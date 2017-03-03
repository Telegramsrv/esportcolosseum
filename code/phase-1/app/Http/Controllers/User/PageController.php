<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
	public function index($slug){
		$page = Page::where("slug", $slug)->firstOrFail();
		return view("user.page.index")->with(['page' => $page]);
	}
}
