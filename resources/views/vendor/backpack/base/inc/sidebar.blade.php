@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        @include('backpack::inc.sidebar_user_panel')

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          {{-- <li class="header">{{ trans('backpack::base.administration') }}</li> --}}
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->


          <!-- ======================================= -->
          {{-- <li class="header">Other menus</li> --}}
          <li><a href="/admin/document"><i class="fas fa-file-alt"></i> <span>Документы</span></a></li>
          <li><a href="/admin/testimonial"><i class="fas fa-quote-left"></i> <span>Отзывы</span></a></li>
          <li><a href="/admin/gallery"><i class="far fa-images"></i> <span>Галереи</span></a></li>
          <li><a href="/admin/category"><i class="fas fa-certificate"></i> <span>Категории</span></a></li>
          <li><a href="/admin/product"><i class="fas fa-cart-arrow-down"></i> <span>Продукты</span></a></li>
          <li><a href="/admin/price"><i class="far fa-money-bill-alt"></i> <span>Прайсы</span></a></li>
          <li><a href="/admin/article"><i class="fab fa-blogger-b"></i> <span>Блог</span></a></li>
          <li><a href="/admin/contact"><i class="far fa-map"></i> <span>Контакты</span></a></li>

          <li><a href="/admin/slide"><i class="fas fa-image"></i> <span>Слайды</span></a></li>

          <li class="treeview">
              <a href="#"><i class="fas fa-envelope"></i> <span>Формы отправки</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="/admin/order"><i class="fas fa-shopping-cart"></i> <span>Заказы</span></a></li>
                <li><a href="/admin/contactresponse"><i class="fas fa-users"></i> <span>Форма контактов</span></a></li>
                <li><a href="/admin/subscriber"><i class="far fa-user"></i> <span>Подписчики</span></a></li>
                <li><a href="/admin/priceclarify"><i class="fas fa-dollar-sign"></i> <span>Уточнение цены</span></a></li>
              </ul>
          </li>

          

          <li><a href="{{backpack_url('page') }}"><i class="far fa-file"></i> <span>Страницы</span></a></li>
          <li><a href="{{  backpack_url('language') }}"><i class="far fa-flag"></i> <span>Языки</span></a></li>
          <li><a href="{{ backpack_url( 'language/texts') }}"><i class="fas fa-language"></i> <span>Файлы переводов</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/menu-item') }}"><i class="fas fa-bars"></i> <span>Меню</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
