@if($slides->count())
    <section id="home">
        <div class="container-fluid p-0 mainSliderWrapper">
            <!-- Slider Revolution Start -->
            <div class="rev_slider_wrapper">
                <div class="rev_slider rev_slider_default" data-version="5.0">
                    <ul>
                    @foreach($slides as $slide)
                        <!-- SLIDE 1 -->
                            <li data-index="rs-{{$loop->index +1}}" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{$slide->getPhoto('image', 'min')}}" data-rotate="0" data-fstransition="fade" data-saveperformance="off" data-title="Web Show" data-description="" class="rs-{{$loop->index +1}}">
                                <!-- MAIN IMAGE -->
                                <img src="{{$slide->getPhoto('image', 'big')}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="6" data-no-retina>
                                <!-- LAYERS -->
                                <!-- LAYER NR. 1 -->
                                @if($slide->label && $loop->index > 0)
                                    <div class="tp-caption tp-resizeme sft text-black-222 text-uppercase font-raleway bg-theme-colored pl-20 pr-20" id="rs-{{$loop->index +1}}-layer-1" data-x="['{{($loop->index +1) % 2 ? 'left' : 'right'}}']" data-hoffset="['30']" data-y="['middle']" data-voffset="['-125']" data-fontsize="['24']" data-lineheight="['48']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;s:500" data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;" data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-speed="500" data-start="600" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; font-weight:700; border-left: 8px solid #fff;">
                                        {{$slide->label}}
                                    </div>
                                @endif
                            <!-- LAYER NR. 2 -->
                                @if($slide->title && $loop->index > 0)
                                    <div class="tp-caption tp-resizeme sft text-uppercase text-white font-raleway font-weight-700 m-0" id="rs-{{$loop->index +1}}-layer-2" data-x="['{{($loop->index +1) % 2 ? 'left' : 'right'}}']" data-hoffset="['30']" data-y="['middle']" data-voffset="['-50']" data-fontsize="['72']" data-lineheight="['82']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;s:500" data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;" data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-speed="500" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; font-weight:700;">
                                        {{$slide->title}}
                                    </div>
                                @endif
                            <!-- LAYER NR. 3 -->
                                @if($slide->description && $loop->index > 0)
                                    <div class="tp-caption tp-resizeme sft text-white" id="rs-{{$loop->index +1}}-layer-3" data-x="['{{($loop->index +1) % 2 ? 'left' : 'right'}}']" data-hoffset="['30']" data-y="['middle']" data-voffset="['20']" data-fontsize="['50']" data-lineheight="['55']" data-width="none" data-height="none" data-whitespace="wrap" data-transform_idle="o:1;s:500" data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;" data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-speed="500" data-start="1200" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; font-weight:400;">
                                        {{$slide->description}}
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- end .rev_slider -->
            </div>
            <!-- end .rev_slider_wrapper -->
            @push('scripts')
                <script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
                <script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
                <script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
                <script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
                <script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
                <script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
                <script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
                <script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
                <script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>
                <script>
                    $(document).ready(function(e) {
                        $(".rev_slider_default").revolution({
                            sliderType: "standard",
                            sliderLayout: "auto",
                            dottedOverlay: "none",
                            delay: 5000,
                            navigation: {
                                keyboardNavigation: "off",
                                keyboard_direction: "horizontal",
                                mouseScrollNavigation: "off",
                                onHoverStop: "off",
                                touch: {
                                    touchenabled: "on",
                                    swipe_threshold: 75,
                                    swipe_min_touches: 1,
                                    swipe_direction: "horizontal",
                                    drag_block_vertical: false
                                },
                                arrows: {
                                    style: "gyges",
                                    enable: true,
                                    hide_onmobile: false,
                                    hide_onleave: true,
                                    hide_delay: 200,
                                    hide_delay_mobile: 1200,
                                    tmp: '',
                                    left: {
                                        h_align: "left",
                                        v_align: "center",
                                        h_offset: 0,
                                        v_offset: 0
                                    },
                                    right: {
                                        h_align: "right",
                                        v_align: "center",
                                        h_offset: 0,
                                        v_offset: 0
                                    }
                                },
                                bullets: {
                                    enable: true,
                                    hide_onmobile: true,
                                    hide_under: 800,
                                    style: "hebe",
                                    hide_onleave: false,
                                    direction: "horizontal",
                                    h_align: "center",
                                    v_align: "bottom",
                                    h_offset: 0,
                                    v_offset: 30,
                                    space: 5,
                                    tmp: '<span class="tp-bullet-image"></span><span class="tp-bullet-imageoverlay"></span><span class="tp-bullet-title"></span>'
                                }
                            },
                            responsiveLevels: [1240, 1024, 778],
                            visibilityLevels: [1240, 1024, 778],
                            gridwidth: [1170, 1024, 778, 480],
                            gridheight: [400, 400, 500, 500],
                            lazyType: "none",
                            parallax: {
                                origo: "slidercenter",
                                speed: 1000,
                                levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                                type: "scroll"
                            },
                            shadow: 0,
                            spinner: "off",
                            stopLoop: "on",
                            stopAfterLoops: 0,
                            stopAtSlide: -1,
                            shuffle: "off",
                            autoHeight: "off",
                            fullScreenAutoWidth: "off",
                            fullScreenAlignForce: "off",
                            fullScreenOffsetContainer: "",
                            fullScreenOffset: "0",
                            hideThumbsOnMobile: "off",
                            hideSliderAtLimit: 0,
                            hideCaptionAtLimit: 0,
                            hideAllCaptionAtLilmit: 0,
                            debugMode: false,
                            fallbacks: {
                                simplifyAll: "off",
                                nextSlideOnWindowFocus: "off",
                                disableFocusListener: false,
                            }
                        });
                    });
                </script>
            @endpush
        </div>
    </section>
@endif