@extends('admin-panel.admin-layout')
@push('style')
<!-- Bootstrap Select Css -->
<link href="{{asset('admin-panel/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .select2-selection{
        border-bottom: 1px solid #ddd;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>COMMENTS</h2>
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
                                COMMENTS
                                <span class="badge bg-blue">{{$comments->count()}}</span> / 
                                <span class="badge bg-red">{{$comments->where('status', '=', false)->count()}}</span>
                                
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable myDataTable" >
                                    <thead>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Title</th>
                                            <th>Comment</th>
                                            <th>User</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Title</th>
                                            <th>Comment</th>
                                            <th>User</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        @foreach($comments as $key => $comment)
                                            <tr>
                                            <td>{{ ++$key }}</td>
                                            
                                            <td>
                                                <a href="{{url('/post')}}/{{$comment->post->slug}}" target="_blank">
                                                    {{ str_limit($comment->post->title, $limit = 30, $end = '...') }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ str_limit($comment->comment, $limit = 30, $end = '...') }}
                                            </td>
                                            <td>{{$comment->user->name}}</td>
                                            <td>
                                                @if($comment->status==true)
                                                    <p class="badge bg-green">Approved</p>
                                                @else
                                                    <p class="badge bg-red">Unapproved</p>
                                                @endif
                                            </td>
                                            
                                            
                                            <td>
                                                <!-- edit comment-->
                                                 <a href="" class="btn btn-success btn-inline btn-sm" data-toggle="modal" data-target="#edit_comment_{{$comment->id}}">
                                                    <i class="material-icons">edit</i>
                                                </a>

                                                <a href="javascript:void(0);" onclick="document.getElementById('comment_{{$comment->id}}').submit();"  class="btn btn-danger btn-inline btn-sm" >
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <form id="comment_{{$comment->id}}" class="d-none" method="post" action="{{url('admin/comment/delete')}}/{{$comment->id}}">
                                                    {{ csrf_field() }}
                                                </form>

                                               
                                                 
                                            </td>
                                        </tr>
                                            <!-- edit a tag-->  
                                        <div id="edit_comment_{{$comment->id}}" class="modal fade" role="dialog">
                                          <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4><span class="badge bg-blue"> {{$comment->user->name}}</span> Commented On The - {{$comment->post->title}}</h4>
                                              </div>
                                              <div class="modal-body">
                                                <form action="{{url('admin/comment/update', $comment->id)}}"  method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" name="comment" class="form-control" value="{{$comment->comment}}">
                                                            <label class="form-label">Comment</label>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <input type="checkbox" id="status" name="status"  value="1" {{$comment->status==true ? 'checked':''}}>
                                                        <label for="status">Is Published</label>  
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
                                        <!-- edit a comment end-->                                            
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