<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\Master\Physicalandgeneralexamination;
use App\Models\Admin\Miscellaneous\helper;
use Auth;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PhysicalandgeneralexaminationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:physicalandgeneralexam-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:physicalandgeneralexam-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:physicalandgeneralexam-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables)
    {
        if (request()->ajax()) {
            $physicalandgeneralexamination = Physicalandgeneralexamination::select(array('id', 'uniqid', 'name', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($physicalandgeneralexamination)
                ->editColumn('created_at', function ($physicalandgeneralexamination) {
                    return $physicalandgeneralexamination->created_at->format('d/m/Y H:i:s');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($physicalandgeneralexamination) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('physicalandgeneralexam-show')) {
                        $action .= '<a href="physicalandgeneralexamination/' . $physicalandgeneralexamination->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('physicalandgeneralexam-edit')) {
                        $action .= '<a href="physicalandgeneralexamination/' . $physicalandgeneralexamination->id . '/edit" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/master/physicalandgeneralexamination/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Physicalandgeneralexamination $physicalandgeneralexamination)
    {
        return view('/admin/master/physicalandgeneralexamination/createorupdate', compact('physicalandgeneralexamination'));
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
                'name' => 'required|max:50|unique:physicalandgeneralexaminations,name,' . $request->id,
            ]);

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('physicalandgeneralexamination.index');

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
            Physicalandgeneralexamination::where('id', $request['id'])->update($validation);
            toast('Physical and generalexamination Updated successfully', 'success', 'top-right');
            $trackStatus = $request['uniqid'] . ' Updated Existing Physical and generalexamination';
        } else {
            $uniqueId = helper::getNextSequenceId(5, 'PHY', 'App\Models\Admin\Master\Physicalandgeneralexamination');
            $validation['sys_id'] = md5(uniqid(rand(), true));
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['user_id'] = Auth::user()->id;
            $validation['created_by'] = Auth::user()->name;
            Physicalandgeneralexamination::create($validation);
            toast('New physicalandgeneralexamination Created Successfully', 'success', 'top-right');
            $trackStatus = $validation['uniqid'] . ' Created New physicalandgeneralexamination';
        }
        helper::trackmessage($trackStatus, 'ADMIN');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Model\/updates\physicalandgeneralexaminatione
     * @return \Illuminate\Http\Response
     */
    public function show(Physicalandgeneralexamination $physicalandgeneralexamination)
    {
        return view('/admin/master/physicalandgeneralexamination/show', compact('physicalandgeneralexamination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Model\/updates\physicalandgeneralexaminationegory
     * @return \Illuminate\Http\Response
     */
    public function edit(Physicalandgeneralexamination $physicalandgeneralexamination)
    {
        return view('/admin/master/physicalandgeneralexamination/createorupdate', compact('physicalandgeneralexamination'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Model\/updates\physicalandgeneralexamination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Physicalandgeneralexamination $physicalandgeneralexamination)
    {
        // $category->delete();
        // toast('Deleted Successfully', 'error', 'top-right');
        // return redirect()->route('category.index');
    }

}
