<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>


            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @can('user-list')
                    <li class="active"><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> Manage Users</a></li>
                       @endcan
                        @can('role-list')
                    <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i> Manage Role</a></li>
                        @endcan
                        @can('config-list')
                    <li><a href="{{url('/admin/configurations')}}"><i class="fa fa-circle-o"></i> Manage Mail</a></li>
                        @endcan
                       @can('banner-list')
                     <li><a href="{{url('/admin/banners')}}"><i class="fa fa-circle-o"></i>Manage Banner</a></li> 
                        @endcan 
                       @can('category-list')
                     <li><a href="{{url('/admin/categories')}}"><i class="fa fa-circle-o"></i>Manage Category</a></li> 
                        @endcan  
                        @can('product-list')
                        <li><a href="{{url('/admin/product')}}"><i class="fa fa-circle-o"></i>Manage Product</a></li> 
                        @endcan
                        @can('coupon-list')
                           <li><a href="{{url('/admin/coupons')}}"><i class="fa fa-circle-o"></i>Manage Coupons</a></li> 
                           @endcan
                        
                </ul>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>