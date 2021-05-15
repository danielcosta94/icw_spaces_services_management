 @extends('public.layouts.master')

@section('head')
    <head>
        <title>Sample Page</title>

        @include('public.layouts.styles')
    </head>
@endsection

@section('content')

    <!-- =========================
 Simple Page Header
============================== -->
    <section class="header-banner">
        <div class="banner-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h2>Simple Page</h2>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="">Home</a></li>
                            <li><a class="active" href="">Simple Page</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 content-page-inner-area">
                    <h2>We have added new features to DreamVilla</h2>
                    <img src="images/house-image.jpg" alt="" class="img-responsive">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa ipsum, efficitur a fermentum sed, suscipit sit amet arcu. Ut ut finibus tortor, eu ultrices turpis. Mauris vitae elit nec diam elementum elementum. Mauris ante quam, consequat ac nibh placerat, lacinia sollicitudin mi. Duis facilisis nibh quam, sit amet interdum tellus sollicitudin tempor. Curabitur aliquam erat in nisl lobortis, ut pellentesque lectus viverra. Aenean sodales aliquet arcu at aliquam. </p>
                    <p>Vestibulum quam nisi, pretium a nibh sit amet, consectetur hendrerit mi. Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum. Cras sed nunc massa. Quisque tempor dolor sit amet tellus malesu ada, malesuada iaculis eros dignissim. Aenean vitae diam id lacus fringilla maximus. Mauris auctor efficitur nisl, non blandit urna fermentum nec. Vestibulum non leo libero. </p>
                    <div class="content-list-items clearfix">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><a href="">Feature Point 1 will appear here</a></li>
                                <li><a href="">Some Poiner goes here</a></li>
                                <li><a href="">Lorem ipsum text will apprear here</a></li>
                                <li><a href="">You dont need to worry about the payment</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><a href="">Feature Point 1 will appear here</a></li>
                                <li><a href="">Some Poiner goes here</a></li>
                                <li><a href="">Lorem ipsum text will apprear here</a></li>
                                <li><a href="">You dont need to worry about the payment</a></li>
                            </ul>
                        </div>
                    </div><!-- end content list items -->
                    <blockquote class="content-inner-quote">
                        Vestibulum quam nisi, pretium a nibh sit amet, consectetur hendrerit mi. amet elit porta, et malesuada erat bibendum. Cras sed nunc massa. tellus malesuada, malesuada iaculis eros dignissim.
                    </blockquote>

                    <p>Vestibulum quam nisi, pretium a nibh sit amet, consectetur hendrerit mi. Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum. Cras sed nunc massa. Quisque tempor dolor sit amet tellus malesu ada, malesuada iaculis eros dignissim. Aenean vitae diam id lacus fringilla maximus. Mauris auctor efficitur nisl, non blandit urna fermentum nec. Vestibulum non leo libero. </p>

                    <div class="image-left-content clearfix">
                        <div class="col-md-6 padding-fix">
                            <img src="images/white-house.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                            <h3>Image on left</h3>
                            <p>Cras sed nunc massa. Quisque tempor dolor sit ame t tellus malesu ada, malesuada iaculis eros dignissim. </p>
                            <ul class="list-unstyled">
                                <li><a href="">Feature Point 1 will appear here</a></li>
                                <li><a href="">Some Poiner goes here</a></li>
                                <li><a href="">Lorem ipsum text will apprear here</a></li>
                                <li><a href="">You dont need to worry about the payment</a></li>
                            </ul>
                        </div>
                    </div><!-- end image left content -->

                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at vel it elit. In tincidunt lectus neque, non </h3>
                    <p>Vestibulum quam nisi, pretium a nibh sit amet, consectetur hendrerit mi. Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum. Cras sed nunc massa. Quisque tempor dolor sit amet tellus malesu ada, malesuada iaculis eros dignissim. Aenean vitae diam id lacus fringilla maximus. Mauris auctor efficitur nisl, non blandit urna fermentum nec. Vestibulum non leo libero. </p>

                    <div class="image-right-content clearfix">
                        <div class="col-md-6">
                            <h3>Image on left</h3>
                            <p>Cras sed nunc massa. Quisque tempor dolor sit ame t tellus malesu ada, malesuada iaculis eros dignissim. </p>
                            <ul class="list-unstyled">
                                <li><a href="">Feature Point 1 will appear here</a></li>
                                <li><a href="">Some Poiner goes here</a></li>
                                <li><a href="">Lorem ipsum text will apprear here</a></li>
                                <li><a href="">You dont need to worry about the payment</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 padding-fix">
                            <img src="images/right-side-image.jpg" alt="" class="img-responsive">
                        </div>
                    </div><!-- end image right content -->
                </div><!-- end content-page-inner-area -->

                <div class="col-md-3 blog-sidebar content-page-right-sidebar">
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
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Archieves</h3>
                        <div class="widget-content">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="">May 2016</a></li>
                                <li><a href="">Jun 2016</a></li>
                                <li><a href="">July 2016</a></li>
                                <li><a href="">August 2016</a></li>
                                <li><a href="">February 2016</a></li>
                                <li><a href="">April 2016</a></li>
                                <li><a href="">November 2016</a></li>
                            </ul>
                        </div>
                    </div><!-- Sidebar Widget Ends -->
                </div><!-- Blog Sidebar ends -->
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('public.layouts.footer')
@endsection
