@extends('public.layouts.master')

@section('head')
    <head>
        <title>{{ $space->name }}</title>

        @include('public.layouts.styles')
        <link href="{{ asset('/css/stars_review.css') }}" rel="stylesheet" type="text/css" />

        <meta id="token" name="csrf-token" content="{{ csrf_token() }}">

        <script>
            var component = {
                stripeKey: "{{ config('services.stripe.key') }}"
            };
        </script>
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
                        <h2>{{ $space->name }}</h2>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a class="active" href="{{ route('home_page') }}">Home</a></li>
                            <li><a href="#description">{{ trans('management.description') }}</a></li>
                            <li><a href="#location">{{ trans('management.location') }}</a></li>
                            <li><a href="#amenities">{{ trans('management.amenities') }}</a></li>
                            <li><a href="#price_table">{{ trans('management.prices_table') }}</a></li>
                            <li><a href="#timetable">{{ trans('management.timetable') }}</a></li>
                            <li><a href="#bookings">{{ trans_choice('management.booking', 2) }}</a></li>
                            <li><a href="#space_reviews">{{ trans_choice('management_spaces.space_review', 2) }}</a></li>
                            <li><a href="#contact">{{ trans('management.contact') }}</a></li>
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
                <div class="container">
                    <div class="col-sm-8">

                        @php
                            use Illuminate\Foundation\Auth\User;

                            $space_avg = \App\Models\Space::get_space_review_avg($space->id);
                            try {
                                $user_id = Auth::user()->id;
                                $user = User::find($user_id);
                            } catch (Exception $exception) {
                                $user_id = null;
                            }
                        @endphp

                        @if($space_avg != null)
                            <h2 class="padding-bottom-7">Rating: {{ round($space_avg, 1) }} <small>/ 5</small></h2>
                        @endif

                        <div class="property-name">
                            <h2>
                                <span>{{ $space->space_type->space_type }}</span>
                                <span>{{ $space->business_vertical->name }}</span>
                            </h2>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="property-price">
                            @if($currency != null)
                                @foreach($space->space_price_plans()->where('active', '=', 1)->orderBy('payment_plan_type_id')->get() as $space_price_plan)
                                    <h4>{{ $space_price_plan->price . $currency->symbol .'/' . trans('management.price_' . $space_price_plan->payment_plan_type->plan) . ' ' }}</h4>
                                @endforeach
                            @else
                                @foreach($space->space_price_plans()->where('active', '=', 1)->orderBy('payment_plan_type_id')->get() as $space_price_plan)
                                    <h4>{{ $space_price_plan->price .'/' . trans('management.price_' . $space_price_plan->payment_plan_type->plan) . ' ' }}</h4>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            @if(count($space->space_photos()->get()) > 0)
                <!-- =========================
                   Intro Carousel
                ============================== -->
                    <section class="intro-carousel wow fadeIn container">
                        <div class="container-fluid padding-fix">
                            <div id="intro-carousel-inner" class="carousel slide carousel-fade" data-ride="carousel">
                                <div class="carousel-inner">
                                    @php
                                        $active = true;
                                    @endphp
                                    @foreach($space->space_photos()->get() as $space_photo)
                                        @if($active)
                                            <div class="item active">
                                                <img src="{{ Storage::url($space_photo->path) }}" alt="{{ $space_photo->id }}">
                                            </div>
                                            @php
                                                $active = false;
                                            @endphp
                                        @else
                                            <div class="item">
                                                <img src="{{ Storage::url($space_photo->path) }}" alt="{{ $space_photo->id }}">
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                                <a class="left carousel-control" href="#intro-carousel-inner" data-slide="prev"><span><i class="fa fa-angle-left"></i></span></a>
                                <a class="right carousel-control" href="#intro-carousel-inner" data-slide="next"><span><i class="fa fa-angle-right"></i></span></a>
                            </div>
                        </div>
                    </section>
                @endif

                <div class="col-sm-12 single-property-details">
                    <div id="description" class="property-description">
                        <h2 class="pd-title">{{ trans('management.description') }}</h2>
                        <p>{!! $space->description !!}</p>
                    </div><!-- End Property Description -->


                    <div id="location" class="property-location">
                        <h2 class="pd-title">{{ trans('management.location') }}</h2>
                        <div class="row">
                            <div class="col-sm-4">
                                <ul>
                                    <li><strong>{{ trans('management.address') . ': '}}</strong><span id="street_number"></span><span id="route"></span></li>
                                    <li><strong>{{ trans('management.zip_code') . ': '}}</strong><span id="zip_code"></span></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul>
                                    <li><strong>{{ trans('management.city') . ': ' }}</strong><span id="city"></span></li>
                                    <li><strong>{{ trans('management.county') . ': '}}</strong><span id="county"></span></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul>
                                    <li><strong>{{ trans('management.state') . ': '}}</strong><span id="state"></span></li>
                                    <li><strong>{{ trans('management.country') . ': '}}</strong><span id="country"></span></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul>
                                    <li><strong>{{ trans('management.coordinates_gps') . ': '}}</strong><span id="coordinates_gps">{{ $space->latitude . ',' . $space->longitude }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- End Property Location -->

                    <!-- =========================
                        Google Map
                        ============================== -->
                    <section class="google-map">
                        <div class="container-fluid padding-fix wow fadeInUp">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="property-map"></div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div id="amenities" class="property-details-list">
                        <h2 class="pd-title">{{ trans('management.details') }}</h2>
                        <div class="alert alert-success">
                            <ul class="list-details">
                                <li><strong>{{ trans('management.id') . ': '}}</strong>{{ ' ' . $space->id }}</li>
                                <li><strong>{{ trans_choice('management_spaces.space_type', 1) . ': '}}</strong>{{ ' ' . $space->space_type->space_type }}</li>
                                <li><strong>{{ trans_choice('management_spaces.business_vertical', 1) . ': '}}</strong>{{ ' ' . $space->business_vertical->name }}</li>
                                <li><strong>{{ trans('management_spaces.capacity') . ': '}}</strong>{{ ' ' . $space->capacity }}</li>
                                @if($space->website != null)
                                    <li><strong>{{ trans('management_spaces.website') . ': '}}</strong><a href="{{ $space->website }}">{{ ' ' . $space->website }}</a></li>
                                @endif
                                <li><strong>Uploaded At:</strong>{{ ' ' . $space->created_at }}</li>
                            </ul>
                        </div>
                    </div><!-- End Property details List -->

                    <div id="space_extras_generic" class="property-features">
                        <h2 class="pd-title">{{ trans('management.amenities') }}</h2>
                        <ul class="list-features">
                            @forelse($space->space_extras()->get() as $space_extra)
                                <li><i class="fa fa-check"></i>{{' '. $space_extra->space_extras_generic->name}}</li>
                            @empty
                                <li><i class="fa fa-close"></i>{{ trans('management.empty_records') }}</li>
                            @endforelse
                        </ul>
                    </div><!-- End Property Featues -->

                    <div id="price_table" class="property-details-list">
                        <h2 class="pd-title">{{ trans('management.prices_table') }}</h2>
                        <div>
                            @if($currency != null)
                                @foreach($space->space_price_plans()->where('active', '=', 1)->orderBy('payment_plan_type_id')->get() as $space_price_plan)
                                    <h5><strong class="text-uppercase">{{ trans('management.price_' . $space_price_plan->payment_plan_type->plan) . ':' }}</strong>{{ ' ' . $space_price_plan->price . $currency->symbol }}</h5>
                                @endforeach
                            @else
                                @foreach($space->space_price_plans()->where('active', '=', 1)->orderBy('payment_plan_type_id')->get() as $space_price_plan)
                                    <h5><strong class="text-uppercase">{{ trans('management.price_' . $space_price_plan->payment_plan_type->plan) . ':' }}</strong>{{ ' ' . $space_price_plan->price }}</h5>
                                @endforeach
                            @endif

                        </div>
                    </div><!-- End Property details List -->

                    <div id="timetable" class="property-details-list">
                        <h2 class="pd-title">{{ trans('management.timetable') }}</h2>
                        <div>
                            @php
                                $space_availabilties = $space->space_availabilties()->get();
                            @endphp
                            @foreach($space_availabilties as $space_availabilty)
                                <h5><strong class="text-uppercase">{{ trans('management.' . $space_availabilty->day_week) . ':' }}</strong>{{ ' ' . $space_availabilty->opening_hour . 'h ' . trans('management.to') . ' ' . $space_availabilty->closing_hour . 'h'}}</h5>
                            @endforeach
                        </div>
                    </div><!-- End Property details List -->

                    <div id="bookings" class="property-details-list">
                        <h2 class="pd-title">{{ trans_choice('management.booking', 2) }}</h2>

                        @if($space->active)
                            @if(\Illuminate\Support\Facades\Auth::user() != null)
                                @if($currency != null)
                                    <div id="app">
                                        <book-form :space_availabilties="{{ $space_availabilties }}" :user="{{ $user }}" :currency="{{ $currency }}" :space="{{ $space }}" :space_price_plans="{{ \App\Models\Space::getSpacePricePlansDetails($space->id) }}"></book-form>
                                    </div>
                                @else
                                    <div class="panel-body text-center">
                                        <div class="alert alert-danger">
                                            {{ trans('management.country_empty_currency') }}
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="panel-body text-center">
                                    <div class="alert alert-danger">
                                        {{ trans('auth.authenticate') }}
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="panel-body text-center">
                                <div class="alert alert-danger">
                                    {{ trans('management_spaces.space_disabled_msg') }}
                                </div>
                            </div>
                        @endif
                    </div><!-- End Property details List -->


                    @if($space_avg != null)
                        <div id="space_reviews" class="property-description">
                            <div class="row">
                                <div class="review-block rating_overview">
                                    <div class="row ">
                                        <div class="col-sm-4">
                                            <div class="rating-block">
                                                <h4>{{ trans('management.average_rating') }}</h4>
                                                <h2 class="bold padding-bottom-7">{{ round($space_avg, 1) }}<small>/ 5</small></h2>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="rating-block">
                                                <h4>{{ trans('management.graphic_rating') }}</h4>

                                                @php
                                                    $colours = array('success', 'primary', 'info', 'warning', 'danger')
                                                @endphp


                                                @for($i = 5; $i > 0; $i--)
                                                    <div class="level_rating_div">
                                                        <div class="level_rating">{{ $i . ' '}}<span class="glyphicon glyphicon-star"></span></div>
                                                        <div class="progress level_rating_bar_div">
                                                            <div class="progress-bar progress-bar-{{ $colours[$i - 1] }}" role="progressbar" style="width: {{ \App\Models\Space::get_percentage_reviews_by_level($space->id, $i) }}%">
                                                            </div>
                                                        </div>
                                                        <div class="level_rating_count">{{ \App\Models\Space::get_number_reviews_by_level($space->id, $i) }}</div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (Session::has('message'))
                                <div class="row alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="row alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif

                            @php
                                $space_reviews = $space->space_reviews()->orderBy('commented_at', 'desc')->paginate(5);
                            @endphp

                            @foreach($space->space_reviews()->orderBy('commented_at', 'desc')->paginate(5) as $space_review)
                                <div class="row">
                                    <div class="review-block{{ $user_id == $space_review->user_id ? ' my_review' : '' }}">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                                                <div class="review-block-name"><a href="#">{{ $space_review->user->first_name . ' ' . $space_review->user->last_name }}</a></div>
                                                @php
                                                    \Carbon\Carbon::setLocale(Config::get('app.locale'));
                                                @endphp
                                                <div class="review-block-date">{{ $space_review->commented_at }}<br/>{{ $space_review->commented_at->diffForHumans() }}</div>
                                            </div>
                                            <div class="col-sm-10">

                                                <div class="review-block-rate">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($space_review->rating >= $i)
                                                            <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                            </button>
                                                        @endif
                                                    @endfor
                                                </div>
                                                @if($user_id == $space_review->user_id)
                                                    <div class="actions-comment">
                                                        <i id="edit_review" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        <i id="delete_review" class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </div>
                                                @endif


                                                <div id="{{ $user_id == $space_review->user_id ? 'my_review' : '' }}" class="review-block-title">{{ $space_review->comment }}</div>

                                                @if($user_id == $space_review->user_id)
                                                    <form class="collapse" action="{{ route('space_reviews.destroy', $space_review) }}" method="POST">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}

                                                        <button id="destroy_review" type="submit"></button>
                                                    </form>

                                                    {!! Form::open(['id' => 'edit_review_form', 'class' => 'form-horizontal collapse', 'role' => 'form', 'method' => 'PUT', 'route' => ['space_reviews.update', $space_review->id]]) !!}
                                                    {{ csrf_field() }}


                                                    <input name="space_id" type="hidden" value="{{ $space->id }}">
                                                    <input id="rating" name="rating" type="hidden" value="{{ $space_review->rating }}">
                                                    <textarea name="comment" class="form-control text_height">{{ $space_review->comment }}</textarea>

                                                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                                        @if ($errors->has('comment'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('comment') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="text-right">
                                                        <div class="stars starrr" data-rating="0"></div>
                                                        <button class="btn btn-success btn-sm" id="submit_review" type="submit">{{ trans('management.send') }}</button>
                                                    </div>

                                                    {!! Form::close() !!}
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-center padding-bottom-text">
                                @php
                                    $link_limit = 5;
                                @endphp

                                @if ($space_reviews->lastPage() > 1)
                                    <ul class="pagination">
                                        <li class="{{ ($space_reviews->currentPage() == 1) ? ' disabled' : '' }}">
                                            <a href="{{ $space_reviews->url(1) . '#space_reviews'  }}">{{ trans('pagination.first') }}</a>
                                        </li>
                                        @for ($i = 1; $i <= $space_reviews->lastPage(); $i++)
                                            <?php
                                            $half_total_links = floor($link_limit / 2);
                                            $from = $space_reviews->currentPage() - $half_total_links;
                                            $to = $space_reviews->currentPage() + $half_total_links;
                                            if ($space_reviews->currentPage() < $half_total_links) {
                                                $to += $half_total_links - $space_reviews->currentPage();
                                            }
                                            if ($space_reviews->lastPage() - $space_reviews->currentPage() < $half_total_links) {
                                                $from -= $half_total_links - ($space_reviews->lastPage() - $space_reviews->currentPage()) - 1;
                                            }
                                            ?>
                                            @if ($from < $i && $i < $to)
                                                <li class="{{ ($space_reviews->currentPage() == $i) ? ' active' : '' }}">
                                                    <a href="{{ $space_reviews->url($i) . '#space_reviews' }}">{{ $i }}</a>
                                                </li>
                                            @endif
                                        @endfor
                                        <li class="{{ ($space_reviews->currentPage() == $space_reviews->lastPage()) ? ' disabled' : '' }}">
                                            <a href="{{ $space_reviews->url($space_reviews->lastPage()) . '#space_reviews' }}">{{ trans('pagination.last') }}</a>
                                        </li>
                                    </ul>
                                @endif
                            </div>

                            @if($user_id != null)
                                <div class="row">
                                    <div class="review-block">
                                        <h4 class="text-center padding-bottom-text">{{ trans('management.leave_review') }}</h4>
                                        <div class="text-center">
                                            <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">{{ trans('management.send') . ' ' . trans('management.review') }}</a>
                                        </div>

                                        <div class="row collapse" id="post-review-box">
                                            <div class="col-md-12">
                                                <form accept-charset="UTF-8" action="{{ route('space_reviews.store') }}" method="POST">
                                                    {{ csrf_field() }}

                                                    <input name="space_id" type="hidden" value="{{ $space->id }}">
                                                    <input id="rating" name="rating" type="hidden" value="{{ old('rating') }}">
                                                    <textarea class="form-control animated" id="comment" name="comment" required>{{ old('comment') }}</textarea>

                                                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                                        @if ($errors->has('comment'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('comment') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="text-right">
                                                        <div class="stars starrr" data-rating="0"></div>
                                                        <button class="btn btn-danger btn-sm" id="close-review-box">{{ trans('management.cancel') }}</button>
                                                        <button class="btn btn-success btn-sm" id="submit_review" type="submit">{{ trans('management.send') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <a href="{{ route('login') }}"><h4 class="text-center padding-bottom-text">{{ trans('management.auth_review') }}</h4></a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div id="space_reviews" class="property-description">
                            @if($user_id != null)
                                <div class="row">
                                    <div class="review-block">
                                        <h4 class="text-center padding-bottom-text">{{ trans('management.no_views_msg') }}</h4>
                                        <div class="text-center">
                                            <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">{{ trans('management.send') . ' ' . trans('management.review') }}</a>
                                        </div>

                                        <div class="row collapse" id="post-review-box">
                                            <div class="col-md-12">
                                                <form accept-charset="UTF-8" action="{{ route('space_reviews.store') }}" method="POST">
                                                    {{ csrf_field() }}

                                                    <input name="space_id" type="hidden" value="{{ $space->id }}">
                                                    <input id="rating" name="rating" type="hidden" value="{{ old('rating') }}">
                                                    <textarea class="form-control animated" id="comment" name="comment" required>{{ old('comment') }}</textarea>

                                                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                                        @if ($errors->has('comment'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('comment') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="text-right">
                                                        <div class="stars starrr" data-rating="0"></div>
                                                        <button class="btn btn-danger btn-sm collapse" id="close-review-box">{{ trans('management.cancel') }}</button>
                                                        <button class="btn btn-success btn-sm" id="submit_review" type="submit">{{ trans('management.send') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login') }}"><h4 class="text-center padding-bottom-text">{{ trans('management.auth_review') }}</h4></a>
                            @endif
                        </div>
                    @endif

                    <div id="contact" class="property-contact-info">
                        <h2 class="pd-title">{{ trans('management.contact_info') }}</h2>
                        <div class="agent-media clearfix">
                            <img src="images/women-agent-2.jpg" alt="" class="pull-left" />
                            <ul>
                                <li>{{ trans_choice('management_spaces.space_manager', 1) }}</li>
                                <li><i class="fa fa-user"></i>{{ ' ' . $space->user->first_name . ' ' . $space->user->last_name }}</li>
                                <li><i class="fa fa-phone"></i>{{ $space->telephone_number }}</li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i>{{ $space->user->email }}</li>
                                <li>
                                    @if($space->user->facebook_profile != null)
                                        <span><a href="{{ 'https://www.facebook.com/' . $space->user->facebook_profile }}"><i class="fa fa-facebook-square"></i> Facebook</a></span>
                                    @endif

                                    @if($space->user->linkedin_profile != null)
                                        <span><a href="{{ 'https://pt.linkedin.com/in/' . $space->user->linkedin_profile }}"><i class="fa fa-facebook-square"></i> Facebook</a></span>
                                    @endif
                                </li>
                            </ul>
                        </div>

                        <h3>{{ trans('management.send_message_manager') }}</h3>
                        <form method="POST" action="{{ route('spaces.sendEmail', ['id' => $space->id]) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if (\Illuminate\Support\Facades\Session::has('message_request'))
                                            <div class="alert alert-success">{{ \Illuminate\Support\Facades\Session::get('message_request') }}</div>
                                        @elseif(\Illuminate\Support\Facades\Session::has('message_request_error'))
                                            <div class="alert alert-danger">{{ \Illuminate\Support\Facades\Session::get('message_request_error') }}</div>
                                        @endif

                                        <textarea name="description" required></textarea>

                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <input type="submit" value="{{ trans('management.send') }}">
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

@section('google-maps-scripts')
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    @include('public.layouts.google-maps-scripts')
    <script src="{{ asset('/js/google-map-space-details.js') }}"></script>
    <script src="{{ asset('/js/space_reviews.js') }}"></script>
@endsection
