<?php

namespace App\Http\Controllers\Admin\Report;

use App\Exports\DrugalertExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Druginward\Inwarditem;
use Carbon\Carbon;
use Excel;
use Yajra\DataTables\DataTables;

class DrugalertreportController extends Controller
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

    // ----drugalert------//
    public function drugalertreport()
    {
        return view('admin/report/drugalertreport/drugalertreport');
    }

    public function ajaxdrugalertreport(DataTables $datatables)
    {

        if (!empty(request()->from_date)) {

            request()->from_date = Carbon::parse(request()->from_date . " 00:00:00");
            request()->to_date = Carbon::parse(request()->to_date . " 23:59:59");

            $drugexpiry = Inwarditem::where('balance', '>=', 0)
                ->select(array('id', 'drug_name', 'expiry_alertdate', 'variant', 'qty', 'balance', 'unit', 'bacth_id', 'manufacture_date', 'created_at'))
                ->whereBetween('expiry_alertdate', array(request()->from_date, request()->to_date))
                ->orderby('expiry_alertdate', 'desc');

        } else {
            $drugexpiry = Inwarditem::where('balance', '>=', 0)
                ->whereDate('expiry_alertdate', '=', Carbon::now())
                ->select(array('id', 'drug_name', 'variant', 'expiry_alertdate', 'qty', 'balance', 'unit', 'bacth_id', 'manufacture_date', 'created_at'))
                ->orderby('expiry_alertdate', 'desc');
        }

        return DataTables::of($drugexpiry)

            ->addIndexColumn()
            ->editColumn('expiry_alertdate', function($drugexpiry){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $drugexpiry->expiry_alertdate)
                ->format('d-m-Y'); 
                return $formatedDate; })
           ->editColumn('manufacture_date', function($drugexpiry){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $drugexpiry->manufacture_date)
                    ->format('d-m-Y'); 
                    return $formatedDate; })
           
            ->make(true);

    }

    public function drugalertreportcsv($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            return Excel::download(new DrugalertExport($start, $end), 'drugalertreportcsv.xlsx');
        }
    }

}
