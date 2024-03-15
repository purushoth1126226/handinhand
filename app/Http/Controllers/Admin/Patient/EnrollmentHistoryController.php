<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\Admin\Patients\Enrollment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EnrollmentHistoryController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function enrollmenthistory(DataTables $datatables)
    {
        if (request()->ajax()) {
            $vital = Enrollment::with('village')
                ->select(array('id', 'uniqid', 'name', 'phone', 'village_id', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($vital)
            ->addIndexColumn()
                ->editColumn('created_at', function ($vital) {
                    return $vital->created_at->format('d/m/Y H:i:s');
                })
                ->editColumn('villagename', function ($vital) {
                    return ($vital->village) ? $vital->village->name : '-';
                })
                ->addColumn('action', function ($vital) {
                    return '<td class="text-right">
                    <a href="enrollmenthistory/' . $vital->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                   </td>';
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/patient/enrollmenthistory/index');
    }

    public function show($id)
    {
        $vital = Enrollment::find($id);
        return view('/admin/patient/enrollmenthistory/show', compact('vital'));
    }

}
