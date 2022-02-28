<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SiteSetting;
use App\SocialSetting;
use App\Traits\imagesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    use imagesTrait;

    public function generalShow()
    {
        $site_settings =  SiteSetting::first();

        return view('admin.settings.site.index', compact('site_settings'));

    } // end of index

    public function generalUpdate(Request $request)
    {
        // return $request -> all();
        $site_settings = SiteSetting::findorFail(1);

        $request_data = $request->except(['_token', '_method', 'logo', 'favicon']);

        foreach ($request_data as $index => $item) {
            if($request_data[$index] == null){
                $request_data[$index] = $site_settings[$index];
            }
        }

        if($request->has('logo')){
            if ($site_settings -> logo != 'default.png') {
                Storage::disk('public_uploads')->delete('site/' . $site_settings -> logo);
            } // end of inner if
            $logoPath = $this->saveImages( $request -> logo , 'images/site');
            $request_data['logo']= $logoPath;
        }


        if($request->has('favicon')){
            if ($site_settings -> favicon != 'favicon.png') {
                Storage::disk('public_uploads')->delete('site/' . $site_settings -> favicon);
            } // end of inner if
            $faviconPath = $this->saveImages( $request -> favicon , 'images/site');
            $request_data['favicon'] = $faviconPath;
        }

        $site_settings->update($request_data);

        session()->flash('success', trans('validation.Updated Successfully'));
        return redirect()->route('settings.site.show');

    } // end of index

    public function socialShow()
    {
        $social_settings =  SocialSetting::all();

        return view('admin.settings.social.index', compact('social_settings'));

    } // end of index

    public function socialUpdate(Request $request)
    {
        $social_settings = SocialSetting::all();

        $request_data = $request -> except('_token', '_method');

        foreach ($social_settings as $social){

            $values = [];
            $setting_key = $social_settings -> where('key', $social -> key)-> first() -> key;

            $values += [
                'key' => $setting_key,
                'value' => $request_data[$setting_key],
            ];

            $social -> update($values);

        }  // end of foreach

        session()->flash('success', trans('validation.Updated Successfully'));
        return redirect()->route('settings.social.show');

    } // end of index

}
