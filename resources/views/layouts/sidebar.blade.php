      <!-- Sidebar user panel (optional) -->
      
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ADMIN</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
          <a href="{{ url('admin/user/welcome') }}" class="{{ (request()->segment(1) == '') ? 'nav-link active' : 'nav-link inactive' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                HOME
              </p>
            </a>
          </li>

          <li class="nav-item">
          <a href="{{ url('admin/pertumbuhan/ibu') }}" class="{{ (request()->segment(1) == '') ? 'nav-link active' : 'nav-link inactive' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                IBU
              </p>
            </a>
          </li>

          <li class="nav-item">
          <a href="{{ url('admin/pertumbuhan/kuesioner') }}" class="{{ (request()->segment(1) == '') ? 'nav-link active' : 'nav-link inactive' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                KUESIONER
              </p>
            </a>
          </li>

          <li class="nav-item">
          <a href="{{ url('admin/pertumbuhan/prosentasekuesioner') }}" class="{{ (request()->segment(1) == '') ? 'nav-link active' : 'nav-link inactive' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                SKOR
              </p>
            </a>
          </li>

          <li class="nav-item">
          <a href="{{ url('admin/pertumbuhan/historibaca') }}" class="{{ (request()->segment(1) == '') ? 'nav-link active' : 'nav-link inactive' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                HISTORI MATERI
              </p>
            </a>
          </li>
          
          
          <!-- <li class="nav-header">CONTOH DEMO</li> -->
          <!--
          <li class="nav-item">
          <a href="{{ route ('product.index')}}" class="{{ (request()->segment(1) == 'product') ? 'nav-link active' : 'nav-link inactive' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Jquery Datatables
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route ('yajra.index')}}" class="{{ (request()->segment(1) == 'yajra') ? 'nav-link active' : 'nav-link inactive' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Yajra Datatables
                  <span class="badge badge-info right">New</span>
                </p>
            </a>
          </li>
          -->

          <!--<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Menu
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/kehamilan/getuser') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Menu</p>
                </a>
              </li>
            </ul>
          </li> -->

          <li class="nav-item">
          <a href="{{ url('admin/logout') }}" class="{{ (request()->segment(1) == '') ? 'nav-link active' : 'nav-link inactive' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->