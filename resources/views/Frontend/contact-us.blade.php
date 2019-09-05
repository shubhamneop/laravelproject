@extends('Frontend.masterfrontend')

@section('content')
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">
	    		<div class="col-sm-12">
					<h2 class="title text-center">Contact <strong>Us</strong></h2>
					<div id="gmap" class="contact-map">
					</div>
				</div>
			</div>
    		<div class="row">
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" action="{{url('contactus')}}" class="contact-form row" name="contact-form" method="post" data-parsley-validate>
								{{csrf_field()}}
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control"  required="required"  placeholder="Name" data-parsley-pattern="/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i" data-parsley-trigger="change">
												  <span style="color: red">{{ $errors->first('name') }}</span>
				            </div>
										<div class="form-group col-md-6">
											 <input type="text" name="contactno" class="form-control" required="required" placeholder="Contact No" data-parsley-required data-parsley-type="number" data-parsley-pattern="/^\(?([0-9]{3})\)?([0-9]{3})?([0-9]{4})$/">
											   <span style="color: red">{{ $errors->first('contactno') }}</span>
									 </div>
				            <div class="form-group col-md-12">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email" data-parsley-required>
												  <span style="color: red">{{ $errors->first('email') }}</span>
				            </div>

				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
												  <span style="color: red">{{ $errors->first('subject') }}</span>
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
												  <span style="color: red">{{ $errors->first('message') }}</span>
				            </div>
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>E-Shopper Inc.</p>
							<p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
							<p>Newyork USA</p>
							<p>Mobile: +2346 17 38 93</p>
							<p>Fax: 1-714-252-0026</p>
							<p>Email: info@e-shopper.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>
	    	</div>
    	</div>
    </div><!--/#contact-page-->

	@endsection


	@section('script')

	<!-- <script type="text/javascript">
	$(function () {
			$('#main-contact-form').parsley();
	});
	</script> -->
	<script src="https://code.jquery.com/jquery-3.4.1.js"
	integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	crossorigin="anonymous"></script>
	<script src="http://parsleyjs.org/dist/parsley.js"></script>


	@endsection
