@extends("theme.$theme.layout")

@section('styles')
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/morris.js/morris.css")}}">
@endsection

@section('contenido')
<section class="content-header">
    <h1>
      Reportes      <small>Graficas</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12 ">
          <!-- Line chart -->
          <div class="box box-primary">
              </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
@endsection