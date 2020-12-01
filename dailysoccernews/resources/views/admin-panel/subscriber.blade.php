@extends('admin-panel.admin-layout')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>SUBSCRIBERS</h2>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <p>Add New Subscriber</p>
                            <form action="{{url('admin/subscriber/store')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Subscriber Email" value="">
                                    </div>
                                    <br/>
                                     <input type="submit" name="submit" value="Save" class="btn btn-info">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL SUBSCRIBER LIST 
                                <span class="badge bg-blue">{{$subscribers->count()}}</span>
                            </h2>
                            
                            <br/>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable myDataTable" >
                                    <thead>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        @foreach($subscribers as $key => $user )
                                            <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->created_at}}</td>
                                            
                                            <td>
                                                <a href="{{url('admin/subscriber/edit', $user->id)}}" class="btn btn-success btn-inline btn-sm" >
                                                    <i class="material-icons">edit</i>
                                                </a>
                                               <a href="#" class="btn btn-danger btn-inline btn-sm" data-toggle="modal" data-target="#delete_subscriber_{{$user->id}}">
                                                    <i class="material-icons">delete</i>
                                                </a>   
                                            </td>
                                        </tr>
                                        <!-- Delete A Subscriber-->  
                                        <div id="delete_subscriber_{{$user->id}}" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-sm">
                                            <!-- Modal content-->
                                            <div class="modal-content text-center">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <p class="modal-title">Delete <mark>{{$user->name}}</mark></p>
                                              </div>
                                              <div class="modal-body">
                                               
                                                <i class="material-icons" style="font-size: 40px;">delete</i><br/><br/>
                                                <a href="{{url('admin/subscriber/delete', $user->id)}}" class="btn btn-danger btn-inline btn-sm">
                                                     Delete
                                                  </a>
                                                  <button type="button" class="btn btn-info" data-dismiss="modal">Cancle</button>
                                              </div>
                                            </div>

                                          </div>
                                        </div>                                             
                                        <!-- Delete A Subscriber end-->                                                
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