<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
	public function index() {
		$users = User::all();
		return view("admin.user.index", compact('users'));
	}
	
	public function edit($userId) {
		$user = User::findOrFail($userId);
		return view("admin.user.edit", compact('user'));
	}
}
