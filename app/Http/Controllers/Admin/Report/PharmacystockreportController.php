<?php

namespace App\Http\Controllers\Admin\Report;

use Excel;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Models\Admin\Master\Drug;
use App\Exports\PharmacystockExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Druginward\Inwarditem;
use App\Models\Admin\Druginward\Pharmacystock;

class PharmacystockreportController extends Controller
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

    // ----pharmacystock------//
    public function pharmacystockreport()
    {
        return view('admin/report/pharmacystockreport/pharmacystockreport');
    }

    public function ajaxpharmacystockreport(DataTables $datatables)
    {

        if (!empty(request()->from_date)) {

            request()->from_date = Carbon::parse(request()->from_date . " 00:00:00");
            request()->to_date = Carbon::parse(request()->to_date . " 23:59:59");

            // $drugexpiry =   $inwarditem = Inwarditem::whereDate('expiry_date', '<>', Carbon::now())
            // ->pluck('drug_id');
          $pharmacystock = Drug::where('currentstock', '>=', 0)
            // ->whereIn('id', $inwarditem)
            ->select(array('id', 'uniqid', 'name', 'currentstock', 'manufacture_name', 'generic_name'))
            ->whereBetween('created_at', array(request()->from_date, request()->to_date))
            ->orderby('created_at', 'desc');

        } else {
            // $drugexpiry =   $inwarditem = Inwarditem::whereDate('expiry_date', '<>', Carbon::now())
            // ->pluck('drug_id');
        $pharmacystock = Drug::where('currentstock', '>=', 0)
            // ->whereIn('id', $inwarditem)
            ->select(array('id', 'uniqid', 'name', 'currentstock', 'manufacture_name', 'generic_name', 'created_by', 'created_at'))
            ->orderby('created_at', 'desc');
        }

        return DataTables::of($pharmacystock)

            ->addIndexColumn()
           
            ->make(true);

    }

    public function pharmacystockreportcsv($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            return Excel::download(new PharmacystockExport($start, $end), 'pharmacystockreportcsv.xlsx');
        }
    }

}
