@extends('admin-panel.admin-layout')
@section('content')
 <div class="container-fluid">
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <a href="{{url('/admin/post')}}" title="All Posts">
                                <div class="text">TOTAL POSTS</div>
                                <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="15" data-fresh-interval="20"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <a href="{{url('admin/post/pending')}}">
                                <div class="text">PENDING POST</div>
                                <div class="number count-to" data-from="0" data-to="{{$total_pending_post}}" data-speed="1000" data-fresh-interval="20"></div>
                            </a>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                        <div class="content">
                            <div class="text">FAVORITE</div>
                            <div class="number count-to" data-from="0" data-to="{{\Auth::user()->favorite_post->count()}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">COMMENTS</div>
                            <div class="number count-to" data-from="0" data-to="0" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <a href="{{url('/admin/user')}}">
                            <div class="content">
                                <div class="text">AUTHORS</div>
                                <div class="number count-to" data-from="0" data-to="{{$total_author}}" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-black hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">category</i>
                        </div>
                        <a href="">
                            <div class="content">
                                <div class="text">CATEGORIES</div>
                                <div class="number count-to" data-from="0" data-to="{{$total_category}}" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">tag</i>
                        </div>
                        <a href="#">
                            <div class="content">
                                <div class="text">TAGS</div>
                                <div class="number count-to" data-from="0" data-to="{{$total_tag}}" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <a href="#">
                            <div class="content">
                                <div class="text">TODAYS AUTHOR</div>
                                <div class="number count-to" data-from="0" data-to="{{$todays_authors}}" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>POPULAR POSTS</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Comments</th>
                                            <th>views</th>
                                            <th>Favorite</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($popular_posts as $key=>$post)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td><a href="{{url('/post')}}/{{$post->slug}}" target="_blank">{{$post->title}}</a></td>
                                            <td>{{$post->user->name}}</td>
                                            <td>{{$post->comments->count()}}</td>
                                            <td>{{$post->view_count}}</td>
                                            <td>{{$post->favorite_to_user->count()}}</td>     
                                           
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>ACTIVE AUTHOR</h2>
                        </div>
                        <div class="body">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover dashboard-task-infos">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                
                                                <th>Posts</th>
                                                <th>Comments</th>
                                                <th>Favorite</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($active_author as $key=>$author)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$author->name}}</td>
                                                <td>{{$author->posts->count()}}</td>
                                                <td>{{$author->comments->count()}}</td>
                                                <td>{{$author->favorite_post->count()}}</td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
@endsection