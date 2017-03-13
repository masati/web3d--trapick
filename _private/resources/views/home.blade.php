@extends('layouts.app')
@section('content')
    @include('partials._searchtabs')

    <h2>{{ trans('app.home-title') }}</h2>

    <table class="table table-striped">
        <tbody>
        @foreach( $data as $lesson )
            <tr class="lesson">
                    <?php $author = $lesson['user'];?>
                    <td width="70%"><a href="/sessions/view/{{$lesson['id']}}">{{$lesson['title']}}</a></td>
                    <td>{{trans('app.txt-by')}} <span class='pic user-male'></span> {{ $author['full_name'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

