@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>404 hiba</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-solid">
                <div class="box-body">
                    <p>Sajnos a keresett oldal nem található.</p>
                </div>
            </div>

        </div>
    </div>
</section>
@stop