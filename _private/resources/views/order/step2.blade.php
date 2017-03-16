@extends('layouts.app')
@section('content')
    <h2>{{ trans('app.slogan') }}</h2>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <nav>
                <ul class="wrap">
                    <li><span {!! is_active($step, 1) !!} class="glyphicon glyphicon-pushpin" aria-hidden="true"></span></li>
                    <li><span {!! is_active($step, 2) !!} class="glyphicon glyphicon-tag" aria-hidden="true"></span></li>
                    <li><span {!! is_active($step, 3) !!} class="glyphicon glyphicon-user" aria-hidden="true"></span></li>
                    <li><span {!! is_active($step, 4) !!} class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></li>
                    <li><span {!! is_active($step, 5) !!} class="glyphicon glyphicon-ok" aria-hidden="true"></span></li>
                </ul>
            </nav>
        </div>
    </div>

    {!! Form::open(['route' => 'step2', 'class' => 'form']) !!}

    <div class="row">
        <div class="col-md-4">
            {{ trans('app.from') }}
            {{ Form::select('route_from', [0=>''] + $routes->toArray(), null, ['class' => 'select2'] ) }}
        </div>
        <div class="col-md-4">
            {{ trans('app.to') }}
            {{ Form::select('route_to', [0=>''] + $routes->toArray(), null, ['class' => 'select2'] ) }}
        </div>
        <div class="col-md-4">
            {{ trans('app.date') }}
            <div class="input-date input-group">
                {!! Form::text('pick_date', old('pick_date'),
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {{ trans('app.time') }}
            <div class="input-group date" id='timepicker'>
                {!! Form::text('pick_time', old('pick_time'),
                ['class' => 'form-control',
                'placeholder' => 'HH:MM']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            {{ trans('app.passengers') }}
            {!! Form::text('passengers', old('passengers'),
                ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {{ trans('app.baby') }}
            {!! Form::text('passengers_baby', old('passengers_baby'),
                ['class' => 'form-control']) !!}
        </div>
    </div>
    <HR>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ trans('app.order_back') }}
                {!! Form::checkbox('ride_back', 'ride_back', old('ride_back') ) !!}
            </div>
            <div class="form-group">
                {{ trans('app.order_back') }}
                {!! Form::checkbox('ride_back', 'ride_back', old('ride_back') ) !!}
            </div>
        </div>
    </div>
    <HR>
    <div class="row">
        <div class="col-md-12">
            {{ trans('app.car_some_text') }}
        </div>
    </div>
    <div class="form-group">
        {!! Form::submit( trans('app.continue'), ['class'=>'btn btn-primary']) !!}
        {!! Form::submit( trans('app.back'), ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('.input-date').datetimepicker({
            });
            $('#timepicker').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endsection