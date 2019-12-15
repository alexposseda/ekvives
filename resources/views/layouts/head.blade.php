<!DOCTYPE html>
<html dir="ltr" lang="{{App::getLocale()}}">

<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WLTH4JW');</script>
    <!-- End Google Tag Manager -->


    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type"
          content="text/html; charset=UTF-8"/> @if(trim($__env->yieldContent('meta_description'))) @yield('meta_description') @else @if(isset($page->meta_title) && $page->meta_title)
        <meta name="description"
              content="{{$page->meta_title}}"/> @endif @endif  @if(trim($__env->yieldContent('no_index'))) @yield('no_index') @else @if(isset($page->no_index) && $page->no_index)
        <meta name="robots" content="noindex,nofollow"> @endif @endif  <!-- Page Title -->
    <title>@yield('meta_title', isset($page->meta_title) && $page->meta_title ? $page->meta_title : 'Ekvives')</title>
	
    <!-- start:Open Graph -->
    @yield('OpenGraph')
<!-- end:Open Graph -->
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    
<!-- Stylesheet -->
    <!-- <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/css/jquery-ui.min.css" rel="stylesheet" type="text/css"> -->

    <!-- external javascripts -->
    <!-- <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script> -->
    <script src="/js/tether.js"></script>
    <script src="/js/jquery-2.2.4.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="/js/jquery-plugin-collection.js"></script>

    <!-- CSS | main -->
    <link href="/css/style.min.css" rel="stylesheet" type="text/css">


    <!-- Revolution Slider 5.x SCRIPTS -->
    <script src="/js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
    <script src="/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WLTH4JW"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="wrapper" class="clearfix">
<!-- preloader
    <div id="preloader">
      <div id="spinner">
        <img class="ml-5" src="/images/preloaders/3.gif" alt="">
      </div>
      <div id="disable-preloader" class="btn btn-default btn-sm">@lang('header.disable_preloader')</div>
    </div> -->
    <!-- BEGIN JIVOSITE CODE {literal} -->
    <script type='text/javascript'>
        (function () {
            var widget_id = '{{env('CHAT_KEY')}}';
            var d = document;
            var w = window;

            function l() {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = '//code.jivosite.com/script/geo-widget/' + widget_id;
                var ss = document.getElementsByTagName('script')[0];
                ss.parentNode.insertBefore(s, ss);
            }

            if (d.readyState == 'complete') {
                l();
            } else {
                if (w.attachEvent) {
                    w.attachEvent('onload', l);
                } else {
                    w.addEventListener('load', l, false);
                }
            }
        })();</script>
    <!-- {/literal} END JIVOSITE CODE -->