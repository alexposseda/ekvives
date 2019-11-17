@extends('layouts.app') @section('content') @include('inc.banner', ['title' => Lang::get('banners.testimonials')])
<section class="bg-lighter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="separator separator-rouned">
                    <i class="fa fa-cog fa-spin"></i>
                </div>
                <div id="grid" class="gallery-isotope grid-3 gutter clearfix">
                    @forelse($testimonials as $testimonial)
                    <div class="gallery-item photography photoBorder">
                        <h4 class="font-weight-700 mt-20 font-size-title">{{$testimonial->title}}</h4>
                        <span class="date">{{$testimonial->created_at->format('d.m.Y')}}</span>
                        <p class="mt-20"></p>
                        <div class="thumb mt-20">
                            <img class="img-fullwidth" src="{{$testimonial->getPhoto('image', 'mid')}}" alt="project">
                            <div class="overlay-shade"></div>
                            <div class="icons-holder fullSizeCover">
                                <div class="icons-holder-inner fullSizeCover mrReset">
                                    <a data-lightbox="image" href="{{url()->to($testimonial->getPhoto('image', 'big'))}}" class="fullSizeCoverBtn">
                                        <i class="fa fa-picture-o"></i>
                                    </a>
                                </div>
                            </div>
                            <a class="hover-link" data-lightbox="image" href="{{url()->to($testimonial->getPhoto('image', 'big'))}}">@lang('pages.testimonials.download')</a>
                        </div>
                        <div class="button mt-20 reviewBtnWrap">
                            @if($testimonial->file && $testimonial->file != '/uploads/')
                            <a href="{{$testimonial->file}}" class="btn btn-sm btn-theme-colored">@lang('pages.testimonials.look')</a>
                            @endif @if($testimonial->gallery_id)
                            <a href="{{$testimonial->gallery->path}}" class="btn btn-sm btn-theme-colored">@lang('pages.testimonials.to_gallery')</a>
                            @endif
                        </div>
                    </div>
                    @empty @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection