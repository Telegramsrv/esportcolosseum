<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    
    public function index(){
    	$blogs = Blog::orderBy("created_at", 'desc')->get();
    	return view("user.blog.index")->with(['blogs' => $blogs]);
    }

    public function detail(Blog $blog){
    	return view("user.blog.detail")->with(['blog' => $blog]);
    }
}
