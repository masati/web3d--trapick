@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.registration') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), '/registration') }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.first_name') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.surname') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('last_name', old('last_name'), ['class' => 'form-control']) !!}

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.position') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('job_title', old('job_title'), ['class' => 'form-control']) !!}

                                @if ($errors->has('job_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('institution') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.institution') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('institution', old('institution'), ['class' => 'form-control']) !!}

                                @if ($errors->has('institution'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('institution') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.city') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('city', old('city'), ['class' => 'form-control']) !!}

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.country') }}</label>
                            <div class="col-md-6">
                                {!! Form::select('country_id', \App\Models\Country::all()->pluck('name', 'id'), old('country_id'), ['class' => 'form-control'] ) !!}

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{$errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.email') }}</label>

                            <div class="col-md-6">
                                {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.confirm_password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('shared') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.permission') }}</label>
                            <div class="col-md-1">
                                <input type="checkbox" class="form-control" name="shared" value="1">


                            </div>
                            <div class="col-md-5">
                                @if ($errors->has('shared'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shared') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('date_course') ? ' has-error' : '' }}">
                            <label class="col-md-6 control-label">{{ trans('app.completed') }}I completed the 4HQ course on </label>
                            <div class="col-md-3">
                                <div class="input-date input-group">
                                    {!! Form::text('course_date', old('date_course'),
                                    ['class' => 'form-control',
                                    'placeholder' => 'YYYY-MM-DD',
                                    'data-date-pickdate' => 'true',
                                    'data-date-picktime' => 'false',
                                    'data-date-useseconds' => 'false',
                                    'data-date-format' => 'YYYY-MM-DD']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                @if ($errors->has('course_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Phone</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>--}}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> {{ trans('app.send') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('.input-date').datetimepicker({

            });
        });
    </script>
@endsection
