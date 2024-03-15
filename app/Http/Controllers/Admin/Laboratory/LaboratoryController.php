<?php

namespace App\Http\Controllers\Admin\Laboratory;

use App\Http\Controllers\Controller;
use App\Models\Admin\Patients\Labreport;
use App\Models\Admin\Patients\Vital;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LaboratoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:patientlab-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patientlab-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patientlab-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function patientlist(DataTables $datatables)
    {
        if (request()->ajax()) {
            $vital = Vital::whereNotNull('is_labarotary')
                ->whereDate('created_at', Carbon::today())
                ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'labarotarystatus', 'phone', 'token_id', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($vital)
                ->setRowClass(function ($vital) {
                    if ($vital->labarotarystatus == 0) {
                        return 'font-bold text-red-500';
                    }
                    if ($vital->labarotarystatus == 1) {
                        return 'font-bold text-yellow-600';
                    }
                    if ($vital->labarotarystatus == 2) {
                        return 'font-bold text-green-600';
                    }

                })

                ->editColumn('created_at', function ($vital) {
                    return $vital->created_at->format('d/m/Y H:i:s');
                })
                ->editColumn('diagnosis', function ($vital) {
                    return $vital->diagnosis->pluck('name')->implode(', ');
                })
                ->editColumn('labreport', function ($vital) {
                    return $vital->labreport->pluck('name')->implode(', ');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($vital) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('patientlab-show')) {
                        $action .= '<a href="labarotaryshow/' . $vital->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('patientlab-edit')) {
                        $action .= '<a href="labarotaryentry/' . $vital->id . '" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/laboratory/patientlist/index');
    }
    public function patienthistory(DataTables $datatables)
    {
        if (request()->ajax()) {
            $vital = Vital::with('diagnosis')
                ->whereNotNull('is_labarotary')
                ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'labarotarystatus', 'phone', 'token_id', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($vital)
                ->setRowClass(function ($vital) {
                    if ($vital->labarotarystatus == 0) {
                        return 'font-bold text-red-500';
                    }
                    if ($vital->labarotarystatus == 1) {
                        return 'font-bold text-yellow-600';
                    }
                    if ($vital->labarotarystatus == 2) {
                        return 'font-bold text-green-600';
                    }

                })
                ->editColumn('created_at', function ($vital) {
                    return $vital->created_at->format('d/m/Y H:i:s');
                })
                ->editColumn('diagnosis', function ($vital) {
                    return $vital->diagnosis->pluck('name')->implode(', ');
                })
                ->editColumn('labreport', function ($vital) {
                    return $vital->labreport->pluck('name')->implode(', ');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($vital) {
                    return '<td class="text-right">
                    <a href="patienthistoryshow/' . $vital->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                   </td>';
                })
                ->rawColumns(['action', 'created_at', 'diagnosis'])
                ->make(true);
        }
        return view('admin/laboratory/patienthistory/index');
    }

    public function labarotaryshow(Vital $vital)
    {
        return view('/admin/laboratory/patientlist/show', compact('vital'));
    }

    public function labarotaryentry(Vital $vital)
    {
        return view('/admin/laboratory/patientlist/laboratoryentry', compact('vital'));
    }

    public function store(Request $request)
    {
        //   return $request->all();
        try {
            DB::beginTransaction();
            $validation = $this->validate($request, [
                'labarotaryremark' => 'nullable',
            ]);
            $vital = Vital::find($request['id']);
            if (!$vital->is_labarotaryattended) {
                $vital->is_labarotaryattended = Carbon::now();
            }

            $vital->labarotaryremark = $request->labarotaryremark;
            $vital->labarotarystatus = $request->labarotarystatus;
            $vital->save();

            foreach ($request->labreport_id as $key => $value) {
                $sample = ($request->sample && in_array($key, $request->sample)) ? 1 : 0;
                Labreport::find($value)
                    ->update(['result' => $request->result[$key], 'sample' => $sample]);
            }

            DB::commit();
            return redirect()->route('labpatientlist.index');

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

    public function patienthistoryshow(Vital $vital)
    {
        return view('/admin/laboratory/patienthistory/show', compact('vital'));
    }

}
