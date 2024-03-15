<?php

namespace App\Http\Controllers\Admin\Settings;

use DB;
use App;
use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin\Miscellaneous\helper;
use App\Models\Admin\Miscellaneous\tracking;

class AddemployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:addemployee-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:addemployee-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:addemployee-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables)
    {
        if (request()->ajax()) {
            $addemployee = User::where('email', '!=', 'preparenext@gmail.com')
                ->select(array('id', 'employee_id', 'name', 'status', 'phone', 'email', 'created_by', 'created_at'))
                ->latest();
            return DataTables::of($addemployee)
                ->editColumn('status', function ($addemployee) {
                    if ($addemployee->status == 1) {
                        return 'In Active';
                    }
                    if ($addemployee->status == 0) {
                        return 'Active';
                    }
                    return 'NA';
                })
                ->addIndexColumn()
                ->addColumn('action', function ($addemployee) {
                    return '<td class="text-right">
                   <a href="addemployee/' . $addemployee->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                   <a href="addemployee/' . $addemployee->id . '/edit" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>
                   </td>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/settings/addemployee/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $addemployee)
    {
        $role = Role::pluck('name', 'id')->all();
        return view('/admin/settings/addemployee/createorupdate', compact('addemployee'), ['roles' => $role]);
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
                'name' => 'required|max:35',
                'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
                'password' => 'required|string|min:8',
                'status' => 'required',
                'designation' => 'required',
                'employee_id' => 'nullable',
                'phone' => 'required|numeric|digits:10',
                'phone_two' => 'nullable|numeric|digits:10',
                'department' => 'required|max:30',
                'dob' => 'nullable',
                'address' => 'nullable|max:255',
                'remarks' => 'nullable|max:255',
                'doj' => 'nullable',
                'role_id' => 'nullable',
                'language' => 'nullable',

            ]);

          
            $validation['password'] = Hash::make($validation['password'] );

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('addemployee.index');

        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException$e) {
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

        // $validation['previous_company'] = $request['previous_company'];
        // $validation['experience'] = $request['experience'];
        // $validation['pan_no'] = $request['pan_no'];
        // $validation['dob'] = Carbon::createFromFormat('d/m/Y', $request['dob']);
        // $validation['doj'] = Carbon::createFromFormat('d/m/Y', $request['doj']);

        // if ($request->file('avatar')) {
        //     $this->validate($request, [
        //         'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        //     ]);
        //     $avatar = Auth::user()->avatar;
        //     if ($avatar) {
        //         $thumbnail = public_path("avatar/thumbnail/{$avatar}");
        //         $images = public_path("avatar/images/{$avatar}");

        //         if (File::exists($thumbnail)) {
        //             unlink($thumbnail);
        //             unlink($images);
        //         }
        //     }

        //     $originalImage = $request->file('avatar');
        //     $thumbnailImage = Image::make($originalImage);
        //     $thumbnailPath = public_path() . '/avatar/thumbnail/';
        //     $originalPath = public_path() . '/avatar/images/';
        //     $thumbnailImage->save($originalPath . time() . $originalImage->getClientOriginalName());
        //     $thumbnailImage->resize(150, 150);
        //     $thumbnailImage->save($thumbnailPath . time() . $originalImage->getClientOriginalName());
        //     $validation['avatar'] = time() . $originalImage->getClientOriginalName();

        // }

        if (!empty($request['id'])) {
            $validation['updated_id'] = Auth::user()->id;
            $validation['updated_by'] = Auth::user()->name;
            User::where('id', $request['id'])->update($validation);
            $user = User::find($request['id']);
            DB::table('model_has_roles')->where('model_id', $request['id'])->delete();
            $user->assignRole($request['role_id']);
            $user->save();
            toast('Employee Updated successfully', 'success', 'top-right');
            $trackStatus = $request['uniqid'] . ' Updated Existing Employee';
        } else {
            $uniqueId = helper::getNextSequenceId(5, 'EMP', 'App\Models\User');
            $validation['sys_id'] = md5(uniqid(rand(), true));
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['user_id'] = Auth::user()->id;
            $validation['created_by'] = Auth::user()->name;
            User::create($validation)->assignRole($request['role_id']);
            toast('New Employee Created Successfully', 'success', 'top-right');
            $trackStatus = $validation['uniqid'] . ' Created New Employee';
        }

        tracking::create(['details' => $trackStatus,
            'name' => Auth::user()->name,
            'user_id' => Auth::user()->id,
            'uuid' => Auth::user()->uuid,
            'panal' => 'ADMIN',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Model\/updates\addemployee
     * @return \Illuminate\Http\Response
     */
    public function show(User $addemployee)
    {
      
        $role = Role::where('id',$addemployee->role_id)->first();
        return view('/admin/settings/addemployee/profile', compact('addemployee','role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Model\/updates\addemployee
     * @return \Illuminate\Http\Response
     */
    public function edit(User $addemployee)
    {
        // return $addemployee;
        $addemployee->password = '';
        $role = Role::pluck('name', 'id')->all();
        return view('/admin/settings/addemployee/createorupdate', compact('addemployee'), ['roles' => $role]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Model\/updates\addemployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $user->delete();
        // toast('Deleted Successfully', 'error', 'top-right');
        // return redirect()->route('addemployee.index');
    }

    public function profile()
    {
        $addemployee = User::findOrFail(Auth::user()->id);
      
        return view('/admin/settings/addemployee/profile', compact('addemployee'));
    }

    public function changepasswordform()
    {
        return view('/admin/settings/addemployee/changepassword');
    }
    public function changepassword(Request $request)
    {
        try {
            $validator = $this->validate($request, [
                'current-password' => 'required',
                'password' => 'required|confirmed|min:8',
                
            ]);
            if (Hash::check($request['current-password'], Auth::user()->password)) {
                $user_id = Auth::user()->id;
                $obj_user = User::find($user_id);
                $obj_user->password = Hash::make($request['password']);
                $obj_user->save();
                alert()->success('SUCCESS', 'Password Changed Successfully');
                return redirect()->back();
            } else {
                toast('Invalid Current Password', 'error', 'top-right')->persistent("Close");
                return redirect()->back();
            }

        } catch (Exception $e) {
            return $e;
        }

    }

    public function switchlanguage()
    {
        User::find(Auth::user()->id)->update(['language' => request()->language]);
        toast('Language switched successfully', 'success', 'top-right');
        return redirect()->back();
    }
}
