@extends('_frontend.master')
@section('content')
    <section class="error">
        <h1>{{$code}} hiba</h1>

        <p>{{$msg}}</p>
    </section>
@stop