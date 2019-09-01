@extends('layouts.app')
@section('meta_description')
	@if($category->meta_description)
		<meta name="description" content="{{$category->meta_description}}" />
	@endif
@endsection
@section('OpenGraph')

	@switch(request()->path())
		@case('elektrodvigateli')
			<meta property="og:title" content="Электродвигатель купить в Киеве - купить электромотор  от надежного поставщика Ekvives."/>
			<meta property="og:description" content="Электродвигатель купить в Киеве - купить электромотор  по выгодным ценам от надежного поставщика Ekvives доставкой по всей Украине"/>
			<meta property="og:type" content="website"/>
			<meta property="og:url" content="https://ekvives.com/elektrodvigateli"/>
			<meta property="og:image" content="https://ekvives.com/images/logo.png"/>
			<meta property="og:image:width" content="1200"/>
			<meta property="og:image:height" content="630"/>
			<meta property="og:site_name" content="Ekvives"/>
		@break
		@case('nasosy')
			<meta property="og:title" content="Промышленные насосы купить в Киеве – большой каталог насосов в интернет магазине Ekvives"/>
			<meta property="og:description" content="Промышленные насосы купить в Киеве по доступным ценам  – большой каталог насосов в интернет магазине Ekvives с доставкой по всей Украине"/>
			<meta property="og:type" content="website"/>
			<meta property="og:url" content="https://ekvives.com/nasosy"/>
			<meta property="og:image" content="https://ekvives.com/images/logo.png"/>
			<meta property="og:image:width" content="1200"/>
			<meta property="og:image:height" content="630"/>
			<meta property="og:site_name" content="Ekvives"/>
		@break
	@endswitch

@endsection
@section('no_index')
	@if($category->no_index)
<meta name="robots" content="noindex,nofollow">
	@endif @endsection
@if($category->meta_title)
@section('meta_title') {{ $category->meta_title}} @endsection
@endif
@section('content')
	@include('inc.banner', ['title' => $category->title, 'picture' => $category->getPhoto('banner', 'big')])
<section>
	<div class="container mt-30 mb-30 pt-30 pb-30">
		<div class="row">
			<div class="col-md-9 pull-right flip sm-pull-none flexRow ">
				<!-- <div class="container pb-30"> -->
				<!-- start of main content -->
				@foreach($category->children as $sub_category)
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 project catalogItemCard mb-30">
					<div class="productTypesWrap">
						<a class="hoverButton" href="{{$sub_category->path}}">
							
						</a>
						<div class="thumb">
							<img class=" img_category" alt="product" src="{{$sub_category->getPhoto('image', 'min')}}">
						</div>
						<div class="project-details p-15 pt-10 pb-10">
							<h4 class="title font-weight-700 text-uppercase mt-0">{{$sub_category->title}}</h4>
						</div>
					</div>
				</div>
				@endforeach @foreach($category->products as $product)
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 project catalogItemCard mb-30">
					<div class="productTypesWrap">
						<a class="hoverButton" href="{{$product->path}}">
							
						</a>
						<div class="thumb">
							<img class="img_category" alt="" src="{{$product->getPhoto('image', 'min')}}">
						</div>
						<div class="project-details p-15 pt-10 pb-10">
						@if($product->article)
							<h5 class="sub-title font-14 font-weight-500 mb-5">{{$product->article}}</h5>
							@endif
							<h4 class="title font-weight-700 text-uppercase mt-0">{{$product->title}}</h4>
						</div>
					</div>
				</div>
				@endforeach
			</div>

			<!-- end of main content -->
			<!-- start of sidebar content -->
			<div class="col-md-3">
				<div class="sidebar sidebar-left mt-sm-30">
					@include('categories_widget', ['categories' => $categories])
				</div>
			</div>
			<!-- end of sidebar content -->
		</div>
	</div>
</section>
@endsection @section('seo_text') @if($category->seo_text) {!!$category->seo_text!!} @endif @endsection