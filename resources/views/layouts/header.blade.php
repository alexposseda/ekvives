<?php
	function clearLangPartsFromUrl(){
		$urlParts = explode('/',\Request::path());
		array_shift($urlParts);

		$url = implode('/', $urlParts) /*. (\Request::getQueryString() ? ('?' . \Request::getQueryString()) : '')*/;

		return url()->to($url);
	}
?>

<!-- Header -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WHZJJT2"
				  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header id="header" class="header">
	<div class="header-top bg-black-333 sm-text-center border-top-theme-color-3px p-0">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="widget no-border m-0">
						<ul class="list-inline xs-text-center text-white mt-5 contactListHeader">
							@foreach(Lang::get('header.phones') as $phone ) @if($phone != '-')
							<li class="m-0 pl-10 pr-10">
								<a href="tel: {{$phone}}" class="text-white">
									<i class="fa fa-phone text-theme-colored"></i> {{$phone}}
								</a>
							</li>
							@endif @endforeach @if(Lang::get('header.email') != '-')
							<li class="m-0 pl-10 pr-10">
								<a href="mailto: @lang('header.email')" class="text-white">
									<i class="fa fa-envelope-o text-theme-colored"></i> @lang('header.email')</a>
							</li>
							@endif
						</ul>
					</div>
				</div>
				<div class="col-md-4 pr-0">
					<div class="widget no-border m-0">
						<ul class="styled-icons icon-dark icon-flat icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
							@foreach(Lang::get('header.socials') as $social => $link ) @if($link != '-')
							<li>
								<a href="{{$link}}" target="_blank">
									<i class="fa fa-{{$social}} text-white"></i>
								</a>
							</li>
							@endif @endforeach
							<li class="hiddenMenu">
								<a class="mainLang">{{strtoupper(App::getLocale())}}</a>
								<ul class="dropdown">
									<?php $defaultLanguage = \App\Models\Language::getDefault();?>
									@foreach($locales as $language) @if(App::getLocale() != $language)
									<li>
										@if($defaultLanguage == $language)
											<a href="<?= clearLangPartsFromUrl()?>">{{strtoupper($language)}}</a>
										@else
											<a href="{{url()->to($language . \Request::getRequestUri())}}">{{strtoupper($language)}}</a>
										@endif
									</li>
									@endif @endforeach
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-nav">
		<div class="header-nav-wrapper navbar-scrolltofixed ">
			<div class="container">
				<nav id="menuzord-right" class="menuzord default headerMenuWrap">
					@if(request()->path()== '/')
					<img src="{{url()->asset('/images/logo.png')}}" alt="logo">
					@else
					<a class="menuzord-brand pull-left flip xs-pull-center noMargin" href="/">
						<img src="{{url()->asset('/images/logo.png')}}" alt="logo">
					</a>
					@endif
					
					<ul class="menuzord-menu">
						@foreach($menu_items as $item) @if($item->type == 'categories_link')
						<li>
							<a href="#">{{$item->name}}</a>
							@if($categories->count())
							<ul class="dropdown">
								@foreach($categories as $category)
								<li>
									<a href="{{url()->to($category->path)}}">{{$category->title}}</a>
								</li>
								@endforeach
							</ul>
							@endif
						</li>
						@else
						<li>
							@if($item->children->count())
							<a href="#">{{$item->name}}</a>
							<ul class="dropdown">
								@foreach($item->children as $child)
								<li>
									<a href="{{$child->url()}}">{{$child->name}}</a>
								</li>
								@endforeach
							</ul>
							@else
							<a href="{{$item->url()}}">{{$item->name}}</a>
							@endif
						</li>
						@endif @endforeach
					</ul>
					<div class="search-form headerSearchWrap">
						<form method="GET" action="{{route('search')}}">
							<div class="input-group">
								<input type="text" name="s" {{request()->has('s') ? 'value='.request()->s : ''}} placeholder="@lang('header.search_placeholder')" class="form-control search-input">
								<span class="input-group-btn borderGray">
									<button type="submit" class="btn search-button btnReset">
										<i class="fa fa-search"></i>
									</button>
								</span>
							</div>
						</form>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>