@extends('layouts.app')
@section('content')
    <h2>{{ trans('app.slogan') }}</h2>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('partials.nav_steps')
        </div>
    </div>
    <div>
        <ul>
        @foreach($order->getAttributes() as $key => $field)
            <li>

                {{ $key }}: {{ $field }}
            </li>
        </ul>
        @endforeach

    </div>
    <div>
        <ul>
            @foreach($rides as $ride)
                @foreach($ride->getAttributes() as $key => $field)
                    <li>
                        {{ $key }}: {{ $field }}
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>

@endsection

@section('scripts')

@endsection