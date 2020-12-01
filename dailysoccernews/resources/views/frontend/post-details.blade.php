@extends('frontend.layout')
	<!-- <title>TITLE</title> -->
@push('title')
{{$post->slug}}
@endpush

@section('style')
	<link href="{{asset('frontend/single-post-1/css/styles.css')}}" rel="stylesheet">

	<link href="{{asset('frontend/single-post-1/css/responsive.css')}}" rel="stylesheet">
@endsection

@section('content')

	<div class="slider" @if($post->image)style="background-image:url({{asset('images/post')}}/{{$post->image}})" @endif>
		<div class="display-table  center-text">
			<h1 class="title display-table-cell" style="background: rgba(0,0,0,.5);"><b>{{$post->title}}</b></h1>
		</div>
	</div><!-- slider -->


	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#">
										@if($post->user->image==true)
											<img src="{{asset('images/users')}}/{{$post->user->image}}" alt="Profile Image">
										@else
										
										<img src="{{asset('images/users/default-user-img.png')}}" alt="{{$post->user->name}}">

										@endif
									</a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{$post->user->name}}</b></a>
									<h6 class="date">on {{$post->created_at->format('D M Y i A')}}</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

							<p class="para">
								{!!$post->body!!}
							</p>

							
							<h4>Tags:</h4>
							<ul class="tags">
								@foreach($post->tags as $tag)
								<li><a href="{{url('/tag')}}/{{$tag->slug}}">{{$tag->name}}</a></li>
								@endforeach
							</ul>
							<h4>Category:</h4>
							<ul class="tags">
								@foreach($post->categories as $category)
								<li><a href="{{url('/category')}}/{{$category->slug}}">{{$category->name}}</a></li>
								@endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
								
								<li>
									@guest
										<a href="#" onclick="alert('You Must Login First')">
											<i class="ion-heart"></i>
											{{$post->favorite_to_user->count()}}
										</a>
										@else
											@if($post->favorite_to_user->count()==true)
												<a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$post->id}}').submit();" class="text-info">
													<i class="ion-heart"></i>
													{{$post->favorite_to_user->count()}}
												</a>
												@else
													<a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$post->id}}').submit();">
													<i class="ion-heart"></i>
													{{$post->favorite_to_user->count()}}
												</a>
											@endif  
										@endguest
										<form id="favorite-form-{{$post->id}}" class="d-none" method="post" action="{{url('/favorite/add')}}/{{$post->id}}">
											{{ csrf_field() }}
										</form>
								</li>
								<li><a href="#"><i class="ion-chatbubble"></i>{{$post->comments->count()}}</a></li>
								<li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
							</ul>

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>

						<div class="post-footer post-info">

							<div class="left-area">
								<a class="avatar" href="#">
									@if($post->user->image==true)
										<img src="{{asset('images/users')}}/{{$post->user->image}}" alt="Profile Image">
									@else
									
									<img src="{{asset('images/users')}}/default-user-img.png" alt="Profile Image">

									@endif
								</a>
							</div>

							<div class="middle-area">
								<a class="name" href="#"><b>{{$post->user->name}}</b></a>
								<h6 class="date">on {{$post->created_at->format('d M Y , H:i A')}}</h6>
							</div>

						</div><!-- post-info -->


					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					@include('frontend.partial.sidebar')

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">
				@foreach($post_random as $rn_post)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image">
								@if($rn_post->image==true)
								<img src="{{asset('images/post')}}/{{$rn_post->image}}" alt="{{$post->slug}}">
								@else
								<img src="{{asset('images/post/default.jpg')}}" alt="{{$rn_post->slug}}">
								@endif
							</div>

							<a class="avatar" href="#">
								@if($rn_post->user->image==true)
								<img src="{{asset('images/users')}}/{{$rn_post->user->image}}" alt="{{$rn_post->user->name}}">
								@else
								<img src="{{asset('images/users/default-user-img.png')}}" alt="{{$rn_post->user->name}}">
								@endif
							</a>

							<div class="blog-info">

								<h4 class="title"><a href="{{url('/post')}}/{{$rn_post->slug}}"><b>{{$rn_post->title}}</b></a></h4>

								<ul class="post-footer">
									<li>
									@guest
										<a href="#" onclick="alert('You Must Login First')">
											<i class="ion-heart"></i>
											{{$rn_post->favorite_to_user->count()}}
										</a>
										@else
										<a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$post->id}}').submit();">
											<i class="ion-heart"></i>
											{{$rn_post->favorite_to_user->count()}}
										</a> 
										@endguest
										<form id="favorite-form-{{$post->id}}" class="d-none" method="post" action="{{url('/favorite/add')}}/{{$post->id}}">
											{{ csrf_field() }}
										</form>
								</li>
									<li><a href="#"><i class="ion-chatbubble"></i>.</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-md-6 col-sm-12 -->
				@endforeach

				

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			@guest
				<h4 class="text-danger"><b>PLEASE LOGIN TO POST COMMENT</b></h4>
			@else

			
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
						
						@if ($errors->has('comment'))
			                <div class="alert text-danger alert-dismissible" role="alert">
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
						<form method="post" action="{{url('comment')}}/{{$post->id}}">
							{{csrf_field()}}
							<div class="row">

								
								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false" required=""></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
					</div><!-- comment-form -->
			@endguest
			<!-- show comments-->
					<h5><b>
						COMMENTS({{$post->comments->count()}})
						
					</b></h5>
					
					@if($post->comments->count() > 0)

						@foreach($post->comments as $comment)
							@if($comment->status == true)
							<div class="commnets-area">

							
								<div class="comment">

									<div class="post-info">

										<div class="left-area">
											@if($comment->user->image==true)
												<img src="{{asset('images/users')}}/{{$comment->user->image}}" alt="Profile Image">
											@else
											
											<img src="{{asset('images/users')}}/default-user-img.png" alt="Profile Image">

											@endif
										</div>

										<div class="middle-area">
											<a class="name" href="#"><b>{{$comment->user->name}}</b></a>
											
											<h6 class="date">on {{$comment->created_at}}</h6>
										</div>

										<div class="right-area">
											<h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
										</div>

									</div><!-- post-info -->

									<p>{{$comment->comment}}</p>

								</div>
							</div><!-- commnets-area -->
							@endif
						@endforeach

						@else
						<br/>
							<h4>No Comment For This Post</h4>
								
						@endif
					

					

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>


@endsection

