<!-- header logo: style can be found in header.less -->
<header class="header">
    {{ HTML::linkRoute('admin.vezerlopult','Divide Admin',array(),array('class'=>'logo'))}}

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle animated fadeInLeft" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navigáció</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav animated fadeInRight">

                <li>{{HTML::decode(HTML::linkRoute('fooldal','<i class="fa fa-link"></i> <span class="visible-md-inline visible-lg-inline">Főoldal</span>',array(),array('target'=>'_blank')))}}</li>
                <!--li>{{HTML::decode(HTML::link('#','<i class="fa fa-code"></i>'))}}</li-->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>{{$user->getFullName()}} <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-divide">
                            <img src="{{$user->getThumbProfilePicture()}}" class="img-circle" alt="{{$user->getFullName()}}" />
                            <p>{{$user->getFullName()}}</p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                {{HTML::linkRoute('admin.felhasznalok.felhasznalo.show','Profil',array('id'=>$user->id),array('class'=>'btn btn-default btn-flat'))}}
                            </div>
                            <div class="pull-right">
                                {{HTML::linkRoute('admin.kijelentkezes','Kijelentkezés',array(),array('class'=>'btn btn-default btn-flat'))}}
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{$user->getThumbProfilePicture()}}" class="img-circle" alt="{{$user->getFullName()}}" />
                </div>
                <div class="pull-left info">
                    <p>Szia, {{HTML::linkRoute('admin.felhasznalok.felhasznalo.show',$user->first_name,array('id'=>$user->id))}}</p>
                    {{HTML::linkRoute('admin.kijelentkezes','Kijelentkezés')}}
                </div>
            </div>
            <!-- search form -->
            <!--form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    {{-- Form::text('menuSearch','',array('placeholder'=>'Keresés...','class'=>'form-control'))--}}
                    <span class="input-group-btn">
                        {{--HTML::decode(Form::button('<i class="fa fa-search"></i>',array('class'=>'btn btn-flat','type'=>'submit')))--}}
                    </span>
                </div>
            </form-->
            <!-- /.search form -->

            {{$adminMenu->asUl(['class'=>'sidebar-menu'])}}

        </section>
        <!-- /.sidebar -->
    </aside>


