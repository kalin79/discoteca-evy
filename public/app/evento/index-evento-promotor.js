$(document).ready(function() {
    load();
    var data_fields = [
        {"id": 1, "text": "Promotores", type:'list', field : 'promotor_id',list: function(){return list_promtor()}, 'type_select2':true},
    ];

    function list_promtor() {
        return get_list(url_promotores_list);
    }

    $("#cmb-field").select2({
        theme: "bootstrap4",
        "data": data_fields,
        placeholder: "Buscar por",
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
        rules: {},

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
        promotor_id: { required: true },
        zona_id: { required: true },
    }
    ModalCRUD.create({
        title: 'Evento-Promotor',
        element: '.entity-create',
        form_element: '#form-evento-promotor-create',
        element_is_load: true,
        isLoadFromAjax: false,
        rules: rules,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {
            load_functions();
        },
        afterSuccess: function() {
            load();

        }
    });

    $(document).on('click', '.pagination li a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        load(url);
    });

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
        $("#evento_id").val($("#evento_data_id").val());
        $('#valor_filter_excel').val(value_filter.toString());
        $('#title_filter_excel').val(title_filter.toString());
        $('#submit-export-excel').trigger('click');
    });


});


function eliminar($id, $url) {
    swal({
        title: "Dar de baja",
        text: "Estas seguro de dar de baja a este registro",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, //"{{ url('/dashboard/user/delete') }}",
                    method: 'post',
                    data: {
                        id: $id
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
            /*else {
                  swal("Your imaginary file is safe!");
                }*/
        });
}

function activar($id, $url) {
    swal({
        title: "Activar Registro",
        text: "Estas seguro activar el registro",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, //"{{ url('/dashboard/user/active') }}",
                    method: 'post',
                    data: {
                        id: $id
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Registro activado correctamente", {
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
            /*else {
                  swal("Your imaginary file is safe!");
                }*/
        });
}

function desactivar($id, $url) {

    swal({
        title: "Desactivar Registro",
        text: "Estas seguro desactivar este registro",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, //"{{ url('/dashboard/user/desactive') }}",
                    method: 'post',
                    data: {
                        id: $id
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Registro desactivado correctamente", {
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
    var url = url ? url : url_evento_promotor_load;

    $.get(url, filters, function(data) {
        $('#table-content-promotor').html(data);
        init_functions();
    });
}

var init_functions = function() {
    ModalCRUD.edit({
        title: 'Evento-Promotor',
        element: '.edit-entity',
        element_is_load: true,
        form_element: '#form-evento-promotor-edit',
        isLoadFromAjax: false,
        url: function(element) {
            return $(element).attr("href");
        },
        initialized: function() {
            load_functions();
        },
        afterSuccess: function() {
            load();
        }
    });
}

var load_functions = function() {
    $("#cmb_promotor").select2({
        theme: "bootstrap4",
        dropdownParent: $('.bootbox'),
        allowClear: true,
        placeholder: "Seleccione promotor"
    });

    $("#cmb_zona").select2({
        theme: "bootstrap4",
        dropdownParent: $('.bootbox'),
        allowClear: true,
        placeholder: "Seleccione zona"
    });
}
