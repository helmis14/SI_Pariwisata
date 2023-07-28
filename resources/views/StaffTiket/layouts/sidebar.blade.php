  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('images/logo22.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-4" style="opacity: .8; ">
      <span class="brand-text font-weight-light">Sistem Informasi </span><br>
      <span class="brand-text font-weight-light" style="margin-left:53px;">Pariwisata</span>
    
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/bg-1.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
                <a href="home" class="nav-link active">
                  <i class="fas fa-briefcase nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li> 
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="tiket" class="nav-link active">
                  <i class="far fa-address-book nav-icon"></i>
                  <p>Kelola Tiket</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="pembayaran" class="nav-link active">
                  <i class="far fa-building nav-icon"></i>
                  <p>Kelola Pembayaran</p>
                </a>
              </li>

             
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>