<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    
    public function index(){
    	$blogs = Blog::active()->orderBy("updated_at", 'desc')->paginate(env('BLOG_RECORDS_PER_PAGE', 12));

    	return view("user.blog.index")->with(['blogs' => $blogs]);
    }

    public function detail(Blog $blog){
    	return view("user.blog.detail")->with(['blog' => $blog]);
    }
}
