<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Comment;
class CommentController extends Controller
{
    public function store(Request $request){
    // 	 $this->validate(request(),[
    //         'comment' => 'required|min:5|regex:/([A-Za-z0-9 ])+/',
    //         ]);
    	$comment= new Comment;
    	$comment->user_id=\Auth::user()->id;
    	$comment->post_id= $request->id;
    	$comment->comment= $request['comment'];
    	
    	$comment->save();
    	session()->flash('msg', 'Successfully Commented On This Post');
        return redirect()->back();
    }
}
