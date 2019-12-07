@extends('layouts.app') @section('content') @include('inc.banner', ['title' => Lang::get('banners.price')])
<section class="bg-lighter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('inc.price_clarify')
                <div class="separator separator-rouned">
                    <i class="fa fa-cog fa-spin"></i>
                </div>
                <div id="grid" class="gallery-isotope grid-3 gutter clearfix">
                    @forelse($prices as $price)
                    <div class="gallery-item photography photoBorder customGalleryItem">
                        <h4 class="font-weight-700 mt-20">{{$price->title}}</h4>
                        <div class="buttomDateSplit">
                            <span class="date">{{$price->created_at->format('d.m.Y')}}</span>
                            <div class="button reviewBtnWrap">
                            @if($price->file && $price->file != '/uploads/')
                                <a href="{{url()->to($price->file)}}" class="btn btn-sm btn-theme-colored" target="_blank">@lang('pages.prices.download')</a>
                            @endif
                        </div>
                        </div>
                        <p class="mt-20">{{$price->description}}</p>
                        <div class="thumb mt-20">
                            <img class="img-fullwidth" src="{{$price->getPhoto('image', 'mid')}}" alt="project">
                            <div class="overlay-shade"></div>
                            <div class="icons-holder fullSizeCover">
                                <div class="icons-holder-inner fullSizeCover mrReset">
                                    <a data-lightbox="image" href="{{url()->to($price->getPhoto('image', 'big'))}}" class="fullSizeCoverBtn">
                                        <i class="fa fa-picture-o"></i>
                                    </a>
                                </div>
                            </div>
                            <a class="hover-link" data-lightbox="image" href="{{url()->to($price->getPhoto('image', 'big'))}}">@lang('pages.prices.view_more')</a>
                        </div>
                        
                    </div>
                    @empty @endforelse
                </div>
            </div>
        </div>
        {{$prices->links()}}
    </div>
</section>
@endsection