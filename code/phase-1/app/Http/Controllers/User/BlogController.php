<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    
    public function index(){
    	dd("Listing goes here!!");
    }

    public function detail(Blog $blog){
    	return view("user.blog.detail")->with(['blog' => $blog]);
    }
}
