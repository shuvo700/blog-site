@extends('admin-panel.admin-layout')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">     
        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
             @if(Session::has('msg'))
        <div class="alert bg-green alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{Session::get("msg")}}
        </div>
         @endif
            <div class="card">
                <div class="body">
                    <h4>{{$user->name}}</h4>
                    <p>
                        You are members from - {{$user->created_at}}
                    </p>
                    <hr/>
                    <p>
                        {{$user->about}}
                    </p>
                </div>
            </div>         
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="body">
                   <img src="{{asset('images/users')}}/{{$user->image}}" class="img img-responsive" alt="post-image">
                   
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <h4>Action</h4>
                    <div class="btn-inline">
                        <a href="{{url('author/profile/edit')}}" title="Back" class="btn btn-md btn-info">Edit Your Profile</a>
                        <a href="" title="Back" class="btn btn-md btn-warning">Back</a>
                       
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="body">
                   <h5>Total Post</h5>
                   <p>
                       {{$user->posts->count()}}
                   </p>
                </div>
            </div> 
        </div>
    </div>
    <!-- Exportable Table -->
    
</div>
@endsection
