@if($articles->count())
<section class="layer-overlay overlay-dark-6 sliderWrap" data-bg-img="/images/bg/bg1.jpg">
        <div class="container pb-40">
            <div class="section-title vertical-line safeControls">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-uppercase text-gray-lightgray mb-0">@lang('pages.main.news.first_line')</p>
                        <h2 class="text-uppercase text-theme-colored title">@lang('pages.main.news.second_line.blue') <span class="text-white">@lang('pages.main.news.second_line.black')</span></h2>
                    </div>
                </div>
            </div>
            <div class="row multi-row-clearfix">
                <div class="col-md-12">
                    <div class="owl-carousel-4col owl-nav-top stepsFixWrap" data-nav="true">
                        @foreach($articles as $article)
                            <!-- <div class="item">
                            <div class="project mb-30"> --> 
                                <article class="post clearfix bg-lighter stepsFixItem">
                                    <div class="entry-header post clearfix bg-lighter">
                                        <div class="post-thumb thumb">
                                            <img src="{{$article->getPhoto('image', 'min')}}" alt="" class="img-responsive img-fullwidth">
                                        </div>
                                    </div>
                                    <div class="entry-content p-20 post clearfix bg-lighter">
                                        <h4 class="entry-title text-white text-uppercase"><a class="font-weight-600" href="{{url()->to($article->path)}}">{{$article->title}}</a></h4>
                                        <div class="entry-meta">
                                            <ul class="list-inline font-12 mb-10">
                                                <li><i class="fa fa-calendar text-theme-colored mr-5"></i>{{$article->published_at->format('M d, Y')}} | </li>
                                            </ul>
                                        </div>
                                        <p class="itemText">{{$article->description ?? ''}}</p>
                                        <a class="btn btn-theme-colored btn-sm" href="{{url()->to($article->path)}}">@lang('pages.main.news.watch')</a>
                                    </div>
                                </article>
                            <!-- </div>
                        </div> -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endif

