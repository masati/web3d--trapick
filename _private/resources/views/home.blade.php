@extends('layouts.app')
@section('content')
    <h2>{{ trans('app.home-title') }}</h2>

    <div>
        <div class="steps">
            <ul>
                <li>step 1</li>
                <li><i class="fa fa-tag" aria-hidden="true"></i></li>
                <li>step 3</li>
                <li>step 4</li>
                <li>step 5</li>
            </ul>
        </div>
    </div>
@endsection

