<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="oreho">
    {{-- <link href='#' rel='shortcut icon' type='image/x-icon' /> --}}

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- @vite(['resources/js/app.js','resources/oreho/jquery.min.js']) --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/oreho/bootstrap.min.css',
        'resources/oreho/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        'resources/oreho/plugins/fontawesome-free/css/fontawesome.min.css',
        'resources/oreho/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'resources/oreho/select2.min.css',
        'resources/oreho/plugins/fontawesome-free/css/all.min.css',
        'resources/oreho/dist/css/skins/_all-skins.min.css',
        'resources/oreho/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        'resources/oreho/dist/css/adminlte.min.css',
        'resources/oreho/my.css',
        'resources/oreho/plugins/jquery-ui/jquery-ui.min.js',
        // 'resources/oreho/plugins/bootstrap/js/bootstrap.min.js',
        // 'resources/oreho/dist/js/adminlte.min.js',
        // 'resources/oreho/plugins/select2/js/select2.full.min.js',
        // 'resources/oreho/jquery.min.js',
        'resources/oreho/my.js',
        // 'resources/oreho/ckeditor/ckeditor.js',
        // 'resources/oreho/ckeditor/adapters/jquery.js',
    ])
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ Vite::asset('resources/oreho/dist/img/AdminLTELogo.png') }}"
                alt="AdminLTELogo" height="60" width="60">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a id="toogle" class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>

                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" title="Home page" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/contact" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ Vite::asset('resources/oreho/dist/img/user1-128x128.jpg') }}"
                                    alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">

                                <img src=" {{ Vite::asset('resources/oreho/dist/img/user8-128x128.jpg') }}"
                                    alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src=" {{ Vite::asset('resources/oreho/dist/img/user3-128x128.jpg') }}"
                                    alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <!-- <li class="nav-item">
            <a href="#" class="nav-link" data-widget="fullscreen" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true"
                        href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link" target="_blank" title="home website">
                <img src="{{ Vite::asset('resources/oreho/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"> &nbsp;&nbsp;АДМИН &nbsp;&nbsp; ПАНЕЛЬ</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">

                        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                        <img src="{{ Vite::asset('resources/oreho/dist/img/Northern_ Lights.jpg') }}"
                            class="user-image" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('user.my_account') }}" class="d-block">Admin</a>
                    </div>
                    <div class="logout_admin">
                        <a href="{{ route('logoutAdmin') }}" class="d-block">Logout</a>
                    </div>
                </div>
                <!-- =================== Search FORM  ========================= -->
                <form action="/search" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="s" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- =================== Search FORM  END ========================= -->
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="/" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/order"><i class="fa fa-shopping-cart"></i>
                                &nbsp;&nbsp;&nbsp;&nbsp;<span>Orders</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Categories &nbsp;
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}">List categories</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categories.create') }}">Add category</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Tags &nbsp;
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('tags.index') }}">List tags</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tags.create') }}">Add tag</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-pencil-alt"></i>
                                <p>
                                    Posts &nbsp;
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('posts.index') }}">List Posts</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('postsAdmin.create') }}">Add post</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Profile &nbsp;
                                    {{-- <?//=$_SESSION['user']['name'];?> --}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            {{-- <!-- <ul class="dropdown-menu">
                  <li class="user-header">
                      <img src="dist/img/Northern_ Lights.jpg" class="img-circle" alt="User Image">

                      <p>
                         <?//=$_SESSION['user']['name'];?>
                      </p>
                  </li>
                  <li class="user-footer">
                      <div class="pull-left">
                          <a href="<?//=OREHO;?>/user/edit?id=<?//=$_SESSION['user']['id'];?>" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                          <a href="/user/logout" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                  </li> -->
                            <!-- </ul> --> --}}
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/user/edit?id=<?//=$_SESSION['user']['id'];?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Edit user</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/user/logout" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sign out</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/contact" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Contact us</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Products &nbsp;
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/product">List products</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/product/add">Add product</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/modification">Product modifications</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cache"><i class="fa fa-database"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span>Caching</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Users &nbsp;
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}">List users</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="/user/add">Add user</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li> --}}
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>
                                    Currencies &nbsp;
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/currency">List currencies</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/currency/add">Add currency</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-filter"></i>
                                <p>
                                    Filters &nbsp;
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/filter/attribute-group">List filters</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/filter/attribute">Filters</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    News &nbsp;
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/news">List News</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/news/add">Add news</a>
                                    <i class="far fa-circle nav-icon"></i>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        {{-- ====================>> End Header  ============================= --}}
        <div class="content-wrapper" style="min-height: 548.062px;">
            {{-- <div class="container">
                <div class="row">
                    <div class="col-9">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        @yield('footer')
        @yield('sidebar')
        <script>
            var path = '/',
                adminpath = 'oreho';
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"
            integrity="sha512-KBeR1NhClUySj9xBB0+KRqYLPkM6VvXiiWaSz/8LCQNdRpUm38SWUrj0ccNDNSkwCD9qPA4KobLliG26yPppJA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
