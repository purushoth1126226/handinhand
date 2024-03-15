<?php

namespace App\Http\Controllers\Admin\Druginward;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Master\Drug;
use App\Http\Controllers\Controller;
use App\Models\Admin\Druginward\Inward;
use App\Models\Admin\Druginward\Supplier;
use App\Models\Admin\Miscellaneous\helper;
use App\Models\Admin\Druginward\Inwarditem;

class InwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:inward-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:inward-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:inward-delete', ['only' => ['destroy']]);
    }

    public function index()
    {

        if (request()->ajax()) {
            $inward = Inward::select(array('id', 'uniqid', 'supplier_name', 'companyname', 'phone', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($inward)
                ->editColumn('created_at', function ($inward) {
                    return $inward->created_at->format('d/m/Y H:i:s');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($inward) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('inward-show')) {
                        $action .= '<a href="inward/' . $inward->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('inward-edit')) {
                        $action .= '<a href="inward/' . $inward->id . '/edit" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/druginward/inward/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Inward $inward)
    {
        return view('/admin/druginward/inward/createorupdate', compact('inward'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  return $request->all();
      
        try {

            DB::beginTransaction();
            $validation = $this->validate($request, [
                'supplier_id' => 'nullable',
                'supplier_name' => 'required',
                'supplier_uniqid' => 'required',
                'address' => 'nullable',
                'companyname' => 'required',
                'date' => 'required',
                'phone' => 'required',
                'remarks' => 'nullable', 

            ]);

            $validationone = $this->validate($request, [
                'drug_name' => 'required',
                "manufacture_date" => "required|array",
                "manufacture_date.*" => 'required|string|date|after_or_equal:today',
                "expiry_date" => "required|array",
                "expiry_date.*" => 'required|string|date|after_or_equal:today',
                "expiry_alertdate" => "required|array",
                "expiry_alertdate.*" => 'required|string|date|after_or_equal:today',
                // 'bacth_id' => 'required|unique:inwarditems,bacth_id,'.$request->id,
                'bacth_id' => 'required|min:1',
                "bacth_id.*" => 'required|string|distinct|min:1',
                "unit" => "required|array|min:1",
                "unit.*" => 'required|string|min:1',
                "qty" => "required|array|min:1",
                "qty.*" => 'required|integer|min:1',

            ],
                [
                    'bacth_id.*.required' => 'The bacth id field is required',
                    "unit.*.required" => 'The unit field is required ',
                    "qty.*.required" => 'The qty field is required ',
                    'expiry_date.*required' => 'The expiry date is required field is required ',
                    'expiry_alertdate.*required' => 'The expiry alert date is required field is required ',
                    'manufacture_date.*required' => 'The Manufacture date is required field is required ',
                ]);

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('inward.index');

        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (PDOException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
    }

    public function createorupdate($validation, $request)
    {
        $validation['active'] = 1;
        $validation['status'] = 1;

        if (!empty($request['id'])) {
            $validation['updated_id'] = Auth::user()->id;
            $validation['updated_by'] = Auth::user()->name;
            Inward::where('id', $request['id'])->update($validation);
            $inward = Inward::find($request['id']);

            $inwarditemdata = $this->inwarditem($request, $inward->id);
            Inwarditem::where('inward_id', $request['id'])->delete();
            Inwarditem::insert($inwarditemdata);

            toast('Inward Updated successfully', 'success', 'top-right');
            $trackStatus = $request['uniqid'] . ' Updated Existing Inward';
        } else {
            $uniqueId = helper::getNextSequenceId(5, 'IN', 'App\Models\Admin\Druginward\Inward');
            $validation['sys_id'] = md5(uniqid(rand(), true));
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['user_id'] = Auth::user()->id;
            $validation['created_by'] = Auth::user()->name;
            $inward = Inward::create($validation);

            $inwarditemdata = $this->inwarditem($request, $inward->id);
            Inwarditem::insert($inwarditemdata);

            toast('New Inward Created Successfully', 'success', 'top-right');
            $trackStatus = $validation['uniqid'] . ' Created New Inward';
        }
        helper::trackmessage($trackStatus, 'ADMIN');
    }

    public function inwarditem($request, $inward_id)
    {

        $insertDataOne = array();
        if (count($request['drug_id']) > 0) {
           
            for ($i = 0; $i < sizeof($request->drug_id); $i++) {
 
    
                if (!empty($request->id)) {
                    $inwarditem = Inwarditem::where('inward_id',$request->id)->first();
                    if( $inwarditem->qty != $request->qty[$i] )
                    {
                        $drug = Drug::find($request->drug_id[$i]);
                        $drug->currentstock = $drug->currentstock- $inwarditem->qty + $request->qty[$i];
                        $drug->save();
                    }
                }else{
                    $drug = Drug::find($request->drug_id[$i]);
                    $drug->currentstock = $drug->currentstock + $request->qty[$i];
                    $drug->save();
                    
            }
                
               

                $inward = Inward::where('id', $inward_id)->first();

                $insertDataOne[] = [

                    'inward_id' => $inward_id,

                    'drug_id' => $request->drug_id[$i],
                    'drug_name' => Drug::find($request->drug_id[$i])->name,
                    'bacth_id' => $request->bacth_id[$i],
                    'manufacture_date' => $request->manufacture_date[$i],
                    'expiry_date' => $request->expiry_date[$i],
                    'expiry_alertdate' => $request->expiry_alertdate[$i],
                    'price' =>0,

                    'qty' => $request->qty[$i],
                    'balance' => $request->qty[$i],

                    'unit' => $request->unit[$i],
                    'variant' => $request->variant[$i],
                    'created_at' => $inward->created_at,
                    'updated_at' => $inward->updated_at,

                ];
            }
        }

        return $insertDataOne;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\inward\inward  $inward
     * @return \Illuminate\Http\Response
     */
    public function show(Inward $inward)
    {
        $inwarditem = Inwarditem::where('inward_id', '=', $inward->id)->get();
        return view('/admin/druginward/inward/show', compact('inward', 'inwarditem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\inward\inward  $inward
     * @return \Illuminate\Http\Response
     */
    public function edit(Inward $inward)
    {
        return view('/admin/druginward/inward/createorupdate', compact('inward'));
    }

    public function inwardsearch()
    {
        $search = request()->search;
        if ($search) {
            $search_arr = Supplier::where("name", "LIKE", "%{$search}%")
                ->orwhere('phone', 'LIKE', "%{$search}%")
                ->orwhere('company', 'LIKE', "%{$search}%")
                ->orwhere('uniqid', 'LIKE', "%{$search}%")
                ->orwhere('id', 'LIKE', "%{$search}%")
                ->select('id', 'name', 'phone', 'uniqid', 'company')
                ->limit(10)
                ->get();

            echo json_encode($search_arr);
        } else {
            return $supplier = Supplier::find(request()->id);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\inward\inward  $inward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inward $inward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\inward\inward  $inward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inward $inward)
    {
        //
    }
}
