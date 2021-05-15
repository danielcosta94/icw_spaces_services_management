@extends('public.layouts.master')

@section('head')
    <head>
        <title>Blog Left Sidebar</title>

        @include('public.layouts.styles')
    </head>
@endsection

@section('content')
    <!-- =========================
 Right Sidebar Blog Template
============================== -->
    <section class="header-banner blog-banner">
        <div class="banner-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h2>Blog Posts</h2>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="">Home</a></li>
                            <li><a class="active" href="">Blog</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 blog-sidebar">
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Useful Links</h3>
                        <div class="widget-content">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="">Terms & onditions</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="">FAQ and Help</a></li>
                                <li><a href="">Mortgage Calculator</a></li>
                                <li><a href="">Tips for better living</a></li>
                                <li><a href="">Login</a></li>
                                <li><a href="">Signup</a></li>
                            </ul>
                        </div>
                    </div><!-- Sidebar Widget Ends -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Recent Properties</h3>
                        <div class="widget-content">
                            <div class="small-property-list">
                                <div class="small-property clearfix">
                                    <div class="property-small-picture col-sm-12 col-md-4">
                                        <a href="">
                                            <img src="images/small-property01.jpg" alt="" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="property-small-content col-sm-12 col-md-8">
                                        <h4><a href="">St Johns Pl</a></h4>
                                        <p><span>$ 1,800</span> / per month</p>
                                    </div>
                                </div><!-- Small Property Ends -->
                                <div class="small-property clearfix">
                                    <div class="property-small-picture col-sm-12 col-md-4">
                                        <a href="">
                                            <img src="images/small-property02.jpg" alt="" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="property-small-content col-sm-12 col-md-8">
                                        <h4><a href="">South St</a></h4>
                                        <p><span>$ 1,800</span> / per month</p>
                                    </div>
                                </div><!-- Small Property Ends -->
                                <div class="small-property clearfix">
                                    <div class="property-small-picture col-sm-12 col-md-4">
                                        <a href="">
                                            <img src="images/small-property03.jpg" alt="" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="property-small-content col-sm-12 col-md-8">
                                        <h4><a href="">Five Ave</a></h4>
                                        <p><span>$ 1,800</span> / per month</p>
                                    </div>
                                </div><!-- Small Property Ends -->
                            </div>
                        </div><!-- Widget content Ends -->
                    </div><!-- Sidebar Widget Ends -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Contact</h3>
                        <div class="widget-content">
                            <div class="address-widget">
                                <address>
                                    <strong>Example, Inc.</strong><br><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                </address>
                                <address>
                                    <abbr title="Phone">Phone:</abbr> 661-999-6483<br>
                                    <abbr title="Email">Email:</abbr> <a href="mailto:">hello@yourcompany.com</a><br>
                                    <abbr title="Skype">Skype:</abbr> (123) 456-7890<br>
                                </address>
                                <a class="btn btn-primary" href="#">Contact page</a>
                            </div>
                        </div>
                    </div><!-- Sidebar Widget Ends -->
                </div><!-- Blog Sidebar ends -->
                <div class="col-md-9 blog-posts-area">
                    <h2>Left Sidebar Blog Template</h2>
                    <div class="row blog-posts">
                        <div class="blog-single-post clearfix">
                            <div class="col-md-1 post-dates">
                                <span><i class="fa fa-calendar"></i> Aug</span>
                                <strong>27</strong>
                            </div>
                            <div class="col-md-3 post-thumbnails">
                                <a href="">
                                    <img src="images/blog-01.jpg" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="col-md-8 single-post-content">
                                <h3 class="post-title">
                                    <a href="">Aliquam risus neque, egestas aliquet</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer placerat condimentum nulla, sit amet porta lacus ultrices eget. Sed eu vehicula sapien. Donec et lorem sit amet sapien lacinia imperdiet sit amet sed lorem. Vestibulum non libero felis. Donec vulputate vel leo eu consequat. Ut in sodales sapien, nec malesuada nibh. Sed ullamcorper dui non sapien venenatis, at cursus sapien molestie.</p>
                                <a href="" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                        <div class="blog-single-post clearfix">
                            <div class="col-md-1 post-dates">
                                <span><i class="fa fa-calendar"></i> Aug</span>
                                <strong>27</strong>
                            </div>
                            <div class="col-md-3 post-thumbnails">
                                <a href="">
                                    <img src="images/blog-02.jpg" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="col-md-8 single-post-content">
                                <h3 class="post-title">
                                    <a href="">Aliquam risus neque, egestas aliquet</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer placerat condimentum nulla, sit amet porta lacus ultrices eget. Sed eu vehicula sapien. Donec et lorem sit amet sapien lacinia imperdiet sit amet sed lorem. Vestibulum non libero felis. Donec vulputate vel leo eu consequat. Ut in sodales sapien, nec malesuada nibh. Sed ullamcorper dui non sapien venenatis, at cursus sapien molestie.</p>
                                <a href="" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                        <div class="blog-single-post clearfix">
                            <div class="col-md-1 post-dates">
                                <span><i class="fa fa-calendar"></i> Aug</span>
                                <strong>27</strong>
                            </div>
                            <div class="col-md-3 post-thumbnails">
                                <a href="">
                                    <img src="images/blog-03.jpg" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="col-md-8 single-post-content">
                                <h3 class="post-title">
                                    <a href="">Aliquam risus neque, egestas aliquet</a>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer placerat condimentum nulla, sit amet porta lacus ultrices eget. Sed eu vehicula sapien. Donec et lorem sit amet sapien lacinia imperdiet sit amet sed lorem. Vestibulum non libero felis. Donec vulputate vel leo eu consequat. Ut in sodales sapien, nec malesuada nibh. Sed ullamcorper dui non sapien venenatis, at cursus sapien molestie.</p>
                                <a href="" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="center blog-pagination">
                        <ul class="list-unstyled list-inline">
                            <li><a href=""><i class="fa fa-angle-double-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="" class="active">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href="">5</a></li>
                            <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
                        </ul>
                    </div>
                </div><!-- Blog Post Area Ends -->
            </div>
        </div>
    </section><!-- Blog content ends -->
@endsection

@section('footer')
    @include('public.layouts.footer')
@endsection
