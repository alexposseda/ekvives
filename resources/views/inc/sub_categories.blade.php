@if($category->children)
<ul class="list list-border angle-double-right">
    @foreach($category->children as $sub_category)
    <li>
        <a href="{{ $sub_category->path }}">{{ $sub_category->title }}</a>
        @include('inc.sub_categories', ['category' => $sub_category])
    </li>
    @endforeach
</ul>
@endif