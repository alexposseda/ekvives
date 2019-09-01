@if($categories->count())
<section>
    <div class="container">
        <div class="section-title maxwidth500 vertical-line">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-uppercase mb-0">@lang('pages.main.categories.first_line')</p>
                    <h2 class="text-uppercase text-theme-colored title">@lang('pages.main.categories.second_line.blue') <span class="text-black-333">@lang('pages.main.categories.second_line.black')</span></h2>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row flexRow">
            @foreach($categories as $category)
                <a href="{{$category->path}}" class="col-6 col-sm-6 col-md-4 maxwidth500 mb-40 wow itemCard fadeInLeft itemCard itemCardButton" data-wow-duration="1s" data-wow-delay="0.1s">
                    <div class="mainCategoryItem">
                        <img class="img-fullwidth" src="{{$category->getPhoto('image', 'min')}}" alt="">
                    </div>
                    <h4 class="font-weight-700 mt-20">{{$category->title}}</h4>
                    <p>{{$category->description ?? ''}}</p>              
                </a>
            @endforeach                 
            </div>
        </div>
    </div>
</section>
@endif