@extends('admin-panel.admin-layout')
@push('style')

@endpush
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-6 block-header">
                    <h2> POSTS</h2>
                </div>
                <div class="col-lg-6">
                    <a href="{{url('admin/post/create')}}" class="btn btn-success m-t-15 waves-effect pull-right">ADD NEW POST</a>
                </div>
            </div>
             <br/>
                @if ($errors->any())
                    <p class="text-danger bg-info">
                        {{ implode('', $errors->all(':message')) }}
                    </p>
                @endif
                <p class="text-success bg-info">
                     {!! Session::has('msg') ? Session::get("msg") : '' !!}
                </p> 
                
                
        </div>
    </div>
    <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-6">
                                <h2 class="text-left">
                                   PENDING POST <spna class="badge bg-red">{{$posts->count()}}</spna>
                                </h2>
                            </div>
                            <br/>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable myDataTable">
                                    <thead>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Title</th>
                                           <!--  <th>Slug</th> -->
                                            <th>Author</th>
                                            <th>Tags</th>
                                            <th>Categories</th>
                                            <!-- <th>Image</th> -->
                                            <th>Status</th>
                                            <th>Approved</th>
                                            <th>View Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>SL NO</th>
                                            <th>Title</th>
                                           <!--  <th>Slug</th> -->
                                            <th>Author</th>
                                            <th>Tags</th>
                                            <th>Categories</th>
                                            <!-- <th>Image</th> -->
                                            <th>Status</th>
                                            <th>Approved</th>
                                            <th>View Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        @foreach($posts as $key => $row )
                                            <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ str_limit($row->title, $limit = 15, $end = '...') }}</td>
                                           <!--  <td>{{$row->slug}}</td> -->
                                            <td>{{$row->user->name}}</td>
                                            <td>
                                                <!-- data load from pivot[post_tag] table-->
                                                @foreach($row->tags as $data)
                                                     <span class="badge bg-purple">{{$data->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <!-- data load from pivot[category_post] table-->
                                                @foreach($row->categories as $data)
                                                    <span class="badge bg-teal"> {{$data->name}}</span>
                                                @endforeach
                                            </td>
                                           <!--  <td>
                                                <img src="{{asset('images/post')}}/{{$row->image}}" width="80"/>
                                                </td> -->
                                            <td>
                                                 @if($row->status== true)
                                                    <span class="badge bg-green">Published</span>
                                                @else
                                                    <span class="badge bg-pink">Unpublished</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($row->is_approved== true)
                                                    <span class="badge bg-blue">Approved</span>
                                                @else
                                                    <span class="badge bg-red">Pending</span>
                                                @endif
                                               
                                            <td>{{$row->view_count}}</td>
                                            <td>
                                                <a href="{{url('admin/post/show', $row->id)}}" class="btn btn-info btn-inline btn-sm">
                                                    <i class="material-icons">book</i>
                                                </a>
                                                <a href="{{url('admin/post/edit', $row->id)}}" class="btn btn-success btn-inline btn-sm">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                
                                               
                                                <a href="" class="btn btn-danger btn-inline btn-sm" data-toggle="modal" data-target="#delete_post_{{$row->id}}">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <a href="" class="btn bg-orange btn-inline btn-sm" data-toggle="modal" data-target="#approved_post_{{$row->id}}">
                                                    <i class="material-icons">done_all</i>
                                                </a>
                                            </td>
                                        </tr>
                                          <!-- edit a tag-->  
                                        <div id="approved_post_{{$row->id}}" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-sm text-center">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Approved {{ str_limit($row->title, $limit = 15, $end = '...') }}</h4>
                                                <span class="material-icons text-info" style="font-size: 80px;">spellcheck</span>
                                              </div>
                                              <!-- <div class="modal-body">

                                                                                               
                                              </div> -->
                                              <div class="modal-footer text-center">
                                               <form action="{{url('admin/pending/approved')}}/{{$row->id}}" method="post">
                                                {{ csrf_field() }}
                                                   <input type="hidden" name="approved" value="1">
                                                   <input type="submit" value="Approved" class="btn btn-info">
                                               </form>
                                              
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>

                                          </div>
                                        </div>                                                
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
