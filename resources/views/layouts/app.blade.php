@inject('users', 'App\Models\User')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blood Bank - DashBoard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/admin/home') }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ auth()->user()->name }}
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
          </div>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin/home')}}" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/blood_bank_logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Blood Bank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                 <li class="nav-item">
                 <a href="#" class="nav-link">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>
                        Governorates
                    <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('governorates.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Governorates</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('governorates.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Governorate</p>
                            </a>
                        </li>
                    </ul>
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-flag"></i>
                        <p>
                            Cities
                        <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cities.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Cities</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cities.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create City</p>
                            </a>
                        </li>
                    </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bars"></i>
                            <p>
                                Categories
                            <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categories.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Category</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-comment"></i>
                            <p>
                                Posts
                            <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('posts.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Posts</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('posts.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Post</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>
                                Clients
                            <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('clients.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Clients</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-phone-alt"></i>
                            <p>
                                Contact Us
                            <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('contacts.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Contacts</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-ambulance"></i>
                            <p>
                                Donations
                            <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('donations.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Contacts</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cogs"></i>
                            <p>
                                Settings
                            <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('settings.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-list"></i>
                            <p>
                                Roles
                            <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Role</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-list"></i>
                            <p>
                                Permissions
                            <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permissions.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Permission</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>
                                Admins
                            <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Admins</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Admin</p>
                                </a>
                            </li>
                        </ul>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1> @yield('page_title')
                <small> @yield('small_title') </small>
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
        @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
@stack('scripts')
</body>
</html>
