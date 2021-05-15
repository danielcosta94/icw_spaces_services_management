@extends('public.layouts.master')

@section('head')
    <head>
        <title>About Us</title>

        @include('public.layouts.styles')
    </head>
@endsection

@section('content')
    <!-- =========================
About Us Page Header
============================== -->
    <section class="header-banner about-banner-bg">
        <div class="banner-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h2>About EcoReal</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ol class="breadcrumb">
                            <li><a href="">Home</a></li>
                            <li><a class="active" href="">About Us</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-ecoreal">
        <div class="container">
            <div class="row">
                <div class="col-md-12 about-ecoreal-content">
                    <p><i class="fa fa-map-marker fa-2x"></i></p>
                    <h2>About EcoReal</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor arcu non ligula convallis, vel tincidunt ipsum posuere. Fusce sodales lacus ut pellentesque sollicitudin. Duis iaculis, arcu ut hendrerit pharetra, elit augue pulvinar magna, a consectetur eros quam eu orci. Duis lacus odio, varius tincidunt sit amet, accumsan non ex. Duis id fringilla risus. Donec ac faucibus mauris. Curabitur efficitur gravida ligula.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-documents">
        <div class="container">
            <div class="col-md-4 document-title">
                <p>Documents</p>
            </div>
            <div class="col-md-4 pdfone">
                <a href="">Energetic Certificate PDF <i class="fa fa-download"></i></a>
            </div>
            <div class="col-md-4 pdftwo">
                <a href="">Another Sample PDF <i class="fa fa-download"></i></a>
            </div>
        </div>
    </section>

    <section class="who-we-are">
        <div class="container-fluid padding-fix">
            <div class="row">
                <div class="col-md-6 padding-fix who-we-are-left">
                    <div class="who-we-are-content">
                        <span>Who We Are & What We Do</span>
                        <h2>Who We Are</h2>
                        <p>Purchasing web products from ThemeRex company means entrusting your reputation to one of the best web-studios in this area. Our team creates our themes with a thought of our customers, therefore our creative minds works hard to provide you best technical support in the whole world. </p>
                        <a href="" class="who-we-are-btn">Learn More</a>
                    </div>
                </div>
                <div class="col-md-6 padding-fix who-we-are-right"></div>
            </div>
        </div>
    </section>

    <section class="ecoreal-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Features of Eco Real</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor arcu non ligula convallis, vel tincidunt ipsum posuere. sollicitudin. Duis iaculis, arcu ut hendrerit pharetra, elit augue pulvinar magna</p>
                </div>
                <div class="col-md-4 col-sm-4 about-feature">
                    <div class="row">
                        <div class="col-md-3 feature-icon">
                            <i class="fa fa-home fa-3x"></i>
                        </div>
                        <div class="col-md-9 feature-details">
                            <h3>GOOD NEIGHBOURHOOD</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisc arcu non ligula convallis, vel tincidunt.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 about-feature">
                    <div class="row">
                        <div class="col-md-3 feature-icon">
                            <i class="fa fa-leaf fa-3x"></i>
                        </div>
                        <div class="col-md-9 feature-details">
                            <h3>IN GREEN AREA</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisc arcu non ligula convallis, vel tincidunt.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 about-feature">
                    <div class="row">
                        <div class="col-md-3 feature-icon">
                            <i class="fa fa-mobile fa-3x"></i>
                        </div>
                        <div class="col-md-9 feature-details">
                            <h3>FULLY FURNISHED</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisc arcu non ligula convallis, vel tincidunt.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 about-feature">
                    <div class="row">
                        <div class="col-md-3 feature-icon">
                            <i class="fa fa-lock fa-3x"></i>
                        </div>
                        <div class="col-md-9 feature-details">
                            <h3>STRONG CONSTRUCTION</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisc arcu non ligula convallis, vel tincidunt.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 about-feature">
                    <div class="row">
                        <div class="col-md-3 feature-icon">
                            <i class="fa fa-bars fa-3x"></i>
                        </div>
                        <div class="col-md-9 feature-details">
                            <h3>MORTGAGE AVAILABLE</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisc arcu non ligula convallis, vel tincidunt.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 about-feature">
                    <div class="row">
                        <div class="col-md-3 feature-icon">
                            <i class="fa fa-thumbs-o-up fa-3x"></i>
                        </div>
                        <div class="col-md-9 feature-details">
                            <h3>ROYAL TOUCH PAINT</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisc arcu non ligula convallis, vel tincidunt.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End eco real features -->
@endsection

@section('footer')
    @include('public.layouts.footer')
@endsection
