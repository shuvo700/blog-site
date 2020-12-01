@extends('frontend.layout')
	<!-- <title>TITLE</title> -->
@push('title')
Home
@endpush
@section('style')
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.theme.css'>
	<link href="{{asset('frontend/layout-1/css/styles.css')}}" rel="stylesheet">

	<link href="{{asset('frontend/layout-1/css/responsive.css')}}" rel="stylesheet">
	<style type="text/css">
		#carousel .item{
  cursor:grab;
  cursor:-webkit-grab;
}

#carousel .item img {
  display: block;
 /* width: auto;
  height: auto;*/
}

/* Styling Pagination*/
.owl-theme .owl-controls .owl-page span{
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
  width: 100px;
  height: 5px;
  margin-left: 2px;
  margin-right: 2px;
  background: #ccc;
  border:none;
}

.owl-theme .owl-controls .owl-page.active span,
.owl-theme .owl-controls.clickable .owl-page:hover span{
  background: #3F51B5;
}
	</style>
<meta charset="utf-8">
<meta name="Keywords" value="maruf,maruf cse,cse,al bashir,maruf al bashir,blog,laravel,laravel developer,wordpress,wordpress developer,bangladesh,bd,dhaka,laravel developer bangladesh,revinr web developer,web designer,wordpress theme developer,wordpress plugin developer">
<meta name="Description" content="Maruf Al Bashir,Web developer">

@endsection

	@section('content')
	@if(Session::has('favorite'))
    <div class="alert bg-success alert-dismissible auto-dismissible" data-auto-dismiss="20" role="alert" style="width: 280px; float: right; position: absolute; height: 100px; z-index: 100; right: 0;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{Session::get("favorite")}}
    </div>
     @endif  
     @if($categories==true)
					
     <div id="carousel" class="owl-carousel owl-theme"> 
		 @foreach($categories as $category)
		  <div class="item">
		   	<a class="slider-category" href="{{url('/category')}}/{{$category->slug}}">
			    <div class="blog-image">
				    <img src="{{asset('images/category/'.$category->image)}}" style="height:422px; width:1200px"/>
				</div>
			    	{{-- <div class="category">
						<div class="display-table center-text">
							<div class="display-table-cell">
								<h3><b>{{$category->name}}
								</b></h3>
								
							</div>
						</div>
					</div> --}}
					</a>
			  	</div>

		  @endforeach
		 
		</div>
		@endif
	{{-- <div class="main-slider">
		


		<div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
			data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
			data-swiper-breakpoints="true" data-swiper-loop="true" >
			<div class="swiper-wrapper">
				@if($categories==true)
					@foreach($categories as $category)
					<div class="swiper-slide">
						<a class="slider-category" href="{{url('/category')}}/{{$category->slug}}">
							<div class="blog-image"><img src="{{asset('images/category/'.$category->image)}}" alt="Blog Image"></div>

							<div class="category">
								<div class="display-table center-text">
									<div class="display-table-cell">
										<h3><b>{{$category->name}}
										</b></h3>
										
									</div>
								</div>
							</div>

						</a>
					</div>
					@endforeach
				@else
					<div class="swiper-slide">
						<a class="slider-category" href="#">
							<div class="blog-image"><img src="{{asset('frontend/images/category-1-400x250.jpg')}}" alt="Blog Image"></div>

							<div class="category">
								<div class="display-table center-text">
									<div class="display-table-cell">
										<h3><b>BEAUTY</b></h3>
									</div>
								</div>
							</div>

						</a>
					</div>
				@endif


				


				

			</div><!-- swiper-wrapper -->

		</div><!-- swiper-container -->

	</div> --}}<!-- slider -->

	<section class="blog-area section">
		<div class="container">
			<div class="row">
				@foreach($posts as $post)
				<div class="col-lg-4 col-md-6">
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

			@if($posts->count()>12)
			<a class="load-more-btn" href="{{url('/blog')}}" title="All Blog"><b>LOAD MORE</b></a>
			@endif
		</div><!-- container -->
	</section><!-- section -->

@endsection

@section('scripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.js'></script>
<script type="text/javascript">
	$(document).ready(function() {
  $("#carousel").owlCarousel({
      navigation : false,
      slideSpeed : 500,
   		paginationSpeed : 800,
    	rewindSpeed : 1000,
      singleItem: true,
			autoPlay : true,
    	stopOnHover : true,
  });
});
</script>
@endsection