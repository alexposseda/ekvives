@extends('layouts.app') @section('content') @include('inc.banner', ['title' => Lang::get('banners.documents')])
<section class="bg-lighter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="separator separator-rouned">
                    <i class="fa fa-cog fa-spin"></i>
                </div>
                <div id="grid" class="gallery-isotope grid-3 gutter clearfix">
                    @forelse($documents as $document)
                    <div class="gallery-item photography photoBorder customGalleryItem">
                        <h4 class="font-weight-700 mt-20">{{$document->title}}</h4>
                        <div class="buttomDateSplit">
                            <span class="date">{{$document->created_at->format('d.m.Y')}}</span>
                            <div class="button reviewBtnWrap">
                                @if($document->file && $document->file != '/uploads/')
                                    <a href="{{$document->file}}" class="btn btn-sm btn-theme-colored" target="_blank">@lang('pages.documents.download')</a>
                                @endif
                            </div>
                        </div>
                        <p class="mt-20">{{$document->description}}</p>
                        <div class="thumb mt-20">
                            <img class="img-fullwidth" src="{{$document->getPhoto('image', 'mid')}}" alt="project">
                            <div class="overlay-shade"></div>
                            <div class="icons-holder fullSizeCover">
                                <div class="icons-holder-inner fullSizeCover mrReset">
                                    <a data-lightbox="image" href="{{$document->getPhoto('image', 'big')}}" class="fullSizeCoverBtn">
                                        <i class="fa fa-picture-o"></i>
                                    </a>
                                </div>
                            </div>
                            <a class="hover-link" data-lightbox="image" href="{{$document->getPhoto('image', 'big')}}">@lang('pages.documents.view_more')</a>
                        </div>                        
                    </div>
                    @empty @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection