<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('admin-panel.user',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('admin-panel.user-create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|min:4|max:50',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'email' => 'required|unique:users,email,.($id)',
            'password' => 'min:6|max:20',
            
            'email' => 'required',
            ]);
        $user=new User;
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->username=str_slug($request['name']);
       
        $user->role_id= $request['user_role'];
        $user->about= $request['about'];
        $user->password=bcrypt($request['password']);
        $user->remember_token=($request['_token']);
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
        $user->save();
        session()->flash('msg', 'Successfully Create User');
        return redirect()->back();
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
        $user=User::find($id);
        $roles=Role::all();
        return view('admin-panel.user-edit',compact('user','roles'));
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
       $this->validate(request(),[
            'name' => 'required|min:4|max:50',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'email' => 'required|unique:users,email,.($id)',
            
            //'new_password' => 'min:6|max:20',
            'email' => 'required',
            ]);
        $user=User::find($id);
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
        $user->update();
        session()->flash('msg', 'Successfully Update User');
        return redirect(url('/admin/user'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $user_post= $user->posts->find($id); // delete this user post
        $user->delete();
        return back()->with('msg', 'User Has Been Delete');
        //return redirect('ItemName')->with('msg', 'Item Has Been Delete');
    }
}
