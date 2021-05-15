@extends('public.layouts.master')

@section('head')
	<head>
		<title>Contact</title>

		@include('public.layouts.styles')
	</head>
@endsection

@section('content')

	<!-- =========================
Contact Us Page Header
============================== -->
	<section class="header-banner">
		<div class="banner-overlay">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<h2>Contact Us</h2>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="">Home</a></li>
							<li><a class="active" href="">Contact Us</a></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =========================
    Contact Details
    ============================== -->
	<section class="contact-page-details">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="contact-box clearfix">
						<p class="col-sm-3"><i class="fa fa-map-marker fa-2x"></i></p>
						<p class="col-sm-9">
							<span class="contact-box-heading">Office Address</span>
							<span>Hoffman Parkway, P.O Box 353</span>
							<span>Mountain Veiw, USA</span>
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="contact-box clearfix">
						<p class="col-sm-3"><i class="fa fa-phone fa-2x"></i></p>
						<p class="col-sm-9">
							<span class="contact-box-heading">Phone Number</span>
							<span>Local: 1-800-11111</span>
							<span>Mobile: 1-000-12345</span>
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="contact-box clearfix">
						<p class="col-sm-3"><i class="fa fa-envelope fa-2x"></i></p>
						<p class="col-sm-9">
							<span class="contact-box-heading">Email Address</span>
							<span>youremail@mail.com</span>
							<span>www.yourwebsite.com</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =========================
    Contact Form
    ============================== -->
	<section class="contact-form">
		<div class="container">
			<div class="row">
				<div class="col-md-12 contact-form-holder">
					<h2>Say Hello! Don't be shy.</h2>
					<p>If you have any question or comments, or would just like to say hello, just send us a message to our awesome team.</p>

					<form action="contact.php"  method="post" name="contactform" id="contactform" class="clearfix">
						<div class="form-left col-sm-5">
							<input class="form-control" placeholder="Your Name" type="text" name="name">
							<input class="form-control" placeholder="Your Email" type="email" name="email">
							<input class="form-control" placeholder="Subject" type="text" name="subject">
						</div>
						<div class="form-right col-sm-7">
							<textarea class="form-control" name="message" rows="3" placeholder="Type Your message"></textarea>
						</div>
						<div class="form-button col-sm-12">
							<button type="submit" name="submit">Send Message</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- =========================
    Contact Map
    ============================== -->
	<section class="google-map contact-map">
		<div class="container-fluid padding-fix">
			<div class="row">
				<div class="col-md-12">
					<div id="property-map"></div>
				</div><!-- end .col-md-12 -->
			</div><!-- end .row -->
		</div><!-- end .container-fluid -->
	</section>
@endsection

@section('footer')
	@include('public.layouts.footer')
@endsection

@section('google-maps-scripts')
	@include('public.layouts.google-maps-scripts')
@endsection