<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title text-uppercase"><b>ABOUT {{$post->user->name}}</b></h4>
							<p>
								{{$post->user->about}}
							</p>
						</div>

						<div class="sidebar-area subscribe-area">

							<h4 class="title"><b>SUBSCRIBE</b></h4>
								@if ($errors->has('email'))
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

							</div><!-- subscribe-area -->

						<div class="tag-area">

							<h4 class="title"><b>TAG CLOUD</b></h4>
							<ul>
								@foreach($tags as $tag)
								<li><a href="{{url('/tag')}}/{{$tag->slug}}">{{$tag->name}}</a></li>
								@endforeach
							</ul>

						</div>
						
						<!-- subscribe-area -->

					</div><!-- info-area -->