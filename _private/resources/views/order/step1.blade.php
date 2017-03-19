@extends('layouts.app')
@section('content')
    <h2>{{ trans('app.slogan') }}</h2>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                @include('partials.nav_steps')
        </div>
    </div>

    {!! Form::open(['route' => 'step1', 'class' => 'form']) !!}

    <div class="row">
        <div class="col-md-4">
            {{ trans('app.from') }}
            {{ Form::select('route_from[0]', [0=>''] + $routes->toArray(), old('route_from'), ['class' => 'select2'] ) }}
        </div>
        <div class="col-md-4">
            {{ trans('app.to') }}
            {{ Form::select('route_to[0]', [0=>''] + $routes->toArray(), old('route_to'), ['class' => 'select2'] ) }}
        </div>
        <div class="col-md-4">
            {{ trans('app.date') }}
            <div class="input-date input-group">
                {!! Form::text('pick_date[0]', old('pick_date'),
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
            <div class="time input-group" id='timepicker' data-date-format="HH:mm"
                 data-date-useseconds="false"
                 data-date-pickDate="false">
                {!! Form::text('pick_time[0]', old('pick_time'),
                ['class' => 'form-control',
                'placeholder' => 'HH:mm']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            {{ trans('app.passengers') }}
            {!! Form::text('passengers[0]', old('passengers'),
                ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {{ trans('app.baby') }}
            {!! Form::text('passengers_baby[0]', old('passengers_baby'),
                ['class' => 'form-control']) !!}
        </div>
    </div>
    <HR>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ trans('app.order_back') }}
                {!! Form::checkbox('ride_back', old('ride_back'), old('ride_back') ) !!}

            </div>
        </div>
    </div>
    <div class="row ride_back" {!! (!old('ride_back') ? 'style="display: none;"' : '')  !!}>
        <div class="col-md-4">
            {{ trans('app.from') }}
            {{ Form::select('route_from[1]', [0=>''] + $routes->toArray(), old('route_from[1]'), ['class' => 'select2 back'] ) }}
        </div>
        <div class="col-md-4">
            {{ trans('app.to') }}
            {{ Form::select('route_to[1]', [0=>''] + $routes->toArray(), old('route_to[1]'), ['class' => 'select2 back'] ) }}
        </div>
        <div class="col-md-4">
            {{ trans('app.date') }}
            <div class="input-date input-group">
                {!! Form::text('pick_date[1]', old('pick_date[1]'),
                ['class' => 'form-control back',
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
    <div class="row ride_back" {!! (!old('ride_back') ? 'style="display: none;"' : '') !!}>
        <div class="col-md-4">
            {{ trans('app.time') }}
            <div class="input-group time" id='timepicker_back' data-date-format="HH:mm"
                 data-date-useseconds="false"
                 data-date-pickDate="false">
                {!! Form::text('pick_time[1]', old('pick_time[1]'),
                ['class' => 'form-control back',
                'placeholder' => 'HH:mm']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            {{ trans('app.passengers') }}
            {!! Form::text('passengers[1]', old('passengers[1]'),
                ['class' => 'form-control back']) !!}
        </div>
        <div class="col-md-4">
            {{ trans('app.baby') }}
            {!! Form::text('passengers_baby[1]', old('passengers_baby[1]'),
                ['class' => 'form-control back']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::submit( trans('app.continue'), ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('.input-date').datetimepicker({
            });
            $('#timepicker').datetimepicker({
                format: 'HH:mm'
            });
            $('#timepicker_back').datetimepicker({
                format: 'HH:mm'
            });
        });

        $(function () {
            $('input[name="ride_back"]').on('change',function () {
                if ($(this).prop('checked')) {
                    $('.ride_back').show();
                }
                else {
                    $('.ride_back').hide();
                }
            })
        })
    </script>
@endsection