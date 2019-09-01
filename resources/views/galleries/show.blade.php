@extends('layouts.app')
@section('meta_title') {{$gallery->meta_title}} @endsection
@section('meta_description')
  @if($gallery->meta_description)
    <meta name="description" content="{{$gallery->meta_description}}" />
  @endif
@endsection
@section('content') @include('inc.banner', ['title' => $gallery->title, 'picture' => $gallery->getPhoto('banner', 'big')])
<section>
  <div class="container-fluid pb-0">
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <div id="grid" class="gallery-isotope grid-4 gutter clearfix">
            @foreach($gallery->photos as $photo)
            <div class="gallery-item design">
              <div class="thumb">
                <div class="flexslider-wrapper">
                  <div class="flexslider">
                    <ul class="slides">
                      <li>
                        <a href="{{$photo}}" title="{{$gallery->title}} - фото {{$loop->index+1}}">
                          <img src="{{$photo}}" alt="" style="height:16rem;">
                        </a>
                      </li>                      
                    </ul>
                  </div>
                </div>
                <div class="overlay-shade"></div>
                <div class="icons-holder fullSizeCover" >
                  <div data-id="{{$loop->index}}" class="icons-holder-inner fullSizeCover mrReset">
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push("scripts")
<script>
  $(window).load(function() {
    setTimeout(() => {
      $('.gallery-isotope').isotope();
    }, 100);    
  });
</script>
@endpush
@section('seo_text') @if($gallery->seo_text) {!!$gallery->seo_text!!} @endif @endsection