<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>{{Config::get('globals.admintitle');}} - {{$title or ''}}</title>

    {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600&subset=latin')}}
    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('css/divide-admin.min.css'); }}
</head>
<body class="skin-black">

@include('_backend.header')
<aside class="right-side">
    @yield('content')
</aside>
@include('_backend.footer')

{{ HTML::script('js/jquery-2.1.1.min.js'); }}
{{ HTML::script('js/bootstrap.min.js'); }}
{{ HTML::script('js/plugins/admin-lte.js'); }}
{{ HTML::script('js/plugins/summernote.min.js'); }}
{{ HTML::script('js/plugins/summernote-hu-HU.js'); }}
{{ HTML::script('js/plugins/jquery.tablesorter.min.js'); }}
{{ HTML::script('js/plugins/jquery.tablesorter.pager.min.js'); }}
{{ HTML::script('js/plugins/jquery.tablesorter.widgets.min.js'); }}
{{ HTML::script('js/plugins/metisMenu.js'); }}
{{ HTML::script('js/plugins/alertify.min.js'); }}
{{ HTML::script('js/plugins/bootstrap-switch.min.js'); }}
{{ HTML::script('js/plugins/bootstrap-tagsinput.min.js'); }}
{{ HTML::script('js/plugins/jquery.datetimepicker.js'); }}
{{ HTML::script('ckeditor/ckeditor.js'); }}
{{ HTML::script('ckeditor/adapters/jquery.js'); }}
{{ HTML::script('js/divide-admin.js'); }}
</body>
</html>
