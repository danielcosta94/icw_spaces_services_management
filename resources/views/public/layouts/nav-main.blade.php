<nav class="navbar navbar-default" id="my-navbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse main-nav" id="navbar-collapse">
                    <ul class="nav navbar-nav main-menu ">
                        <li><a href="{{ route('home_page') }}">{{ trans('navigation_menu.home_page') }}</a></li>
                        <li><a href="{{ route('login') }}">{{ trans('navigation_menu.how_works') }}</a></li>
                        <li><a href="{{ route('login') }}">{{ trans('navigation_menu.help_center') }}</a></li>
                    </ul>
                    @if (Auth::guest())
                        <a class="navbar-right" href="{{ route('login') }}">{{ trans('navigation_menu.login') }}</a>
                    @else
                        <li class="dropdown">
                            <a href="{{ route('management_board') }}" class="navbar-right">
                                {{Auth::user()->first_name . ' ' . Auth::user()->last_name}} <span class="caret"></span>
                            </a>
                        </li>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- end conainer -->
</nav><!-- end navbar -->