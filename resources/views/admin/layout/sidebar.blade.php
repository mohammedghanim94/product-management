@php 
$prefix = Request::route()->getPrefix();
$route =  Route::current()->getName();
@endphp


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{asset('admin/images/logo-dark.png')}}" alt="">
                        <h3><b>Prodcuts</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{($route  == 'dashboard')?'active':''}}">
                <a href="{{route('dashboard')}}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>
       
            <li class="treeview {{($prefix  == '/user')?'active':''}}">
                <a href="#">
                    <i data-feather="users"></i>
                    <span>Manage Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{($route  == 'users.list')?'active':''}}"><a href="{{route('users.list')}}"><i class="ti-more"></i>List Users</a></li>
                    <li class="{{($route  == 'user.add')?'active':''}}"><a href="{{route('user.add')}}"><i class="ti-more"></i>Add User</a></li>
                </ul>
            </li>

            <li class="treeview {{($prefix  == '/profile')?'active':''}}">
                <a href="#">
                    <i data-feather="user"></i> <span>Manage Profile</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{($route  == 'view.profile')?'active':''}}"><a href="{{route('view.profile')}}"><i class="ti-more"></i>My Profile</a></li>
                    <li class="{{($route  == 'profile.changepassword')?'active':''}}"><a href="{{route('profile.changepassword')}}"><i class="ti-more"></i>Change Password</a></li>
                </ul>
            </li>

            <li class="treeview {{($prefix  == '/category')?'active':''}}">
                <a href="#">
                    <i data-feather="grid"></i> <span>Manage Categories</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{($route  == 'categories.list')?'active':''}}"><a href="{{route('categories.list')}}"><i class="ti-more"></i>List Categories</a></li>
                    <li class="{{($route  == 'category.add')?'active':''}}"><a href="{{route('category.add')}}"><i class="ti-more"></i>Create Category</a></li>
                </ul>
            </li>

            <li class="treeview {{($prefix  == '/product')?'active':''}}">
                <a href="#">
                    <i data-feather="package"></i> <span>Manage Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{($route  == 'products.list')?'active':''}}"><a href="{{route('products.list')}}"><i class="ti-more"></i>List Products</a></li>
                    <li class="{{($route  == 'product.add')?'active':''}}"><a href="{{route('product.add')}}"><i class="ti-more"></i>Create Product</a></li>
                </ul>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>