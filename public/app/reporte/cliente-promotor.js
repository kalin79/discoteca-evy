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


    $("#btn-export-excel").on('click',function (){
        if($("#has_filtro").val()==1){
            window.open('/admin/reporte-cliente-promotor/export-data?promotor_id=' + $('#cmb_promotores').val() , '_target');
        }else{
            window.open('/admin/reporte-cliente-promotor/export-data', '_target');
        }


    });


});

function load(url = null,filter=null) {
    var url = url ? url : url_reporte_load;
    // console.log(3)
    $.get(url,filter ,function(data) {
        $('#table-content').html(data);
        $(document).on('click', '.pagination li a', function(e) {
            e.preventDefault();
            var url_page = $(this).attr('href');
            var filtro ={
                promotor_id:$('#cmb_promotores').val(),
            };
            //console.log(url_page,filtro);
            load(url_page,filtro);
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
