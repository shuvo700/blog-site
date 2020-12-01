<footer>
		@yield('footer')
		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">
						<h4 class="title"><b>ABOUT US</b></h4>
						<p class="copyright">Shuvo @ {{date('Y')}}. All rights reserved.</p>
						
						<ul class="icons">
							<li><a href="https://facebook.com/" target="_blank" title="Maruf facebook"><i class="ion-social-facebook-outline"></i></a></li>
							<li><a href="https://mobile.twitter.com/" target="_blank"><i class="ion-social-twitter-outline"></i></a></li>
							{{-- <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
							<li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li> --}}
						</ul>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
						<div class="footer-section">
						@if(@$categories->count()>0)
							<h4 class="title"><b>CATAGORIES</b></h4>
							<ul>
								@foreach(@$categories as $category)
								<li><a href="{{url('/category')}}/{{$category->slug}}" title="{{$category->name}}">{{$category->name}}</a></li>
								@endforeach
							</ul>
						@endif
						
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<h4 class="title"><b>SUBSCRIBE</b></h4>
						 @if ($errors->any())
					            <div class="alert alert-warning alert-dismissible" role="alert">
					                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					                {{ implode('', $errors->all(':message')) }}
					            </div>
					         @endif
					         @if(Session::has('msg'))
					        <div class="alert alert-success alert-dismissible" role="alert">
					            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					            {{Session::get("msg")}}
					        </div>
					         @endif
						<div class="input-area">
							 <form action="{{url('/subscribe')}}" method="post">
                                {{ csrf_field() }}
								<input class="email-input" type="email" name="email" placeholder="Enter your email">
								<button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
							</form>
						</div>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

			</div><!-- row -->
		</div><!-- container -->
	</footer>