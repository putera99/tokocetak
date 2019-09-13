<section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">BERANDA</li>
        <li><a href="{{ url('/') }}"><i class="fa fa-fw fa-home"></i> Home</span></a></li>

        <li class="{{ (Request::path() == 'user/beranda') ? 'active' : '' }}"><a href="{{ url('/user/beranda') }}"><i class="fa fa-fw fa-external-link"></i> Beranda</span></a></li>




        <li class="header">TRANSAKSI</li>
        <li class="treeview {{ ( Request::segment(2) == 'pesanan' ) ? 'active' : '' }}">
          <a href="#">
            <span class="glyphicon glyphicon-screenshot"></span> <span>Pesanan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li class="{{ (Request::path() == 'user/pesanan') ? 'active' : '' }}"><a href="{{ url('user/pesanan') }}"><i class="fa fa-circle-o"></i> Semua Pesanan</a></li>

            <li class="{{ (Request::path() == 'user/pesanan/konfirmasi') ? 'active' : '' }}"><a href="{{ url('user/pesanan/konfirmasi') }}"><i class="fa fa-circle-o"></i> Konfirmasi Pembayaran</a></li>

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