@extends('public.layouts.master')

@section('head')
    <head>
        <title>{{ trans('navigation_menu.register') }}</title>

        @include('public.layouts.styles')
    </head>
@endsection

@section('content')
    <div class="container-fluid photo-gallery">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">{{ trans('navigation_menu.register') }}</div>
                    <div class="panel-body">

                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @elseif(Session::has('message-error'))
                            <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                        @endif

                        @php
                            $user_types = \App\Models\UserType::all();
                        @endphp

                        @if(count($user_types))
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">{{ trans('register.email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name" class="col-md-4 control-label">{{ trans('register.first_name') }}</label>

                                    <div class="col-md-6">
                                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name" class="col-md-4 control-label">{{ trans('register.last_name') }}</label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                                    <label for="user_type" class="col-md-4 control-label">{{ trans('register.user_type') }}</label>

                                    <div class="col-md-6">
                                        <select id="user_type" class="form-control" name="user_type" required>
                                            <option selected disabled>{{ trans('register.select_user_type') }}</option>
                                            <optgroup label="{{ trans('register.user_type_list') }}">
                                                @foreach($user_types as $user_type)
                                                    @if($user_type->user_type != 'admin')
                                                        @if (old('user_type') == $user_type->id)
                                                            <option value="{{$user_type->id}}" selected>{{$user_type->description}}</option>
                                                        @else
                                                            <option value="{{$user_type->id}}">{{$user_type->description}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        </select>

                                        @if ($errors->has('user_type'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('user_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">{{ trans('register.password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">{{ trans('register.confirm_password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">{{ trans('navigation_menu.register') }}</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p class="alert alert-danger">{{ trans('register.empty_user_types') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection