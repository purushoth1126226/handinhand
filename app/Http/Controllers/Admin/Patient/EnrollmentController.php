<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\Admin\Master\Village;
use App\Models\Admin\Miscellaneous\helper;
use App\Models\Admin\Patients\Enrollment;
use App\Models\Admin\Patients\Vital;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EnrollmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:patientenrollment-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patientenrollment-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patientenrollment-delete', ['only' => ['destroy']]);
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
                ->whereDate('created_at', Carbon::today())
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
                    $action = '<td class="text-right">';
                    if (auth()->user()->can('patientenrollment-show')) {
                        $action .= '<a href="enrollment/' . $vital->id . '" class="m-0.5 shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>';
                    }
                    if (auth()->user()->can('patientenrollment-edit')) {
                        $action .= '<a href="enrollment/' . $vital->id . '/edit" class="m-0.5 shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>';
                    }

                    $action .= ' </td>';
                    return $action;
                })
                ->addColumn('token', function ($vital) {
                    $token = '<td class="text-right">';
                    if (auth()->user()->can('patientenrollment-token')) {
                        $token .= '<a href="token/' . $vital->id . '" class="m-0.5 shadow rounded bg-yellow-500 hover:bg-yellow-600 p-2"><i class="text-white fa fa-address-card" aria-hidden="true"></i></a>';
                    }
                    $token .= ' </td>';
                    return $token;
                })

                ->rawColumns(['action', 'created_at', 'token'])
                ->make(true);
        }
        return view('admin/patient/enrollment/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Vital $vital)
    {
        $village = Village::orderBy('name')->where('active', true)->get();
        $doctor = [0 => 'Select Doctor'] + User::orderBy('name')->where('role_id', 1)->pluck('name', 'id')->all();
        return view('/admin/patient/enrollment/createorupdate', compact('vital', 'village', 'doctor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validation = $this->validate($request, [
                'enrollment_id' => 'nullable',
                'enrollment_uuid' => 'nullable',
                'enrollment_uniqid' => 'nullable',
                // Personal info
                'name' => 'required|max:50',
                'age' => 'nullable|numeric',
                'sexuality' => 'nullable',
                'fatherorhusband' => 'nullable',
                'phone' => 'nullable|numeric|digits:10',
                'village_id' => 'nullable|numeric|not_in:0',
                'dob' => 'nullable',
                'address' => 'nullable',
                'aadharorrational' => 'nullable',
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
                // Current Complaints
                'currentcomplaints' => 'nullable',
                // psychosocial History
                'alcohol' => 'nullable',
                'tobacco' => 'nullable',
                'smoking' => 'nullable',
                'others' => 'nullable',
                // Doctor
                'doctors_name' => 'nullable',
                'doctors_id' => 'nullable',
                'remarks' => 'nullable',
            ]);

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('enrollment.index');

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

    public function createorupdate($validation, $request)
    {

        $data['name'] = $request->name;
        $data['age'] = $request->age;
        $data['sexuality'] = $request->sexuality;
        $data['fatherorhusband'] = $request->fatherorhusband;
        $data['phone'] = $request->phone;
        $data['village_id'] = $request->village_id;
        $data['dob'] = $request->dob;
        $data['address'] = $request->address;
        $data['active'] = 1;
        $data['status'] = 1;
        $data['aadharorrational'] = $request->aadharorrational;

        if (!empty($request['enrollment_id'])) {
            $data['updated_id'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->name;
            Enrollment::where('id', $request['enrollment_id'])->update($data);
            $this->savevital([], $validation, $request);
            $trackStatus = $request['uniqid'] . ' Updated Existing Enrollment';
        } else {
            $uniqueId = helper::getNextSequenceId(7, 'EN', 'App\Models\Admin\Patients\Enrollment');
            $data['sys_id'] = md5(uniqid(rand(), true));
            $data['uniqid'] = $uniqueId['uniqid'];
            $data['sequence_id'] = $uniqueId['sequence_id'];
            $data['user_id'] = Auth::user()->id;
            $data['created_by'] = Auth::user()->name;
            $enrollment = Enrollment::create($data);
            $this->savevital($enrollment, $validation, $request);
            $trackStatus = $data['uniqid'] . ' Created New Enrollment';
        }

        helper::trackmessage($trackStatus, 'ADMIN');

    }

    public function savevital($enrollment, $validation, $request)
    {
        $validation['active'] = 1;
        $validation['status'] = 1;

        $validation['alcohol'] = request()->has('alcohol');
        $validation['tobacco'] = request()->has('tobacco');
        $validation['smoking'] = request()->has('smoking');

        if (!empty($request['id'])) {
            $validation['updated_id'] = Auth::user()->id;
            $validation['updated_by'] = Auth::user()->name;
            Vital::where('id', $request['id'])->update($validation);
            $vital = Vital::find($request['id']);
            $vital->allergy()->sync($request->allergy_select);
            $vital->illness()->sync($request->illness_select);
            toast('Vital Updated successfully', 'success', 'top-right');
            $vitaltrackStatus = $request['uniqid'] . ' Updated Existing Vital';
        } else {
            $uniqueId = helper::getNextSequenceIdVital(8, 3, 'PV', 'App\Models\Admin\Patients\Vital');

            $validation['sys_id'] = $uniqueId['sys_id'];
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['token_id'] = $uniqueId['token_id'];

            $validation['user_id'] = Auth::user()->id;
            $validation['created_by'] = Auth::user()->name;

            if ($request->enrollment_id) {
                $validation['enrollment_id'] = $request->enrollment_id;
                $validation['enrollment_uuid'] = $request->enrollment_uuid;
                $validation['enrollment_uniqid'] = $request->enrollment_uniqid;
            } else {
                $validation['enrollment_id'] = $enrollment->id;
                $validation['enrollment_uuid'] = $enrollment->uuid;
                $validation['enrollment_uniqid'] = $enrollment->uniqid;
            }

            $vital = Vital::create($validation);
            $vital->allergy()->attach($request->allergy_select);
            $vital->illness()->attach($request->illness_select);

            toast('New Vital Created Successfully', 'success', 'top-right');
            $vitaltrackStatus = $validation['uniqid'] . ' Created New Vital';
        }
        helper::trackmessage($vitaltrackStatus, 'ADMIN');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Model\/updates\vitalegory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vital = Vital::find($id);
        return view('/admin/patient/enrollment/show', compact('vital'));
    }

    public function token($id)
    {
        $vital = Vital::find($id);
        return view('/admin/patient/enrollment/token', compact('vital'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Model\/updates\vitalegory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vital = Vital::find($id);
        $village = Village::orderBy('name')->where('active', true)->get();
        $doctor = [0 => 'Select Doctor'] + User::orderBy('name')->where('role_id', 1)->pluck('name', 'id')->all();
        return view('/admin/patient/enrollment/createorupdate', compact('vital', 'village', 'doctor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Model\/updates\vital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vital $vital)
    {
        // $vital->delete();
        // toast('Deleted Successfully', 'error', 'top-right');
        // return redirect()->route('category.index');
    }

    public function patientsearch()
    {
        $search = request()->search;
        if ($search) {
            $search_arr = Enrollment::with('village')
                ->where("name", "LIKE", "%{$search}%")
                ->orwhere('phone', 'LIKE', "%{$search}%")
                ->orwhere('fatherorhusband', 'LIKE', "%{$search}%")
                ->orwhereHas('village', function (Builder $query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->select('id', 'name', 'phone', 'fatherorhusband', 'village_id')
                ->limit(10)
                ->get();

            echo json_encode($search_arr);
        } else {
            return Enrollment::find(request()->id);
        }
    }

}
