@extends('layouts.app')
@section('meta_description')
    @if($product->meta_description)
        <meta name="description" content="{{$product->meta_description}}" />
    @endif
@endsection
@section('OpenGraph')

    @switch(request()->path())
        @case('reduktory/reduktory')
            <meta property="og:title" content="Купить редуктор и мотор-редуктор  в Киеве  - от надежного поставщика Ekvives."/>
            <meta property="og:description" content="Купить редуктор и мотор-редуктор  в Киеве по выгодным ценам от надежного поставщика Ekvives с доставкой по всей Украине."/>
            <meta property="og:type" content="website"/>
            <meta property="og:url" content="https://ekvives.com/reduktory"/>
            <meta property="og:image" content="https://ekvives.com/images/logo.png"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
            <meta property="og:site_name" content="Ekvives"/>
        @break
        @case('ventilyatory/ventilyatory')
            <meta property="og:title" content="Вентилятор вытяжной купить - промышленные центробежные вентиляторы  от надежного поставщика Ekvives."/>
            <meta property="og:description" content="Вентилятор вытяжной купить - промышленные центробежные вентиляторы по выгодным ценам от надежного поставщика Ekvives по всей Украине."/>
            <meta property="og:type" content="website"/>
            <meta property="og:url" content="https://ekvives.com/ventilyatory"/>
            <meta property="og:image" content="https://ekvives.com/images/logo.png"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
            <meta property="og:site_name" content="Ekvives"/>
        @break
        @case('pogruzchiki-spectehnika/pogruzchiki-spectehnika')
            <meta property="og:title" content="Спецтехника купить в Киеве (купить экскаваторы, погрузчики , бульдозеры) -  дорожная техника от надежного поставщика Ekvives."/>
            <meta property="og:description" content="Спецтехника купить в Киеве (купить экскаваторы, погрузчики , бульдозеры) -  дорожная техника по выгодным ценам от надежного поставщика Ekvives с доставкой по всей Украине."/>
            <meta property="og:type" content="website"/>
            <meta property="og:url" content="https://ekvives.com/pogruzchiki-spectehnika/pogruzchiki-spectehnika"/>
            <meta property="og:image" content="https://ekvives.com/images/logo.png"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
            <meta property="og:site_name" content="Ekvives"/>
        @break
        @case('generatory/generatory')
            <meta property="og:title" content="Купить генератор в Киеве - дизельный, бензогенератор, электрогенератор"/>
            <meta property="og:description" content="Купить генератор в Киеве, доступная цена. Все виды генераторов: дизельный, бензогенератор, электрогенератор..."/>
            <meta property="og:type" content="website"/>
            <meta property="og:url" content="https://ekvives.com/generatory"/>
            <meta property="og:image" content="https://ekvives.com/images/logo.png"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
            <meta property="og:site_name" content="Ekvives"/>
        @break
    @endswitch

@endsection
@section('no_index')
    @if($product->no_index)
<meta name="robots" content="noindex,nofollow"> @endif @endsection @if($product->meta_title) @section('meta_title') {{ $product->meta_title}} @endsection @endif @section('content')
@include('inc.banner', ['title' => $product->title, 'picture' => $product->getPhoto('banner', 'big')])
<section>
    <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
            <div class="col-md-9 pull-right flip sm-pull-none flexRow ">
                <!-- <div class="container pb-30"> -->
                <!-- start of main content -->
                <div class="row">
                    <div class="col-md-12 itemsCustomBlockWrap">
                        <div class="itemsPreviewGallery col-md-6">
                            <!-- preview slider start -->
                            @if($product->images)
                            <div id="slider-img-products">
                                @if($product->image)
                                <div class="s_block shadow" id="slide-main">
                                    <img class="animate1" src="{{$product->getPhoto('image', 'big')}}" title="<?=  $product->title?>">
                                </div>
                                @endif @foreach($product->images as $image)
                                <div class="s_block shadow" id="slide-{{$loop->index+1}}">
                                    <img class="animate1" src="{{$image}}" title="<?=  $product->title?>">
                                </div>
                                @endforeach
                            </div>
                            <div id="img-nav">
                                <ul>
                                    @if($product->image)
                                    <li class="slide-main">
                                        <a href="#slide-main">
                                            <img class="animate2" src="{{$product->getPhoto('image', 'min')}}" title="<?=  $product->title?>">
                                        </a>
                                    </li>
                                    @endif @foreach($product->images as $image)
                                    <li class="slide-{{$loop->index+1}}">
                                        <a href="#slide-{{$loop->index+1}}">
                                            <img class="animate2" src="{{$image}}" title="<?=  $product->title?>">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @elseif($product->image)
                            <div id="slider-img-products">
                                <div class="s_block shadow" id="slide-main">
                                    <img class="animate1" src="{{$product->getPhoto('image', 'big')}}" title="<?=  $product->title?>">
                                </div>
                            </div>
                            <div id="img-nav">
                                <ul>
                                    <li class="slide-main">
                                        <a href="#slide-main">
                                            <img class="animate2" src="{{$product->getPhoto('image', 'min')}}" title="<?=  $product->title?>">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @endif
                            <!-- preview slider end -->
                        </div>
                        <div class="col-md-6 orderFormWrap">
                            @include('inc.product_form')
                            <!-- Small modal end -->
                            @if($product->price && $product->price != '/uploads/')
                            <div class="orderFormItem">
                                <a href="<?= url()->to('/uploads')?>/{{$product->price}}" target="_blank" class="downloadItem">@lang('pages.product.buttons.price')</a>
                            </div>
                            @endif @if($product->catalog && $product->catalog != '/uploads/')
                            <div class="orderFormItem">
                                <a href="<?= url()->to('/uploads')?>/{{$product->catalog}}" target="_blank" class="downloadItem">@lang('pages.product.buttons.catalog')</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mt-20 contentWrap">
                        {!!$product->content ?? ''!!}
                    </div>
                </div>
            </div>
            <!-- end of main content -->
            <!-- start of sidebar content -->
            <div class="col-md-3 blogSidebarWrapper">
                <div class="sidebar sidebar-left mt-sm-30">
                    <!-- sidebar start -->
                    @include('categories_widget', ['categories' => $categories])
                    <!-- sidebar end -->
                </div>
            </div>
            <!-- end of sidebar content -->
        </div>
    </div>
</section>
<!-- Section: Project -->
<section class="layer-overlay overlay-dark-6 sliderWrap" data-bg-img="/images/bg/bg1.jpg">
    <div class="container pb-40">
        <div class="section-title vertical-line productHeader safeControls">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-uppercase text-theme-colored title">@lang('pages.product.recomended.blue')
                        <span class="text-white">@lang('pages.product.recomended.white')</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row multi-row-clearfix">
            <div class="col-md-12">
                <div class="owl-carousel-4col owl-nav-top productCaruselWrap" data-nav="true">
                    @foreach($product->suggestedCategories as $category)
                    <div class="item">
                        <div class="project ">
                            <article class="post clearfix ">
                                <div class="entry-header">
                                    <div class="post-thumb thumb">
                                        <img src="{{$category->getPhoto('image', 'big')}}" alt="" class="img-responsive img-fullwidth">
                                    </div>
                                </div>
                                <div class="entry-content p-20">
                                    <h4 class="entry-title text-white text-uppercase">
                                        <a class="font-weight-600" href="{{url()->to($category->path)}}">{{$category->title}}</a>
                                    </h4>
                                    <a class="btn btn-theme-colored btn-sm mt-10" href="{{url()->to($category->path)}}">@lang('pages.product.read_more')</a>
                                </div>
                            </article>
                        </div>
                    </div>
                    @endforeach @foreach($product->suggestedProducts as $suggested_product)
                    <div class="item">
                        <div class="project ">
                            <article class="post clearfix ">
                                <div class="entry-header">
                                    <div class="post-thumb thumb">
                                        <img src="{{$suggested_product->getPhoto('image', 'big')}}" alt="" class="img-responsive img-fullwidth">
                                    </div>
                                </div>
                                <div class="entry-content p-20">
                                    @if($product->article)
                                    <h5 class="sub-title font-14 font-weight-500 mb-5">{{$suggested_product->article}}</h5>
                                    @endif
                                    <h4 class="entry-title text-white text-uppercase">
                                        <a class="font-weight-600" href="{{$suggested_product->path}}">{{$suggested_product->title}}</a>
                                    </h4>
                                    <a class="btn btn-theme-colored btn-sm mt-10" href="{{$suggested_product->path}}">@lang('pages.product.read_more')</a>
                                </div>
                            </article>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection @push('scripts')
<script>
    $(function () {
        var tabContainers = $('div#slider-img-products > div.s_block');
        tabContainers.hide().filter(':first').show();
        $('div#img-nav ul a').hover(function () {
            tabContainers.hide();
            tabContainers.filter(this.hash).show();
            $('div#img-nav ul a').removeClass('selected');
            $(this).closest('li').addClass('selected');
            return false;
        }).filter(':first').hover();
    });
    $(function () {
        var lastId,
            topMenu = $(".nav"),
            topMenuHeight = topMenu.outerHeight() - 20,
            menuItems = topMenu.find("a"),
            scrollItems = menuItems.map(function () {
                var item = $($(this).attr("href"));
                if (item.length) {
                    return item;
                }
            });
            console.log("azaza");
    });
    $('#img-nav li a').on('click', function (e) {
        e.preventDefault();
        var reqSectionPos = $('#slider-img-products').offset().top - 100;
        $('body, html').animate({scrollTop: reqSectionPos}, 500);
    });
</script>
@endpush @section('seo_text') @if($product->seo_text) {!!$product->seo_text!!} @endif @endsection