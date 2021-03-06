<section class="inner-header divider layer-overlay overlay-dark-5 bp-center"
         data-bg-img="{{ isset($page->banner) ? $page->getPhoto('banner', 'big') : (isset($picture) && $picture ? $picture : '/images/bg/bg11.jpg') }}">
    <div class="container pt-100 pb-50">
        <!-- Section Content -->
        <div class="section-content pt-100">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title text-theme-colored">{{$title}}</h1>
                    <?php $bCnt = 1;?>
                    <ul class="breadcrumb white" itemscope itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <?php if(\App::getLocale() == \App\Models\Language::getDefault()):?>
                            <a href="<?= url()->to('/')?>" itemprop="item"><span
                                        itemprop="name">@lang('banners.main')</span>
                                <meta itemprop="position" content="<?= $bCnt?>"/>
                            </a>
                            <?php else:?>
                            <a href="<?= url()->to('/' . \App::getLocale())?>" itemprop="item"><span
                                        itemprop="name">@lang('banners.main')</span>
                                <meta itemprop="position" content="<?= $bCnt?>"/>
                            </a>
                            <?php endif;?>
                        </li>
                        <?php $bCnt++?>
                        @if(isset($breadcrumbs)) @foreach($breadcrumbs as $breadcrumb)
                            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a href="{{url()->to($breadcrumb['path'])}}" itemprop="item"><span
                                            itemprop="name">{{$breadcrumb['title']}}</span>
                                    <meta itemprop="position" content="<?= $bCnt?>"/>
                                </a>
                            </li>
                            <?php $bCnt++?>
                        @endforeach @endif
                        <li class="active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <strong itemtype="http://schema.org/TEXT" itemprop="name">{{$title}}</strong>
                            <meta itemprop="position" content="<?= $bCnt?>"/>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
