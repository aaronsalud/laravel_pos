<div class="navbar-default sidebar" role="navigation">
<div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
    
        <li>
            <a href="{{ url('/home ') }}" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
        </li>
       
        <li >
            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Master</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="{{ url('category')}}" class=" hvr-bounce-to-right"> <i class="fa fa-list nav_icon @{{activecategory}}"></i>Kategori Barang</a></li>
                
                <li><a href="{{url('item')}}" class=" hvr-bounce-to-right"><i class="fa fa-shopping-bag nav_icon @{{activeitem}}"></i>Daftar Barang</a></li>

                <li><a href="{{url('supplier')}}" class=" hvr-bounce-to-right"><i class="fa fa-truck nav_icon @{{activesupplier}}"></i>Supplier</a></li>
                
                <li><a href="{{url('customer')}}" class=" hvr-bounce-to-right"><i class="fa fa-smile-o nav_icon @{{activecustomer}}"></i>Pelanggan</a></li>

           </ul>
        </li>
        <li >
            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-money nav_icon"></i> <span class="nav-label">Transaksi</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="{{ url('purchase')}}" class=" hvr-bounce-to-right"> <i class="fa fa-shopping-basket nav_icon @{{activepurchase}}"></i>Pembelian</a></li>
                
                <li><a href="{{url('sale')}}" class=" hvr-bounce-to-right"><i class="fa fa-credit-card nav_icon @{{activeitem}}"></i>Penjualan</a></li>
           </ul>
        </li>
        <li >
            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-area-chart nav_icon"></i> <span class="nav-label">Laporan</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="{{ url('purchase/report')}}" class=" hvr-bounce-to-right"> <i class="fa fa-line-chart nav_icon @{{activepurchase}}"></i>Pembelian</a></li>
                
                <li><a href="{{url('sale/report')}}" class=" hvr-bounce-to-right"><i class="fa fa-bar-chart nav_icon @{{activeitem}}"></i>Penjualan</a></li>
           </ul>
        </li>
         <li>
            <a href="inbox.html" class=" hvr-bounce-to-right"><i class="fa fa-gear nav_icon"></i> <span class="nav-label">Settings</span> </a>
        </li>
    </ul>
</div>
</div>