@extends('admin-panel.admin-layout')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>USERS</h2>
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
    </div>
    <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL USER LIST 
                                <span class="badge bg-blue">{{$users->count()}}</span>
                            </h2>
                            <a href="{{url('admin/user/create')}}" class="btn btn-info pull-right">Create New</a>
                            <br/>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable myDataTable">
                                    <thead>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Post Count</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Role</th>
                                            <th>Slug</th>
                                            <th>Post Count</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        @foreach($users as $key => $user )
                                            <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{$user->name}}</td>
                                            <td>
                                                @if($user->role->id==1)
                                                <span class="badge bg-green"> 
                                                    {{$user->role['name']}}
                                                </span>
                                                @else
                                                {{$user->role['name']}}
                                                @endif
                                            </td>
                                            <td>{{$user->posts->count()}}</td>
                                            <td>
                                      			{{$user->email}}
                                            </td>
                                            <td>{{$user->created_at}}</td>
                                            
                                            <td>
                                                <a href="{{url('admin/user/edit', $user->id)}}" class="btn btn-success btn-inline btn-sm" >
                                                    <i class="material-icons">edit</i>
                                                </a>
                                               
                                                
                                              
                                               <a href="#" class="btn btn-danger btn-inline btn-sm" data-toggle="modal" data-target="#delete_user_{{$user->id}}">
                                                    <i class="material-icons">delete</i>
                                                </a>   
                                            </td>
                                        </tr>
                                        <!-- Delete A User-->  
                                        <div id="delete_user_{{$user->id}}" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-sm">
                                            <!-- Modal content-->
                                            <div class="modal-content text-center">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <p class="modal-title">Delete <mark>{{$user->name}}</mark></p>
                                              </div>
                                              <div class="modal-body">
                                               
                                                <h2><i class="material-icons">delete</i></h2>
                                                <p>Also Delete {{$user->name}}'s Posts</p>
                                                 <a href="{{url('admin/user/delete', $user->id)}}" class="btn btn-danger btn-inline btn-sm">
                                                     Delete
                                                  </a>
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                                              </div>
                                            </div>

                                          </div>
                                        </div>                                             
                                        <!-- edit a tag end-->                                                
                                        @endforeach                                 
                                    </tbody>
                                </table>
                                  <!-- Modal Trigger -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
</div>
@endsection