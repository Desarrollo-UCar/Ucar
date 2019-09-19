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
            <p>{{auth::user()->nombre()}} </p>
          <p>{{auth::user()->rol()}}</p>
          {{-- <a href="#"><i class="fa fa-circle text-success"></i>Activo</a>  --}}
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
      <!--       <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>-->
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

          @if(auth::user()->hasRole('gerente'))
            <li><a href="{{ route('sucursal.create')}}"><i class="fa fa-circle-o"></i>Nueva Sucursal</a></li><!--GERENTE -->
            @endif
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
            <li><a href="{{ route('reservacion.index')}}"><i class="fa fa-circle-o"></i>Ver todas las reservaciones</a></li>
            <li><a href="#reservacionFechas" data-toggle="modal" data-target="#reservacionFechas"><i class="fa fa-circle-o"></i>Ver reservaciones por fecha</a></li>
            <li><a data-toggle="modal" data-target="#reservacionesCliente"><i class="fa fa-circle-o"></i>Ver reservaciones por cliente</a></li>
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
            
          @if(auth::user()->hasRole('gerente'))
            <li><a href="{{ route('catalogos')}}"><i class="fa fa-circle-o"></i>Marcas/Modelos/Categorias</a></li>
            @endif
            <li><a href="{{ route('vehiculo.create')}}"><i class="fa fa-circle-o"></i>Nuevo</a></li>
            <li><a href="{{ route('vehiculo.index') }}"><i class="fa fa-circle-o"></i>Ver vehiculos</a></li>
            <li><a href="{{ route('modelovehiculo') }}"><i class="fa fa-circle-o"></i>Agregar Modelo</a></li>
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
              @if(auth::user()->hasRole('gerente'))
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
            @endif
            <li class="treeview">
                <li><a href="{{ route('cliente.index') }}"><i class="fa fa-circle-o"></i>Clientes</a> </li>
       
              </li> 
              

      <li class="treeview">
          <a href="#"><i class="fa fa-wrench"></i> Reportes
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('reportesFechaReservacion')}}"><i class="fa fa-circle-o"></i>Reservaciones por fecha</a></li>
            <li><a href="{{ route('mantenimiento.index') }}"><i class="fa fa-circle-o"></i>Ver Mantenimientos</a></li>
          </ul>
        </li> 

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="modal fade in" id="reservacionFechas">

      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Ver reservaciones por fecha de recogida'}} </b> </h4>
          </div>
          <div class="modal-body">

              <div class="box-body">
                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="form-group">
                        Ingrese el campo requerido
                          <form method="GET" action="{{ route('porFecha') }}"  role="form">
                              {{ csrf_field() }}


                              <div class="col-md-6 form-group">
                                  <label>Fecha recogida</label>
                                  <input type="date" name="fecha_e" id="" class="form-control"  value="">
                                </div>
                      
                      </div>
                    </div>
                  </div>
                </div>
                  
            <p><b>{{'Se mostraran las reservaciones coincidentes'}} {{' '}} </b>&hellip;</p>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span>{{'Ver'}}</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade in" id="reservacionesCliente">

        <div class="modal-dialog">
          <div class="modal-content">
  
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Ver reservaciones por cliente'}} </b> </h4>
            </div>
            <div class="modal-body">
  
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12 ">
                        <div class="form-group">
                          Ingrese los siguientes campos, todos son requeridos.
                            <form method="GET" action="{{ route('porCliente') }}"  role="form">
                                {{ csrf_field() }}
  
  
                                <div class="col-md-6 form-group">
                                    <label>Nombre(s)</label>
                                    <input type="text" name="nombre" id="" class="form-control"  value="">
                                  </div>

                                <div class="col-md-6 form-group">
                                  <label>Primer Apellido</label>
                                  <input type="text" name="apellido" id="" class="form-control"  value="">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Fecha de Nac.</label>
                                    <input type="date" name="nac" id="" class="form-control"  value="">
                                  </div>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                    
              <p><b>{{'Se mostraran las reservaciones coincidentes'}} {{' '}} </b>&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span>{{'Ver'}}</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>