</div>
<footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <b>IKSPI KERA SAKTI CAB. SUMENEP-KALIANGET</b>
        </div>
        All rights
        reserved. | Created by <a href='' title='' target='_blank'>RMS</a>
        
    </div>
    <!-- /.container -->
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=$base_url;?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=$base_url;?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=$base_url;?>/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=$base_url;?>/assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- Select2 -->
<script src="<?=$base_url;?>/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=$base_url;?>/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- DataTables -->
<script src="<?=$base_url;?>/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$base_url;?>/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=$base_url;?>/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=$base_url;?>/assets/dist/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="<?=$base_url;?>/assets/bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?=$base_url;?>/assets/bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT LABELS PLUGIN -->
<script src="<?=$base_url;?>/assets/bower_components/Flot/jquery.flot.axislabels.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?=$base_url;?>/assets/bower_components/Flot/jquery.flot.categories.js"></script>
<script>
$(function() {
    /*
     * BAR CHART
     * ---------
     */
    $.ajax({
        type: "GET",
        url: '<?=$base_url;?>proses/statistik.php',
        dataType: 'json',
        success: function(e) {
            chartBar2(e);
        }
    });


    $('.datatable').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': false
    })

    //Initialize Select2 Elements
    $('.select2').select2()

    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    })
})

function chartBar2(x) {
    var data = x;
    console.log(data);

    var dataset = [{
        label: "Umur",
        data: data,
        color: "#5482FF"
    }];
    var ticks = [
        [0, "5 - 10"],
        [1, "11 - 17"],
        [2, "18 - 35"]
    ];

    var options = {
        series: {
            bars: {
                show: true
            }
        },
        bars: {
            align: "center",
            barWidth: 0.5
        },
        xaxis: {
            axisLabel: "Umur Pendaftar",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10,
            ticks: ticks
        },
        yaxis: {
            axisLabel: "Jumlah Pendaftar",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 3,
            tickFormatter: function(v, axis) {
                return v;
            }
        },
        legend: {
            noColumns: 0,
            labelBoxBorderColor: "#000000",
            position: "nw"
        },
        grid: {
            hoverable: true,
            borderWidth: 2,
            backgroundColor: {
                colors: ["#ffffff", "#EDF5FF"]
            }
        }
    };
    $.plot($("#flot-placeholder"), dataset, options);
    $("#flot-placeholder").UseTooltip();
}

function gd(year, month, day) {
    return new Date(year, month, day).getTime();
}

var previousPoint = null,
    previousLabel = null;

$.fn.UseTooltip = function() {
    $(this).bind("plothover", function(event, pos, item) {
        if (item) {
            if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                previousPoint = item.dataIndex;
                previousLabel = item.series.label;
                $("#tooltip").remove();

                var x = item.datapoint[0];
                var y = item.datapoint[1];

                var color = item.series.color;

                //console.log(item.series.xaxis.ticks[x].label);                

                showTooltip(item.pageX,
                    item.pageY,
                    color,
                    "<strong>" + item.series.label + "</strong><br>" + item.series.xaxis.ticks[x]
                    .label + " : <strong>" + y + "</strong> Orang");
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
};

function showTooltip(x, y, color, contents) {
    $('<div id="tooltip">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y - 40,
        left: x - 120,
        border: '2px solid ' + color,
        padding: '3px',
        'font-size': '9px',
        'border-radius': '5px',
        'background-color': '#fff',
        'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
        opacity: 0.9
    }).appendTo("body").fadeIn(200);
}

// function chartBar(data) {
//     var bar_data = {
//         label: 'Umur',
//         data: data,
//         color: '#3c8dbc'
//     }
//     $.plot('#bar-chart', [bar_data], {
//         grid: {
//             borderWidth: 1,
//             borderColor: '#f3f3f3',
//             tickColor: '#f3f3f3'
//         },
//         series: {
//             bars: {
//                 show: true,
//                 barWidth: 0.5,
//                 align: 'center'
//             }
//         },
//         xaxis: {
//             mode: 'categories',
//             tickLength: 0
//         },
//         yaxis: {
//             yaxisLabel: "tes"
//         }
//     })
//     /* END BAR CHART */
// }

function preview_foto(event) {

    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('viewfoto');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
</body>

</html>