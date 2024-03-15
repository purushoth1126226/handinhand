<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\Master\Illness;
use App\Models\Admin\Miscellaneous\helper;
use Auth;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IllnessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:illness-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:illness-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:illness-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables)
    {
        if (request()->ajax()) {
            $illness = Illness::select(array('id', 'uniqid', 'name', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($illness)
                ->editColumn('created_at', function ($illness) {
                    return $illness->created_at->format('d/m/Y H:i:s');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($illness) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('illness-show')) {
                        $action .= '<a href="illness/' . $illness->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('illness-edit')) {
                        $action .= '<a href="illness/' . $illness->id . '/edit" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/master/illness/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Illness $illness)
    {
        return view('/admin/master/illness/createorupdate', compact('illness'));
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
                'name' => 'required|max:50|unique:illnesses,name,' . $request->id,
            ]);

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('illness.index');

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
            Illness::where('id', $request['id'])->update($validation);
            toast('Illness Updated successfully', 'success', 'top-right');
            $trackStatus = $request['uniqid'] . ' Updated Existing Illness';
        } else {
            $uniqueId = helper::getNextSequenceId(5, 'IL', 'App\Models\Admin\Master\Illness');
            $validation['sys_id'] = md5(uniqid(rand(), true));
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['user_id'] = Auth::user()->id;
            $validation['created_by'] = Auth::user()->name;
            Illness::create($validation);
            toast('New Illness Created Successfully', 'success', 'top-right');
            $trackStatus = $validation['uniqid'] . ' Created New Illness';
        }
        helper::trackmessage($trackStatus, 'ADMIN');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Model\/updates\illnessegory
     * @return \Illuminate\Http\Response
     */
    public function show(Illness $illness)
    {
        return view('/admin/master/illness/show', compact('illness'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Model\/updates\illnessegory
     * @return \Illuminate\Http\Response
     */
    public function edit(Illness $illness)
    {
        return view('/admin/master/illness/createorupdate', compact('illness'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Model\/updates\illnessegory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Illness $illness)
    {
        // $illness->delete();
        // toast('Deleted Successfully', 'error', 'top-right');
        // return redirect()->route('allergy.index');
    }
}
