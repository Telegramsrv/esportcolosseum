<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Page\SavePage;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
	public function index() {
		$pages = Page::all();
		return view("admin.page.index", compact('pages'));
	}
	
	public function add() {
		return view("admin.page.add");
	}
	
	public function save(SavePage $request){
		$input = $request->all();
		$page = new Page($input);
		$page->save();
 		$request->session()->flash('alert-success', 'Page added successfully.');
 		return redirect()->route('admin.page.list');
	}
	
	public function edit($pageId) {
		$page = Page::findOrFail($pageId);
		return view("admin.page.edit", compact('page'));
	}
	
	public function update(SavePage $request, $pageId){
		$page = Page::findOrFail($pageId);
		$input = $request->all();
		$page->update($input);
		$request->session()->flash('alert-success', 'Page updated successfully.');
		return redirect()->route('admin.page.list');
	}
	
	public function delete(SavePage $request, $pageId) {
		$page = Page::findOrFail($pageId);
		$page->delete();
		$request->session()->flash('alert-success', 'Page deleted successfully.');
		return redirect()->route('admin.page.list');
	}
}
