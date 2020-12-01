@extends('admin-panel.admin-layout')
@section('content')
 <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        
                        <div class="col-lg-6">
                            <h2>
                                YOUR FAVORITE POSTS <spna class="badge bg-green">{{$posts->count()}}</spna>
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
                                        <th>Time</th>
                                        <th>Action</th>
                                       
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                       <th>SL NO</th>
                                        <th>Title</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                      
                                    </tr>
                                </tfoot>
                                <tbody>

                                    @foreach($posts as $key => $row )
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td><a href="{{url('post')}}/{{$row->slug}}" target="_blank">{{$row->title}}</a></td>
                                            <td>{{$row->updated_at->format('d M Y - H:i A')}}</td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$row->id}}').submit();">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                                <form id="favorite-form-{{$row->id}}" class="d-none" method="post" action="{{url('/favorite/add')}}/{{$row->id}}">
                                                    {{ csrf_field() }}
                                                </form>

                                            </td>
                                        </tr>
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
@endsection
