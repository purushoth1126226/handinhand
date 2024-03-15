<?php

namespace App\Http\Controllers\Admin\Report;

use App\Exports\InwarditemExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Druginward\Inwarditem;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InwarditemreportController extends Controller
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

    // ----inwarditem------//
    public function inwarditemreport()
    {
        return view('admin/report/inwarditemreport/inwarditemreport');
    }

    public function ajaxinwarditemreport(DataTables $datatables)
    {

        if (!empty(request()->from_date)) {

            request()->from_date = Carbon::parse(request()->from_date . " 00:00:00");
            request()->to_date = Carbon::parse(request()->to_date . " 23:59:59");

            $inwarditem = Inwarditem::where('balance', '>=', 0)
                ->select(array('id', 'drug_name', 'expiry_date','variant', 'qty', 'balance', 'unit', 'bacth_id', 'manufacture_date','expiry_alertdate', 'created_at'))
                ->whereBetween('created_at', array(request()->from_date, request()->to_date));
              
                

        } else {
            $inwarditem = Inwarditem::where('balance', '>=', 0)
                ->select(array('id', 'drug_name', 'variant', 'expiry_date', 'qty', 'balance', 'unit', 'bacth_id', 'manufacture_date','expiry_alertdate', 'created_at'));
              
            }
            
            return DataTables::of($inwarditem)
           

            ->addIndexColumn()
          
            ->editColumn('expiry_date', function($inwarditem){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $inwarditem->expiry_date)
                ->format('d-m-Y'); 
                return $formatedDate; })
                ->editColumn('expiry_alertdate', function($inwarditem){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $inwarditem->expiry_alertdate)
                    ->format('d-m-Y'); 
                    return $formatedDate; })
       
           ->editColumn('manufacture_date', function($inwarditem){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $inwarditem->manufacture_date)
                    ->format('d-m-Y'); 
                    return $formatedDate; })
            ->make(true);

    }

    public function inwarditemreportcsv($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            return Excel::download(new InwarditemExport($start, $end), 'inwarditemreportcsv.xlsx');
        }
    }

}
