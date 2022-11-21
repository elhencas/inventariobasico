<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 >Inicio</h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class="card card-body">
                        <?php 
                        $chartdata = $comp_model->barchart_saldosinventario();
                        ?>
                        <div>
                            <h4>Saldos Inventario</h4>
                            <small class="text-muted">Los 20 productos con mas movimiento y sus saldos</small>
                        </div>
                        <hr />
                        <canvas id="barchart_saldosinventario"></canvas>
                        <script>
                            $(function (){
                            var chartData = {
                            labels : <?php echo json_encode($chartdata['labels']); ?>,
                            datasets : [
                            {
                            label: 'Saldos',
                            backgroundColor:'<?php echo random_color(0.9); ?>',
                            type:'bar',
                            borderWidth:3,
                            data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                            },{
                            label: 'Rotacion',
                            fill:true,
                            backgroundColor:'<?php echo random_color(0.5); ?>',
                            borderWidth:3,
                            pointStyle:'circle',
                            pointRadius:5,
                            lineTension:0.1,
                            type:'line',
                            steppedLine:false,
                            data : <?php echo json_encode($chartdata['datasets'][1]); ?>,
                            }
                            ]
                            }
                            var ctx = document.getElementById('barchart_saldosinventario');
                            var chart = new Chart(ctx, {
                            type:'bar',
                            data: chartData,
                            options: {
                            scaleStartValue: 0,
                            responsive: true,
                            scales: {
                            xAxes: [{
                            ticks:{display: true},
                            gridLines:{display: true},
                            categoryPercentage: 1.0,
                            barPercentage: 0.8,
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            },
                            }],
                            yAxes: [{
                            ticks: {
                            beginAtZero: true,
                            display: true
                            },
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }]
                            },
                            }
                            ,
                            })});
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
