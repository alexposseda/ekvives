@extends('layouts.app') @section('content') @include('inc.banner', ['title' => $article->title, 'picture' => $article->getPhoto('banner', 'big')])
<!-- Section: Blog -->
<section>
    <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
            <div class="col-md-9">
                <div class="blog-posts single-post">
                    <article class="post clearfix mb-0">
                        <div class="entry-header">
                            <div class="post-thumb thumb">
                                <img src="{{$article->getPhoto('image', 'big')}}" alt="" class="img-responsive img-fullwidth"> </div>
                        </div>
                        <div class="entry-content">
                            <div class="entry-meta media no-bg no-border mt-15 pb-20">
                                <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                    <ul>
                                        <li class="font-16 text-white font-weight-600">{{$article->published_at->format('d')}}</li>
                                        <li class="font-12 text-white text-uppercase">{{$article->published_at->format('M')}}</li>
                                    </ul>
                                </div>
                                <div class="media-body pl-15">
                                    <div class="event-content pull-left flip">
                                        <h4 class="entry-title text-uppercase m-0">{{$article->title}}</h4>
                                    </div>
                                </div>
                            </div>
                            {!!$article->content!!}
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sidebar sidebar-left mt-sm-30">
                    <div class="widget">
                        <h5 class="widget-title line-bottom">@lang('pages.news.last_news')</h5>
                        <div class="latest-posts">
                            @foreach($last_articles as $article)
                            <article class="post media-post clearfix pb-0 mb-10">
                                <a class="post-thumb" href="{{$article->path}}">
                                    <img src="{{$article->getPhoto('image', 'min')}}" alt="">
                                </a>
                                <div class="post-right">
                                    <h5 class="post-title mt-0">
                                        <a href="{{$article->path}}">{{$article->title}}</a>
                                    </h5>
                                    
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection @section('seo_text') @if($article->seo_text) {!!$article->seo_text!!} @endif @endsection