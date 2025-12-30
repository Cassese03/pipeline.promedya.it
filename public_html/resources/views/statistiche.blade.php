<?php $utente = session('utente'); ?>
<?php $differenza_mese = $statistiche_budget_mensile[1]->valore - $statistiche_budget_mensile[0]->valore; ?>
<?php $esito1 = 0;$esito2 = 0;$esito3 = 0; ?>
<?php foreach ($valore_disdette as $v) {
    if ($v->Esito == 0) $esito1 += $v->valore;
} ?>
<?php foreach ($valore_disdette as $v) {
    if ($v->Esito == 1) $esito2 += $v->valore;
} ?>
<?php foreach ($valore_disdette as $v) {
    if ($v->Esito == 2) $esito3 += $v->valore;
} ?>

@include('common.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="display: flex;justify-content: space-between">
        <h1 style="color:#007bff">
            PROMEDYA | Smart Sales Force
            <small>&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
        <div style="display: flex;">
            <h1 style="color:#007bff">
                Esercizio
                <small>&nbsp;&nbsp;<b id="countdown"></b></small>
            </h1>
            <input type="number" class="form-control" min="2024" step="1" max="2100"
                   value="{{intval(explode('-',$mese_usato)[1])}}"
                   onchange="top.location.href = '/statistiche/'+this.value+'-12-31';">
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xl-3 col-sm-12">
                <!-- Bar chart -->
                <div class="card card-warning">
                    <div class="card-header" style="color:white;background-color:lightseagreen">
                        <h3 class="card-title">
                            Statistiche Target Budget
                        </h3>
                        {{--
                                                <h3 class="card-title" style="background: white;border-color: white;"><?php echo number_format($differenza[0]->valore,2,',',' ');?> € </h3>
                        --}}
                    </div>
                    <div class="card-body">
                        <div style="height:262px!important; max-height: 262px!important; max-width: 100%!important;">
                            <?php foreach ($statistiche_budget as $s){ ?>
                            <div style="margin:5%;display: flex;align-content:self-end;justify-content: space-between">
                                <label style="width: 30%"><?php echo $s->type; ?>
                                </label>
                                <input type="text"
                                       style="width: 40%;margin-right:5%;text-align: right;<?php if($s->type == 'Budget') echo 'font-weight:bolder;'; if($s->type == 'Budget Progressivo')echo 'color:blue;'; ?>@if($s->type == 'Vendite') @if($statistiche_budget[2]->valore < $statistiche_budget[1]->valore) color:red; @else color:green; @endif @endif"
                                       readonly class="form-control"
                                       value="<?php echo number_format($s->valore,2,',',' ');?>">
                                <input type="text" class="form-control"
                                       style="width: 25%;text-align: right;<?php if($s->type == 'Budget') echo 'font-weight:bolder;'; if($s->type == 'Budget Progressivo')echo 'color:blue;'; ?>@if($s->type == 'Vendite') @if($statistiche_budget[2]->valore < $statistiche_budget[1]->valore) color:red; @else color:green; @endif @endif"
                                       readonly
                                       value="<?php if($s->type == 'Budget') echo '100%'; if($s->type == 'Vendite') echo number_format((1 - (floatval($statistiche_budget[0]->valore-$statistiche_budget[2]->valore)/$statistiche_budget[0]->valore))*100,2,',','').'%';if($s->type == 'Budget Progressivo') echo number_format((1 - (floatval($statistiche_budget[0]->valore-$statistiche_budget[1]->valore)/$statistiche_budget[0]->valore))*100,2,',','').'%';?>">
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
            <div class="col-xl-4 col-sm-12">
                <div class="card card-warning" style="height:95%">
                    <div class="card-header" style="color:white;background-color:lightseagreen">
                        <div style="display:flex;justify-content:space-between">
                            <h3 class="card-title">
                                Statistiche Target Vendite
                            </h3>
                            <div style="display: flex;justify-content: flex-start">
                                <label for="semestre" style="text-align: center">
                                    Semestre
                                </label>
                                <input style="margin-left: 5%;height: 75%"
                                       onchange="top.location.href= window.location.href.replace(window.location.search,'') + '?semestre=' + this.value"
                                       class="form-control" value="{{$semestre}}" type="number" step="1" min="1" max="2"
                                       name="semestre" id="semestre">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row large_device" style="height: 100%">
                            <div class="col-4">
                                <label style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                    Descrizione Obiettivo
                                </label>
                            </div>
                            <div class="col-4">
                                <label style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                    Target
                                </label>
                            </div>
                            <div class="col-4">
                                <label style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                    Vendite
                                </label>
                            </div>
                            @foreach($incentivi as $i)
                                <div class="col-4" style="margin-top:1%;margin-bottom:1%;">
                                    <input style="text-align: left;font-size:0.90rem!important;font-weight: bolder"
                                           readonly type="text" class="form-control"
                                           value="{{ str_replace('Subscription ','',$i->desc_obiettivo) }}">
                                </div>
                                <div class="col-4" style="margin-top:1%;margin-bottom:1%;">
                                    <input style="text-align: right;" readonly type="text"
                                           class="form-control"
                                           value="{{ number_format($i->target,2,',',' ') }}">
                                </div>
                                @if ($i->desc_obiettivo == 'Services')
                                    @foreach($statistiche_incentivi as $si)
                                        @if($si->type == 'SERVIZI')
                                            <div class="col-4" style="margin-top:1%;margin-bottom:1%;">
                                                <input
                                                    style="text-align: right;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                    readonly
                                                    type="text"
                                                    class="form-control"
                                                    value="{{ number_format($si->valore,2,',',' '); }}">
                                            </div>

                                            {{-- <div class="col-2" style="margin-top:1%;margin-bottom:1%;">
                                                 <input
                                                     style="text-align: right;font-weight:bolder;"
                                                     readonly type="text"
                                                     class="form-control"
                                                     value="{{ number_format($i->incentivo,2,',',' ') }}">
                                             </div>--}}
                                        @endif
                                    @endforeach
                                @endif

                                @if ($i->desc_obiettivo == 'Subscription New Customer')

                                    @foreach($statistiche_incentivi as $si)
                                        @if($si->type == 'Vendite_NEW')
                                            <div class="col-4" style="margin-top:1%;margin-bottom:1%;">
                                                <input
                                                    style="text-align: right;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                    readonly
                                                    type="text"
                                                    class="form-control"
                                                    value="{{ number_format($si->valore,2,',',' '); }}">
                                            </div>
                                            {{--
                                                                                        <div class="col-2" style="margin-top:1%;margin-bottom:1%;">
                                                                                            <input
                                                                                                style="text-align: right;font-weight:bolder;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                                                                readonly type="text"
                                                                                                class="form-control"
                                                                                                value="{{ number_format($i->incentivo,2,',',' ') }}">
                                                                                        </div>--}}
                                        @endif
                                    @endforeach
                                @endif

                                @if ($i->desc_obiettivo == 'Subscription Existing Customer')
                                    @foreach($statistiche_incentivi as $si)
                                        @if($si->type == 'Vendite_OLD')
                                            <div class="col-4" style="margin-top:1%;margin-bottom:1%;">
                                                <input
                                                    style="text-align: right;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                    readonly
                                                    type="text"
                                                    class="form-control"
                                                    value="{{ number_format($si->valore,2,',',' '); }}">
                                            </div>
                                            {{--
                                                                                        <div class="col-2" style="margin-top:1%;margin-bottom:1%;">
                                                                                            <input
                                                                                                style="text-align: right;font-weight:bolder;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                                                                readonly type="text"
                                                                                                class="form-control"
                                                                                                value="{{ number_format($i->incentivo,2,',',' ') }}">
                                                                                        </div>--}}
                                        @endif
                                    @endforeach
                                @endif

                            @endforeach
                        </div>
                        <div class="d-flex flex-column telefonino">
                            @foreach($incentivi as $i)
                                <div style="display:flex;margin-top:1%;margin-bottom:1%;">
                                    <input style="text-align: center;font-size:0.90rem!important;font-weight: bolder"
                                           readonly type="text" class="form-control"
                                           value="{{ $i->desc_obiettivo }}">
                                </div>

                                <div style="display:flex;margin-top:1%;margin-bottom:1%;">
                                    <label style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                        Target
                                    </label>
                                    <input style="text-align: right;" readonly type="text"
                                           class="form-control"
                                           value="{{ number_format($i->target,2,',',' ') }}">
                                </div>
                                @if ($i->desc_obiettivo == 'Services')
                                    @foreach($statistiche_incentivi as $si)
                                        @if($si->type == 'SERVIZI')
                                            <div style="display:flex;margin-top:1%;margin-bottom:1%;">

                                                <label
                                                    style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                                    Vendite
                                                </label>
                                                <input
                                                    style="text-align: right;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                    readonly
                                                    type="text"
                                                    class="form-control"
                                                    value="{{ number_format($si->valore,2,',',' '); }}">
                                            </div>

                                            {{--    <div style="display:flex;margin-top:1%;margin-bottom:1%;">

                                                    <label
                                                        style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                                        Incentivi
                                                    </label>
                                                    <input
                                                        style="text-align: right;font-weight:bolder;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                        readonly type="text"
                                                        class="form-control"
                                                        value="{{ number_format($i->incentivo,2,',',' ') }}">
                                                </div>--}}
                                        @endif
                                    @endforeach
                                @endif

                                @if ($i->desc_obiettivo == 'Subscription New Customer')

                                    @foreach($statistiche_incentivi as $si)
                                        @if($si->type == 'Vendite_NEW')
                                            <div style="display:flex;margin-top:1%;margin-bottom:1%;">

                                                <label
                                                    style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                                    Vendite
                                                </label>
                                                <input
                                                    style="text-align: right;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                    readonly
                                                    type="text"
                                                    class="form-control"
                                                    value="{{ number_format($si->valore,2,',',' '); }}">
                                            </div>

                                            {{--<div style="display:flex;margin-top:1%;margin-bottom:1%;">

                                                <label
                                                    style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                                    Incentivi
                                                </label><input
                                                    style="text-align: right;font-weight:bolder;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                    readonly type="text"
                                                    class="form-control"
                                                    value="{{ number_format($i->incentivo,2,',',' ') }}">
                                            </div>--}}
                                        @endif
                                    @endforeach
                                @endif

                                @if ($i->desc_obiettivo == 'Subscription Existing Customer')
                                    @foreach($statistiche_incentivi as $si)
                                        @if($si->type == 'Vendite_OLD')
                                            <div style="display:flex;margin-top:1%;margin-bottom:1%;">
                                                <label
                                                    style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                                    Vendite
                                                </label>
                                                <input
                                                    style="text-align: right;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                    readonly
                                                    type="text"
                                                    class="form-control"
                                                    value="{{ number_format($si->valore,2,',',' '); }}">
                                            </div>
                                            {{--
                                                                                        <div style="display:flex;margin-top:1%;margin-bottom:1%;">

                                                                                            <label
                                                                                                style="font-size:0.90rem!important;width:100%;text-align:center;color:blue;">
                                                                                                Incentivi
                                                                                            </label><input
                                                                                                style="text-align: right;font-weight:bolder;@if($i->target>$si->valore)color:red; @else color:green; @endif"
                                                                                                readonly type="text"
                                                                                                class="form-control"
                                                                                                value="{{ number_format($i->incentivo,2,',',' ') }}">
                                                                                        </div>--}}
                                        @endif
                                    @endforeach
                                @endif

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-sm-12">
                <div class="card card-warning">
                    <div class="card-header" style="color:white;background-color:lightseagreen">
                        <h3 class="card-title">
                            Statistiche Target
                            Opening
                        </h3>
                    </div>
                    <div class="card-body" style="padding:0!important;">
                        <div
                            style="display:flex;flex-wrap: wrap;margin:1.5% 1.5% 4% 1.5%;gap:5%;">

                            <div style="width: 46%">
                                <label style="font-size:0.85rem!important">Opening (Anno Corrente)</label>
                                <input type="text"
                                       style="width: 60%;margin-right:5%;text-align: right;color:black;font-weight: bolder"
                                       readonly class="form-control"
                                       value="<?php echo number_format($opening[0]->Val_Opening,2,',',' ');?>">

                            </div>
                            <div style="width: 46%">
                                <label style="font-size:0.85rem!important">Canoni (Anno Successivo)</label>
                                <input type="text"
                                       style="width: 60%;margin-right:5%;text-align: right;color:blue;"
                                       readonly class="form-control"
                                       value="<?php echo number_format($canone_successivo[0]->valore,2,',',' ');?>">
                            </div>

                            <div style="width: 46%">
                                <label style="font-size:0.85rem!important">Disdette</label>
                                <input type="text"
                                       style="width: 60%;margin-right:5%;text-align: right;color:red;"
                                       readonly class="form-control"
                                       value="-<?php echo number_format($esito1 + $esito3,2,',',' ');?>">
                            </div>
                            <div style="width: 46%">
                                <label style="font-size:0.85rem!important">Caring</label>
                                <input type="text"
                                       style="width: 60%;margin-right:5%;text-align: right;color:blue;"
                                       readonly class="form-control"
                                       value="<?php echo number_format($esito3,2,',',' ');?>">

                            </div>

                            <div style="width: 46%">
                                <label style="font-size:0.85rem!important">Recuperati</label>
                                <input type="text"
                                       style="width: 60%;margin-right:5%;text-align: right;color:blue;"
                                       readonly class="form-control"
                                       value="<?php echo number_format($ricontrattati[0]->valore,2,',',' ');?>">
                            </div>
                            <div style="width: 46%">
                                <label style="font-size:0.85rem!important">Differenza su Canoni (Anno
                                    Successivo)</label>
                                <input type="text"
                                       style="width: 60%;margin-right:5%;text-align: right;color:red;"
                                       readonly class="form-control"
                                       value="-<?php echo number_format($esito2,2,',',' ');?>">

                            </div>
                            <div style="width: 46%">
                                <label style="font-size:0.85rem!important">Opening (Anno Successivo)</label>
                                <input type="text"
                                       style="width: 60%;margin-right:5%;text-align: right;<?php if($opening_anno_successivo <= $opening[0]->Val_Opening) echo 'color:red;';else echo 'color:green;';?>"
                                       readonly class="form-control"
                                       value="<?php echo number_format($opening_anno_successivo,2,',',' ');?>">


                            </div>
                            <div style="width: 46%">
                                <label style="font-size:0.85rem!important">Valore (Delta)</label>
                                <div style="display:flex">
                                    <input type="text"
                                           style="width: 8em;margin-right:5%;text-align: right;<?php if($opening_anno_successivo <= $opening[0]->Val_Opening) echo 'color:red;';else echo 'color:green;';?>"
                                           readonly class="form-control"
                                           value="<?php echo number_format($opening_anno_successivo - $opening[0]->Val_Opening ,2,',',' ');?>">
                                    <input type="text"
                                           style="width: 5em;margin-right:5%;text-align: right;<?php if($opening_anno_successivo <= $opening[0]->Val_Opening) echo 'color:red;';else echo 'color:green;';?>"
                                           readonly class="form-control"
                                           value="<?php echo number_format($differenza_opening,2,',','').'%';?>">

                                </div>
                            </div>
                        </div>
                        {{-- <canvas id="donutBUDGETChart"
                                 style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>--}}
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
                        <div class="col-xl-2 col-sm-12">
                            <!-- Bar chart -->
                            <div
                                style="height:240px!important; max-height: 233px!important; max-width: 100%!important;">
                                <?php foreach ($statistiche_budget_mensile as $s){ ?>
                                <div
                                    style="margin:5%;display: flex;align-items:center;justify-content: space-between">
                                    <label style="width: 25%;font-size:14px"><?php echo $s->type; ?>
                                    </label>
                                    <input type="text"
                                           style="width: 40%;text-align: right;<?php if($s->type != 'Budget') echo 'color:blue;'; ?>"
                                           readonly class="form-control"
                                           value="<?php echo number_format($s->valore,2,',',' ');?>">
                                    <input type="text" class="form-control"
                                           style="width: 34%;text-align: right;<?php if($s->type != 'Budget') echo 'color:blue;'; ?>"
                                           readonly
                                           value="<?php if($s->type == 'Budget') echo '100%'; else echo number_format((1 - (floatval($statistiche_budget_mensile[0]->valore-$statistiche_budget_mensile[1]->valore)/$statistiche_budget_mensile[0]->valore))*100,2,',','').'%';?>">
                                </div>
                                <?php } ?>
                                <div
                                    style="margin:5%;display: flex;align-items:center;justify-content: space-between">
                                    <label style="width: 25%;font-size:14px">Obiettivo</label>
                                    <input type="text"
                                           style="width: 40%;text-align: right;<?php if($differenza_mese<= 0) echo 'color:red;';else echo 'color:green;'?>"
                                           readonly class="form-control"
                                           value="<?php echo number_format($differenza_mese,2,',',' ');?>">
                                    <input type="text" class="form-control"
                                           style="width: 34%;text-align: right;<?php if($differenza_mese<= 0) echo 'color:red;'; else echo 'color:green;'?>"
                                           readonly
                                           value="<?php if($differenza_mese<= 0) echo '-';else echo '+';?><?php echo number_format(abs(100-(1 - (($statistiche_budget_mensile[0]->valore-$statistiche_budget_mensile[1]->valore)/$statistiche_budget_mensile[0]->valore))*100),2,',','').'%';?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-2 col-sm-12">
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

                        <div class="col-xl-5 col-sm-12">
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
                <div class="card card-fuchsia">
                    <div class="card-header">
                        <h3 class="card-title">
                            Prodotto Best Performer Annuale
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="donutAnnualeProdottoPERFORMERChart"
                                style="height:  260px!important; max-height: 260px!important; max-width: 100%!important;"></canvas>
                    </div>
                    <!-- /.card-body-->

                </div>
            </div>
            <div class="col-xl-6 col-sm-12">

                <div class="card card-fuchsia">
                    <div class="card-header">
                        <h3 class="card-title">
                            Asset Best Performer Annuale
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="donutAnnualeSottogruppoPERFORMERChart"
                                style="height:  260px!important; max-height: 260px!important; max-width: 100%!important;"></canvas>
                    </div>
                    <!-- /.card-body-->

                </div>
            </div>
            <div class="col-xl-12 col-sm-12" style="display:flex;width: 100%;gap: 2%;">
                <!-- Bar chart -->
                <div class="card card-fuchsia" style="width: 60%;">
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
                <div class="card card-fuchsia" style="width: 60%;">
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
            <div class="col-xl-12 col-sm-12">
                <!-- Bar chart -->
                <div class="card card-warning">
                    <div class="card-header" style="background-color:#fa8072">
                        <h3 class="card-title" style="color:white">
                            Statistiche Disdette

                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-12">
                            <div class="card-body">
                                <canvas id="donutDisdetteProdottoChart"
                                        style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-12">
                            <div class="card-body">
                                <canvas id="donutDisdetteSottoProdottoChart"
                                        style="height:  250px!important; max-height: 250px!important; max-width: 100%!important;"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body-->
                </div>
            </div>
            <div class="col-xl-4 col-sm-12">
                <!-- Bar chart -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Statistiche Pipeline Mensili
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
            <div class="col-xl-4 col-sm-12">
                <!-- STACKED BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Statistiche Pipeline per Categoria</h3>

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
            <div class="col-xl-4 col-sm-12">
                <!-- STACKED BAR CHART -->
                <div class="card card-teal">
                    <div class="card-header">
                        <h3 class="card-title">Statistiche Pipeline Mesi Successivi</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="stackedBarChartChiusura"
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

    var donutMESEChartCanvas = $('#donutMESEChart').get(0).getContext('2d')
    var donutMESEData = {
        labels: [
            <?php $sales = '';
            foreach ($statistiche_corrente as $s) {
                $val = '';
                if ($s->Vinta == 1) {
                    $val = 'PERSA';
                } else {
                    if ($s->Vinta == 2) {
                        $val = 'VINTA';
                    } else {
                        $val = 'IN CORSO';
                    }
                }

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
    var donutDisdetteProdottoChartCanvas = $('#donutDisdetteProdottoChart').get(0).getContext('2d')

    var donutDisdetteProdottoData = {
        labels: [
            <?php
            $gruppo = '';
            foreach ($statistiche_disdetta_gruppo_annuale as $s) {
                if ($s->gruppo != null && $s->gruppo != '') {
                    $gruppo = str_replace('\'' . $s->gruppo . '\',', '', $gruppo);
                    $gruppo .= '\'' . $s->gruppo . '\',';
                }
            }
            $gruppo = substr($gruppo, 0, strlen($gruppo) - 1);
            echo $gruppo;
            ?>],
        datasets: [
            <?php

            $sales = '';

            $esito = '';
            foreach ($statistiche_disdetta_gruppo_annuale as $s) {
                if ($s->Esito != null && $s->Esito != '') {
                    $esito = str_replace('\'' . $s->Esito . '\',', '', $esito);
                    $esito .= '\'' . $s->Esito . '\',';
                }
            }
            $esito = substr($esito, 0, strlen($esito) - 1);

            $gruppo_util = trim($gruppo, "'");

            $gruppo_util = explode("','", $gruppo_util);

            $esito_util = trim($esito, "'");

            $esito_util = explode("','", $esito_util);

            foreach ($esito_util as $p) {
                $sales .= '
                {
                label: \'' . $p . '\',
                borderColor: \'#' . substr(md5(mt_rand()), 0, 6) . '\',
                backgroundColor: \'#' . substr(md5(mt_rand()), 0, 6) . '\',
                pointRadius: false,
                borderWidth: 2,
                data: [';
                $sales2 = '';
                foreach ($gruppo_util as $c) {
                    $i = 0;
                    foreach ($statistiche_disdetta_gruppo_annuale as $m) {
                        if ($c == $m->gruppo) {
                            if ($p == $m->Esito) {
                                $i++;
                                $sales2 .= $m->Val . ',';
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

    var donutDisdetteProdottoOptions = {
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

    new Chart(donutDisdetteProdottoChartCanvas, {
        type: 'bar',
        data: donutDisdetteProdottoData,
        options: donutDisdetteProdottoOptions
    })

    var donutDisdetteSottoProdottoChartCanvas = $('#donutDisdetteSottoProdottoChart').get(0).getContext('2d')

    var donutDisdetteSottoProdottoData = {
        labels: [
            <?php
            $gruppo = '';
            foreach ($statistiche_disdetta_sottogruppo_annuale as $s) {
                if ($s->gruppo != null && $s->gruppo != '') {
                    $gruppo = str_replace('\'' . $s->gruppo . '\',', '', $gruppo);
                    $gruppo .= '\'' . $s->gruppo . '\',';
                }
            }
            $gruppo = substr($gruppo, 0, strlen($gruppo) - 1);
            echo $gruppo;
            ?>],
        datasets: [
            <?php

            $sales = '';

            $esito = '';
            foreach ($statistiche_disdetta_sottogruppo_annuale as $s) {
                if ($s->Esito != null && $s->Esito != '') {
                    $esito = str_replace('\'' . $s->Esito . '\',', '', $esito);
                    $esito .= '\'' . $s->Esito . '\',';
                }
            }
            $esito = substr($esito, 0, strlen($esito) - 1);

            $gruppo_util = trim($gruppo, "'");

            $gruppo_util = explode("','", $gruppo_util);

            $esito_util = trim($esito, "'");

            $esito_util = explode("','", $esito_util);

            foreach ($esito_util as $p) {
                $sales .= '
                {
                label: \'' . $p . '\',
                borderColor: \'#' . substr(md5(mt_rand()), 0, 6) . '\',
                backgroundColor: \'#' . substr(md5(mt_rand()), 0, 6) . '\',
                pointRadius: false,
                borderWidth: 2,
                data: [';
                $sales2 = '';
                foreach ($gruppo_util as $c) {
                    $i = 0;
                    foreach ($statistiche_disdetta_sottogruppo_annuale as $m) {
                        if ($c == $m->gruppo) {
                            if ($p == $m->Esito) {
                                $i++;
                                $sales2 .= $m->Val . ',';
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

    var donutDisdetteSottoProdottoOptions = {
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

    new Chart(donutDisdetteSottoProdottoChartCanvas, {
        type: 'bar',
        data: donutDisdetteSottoProdottoData,
        options: donutDisdetteSottoProdottoOptions
    })
</script>
<script type="text/javascript">

    function changeData() {
        var data = $('#data_mese').val();
        top.location.href = '/statistiche/' + data;
    }


    // BEST PERFORMER SALES MESE
    // STATISTICHE MESE CORRENTE
    <?php
    $sales = '';
    $total = 0;
    foreach ($statistiche_corrente_sales as $s) {
        $total += $s->Val;
    }
    ?>
    var donutMESESalesChartCanvas = $('#donutMESESalesChart').get(0).getContext('2d')
    var donutMESESalesData = {
        labels: [
            <?php $sales = '';
            foreach ($statistiche_corrente_sales as $s) {

                $sales .= '\'' . $s->Sales . ' (' . number_format(floatval(floatval($s->Val) * 100) / floatval($total), 2, ',', ' ') . '%)\',';
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
    var donutAnnualeSottogruppoPERFORMERChart = $('#donutAnnualeSottogruppoPERFORMERChart').get(0).getContext('2d')
    var donutAnnualeSottogruppoPERFORMERData = {
        labels: [
            <?php $sales = ''; foreach ($statistiche_corrente_sottogruppo_annuale as $s) {
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
                    <?php $sales = ''; foreach ($statistiche_corrente_sottogruppo_annuale as $s) {
                        if ($s->gruppo != null && $s->gruppo != '')
                            $sales .= $s->Val . ',';
                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],
                backgroundColor: [

                    <?php $sales = ''; foreach ($statistiche_corrente_sottogruppo_annuale as $s) {
                        if ($s->gruppo != null && $s->gruppo != '')
                            $sales .= '\'#' . substr(md5(mt_rand()), 0, 6) . '\',';

                    }
                    $sales = substr($sales, 0, strlen($sales) - 1);
                    echo $sales;
                    ?>

                ],

                borderColor: [
                    <?php $sales = ''; foreach ($statistiche_corrente_sottogruppo_annuale as $s) {
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

    var donutAnnualeSottogruppoPERFORMEROptions = {
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

    new Chart(donutAnnualeSottogruppoPERFORMERChart, {
        type: 'bar',
        data: donutAnnualeSottogruppoPERFORMERData,
        options: donutAnnualeSottogruppoPERFORMEROptions
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


    var donuteAnnualePERFORMERChartCanvas = $('#donutAnnualePERFORMERChart').get(0).getContext('2d')
    <?php
    $sales = '';
    $total = 0;
    foreach ($statistiche_sales_vinte as $s) {
        $total += $s->Val;
    }
    ?>
    var donutAnnualePERFORMERData = {
        labels: [
            <?php $sales = ''; foreach ($statistiche_sales_vinte as $s) {
                if ($s->Sales != null && $s->Sales != '')
                    $sales .= '\'' . $s->Sales . ' (' . number_format(floatval(floatval($s->Val) * 100) / floatval($total), 2, ',', ' ') . '%)\',';

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


    var stackedBarChartChiusuraCanvas = $('#stackedBarChartChiusura').get(0).getContext('2d')

    var stackedBarChartChiusuraData = {
        labels: [
            <?php $mesi = ''; foreach ($statistiche_categoria_chiusura as $s) {
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
                    foreach ($statistiche_categoria_chiusura as $c) {
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

    var stackedBarChartChiusuraOptions = {
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

    new Chart(stackedBarChartChiusuraCanvas, {
        type: 'bar',
        data: stackedBarChartChiusuraData,
        options: stackedBarChartChiusuraOptions
    })


</script>
