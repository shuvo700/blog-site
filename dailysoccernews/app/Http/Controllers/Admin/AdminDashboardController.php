<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use Carbon\Carbon;
class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $posts= Post::all();
        $total_pending_post= Post::where('is_approved',false)->count();
        $popular_posts= Post::withCount('comments')
                        ->withCount('favorite_to_user')
                        ->orderBy('comments_count','desc')
                        ->orderBy('favorite_to_user_count','desc')
                        ->orderBy('view_count','desc')
                        ->take(5)
                        ->get();
        $total_author= User::where('role_id',2)->count();
        $active_author= User::where('role_id',2)
                        ->withCount('posts')
                        ->withCount('comments')
                        ->withCount('favorite_post')
                        ->orderBy('comments_count','desc')
                        ->orderBy('favorite_post_count','desc')
                        //->orderBy('view_count','desc')
                        ->take(5)
                        ->get();
        $total_category= Category::all()->count();
        $total_tag= Tag::all()->count();
        $todays_authors= User::where('role_id',2)
                        ->whereDate('created_at',Carbon::today())->count();

        return view('admin-panel.dashboard',compact('posts','total_pending_post','popular_posts','total_category','total_tag','total_author','active_author','todays_authors'));
    }
public function logout() {
    //logout user
    auth()->logout();
    // redirect to homepage
    return redirect('/');
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
