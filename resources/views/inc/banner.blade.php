<section class="inner-header divider layer-overlay overlay-dark-5 bp-center" data-bg-img="{{ isset($page->banner) ? $page->getPhoto('banner', 'big') : (isset($picture) && $picture ? $picture : '/images/bg/bg11.jpg') }}">
	<div class="container pt-100 pb-50">
		<!-- Section Content -->
		<div class="section-content pt-100">
			<div class="row">
				<div class="col-md-12">
					<h3 class="title text-theme-colored">{{$title}}</h3>
					<ul class="breadcrumb white">
						<li>
							<a href="/">@lang('banners.main')</a>
						</li>
                        @if(isset($breadcrumbs)) @foreach($breadcrumbs as $breadcrumb)
                        <li>
							<a href="{{$breadcrumb['path']}}">{{$breadcrumb['title']}}</a>
						</li>
                        @endforeach @endif
						<li class="active">{{$title}}</li>
					</ul>
				</div>
			</div>
		</div>
<a class="bannerBackButton" href="{{$breadcrumb['path'] ?? '/'}}">@lang('banners.back')</a>
	</div>
</section>