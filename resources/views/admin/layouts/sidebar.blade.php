<section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">BERANDA</li>
        <li><a href="{{ url('/') }}"><i class="fa fa-fw fa-home"></i> Home</span></a></li>

        <li class="{{ (Request::path() == 'admin/beranda') ? 'active' : '' }}"><a href="{{ url('/admin/beranda') }}"><i class="fa fa-fw fa-external-link"></i> Beranda</span></a></li>

        <!-- <li class="{{ (Request::path() == 'admin/banner') ? 'active' : '' }}"><a href="{{ url('/admin/banner') }}"><span class="glyphicon glyphicon-modal-window"></span> Banner</span></a></li> -->

        <li class="{{ (Request::path() == 'admin/alamat') ? 'active' : '' }}"><a href="{{ url('/admin/alamat') }}"><i class="fa fa-fw fa-map-o"></i> Alamat</span></a></li>


        <li class="header">MANAGE PRODUUCTS</li>
        <li class="treeview {{ ( Request::segment(2) == 'produk' ) ? 'active' : '' }}">
          <a href="#">
            <span class="glyphicon glyphicon-list-alt"></span> <span>Produk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="{{ (Request::path() == 'admin/produk') ? 'active' : '' }}"><a href="{{ url('admin/produk') }}"><i class="fa fa-circle-o"></i> Daftar Semua Produk</a></li>

            <li class="{{ (Request::path() == 'admin/produk/habis') ? 'active' : '' }}"><a href="{{ url('admin/produk/habis') }}"><i class="fa fa-circle-o"></i> Daftar Produk Yg Habis</a></li>

            <li class="{{ (Request::path() == 'admin/produk/aktif') ? 'active' : '' }}"><a href="{{ url('admin/produk/aktif') }}"><i class="fa fa-circle-o"></i> Produk Yg Aktif</a></li>

            <li class="{{ (Request::path() == 'admin/produk/nonaktif') ? 'active' : '' }}"><a href="{{ url('admin/produk/nonaktif') }}"><i class="fa fa-circle-o"></i> Produk Yg Non-Aktif</a></li>

          </ul>
        </li>




        <li class="treeview {{ ( Request::segment(2) == 'kategori' ) ? 'active' : '' }}">
          <a href="#">
            <span class="glyphicon glyphicon-tags"></span> <span>Kategori</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li class="{{ (Request::path() == 'admin/kategori') ? 'active' : '' }}"><a href="{{ url('admin/kategori') }}"><i class="fa fa-circle-o"></i> Daftar Kategori</a></li>

            <li class="{{ (Request::path() == 'admin/kategori/tambah') ? 'active' : '' }}"><a href="{{ url('admin/kategori/tambah') }}"><i class="fa fa-circle-o"></i> Tambah Kategori</a></li>

          </ul>
        </li>


         <li class="treeview {{ ( Request::segment(2) == 'warna' ) ? 'active' : '' }}">
          <a href="#">
            <span class="glyphicon glyphicon-screenshot"></span> <span>Warna</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li class="{{ (Request::path() == 'admin/warna') ? 'active' : '' }}"><a href="{{ url('admin/warna') }}"><i class="fa fa-circle-o"></i> Daftar Warna</a></li>

            <li class="{{ (Request::path() == 'admin/warna/tambah') ? 'active' : '' }}"><a href="{{ url('admin/warna/tambah') }}"><i class="fa fa-circle-o"></i> Tambah Warna</a></li>

          </ul>
        </li>


        <li class="treeview {{ ( Request::segment(2) == 'warna' ) ? 'active' : '' }}">
          <a href="#">
            <span class="glyphicon glyphicon-pushpin"></span> <span>Ukuran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li class="{{ (Request::path() == 'admin/ukuran') ? 'active' : '' }}"><a href="{{ url('admin/ukuran') }}"><i class="fa fa-circle-o"></i> Daftar Ukuran</a></li>

            <li class="{{ (Request::path() == 'admin/ukuran/tambah') ? 'active' : '' }}"><a href="{{ url('admin/ukuran/tambah') }}"><i class="fa fa-circle-o"></i> Tambah Ukuran</a></li>

          </ul>
        </li>





        <li class="header">PROMO & EVENTS</li>
        <li class="{{ (Request::path() == 'admin/populer-minggu') ? 'active' : '' }}"><a href="{{ url('/admin/populer-minggu') }}"><i class="fa fa-fw fa-line-chart"></i> Populer Minggu ini</span></a></li>

        <li class="{{ (Request::path() == 'admin/featured') ? 'active' : '' }}"><a href="{{ url('/admin/featured') }}"><i class="fa fa-fw fa-mortar-board"></i> Unggulan</span></a></li>

        <li class="{{ (Request::path() == 'admin/best-seller') ? 'active' : '' }}"><a href="{{ url('/admin/best-seller') }}"><i class="fa fa-fw fa-bar-chart"></i> Best Seller</span></a></li>

        <li class="{{ (Request::path() == 'admin/banner-slider') ? 'active' : '' }}"><a href="{{ url('/admin/banner-slider') }}"><i class="fa fa-fw fa-bar-chart"></i> Banner Slider</span></a></li>




        <li class="header">TRANSAKSI</li>
        <li class="treeview {{ ( Request::segment(2) == 'pesanan' ) ? 'active' : '' }}">
          <a href="#">
            <span class="glyphicon glyphicon-screenshot"></span> <span>Pesanan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li class="{{ (Request::path() == 'admin/pesanan') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i> Semua Pesanan</a></li>

            <li class="{{ (Request::path() == 'admin/warna/tambah') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i> Konfirmasi Pembayaran</a></li>

          </ul>
        </li>




        
        <li class="header">OTHER</li>
        <li><a href="{{ url('keluar') }}"><i class="fa fa-book"></i> <span>Keluar</span></a></li>

        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>