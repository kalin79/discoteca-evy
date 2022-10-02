jQuery(function() {
    load();
    var data_fields = [
        {"id": 1, "text": "Evento", type:'list', field : 'evento_id',list: function(){return list_evento()}, 'type_select2':true},
    ];


    function list_evento() {
        return get_list(url_evento_list);
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



function load(url = null) {
    // console.log(2)
    var filters = get_filters();
    var url = url ? url : url_reporte_general_load;
    console.log(filters);
    $.get(url, filters, function(data) {
        $('#table-content').html(data);
        //init_functions();
    });
}

