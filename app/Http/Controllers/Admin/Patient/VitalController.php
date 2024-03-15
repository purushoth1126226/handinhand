<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\Admin\Master\Allergy;
use App\Models\Admin\Master\Diagnosis;
use App\Models\Admin\Master\Illness;
use App\Models\Admin\Master\Labinvestigation;
use App\Models\Admin\Master\Physicalandgeneralexamination;
use App\Models\Admin\Patients\Vital;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VitalController extends Controller
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
    public function index(DataTables $datatables)
    {
        if (request()->ajax()) {
            $vital = Vital::with('village')
                ->select(array('id', 'uniqid', 'name', 'enrollment_id', 'phone', 'village_id', 'token_id', 'created_by', 'created_at'))
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
                    <a href="vital/' . $vital->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                   </td>';
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/patient/vital/index');
    }

    public function show(vital $vital)
    {
        return view('/admin/patient/vital/show', compact('vital'));
    }

    public function ajaxvitalsmultiselectvital()
    {
        $allergy = Allergy::where('active', true)->get();
        $allergyoption = '<option value="">SELECT ALLERGY</option>';
        foreach ($allergy as $row) {
            $allergyoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        $illness = Illness::where('active', true)->get();
        $illnessoption = '<option value="">SELECT ILLNESS</option>';
        foreach ($illness as $row) {
            $illnessoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $data = [
            'allergy' => $allergyoption,
            'illness' => $illnessoption,
        ];

        echo json_encode($data);
    }

    public function ajaxvitalsmultiselectdoctor()
    {

        $allergy = Allergy::where('active', true)->get();
        $allergyoption = '<option value="">SELECT ALLERGY</option>';
        foreach ($allergy as $row) {
            $allergyoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        $illness = Illness::where('active', true)->get();
        $illnessoption = '<option value="">SELECT ILLNESS</option>';
        foreach ($illness as $row) {
            $illnessoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }



        $physicalandgeneralexamination = Physicalandgeneralexamination::where('active', true)->get();
        $physicalandgeneralexaminationoption = '<option value="">SELECT PHYSICAL & GENERAL</option>';
        foreach ($physicalandgeneralexamination as $row) {
            $physicalandgeneralexaminationoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $diagnosis = Diagnosis::where('active', true)->get();
        $diagnosisoption = '<option value="">SELECT DIAGNOSIS</option>';
        foreach ($diagnosis as $row) {
            $diagnosisoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $labinvestigation = Labinvestigation::where('active', true)->get();
        $labinvestigationoption = '<option value="">SELECT LAB INVESTIGATION</option>';
        foreach ($labinvestigation as $row) {
            $labinvestigationoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $data = [
            'physicalandgeneralexaminationoption' => $physicalandgeneralexaminationoption,
            'diagnosisoption' => $diagnosisoption,
            'labinvestigationoption' => $labinvestigationoption,
            'allergyoption' => $allergyoption,
            'illnessoption' => $illnessoption,
        ];

        echo json_encode($data);
    }

}
