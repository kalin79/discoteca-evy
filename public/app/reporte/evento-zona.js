jQuery(function() {
    $("#cmb_evento").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione evento",
        allowClear: true,
    })/*.on('select2:select', function (e) {
        var evento_id = $(this).val();
        $("#cmb_zona").html('');
        load_zonas(evento_id);
    })*/

    $("#cmb_zona").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione zona",
        allowClear: true,
    });

    $("#btn-add-filter").on('click',function (){
        var filter ={
            evento_id:$('#cmb_evento').val(),
            zona_id: $('#cmb_zona').val()
        };
        load(url_reporte_load,filter)

    });

    load();



    $("#btn-export-excel").on('click',function (){

        window.open('/admin/reporte-evento-zona/export-data?evento_id=' + $('#cmb_evento').val() + "&zona_id=" + $('#cmb_zona').val(), '_target');

    });




});

function load(url = null,filter=null) {
    var url = url ? url : url_reporte_load;
    // console.log(1)
    $.get(url,filter ,function(data) {
        $('#table-content').html(data);
        $(document).on('click', '.pagination li a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var filter ={
                evento_id:$('#cmb_evento').val(),
                zona_id: $('#cmb_zona').val()
            };
            load(url,filter);
            e.stopImmediatePropagation();
        });
    });
}


var load_zonas = function (ids) {
    $.ajax({
        url: url_list_zonas,
        data: { evento_id: ids },
        method: 'get',
        beforeSend: function () {
            $("#cmb_zona").html('<option>Cargando datos...</option>');
        },
        success: function (data) {
            $("#cmb_zona").html(data);
        }
    });
}
