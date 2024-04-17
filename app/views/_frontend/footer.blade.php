<footer>

        <div class="container">
            <div class="row">
                 <div class="col-xs-4">
                    <h2 class="info"><strong>Telefon</strong><br>+36 (48) 423-245</h2>
                 </div>
                <div class="col-xs-4">
                    <h2 class="info"><strong>Fax</strong><br>+36 (48) 345-528</h2>
                </div>
                <div class="col-xs-4">
                    <h2 class="info"><strong>Email</strong><br>{{HTML::mailto('peteri.szocialis@gmail.com')}}</h2>
                </div>
            </div>
        </div>

        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2658.5441343913394!2d20.725215999999996!3d48.215395999999984!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473f646d5fd57e87%3A0xf4307d360d2ba435!2zS29zc3V0aCBMYWpvcyDDunQgNDAsIFNhasOzc3plbnRww6l0ZXIsIDM3NzA!5e0!3m2!1shu!2shu!4v1426066426041"
                width="100%" height="270" frameborder="0" style="border:0"></iframe>

        <div class="bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p>{{date('Y')}} © {{Config::get('globals.title')}}</p>
                    </div>
                </div>
            </div>

            {{HTML::link('http://divide.hu','Divide.hu',['class'=>'divide-bottom-logo','target'=>'_blank'])}}
        </div>
</footer>