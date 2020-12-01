<?php

namespace App\Http\Controllers\Forntend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Mailer; 

use \Mail;

use App\Category;
use App\User;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
       $admin=User::where('id',1)->first();
       $categories=Category::orderBY('name','ASC')->get();
        return view('frontend.contact',compact('categories','admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $this->validate(request(),[
            'email' => 'required',
            'message' => 'required|min:5',
            ]);
        $title = $request['name'];
        $subject= $request['subject']; 
        $email= $request['email']; 
        $content = $request['message'];

        \Mail::send('frontend.email-template.contact', ['title' => $title, 'content' => $content], function ($message)
        {
            $subject= "Contact Mail"; 
            $message->from('from@example.com', 'Laravel Blog Contact');            
            $message->subject($subject);
            $message->to('marufalbashir@gmail.com');
        
        });
        session()->flash('success-msg', 'Successfully Send Message');
        return redirect()->back();
    }

   
}
