<?php $utente = session('utente'); ?>
<?php $differenza_mese = $statistiche_budget_mensile[1]->valore - $statistiche_budget_mensile[0]->valore; ?>

@include('common.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PROMEDYA | Sales Force
            <small>&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
        <br>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                <!-- Bar chart -->
                <div class="card card-warning">
                    <div class="card-header" style="color:white;background-color:lightseagreen">
                        <h3 class="card-title">
                            Statistiche Budget
                        </h3>
                        {{--
                                                <h3 class="card-title" style="background: white;border-color: white;"><?php echo number_format($differenza[0]->valore,2,',',' ');?> € </h3>
                        --}}
                    </div>
                    <div class="card-body">
                        <div style="height:240px!important; max-height: 233px!important; max-width: 100%!important;">
                            <?php foreach ($statistiche_budget as $s){ ?>
                            <div style="margin:5%;display: flex;align-content:self-end;justify-content: space-between">
                                <label style="width: 30%"><?php echo $s->type; ?>
                                </label>
                                <input type="text"
                                       style="width: 40%;margin-right:5%;text-align: right;<?php if($s->type != 'Budget') echo 'color:green;'; ?>"
                                       readonly class="form-control"
                                       value="<?php echo number_format($s->valore,2,',',' ');?>">
                                <input type="text" class="form-control"
                                       style="width: 25%;text-align: right;<?php if($s->type != 'Budget') echo 'color:green;'; ?>"
                                       readonly
                                       value="<?php if($s->type == 'Budget') echo '100%'; else echo number_format((1 - (floatval($statistiche_budget[0]->valore-$statistiche_budget[1]->valore)/$statistiche_budget[0]->valore))*100,2,',','').'%';?>">
                            </div>
                            <?php } ?>
                            <div style="margin:5%;display: flex;align-content:self-end;justify-content: space-between">
                                <label style="width: 30%">Obiettivo</label>
                                <input type="text"
                                       style="width: 40%;margin-right:5%;text-align: right;<?php if($differenza[0]->valore <= 0) echo 'color:red;';?>"
                                       readonly class="form-control"
                                       value="<?php echo number_format($differenza[0]->valore,2,',',' ');?>">
                                <input type="text" class="form-control"
                                       style="width: 25%;text-align: right;<?php if($differenza[0]->valore <= 0) echo 'color:red;';?>"
                                       readonly
                                       value="<?php if($differenza[0]->valore <= 0) echo '-';else echo '+';?><?php echo number_format(abs(100-(1 - (($statistiche_budget[0]->valore-$statistiche_budget[1]->valore)/$statistiche_budget[0]->valore))*100),2,',','').'%';?>">
                            </div>
                        </div>
                        {{-- <canvas id="donutBUDGETChart"
                                 style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>--}}
                    </div>
                    <!-- /.card-body-->

                </div>
            </div>
            <div class="col-xl-4 col-sm-12" style="display:flex;width: 100%;gap: 2%;">
                <!-- Bar chart -->
                <div class="card card-fuchsia" style="width: 50%;">
                    <div class="card-header">
                        <h3 class="card-title">
                            Sales Best Performer Annuale
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="donutAnnualePERFORMERChart"
                                style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>
                    </div>
                    <!-- /.card-body-->

                </div>
                <div class="card card-fuchsia" style="width: 50%;">
                    <div class="card-header">
                        <h3 class="card-title">
                            Sede Best Performer Annuale
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="donutAnnualePERFORMERZONAChart"
                                style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>
                    </div>
                    <!-- /.card-body-->

                </div>
            </div>
            {{--<div class="col-xl-3 col-sm-12">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Statistiche Sales LEAD (TOTALE)</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>--}}
            <div class="col-xl-5 col-sm-12">
                <!-- Bar chart -->
                <div class="card card-fuchsia">
                    <div class="card-header">
                        <h3 class="card-title">
                            Prodotto Best Performer Annuale
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="donutAnnualeProdottoPERFORMERChart"
                                style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>
                    </div>
                    <!-- /.card-body-->

                </div>
            </div>
            <div class="col-xl-12 col-sm-12">
                <!-- Bar chart -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            Statistiche {{$mese_usato}}
                        </h3>

                        <div class="card-tools">
                            <input type="date" class="btn btn-tool" onchange="changeData()" id="data_mese">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-sm-12">
                            <!-- Bar chart -->
                            <div
                                style="height:240px!important; max-height: 233px!important; max-width: 100%!important;">
                                <?php foreach ($statistiche_budget_mensile as $s){ ?>
                                <div
                                    style="margin:5%;display: flex;align-content:self-end;justify-content: space-between">
                                    <label style="width: 30%"><?php echo $s->type; ?>
                                    </label>
                                    <input type="text"
                                           style="width: 40%;margin-right:5%;text-align: right;<?php if($s->type != 'Budget') echo 'color:green;'; ?>"
                                           readonly class="form-control"
                                           value="<?php echo number_format($s->valore,2,',',' ');?>">
                                    <input type="text" class="form-control"
                                           style="width: 25%;text-align: right;<?php if($s->type != 'Budget') echo 'color:green;'; ?>"
                                           readonly
                                           value="<?php if($s->type == 'Budget') echo '100%'; else echo number_format((1 - (floatval($statistiche_budget_mensile[0]->valore-$statistiche_budget_mensile[1]->valore)/$statistiche_budget_mensile[0]->valore))*100,2,',','').'%';?>">
                                </div>
                                <?php } ?>
                                <div
                                    style="margin:5%;display: flex;align-content:self-end;justify-content: space-between">
                                    <label style="width: 30%">Obiettivo</label>
                                    <input type="text"
                                           style="width: 40%;margin-right:5%;text-align: right;<?php if($differenza_mese<= 0) echo 'color:red;';?>"
                                           readonly class="form-control"
                                           value="<?php echo number_format($differenza_mese,2,',',' ');?>">
                                    <input type="text" class="form-control"
                                           style="width: 25%;text-align: right;<?php if($differenza_mese<= 0) echo 'color:red;';?>"
                                           readonly
                                           value="<?php if($differenza_mese<= 0) echo '-';else echo '+';?><?php echo number_format(abs(100-(1 - (($statistiche_budget_mensile[0]->valore-$statistiche_budget_mensile[1]->valore)/$statistiche_budget_mensile[0]->valore))*100),2,',','').'%';?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-3 col-sm-12">
                            <div class="card-body">
                                <canvas id="donutMESEChart"
                                        style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-12">
                            <div class="card-body">
                                <canvas id="donutMESESalesChart"
                                        style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-12">
                            <div class="card-body">
                                <canvas id="donutMESEProdottoChart"
                                        style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body-->
                </div>
            </div>
            <div class="col-xl-6 col-sm-12">
                <!-- Bar chart -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Statistiche Mensili LEAD
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="barChart"
                                style="height: 250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>
                    </div>
                    <!-- /.card-body-->

                </div>
            </div>
            <div class="col-xl-6 col-sm-12">
                <!-- STACKED BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Statistiche x Categoria</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="stackedBarChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
    </section>
</div>
</div>
<!-- /.container-fluid-->
@include('common.footer')

<script type="text/javascript">
    function changeData() {
        var data = $('#data_mese').val();
        top.location.href = '/statistiche/' + data;
    }


    // BEST PERFORMER SALES MESE
    // STATISTICHE MESE CORRENTE

    var donutMESESalesChartCanvas = $('#donutMESESalesChart').get(0).getContext('2d')
    var donutMESESalesData = {
        labels: [
            <?php $sales = '';
            foreach ($statistiche_corrente_sales as $s) {
                $sales .= '\'' . $s->Sales . '\',';
            }
            $sales = substr($sales, 0, strlen($sales) - 1);
            echo $sales;
            ?>
        ],
        datasets: [
            {
                data: [
                    <?php $sales = ''; foreach ($statistiche_corrente_sales as $s) {
                        $sales .= $s->Val . ',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],
                backgroundColor: [

                    <?php $sales = ''; foreach ($statistiche_corrente_sales as $s) {
                        $sales .= '\'#' . substr(md5(mt_rand()), 0, 6) . '\',';

                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],

                borderColor: [
                    <?php $sales = ''; foreach ($statistiche_corrente_sales as $s) {
                        $sales .= '\'#999999\',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>
                ],
            }
        ]
    }
    var donutMESESalesOptions = {
        datasetLabel: false,
        maintainAspectRatio: false,
        responsive: true,
    }

    new Chart(donutMESESalesChartCanvas, {
        type: 'doughnut',
        data: donutMESESalesData,
        options: donutMESESalesOptions
    });


    // BEST PERFORMER PRODOTTO MESE
    // STATISTICHE MESE CORRENTE

    var donutMESEProdottoChartCanvas = $('#donutMESEProdottoChart').get(0).getContext('2d')
    var donutMESEProdottoData = {
        labels: [
            <?php $sales = '';
            foreach ($statistiche_corrente_prodotto as $s) {
                $sales .= '\'' . $s->gruppo . '\',';
            }
            $sales = substr($sales, 0, strlen($sales) - 1);
            echo $sales;
            ?>
        ],
        datasets: [
            {
                data: [
                    <?php $sales = ''; foreach ($statistiche_corrente_prodotto as $s) {
                        $sales .= $s->Val . ',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],
                backgroundColor: [

                    <?php $sales = ''; foreach ($statistiche_corrente_prodotto as $s) {
                        $sales .= '\'#' . substr(md5(mt_rand()), 0, 6) . '\',';

                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],

                borderColor: [
                    <?php $sales = ''; foreach ($statistiche_corrente_prodotto as $s) {
                        $sales .= '\'#999999\',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>
                ],
            }
        ]
    }
    var donutMESEProdottoOptions = {
        responsive: true,
        legend: {
            display: false
        },
        maintainAspectRatio: false,
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true
            },
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }

    new Chart(donutMESEProdottoChartCanvas, {
        type: 'bar',
        data: donutMESEProdottoData,
        options: donutMESEProdottoOptions
    });


    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    /*  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      var donutData = {
          labels: [
<?php $sales = ''; foreach ($statistiche_sales as $s) {
        if ($s->Sales != null && $s->Sales != '')
            $sales .= '\'' . $s->Sales . '\',';
    }
    $sales = substr($sales, 0, strlen($sales) - 1);
    echo $sales;
    ?>
    ],
    datasets: [
        {
            data: [
<?php $sales = ''; foreach ($statistiche_sales as $s) {
        if ($s->Sales != null && $s->Sales != '')
            $sales .= $s->Val . ',';
    }
    $sales = substr($sales, 0, strlen($sales) - 1);
    echo $sales;
    ?>

    ],
    backgroundColor: [

<?php $sales = ''; foreach ($statistiche_sales as $s) {
        if ($s->Sales != null && $s->Sales != '')
            $sales .= '\'#' . substr(md5(mt_rand()), 0, 6) . '\',';

    }
    $sales = substr($sales, 0, strlen($sales) - 1);
    echo $sales;
    ?>

    ],

    borderColor: [
<?php $sales = ''; foreach ($statistiche_sales as $s) {
        if ($s->Sales != null && $s->Sales != '')
            $sales .= '\'#999999\',';
    }
    $sales = substr($sales, 0, strlen($sales) - 1);
    echo $sales;
    ?>
    ],
}
]
}
var donutOptions = {
datasetLabel: false,
maintainAspectRatio: false,
responsive: true,
}

//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
new Chart(donutChartCanvas, {
type: 'doughnut',
data: donutData,
options: donutOptions
});
*/
    const data = {
        labels: [
            <?php $sales = ''; foreach ($statistiche_mensili as $s) {
                if ($s->Data != null && $s->Data != '')
                    $sales .= '\'' . $s->Data . '\',';
            }
            $sales = substr($sales, 0, strlen($sales) - 1);
            echo $sales;
            ?>],
        datasets: [{
            data: [
                <?php $sales = ''; foreach ($statistiche_mensili as $s) {
                    if ($s->Data != null && $s->Data != '')
                        $sales .= '\'' . $s->Val . '\',';
                }
                $sales = substr($sales, 0, strlen($sales) - 1);
                echo $sales;
                ?>],
            backgroundColor: [
                <?php $sales = ''; foreach ($statistiche_mensili as $s) {
                    if ($s->Data != null && $s->Data != '')
                        $sales .= '\'#' . substr(md5(mt_rand()), 0, 6) . '\',';
                }
                $sales = substr($sales, 0, strlen($sales) - 1);
                echo $sales;
                ?>
            ],
            borderColor: [
                <?php $sales = ''; foreach ($statistiche_mensili as $s) {
                    if ($s->Data != null && $s->Data != '')
                        $sales .= '\'#000000\',';
                }
                $sales = substr($sales, 0, strlen($sales) - 1);
                echo $sales;
                ?>
            ],
            borderWidth: 2
        }]
    };
    var barChart = $("#barChart").get(0).getContext('2d');
    new Chart(barChart, {
        type: 'bar',
        data: data,
        options: {
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    })

    /* END BAR CHART */

    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')

    var stackedBarChartData = {
        labels: [
            <?php $mesi = ''; foreach ($statistiche_categoria as $s) {
                if ($s->Data != null && $s->Data != '') {
                    $mesi = str_replace('\'' . $s->Data . '\',', '', $mesi);
                    $mesi .= '\'' . $s->Data . '\',';

                }
            }
            $mesi = substr($mesi, 0, strlen($mesi) - 1);
            echo $mesi;
            ?>],
        datasets: [
            <?php
            $sales = '';

            $mesi_util = trim($mesi, "'");

            $mesi_util = explode("','", $mesi_util);

            foreach ($categoria as $p) {
                $sales .= '
                {
                label: \'' . $p->Categoria . '\',
                borderColor: \'#' . substr(md5(mt_rand()), 0, 6) . '\',
                backgroundColor: \'#' . substr(md5(mt_rand()), 0, 6) . '\',
                pointRadius: false,
                borderWidth: 2,
                data: [';
                $sales2 = '';
                foreach ($mesi_util as $m) {
                    $i = 0;
                    foreach ($statistiche_categoria as $c) {
                        if ($m == $c->Data) {
                            if ($c->Categoria == $p->Categoria) {
                                $i++;
                                $sales2 .= $c->Val . ',';
                            }
                        }
                    }
                    if ($i == 0) {
                        $sales2 .= '0,';
                    }

                }
                $sales2 = substr($sales2, 0, strlen($sales2) - 1);
                $sales .= $sales2 . ']
                },';
            }
            $sales = substr($sales, 0, strlen($sales) - 1);
            echo $sales;
            ?>
        ]
    }

    var stackedBarChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true
            },
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }

    new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: stackedBarChartOptions
    })


    // STATISTICHE MESE CORRENTE

    var donutMESEChartCanvas = $('#donutMESEChart').get(0).getContext('2d')
    var donutMESEData = {
        labels: [
            <?php $sales = '';
            foreach ($statistiche_corrente as $s) {
                $val = '';
                if ($s->Vinta == 0) $val = 'PERSA';
                if ($s->Vinta == 1) $val = 'VINTA';
                if ($s->Vinta == 2) $val = 'IN CORSO';
                $sales .= '\'' . $val . '\',';
            }
            $sales = substr($sales, 0, strlen($sales) - 1);
            echo $sales;
            ?>
        ],
        datasets: [
            {
                data: [
                    <?php $sales = ''; foreach ($statistiche_corrente as $s) {
                        $sales .= $s->Val . ',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],
                backgroundColor: [

                    <?php $sales = ''; foreach ($statistiche_corrente as $s) {
                        $sales .= '\'#' . substr(md5(mt_rand()), 0, 6) . '\',';

                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],

                borderColor: [
                    <?php $sales = ''; foreach ($statistiche_corrente as $s) {
                        $sales .= '\'#999999\',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>
                ],
            }
        ]
    }
    var donutMESEOptions = {
        datasetLabel: false,
        maintainAspectRatio: false,
        responsive: true,
    }

    new Chart(donutMESEChartCanvas, {
        type: 'polarArea',
        data: donutMESEData,
        options: donutMESEOptions
    });


    var donuteAnnualePERFORMERChartCanvas = $('#donutAnnualePERFORMERChart').get(0).getContext('2d')
    var donutAnnualePERFORMERData = {
        labels: [
            <?php $sales = ''; foreach ($statistiche_sales_vinte as $s) {
                if ($s->Sales != null && $s->Sales != '')
                    $sales .= '\'' . $s->Sales . '\',';
            }
            $sales = substr($sales, 0, strlen($sales) - 1);
            echo $sales;
            ?>
        ],
        datasets: [
            {
                data: [
                    <?php $sales = ''; foreach ($statistiche_sales_vinte as $s) {
                        if ($s->Sales != null && $s->Sales != '')
                            $sales .= $s->Val . ',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],
                backgroundColor: [

                    <?php $sales = ''; foreach ($statistiche_sales_vinte as $s) {
                        if ($s->Sales != null && $s->Sales != '')
                            $sales .= '\'#' . substr(md5(mt_rand()), 0, 6) . '\',';

                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],

                borderColor: [
                    <?php $sales = ''; foreach ($statistiche_sales_vinte as $s) {
                        if ($s->Sales != null && $s->Sales != '')
                            $sales .= '\'#999999\',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>
                ],
            }
        ]
    }

    var donutAnnualePERFORMEROptions = {
        datasetLabel: false,
        maintainAspectRatio: false,
        responsive: true,
    }

    new Chart(donuteAnnualePERFORMERChartCanvas, {
        type: 'doughnut',
        data: donutAnnualePERFORMERData,
        options: donutAnnualePERFORMEROptions
    });

    var donutAnnualeProdottoPERFORMERChart = $('#donutAnnualeProdottoPERFORMERChart').get(0).getContext('2d')
    var donutAnnualeProdottoPERFORMERData = {
        labels: [
            <?php $sales = ''; foreach ($statistiche_corrente_prodotto_annuale as $s) {
                if ($s->gruppo != null && $s->gruppo != '')
                    $sales .= '\'' . $s->gruppo . ' (' . number_format(floatval(floatval($s->Val) * 100) / floatval($s->Percentuale), 2, ',', ' ') . '%)\',';
            }
            $sales = substr($sales, 0, strlen($sales) - 1);
            echo $sales;
            ?>
        ],
        datasets: [
            {
                data: [
                    <?php $sales = ''; foreach ($statistiche_corrente_prodotto_annuale as $s) {
                        if ($s->gruppo != null && $s->gruppo != '')
                            $sales .= $s->Val . ',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],
                backgroundColor: [

                    <?php $sales = ''; foreach ($statistiche_corrente_prodotto_annuale as $s) {
                        if ($s->gruppo != null && $s->gruppo != '')
                            $sales .= '\'#' . substr(md5(mt_rand()), 0, 6) . '\',';

                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],

                borderColor: [
                    <?php $sales = ''; foreach ($statistiche_corrente_prodotto_annuale as $s) {
                        if ($s->gruppo != null && $s->gruppo != '')
                            $sales .= '\'#999999\',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>
                ],
            }
        ]
    }

    var donutAnnualeProdottoPERFORMEROptions = {
        responsive: true,
        legend: {
            display: false
        },
        maintainAspectRatio: false,
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true
            },
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }

    new Chart(donutAnnualeProdottoPERFORMERChart, {
        type: 'bar',
        data: donutAnnualeProdottoPERFORMERData,
        options: donutAnnualeProdottoPERFORMEROptions
    });


    var donuteAnnualePERFORMERZONAChartCanvas = $('#donutAnnualePERFORMERZONAChart').get(0).getContext('2d')
    var donutAnnualePERFORMERZONAData = {
        labels: [
            <?php $sales = ''; foreach ($statistiche_sales_vinte_zona as $s) {
                if ($s->Sales != null && $s->Sales != '')
                    $sales .= '\'' . $s->Sales . ' (' . number_format(floatval(floatval($s->Val) * 100) / floatval($s->Percentuale), 2, ',', ' ') . '%)\',';
            }
            $sales = substr($sales, 0, strlen($sales) - 1);
            echo $sales;
            ?>
        ],
        datasets: [
            {
                data: [
                    <?php $sales = ''; foreach ($statistiche_sales_vinte_zona as $s) {
                        if ($s->Sales != null && $s->Sales != '')
                            $sales .= $s->Val . ',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],
                backgroundColor: [

                    <?php $sales = ''; foreach ($statistiche_sales_vinte_zona as $s) {
                        if ($s->Sales != null && $s->Sales != '')
                            $sales .= '\'#' . substr(md5(mt_rand()), 0, 6) . '\',';

                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],

                borderColor: [
                    <?php $sales = ''; foreach ($statistiche_sales_vinte_zona as $s) {
                        if ($s->Sales != null && $s->Sales != '')
                            $sales .= '\'#999999\',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>
                ],
            }
        ]
    }

    var donutAnnualePERFORMERZONAOptions = {
        datasetLabel: false,
        maintainAspectRatio: false,
        responsive: true,
    }

    new Chart(donuteAnnualePERFORMERZONAChartCanvas, {
        type: 'doughnut',
        data: donutAnnualePERFORMERZONAData,
        options: donutAnnualePERFORMERZONAOptions
    });
</script>
