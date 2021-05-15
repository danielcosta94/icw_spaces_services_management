@extends('public.layouts.master')

@section('head')
	<head>
		<title>Gallery</title>

		@include('public.layouts.styles')
	</head>
@endsection

@section('content')

	<!-- =========================
 Gallery Page Header
============================== -->
	<section class="header-banner">
		<div class="banner-overlay">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<h2>Gallery</h2>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="">Home</a></li>
							<li><a class="active" href="">Gallery</a></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="gallery-main">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="section-heading">Photo <span>Gallery</span></h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu magna metus. Donec sed erat non ipsum tincidunt pharetra ipsum tincidunt pharetra
					</p>
				</div><!-- end .col-md-12 -->
			</div><!-- end .row -->
			<div class="row">
				<div class="col-md-12">
					<div class="controls">
						<button class="filter" data-filter="all">All</button>
						<button class="filter" data-filter=".bedroom">Bedroom</button>
						<button class="filter" data-filter=".bathroom">Bathroom</button>
						<button class="filter" data-filter=".kitchen">Kitchen</button>
						<button class="filter" data-filter=".garage">Garage</button>
						<button class="filter" data-filter=".basement">Basement</button>
					</div>
					<div id="container-mix" class="container-mix grid-effect">
						<div class="mix bedroom col-md-4 col-sm-6" data-myorder="1">
							<figure class="effect-zoe">
								<img src="images/image1.png" alt="img25"/>
								<figcaption>
									<div><a href="images/image1.png" class="preview-btn"><i class="fa fa-search"></i></a>
										<a href=""><h3>Burnside Court</h3></a></div>
								</figcaption>
							</figure>
						</div>
						<div class="mix bathroom col-md-4 col-sm-6" data-myorder="2">
							<figure class="effect-zoe">
								<img src="images/image2.png" alt="img25"/>
								<figcaption>
									<div><a href="images/image2.png" class="preview-btn"><i class="fa fa-search"></i></a>
										<a href=""><h3>Burnside Court</h3></a></div>
								</figcaption>
							</figure>
						</div>
						<div class="mix kitchen col-md-4 col-sm-6" data-myorder="3">
							<figure class="effect-zoe">
								<img src="images/image3.png" alt="img25"/>
								<figcaption>
									<div><a href="images/image3.png" class="preview-btn"><i class="fa fa-search"></i></a>
										<a href=""><h3>Burnside Court</h3></a></div>
								</figcaption>
							</figure>
						</div>
						<div class="mix garage col-md-4 col-sm-6" data-myorder="4">
							<figure class="effect-zoe">
								<img src="images/image4.png" alt="img25"/>
								<figcaption>
									<div><a href="images/image4.png" class="preview-btn"><i class="fa fa-search"></i></a>
										<a href=""><h3>Burnside Court</h3></a></div>
								</figcaption>
							</figure>
						</div>
						<div class="mix basement col-md-4 col-sm-6" data-myorder="5">
							<figure class="effect-zoe">
								<img src="images/image5.png" alt="img25"/>
								<figcaption>
									<div><a href="images/image5.png" class="preview-btn"><i class="fa fa-search"></i></a>
										<a href=""><h3>Burnside Court</h3></a></div>
								</figcaption>
							</figure>
						</div>
						<div class="mix bedroom col-md-4 col-sm-6" data-myorder="6">
							<figure class="effect-zoe">
								<img src="images/image6.png" alt="img25"/>
								<figcaption>
									<div><a href="images/image6.png" class="preview-btn"><i class="fa fa-search"></i></a>
										<a href=""><h3>Burnside Court</h3></a></div>
								</figcaption>
							</figure>
						</div>
						<div class="mix garage col-md-4 col-sm-6" data-myorder="7">
							<figure class="effect-zoe">
								<img src="images/image1.png" alt="img25"/>
								<figcaption>
									<div><a href="images/image1.png" class="preview-btn"><i class="fa fa-search"></i></a>
										<a href=""><h3>Burnside Court</h3></a></div>
								</figcaption>
							</figure>
						</div>
						<div class="mix basement col-md-4 col-sm-6" data-myorder="8">
							<figure class="effect-zoe">
								<img src="images/image3.png" alt="img25"/>
								<figcaption>
									<div><a href="images/image3.png" class="preview-btn"><i class="fa fa-search"></i></a>
										<a href=""><h3>Burnside Court</h3></a></div>
								</figcaption>
							</figure>
						</div>
						<div class="mix bedroom col-md-4 col-sm-6" data-myorder="9">
							<figure class="effect-zoe">
								<img src="images/image5.png" alt="img25"/>
								<figcaption>
									<div><a href="images/image5.png" class="preview-btn"><i class="fa fa-search"></i></a>
										<a href=""><h3>Burnside Court</h3></a></div>
								</figcaption>
							</figure>
						</div>
					</div>
				</div><!-- end .col-md-12 -->
			</div><!-- end .row -->
		</div><!-- end .container -->
	</section>
@endsection

@section('footer')
	@include('public.layouts.footer')
@endsection
