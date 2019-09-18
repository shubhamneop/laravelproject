<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <img src="{{asset('User_profile/' .Auth::user()->profile_image)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
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
          <a href="{{url('admin-dash')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin-dash')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

          </ul>
        </li>

        @can('user-list')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            <span>Manage User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> User</a></li>

          </ul>
        </li>
        @endcan
        @can('role-list')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span>Manage Role</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i> Role</a></li>

          </ul>
        </li>
        @endcan
        @can('config-list')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>Manage Mail</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/configurations')}}"><i class="fa fa-circle-o"></i> Mail</a></li>

          </ul>
        </li>
        @endcan
        @can('banner-list')
        <li class="treeview">
          <a href="#">
           <i class="fa fa-image" aria-hidden="true"></i>
            <span>Manage Banner</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/banners')}}"><i class="fa fa-circle-o"></i>Banner</a></li>

          </ul>
        </li>
        @endcan
        @can('category-list')
        <li class="treeview">
          <a href="#">
           <i class="fa fa-list-alt" aria-hidden="true"></i>
            <span>Manage Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/categories')}}"><i class="fa fa-circle-o"></i>Category</a></li>

          </ul>
        </li>
        @endcan
        @can('product-list')
        <li class="treeview">
          <a href="#">
           <i class="fa fa-product-hunt" aria-hidden="true"></i>
            <span>Manage Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/product')}}"><i class="fa fa-circle-o"></i>Products</a></li>

          </ul>
        </li>
        @endcan
        @can('coupon-list')
        <li class="treeview">
          <a href="#">
          <i class="fa fa-money" aria-hidden="true"></i>
            <span>Manage Coupons</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/coupons')}}"><i class="fa fa-circle-o"></i>Coupons</a></li>

          </ul>
        </li>
        @endcan
        @can('contact-list')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span>Manage Message</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/contactus')}}"><i class="fa fa-circle-o"></i>Message</a></li>

          </ul>
        </li>
        @endcan
        @can('order-list')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-first-order"aria-hidden="true"></i>
            <span>Manage Order</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/order')}}"><i class="fa fa-circle-o"></i>Order</a></li>

          </ul>
        </li>
        @endcan
        @can('cms-list')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file" aria-hidden="true"></i>
            <span> CMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/pages')}}"><i class="fa fa-circle-o"></i>Pages</a></li>

          </ul>
        </li>
        @endcan
        @can('report-list')
        <li class="treeview">
          <a href="#">
          <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/reports/sales')}}" ><i class="fa fa-circle-o"></i>Sales Reports</a></li>
            <li><a href="{{url('admin/reports/customer')}}" ><i class="fa fa-circle-o"></i>Customer Reports</a></li>
            <li><a href="{{url('admin/reports/coupon')}}"><i class="fa fa-circle-o"></i>Cupons Reports</a></li>
          </ul>
        </li>
        @endcan





      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
