@extends('frontend.layout')
	<!-- <title>TITLE</title> -->
@push('title')
All Posts
@endpush
@section('style')

@endsection

	@section('content')
	
	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<h2 class="text-center">Get In Touch</h2>
					 @if ($errors->any())
		                <div class="alert bg-red alert-dismissible" role="alert">
		                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		                    {{ implode('', $errors->all(':message')) }}
		                </div>
		             @endif
		             @if(Session::has('msg'))
		            <div class="alert bg-green alert-dismissible" role="alert">
		                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		                {{Session::get("success-msg")}}
		            </div>
		             @endif  
					<form class="form-group" method="post" action="{{url('/contact/send')}}">
						{{csrf_field()}}
						<label for="name" class="text-left">Name</label>
						<input name="name" class="form-control" id="name">
						<label for="email">Email</label>
						<input name="email" class="form-control" id="email" required="">
						<label for="subject">Subject</label>
						<input name="subject" class="form-control" id="subject" >
						<label for="massege">Message</label>
						<textarea name="message" class="form-control" rows="5" id="message" required=""></textarea>
						<br/>
						<input type="submit" name="submit" value="Send" class="btn btn-info btn-md">
						<input type="reset" name="reset" value="Reset" class="btn btn-danger btn-md">
					</form>
				</div><!-- col-lg-8 col-md-12 -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- section -->

@endsection