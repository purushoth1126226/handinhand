<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Admin\Druginward\Inwarditem;
use App\Models\Admin\Master\Drug;
use App\Models\Admin\Patients\Doctorprescription;
use App\Models\Admin\Patients\Vital;
use App\Models\Admin\Pharmacy\Pharmacyoutward;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PharmacyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:patientpharmacy-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patientpharmacy-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patientpharmacy-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function patientlist(DataTables $datatables)
    {
        if (request()->ajax()) {
            $vital = Vital::with('diagnosis')
                ->whereNotNull('is_pharmacy')
                ->whereDate('created_at', Carbon::today())
                ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'pharmacystatus', 'phone', 'token_id', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($vital)
                ->setRowClass(function ($vital) {
                    if ($vital->pharmacystatus == 0) {
                        return 'font-bold text-red-500';
                    }
                    if ($vital->pharmacystatus == 1) {
                        return 'font-bold text-yellow-600';
                    }
                    if ($vital->pharmacystatus == 2) {
                        return 'font-bold text-green-600';
                    }

                })
                ->editColumn('created_at', function ($vital) {
                    return $vital->created_at->format('d/m/Y H:i:s');
                })
                ->editColumn('diagnosis', function ($vital) {
                    return $vital->diagnosis->pluck('name')->implode(', ');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($vital) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('patientpharmacy-show')) {
                        $action .= '<a href="pharmacyshow/' . $vital->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('patientpharmacy-edit')) {
                        $action .= '<a href="pharmacyentry/' . $vital->id . '" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/pharmacy/patientlist/index');
    }
    public function pharmacyshow(Vital $vital)
    {
        $pharmacyoutward = Pharmacyoutward::where('vital_id', '=', $vital->id)->get();
        $doctorprescription = Doctorprescription::where('vital_id', '=', $vital->id)->get();
        $status = ($doctorprescription->count() > 0) ? 1 : 0;
        return view('admin/pharmacy/patientlist/pharmacyshow', compact('vital', 'doctorprescription', 'status', 'pharmacyoutward'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        try {
            DB::beginTransaction();

            // if(!$request->id){
            $validation = $this->validate($request, [
                'pharmacyremarks' => 'nullable',
                'outward_qty' => 'required|array',
                "outward_qty.*" => 'required|lte:balance.*',

            ],
                [
                    'outward_qty.required' => 'The received qty field is required',
                    'lte' => 'The received qty must be less than or equal to balance',
                    "outward_qty.*.required" => 'The outward_qty field is required ',
                ]);

            $vital = Vital::find($request['id']);
            if (!$vital->is_pharmacyattended) {
                $vital->is_pharmacyattended = Carbon::now();
            }
            $vital->pharmacyremarks = $request->pharmacyremarks;
            $vital->pharmacystatus = $request->pharmacystatus;
            $vital->save();
            if (!empty($request['id'])) {
                // $vital = Vital::find($request['id']);

                $pharmacyoutward = $this->pharmacyoutward($request, $vital);
                Pharmacyoutward::where('vital_id', $request['id'])->delete();
                Pharmacyoutward::insert($pharmacyoutward);
            }

            DB::commit();
            return redirect()->route('pharmacypatientlist.index');

        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException$e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (PDOException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }

    }

    public function pharmacyoutward($request, $vital)
    {

        $insertDataOne = array();
        if (count($request['drug_id']) > 0) {
            for ($i = 0; $i < sizeof($request->drug_id); $i++) {

                $drug = Drug::find($request->drug_id[$i]);

                $pharmacyoutward = Pharmacyoutward::where('vital_id', $request['id'])
                    ->where('drug_id', $request->drug_id[$i])
                    ->where('bacth_id', $request->bacth_id[$i])
                    ->where('inward_id', $request->inward_id[$i])
                    ->first();
                if ($pharmacyoutward) {
                    $drug->currentstock = $drug->currentstock + ($pharmacyoutward->qty - $pharmacyoutward->balance) - ($request->received_qty[$i]+$request->outward_qty[$i]);
            
                } else {
                    $drug->currentstock = $drug->currentstock - $request->outward_qty[$i];
                   
                }

                $drug->save();

                $inwarditem = Inwarditem::find($request->inward_id[$i]);
                if ($pharmacyoutward) {
                $inwarditem->balance = $pharmacyoutward->qty  - ($request->received_qty[$i]+$request->outward_qty[$i]);
                } else {
                $inwarditem->balance = $inwarditem->balance - $request->outward_qty[$i];
               
               }
            $inwarditem->save();
                

                $insertDataOne[] = [
                    'enrollment_id' => $request->enrollment_id,
                    'enrollment_uuid' => $request->enrollment_uuid,
                    'enrollment_uniqid' => $request->enrollment_uniqid,

                    'vital_id' => $vital->id,
                    'vital_uuid' => $vital->uuid,
                    'vital_uniqid' => $vital->uniqid,
                    'patient_name' => $vital->name,
                    'patient_phone' => $vital->phone,

                    'inward_id' => $request->inward_id[$i],

                    'drug_id' => $request->drug_id[$i],
                    'drug_name' => Drug::find($request->drug_id[$i])->name,
                    'bacth_id' => $request->bacth_id[$i],
                    'manufacture_date' => $request->manufacture_date[$i],
                    'expiry_date' => $request->expiry_date[$i],
                    'expiry_alertdate' => $request->expiry_alertdate[$i],

                    'qty' => $request->qty[$i],
                    'balance' => $request->qty[$i] - ($request->outward_qty[$i]+$request->received_qty[$i]),
                   

                    'unit' => $request->unit[$i],
                    'variant' => $request->variant[$i],
                    'received_qty' => $request->received_qty[$i]+$request->outward_qty[$i],

                ];
            }
        }

        return $insertDataOne;
    }

    public function pharmacyentry(Vital $vital)
    {

        $doctorprescription = Doctorprescription::where('vital_id', '=', $vital->id)->get();
        $status = ($doctorprescription->count() > 0) ? 1 : 0;
        return view('admin/pharmacy/patientlist/pharmacyentry', compact('vital', 'doctorprescription', 'status'));
    }

    public function patienthistory(DataTables $datatables)
    {
        if (request()->ajax()) {
            $vital = Vital::select(array('id', 'uniqid', 'name', 'pharmacystatus', 'enrollment_id', 'phone', 'token_id', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($vital)
                ->setRowClass(function ($vital) {
                    if ($vital->pharmacystatus == 0) {
                        return 'font-bold text-red-500';
                    }
                    if ($vital->pharmacystatus == 1) {
                        return 'font-bold text-yellow-600';
                    }
                    if ($vital->pharmacystatus == 2) {
                        return 'font-bold text-green-600';
                    }

                })
                ->editColumn('created_at', function ($vital) {
                    return $vital->created_at->format('d/m/Y H:i:s');
                })
                ->editColumn('diagnosis', function ($vital) {
                    return $vital->diagnosis->pluck('name')->implode(', ');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($vital) {
                    return '<td class="text-right">
                    <a href="pharmacyhistoryshow/' . $vital->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                   </td>';
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/pharmacy/patienthistory/index');
    }

    public function pharmacyhistoryshow(Vital $vital)
    {
        $pharmacyoutward = Pharmacyoutward::where('vital_id', '=', $vital->id)->get();
        return view('admin/pharmacy/patienthistory/show', compact('vital', 'pharmacyoutward'));
    }

}
