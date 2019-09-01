@extends('layouts.app')
@section('OpenGraph')

    <meta property="og:title" content="Промышленное оборудование | Ekvives | Купить в Украине"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://ekvives.com/"/>
    <meta property="og:image" content="https://ekvives.com/images/logo.png"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <meta property="og:site_name" content="Ekvives"/>
    <meta property="og:description" content="Промышленное оборудование | Ekvives | Купить в Украине"/>

@endsection
@section('content')
<!--[if IE]>
    <div class="interbet_block">
        <div class="ie_bg"   style="background-image:url({#DESIGN_URL}//img/ie10.png)">
            <div class="window_block">
                <div class="message_wrapper">
                    <div class="bottom_block">
                        <p class="bold">Ви використовуєте застарілу версію  Internet Explorer</p>
                        <p class="next_p">Щоб отримати можливість ознайомитися з сайтом, поновіть Ваш браузер</p>
                        <a href="http://browsehappy.com/" rel="nofollow">Оновити браузер</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<![endif]-->
@include('main_page.inc.slider')
@include('main_page.inc.categories')
@include('main_page.inc.news')
<div itemscope itemtype="http://schema.org/Organization" style="display: none; visibility: hidden">
    Контакты:
    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
        Адрес:
        <span itemprop="streetAddress">ул. Гната Хоткевича 8</span>
        <span itemprop="postalCode"> офис 199</span>
        <span itemprop="addressLocality">Киев</span>,
    </div>
    Телефон:<span itemprop="telephone">(044)220-05-22</span>,
    Телефон:<span itemprop="telephone">(044)599-14-78</span>,
    Телефон:<span itemprop="telephone">38(067)234-77-78</span>,
    Электронная почта: <span itemprop="email">ekvives@ekvives.com</span>
</div>
@endsection