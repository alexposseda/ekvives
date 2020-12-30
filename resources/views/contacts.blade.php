@extends('layouts.app') @section('content') @include('inc.banner', ['title' => Lang::get('banners.contacts')])


<section class="divider">
    <div class="container rowFlex">
        <h3 class="line-bottom mt-0 ml-15">@lang('pages.contacts.managers.title')</h3>
        <div class="col-md-12 rowFlex">
            @foreach($no_address_contacts as $address)
                <div class="col-md-6 humanComtactWrap">
                    <div class="humanComtact pt-10">
                        @if($address->image)
                            <div class="thumb pull-left mb-0 mr-0 pr-20">
                                <img width="75" class="img-circle" alt="" src="{{$address->getPhoto('image', 'min')}}">
                            </div>
                        @endif
                        <div class="ml-100 ">
                            <p class="author">{!!$address->text!!}
                            </p>
                            <ul class="contacts">
                                @if(json_decode($address->phones)) @foreach(json_decode($address->phones) as $phone)
                                    <li>
                                        <a href="tel: {{$phone->phone ?? ''}}">
                                            <i class="fa fa-phone text-theme-colored"></i>{{$phone->phone ?? ''}}</a>
                                    </li>
                                @endforeach @endif @if($address->email)
                                    <li>
                                        <a href="mailto: {{$address->email}}">
                                            <i class="fa fa-envelope-o text-theme-colored"></i>{{$address->email}}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div itemscope itemtype="http://schema.org/Organization" style="display: none; visibility: hidden">
        Контакты:
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            Адрес:
            <span itemprop="streetAddress">ул. Гната Хоткевича 8</span>
            <span itemprop="postalCode"> офис 199</span>
            <span itemprop="addressLocality">Киев</span>,
        </div>
        Телефон:<span itemprop="telephone">(044)220-05-22</span>,
        Телефон:<span itemprop="telephone">(044)599-14-78</span>,
        Телефон:<span itemprop="telephone">38(067)234-77-78</span>,
        Электронная почта: <span itemprop="email">ekvives@ekvives.com</span>
    </div>
</section>

<section class="divider">
    <div class="container">
        <div class="row pt-30">
            <div class="col-md-5">
                @include('inc.contact_form')
            </div>
            <div class="col-md-7">
                <div class="row">
                    <h3 class="line-bottom mt-0 mb-50 ml-15">@lang('pages.contacts.addresses.title')</h3>
                    <div class="col-md-12">
                        <p class="lead">@lang('pages.contacts.addresses.description')</p>
                    </div>
                </div>
                <div class="mapItems">
                    @foreach($address_contacts as $address)
                        <div class="col-xs-12 col-sm-6 col-md-6 addressItemWrap">
                            <div class="icon-box media bg-deep p-30 mb-20 addressItem" data-id="{{$loop->index+1}}">
                                <a class="media-left pull-left flip" href="#">
                                    <i class="pe-7s-map-2 text-theme-colored"></i>
                                </a>
                                <div class="media-body">
                                    <h5 class="mt-0">{{$address->title}}</h5>
                                    @if(json_decode($address->address))
                                        @foreach(json_decode($address->address) as $address_item)
                                            <p>{{$address_item->item ?? ''}}</p>
                                        @endforeach @endif @if(json_decode($address->phones)) @foreach(json_decode($address->phones) as $phone)
                                        <li>
                                            <a href="tel: {{$phone->phone ?? ''}}">
                                                <i class="fa fa-phone text-theme-colored"></i>{{$phone->phone ?? ''}}
                                            </a>
                                        </li>
                                    @endforeach @endif @if($address->email)
                                        <li>
                                            <a href="mailto: {{$address->email}}">
                                                <i class="fa fa-envelope-o text-theme-colored"></i>{{$address->email}}
                                            </a>
                                        </li>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Divider: Google Map -->
<section>
    <div class="container-fluid pt-0 pb-0">
        <div class="row">
            <!-- Google Map HTML Codes -->
            <div id="map" data-mapstyle="default" data-height="500" data-width="100%" data-zoom="15" data-marker="/images/map-marker.png"
                 style="width:100%;">
            </div>
            <!-- Google Map Javascript Codes -->
        </div>
    </div>
</section>
@endsection @push('scripts') @if($address_contacts)
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('API_GOOGLE_KEY')}}&libraries=places&callback=initMap"></script>
    <script type="text/javascript">
        var map;
                @foreach($address_contacts as $contact)
        var marker{{$loop->index + 1}};
        @endforeach

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 50.439215,
                    lng: 30.502502
                },
                zoom: 15
            });
            var service = new google.maps.places.PlacesService(map);
            @foreach($address_contacts as $contact)
            service.getDetails({
                placeId: '{{$contact->place_id}}'
            }, function (place, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    marker{{$loop->index + 1}} = new google.maps.Marker({
                        map: map,
                        position: place.geometry.location,
                        title: '{{$contact->title}}'
                    });
                    @if($loop->index === 0)
                    map.setCenter(marker1.position);
                    @endif
                }
            });
            @endforeach
        }
        $(document).ready(function () {
            $('.addressItem').click(function (e) {
                $('.addressItem.active').toggleClass("active");
                $(this).toggleClass("active");
                map.setCenter(eval('marker' + $(this).data("id")).position);
            });
        });
    </script>
@endif @endpush