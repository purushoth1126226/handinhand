<?php

namespace App\Http\Controllers\Admin\Report;

use Excel;
use Carbon\Carbon;
use App\Exports\LabExport;
use App\Exports\VitalExport;
use Illuminate\Http\Request;
use App\Exports\DiagnosisExport;
use Yajra\DataTables\DataTables;
use App\Exports\EnrollmentExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Patients\Vital;
use App\Models\Admin\Master\Diagnosis;
use App\Models\Admin\Patients\Enrollment;
use App\Models\Admin\Master\Labinvestigation;
use App\Models\Admin\Pharmacy\Pharmacyoutward;

class ReportController extends Controller
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

    // ----enrollment------//
    public function enrollmentreport()
    {
        return view('admin/report/enrollmentreport/enrollmentreport');
    }

    public function enrollmentreportshow(Vital $vital)
    {

        return view('admin/report/enrollmentreport/show', compact('vital'));
    }

    public function ajaxenrollmentreport(DataTables $datatables)
    {

        if (!empty(request()->from_date)) {

            request()->from_date = Carbon::parse(request()->from_date . " 00:00:00");
            request()->to_date = Carbon::parse(request()->to_date . " 23:59:59");

            $enrollment = Enrollment::with('village')
                ->select(array('id', 'uniqid', 'name', 'phone', 'village_id', 'created_by', 'created_at'))
                ->whereBetween('created_at', array(request()->from_date, request()->to_date))
                ->orderby('created_at', 'desc');

        } else {
            $enrollment = Enrollment::with('village')
                ->select(array('id', 'uniqid', 'name', 'phone', 'village_id', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
        }

        return DataTables::of($enrollment)
            ->editColumn('created_at', function ($enrollment) {
                return $enrollment->created_at->format('d/m/Y H:i:s');
            })
            ->addIndexColumn()
            ->addColumn('action', function ($enrollment) {
                return '<td class="text-right">
                    <a href="enrollmentreportshow/' . $enrollment->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                   </td>';
            })
            ->rawColumns(['action', 'created_at'])
            ->make(true);

    }

    public function enrollmentreportcsv($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            return Excel::download(new EnrollmentExport($start, $end), 'enrollmentreportcsv.xlsx');
        }
    }

    // ----vital------//

    public function vitalreport()
    {
        return view('admin/report/vitalreport/vitalreport');
    }
    public function vitalreportshow(Vital $vital)
    {

        return view('admin/report/vitalreport/show', compact('vital'));
    }

    public function ajaxvitalreport(DataTables $datatables)
    {

        if (!empty(request()->from_date)) {

            request()->from_date = Carbon::parse(request()->from_date . " 00:00:00");
            request()->to_date = Carbon::parse(request()->to_date . " 23:59:59");

            $vital = Vital::whereBetween('created_at', array(request()->from_date, request()->to_date))
                ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'phone', 'token_id', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');

        } else {
            $vital = Vital::select(array('id', 'uniqid', 'name', 'enrollment_id', 'phone', 'token_id', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
        }

        return DataTables::of($vital)
            ->editColumn('created_at', function ($vital) {
                return $vital->created_at->format('d/m/Y H:i:s');
            })
            ->addIndexColumn()
            ->addColumn('action', function ($vital) {
                return '<td class="text-right">
                    <a href="vitalreportshow/' . $vital->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                   </td>';
            })
            ->rawColumns(['action', 'created_at'])
            ->make(true);

    }

    public function vitalreportcsv($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            return Excel::download(new VitalExport($start, $end), 'vitalreportcsv.xlsx');
        }
    }

    // ----Diagnosis------//

    public function diagnosisreportshow(Vital $vital)
    {
        $pharmacyoutward = Pharmacyoutward::where('vital_id',$vital->id)->get();
        return view('admin/report/diagnosisreport/show', compact('vital','pharmacyoutward'));
    }

    public function diagnosisreport()
    {
        $diagnosis = [0 => 'Select Diagnosis'] + Diagnosis::orderBy('name')->pluck('name', 'id')->all();
        // ->where('active', true)
        return view('admin/report/diagnosisreport/diagnosisreport', compact('diagnosis'));
    }
    public function ajaxdiagnosisreport(DataTables $datatables)
    {

        if (!empty(request()->from_date)) {

            request()->from_date = Carbon::parse(request()->from_date . " 00:00:00");
            request()->to_date = Carbon::parse(request()->to_date . " 23:59:59");

            if (!empty(request()->diagnosis_id)) {
                $vital_id = Diagnosis::find(request()->diagnosis_id)->vital->pluck('id');
                $diagnosis = Vital::whereIn('id', $vital_id)
                    ->whereBetween('created_at', array(request()->from_date, request()->to_date))
                    ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'phone', 'sexuality', 'age', 'created_by', 'created_at'))
                    ->orderby('created_at', 'desc');
            } else {
                $diagnosis = Vital::whereBetween('created_at', array(request()->from_date, request()->to_date))
                    ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'phone', 'sexuality', 'age', 'created_by', 'created_at'))
                    ->orderby('created_at', 'desc');
            }

        } else {
            $diagnosis = Vital::with('diagnosis')
            ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'phone', 'age', 'sexuality', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
        }

        return DataTables::of($diagnosis)
            ->editColumn('created_at', function ($diagnosis) {
                return $diagnosis->created_at->format('d/m/Y H:i:s');
            })
            ->addIndexColumn()
            ->addColumn('diagnosis', function (Vital $vital) {
                return $vital->diagnosis->map(function($diagnosis) {
                    return $diagnosis->name;
                })->implode(',');
            })

            ->addColumn('action', function ($diagnosis) {
                return '<td class="text-right">
                    <a href="diagnosisreportshow/' . $diagnosis->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                   </td>';
            })
            ->rawColumns(['action', 'created_at'])
            ->make(true);

    }

    public function diagnosisreportcsv($start = null, $end = null, $diagnosis_id = null)
    {

        if ($start != null && $end != null) {

            $start = Carbon::parse($start . " 00:00:00");
            $end = Carbon::parse($end . " 23:59:59");

            if ($diagnosis_id != 0) {
                $diagnosis = Diagnosis::find($diagnosis_id);

                $diagnosisname = $diagnosis->name;
                $vital = $diagnosis->vital->whereBetween('created_at', [$start, $end]);
                if ($vital->isEmpty()) {
                    toast('Diagnosis Report record not Found');
                    return redirect()->back();
                }

            } else {
                $vital = Vital::whereBetween('created_at', [$start, $end])->get();
                $diagnosisname = null;
            }

            return Excel::download(new DiagnosisExport($vital, $diagnosisname), 'diagnosisreportcsv.xlsx');
        }

    }

    // ----LAB REPORT------//

    public function labreport()
    {
        $labinvestigation = [0 => 'Select Labinvestigation'] + Labinvestigation::orderBy('name')->pluck('name', 'id')->all();
        // ->where('active', true)
        return view('admin/report/labreport/labreport', compact('labinvestigation'));
    }
    public function labreportshow(Vital $vital)
    {

        return view('admin/report/labreport/show', compact('vital'));
    }

    public function ajaxlabreport(DataTables $datatables)
    {
        if (!empty(request()->from_date)) {

            request()->from_date = Carbon::parse(request()->from_date . " 00:00:00");
            request()->to_date = Carbon::parse(request()->to_date . " 23:59:59");

            if (!empty(request()->labinvestigation_id)) {
                $vital_id = Labinvestigation::find(request()->labinvestigation_id)->vital->pluck('id');
                $lab = Vital::whereNotNull('is_labarotary')
                    ->whereIn('id', $vital_id)
                    ->whereBetween('created_at', array(request()->from_date, request()->to_date))
                    ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'phone', 'sexuality', 'labarotarystatus', 'age', 'created_by', 'created_at'))
                    ->orderby('created_at', 'desc');
            } else {
                $lab = Vital::whereNotNull('is_labarotary')
                    ->whereBetween('created_at', array(request()->from_date, request()->to_date))
                    ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'phone', 'sexuality', 'age', 'labarotarystatus', 'created_by', 'created_at'))
                    ->orderby('created_at', 'desc');
            }

        } else {
            $lab = Vital::whereNotNull('is_labarotary')
                ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'labarotarystatus', 'phone', 'age', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
        }

        return DataTables::of($lab)
            ->setRowClass(function ($lab) {
                if ($lab->labarotarystatus == 0) {
                    return 'font-bold text-red-500';
                }
                if ($lab->labarotarystatus == 1) {
                    return 'font-bold text-yellow-600';
                }
                if ($lab->labarotarystatus == 2) {
                    return 'font-bold text-green-600';
                }

            })
            ->editColumn('created_at', function ($lab) {
                return $lab->created_at->format('d/m/Y H:i:s');
            })

            ->editColumn('labreport', function ($lab) {
                return $lab->labreport->pluck('name')->implode(', ');
            })
            ->addIndexColumn()
            ->addColumn('action', function ($lab) {
                return '<td class="text-right">
            <a href="labreportshow/' . $lab->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
           </td>';
            })

            ->rawColumns(['action', 'created_at', 'labreport'])
            ->make(true);

    }

    public function labreportcsv($start = null, $end = null, $labinvestigation_id = null)
    {

        if ($start != null && $end != null) {

            $start = Carbon::parse($start . " 00:00:00");
            $end = Carbon::parse($end . " 23:59:59");

            if ($labinvestigation_id != 0) {
                $labinvestigation = Labinvestigation::find($labinvestigation_id);

                $labinvestigationname = $labinvestigation->name;
                $vital = $labinvestigation->vital->whereBetween('created_at', [$start, $end]);
                if ($vital->isEmpty()) {
                    toast('Lab Report record not Found');
                    return redirect()->back();
                }

            } else {
                $vital = Vital::whereBetween('created_at', [$start, $end])->get();
                $labinvestigationname = null;
            }

            return Excel::download(new LabExport($vital, $labinvestigationname), 'labreportcsv.xlsx');
        }
    }
}
