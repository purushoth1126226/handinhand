<?php

namespace App\Http\Controllers\Admin\Report;

use App\Exports\DrugexpiryExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Druginward\Inwarditem;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DrugexpiryreportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);

    }

    // ----drugexpiry------//
    public function drugexpiryreport()
    {
        return view('admin/report/drugexpiryreport/drugexpiryreport');
    }

    public function ajaxdrugexpiryreport(DataTables $datatables)
    {

        if (!empty(request()->from_date)) {

            request()->from_date = Carbon::parse(request()->from_date . " 00:00:00");
            request()->to_date = Carbon::parse(request()->to_date . " 23:59:59");

            $drugexpiry = Inwarditem::where('balance', '>=', 0)
                ->select(array('id', 'drug_name', 'expiry_date', 'variant', 'qty', 'balance', 'unit', 'bacth_id', 'manufacture_date', 'created_at'))
                ->whereBetween('expiry_date', array(request()->from_date, request()->to_date))
                ->orderby('expiry_date', 'desc');
                

        } else {
            $drugexpiry = Inwarditem::whereDate('expiry_date', '=', Carbon::now())
                ->where('balance', '>=', 0)
                ->select(array('id', 'drug_name', 'variant', 'expiry_date', 'qty', 'balance', 'unit', 'bacth_id', 'manufacture_date', 'created_at'))
                ->orderby('expiry_date', 'desc');
            }
            
            return DataTables::of($drugexpiry)
           

            ->addIndexColumn()
            ->editColumn('expiry_date', function($drugexpiry){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $drugexpiry->expiry_date)
                ->format('d-m-Y'); 
                return $formatedDate; })
           ->editColumn('manufacture_date', function($drugexpiry){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $drugexpiry->manufacture_date)
                    ->format('d-m-Y'); 
                    return $formatedDate; })
            ->make(true);

    }

    public function drugexpiryreportcsv($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            return Excel::download(new DrugexpiryExport($start, $end), 'drugexpiryreportcsv.xlsx');
        }
    }

}
