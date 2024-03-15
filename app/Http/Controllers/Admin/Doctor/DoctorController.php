<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Admin\Master\Diagnosis;
use App\Models\Admin\Master\Drug;
use App\Models\Admin\Master\Labinvestigation;
use App\Models\Admin\Patients\Doctorprescription;
use App\Models\Admin\Patients\Labreport;
use App\Models\Admin\Patients\Vital;
use App\Models\Admin\Pharmacy\Pharmacyoutward;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DoctorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:patientdoctor-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patientdoctor-edit', ['only' => ['edit', 'create']]);
        $this->middleware('permission:patientdoctor-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function patientlist(DataTables $datatables)
    {
        if (request()->ajax()) {
            $vital = Vital::select(array('id', 'uniqid', 'name', 'enrollment_id', 'phone', 'token_id', 'created_by', 'created_at', 'is_doctor'))
                ->whereDate('created_at', Carbon::today())
                // ->orderBy('is_doctor', 'asc')
                ->orderBy('created_at', 'desc');
            return DataTables::of($vital)
                ->addIndexColumn()
                ->setRowClass(function ($vital) {
                    return ($vital->is_doctor) ? 'text-green-600' : 'text-red-500';
                })
                ->editColumn('created_at', function ($vital) {
                    return $vital->created_at->format('d/m/Y H:i:s');
                })
                ->editColumn('created_at', function ($vital) {
                    return $vital->created_at->format('d/m/Y H:i:s');
                })
                ->editColumn('diagnosis', function ($vital) {
                    return $vital->diagnosis->pluck('name')->implode(', ');
                })
                ->addColumn('action', function ($vital) {
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('patientdoctor-show')) {
                        $action .= '<a href="patientlistshow/' . $vital->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('patientdoctor-edit')) {
                        $action .= '<a href="patientprescriptionform/' . $vital->id . '" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }
                    $action .= ' </td>';
                    return $action;
                })
                ->rawColumns(['action', 'created_at', 'diagnosis'])
                ->make(true);
        }
        return view('admin/doctor/todaypatientlist/index');
    }

    public function patientprescriptionform(Vital $vital)
    {
        $doctorprescription = Doctorprescription::where('vital_id', '=', $vital->id)->get();
        $status = ($doctorprescription->count() > 0) ? 1 : 0;
        return view('admin/doctor/todaypatientlist/patientprescriptionform', compact('vital', 'doctorprescription', 'status'));
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $validation = $this->validate($request, [
                'nextvisit' => 'nullable',
                'referral' => 'nullable',
                'doctorremark' => 'nullable',
                'morbidity' => 'nullable',

                   //Vitals
                   'temperature' => 'nullable',
                   'bloodpressure' => 'nullable',
                   'height' => 'nullable',
                   'weight' => 'nullable',
                   'pulserate' => 'nullable',
                   'respiratoryrate' => 'nullable',
                   'spo_two' => 'nullable',
                   'painscaleone' => 'nullable|numeric',
                   'painscaletwo' => 'nullable|numeric',
                   'location' => 'nullable',
                   'character' => 'nullable',

                   'diagnosis_note'=>'nullable',
                   'laboratory_note'=>'nullable',
                   'prescription_note'=>'nullable',

                   'illness_note'=>'nullable',
                   'allergy_note'=>'nullable'


            ]);

            $vital = Vital::find($request['id']);

            if ($vital->is_labarotaryattended || $vital->is_pharmacyattended) {
                DB::rollback();
                toast('Once Lab Report or Pharmacy proccess intiated, Unable to Edit the Record', 'error', 'top-right')->persistent("Close");
                return redirect()->route('patientlist.index');
            }

            $vital->nextvisit = $request->nextvisit;
            $vital->referral = $request->referral;
            $vital->doctorremark = $request->doctorremark;
            $vital->morbidity = $request->morbidity;
            $vital->temperature = $request->temperature;
            $vital->bloodpressure = $request->bloodpressure;
            $vital->height = $request->height;
            $vital->weight = $request->weight;
            $vital->respiratoryrate = $request->respiratoryrate;
            $vital->spo_two = $request->spo_two;
            $vital->painscaletwo = $request->painscaletwo;
            $vital->painscaleone = $request->painscaleone;
            $vital->location = $request->location;
            $vital->character = $request->character;
            $vital->pulserate = $request->pulserate;
            $vital->diagnosis_note = $request->diagnosis_note;
            $vital->laboratory_note = $request->laboratory_note;
            $vital->prescription_note = $request->prescription_note;
            $vital->illness_note = $request->illness_note;
            $vital->allergy_note = $request->allergy_note;
            $vital->alcohol = request()->has('alcohol');
            $vital->tobacco = request()->has('tobacco');
            $vital->smoking = request()->has('smoking');
            $vital->others = $request->others;



            if (!$vital->is_doctor) {
                $vital->is_doctor = Carbon::now();
            }


       
            $vital->allergy()->sync($request->allergy_select);
            
            $vital->illness()->sync($request->illness_select);

            $vital->physicalandgeneralexamination()->sync($request->physicalandgeneralexamination_select);
            $vital->diagnosis()->sync($request->diagnosis_select);
            $vital->labinvestigation()->sync($request->labinvestigation_select);

            if (!is_null($request->drug_id)) {
                $vital->is_pharmacy = Carbon::now();
                $vital->pharmacystatus = 0;
                $data = $this->doctorprescriptiondata($request);
                Doctorprescription::where('vital_id', '=', $request['id'])->delete();
                Doctorprescription::insert($data);
            } else {
                $vital->is_pharmacy = null;
                Doctorprescription::where('vital_id', '=', $request['id'])->delete();
            }

            if ($request->labinvestigation_select) {
                $vital->is_labarotary = Carbon::now();
                $vital->labarotarystatus = 0;
                $datatwo = $this->labreportdata($request);
                Labreport::where('vital_id', '=', $request['id'])->delete();
                Labreport::insert($datatwo);
            } else {
                $vital->is_labarotary = null;
                Labreport::where('vital_id', '=', $request['id'])->delete();
            }

            $vital->save();

            DB::commit();
            return redirect()->route('patientlist.index');

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

    public function labreportdata($request)
    {
        $insertDataTwo = array();
        if (!is_null($request->labinvestigation_select)) {
            foreach ($request->labinvestigation_select as $key => $value) {
                $labinvestigation = Labinvestigation::find($value);
                $insertDataTwo[] = [
                    'enrollment_id' => $request->enrollment_id,
                    'enrollment_uuid' => $request->enrollment_uuid,
                    'enrollment_uniqid' => $request->enrollment_uniqid,
                    'vital_id' => $request->id,
                    'vital_uuid' => $request->uuid,
                    'vital_uniqid' => $request->uniqid,

                    'name' => $labinvestigation->name,
                    'range' => $labinvestigation->range,
                    'active' => 1,
                ];
            }
        }

        return $insertDataTwo;
    }

    public function doctorprescriptiondata($request)
    {
        $insertDataOne = array();
        if (!is_null($request->drug_id)) {
            for ($i = 0; $i < sizeof($request->drug_id); $i++) {
                $insertDataOne[] = [

                    'enrollment_id' => $request->enrollment_id,
                    'enrollment_uuid' => $request->enrollment_uuid,
                    'enrollment_uniqid' => $request->enrollment_uniqid,
                    'vital_id' => $request->id,
                    'vital_uuid' => $request->uuid,
                    'vital_uniqid' => $request->uniqid,

                    'drug_id' => $request->drug_id[$i],
                    'drugname' => Drug::find($request->drug_id[$i])->name,
                    'morning' => ($request->morning && in_array($i, $request->morning)) ? 1 : 0,
                    'afternoon' => ($request->afternoon && in_array($i, $request->afternoon)) ? 1 : 0,
                    'evening' => ($request->evening && in_array($i, $request->evening)) ? 1 : 0,
                    'night' => ($request->night && in_array($i, $request->night)) ? 1 : 0,
                    'bf' => ($request->bf && in_array($i, $request->bf)) ? 1 : 0,
                    'af' => ($request->af && in_array($i, $request->af)) ? 1 : 0,
                    'count' => $request->count[$i],
                    'active' => 1,
                ];
            }
        }

        return $insertDataOne;
    }

    public function patienthistory(DataTables $datatables)
    {
        if (request()->ajax()) {
            $vital = Vital::select(array('id', 'uniqid', 'name', 'enrollment_id', 'is_doctor', 'phone', 'token_id', 'created_by', 'created_at'))
                ->orderby('created_at', 'desc');
            return DataTables::of($vital)
                ->setRowClass(function ($vital) {
                    return ($vital->is_doctor) ? 'text-green-600' : 'text-red-500';
                })
                ->editColumn('created_at', function ($vital) {
                    return $vital->created_at->format('d/m/Y H:i:s');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($vital) {
                    return '<td class="text-right">
                    <a href="patienthistoryshow/' . $vital->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                   </td>';
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return view('admin/doctor/patienthistory/index');
    }

    public function searchdruglist(Request $request)
    {
        $druglist = Drug::where('active', true)->select('id', 'name')->get();
        return response()
            ->json([
                'status' => true,
                'druglist' => $druglist,
            ]);
    }

    public function patienthistoryshow(Vital $vital)
    {
        $pharmacyoutward = Pharmacyoutward::where('vital_id', '=', $vital->id)->get();
        return view('/admin/doctor/patienthistory/show', compact('vital', 'pharmacyoutward'));
    }

    public function patientlistshow(Vital $vital)
    {
        $pharmacyoutward = Pharmacyoutward::where('vital_id', '=', $vital->id)->get();
        return view('/admin/doctor/todaypatientlist/show', compact('vital', 'pharmacyoutward'));
    }

    public function ajaxdrug(Request $request)
    {
        $diagnosisval = explode(",", $request->diagnosisval);
        $diagnosis = Diagnosis::where('active', true)
            ->whereIn('id', $diagnosisval)
            ->get();
      
       
        $drugname = '<h1 class="text-gray-800 text-lg font-semibold text-green-600">Drug Name:</h1>';
        $drugname .= '<div class="flex flex-wrap gap-5 p-2">';
        foreach ($diagnosis as $row) {
        if($row->drug->pluck('id')->implode(',') !=0)
        {
            $drugname .=
            '<div class="bg-green-200 py-2 rounded-md ">' .
            '<div>' . '<h2 class="text-base md:text-xl lg:text-xl px-2 whitespace-no-wrap  text-gray-600">' . $row->drug->pluck('name')->implode(',')
                . '</h2>'
                . '</div>' . '</div>';
        }
        }
        $drugname .= '</div>';
        
        $data = [
            'drugname' => $drugname,
        ];

        echo json_encode($data);

    }

}
