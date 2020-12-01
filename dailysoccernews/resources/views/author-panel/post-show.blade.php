@extends('admin-panel.admin-layout')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">     
        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <h4>{{$post->title}}</h4>
                    <p>Posted By <b>{{$post->user->name}}</b> On - {{$post->created_at->format('d M Y')}}
                        @if($post->status==true)
                        <span class="badge bg-green">
                            Published
                        </span>
                        @else
                        <span class="badge bg-red">
                            Unpublished
                        </span>
                        @endif
                    </p>
                    <hr/>
                    <p>{{$post->body}} </p>
                </div>
            </div>         
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="body">
                    <h4>Categories</h4>
                    @foreach($post->categories as $category)
                        <div class="badge bg-blue">
                            {{$category->name}}

                        </div>
                    @endforeach
                   
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <h4>Tags</h4>
                    @foreach($post->tags as $tag)
                        <div class="badge bg-black">
                            {{$tag->name}}
                        </div>
                    @endforeach
                </div>
            </div> 
            <div class="card">
                <div class="body">
                    <h4>Action</h4>
                    <div class="btn-inline">
                        <a href="{{url('author/post/edit', $post->id)}}" title="Back" class="btn btn-md btn-info">Edit This Post</a>
                        <a href="{{url('author/post')}}" title="Back" class="btn btn-md btn-warning">Back</a>
                       
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="body">
                   <h5>Featured Image</h5>
                   <img src="{{asset('images/post')}}/{{$post->image}}" class="img img-responsive" alt="post-image">
                </div>
            </div> 
        </div>
    </div>
    <!-- Exportable Table -->
    
</div>
@endsection
