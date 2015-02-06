@extends('_frontend.master')

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('fooldal')) }}
@stop

@section('content')


    <div class="row">
        <div class="col-xs-4">
            <img class="img-responsive"
                 src="{{URl::route('kep.show',['url'=>urlencode('assets/krisztus.jpg'),'width'=>400,'height'=>400]) }}"
                 alt="Jézus Krisztus"
                 title="Jézus Krisztus"/>
            <ul class="list-unstyled mainpage-menu">
                <li>{{HTML::link('#','Az Egyház életmentő állomás')}}</li>
                <li>{{HTML::link('#','Keresztény élet erőforrásai')}}</li>
                <li>{{HTML::link('#','Katekézis')}}</li>
                <li>{{HTML::link('#','Jelentkezés keresztelőre, esküvőre')}}</li>
                <li>{{HTML::link('#','Nélkülözők megsegítése')}}</li>
                <li>{{HTML::link('#','Támogatóink')}}</li>
            </ul>
        </div>
        <div class="col-xs-8">
            <div class="row">
                @foreach($articles as $article)
                    <div class="col-xs-6">
                        <div class="articles">
                            @if(count($article->gallery) && count($article->gallery->pictures))
                                <img class="img-responsive"
                                     src="{{URl::route('kep.show',['url'=>urlencode($article->gallery->pictures[0]->picture_path),'width'=>300,'height'=>200]) }}"
                                     alt="{{$article->gallery->pictures[0]->name}}"
                                     title="{{$article->gallery->pictures[0]->name}}"/>
                            @endif
                            <h4>{{HTML::link($article->getLink(),$article->title)}}</h4>

                            <p class="text-muted">{{$article->getCreatedAt()}}</p>

                            <div class="article-content-short">{{$article->content}}</div>
                            {{HTML::linkRoute('hirek.show','Bővebben',array('id'=>$article->id,'title'=>\Str::slug($article->title)),array('class'=>'btn btn-sm btn-more'))}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <div class="mainpage-divider">
                <h3>Olvasd naponta a Szentírást!</h3>
                <hr>
            </div>


            <div class="quote-carousel owl-carousel">

                <div class="text-center">
                    <i class="fa fa-quote-left fa-4x quote-icon"></i>

                    <p class="qoute-text">Mennyei hazánkból kaptunk levelet. Ez a Szentírás, amely megtanít minket, hogy jó életet
                        éljünk.</p>

                    <p class="qoute-author">- Szent Ágoston</p>
                </div>

                <div class="text-center">
                    <i class="fa fa-quote-left fa-4x quote-icon"></i>

                    <p class="quote-text">Az ember akkor van a legjobb állapotában, ha az életét úgy éli meg, mintegy utazás az örök élet
                        felé és ehhez igazítja teljesen érzelmeit</p>

                    <p class="qoute-author">- Szent Ágoston</p>
                </div>

            </div>
        </div>
    </div>

@stop