<?php $utente = session('utente'); ?>

@include('common.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="color:#007bff">
            PROMEDYA | Smart Sales Force
            <small>&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
        <br>
    </section>
    <!-- Main content -->
    <section class="content-body" style="margin: 2%;">
        <div class="row" style="margin:2%">
            <div class="col-lg-3 col-md-12 col-sm-12"
                 style="display: flex;justify-content: center;align-items: center"></div>
            <div class="col-lg-3 col-md-12 col-sm-12"><label for="input">ESERCIZIO</label>
                <input style="text-align:right;font-weight: bolder" type="number"
                       value="<?php echo $anno;?>" onchange="check_anno()" id="new_anno" step="1" min="2000" max="2100"
                       class="form-control">
            </div>
            <div class="col-4 col-lg-2 col-md-4 col-sm-4" style="margin-bottom: 2%">
                <label for="input">VENDITA ANNUALE</label>
                <input style="text-align:right;font-weight: bolder;color:blue;" readonly type="text"
                       value="<?php echo number_format($vendite_annuale,2,',',' ');?>" class="form-control">
            </div>
            <div class="col-4 col-lg-2 col-md-4 col-sm-4" style="margin-bottom: 2%">
                <label for="input">BUDGET ANNUALE</label>
                <input style="text-align:right;font-weight: bolder" type="text"
                       value="<?php echo number_format($budget_annuale,2,',',' ');?>" readonly
                       class="form-control">
            </div>
            <div class="col-4 col-lg-2 col-md-4 col-sm-4" style="margin-bottom: 2%">
                <label for="input">OBIETTIVO ANNUALE</label>
                <input
                    style="text-align:right;font-weight: bolder;<?php $differenza = (floatval($vendite_annuale) - floatval($budget_annuale)); if($differenza <= 0) echo 'color:red;';else echo 'color:green;'?>"
                    id="differenza"
                    readonly
                    value="<?php echo number_format($differenza,2,',',' ');?>"
                    type="text" <?php if ($differenza < 0) echo 'style="color:red"'; ?>
                    class="form-control">
            </div>
            <div style="overflow-x:scroll">
                <?php for ($i = 0;
                           $i < 4;
                           $i++) { ?>
                <div class="col-12 row flex-nowrap">
                        <?php for ($y = 1;
                                   $y < 13;
                                   $y++) { ?>
                        <?php if ($i < 3) { ?>
                        <?php if ($y == 1) { ?>
                        <?php if ($i == 0) echo '<div class="col-2 col-lg-1 col-md-2 col-sm-2"><div style="display:flex;align-items: center;justify-content: right;width: 100%;margin-top:5%;"><label><br>Ven</label></div></div>'; ?>
                        <?php if ($i == 1) echo '<div class="col-2 col-lg-1 col-md-2 col-sm-2"><div style="display:flex;align-items: center;justify-content: right;width: 100%;margin-top:5%;"><label><br>Bgt</label></div></div>'; ?>
                        <?php if ($i == 2) echo '<div class="col-2 col-lg-1 col-md-2 col-sm-2"><div style="display:flex;align-items: center;justify-content: right;width: 100%;margin-top:5%;"><label><br>Obt</label></div></div>'; ?>
                    <?php } ?>
                    <div class="col-4 col-lg-1 col-md-2 col-sm-2" style="text-align: center;">
                        <label for="input">
                                <?php
                                if ($i == 0) {
                                    switch ($y) {
                                        case 1:
                                            echo 'Gennaio';
                                            break;
                                        case 2:
                                            echo 'Febbraio';
                                            break;
                                        case 3:
                                            echo 'Marzo';
                                            break;
                                        case 4:
                                            echo 'Aprile';
                                            break;
                                        case 5:
                                            echo 'Maggio';
                                            break;
                                        case 6:
                                            echo 'Giugno';
                                            break;
                                        case 7:
                                            echo 'Luglio';
                                            break;
                                        case 8:
                                            echo 'Agosto';
                                            break;
                                        case 9:
                                            echo 'Settembre';
                                            break;
                                        case 10:
                                            echo 'Ottobre';
                                            break;
                                        case 11:
                                            echo 'Novembre';
                                            break;
                                        case 12:
                                            echo 'Dicembre';
                                            break;
                                        default:
                                            echo '';
                                            break;
                                    }
                                } ?>
                        </label>
                        <div style="display:flex;align-items: center;justify-content: center;width: 100%">
                            <form enctype="multipart/form-data" id="form_1" action="/budget_annuale/{{$anno}}">
                                <input
                                    id="<?php if ($i == 0) echo 'vendita'; ?><?php if ($i == 1) echo 'budget'; ?><?php if ($i == 2) echo 'differenza'; ?><?php echo '_'.$y;?>"
                                    name="<?php if ($i == 0) echo 'vendita'; ?><?php if ($i == 1) echo 'budget'; ?><?php if ($i == 2) echo 'differenza'; ?><?php echo '_'.$y;?>"
                                    <?php if ($i == 0) echo 'readonly'; ?><?php if ($i == 1 && $utente->username != 'Giovanni Tutino') echo 'readonly'; ?><?php if ($i == 2) echo 'readonly'; ?> type="text"
                                    step="0.01"
                                    style="text-align: right;width:92%!important;margin-left:5%;<?php if ($i == 0) echo 'color:blue;'; ?>"
                                    <?php if ($i == 1) echo 'onclick="calcola_differenza();"'; ?>
                                        <?php if ($i == 1) echo 'onkeydown="check_numero(<?php echo $i?>);"'; ?>
                                        <?php if ($i == 1) echo 'onchange="calcola_differenza();"'; ?>
                                        <?php if ($i == 1) echo 'onblur="check_numero(' . $y . ');submit_form(this.form)";'; ?>
                                    value="<?php if($i == 0) foreach ($vendite_mensili as $v) { if($v->Mese == $y) echo number_format($v->Vendite,2,'.','');}if($i == 1) foreach ($budget as $b) { if($b->data_mese == $y) echo number_format($b->budget,2,'.','');}?>"
                                    min="0.01" class="form-control">
                            </form>
                        </div>
                    </div>
                    <?php } else { ?>
                        <?php if ($y == 1) { ?>
                        <?php echo '<div class="col-2 col-lg-1 col-md-2 col-sm-2"></div>'; ?>
                    <?php } ?>
                        <?php if ($y == 3 || $y == 6 || $y == 9 || $y == 12){ ?>
                    <div class="col-4 col-lg-1 col-md-2 col-sm-2" style="margin-top: 2%;">
                        <div class="row">
                            <label for="input" style="width: 100%;text-align: center;">
                                Q<?php if ($y == 3) echo 1;if ($y == 6) echo 2;if ($y == 9) echo 3;if ($y == 12) echo 4; ?></label>
                            <div class="col-12">
                                <div style="display:flex;align-items: center;justify-content: center;width: 100%">
                                    <label style="margin-left:-20%">Ven</label>
                                    <input readonly value="<?php echo number_format(${'vendite_t'.$y},2,',',' ');?>"
                                           style="text-align: right; margin-left: 5%;margin-bottom:5%; width: 92% !important;color:blue"
                                           class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-12">
                                <div style="display:flex;align-items: center;justify-content: center;width: 100%">
                                    <label style="margin-left:-20%">Bgt</label>
                                    <input readonly value="<?php echo number_format(${'budget_t'.$y},2,',',' ');?>"
                                           style="text-align: right; margin-left: 5%;margin-bottom:5%; width: 92% !important;"
                                           class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-12">
                                <div style="display:flex;align-items: center;justify-content: center;width: 100%">
                                    <label style="margin-left:-20%">Obt</label>
                                    <input readonly value="<?php echo number_format(${'differenze_t'.$y},2,',',' ');?>"
                                           style="text-align: right; margin-left: 5%;margin-bottom:5%; width: 92% !important; <?php if(${'differenze_t'.$y}<=0) echo 'color: red;';else echo 'color:green;'?>"
                                           class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="col-4 col-lg-1 col-md-2 col-sm-2" style="text-align: center;"></div>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>

                </div>

                <?php } ?>
            </div>
        </div>

        <div style="display:flex;justify-content:center;align-content:center;">
            <h6 style="margin-top:5%;"><strong>(Ven)</strong> Vendite - <strong>(Bgt)</strong>
                Budget - <strong>(Obt)</strong> Obiettivo</h6>
        </div>
    </section>
</div>
</div>
<!-- /.container-fluid-->


@include('common.footer')

<script type="text/javascript">
function check_anno(){
    new_anno = document.getElementById('new_anno').value;
    top.location.href='/budget_annuale/' + new_anno;
}
    <?php for ($i = 1;
               $i < 13;
               $i++) { ?>
    var c = $('#vendita_' + '<?php echo $i ?>').val();
    if (c === '')
        $('#vendita_' + '<?php echo $i ?>').val('0.00');
    <?php } ?>

    $('#budget_1').click();

    function revert_number(i) {
        $('#budget_' + i).val($('#budget_' + i).val().replaceAll(' ', '').replaceAll(',', '.'));
    }

    function submit_form(form) {
        <?php for ($i = 1;
                   $i < 13;
                   $i++) { ?>
        revert_number(<?php echo $i ?>);
        <?php } ?>
        form.submit();
    }

    <?php for ($i = 1;
               $i < 13;
               $i++) { ?>
    check_number(<?php echo $i ?>);
    <?php } ?>


    function check_number(i) {

        value = document.getElementById('budget_' + i).value;
        // Rimuovi eventuali caratteri non numerici
        value = value.replace(/[^\d.]/g, '');

        // Converti in numero a virgola mobile
        var number = parseFloat(value);

        // Verifica se è un numero valido
        if (!isNaN(number)) {
            // Formatta il numero con 2 decimali e virgole per le migliaia
            var formattedNumber = number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ").replace('.', ',');

            // Aggiorna il valore dell'input
            document.getElementById('budget_' + i).value = formattedNumber;
        } else {
            document.getElementById('budget_' + i).value = value.replace(/[^0-9]/g, '');
        }
        vendita = document.getElementById('vendita_' + i).value;
        vendita = vendita.replace(/[^\d.]/g, '');

        // Converti in numero a virgola mobile
        var vendita_value = parseFloat(vendita);

        // Verifica se è un numero valido
        if (!isNaN(vendita_value)) {
            // Formatta il numero con 2 decimali e virgole per le migliaia
            var formattedNumber = vendita_value.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ").replace('.', ',');

            // Aggiorna il valore dell'input
            document.getElementById('vendita_' + i).value = formattedNumber;
        } else {
            document.getElementById('vendita_' + i).value = vendita.replace(/[^0-9]/g, '');
        }

        /* value = document.getElementById('budget').value;
         // Rimuovi eventuali caratteri non numerici
         value = value.replace(/[^\d.]/g, '');

         // Converti in numero a virgola mobile
         var number = parseFloat(value);

         // Verifica se è un numero valido
         if (!isNaN(number)) {
             // Formatta il numero con 2 decimali e virgole per le migliaia
             var formattedNumber = number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ").replace('.', ',');

             // Aggiorna il valore dell'input
             document.getElementById('budget').value = formattedNumber;
         } else {
             document.getElementById('budget').value = value.replace(/[^0-9]/g, '');
         }*/

    }

    function calcola_differenza() {
        for (let i = 1; i < 13; i++) {
            vendita = document.getElementById('vendita_' + i).value;
            if (vendita === null || vendita === '')
                vendita = 0;
            budget = document.getElementById('budget_' + i).value;
            budget = budget.replace(' ', '').replaceAll(',', '.');
            differenza = parseFloat(vendita) - parseFloat(budget);
            document.getElementById('differenza_' + i).value = differenza.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, " ").replace('.', ',');
            if (differenza <= 0)
                document.getElementById('differenza_' + i).style.color = 'red';
            else
                document.getElementById('differenza_' + i).style.color = 'green';
        }
    }

    function check_numero(i) {
        $('#budget_' + i).val($('#budget_' + i).val().replace(/[^0-9,.\s]/g, ''));
    }
</script>
