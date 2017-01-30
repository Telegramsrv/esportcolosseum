<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Setting\SaveSetting;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
	public function view() {
		$setting = Setting::first();
		if($setting === null){
			$options = array(
					'coins_per_dollar' => "10",
					'esc_challenge_interval_hrs' => "3"
			);
			$data['settings'] = json_encode($options);
			$setting = Setting::firstOrCreate($data);
		}
		
		$setting = json_decode($setting->settings);
		
		return view("admin.setting.view", compact('setting'));
	}
	
	public function update(SaveSetting $request){
		$setting = Setting::firstOrFail();
		$input = $request->all();
		$options = array(
						'coins_per_dollar' => $input['coins_per_dollar'], 
						'esc_challenge_interval_hrs' => $input['esc_challenge_interval_hrs']
					);
		$setting->settings = json_encode($options);
		$setting->save();
		
		$request->session()->flash('alert-success', 'Settings updated successfully.');
		return redirect()->route('admin.setting.view');
	}
}
