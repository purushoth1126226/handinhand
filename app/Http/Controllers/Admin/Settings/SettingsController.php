<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Admin\Miscellaneous\tracking;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/admin/settings/settings');
    }

    public function systeminfo()
    {
        return view('/admin/settings/systeminfo');
    }

    public function cacheclear()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        tracking::create(['details' => Auth::user()->name . ' System Cache Has Been Removed',
            'name' => Auth::user()->name,
            'user_id' => Auth::user()->id,
            'uuid' => Auth::user()->uuid,
            'panal' => 'ADMIN',
        ]);

        toast('System Cache Has Been Removed Successfully.', 'success', 'top-right')->persistent("Close");
        return redirect()->back();
    }

    public function backuprun()
    {
        try {
            $files = glob(storage_path('app/Laravel/*')); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file)) {
                    unlink($file); // delete file
                }
            }

            Artisan::call('backup:run', ['--only-db' => true]);

            tracking::create(['details' => Auth::user()->name . ' Backup Runned Successfully',
                'name' => Auth::user()->name,
                'user_id' => Auth::user()->id,
                'uuid' => Auth::user()->uuid,
                'panal' => 'ADMIN',
            ]);

            $files = glob(storage_path('app/Laravel/*')); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file)) {
                    toast('Backup Runned Successfully.', 'success', 'top-right')->persistent("Close");
                    return response()->download($file);
                }
            }
        } catch (Exception $e) {
            toast('ERROR backuprun 1: ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            toast('ERROR backuprun 2: ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (PDOException $e) {
            toast('ERROR backuprun 3: ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
    }
}
