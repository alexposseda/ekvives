<div class="widget">
    <h5 class="widget-title line-bottom">@lang('pages.categories.widget_title')</h5>
    <div class="categories">
        <ul class="list list-border angle-double-right">
            @foreach($categories->where('parent_id', 0) as $category)
            <li>
                <a href="{{ url()->to($category->path) }}">{{ $category->title }}
                </a>
                @include('inc.sub_categories', ['category' => $category])
            </li>
            @endforeach
        </ul>
    </div>
</div>