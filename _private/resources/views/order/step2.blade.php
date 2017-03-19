@extends('layouts.app')
@section('content')
    <h2>{{ trans('app.slogan') }}</h2>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('partials.nav_steps')
        </div>
    </div>
    {!! Form::open(['route' => 'step2', 'class' => 'form']) !!}
    @include('partials.forms._hidden_fields')
    <div class="row cars" data-direction="0">
        @foreach($cars as $car)
            @include('partials.forms.step2_forCars', ['direction' => 0])
        @endforeach
    </div>
    <HR>
    <div class="row">
        @include('partials.forms._isset_back')
    </div>
    @if(old('ride_back'))
        <div class="row cars" data-direction="1">
            @foreach($cars as $car)
                @include('partials.forms.step2_forCars', ['direction' => 1])
            @endforeach
        </div>
    @endif
    <HR>
    <div class="row">
        <div class="col-md-12">
            {{ trans('app.car_some_text') }}
        </div>
    </div>
    <div class="form-group">
        {!! Form::submit( trans('app.continue'), ['class'=>'btn btn-primary', 'name' => 'continue']) !!}
        {!! Form::submit( trans('app.back'), ['class'=>'btn btn-primary', 'name' => 'back']) !!}
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
        });
        $(function () {
            $('input[type="radio"]').on('change', function () {
//
            });
        });
    </script>
@endsection