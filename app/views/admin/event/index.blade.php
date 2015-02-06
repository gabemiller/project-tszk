@extend('_backend.master')
@section('content')
<section class="content-header">
    <h1>Események</h1>
    {{HTML::decode(Breadcrumbs::render('admin.esemeny.index'))}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-solid">
                <div class="box-body">
                    {{HTML::link('admin/esemeny/create','Új esemény',array('class'=>'btn btn-divide btn-sm'))}}
                    {{Form::button('Törlés',array('type'=>'button','class'=>'btn btn-danger btn-sm','id'=>'deleteButton'))}}
                </div>
            </div>

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Események</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table-sortable">
                            <thead>
                                <tr>
                                    <th class="table-col-xs sorter-false filter-false"><input type="checkbox" id="checkAll"></th>
                                    <th class="table-col-xs">Az</th>
                                    <th>Cím</th>
                                    <th>Kezdés</th>
                                    <th>Vége</th>
                                    <th class="table-col-xs sorter-false filter-false">Beállítások</th>
                                </tr>           
                            </thead>
                            <tbody>
                                @each('admin.event.single',$events,'event','admin.event.empty')
                            </tbody>
                            @include('_backend.table-footer')
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@stop