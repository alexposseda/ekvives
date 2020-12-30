@extends('layouts.app') @section('content')
@include('inc.banner', ['title' => Lang::get('banners.search')])
<section>
	<div class="container mt-30 mb-30 pt-30 pb-30">
		<div class="row">
			<div class="col-md-9 pull-right flip sm-pull-none flexRow ">
            @forelse($products as $product)
				<div class="col-sm-6 col-md-4 col-lg-3 project catalogItemCard mb-30">
					<div class="productTypesWrap">
						@if($product->path)
						<a class="hoverButton" href="{{url()->to($product->path)}}">
							<i class="flaticon-attachment"></i>
						</a>
						@endif
						<div class="thumb">
							<img class="img-fullwidth" alt="" src="{{$product->getPhoto('image', 'min')}}">
						</div>
						<div class="project-details p-15 pt-10 pb-10">
							<h4 class="title font-weight-700 text-uppercase mt-0">{{$product->title}}</h4>
						</div>
					</div>
				</div>
                @empty
                <p>@lang('pages.search.no_results')</p>
				@endforelse
			</div>
			<div class="col-md-3">
				<div class="sidebar sidebar-left mt-sm-30">
					@include('categories_widget', ['categories' => $categories])
				</div>
			</div>
		</div>
	</div>
</section>
@endsection