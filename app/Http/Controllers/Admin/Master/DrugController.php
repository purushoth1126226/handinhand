<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\Master\Diagnosis;
use App\Models\Admin\Master\Drug;
use App\Models\Admin\Miscellaneous\helper;
use Auth;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DrugController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:drug-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:drug-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:drug-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables)
    {
        if (request()->ajax()) {
            $drug = Drug::select(array('id', 'uniqid', 'name', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($drug)
                ->editColumn('created_at', function ($drug) {
                    return $drug->created_at->format('d/m/Y H:i:s');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($drug) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('drug-show')) {
                        $action .= '<a href="drug/' . $drug->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('drug-edit')) {
                        $action .= '<a href="drug/' . $drug->id . '/edit" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/master/drug/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Drug $drug)
    {
        return view('/admin/master/drug/createorupdate', compact('drug'));
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
                'name' => 'required|max:50|unique:drugs,name,' . $request->id,
                // 'drug_id' => 'required',
                'generic_name' => 'required',
                'drug_variant' => 'required',
                'drug_classification' => 'required',
                'dosage' => 'nullable',
                'remarks' => 'nullable',
                'manufacture_name' => 'required',

            ]);

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('drug.index');

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
            Drug::where('id', $request['id'])->update($validation);
            $drug = Drug::find($request['id']);
            $drug->diagnosis()->sync($request->diagnosis_select);
            toast('Drug Updated successfully', 'success', 'top-right');
            $trackStatus = $request['uniqid'] . ' Updated Existing Drug';
        } else {
            $uniqueId = helper::getNextSequenceId(5, 'D', 'App\Models\Admin\Master\Drug');
            $validation['sys_id'] = md5(uniqid(rand(), true));
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['user_id'] = Auth::user()->id;
            $validation['created_by'] = Auth::user()->name;
            $validation['currentstock'] = 0;
            $drug = Drug::create($validation);
            $drug->diagnosis()->attach($request->diagnosis_select);
            toast('New Drug Created Successfully', 'success', 'top-right');
            $trackStatus = $validation['uniqid'] . ' Created New Drug';
        }
        helper::trackmessage($trackStatus, 'ADMIN');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Model\/updates\drugegory
     * @return \Illuminate\Http\Response
     */
    public function show(Drug $drug)
    {
        return view('/admin/master/drug/show', compact('drug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Model\/updates\drugegory
     * @return \Illuminate\Http\Response
     */
    public function edit(Drug $drug)
    {
        return view('/admin/master/drug/createorupdate', compact('drug'));
    }

    public function ajaxdrugsmultiselect()
    {

        $diagnosis = Diagnosis::where('active', true)->get();
        $diagnosisoption = '<option value="">SELECT DIAGNOSIS</option>';
        foreach ($diagnosis as $row) {
            $diagnosisoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $data = [
            'diagnosisoption' => $diagnosisoption,
        ];

        echo json_encode($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Model\/updates\drug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        // $category->delete();
        // toast('Deleted Successfully', 'error', 'top-right');
        // return redirect()->route('category.index');
    }

}
