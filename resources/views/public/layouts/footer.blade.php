<footer class="footer">
    <div class="footer-overlay">
        <div class="container">
            <div class="footer-middle">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget">
                            <h3>Spaces and Services</h3>
                        </div><!-- end .about-us -->
                        <div class="white-links">
                            <a href="#">{{ trans('footer.search') }}</a>
                            <a href="#">{{ trans('footer.about_us') }}</a>
                            <a href="#">{{ trans('footer.terms_service') }}</a>
                            <a href="#blog">{{ trans('footer.blog') }}</a>
                            <a href="#">{{ trans('footer.carrers') }}</a>
                            <a href="#">{{ trans('footer.help_center') }}</a>
                            <a href="#">{{ trans('footer.how_works') }}</a>
                        </div>
                    </div><!-- end .col-md-3 -->

                    <div class="col-md-3 col-sm-6">
                        <div class="footer-widget">
                            <h3>{{ trans('footer.connect') }}</h3>
                        </div><!-- end .about-us -->
                        <div class="white-links">
                            <a href="#">{{ trans('footer.contact_us') }}</a>
                        </div>
                    </div><!-- end .col-md-3 -->

                    <div class="col-md-5 col-sm-6">
                        <div class="footer-widget">
                            <h3>{{ trans('footer.newsletter') }}</h3>
                        </div>

                        <p>{{ trans('footer.newsletter_msg') }}</p>

                        <form id="mc-form" class="form-horizontal" role="form" method="POST" action="#">
                            <div>
                                <input name="email" type="email" placeholder="{{ trans('register.email') }}" id="mc-email" class="form-control" required>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn_margin">{{ trans('navigation_menu.register') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div><!-- end .footer-middle -->
        </div>

        <section class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 copy-right">
                        <p>Copyright &copy; 2017 <a href="{{ route('home_page') }}">Spaces and Services</a> All rights reserved</p>
                    </div><!-- end .col-md-6 -->

                    <div class="col-md-6 col-sm-6 payment">
                        <ul class="list-unstyled list-inline">
                            <li><span>We Accept:</span></li>
                            <li><i class="fa fa-cc-paypal" aria-hidden="true"></i></li>
                            <li><i class="fa fa-cc-stripe" aria-hidden="true"></i></li>
                            <li><i class="fa fa-cc-visa" aria-hidden="true"></i></li>
                            <li><i class="fa fa-cc-mastercard" aria-hidden="true"></i></li>
                        </ul>
                    </div><!-- end .col-md-6 -->
                </div><!-- end .row -->
            </div><!-- end .containter -->
        </section>
    </div>
</footer><!-- /END FOOTER SECTION -->