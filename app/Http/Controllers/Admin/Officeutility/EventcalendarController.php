<?php

namespace App\Http\Controllers\Admin\Officeutility;

use App\Http\Controllers\Controller;
use App\Models\Admin\Miscellaneous\helper;
use App\Models\Admin\Miscellaneous\tracking;
use App\Models\Admin\Officeutility\Eventcalendar;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EventcalendarController extends Controller
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
            $eventcalendar = Eventcalendar::select(array('id', 'uniqid', 'title', 'start', 'end', 'created_by', 'created_at'));
            return DataTables::of($eventcalendar)
                ->addColumn('action', function ($eventcalendar) {
                    return '<td class="text-right">
                    <a href="eventcalendar/' . $eventcalendar->id . '" class="shadow rounded bg-green-500 hover:bg-green-600 p-2"><i class="fa text-white fa-eye"></i></a>
                    <a href="eventcalendar/' . $eventcalendar->id . '/edit" class="shadow rounded bg-blue-500 hover:bg-blue-600 p-2"><i class="fa text-white fa-edit"></i></a>
                   </td>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/officeutility/eventcalendar/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Eventcalendar $eventcalendar)
    {
        return view('/admin/officeutility/eventcalendar/createOrUpdate', compact('eventcalendar'));
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
                'title' => 'required|max:75',
                'start' => 'required',
                'end' => 'required',
                'remarks' => 'required|max:255',
            ]);

            $this->createorupdate($validation, $request);

            DB::commit();
            return redirect()->route('eventcalendar.index');

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
        $validation['start'] = Carbon::createFromFormat('d/m/Y H:i:s', $request['start'] . " 00:00:00");
        $validation['end'] = Carbon::createFromFormat('d/m/Y H:i:s', $request['end'] . " 23:59:59");
        $validation['type'] = 'MANUAL';
        $validation['color'] = 'purple';
        $validation['active'] = 1;
        $validation['user_id'] = Auth::user()->id;
        $validation['created_by'] = Auth::user()->name;

        if (!empty($request['id'])) {
            $validation['updated_id'] = Auth::user()->id;
            $validation['updated_by'] = Auth::user()->name;
            $validation['url'] = '/admin/eventcalendar/' . $request['uniqid'];
            Eventcalendar::where('id', $request['id'])->update($validation);
            toast('eventcalendar/Meeting Updated successfully', 'success', 'top-right');
            $trackStatus = $request['uniqid'] . ' Updated Existing eventcalendar/Meeting';
        } else {
            $uniqueId = helper::getNextSequenceId(5, 'EC', 'App\Models\Admin\Officeutility\Eventcalendar');
            $validation['sys_id'] = md5(uniqid(rand(), true));
            $validation['uniqid'] = $uniqueId['uniqid'];
            $validation['sequence_id'] = $uniqueId['sequence_id'];
            $validation['url'] = '/admin/eventcalendar/' . $validation['uniqid'];
            Eventcalendar::create($validation);
            toast('New eventcalendar/Meeting Created Successfully', 'success', 'top-right');
            $trackStatus = $validation['uniqid'] . ' Created New eventcalendar/Meeting';
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
     * @param  \App\Admin\Model\/updates\eventcalendaregory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (strpos($id, 'APP') !== false) { // Nagivate from calander
            $eventcalendar = Eventcalendar::where('uniqid', $id)->first();
        } else {
            $eventcalendar = Eventcalendar::findOrFail($id);
        }
        return view('/admin/officeutility/eventcalendar/show', compact('eventcalendar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Model\/updates\eventcalendaregory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eventcalendar = Eventcalendar::findOrFail($id);
        $eventcalendar['start'] = Carbon::parse($eventcalendar['start'])->format('d/m/Y');
        $eventcalendar['end'] = Carbon::parse($eventcalendar['end'])->format('d/m/Y');
        return view('/admin/officeutility/eventcalendar/createOrUpdate', compact('eventcalendar'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Model\/updates\eventcalendaregory
     * @return \Illuminate\Http\Response
     */
    public function destroy(eventcalendar $eventcalendar)
    {
        // $eventcalendar->delete();
        // toast('Deleted Successfully', 'error', 'top-right');
        // return redirect()->route('eventcalendar.index');
    }
}
