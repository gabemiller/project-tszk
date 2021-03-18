<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">


    <link href="/assets/favicon.ico" rel="icon" type="image/x-icon"/>
    <title>{{Config::get('globals.title')}} - {{$title or ''}}</title>

    <!--[if lt IE 9]>
    {{ HTML::script('//html5shim.googlecode.com/svn/trunk/html5.js') }}
    <![endif]-->
    {{
    HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,latin-ext')
    }}
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/divide.min.css') }}

</head>
<body class="maintaince">

<header>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <i class="fa fa-warning fa-5x"></i>
                <h2>{{Config::get('globals.title')}}</h2>
                <h2>Weboldalunk jelenleg karbantartás alatt áll.<br>Kérem látogasson vissza később!</h2>
                <img class="img-responsive" src="{{URL::to('assets/tszk.jpg')}}" alt="{{Config::get('globals.title')}}">
            </div>
        </div>
    </div>
</header>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            </div>
        </div>
    </div>

</body>
</html>