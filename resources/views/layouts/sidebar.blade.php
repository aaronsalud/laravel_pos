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
         <li>
            <a href="inbox.html" class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i> <span class="nav-label">Inbox</span> </a>
        </li>
    </ul>
</div>
</div>