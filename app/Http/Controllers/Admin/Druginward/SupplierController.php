<?php

namespace App\Http\Controllers\Admin\Druginward;

use App\Http\Controllers\Controller;
use App\Models\Admin\Druginward\Supplier;
use App\Models\Admin\Miscellaneous\helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:supplier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:supplier-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }

    public function index()
    {

        if (request()->ajax()) {
            $supplier = Supplier::select(array('id', 'uniqid', 'name', 'company', 'phone', 'email', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($supplier)
                ->editColumn('created_at', function ($supplier) {
                    return $supplier->created_at->format('d/m/Y H:i:s');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($supplier) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('supplier-show')) {
                        $action .= '<a href="supplier/' . $supplier->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('supplier-edit')) {
                        $action .= '<a href="supplier/' . $supplier->id . '/edit" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/druginward/supplier/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Supplier $supplier)
    {
        return view('/admin/druginward/supplier/createorupdate', compact('supplier'));
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
                'name' => 'required|max:50',
                'company' => 'required|max:50',
                'phone' => 'required|digits:10|unique:suppliers,phone,' . $request->id,
                'phone_two' => 'nullable|digits:10|different:phone',
                'email' => 'nullable',
                'billing_address' => 'required',
                'remarks' => 'nullable',
                'city' => 'nullable',
                'state' => 'nullable',
                'pincode' => 'nullable',
                'gstin' => 'nullable',
                'pan' => 'nullable',
                'bankname' => 'nullable',
                'bankifsc' => 'nullable',
                'bankbranch' => 'nullable',
                'bankaccountnumber' => 'nullable',

            ]);

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('supplier.index');

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
            Supplier::where('id', $request['id'])->update($validation);
            toast('Supplier Updated successfully', 'success', 'top-right');
            $trackStatus = $request['uniqid'] . ' Updated Existing Supplier';
        } else {
            $uniqueId = helper::getNextSequenceId(5, 'SUP', 'App\Models\Admin\Druginward\Supplier');
            $validation['sys_id'] = md5(uniqid(rand(), true));
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['user_id'] = Auth::user()->id;
            $validation['created_by'] = Auth::user()->name;
            Supplier::create($validation);
            toast('New Supplier Created Successfully', 'success', 'top-right');
            $trackStatus = $validation['uniqid'] . ' Created New Supplier';
        }
        helper::trackmessage($trackStatus, 'ADMIN');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Druginward\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('/admin/druginward/supplier/show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Druginward\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('/admin/druginward/supplier/createorupdate', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Druginward\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Druginward\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
