@extends('admin-panel.admin-layout')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>TAGS</h2>
    </div>
    <div class="row clearfix">
         @if ($errors->any())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ implode('', $errors->all(':message')) }}
            </div>
         @endif
         @if(Session::has('msg'))
        <div class="alert bg-green alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{Session::get("msg")}}
        </div>
         @endif
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
            <div class="card">

                <div class="header">
                    <h2>
                        ADD NEW USER
                    </h2> 
                     
                </div>
            
                <div class="body">
                   
                  <form action="{{url('admin/user/store')}}"  method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group form-float">
                            <div class="form-line col-lg-6">
                                <input type="text" id="user_name" name="name" class="form-control"  value="{{ old('name') }}" required>
                                <label class="form-label">User Name</label>
                            </div>
                            <div class="form-line col-lg-6">
                                <input type="text" id="user_email" name="email" class="form-control" required value="{{ old('email') }}">
                                <label class="form-label">User Email</label>
                            </div>
                            <div class="form-line col-lg-6">
                                <input type="password" id="user_password" name="password" class="form-control" required value="{{old('password')}}">
                                <label class="form-label">Password</label>
                            </div>
                            <div class="form-line col-lg-6">
                                <input type="password" id="user_password" name="confirm_password" class="form-control" required>
                                <label class="form-label">Confirm Password</label>
                            </div>
                            <div class="form-line col-lg-6">
                                <textarea name="about" class="form-control">{{old('about')}}</textarea>
                                <label class="form-label">About User</label>
                            </div>
                            <div class="form-0">                               
                                <label for="post_categories">Select Role</label>
                                
                                <select name="user_role" id="user" class="select">
                                    <option value="0">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>                             
                            </div>
                             <br/>
                            <label class="form-label" for="image">User Image</label>
                             <div class="form-line col-lg-6">
                                <input type="file" id="image" name="image" value="{{old('image')}}" class="form-control">    
                            </div>
                            
                        </div>
                        <input type="submit" name="" class="btn btn-primary m-t-15 waves-effect" value="SAVE">
                        <button type="reset" class="btn btn-danger m-t-15 waves-effect">REFRESH</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
