@extends('admin-panel.admin-layout')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Category</h2>
    </div>
    <div class="row clearfix">
        @if ($errors->any())
            <div class="alert bg-red alert-dismissible" role="alert">
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
                        ADD NEW CATEGORY
                    </h2> 
                     
                </div>
            
                <div class="body">
                   
                  <form action="{{url('admin/category/store')}}"  method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control">
                                <label class="form-label">Category Name</label>
                            </div>
                            
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">Category Image</label>
                            <div class="form-line">
                                <input type="file" name="image" class="form-control">
                                
                            </div>
                            
                        </div>
                        <input type="submit" name="" class="btn btn-primary m-t-15 waves-effect" value="SAVE">
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
                                ALL Category LIST
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable myDataTable">
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
                                                <a href="{{url('admin/category/edit', $row->id)}}" class="btn btn-success btn-inline btn-sm" data-toggle="modal" data-target="#edit_category_{{$row->id}}">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                
                                               <a href="{{url('admin/category/delete', $row->id)}}" class="btn btn-danger btn-inline btn-sm">
                                                 <i class="material-icons">delete</i>
                                              </a>   
                                            </td>
                                        </tr>
                                        <!-- edit a category-->  
                                        <div id="edit_category_{{$row->id}}" class="modal fade" role="dialog">
                                          <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit <mark>{{$row->name}}</mark></h4>
                                              </div>
                                              <div class="modal-body">
                                                <form action="{{url('admin/category/update', $row->id)}}"  method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" name="name" class="form-control" value="{{$row->name}}">
                                                            <label class="form-label">Category Name</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="image">Image</label>
                                                            <input id="image" type="file" name="image">
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