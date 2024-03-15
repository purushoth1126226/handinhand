<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\Master\Diagnosis;
use App\Models\Admin\Miscellaneous\helper;
use Auth;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DiagnosisController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:diagnosis-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:diagnosis-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:diagnosis-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables)
    {
        if (request()->ajax()) {
            $diagnosis = Diagnosis::select(array('id', 'uniqid', 'name', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($diagnosis)
                ->editColumn('created_at', function ($diagnosis) {
                    return $diagnosis->created_at->format('d/m/Y H:i:s');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($diagnosis) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('diagnosis-show')) {
                        $action .= '<a href="diagnosis/' . $diagnosis->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('diagnosis-edit')) {
                        $action .= '<a href="diagnosis/' . $diagnosis->id . '/edit" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/master/diagnosis/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Diagnosis $diagnosis)
    {
        return view('/admin/master/diagnosis/createorupdate', compact('diagnosis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validation = $this->validate($request, [
                'name' => 'required|max:50|unique:diagnoses,name,' . $request->id,
            ]);

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('diagnosis.index');

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
            Diagnosis::where('id', $request['id'])->update($validation);
            toast('Diagnosis Updated successfully', 'success', 'top-right');
            $trackStatus = $request['uniqid'] . ' Updated Existing Diagnosis';
        } else {
            $uniqueId = helper::getNextSequenceId(5, 'DIA', 'App\Models\Admin\Master\Diagnosis');
            $validation['sys_id'] = md5(uniqid(rand(), true));
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['user_id'] = Auth::user()->id;
            $validation['created_by'] = Auth::user()->name;
            Diagnosis::create($validation);
            toast('New Diagnosis Created Successfully', 'success', 'top-right');
            $trackStatus = $validation['uniqid'] . ' Created New Diagnosis';
        }
        helper::trackmessage($trackStatus, 'ADMIN');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Model\/updates\Categoryegory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diagnosis = Diagnosis::find($id);
        return view('/admin/master/diagnosis/show', compact('diagnosis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Model\/updates\Categoryegory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diagnosis = Diagnosis::find($id);
        return view('/admin/master/diagnosis/createorupdate', compact('diagnosis'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Model\/updates\Categoryegory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosis $diagnosis)
    {
        // $diagnosis->delete();
        // toast('Deleted Successfully', 'error', 'top-right');
        // return redirect()->route('diagnosis.index');
    }

}
