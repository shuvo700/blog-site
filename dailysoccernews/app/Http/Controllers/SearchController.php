<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function query(Request $request)
    {
        $query= $request->input('query');
        $categories=Category::orderBy('name','ASC')->get();
        $posts= Post::where('title','LIKE',"%$query%")->where('is_approved',true)->where('status',true)->get();
        return view('frontend.search',compact('posts','query','categories'));
    }

    
}
