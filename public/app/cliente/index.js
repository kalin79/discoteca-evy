jQuery(function() {
    load();
    var data_fields = [
        { "id": 1, "text": "Nombre", type: 'text', field: 'id_cuenta' },
        { "id": 2, "text": "Apellidos", type: 'text', field: 'nombre' },
        {"id": 3, "text": "Promotor", type:'list', field : 'promotor_id',list: function(){return list_promotor()}, 'type_select2':true},
        {"id": 4, "text": "Evento", type:'list', field : 'evento_id',list: function(){return list_evento()}, 'type_select2':true},
        {"id": 5, "text": "Zona", type:'list', field : 'zona_id',list: function(){return list_zona()}, 'type_select2':true},
    ];

    function list_promotor() {
        return get_list(url_promotores_list);
    }
    function list_evento() {
        return get_list(url_evento_list);
    }
    function list_zona() {
        return get_list(url_zona_list);
    }
    $("#cmb-field").select2({
        theme: "bootstrap4",
        "data": data_fields,
    });

    CI.filter({
        controls: { field: '#cmb-field', operator: '#cmb-operator', value: '#text-value' },
        data: data_fields,
        default_filter: 'byField',
        elemnt_action: '#btn-add-filter',
        text_value: '#text-value',
        content_filters: '#content-filters',

        load: function() {
            load();
        }
    });

    var customize_rules = {

        /* @validation states + elements
        ------------------------------------------- */
        ignore: [],
        errorClass: "state-error",
        validClass: "state-success",
        errorElement: "em",

        /*  rules
        ------------------------------------------ */
        rules: {
            //nombre: {required: true},
            //description: {required: true},
        },

        /* @validation error messages
        ---------------------------------------------- */
        messages: {},

        /* @validation highlighting + error placement
        ---------------------------------------------------- */
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.field').addClass(errorClass).removeClass(validClass);
            $(element).parent().find('.select2 > .selection > .select2-selection').addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.field').removeClass(errorClass).addClass(validClass);
            $(element).parent().find('.select2 > .selection > .select2-selection').removeClass(errorClass).addClass(validClass);
        },
        errorPlacement: function(error, element) {
            if (element.is(":radio") || element.is(":checkbox")) {
                element.closest('.option-group').after(error);
            } else {
                error.insertAfter(element.parent());
                error.insertAfter(element.closest(".field"));
            }
        }
    };

    var rules = $.extend(true, {}, customize_rules);
    rules.rules = {
        file_excel: { required: true, extension: "xlsx" },

    }

    ModalCRUD.create({
        title: 'EXCEL',
        title_prefix: 'IMPORTAR',
        element: '.entity-import',
        form_element: '#form-import-excel',
        element_is_load: true,
        isLoadFromAjax: false,
        rules: rules,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {},
        afterSuccess: function() {
            load();

        }
    });
    ModalCRUD.edit({
        title: 'Plan',

        element: '.edit-entity',
        element_is_load: true,
        form_element: '#form-plan-edit',
        isLoadFromAjax: true,
        url: function(element) {
            return $(element).attr("href");
        },
        initialized: function() {},
        afterSuccess: function() {
            load();
        }
    });

    ModalCRUD.show({
        title: 'Compras',
        mode: 'lg',
        element: '.entity-show',
        form_element: '#form-noticia-relacionada-create',
        element_is_load: false,
        isLoadFromAjax: true,
        rules: rules,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {
            //load_product_list();
        }
    });

    var rules_export = $.extend(true, {}, customize_rules);
    rules_export.rules = {
        init_date: { required: true },
        end_date: { required: true },
    }
    ModalCRUD.edit({
        title: 'Compras',
        title_prefix: 'Exportar',
        title_customize: { title: 'Exportación', title_confirm: 'exportar', title_confirmed: 'exporto' },
        full_success_message: 'Los registros se exportaron correctamente',
        element: '.entity-export',
        form_element: '#form-export-excel',
        element_is_load: true,
        isLoadFromAjax: false,
        rules: rules_export,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {
            $(".modal-title").text('Exportar Registros');
            $.fn.datepicker.languages['es-ES'] = {
                format: 'yyyy-mm-dd',
                days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                daysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                daysMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                weekStart: 1,
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
            };

            $('#init_date').datepicker({
                startDate: null,
                language: 'es-ES',
                autoHide: true,
                zIndex: 2048,
            });
            $('#end_date').datepicker({
                startDate: null,
                language: 'es-ES',
                autoHide: true,
                zIndex: 2048,
            });
        },
        afterSuccess: function(result) {

            console.log(result);
            window.open('/interno/socios/export-data?start_date=' + result.fecha_inicio + "&end_date=" + result.fecha_fin, '_target');
        }
    });

    $(document).on('click', '.pagination li a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        load(url);
    })


    $('#btn-export-excel').on('click', function(e){

        var filters = get_filters();
        $('#filter_array_string_excel').val(JSON.stringify(filters));
        var title_filter = [];
        var value_filter = [];

        $('.tag-filter').each(function(){
            var title = $('.field-name', this).html();
            title_filter.push(title);
            var value = $('.field-value', this).html();
            value_filter.push(value);
        });

        $('#valor_filter_excel').val(value_filter.toString());
        $('#title_filter_excel').val(title_filter.toString());
        $('#submit-export-excel').trigger('click');
    });
});


function eliminar($id, $url, $token) {
    swal({
            title: "Eliminar registro",
            text: "Estas seguro de eliminar este registro",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, // "{{ url('/dashboard/role/delete') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Eliminando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Registro eliminado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function activar($id, $url, $token) {
    swal({
            title: "Activar registro",
            text: "Estas seguro de activar?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, // "{{ url('/dashboard/role/active') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Activando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Activado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function desactivar($id, $url, $token) {
    swal({
            title: "Desactivar registro",
            text: "Estas seguro de desactivar",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, //"{{ url('/dashboard/role/desactive') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Desactivando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Desactivado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function load(url = null) {
    var filters = get_filters();
    var url = url ? url : url_cliente_load;
    console.log(filters);
    $.get(url, filters, function(data) {
        $('#table-content').html(data);
        //init_functions();
    });
}

function load_product_list(url = null) {
    var filters = get_filters();
    var url = url ? url : url_producto_list_load;

    $.get(url, filters, function(data) {
        $('#table-content-product').html(data);
        //init_functions();
    });
}
