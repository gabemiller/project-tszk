@extends('_backend.master')
@section('content')

<section class="content-header">
    <h1><i class="fa fa-dashboard"></i> Vezérlőpult</h1>
    {{ HTML::decode(Breadcrumbs::render('admin.vezerlopult')) }}
</section>

<section class="content">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$article}}</h3>
                    <p>Hírek</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-text-o"></i>
                </div>
                {{HTML::decode(HTML::linkRoute('admin.hir.index','További információ <i class="fa fa-arrow-circle-right"></i>',array(),array('class'=>'small-box-footer')))}}
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-divide">
                <div class="inner">
                    <h3>{{$event}}</h3>
                    <p>Események</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{HTML::decode(HTML::linkRoute('admin.esemeny.index','További információ <i class="fa fa-arrow-circle-right"></i>',array(),array('class'=>'small-box-footer')))}}
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$gallery}}</h3>
                    <p>Galériák</p>
                </div>
                <div class="icon">
                    <i class="fa fa-photo"></i>
                </div>
                {{HTML::decode(HTML::linkRoute('admin.galeria.index','További információ <i class="fa fa-arrow-circle-right"></i>',array(),array('class'=>'small-box-footer')))}}
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$page}}</h3>
                    <p>Oldalak</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sitemap"></i>
                </div>
                {{HTML::decode(HTML::linkRoute('admin.oldal.index','További információ <i class="fa fa-arrow-circle-right"></i>',array(),array('class'=>'small-box-footer')))}}
            </div>
        </div><!-- ./col -->
    </div>


</section>
@stop