<?php

namespace App\Http\Controllers\Forntend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Tag;
use App\Category;

class PostsController extends Controller
{
    public function posts(){
    	$posts=Post::where('status',true)->where('is_approved',true)->latest()->paginate(4);
    	$admin=User::where('id',1)->first();
    	$tags=Tag::orderBY('name','ASC')->get();
    	$categories=Category::orderBY('name','ASC')->get();
    	return view('frontend.blog',compact('posts','admin','tags','categories'));
    }
}
