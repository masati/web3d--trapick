<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{isset($title) ? "$title - " : ''}}Trapick</title>

    <!-- Styles -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    @if(App::getLocale() == 'he')
        <link href="/bower_components/bootstrap-rtl/dist/css/bootstrap-rtl.min.css" rel="stylesheet">
    @endif
    <link href="/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="/bower_components/ekko-lightbox/dist/ekko-lightbox.min.css" rel="stylesheet">
    <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="/bower_components/lightslider/dist/css/lightslider.min.css" rel="stylesheet">
    <link href="/css/app.css?2" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body class="{{isset($page) ? $page : ""}} {{trans('app.dir')}}">
    <header>
        @section('header')
            @include('partials._header')
        @show
    </header>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
            @yield('content')
            </div>
        </div>
    </div>
    <footer class="footer">
        @section('footer')
            @include('partials._footer')
        @show
    </footer>

    @section('bottomjs')
        <!-- JavaScripts -->
        <script src="/bower_components/jquery/dist/jquery.min.js?2"></script>
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!--script src="/bower_components/flow.js/dist/flow.min.js"></script-->
        <script src="/bower_components/Sortable/Sortable.min.js"></script>
        <script src="/bower_components/Sortable/jquery.binding.js"></script>
        <script src="/bower_components/bootbox.js/bootbox.js"></script>
        <script src="/bower_components/select2/dist/js/select2.min.js"></script>
        <script src="/bower_components/ckeditor/ckeditor.js"></script>
        <script src="/bower_components/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
        <script src="/bower_components/handlebars/handlebars.min.js"></script>
        <script src="/bower_components/jqBootstrapValidation/dist/jqBootstrapValidation-1.3.7.min.js"></script>
        <script src="/bower_components/moment/min/moment.min.js"></script>
        <script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/bower_components/lightslider/dist/js/lightslider.min.js"></script>
        <script src="/js/app.js?4"></script>

        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @show
    @yield('scripts')
</body>
</html>
