<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">


        </div>

      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="{{url('admin-dash')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        @can('user-list')
        <li>
          <a href="{{route('users.index')}}">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            <span>Manage User</span>
          </a>
        </li>
        @endcan
        @can('role-list')
        <li>
        <a href="{{route('roles.index')}}">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span>Manage Role</span>
          </a>
        </li>
        @endcan
        @can('config-list')
        <li>
          <a href="{{url('/admin/configurations')}}">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>Manage Mail</span>
          </a>
        </li>
        @endcan
        @can('banner-list')
        <li>
          <a href="{{url('/admin/banners')}}">
           <i class="fa fa-image" aria-hidden="true"></i>
            <span>Manage Banner</span>
          </a>
        </li>
        @endcan
        @can('category-list')
        <li>
        <a href="{{url('/admin/categories')}}">
           <i class="fa fa-list-alt" aria-hidden="true"></i>
            <span>Manage Category</span>
          </a>
        </li>
        @endcan
        @can('product-list')
        <li>
          <a href="{{url('/admin/product')}}">
           <i class="fa fa-product-hunt" aria-hidden="true"></i>
            <span>Manage Product</span>
          </a>
        </li>
        @endcan
        @can('coupon-list')
        <li>
          <a href="{{url('/admin/coupons')}}">
          <i class="fa fa-money" aria-hidden="true"></i>
            <span>Manage Coupons</span>
          </a>
        </li>
        @endcan
        @can('contact-list')
        <li>
        <a href="{{url('/admin/contactus')}}">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <span>Manage Message</span></a>
        </li>
        @endcan
        @can('order-list')
        <li>
        <a href="{{url('/admin/order')}}">
            <i class="fa fa-first-order"aria-hidden="true"></i>
            <span>Manage Order</span>
          </a>
        </li>
        @endcan
        @can('cms-list')
        <li>
        <a href="{{url('/admin/pages')}}">
            <i class="fa fa-file" aria-hidden="true"></i>
            <span> CMS</span>

          </a>

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
