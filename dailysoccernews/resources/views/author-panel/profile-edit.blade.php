@extends('admin-panel.admin-layout')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>User</h2>
    </div>
    <div class="row clearfix">
         @if ($errors->any())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ implode('', $errors->all(':message')) }}
            </div>
         @endif
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
            <div class="card">

                <div class="header">
                    <h2>
                        Update User Account
                    </h2> 
                     
                </div>
            
                <div class="body">
                   
                  <form action="{{url('author/profile/update')}}"  method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group form-float">
                            <div class="form-line col-lg-6">
                                <input type="text" id="user_name" name="name" class="form-control"  value="{{ $user->name }}" required>
                                <label class="form-label">User Name</label>
                            </div>
                            <div class="form-line col-lg-6">
                                <input type="text" id="user_email" name="email" class="form-control" required value="{{ $user->email }}">
                                <label class="form-label">User Email</label>
                            </div>
                            
                            <div class="form-line col-lg-6">
                                <input type="password" id="new_password" name="new_password" class="form-control">
                                <label class="form-label">New Password</label>
                            </div>
                            <div class="form-line col-lg-6">
                                <textarea name="about" class="form-control">{{$user->about}}</textarea>
                                <label class="form-label">About User</label>
                            </div>
                           
                            <br/>
                            <label class="form-label" for="image">User Image</label>
                             <div class="form-line col-lg-6">
                                <input type="file" id="image" name="image" class="form-control">
                                
                            </div>
                        </div>
                        <input type="submit" name="" class="btn btn-primary m-t-15 waves-effect" value="UPDATE">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
