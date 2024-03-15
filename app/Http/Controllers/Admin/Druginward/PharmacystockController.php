<?php

namespace App\Http\Controllers\Admin\Druginward;

use App\Http\Controllers\Controller;
use App\Models\Admin\Druginward\Inwarditem;
use App\Models\Admin\Master\Drug;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PharmacystockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:pharmacy-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pharmacy-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pharmacy-delete', ['only' => ['destroy']]);

    }

    public function pharmacystock()
    {

        if (request()->ajax()) {
            // $inwarditem = Inwarditem::whereDate('expiry_date', '<>', Carbon::now())
            //     ->pluck('drug_id');
            $pharmacystock = Drug::where('currentstock', '>=', 0)
                // ->whereIn('id', $inwarditem)
                ->select(array('id', 'uniqid', 'name', 'currentstock', 'manufacture_name', 'generic_name', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($pharmacystock)
                ->editColumn('created_at', function ($pharmacystock) {
                    return $pharmacystock->created_at->format('d/m/Y H:i:s');
                })
                ->addIndexColumn()
                ->rawColumns(['created_at'])
                ->make(true);
        }
        return view('admin/druginward/pharmacystock/index');
    }

}
