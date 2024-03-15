<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Admin\Miscellaneous\tracking;
use App\Models\Admin\Settings\color;
use App\Models\Admin\Settings\configuration;
use Auth;
use DB;
use File;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuration = configuration::where('uuid', '88fc5a4d-8283-478b-aba2-8queens')->first();
        $themecolor = color::where('type', 'bg')->pluck('color', 'color')->all();
        $textcolor = color::where('type', 'text')->pluck('color', 'color')->all();
        return view('/admin/settings/configuration/createOrUpdate', compact('configuration', 'themecolor', 'textcolor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //     return $request->all();
        try {
            $validation = $this->validate($request, [
                'company_name' => 'required',
                'company_full_name' => 'required',
                // 'address_one'       => 'required',
                // 'address_two'       => 'required',
                // 'address_three'     => 'nullable',
                // 'phone'             => 'required',
                // 'landline'          => 'required',
                // 'email'             => 'required',
                'website' => 'required',

                // 'bank_name'         => 'required',
                // 'account_number'    => 'required',
                // 'ifsc_code'         => 'required',
                // 'branch'            => 'required',

                'theme_color' => 'required',
                'background_color' => 'required',
                'text_color' => 'required',

                'headerbg_color' => 'required',
                'headertext_color' => 'required',
                'footerbg_color' => 'required',
                'footertext_color' => 'required',
                // 'blogtemplates' => 'nullable',

                "email_from_name" => 'nullable',
                "email_from_mail" => 'nullable',
                "email_mail_driver" => 'nullable',
                "email_mail_host" => 'nullable',
                "email_mail_port" => 'nullable',
                "email_mail_username" => 'nullable',
                "email_mail_password" => 'nullable',
                "email_mail_encryption" => 'nullable',

                // 'facebook' => 'nullable',
                // 'twitter' => 'nullable',
                // 'instagram' => 'nullable',
                // 'linkedin' => 'nullable',
                // 'youtube' => 'nullable',

                // 'keyword' => 'nullable',
                // 'description' => 'nullable',

                'recaptchasecretstatus' => 'nullable',
                'recaptchasecretkey' => 'nullable',
                'recaptchasitekey' => 'nullable',

                // 'mailchimpflag' => 'nullable',
                // 'mailchimpapikey' => 'nullable',
                // 'mailchimplistid' => 'nullable',
                // 'disqusflag' => 'nullable',
                // 'disquscode' => 'nullable',

                // 'googleanalyticsapi' => 'nullable',
                // 'googleanalyticscode' => 'nullable',

                // 'googleadsverticalcode' => 'nullable',
                // 'googleadshorizontalcode' => 'nullable',

                // 'socialmediaicon' => 'nullable',

                // 'searchstatus' => 'nullable',
                // 'algoliaapp' => 'nullable',
                // 'algoliasecret' => 'nullable',

                'copyrights' => 'nullable',
                'timezone' => 'nullable',
                'dateformate' => 'nullable',

                'remarks' => 'nullable',

            ]);

            if ($request->file('uplode_logo_image')) {
                $this->validate($request, [
                    'uplode_logo_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                $configuration = configuration::where('uuid', '88fc5a4d-8283-478b-aba2-8queens')->first();
                if ($configuration->uplode_logo_image) {
                    $usersImage = public_path("image/{$configuration->uplode_logo_image}");

                    if (File::exists($usersImage)) {
                        unlink($usersImage);
                    }
                }

                $getimageName = time() . '.' . $request->uplode_logo_image->getClientOriginalExtension();
                $request->uplode_logo_image->move(public_path('image'), $getimageName);
                $validation['uplode_logo_image'] = $getimageName;
            }

            if ($request->file('favicon_image')) {
                $this->validate($request, [
                    'favicon_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                $configuration = configuration::where('uuid', '88fc5a4d-8283-478b-aba2-8queens')->first();
                if ($configuration->favicon_image) {
                    $usersImage = public_path("image/{$configuration->favicon_image}");

                    if (File::exists($usersImage)) {
                        unlink($usersImage);
                    }
                }

                $digitalgetimageName = time() . '.' . $request->favicon_image->getClientOriginalExtension();
                $request->favicon_image->move(public_path('image'), $digitalgetimageName);
                $validation['favicon_image'] = $digitalgetimageName;
            }

            DB::beginTransaction();

            if (!empty($request['id'])) {
                configuration::where('id', $request['id'])->update($validation);
                $message = ' Updated Existing Configuration ';
            } else {
                configuration::create($insertData);
                $message = ' New Configuration Details Added ';
            }
            tracking::create(['details' => $message,
                'name' => Auth::user()->name,
                'user_id' => Auth::user()->id,
                'uuid' => Auth::user()->uuid,
                'panal' => 'ADMIN',
            ]);
            toast($request['name'] . '' . $message, 'success', 'top-right')->persistent("Close");
            DB::commit();
            return redirect()->route('configuration.index'); //->with('success', $request['name'] .''.$message);
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

}
