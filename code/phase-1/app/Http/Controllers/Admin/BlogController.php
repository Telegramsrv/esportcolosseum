<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Blog\SaveBlog;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Blog;
use Illuminate\Support\Facades\Hash;

class BlogController extends Controller
{
	public function index() {
		$blogs = Blog::with('user')->get();
		return view("admin.blog.index", compact('blogs'));
	}
	
	public function add() {
		return view("admin.blog.add");
	}
	
	public function save(SaveBlog $request){
		$input = $request->all();
		
		//save 	display_image
		if(!empty($request->hasFile('display_image'))){
			$input['display_image'] = saveMedia($request->file('display_image'), 'UPLOAD_BLOG_THUMBNAIL');
		}
		//save	banner_image
		if(!empty($request->hasFile('banner_image'))){
			$input['banner_image'] = saveMedia($request->file('banner_image'), 'UPLOAD_BLOG_BANNER');
		}
		
		$user = Auth::user();
		$user->blogs()->save(new Blog($input));
 		$request->session()->flash('alert-success', 'Blog added successfully.');
 		return redirect()->route('admin.blog.list');
	}
	
	public function edit($blogId) {
		$blog = Blog::findOrFail($blogId);
		return view("admin.blog.edit", compact('blog'));
	}
	
	public function update(SaveBlog $request, $blogId){
		$blog = Blog::findOrFail($blogId);
		$input = $request->all();
		//update display_image
		if(!empty($request->hasFile('display_image'))){
			if(!empty($blog->display_image)){
				removeMedia($blog->display_image, 'UPLOAD_BLOG_THUMBNAIL');
			}
			$input['display_image'] = saveMedia($request->file('display_image'), 'UPLOAD_BLOG_THUMBNAIL');
		}
		//update banner_image
		if(!empty($request->hasFile('banner_image'))){
			if(!empty($blog->banner_image)){
				removeMedia($blog->banner_image, 'UPLOAD_BLOG_BANNER');
			}
			$input['banner_image'] = saveMedia($request->file('banner_image'), 'UPLOAD_BLOG_BANNER');
		}
		$blog->update($input);
		$request->session()->flash('alert-success', 'Blog updated successfully.');
		return redirect()->route('admin.blog.list');
	}
	
	public function delete(SaveBlog $request, $blogId) {
		$blog = Blog::findOrFail($blogId);
		$blog->delete();
		return redirect()->route('admin.blog.list');
	}
	
}
