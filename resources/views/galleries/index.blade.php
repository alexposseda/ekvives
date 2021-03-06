@extends('layouts.app') @section('content') @include('inc.banner', ['title' => Lang::get('banners.gallery')])
@push("scripts")
<script>
  $(window).load(function() {
    $('.gallery-isotope').isotope();
  });
</script>
@endpush
<section>
    <div class="container">
        <div class="section-content clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div id="grid" class="gallery-isotope flexRow gutter">
                        @foreach($galleries as $gallery)
                        <div class="gallery-item photography photoBorder mb-20" style="height: 27rem">
                            <a href="{{$gallery->path}}">
                            <h4 class="font-weight-700 mt-20">{{$gallery->title}}</h4>
                            <span class="date">{{$gallery->published_at->format('d.m.Y')}}</span>
                            <div class="thumb mt-20">
                                <img class="img-fullwidth" src="{{$gallery->getPhoto('image', 'min')}}" alt="gallery cover" style="height: 13rem">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder fullSizeCover">
                                    <div class="icons-holder-inner fullSizeCover mrReset">
                                        <div class="fullSizeCoverBtn"></div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    {{$galleries->links()}}
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
