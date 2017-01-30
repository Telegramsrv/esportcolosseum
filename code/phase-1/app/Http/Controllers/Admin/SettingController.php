<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Setting\SaveSetting;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
	public function view() {
		$setting = Setting::all();
		dd($setting);
		return view("admin.setting.view", compact('setting'));
	}
	
	public function update(SaveSetting $request){
		$setting = Setting::findOrFail(1);
		$input = $request->all();
		$setting->update($input);
		$request->session()->flash('alert-success', 'Settings updated successfully.');
		return redirect()->route('admin.setting.view');
	}
}
