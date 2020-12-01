<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=  \Auth::user()->id;
        $user=User::find($user_id);
        //($user_id);
        return view('author-panel.profile',compact('user'));
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
    public function edit()
    {
        $user_id=  \Auth::user()->id;
        $user=User::find($user_id);
        //($user_id);
        return view('author-panel.profile-edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $this->validate(request(),[
            'name' => 'required|min:4|max:50',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'email' => 'required|unique:users,email,.($id)',
            
            //'new_password' => 'min:6|max:20',
            'email' => 'required',
            ]);
        $user_id=  \Auth::user()->id;
        $user=User::find($user_id);
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->username=str_slug($request['name']);
        $user->role_id= $request['user_role'];
        $user->remember_token=($request['_token']);
        $user->about= $request['about'];
        // IMAGE
        if($request->image !=''){
                $destinationPath =   public_path('/images/users');
                $file = $request->image;
                $ext = $request->image->getClientOriginalExtension();
                $fileName =  $user->username.'.'.$ext;
                if(file_exists($destinationPath.'/'.$fileName)){
                    @unlink($destinationPath.'/'.$fileName);
                }
                $file->move($destinationPath, $fileName);
                $user->image = $fileName;
            }
        // image
        $request_password=bcrypt($request['password']);
        //bcrypt($request['password']);
        if($request_password==true){
            $user->password=$request_password; // does not working
            
        }
        $user->role_id=2;
        $user->update();
        session()->flash('msg', 'Successfully Update Profile');
        return redirect(url('author/profile'));
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
