<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">{{ trans('management.main_title') }}</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a class="fa fa-home fa-fw" href="{{ route('home_page') }}">{{ trans('management.home_page') }}</a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{Auth::user()->first_name . ' ' . Auth::user()->last_name}} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Sidebar -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">

            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </li>

            @php
                $id = \Illuminate\Support\Facades\Auth::user()->id;
                $user = \App\User::find($id);
            @endphp
            <!-- Admin -->
                @if ($user->user_type->user_type == 'admin')
                    <li>
                        <a href="{{ route('management_board') }}" class="active"><i class="fa fa-dashboard fa-fw"></i>{{ trans('management.admin_title') }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ trans('management.spaces_menu') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('spaces.index') }}">{{ trans_choice('management_spaces.space', 2) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('space_generic_extras.index') }}">{{ trans_choice('management_spaces.space_generic_extra', 2) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('space_types.index') }}">{{ trans_choice('management_spaces.space_type', 2) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('space_bookings.allBookingsMySpaces') }}">{{ trans_choice('management_spaces.space_bookings_all', 2) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('space_bookings.index') }}">{{ trans_choice('management_spaces.my_space_booking', 2) }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ trans('management.services_menu') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            </li>
                            <li>
                                <a href="#">{{ trans('management.list') }}<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">{{ trans('management.list_all') }}</a>
                                        <a href="#">{{ trans('management.list_non_aproved') }}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"><i class="fa fa-sitemap fa-fw"></i>{{ trans('management.users_menu') }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ trans('management.others_menu') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('action_types.index') }}">{{ trans('management.action_types') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('business_verticals.index') }}">{{ trans_choice('management.business_vertical', 2) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('countries.index') }}">{{ trans('management.countries') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('currencies.index') }}">{{ trans('management.currencies') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('distance_units.index') }}">{{ trans('management.distance_units') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('payment_plan_types.index') }}">{{ trans('management.payment_plan_types') }}</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Space Manager -->
                @elseif ($user->user_type->user_type == 'space_manager')
                    <li>
                        <a href="{{ route('management_board') }}" class="active"><i class="fa fa-dashboard fa-fw"></i>{{ trans('management.space_manager_title') }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ trans('management.spaces_menu') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('spaces.index') }}">{{ trans_choice('management_spaces.space', 2) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('space_bookings.allBookingsMySpaces') }}">{{ trans_choice('management_spaces.space_booking', 2) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('space_bookings.index') }}">{{ trans_choice('management_spaces.my_space_booking', 2) }}</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Service Manager -->
                @elseif ($user->user_type->user_type == 'service_manager')
                    <li>
                        <a href="{{ route('management_board') }}" class="active"><i class="fa fa-dashboard fa-fw"></i>{{ trans('management.service_manager_title') }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ trans('management.services_menu') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            </li>
                            <li>
                                <a href="#">{{ trans('management.list') }}<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">{{ trans('management.list_my_services') }}</a>
                                        <a href="#">{{ trans('management.list_all') }}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">{{ trans('management.list_all') }}</a>
                                <a href="#">{{ trans('management.report_review') }}</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Worker -->
                @elseif ($user->user_type->user_type == 'worker')
                    <li>
                        <a href="{{ route('management_board') }}" class="active"><i class="fa fa-dashboard fa-fw"></i>{{ trans('management.worker_title') }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ trans('management.spaces_menu') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('space_bookings.index') }}">{{ trans_choice('management_spaces.my_space_booking', 2) }}</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
