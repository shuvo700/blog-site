@extends('frontend.layout')
	<!-- <title>TITLE</title> -->
@push('title')
All Posts
@endpush
@section('style')
	<link href="{{asset('frontend/blog-sidebar/css/styles.css')}}" rel="stylesheet">

	<link href="{{asset('frontend/blog-sidebar/css/responsive.css')}}" rel="stylesheet">
@endsection

	@section('content')
	<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{$tag->name.'-'.$tag_posts->count()}}</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-12 col-md-12">
					<div class="row">
						@foreach($tag_posts as $post)
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="card h-100">
								<div class="single-post post-style-1">

									<div class="blog-image">
										@if($post->image==true)
										<img src="{{asset('images/post')}}/{{$post->image}}" alt="Blog">
										@else
											<img src="{{asset('images/post/default.jpg')}}" alt="Blog">
										@endif
									</div>

									<a class="avatar" href="#">
										@if($post->user->image==true)
										<img src="{{asset('images/users')}}/{{$post->user->image}}" alt="Profile Image">
										@else
										<img src="{{asset('images/users/default-user-img.png')}}" alt="Profile Image">
										@endif
									</a>

									<div class="blog-info">

										<h4 class="title"><a href="{{url('/post')}}/{{$post->slug}}" title="{{$post->slug}}"><b>{{$post->title}}</b></a></h4>
										<ul class="post-footer">
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

									</div><!-- blog-info -->
								</div><!-- single-post -->
							</div><!-- card -->
						</div><!-- col-lg-4 col-md-6 -->
						@endforeach

					</div><!-- row -->

					

				</div><!-- col-lg-8 col-md-12 -->


			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->

@endsection