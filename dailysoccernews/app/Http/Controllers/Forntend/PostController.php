<?php

namespace App\Http\Controllers\Forntend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use App\Category;
class PostController extends Controller
{
    public function details($slug){
    	$post=Post::where('slug',$slug)->first();
    	$blog_key='blog_'.$post->id;
    	if(!\Session::has($blog_key)){
    		$post->increment('view_count');
    		\Session::put($blog_key,1);
    	}

    	$tags=Tag::latest()->get();
        $admin=User::where('id',1)->first();
        $categories=Category::latest()->get();
    	$post_random = Post::inRandomOrder()->where('slug', '!=', $slug)->where('status',true)->where('is_approved',true)->limit(3)->get();
        //dd($post->comments);
        
    	return view('frontend.post-details',compact('post','post_random','tags','categories','admin'));

    }
    // show post category wise
    public function category_posts($slug){
        
        $category=Category::where('slug',$slug)->first();
        $admin=User::where('id',1)->first();
         $categories=Category::latest()->get();
        $category_posts=Category::where('slug',$slug)->first()->posts->where('is_approved', true)->where('status', true);
        return view('frontend.category',compact('category_posts','category','categories','admin'));
    }
    // show post tag wise
    public function tag_posts($slug){
        
        $tag=Tag::where('slug',$slug)->first();
        $admin=User::where('id',1)->first();
        $categories=Category::latest()->get();
        $tag_posts=Tag::where('slug',$slug)->first()->posts->where('is_approved', true)->where('status', true);
        return view('frontend.tag',compact('tag_posts','tag','categories','admin'));
    }

    
}
