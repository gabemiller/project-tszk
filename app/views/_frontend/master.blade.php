<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns#">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">


    <link href="/assets/favicon.ico" rel="icon" type="image/x-icon"/>
    <title>{{Config::get('globals.title')}} - {{$title or ''}}</title>

    <!--[if lt IE 9]>
    {{ HTML::script('//html5shim.googlecode.com/svn/trunk/html5.js') }}
    <![endif]-->
    {{
    HTML::style('http://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,latin-ext')
    }}
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/divide.min.css') }}

</head>
<body>

@include('_frontend.lightbox')
@include('_frontend.header')
<div class="container main-container">
    <div class="row">
        <div class="col-xs-12">
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>
    <div id="gdpr_statement"></div>
</div>
@include('_frontend.footer')


{{ HTML::script('js/jquery-2.1.1.min.js'); }}
{{ HTML::script('js/bootstrap.min.js'); }}
{{ HTML::script('js/divide.min.js'); }}

<script>$(function(){ $('#gdpr_statement').load('https://api.gdpreg.hu/v1/statement/7461f963-5214-46ee-9629-27eb7d79580e'); });</script>

</body>
</html>
