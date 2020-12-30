@extends('layouts.app') @section('content') @include('inc.banner', ['title' => Lang::get('banners.news'), 'page' => $page])
<section class="blog-posts">
    <div class="container">
        <div class="row multi-row-clearfix">
            @foreach($articles as $article)
                <div class="col-md-12">
                    <article class="post clearfix mb-30 bg-lighter">
                        <div class="entry-content p-20 pr-20">
                            <div class="entry-meta media mt-0 no-bg no-border">
                                <div class="entry-date media-left text-center flip">
                                    <ul>
                                        <li class="font-16 font-weight-600 mt-0">{{$article->published_at->format('d.m.Y')}}</li>
                                    </ul>
                                </div>
                                <div class="media-body">
                                    <div class="event-content flip">
                                        <h4 class="entry-title text-white text-uppercase m-0 mt-5">
                                            <a href="{{$article->path}}">{{$article->title}}</a>
                                        </h4>
                                    </div>
                                    <p class="mt-10 entry-descr">
                                        {{$article->description}}
                                    </p>
                                    <a href="{{$article->path}}" class="btn-read-more">@lang('pages.news.read_more')</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                </div>
            @endforeach
            <div class="col-md-12 ">
                {{$articles->links()}}
            </div>
        </div>
    </div>
</section>
@endsection