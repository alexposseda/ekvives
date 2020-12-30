@extends('layouts.app') @section('content') @include('inc.banner', ['title' => $page->title])
<section class="bg-lighter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!!$page->content!!}
            </div>
        </div>
    </div>
</section>
@endsection