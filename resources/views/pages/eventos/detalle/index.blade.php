@extends('layouts.app')
@section('content')
    <form id="exportar-data" action="{{route('evento.promotor.exportCodigosPromotor')}}" method="POST">
        @csrf

        <input type="hidden" name="filters_aditional" id="filter_array_string_excel"/>
        <input name="valor_filter" id="valor_filter_excel" type="hidden"/>
        <input name="title_filter" id="title_filter_excel" type="hidden"/>
        <input type="hidden" id="evento_id" name="evento_id"  >
        <button id="submit-export-excel" type="submit" style="display: none" ></button>
    </form>

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success"></i>
                </div>
                <div>EVENTO-PROMOTOR
                    <div class="page-title-subheading opacity-10">
                        <nav class="" aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a href="{{route('evento.index')}}">EVENTO</a>
                                </li>
                                <li class="active breadcrumb-item" aria-current="page">
                                    Promotor
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

                <div class="d-inline-block" style="background: white">
                    <a href="{{ route('evento.promotor.create',$evento->id) }}" data-id="{{$evento->id}}" data-name="{{$evento->nombre}}" class="btn btn-outline-2x btn-outline-primary entity-create ">
                        <span class="btn-icon-wrapper ">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>Agregar Registro
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="admin-form theme-primary">
                    <div class="card-body ">
                        <form action="#"  class="form-horizontal">
                            <input type="hidden" id="evento_data_id" value="{{$evento->id}}"  >
                            <div class="section-divider mt20 mb40">
                                <span> Datos del Evento </span>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="roles">Evento</label>
                                    <label class="field">

                                        <input type="text" class="form-control gui-input" value="{{$evento->nombre}}"   type="text"  readonly>

                                    </label>

                                </div>


                            </div>


                        </form>
                        <div class="section-divider mt20 mb40">
                            <span> Listado de Promotor-Zona </span>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xl-4 text-center p1">
                                <select id="cmb-field" class=" select-dropdown form-control" style="width: 100% !important"  data-placeholder="Buscar por">
                                    <option value="" >Buscar por</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xl-3 text-center p1 content-operator" style="display: none">
                                <select id="cmb-operator" class="form-control"  data-placeholder="[Operator]" style="width: 100% !important">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xl-4 text-center p1 content-value" style="display: none">
                                <div class="section-list">
                                    <select id="cmb-value" class="form-control" data-placeholder="Seleccionar" style="width: 100% !important">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="section-text">
                                    <input id="text-value" type="text" placeholder="Digite aquí" class="text-center form-control">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xl-1">
                                <button id='btn-add-filter' class="btn btn-outline-2x btn-outline-primary active"><span class="btn-icon-wrap"><i class="fa fa-search"></i></span></button>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xl-2" style="float:right">
                                <button id="btn-export-excel" class="btn btn-outline-2x btn-outline-info entity-import">
                                    <span class="btn-icon-wrapper ">
                                        <i class="fa fa-download fa-w-20"></i>
                                    </span>Exportar
                                </button>
                            </div>
                        </div>
                        <div class="row pt5">
                            <div class="col-md-12 text-left p1">
                                <span class="fs12"><b>Filtros</b></span>
                                <div id="content-filters">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div id="table-content-promotor">

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
@push('scripts')

    <script>
        var url_evento_promotor_load = "{{route('evento.promotor.load',$evento->id)}}";
        var url_promotores_list ="{{route('evento.promtor.list-promtor-filter')}}";

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Bootbox modal + functions(modal, alerts Customized) -->
    <script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>

    <script src="{{ asset('app/evento/index-evento-promotor.js') }}"></script>

    <!-- Validations JS -->
    @include('scripts-group.jquery-validation')
@endpush
