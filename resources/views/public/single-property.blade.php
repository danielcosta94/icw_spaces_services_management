@extends('public.layouts.master')

@section('head')
    <head>
        <title>Single Property</title>

        @include('public.layouts.styles')
    </head>
@endsection

@section('content')

    <!-- =========================
 Single Property Page Header
============================== -->
    <section class="header-banner single-property-banner">
        <div class="banner-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h2>Property Name</h2>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="">Home</a></li>
                            <li><a class="active" href="">Property Name</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================
     Single Property Content
    ============================== -->
    <section class="single-property">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="property-name">
                        <h2>Single Family Home <span>For Sale</span> <span>Open House</span></h2>
                        <p>S Western Avenue</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="property-price">
                        <h2>$760,000</h2>
                        <h4>$2200/mo</h4>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="property-gallery">
                        <img src="images/single-property01.jpg" alt="" />
                    </div>
                </div>

                <div class="col-sm-12 single-property-details">
                    <div class="property-description">
                        <h2 class="pd-title">Description</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                        <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                    </div><!-- End Property Description -->

                    <div class="property-location">
                        <h2 class="pd-title">Address</h2>
                        <div class="row">
                            <div class="col-sm-4">
                                <ul>
                                    <li><strong>Address:</strong> S Western Avenue</li>
                                    <li><strong>City:</strong> Newyork</li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul>
                                    <li><strong>State/Country:</strong> Newyork</li>
                                    <li><strong>Zip/Postal Code:</strong> 55326</li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul>
                                    <li><strong>Neighborhood:</strong> Hermosa</li>
                                    <li><strong>Country:</strong> United States</li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- End Property Location -->

                    <div class="property-details-list">
                        <h2 class="pd-title">Details</h2>
                        <div class="alert alert-success">
                            <ul class="list-details">
                                <li><strong>Property ID:</strong> HZ33</li>
                                <li><strong>Price:</strong> $670,000</li>
                                <li><strong>Property Size:</strong> 1200 Sq Ft</li>
                                <li><strong>Bedrooms:</strong> 4</li>
                                <li><strong>Bathrooms:</strong> 2</li>
                                <li><strong>Garage:</strong> 1</li>
                                <li><strong>Garage Size:</strong> 200 SqFt</li>
                                <li><strong>Year Built:</strong> 2016-01-09</li>
                            </ul>
                        </div>

                        <h3>Additional Details</h3>
                        <ul class="list-details">
                            <li><strong>Deposit:</strong> 20%</li>
                            <li><strong>Pool Size:</strong> 300 Sqft</li>
                            <li><strong>Last remodel year:</strong> 1987</li>
                            <li><strong>Amenities:</strong> Clubhouse</li>
                            <li><strong>Additional Rooms::</strong> Guest Bath</li>
                            <li><strong>Equipment:</strong> Grill - Gas</li>
                        </ul>
                    </div><!-- End Property details List -->

                    <div class="property-features">
                        <h2 class="pd-title">Features</h2>
                        <ul class="list-features">
                            <li><i class="fa fa-check"></i> Air Conditioning</li>
                            <li><i class="fa fa-check"></i> Barbeque</li>
                            <li><i class="fa fa-check"></i> Dryer</li>
                            <li><i class="fa fa-check"></i> Gym</li>
                            <li><i class="fa fa-check"></i> Laundry</li>
                            <li><i class="fa fa-check"></i> Lawn</li>
                            <li><i class="fa fa-check"></i> Swiming Pool</li>
                            <li><i class="fa fa-check"></i> Yard</li>
                            <li><i class="fa fa-check"></i> WiFi</li>
                            <li><i class="fa fa-check"></i> TV Cable</li>
                            <li><i class="fa fa-check"></i> Washer</li>
                            <li><i class="fa fa-check"></i> Window Coverage</li>
                            <li><i class="fa fa-check"></i> Outdoor Shower</li>
                            <li><i class="fa fa-check"></i> Sauna</li>
                            <li><i class="fa fa-check"></i> Nicrowave</li>
                        </ul>
                    </div><!-- End Property Featues -->

                    <div class="property-contact-info">
                        <h2 class="pd-title">Contact Info</h2>
                        <div class="agent-media clearfix">
                            <img src="images/women-agent-2.jpg" alt="" class="pull-left" />
                            <ul>
                                <li>Contact Agent</li>
                                <li><i class="fa fa-user"></i> Brittany Watkins</li>
                                <li><i class="fa fa-phone"></i> 321 456 9874</li>
                                <li>
                                    <span><a href="#"><i class="fa fa-facebook-square"></i> Facebook</a></span>
                                    <span><a href="#"><i class="fa fa-twitter-square"></i> Twitter</a></span>
                                    <span><a href="#"><i class="fa fa-linkedin-square"></i> Linkedin</a></span>
                                    <span><a href="#"><i class="fa fa-google-plus-square"></i> Google Plus</a></span>
                                </li>
                            </ul>
                        </div>

                        <h3>Inquire about this property</h3>
                        <form action="#">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="Your Name">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="Phone">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="email" placeholder="Email">
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea placeholder="Hello, I am interested in [Sigle Family Home]..."></textarea>
                                    </div>
                                    <input type="submit" value="Request Info">
                                </div>
                            </div>
                        </form>
                    </div><!-- End Property Contact Info -->
                </div><!-- End property details -->
            </div>
        </div><!-- End container -->
    </section>
@endsection

@section('footer')
    @include('public.layouts.footer')
@endsection
