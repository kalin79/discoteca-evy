@extends('layouts.app')
@section('content')
    <form id="exportar-data" action="{{route('cliente.export-data')}}" method="POST">
        @csrf

        <input type="hidden" name="filters_aditional" id="filter_array_string_excel"/>
        <input name="valor_filter" id="valor_filter_excel" type="hidden"/>
        <input name="title_filter" id="title_filter_excel" type="hidden"/>
        <button id="submit-export-excel" type="submit" style="display: none" ></button>
    </form>
    <div class="app-page-title ">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>
                    <div class="page-title-head center-elem">
                        <span class="d-inline-block pr-2">
                            <i class="fa fa-users opacity-6"></i>
                        </span>
                        <span class="d-inline-block">Cliente</span>
                    </div>
                    <div class="page-title-subheading opacity-10">
                        <nav class="" aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a>Socios</a>
                                </li>
                                <li class="active breadcrumb-item" aria-current="page">
                                    Listado
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

                <div class="d-inline-block" style="background: white">
                    <button id="btn-export-excel"  class="btn btn-outline-2x btn-outline-success ">
                        <span class="btn-icon-wrapper ">
                            <i class="fa fa-download fa-w-20"></i>
                        </span>Exportar
                    </button>
                </div>

            </div>
        </div>
    </div>
    @include('includes.search')
    <div class="main-card mb-3 card">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-sm">
                    <div class="table-wrap">
                        <div id="table-content" class="table-responsive">
                            <table  class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Promotor</th>
                                    <th>Evento </th>
                                    <th>Zona</th>

                                </tr>
                                </thead>
                            </table>
                            <div id="loading" class="text-center">
                                <i class="fa fa-spinner fa-pulse fa-lg p-5" role="status" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>


@endsection
@push('scripts')

  <script>
    var url_cliente_load = "{{route('cliente.load')}}";
    var url_promotores_list ="{{route('evento.promtor.list-promtor-filter')}}";
    var url_evento_list ="{{route('filtro.evento-lista')}}";
    var url_zona_list ="{{route('filtro.lista-zona')}}";
  </script>
  <!-- Bootbox modal + functions(modal, alerts Customized) -->
  <script type="text/javascript" src="/js/bootbox.min.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script type="text/javascript" src="/js/filter.js"></script>

  <script src="/js/datepicker/moment.min.js"></script>
  <script src="/js/datepicker/datepicker.js"></script>
  <script src="/js/datepicker/daterangepicker.js"></script>
 <!-- Select2 JavaScript -->
 <script src="/template-mintos/vendors/select2/dist/js/select2.full.min.js"></script>
 <script src="/app/cliente/index.js"></script>

 <!-- Validations JS -->
 @include('scripts-group.jquery-validation')
@endpush
