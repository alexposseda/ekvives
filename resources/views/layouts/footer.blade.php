<?php
if(!function_exists('clearPhone')){
    function clearPhone($phone){
        if(!is_string($phone)){
            $value = (string)$phone;
        }
        $result = preg_replace("/\D/", '', trim($phone));

        return '+'.$result;
    }
}
?>


<!-- Footer data-bg-color="#001018" -->

@if(trim($__env->yieldContent('seo_text')))
    <section class="seoTextBlock">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="separator separator-rouned">
                        <!-- <i class="fa fa-cog fa-spin"></i> -->
                    </div>
                    @yield('seo_text')
                    <div class="separator separator-rouned">
                        <!-- <i class="fa fa-cog fa-spin"></i> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@else @if(isset($page->seo_text) && $page->seo_text)
    <section class="seoTextBlock">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="separator separator-rouned">
                        <!-- <i class="fa fa-cog fa-spin"></i> -->
                    </div>
                    {!!$page->seo_text!!}
                    <div class="separator separator-rouned">
                        <!-- <i class="fa fa-cog fa-spin"></i> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@endif


<footer id="footer" class="footer" data-bg-img="/images/footer-bg.png" data-bg-color="#001018">
    <div class="container pt-70 pb-40">
        <div class="row border-bottom-black">
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <img class="mt-10 mb-20 footerLogo" alt="" src="/images/logo.png">
                    <ul class="list-inline mt-5 footerContacts">
                        @if(Lang::get('footer.phone') != '-')
                            <li class="m-0 pl-10 pr-10">
                                <i class="fa fa-phone text-theme-colored mr-5"></i>
                                <?php
                                $phone = Lang::get('footer.phone')
                                ?>
                                <a class="text-gray" href="tel: <?= clearPhone($phone)?>"><?= $phone?></a>
                            </li>
                        @endif
                        @if(Lang::get('footer.email') != '-')
                            <li class="m-0 pl-10 pr-10">
                                <i class="fa fa-envelope-o text-theme-colored mr-5"></i>
                                <a class="text-gray" href="mailto: @lang('footer.email')">@lang('footer.email')</a>
                            </li>
                        @endif
                        @if(Lang::get('footer.site') != '-')
                            <li class="m-0 pl-10 pr-10">
                                <i class="fa fa-globe text-theme-colored mr-5"></i>
                                <a class="text-gray" href="//@lang('footer.site')"
                                   target="_blank">@lang('footer.site')</a>
                            </li>
                        @endif
                    </ul>
                    <ul class="social-icons icon-bordered icon-circled icon-sm mt-15">
                        @if(Lang::get('footer.facebook') != '-')
                            <li>
                                <a href="@lang('footer.facebook')">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if(Lang::get('footer.twitter') != '-')
                            <li>
                                <a href="@lang('footer.twitter')">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if(Lang::get('footer.skype') != '-')
                            <li>
                                <a href="@lang('footer.skype')">
                                    <i class="fa fa-skype"></i>
                                </a>
                            </li>
                        @endif
                        @if(Lang::get('footer.youtube') != '-')
                            <li>
                                <a href="@lang('footer.youtube')">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h3 class="widget-title line-bottom">@lang('footer.testimonials')</h3>
                    <div class="latest-posts">
                        @foreach($last_testimonials as $testimonial)
                            <article class="post media-post clearfix pb-0 mb-10">
                                <a href="{{route('testimonials')}}" class="post-thumb smallImg">
                                    <img alt="" src="{{$testimonial->getPhoto('image', 'min')}}">
                                </a>
                                <div class="post-right">
                                    <p class="post-title mt-0 mb-5">
                                        <a href="{{$testimonial->file && $testimonial->file != '/uploads/' ? $testimonial->file : '#'}}"
                                           download>{{$testimonial->title}}</a>
                                    </p>
                                    <p class="post-date mb-0 font-12">{{$testimonial->created_at->format('d.m.Y')}}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                @if($footer_menu_items->count())
                    <div class="widget dark">
                        <h3 class="widget-title line-bottom">@lang('footer.menu')</h3>
                        <ul class="list angle-double-right list-border">
                            @foreach($footer_menu_items as $item)
                                <li>
                                    <a href="{{$item->url()}}">{{$item->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h3 class="widget-title line-bottom">@lang('footer.subscription')</h3>
                    <form id="footer_quick_contact_form" name="footer_quick_contact_form" class="quick-contact-form"
                          action="/subscribe" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input id="form_name" name="name" class="form-control" type="text" required=""
                                   placeholder="@lang('footer.name_placeholder')">
                        </div>
                        <div class="form-group">
                            <input id="form_email" name="email" class="form-control" type="email" required=""
                                   placeholder="@lang('footer.email_placeholder')">
                        </div>
                        <div class="form-group">
                            <input id="form_company" name="company" class="form-control" type="text" required=""
                                   placeholder="@lang('footer.company_placeholder')"></textarea>
                        </div>
                        <div class="form-group">
                            <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value=""/>
                            <button type="submit" class="btn btn-default btn-transparent btn-xs btn-flat mt-0"
                                    data-loading-text="@lang('footer.loading_text')">@lang('footer.submit')</button>
                        </div>
                    </form>
                    <!-- Quick Contact Form Validation-->
                    <script type="text/javascript">
                        $("#footer_quick_contact_form").validate({
                            submitHandler: function (form) {
                                var form_btn = $(form).find('button[type="submit"]');
                                var form_result_div = '#form-result';
                                $(form_result_div).remove();
                                form_btn.before(
                                    '<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>'
                                );
                                var form_btn_old_msg = form_btn.html();
                                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                                $(form).ajaxSubmit({
                                    dataType: 'json',
                                    success: function (data) {
                                        if (data.status == 'true') {
                                            $(form).find('.form-control').val('');
                                        }
                                        form_btn.prop('disabled', false).html(form_btn_old_msg);
                                        $(form_result_div).html(data.message).fadeIn('slow');
                                        setTimeout(function () {
                                            $(form_result_div).fadeOut('slow')
                                        }, 6000);
                                    }
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</footer>
<a class="scrollToTop" href="#">
    <i class="fa fa-angle-up"></i>
</a>
</div>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="/js/custom.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems ! The following part can be removed on Server for On Demand Loading) -->
@stack('scripts')
</body>

</html>