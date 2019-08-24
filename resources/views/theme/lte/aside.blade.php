 <!-- Left side column. contains the sidebar -->
 <aside class="main-sidebar" style="position: fixed;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset("assets/$theme/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Gerente General</p>
              <a href="#"><i class="fa fa-circle text-success"></i>Activo</a>
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
            <li class="header">MENU</li>
          </li>

          <li class="treeview">
              <a href="#">
                <i class="fa fa-bank"></i>
                <span>Sucursales</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('sucursal.create')}}"><i class="fa fa-circle-o"></i>Nuevas Sucursal</a></li>
                <li><a href="{{ route('sucursal.index') }}"><i class="fa fa-circle-o"></i>Ver todas las sucursales</a></li>
              </ul>
            </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-calendar-check-o"></i>
              <span>Reservaciones</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="{{ route('products.create')}}"><i class="fa fa-circle-o"></i>Nuevas Reservaciones</a></li>
              <li><a href="boxed.html"><i class="fa fa-circle-o"></i>Ver todas las reservaciones</a></li>
              <li><a href="fixed.html"><i class="fa fa-circle-o"></i>Cancelar reservacion</a></li>
            </ul>
          </li>

            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-user"></i> <span>Empleados</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('empleado.create')}}"><i class="fa fa-circle-o"></i>Nuevo</a></li>
                <li><a href="{{ route('empleado.index') }}"><i class="fa fa-circle-o"></i>Ver Empleados</a></li>
              </ul>      
           </li>             

            <li class="treeview">
              <a href="#"><i class="fa fa-car"></i> Vehiculos
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('vehiculo.create')}}"><i class="fa fa-circle-o"></i>Nuevo</a></li>
                <li><a href="{{ route('vehiculo.index') }}"><i class="fa fa-circle-o"></i>Ver vehiculos</a></li>
               
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-plus-circle"></i> Servicio Extra
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('servicioe.create')}}"><i class="fa fa-circle-o"></i>Nuevo</a></li>
                <li><a href="{{ route('servicioe.index') }}"><i class="fa fa-circle-o"></i>Ver Servicios</a></li>
              </ul>
            </li>  
            
            <li class="treeview">
                <a href="#"><i class="fa fa-wrench"></i> Mantenimiento
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ route('vehiculo.index')}}"><i class="fa fa-circle-o"></i>Nuevo</a></li>
                  <li><a href="{{ route('mantenimiento.index') }}"><i class="fa fa-circle-o"></i>Ver Mantenimientos</a></li>
                </ul>
              </li> 
              <li class="treeview">
                  <a href="#"><i class="fa fa-cogs"></i>Servicio de mantenimiento
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('tallerservicio.index')}}"><i class="fa fa-circle-o"></i>Nuevo</a></li>
                    <li><a href="{{ route('tallerservicio.index') }}"><i class="fa fa-circle-o"></i>Ver servicios</a></li>
                  </ul>
                </li> 
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>