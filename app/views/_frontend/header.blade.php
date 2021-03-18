<header>
    <h1 class="title">{{Config::get('globals.title')}}</h1>
</header>
<nav class="main-navbar">
    <div class="container">
        <ul>
            @include('_frontend.menu', array('items' => $mainMenu->roots()))
        </ul>
    </div>
</nav>
<div class="breadcrumb-container">
    <div class="container">
        @yield('breadcrumb')
    </div>
</div>