<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WithdrawFundRequest;

class WithdrawFundController extends Controller
{
	public function index() {
		$withdrawFundRequests = WithdrawFundRequest::with("user")->get();
		return view("admin.withdraw-fund.index", compact('withdrawFundRequests'));
	}
	
	public function view($requestID) {
		$withdrawFundRequest = WithdrawFundRequest::findOrFail($requestID);
		return view("admin.withdraw-fund.view", compact('withdrawFundRequest'));
	}
	
	public function update($requestID, Request $request) {
		$withdrawFundRequest = WithdrawFundRequest::findOrFail($requestID);
		$input = $request->all();
		$withdrawFundRequest->status = $input['status'];
		$withdrawFundRequest->update();
		$request->session()->flash('alert-success', 'Withdraw Fund Request updated successfully.');
		return redirect()->route('admin.withdraw-fund.list');
	}
	
	public function bankDetails($requestID) {
		dd($requestID);
		$withdrawFundRequest = WithdrawFundRequest::findOrFail($requestID);
		
		if($withdrawFundRequest->user->userDetails->account_no != ''){
			$bankData['account_no'] = decrypt($withdrawFundRequest->user->userDetails->account_no);
		}
		if($withdrawFundRequest->user->userDetails->account_name != ''){
			$bankData['account_name'] = decrypt($withdrawFundRequest->user->userDetails->account_name);
		}
		if($withdrawFundRequest->user->userDetails->account_swift_code != ''){
			$bankData['account_swift_code'] = decrypt($withdrawFundRequest->user->userDetails->account_swift_code);
		}
		if($withdrawFundRequest->user->userDetails->paypal_id != ''){
			$bankData['paypal_id'] = decrypt($withdrawFundRequest->user->userDetails->paypal_id);
		}
		
		$bankData['email'] = $withdrawFundRequest->user->email;
		$bankData['full_name'] = $withdrawFundRequest->user->userDetails->first_name." ".$withdrawFundRequest->user->userDetails->last_name;
		$bankData['mobile_number'] = $withdrawFundRequest->user->userDetails->mobile_number;
		
		$bankData = (object) $bankData;
		
		return view("admin.withdraw-fund.bank-details", compact('bankData'));
	}
	
}
