<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App;
use App\Http\Controllers\Controller;
use App\Models\Admin\Miscellaneous\logininfo;
use App\Models\Admin\Miscellaneous\tracking;
use App\Models\Admin\Officeutility\Eventcalendar;
use App\Models\Admin\Patients\Enrollment;
use App\Models\Admin\Patients\Vital;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {

        $eventcalendar = Eventcalendar::where('active', 1)->get();
        $user = User::all();
        $tracking = tracking::orderBy('created_at', 'desc')->take(19)->get();

        $data['todayenrollment'] = Enrollment::whereDate('created_at', Carbon::today())->count();
        $data['totalenrollment'] = Enrollment::count();
        $data['todayvital'] = Vital::whereDate('created_at', Carbon::today())->count();
        $data['totalvital'] = Vital::count();

        return view('admin.dashboard.admindashboard', compact('eventcalendar', 'tracking', 'user', 'data'));
    }

    public function loginlogs(DataTables $datatables)
    {
        if (request()->ajax()) {
            $logininfo = logininfo::select(array('id', 'user_name', 'email', 'device', 'browser', 'platform', 'serverIp', 'clientIp', 'login_status', 'created_at'));
            return DataTables::of($logininfo)
                ->editColumn('created_at', function ($logininfo) {
                    return $logininfo->created_at->format('d/m/Y H:i:s');
                })
                ->make(true);
        }
        return view('/admin/logs/loginlogs');
    }

    public function trackinglogs(DataTables $datatables)
    {
        if (request()->ajax()) {
            $tracking = tracking::select(array('id', 'name', 'details', 'created_at'));
            return DataTables::of($tracking)
                ->editColumn('created_at', function ($tracking) {
                    return $tracking->created_at->format('d/m/Y H:i:s');
                })
                ->make(true);
        }
        return view('/admin/logs/trackinglogs');
    }

}
