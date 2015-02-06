<html>
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title>{{Config::get('globals.admintitle');}} - {{$title or ''}}</title>
        {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600&subset=latin')}}
        {{ HTML::style('css/bootstrap.min.css'); }}
        {{ HTML::style('css/font-awesome.min.css'); }}
        {{ HTML::style('css/animate.css'); }}
        {{ HTML::style('css/divide-admin.login.css'); }}
    </head>
    <body>
        <div class="container animated flipInX">
            <div class="login-container">
                @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
                @endif
                <div class="avatar animated" style="visibility: hidden"></div>
                <div class="form-box">
                    {{Form::open(array('url' => URL::route('admin.bejelentkezes'),'class'=>'form-horizontal form-login','method'=>'POST'))}}

                    {{Form::input('text','email','',array('class'=>'form-control','Placeholder'=>'Email'))}}
                    {{Form::input('password','password','',array('class'=>'form-control','Placeholder'=>'Jelszó'))}}
                    {{Form::button('Bejelentkezés',array('class'=>'btn btn-divide btn-block btn-login','type'=>'submit'))}}

                    {{Form::close()}}
                </div>
            </div>

            <p class="text-center text-muted"><small>{{date('Y')}} © {{HTML::link('http://divide.hu','Divide-Expo Kft.',array('target'=>'_blank'),array())}}</small></p>

        </div>


        {{ HTML::script('js/jquery-2.1.1.min.js'); }}
        {{ HTML::script('js/bootstrap.min.js'); }}
        {{ HTML::script('js/divide-admin.login.js'); }}
    </body>

</html>