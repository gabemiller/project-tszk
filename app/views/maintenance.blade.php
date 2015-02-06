<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">


    <link href="/assets/favicon.ico" rel="icon" type="image/x-icon"/>
    <title>{{Setting::get('site-title')}} @if(!empty($title)) {{'- '.$title }} @endif</title>

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
                <img class="no-border" src="assets/cross.svg" alt="Görögkatolikus kereszt">
                <h2>Encsi Görögkatolikus Egyházközség</h2>
                <h3>Dicsőség Jézus Krisztusnak!</h3>
                <h1>Weboldalunk hamarosan megnyitja kapuit.<br>Kérem látogasson vissza később!</h1>
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