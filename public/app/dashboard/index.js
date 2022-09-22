jQuery(function() {

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
        //zIndex: 2048,
    });
    $('#end_date').datepicker({
        startDate: null,
        language: 'es-ES',
        autoHide: true,
        //zIndex: 2048,
    });

    $("#btn-add-filter").on('click',function (){

    });
    $.ajax({
        url: url_load_chart,
        type: 'get',
        data: {
            fecha_inicio:$('#init_date').val(),
            fecha_fin: $('#end_date').val()
        },
        success: function(response){

            $("#table-content").html(response.reporte_general.view)
            /*var idChartClientsMonthly = 'chart';
            var optionsChartClientsMonthly = getBaseOptionsChart(idChartClientsMonthly, 'bar', '', '');
            optionsChartClientsMonthly.fill = {};
            optionsChartClientsMonthly.labels = ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
                'United States', 'China', 'Germany'
            ];
            optionsChartClientsMonthly.series = [{
                name:'Codigos',
                data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
            }];


            if ($('#' + idChartClientsMonthly).html() != '') {
                ApexCharts.exec(idChartClientsMonthly, 'destroy', optionsChartClientsMonthly, true, true);
            }

            var ChartClientsMonthly = new ApexCharts(
                document.querySelector("#" + idChartClientsMonthly),
                optionsChartClientsMonthly
            );
            ChartClientsMonthly.render();*/

        }
    });

});

function  getBaseOptionsChart (id, type, label, title) {
    return {
        chart: {
            id: id,
            height: 350,
            width: '100%',
            type: type,
            events: {
                click: function (event, chartContext, config) {
                    // if (config.dataPointIndex >= 0) {
                    //     let client = this.result.hours.clients[config.dataPointIndex];
                    //     console.log(client)
                    // }
                }
            },
            stacked: true,
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true
            }
        },
        dataLabels: {
            enabled: false,
            formatter: function (val) {
                if (type == "area") {
                    return val + " " + label;
                } else {
                    return val.toFixed(2) + label;
                }

            },
        },
        labels: [],
        series: [],
        xaxis: {
            categories: [],

        },
        legend: {
            position: 'bottom',
        },
        title: {
            text: title,
            align: 'center',
            style: {
                fontSize: '20px',
            },
        },
        stroke: {
            curve: 'smooth'
        },
        fill: {
            type: 'gradient',
            gradient: {
                opacityFrom: 0.7,
                opacityTo: 1,
            }
        },
        plotOptions: {
            bar: {

                horizontal: false,
                columnWidth: '50%',
                endingShape: 'rounded'
            },
        },
        responsive: [{
            breakpoint: 320,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    }
}
