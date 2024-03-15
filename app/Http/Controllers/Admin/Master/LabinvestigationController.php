<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\Master\Labinvestigation;
use App\Models\Admin\Miscellaneous\helper;
use Auth;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LabinvestigationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:labinvestigation-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:labinvestigation-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:labinvestigation-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables)
    {
        if (request()->ajax()) {
            $labinvestigation = Labinvestigation::select(array('id', 'uniqid', 'name', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($labinvestigation)
                ->editColumn('created_at', function ($labinvestigation) {
                    return $labinvestigation->created_at->format('d/m/Y H:i:s');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($labinvestigation) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('labinvestigation-show')) {
                        $action .= '<a href="labinvestigation/' . $labinvestigation->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('labinvestigation-edit')) {
                        $action .= '<a href="labinvestigation/' . $labinvestigation->id . '/edit" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/master/labinvestigation/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Labinvestigation $labinvestigation)
    {
        return view('/admin/master/labinvestigation/createorupdate', compact('labinvestigation'));
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
                'name' => 'required|max:50|unique:labinvestigations,name,' . $request->id,
                'range' => 'nullable|max:500',
            ]);

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('labinvestigation.index');

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
            Labinvestigation::where('id', $request['id'])->update($validation);
            toast('Labinvestigation Updated successfully', 'success', 'top-right');
            $trackStatus = $request['uniqid'] . ' Updated Existing Labinvestigation';
        } else {
            $uniqueId = helper::getNextSequenceId(5, 'LAB', 'App\Models\Admin\Master\Labinvestigation');
            $validation['sys_id'] = md5(uniqid(rand(), true));
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['user_id'] = Auth::user()->id;
            $validation['created_by'] = Auth::user()->name;
            Labinvestigation::create($validation);
            toast('New Labinvestigation Created Successfully', 'success', 'top-right');
            $trackStatus = $validation['uniqid'] . ' Created New Labinvestigation';
        }
        helper::trackmessage($trackStatus, 'ADMIN');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Model\/updates\Categoryegory
     * @return \Illuminate\Http\Response
     */
    public function show(Labinvestigation $labinvestigation)
    {
        return view('/admin/master/labinvestigation/show', compact('labinvestigation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Model\/updates\Categoryegory
     * @return \Illuminate\Http\Response
     */
    public function edit(Labinvestigation $labinvestigation)
    {
        return view('/admin/master/labinvestigation/createorupdate', compact('labinvestigation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Model\/updates\Categoryegory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Labinvestigation $labinvestigation)
    {
        // $category->delete();
        // toast('Deleted Successfully', 'error', 'top-right');
        // return redirect()->route('category.index');
    }

}
