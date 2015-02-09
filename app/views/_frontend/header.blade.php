<header>
    <h1>{{Setting::get('site-title')}}</h1>
</header>
<nav class="main-navbar">
    <div class="container">
        <ul>
            @include('_frontend.menu', array('items' => $mainMenu->roots()))
        </ul>
    </div>
</nav>