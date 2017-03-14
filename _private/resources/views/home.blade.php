@extends('layouts.app')
@section('content')
    <h2>{{ trans('app.home-title') }}</h2>

    <table class="table table-striped">
        <tbody>
            <tr class="lesson">
                    <td width="70%"><a href="#">title</a></td>
                    <td>{{trans('app.txt-by')}} <span class='pic user-male'></span> name</td>
            </tr>
        </tbody>
    </table>
@endsection

