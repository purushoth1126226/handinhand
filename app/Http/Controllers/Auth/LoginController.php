<?php

namespace App\Http\Controllers\Auth;

use Log;
use Auth;
use Exception;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Miscellaneous\tracking;
use App\Models\Admin\Miscellaneous\logininfo;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        try {
            if ($user->status == 1) {
                toast('Your account is disabled', 'error', 'top-right')->persistent("Close");
                Log::error('Deactivated User' . json_encode($user));
                Auth::logout();
                return redirect()->back();
            }

            $user->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp(),
            ]);

            session()->put('sidenavstatus', false);

            $this->deviceInfo($request, $user);

        } catch (Exception $e) {
            Auth::logout();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error one' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException$e) {
            Auth::logout();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error two' . $e->getMessage());
        } catch (PDOException $e) {
            Auth::logout();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error three' . $e->getMessage());
        }

    }

    public function logout(Request $request)
    {
        Log::info("User : " . Auth::user()->name . " Session ID :" . $request->session()->get('sessionid'));
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
    
    public function deviceInfo($request, $user)
    {
        try {
            $agent = new Agent();
            $insertData = array(
                'device' => $agent->device(),
                'robot' => $agent->robot(),
                'browser' => $agent->browser(),
                'browser_v' => $agent->version($agent->browser()),
                'platform' => $agent->platform(),
                'platform_v' => $agent->version($agent->platform()),
                'languages' => json_encode($agent->languages()),
                'serverIp' => $request->ip(),
                'clientIp' => $this->getIp(),
                'user_id' => $user->id,
                'user_name' => $user->name,
                'email' => $user->email,
            );
            $tracking = ' LOGGED PLATFORM. Device : ' . $agent->platform() . ', ' . $agent->browser();
            logininfo::create($insertData);
            $this->trackingInfo($tracking, $user->name, $user->id);

        } catch (Exception $e) {
            Auth::logout();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error one' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException$e) {
            Auth::logout();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error two' . $e->getMessage());
        } catch (PDOException $e) {
            Auth::logout();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error three' . $e->getMessage());
        }
    }

    public function trackingInfo($details, $name, $user_id)
    {
        try {
            $insertData = array(
                'details' => $details,
                'name' => $name,
                'user_id' => $user_id,
                'panal' => 'ADMIN',
            );

            tracking::create($insertData);
            toast('Hi ' . $name . ', !! You have logged in Successfully', 'success', 'top-right')
                ->persistent("Close");

        } catch (Exception $e) {
            Auth::logout();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error one' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException$e) {
            Auth::logout();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error two' . $e->getMessage());
        } catch (PDOException $e) {
            Auth::logout();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error three' . $e->getMessage());
        }
    }

    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }
}
