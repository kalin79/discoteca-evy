@extends('layouts.app')
@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph2 icon-gradient bg-happy-green"></i>
                </div>
                <div>Reportes

                </div>
            </div>
        </div>
    </div>


    {{-- <div class="main-card mb-3 card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-2 text-center p1">

                        <input id="init_date" type="text" placeholder="Fecha Inicio" class="text-center form-control">

                </div>
                <div class="col-md-2 text-center p1 ">

                        <input id="end_date" type="text" placeholder="Fecha Fin" class="text-center form-control">

                </div>

                <div class="col-md-2">
                    <button id='btn-add-filter' class="btn btn-outline-2x btn-outline-primary active"><span class="btn-icon-wrap"><i class="fa fa-search"></i></span></button>
                </div>
            </div>

        </div>

    </div>--}}

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body" style="position: relative;">
                    <h5 class="card-title">Reporte General</h5>
                    <div id="chart"></div>
                    <div class="table-wrap">
                        <div id="table-content" class="table-responsive">
                            <div id="loading" class="text-center">
                                <i class="fa fa-spinner fa-pulse fa-lg p-5" role="status" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body" style="position: relative;">
                    <h5 class="card-title">Cantidad de Clientes Registrados</h5>
                </div>
            </div>

        </div>--}}
    </div>






@endsection
@push('scripts')

    <script>
        var url_load_chart = "{{ route('reporte.load') }}";
        var url_user_load = "{{ route('administrator.load') }}";

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Bootbox modal + functions(modal, alerts Customized) -->
    <script type="text/javascript" src="/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/js/functions.js"></script>
    <script type="text/javascript" src="/js/filter.js"></script>

    <script src="{{ asset( 'js/datepicker/moment.min.js' ) }}"></script>
    <script src="{{ asset( 'js/datepicker/datepicker.js' ) }}"></script>
    <script src="{{ asset( 'js/datepicker/daterangepicker.js' ) }}"></script>
    <!-- Select2 JavaScript -->

    <!--Apex Charts-->
    <script src="{{ asset( 'architec-ui/js/vendors/charts/apex-charts.js' ) }}"></script>


    <script src="/app/dashboard/index.js"></script>

    <!-- Validations JS -->
    @include('scripts-group.jquery-validation')
@endpush
