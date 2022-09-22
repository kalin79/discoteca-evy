jQuery(function() {
    $("#cmb_promotores").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione promotor",
        allowClear: true,
    })



    $("#btn-add-filter").on('click',function (){
        var filter ={
            promotor_id:$('#cmb_promotores').val(),
        };
        load(url_reporte_load,filter)

    });

    load();

    $(document).on('click', '.pagination li a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        load(url);
    });

    $("#btn-export-excel").on('click',function (){

        window.open('/admin/reporte-cliente-promotor/export-data?promotor_id=' + $('#cmb_promotores').val() , '_target');

    });


});

function load(url = null,filter=null) {
    var url = url ? url : url_reporte_load;

    $.get(url,filter ,function(data) {
        $('#table-content').html(data);
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