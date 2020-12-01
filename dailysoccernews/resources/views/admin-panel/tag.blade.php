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
                        ADD NEW TAG
                    </h2> 
                     
                </div>
            
                <div class="body">
                   
                  <form action="{{url('admin/tag/store')}}"  method="post">
                        {{ csrf_field() }}
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="tag_name" name="name" class="form-control">
                                <label class="form-label">Tag Name</label>
                            </div>
                            
                        </div>
                        <input type="submit" name="" class="btn btn-primary m-t-15 waves-effect" value="SAVE">
                        <button type="button" class="btn btn-success m-t-15 waves-effect">SAVE ABD NEW</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL TAGS LIST
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Post Count</th>
                                            <th>Updated At</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Post Count</th>
                                            <th>Updated At</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        @foreach($data as $key => $row )
                                            <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->slug}}</td>
                                            <td>{{$row->posts->count()}}</td>
                                            <td>{{$row->created_at}}</td>
                                            <td>{{$row->updated_at}}</td>
                                            <td>
                                                <a href="{{url('admin/tag/edit', $row->id)}}" class="btn btn-success btn-inline btn-sm" data-toggle="modal" data-target="#edit_tag_{{$row->id}}">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                
                                               <a href="{{url('admin/tag/delete', $row->id)}}" class="btn btn-danger btn-inline btn-sm">
                                                 <i class="material-icons">delete</i>
                                              </a>   
                                            </td>
                                        </tr>
                                        <!-- edit a tag-->  
                                        <div id="edit_tag_{{$row->id}}" class="modal fade" role="dialog">
                                          <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit <mark>{{$row->name}}</mark></h4>
                                              </div>
                                              <div class="modal-body">
                                                <form action="{{url('admin/tag/update', $row->id)}}"  method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" name="name" class="form-control" value="{{$row->name}}">
                                                            <label class="form-label">Tag Name</label>
                                                        </div>
                                                        
                                                    </div>
                                                    <input type="submit" name="" class="btn btn-primary m-t-15 waves-effect" value="Update">
                                                    
                                                </form>
                                              </div>
                                              <div class="modal-footer">
                                               
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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