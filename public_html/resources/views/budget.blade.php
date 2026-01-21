<?php $utente = session('utente'); ?>

@include('common.header')
<style>
    .text-gradient {
        background: linear-gradient(135deg, #4f46e5, #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .modern-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .kpi-card {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .kpi-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .kpi-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
    }

    .month-input-container {
        background: white;
        border-radius: 8px;
        padding: 0.75rem;
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease;
    }

    .month-input-container:hover {
        border-color: #4f46e5;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.1);
    }

    .month-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .budget-input {
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .budget-input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        outline: none;
    }

    .quarterly-card {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border-radius: 12px;
        padding: 1rem;
        border: 2px solid #3b82f6;
        margin-top: 0.5rem;
    }

    .quarterly-title {
        font-weight: 700;
        color: #1e40af;
        font-size: 1rem;
        text-align: center;
        margin-bottom: 0.75rem;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Smart Sales Force | Gestione Budget
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content-body" style="padding: 0 1.5rem 1.5rem;">
        <!-- KPI Cards Row -->
        <div class="modern-card" style="margin-bottom: 1.5rem;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">
                    <i class="fas fa-chart-line" style="margin-right: 0.5rem; color: #4f46e5;"></i>
                    Riepilogo Annuale
                </h3>
            </div>
            <div style="padding: 1.5rem;">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="kpi-card">
                            <div class="kpi-label">Budget Annuale</div>
                            <div class="kpi-value">€ <?php echo number_format($budget_annuale,2,',',' ');?></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="kpi-card">
                            <div class="kpi-label">Vendite Annuali</div>
                            <div class="kpi-value" style="color: #4366F6;">€ <?php echo number_format($vendite_annuale,2,',',' ');?></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="kpi-card">
                            <div class="kpi-label">Obiettivo Annuale</div>
                            <div class="kpi-value" style="<?php $differenza = (floatval($vendite_annuale) - floatval($budget_annuale)); if($differenza <= 0) echo 'color:#ef4444;';else echo 'color:#10b981;'?>">
                                € <?php echo number_format($differenza,2,',',' ');?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Budget Mensile -->
        <div class="modern-card">  
            <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">
                    <i class="fas fa-calendar-alt" style="margin-right: 0.5rem; color: #4f46e5;"></i>
                    Budget Mensile e Trimestrale
                </h3>
            </div>
            <div style="padding: 1.5rem;">
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
                            <form enctype="multipart/form-data" id="form_1" action="/budget">
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
                
                <div style="display:flex;justify-content:center;align-content:center; padding: 1.5rem 0; border-top: 1px solid #e5e7eb; margin-top: 1rem; background: #f8fafc;">
                    <div style="text-align: center;">
                        <h6 style="color: #64748B; font-weight: 500; margin: 0;">
                            <span style="display: inline-block; margin: 0 1rem;">
                                <strong style="color: #4366F6;">(Ven)</strong> Vendite
                            </span>
                            <span style="display: inline-block; margin: 0 1rem;">
                                <strong style="color: #1e293b;">(Bgt)</strong> Budget
                            </span>
                            <span style="display: inline-block; margin: 0 1rem;">
                                <strong style="color: #10b981;">(Obt)</strong> Obiettivo
                            </span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.container-fluid-->


@include('common.footer')

<script type="text/javascript">

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
