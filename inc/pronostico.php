<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";


?>

<div id="prueba">
    
</div>

<div class="col-lg-12">

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-8">
            <h2><strong>PRONÓSTICO</strong></h2>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>
    </div>
</div>
</div>

<form method="post" autocomplete="on" id="formCompute_forecast">
<div class="card">
<div class="card-body">
    <div class="row">
            <div class="col-lg-2">
                <label for="fecha_inicio">Fecha Inicio</label>
                <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" required>
            </div> 
            <div class="col-lg-2">
                <label for="fecha_fin">Fecha Fin</label>
                <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" required>
            </div> 
            <div class="col-lg-1">
                <label for="posesion">En posesión</label>
                <select class="form-control js-example-data-array" id="posesion" name="posesion">
                                <?php
                                #codigo para la lista de sucursales que se extraen de la base de datos
                                $result = mysqli_query($conexion,"SELECT idusuario,usuario_acceso,nombre FROM usuario order by usuario_acceso desc");                        
                                if (mysqli_num_rows($result) > 0) {  
                                    echo "<option selected value='todos'>Todos</option>";
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    echo "<option value='".$row["idusuario"]."'>".$row["usuario_acceso"]."</option>";
                                  }
                                }
                                ?>
                </select>
            </div> 
            <div class="col-lg-1">
                <label for="cobrador">Cobrador</label>
                <select class="form-control js-example-data-array" id="cobrador" name="cobrador">
                                <?php
                                #codigo para la lista de sucursales que se extraen de la base de datos
                                $result = mysqli_query($conexion,"SELECT idusuario,usuario_acceso,nombre FROM usuario order by usuario_acceso desc");                        
                                if (mysqli_num_rows($result) > 0) 
                                {  
                                  echo "<option selected value='todos'>Todos</option>";
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    echo "<option value='".$row["idusuario"]."'>".$row["usuario_acceso"]."</option>";
                                  }
                                }
                                ?>
                </select>
            </div>
            <div class="col-lg-1">
                <br>
                <button type="submit" class="btn btn-lg btn-primary" id="compute_forecast">Calcular</button>
            </div>
    </div>
</div>
</div>
</form>

<br>

<div class="row">
    <div class="col-lg-7">
        <div class="card">
        <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Mensual</th>
                        <th>Quincenal</th>
                        <th>Semanal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <th scope="row">Ideal</th>
                      <td align="center"></td>
                      <td align="center"></td>
                      <td align="center"></td>
                      <td align="center"></td>
                    </tr>
                    <tr>
                      <th scope="row">Acuerdo</th>
                      <td align="center"></td>
                      <td align="center"></td>
                      <td align="center"></td>
                      <td align="center"></td>
                    </tr>
                    <tr>
                      <th scope="row">Real</th>
                      <td align="center"></td>
                      <td align="center"></td>
                      <td align="center"></td>
                      <td align="center"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>
</div>


</div>



<!-- para la grafica -->
<!--
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class="col-lg-12">
    <figure class="highcharts-figure">
        <div id="container"></div>
            <p class="highcharts-description">
            </p>
    </figure>      
</div>
-->

<br><br>

<script type="text/javascript">

document.getElementById('divzoom').style.zoom = "100%";
document.getElementById('page-top').style.zoom = "80%";

// A point click event that uses the Renderer to draw a label next to the point
// On subsequent clicks, move the existing label instead of creating a new one.
/*
Highcharts.addEvent(Highcharts.Point, 'click', function () {
    if (this.series.options.className.indexOf('popup-on-click') !== -1) {
        const chart = this.series.chart;
        const date = Highcharts.dateFormat('%A, %b %e, %Y', this.x);
        const text = `<b>${date}</b><br/>${this.y} ${this.series.name}`;

        const anchorX = this.plotX + this.series.xAxis.pos;
        const anchorY = this.plotY + this.series.yAxis.pos;
        const align = anchorX < chart.chartWidth - 200 ? 'left' : 'right';
        const x = align === 'left' ? anchorX + 10 : anchorX - 10;
        const y = anchorY - 30;
        if (!chart.sticky) {
            chart.sticky = chart.renderer
                .label(text, x, y, 'callout',  anchorX, anchorY)
                .attr({
                    align,
                    fill: 'rgba(0, 0, 0, 0.75)',
                    padding: 10,
                    zIndex: 7 // Above series, below tooltip
                })
                .css({
                    color: 'white'
                })
                .on('click', function () {
                    chart.sticky = chart.sticky.destroy();
                })
                .add();
        } else {
            chart.sticky
                .attr({ align, text })
                .animate({ anchorX, anchorY, x, y }, { duration: 250 });
        }
    }
});


Highcharts.chart('container', {

    chart: {
        scrollablePlotArea: {
            minWidth: 700
        }
    },

    data: {
        csvURL: 'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/analytics.csv',
        beforeParse: function (csv) {
            return csv.replace(/\n\n/g, '\n');
        }
    },

    title: {
        text: 'Daily sessions at www.highcharts.com',
        align: 'left'
    },

    subtitle: {
        text: 'Source: Google Analytics',
        align: 'left'
    },

    xAxis: {
        tickInterval: 7 * 24 * 3600 * 1000, // one week
        tickWidth: 0,
        gridLineWidth: 1,
        labels: {
            align: 'left',
            x: 3,
            y: -3
        }
    },

    yAxis: [{ // left y axis
        title: {
            text: null
        },
        labels: {
            align: 'left',
            x: 3,
            y: 16,
            format: '{value:.,0f}'
        },
        showFirstLabel: false
    }, { // right y axis
        linkedTo: 0,
        gridLineWidth: 0,
        opposite: true,
        title: {
            text: null
        },
        labels: {
            align: 'right',
            x: -3,
            y: 16,
            format: '{value:.,0f}'
        },
        showFirstLabel: false
    }],

    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    tooltip: {
        shared: true,
        crosshairs: true
    },

    plotOptions: {
        series: {
            cursor: 'pointer',
            className: 'popup-on-click',
            marker: {
                lineWidth: 1
            }
        }
    },

    series: [{
        name: 'All sessions',
        lineWidth: 4,
        marker: {
            radius: 4
        }
    }, {
        name: 'New users'
    }]
});
*/
</script>

<?php 
ob_end_flush();
include_once "footer.php"; 
?>
