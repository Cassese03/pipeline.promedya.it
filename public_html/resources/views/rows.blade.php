<?php $utente = session('utente'); ?>
@include('common.header')
<style>
    .action-btn {
        padding: 0.55rem 0.85rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: none;
        color: #fff !important;
        box-shadow: 0 8px 18px rgba(67, 102, 246, 0.15);
        transition: transform 0.12s ease, box-shadow 0.12s ease, filter 0.12s ease;
    }

    .action-btn i {
        color: #fff !important;
    }

    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
    }

    .action-btn:active {
        transform: translateY(0);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
    }

    .action-btn--edit {
        background: linear-gradient(135deg, #4f46e5, #2563eb);
    }

    .action-btn--duplicate {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .action-btn--delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .header-btn {
        padding: 0.75rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .header-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .header-btn--primary {
        background: linear-gradient(135deg, #4f46e5, #2563eb);
        color: white;
    }

    .header-btn--filter {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

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

    .legend-modern {
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        display: flex;
        gap: 2rem;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .legend-modern li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
        color: #374151;
    }

    .legend-modern li::before {
        content: '';
        width: 12px;
        height: 12px;
        border-radius: 3px;
        display: inline-block;
    }

    .legend-modern li:nth-child(1)::before {
        background: #fef08a;
    }

    .legend-modern li:nth-child(2)::before {
        background: #ff6666;
    }

    .legend-modern li:nth-child(3)::before {
        background: #90ee90;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 1rem;">
            PROMEDYA | Smart Sales Force
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
        <div style="display: flex; gap: 1rem; margin-top: 1rem; flex-wrap: wrap;">
            <button class="header-btn header-btn--primary" id="aggiungi_pipeline" onclick="aggiungi()"
                name="aggiungi_pipeline">
                <i class="fas fa-plus"></i>
                Aggiungi Nuovo Contatto
            </button>
            <button class="header-btn header-btn--filter" id="filtra_pipeline" onclick="filtra()"
                name="filtra_pipeline">
                <i class="fas fa-filter"></i>
                Filtri / Ricerca
            </button>
        </div>
    </section>
    <!-- Main content -->
    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        <div style="margin: 0 auto; max-width: 100%;">
            <div class="legend-modern">
                <li>In Corso</li>
                <li>Persa</li>
                <li>Vinta</li>
            </div>

            <div class="modern-card">
                <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                    <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">
                        <i class="fas fa-chart-line" style="margin-right: 0.5rem; color: #4f46e5;"></i>
                        Pipeline Vendite
                    </h3>
                </div>
                <div style="overflow-x: auto;">
                    <table id="example11" class="table table-bordered datatable"
                        style="border-color: #e5e7eb; border-width:1px; margin: 0;">
                        <thead>
                        <tr>
                                    <?php foreach ($column as $c){ ?>
                                    <th class="no-sort"
                                        style="text-align: center; background: linear-gradient(135deg, #e0f2fe, #bfdbfe); font-weight: 600; color: #1e40af; border-color: #e5e7eb; border-width:1px; padding: 1rem 0.75rem; white-space: nowrap;">
                                            <?php if ($c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Inc_Canone_AS' && $c->COLUMN_NAME != 'Inc_Anno_Solare') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                            <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'Valore Vendita A/C'; ?>
                                            <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone A/C'; ?>
                                            <?php if ($c->COLUMN_NAME == 'Vinta') echo 'Trattativa'; ?>
                                            <?php if ($c->COLUMN_NAME == 'Inc_Canone_AS') echo 'Incremento Canone A/S'; ?>
                                            <?php if ($c->COLUMN_NAME == 'Inc_Anno_Solare') echo 'Incremento Anno Solare'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                    </th>
                                    <?php } ?>
                                    <th class="no-sort"
                                        style="text-align: center; background: linear-gradient(135deg, #e0f2fe, #bfdbfe); font-weight: 600; color: #1e40af; border-color: #e5e7eb; border-width:1px; padding: 1rem 0.75rem; white-space: nowrap;">
                                        Azioni
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($rows as $r){ ?>
                                <tr style="background: <?php if($r->Vinta == 2) echo 'lightgreen'; if($r->Vinta == 1) echo '#ff6666'; if($r->Vinta != 1 && $r->Vinta != 2) echo 'lightyellow';?>;">
                                        <?php foreach ($column as $c){ ?>

                                        <?php
                                        if ($c->COLUMN_NAME == 'Val_Ven_AC') {
                                            if (isset(${$c->COLUMN_NAME}))
                                                ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                            else
                                                ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                        }
                                        if ($c->COLUMN_NAME == 'Val_Can_AC') {
                                            if (isset(${$c->COLUMN_NAME}))
                                                ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                            else
                                                ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                        }
                                        if ($c->COLUMN_NAME == 'Vendita_Budget') {
                                            if (isset(${$c->COLUMN_NAME}))
                                                ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                            else
                                                ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                        }
                                        if ($c->COLUMN_NAME == 'Inc_Canone_AS') {
                                            if (isset(${$c->COLUMN_NAME}))
                                                ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                            else
                                                ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                        }
                                        if ($c->COLUMN_NAME == 'Inc_Anno_Solare') {
                                            if (isset(${$c->COLUMN_NAME}))
                                                ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                            else
                                                ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                        } ?>

                                        <td class="no-sort" style="contain:content; padding: 0.75rem;
                                        <?php if(($c->DATA_TYPE == 'varchar') && $c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Id_Padre' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria') echo 'text-align:left;';
                                            if($c->DATA_TYPE=='int'||$c->DATA_TYPE=='float') echo 'text-align:right;' ;
                                            if($c->DATA_TYPE=='date') echo 'text-align:center;' ;
                                            if($c->COLUMN_NAME =='Vinta' || $c->COLUMN_NAME == 'Note') echo 'text-align:center;' ;?>
                                                border-color: #e5e7eb; border-width:1px">
                                            <?php if ($c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Note') {
                                            if (($c->DATA_TYPE == 'int' || $c->DATA_TYPE == 'float') and $c->COLUMN_NAME != 'Id' and $c->COLUMN_NAME != 'Id_Padre' and $c->COLUMN_NAME != 'Probabilita_Chiusura') echo number_format($r->{$c->COLUMN_NAME}, 2, '.', ''); else echo ($c->DATA_TYPE != 'date') ? $r->{$c->COLUMN_NAME} : date('d-m-Y', strtotime($r->{$c->COLUMN_NAME}));
                                        } ?>
                                            <?php if ($c->COLUMN_NAME == 'Vinta') {

                                            foreach ($esito_trattativa as $e) {
                                                if ($r->{$c->COLUMN_NAME} == $e->id) echo $e->descrizione;
                                            }
                                        } ?>
                                            <?php if ($c->COLUMN_NAME == 'Note' && ($r->{$c->COLUMN_NAME} != '')) { ?>
                                            <button class="btn btn-sm" style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white; border: none; border-radius: 8px; padding: 0.4rem 1rem; font-weight: 500;"
                                                onclick="nota('<?php echo $r->Id; ?>');">
                                                <i class="fas fa-sticky-note" style="margin-right: 0.3rem;"></i>NOTA
                                            </button>
                                            <?php } ?>
                                            <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') { ?>
                                            <div class="progress-bar-label" style="text-align: center"><label
                                                    style="font-weight: bold">
                                                    <?php echo $r->{$c->COLUMN_NAME} . '%'; ?>
                                                </label>
                                            </div>
                                            <div class="progress"
                                                style="height: 7px;color: rgba(46, 204, 113,0.6);background-color: lightgray">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: <?php echo $r->{$c->COLUMN_NAME};?>%;"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <?php } ?>

                                        </td>
                                        <?php } ?>
                                        <form enctype="multipart/form-data" method="post"
                                            onsubmit="return confirm('Sei sicuro di voler eliminare la riga selezionata?')">
                                            @csrf
                                            <td class="no-sort"
                                                style="background:white; border-color: #e5e7eb; border-width:1px; padding: 0.75rem;">
                                                <div style="display:flex;gap: 0.5rem; justify-content: center;">
                                                    <button type="button" onclick="modifica(<?php echo $r->Id;?>)"
                                                        class="btn action-btn action-btn--edit" title="Modifica">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" onclick="duplica(<?php echo $r->Id;?>)"
                                                        class="btn action-btn action-btn--duplicate" title="Duplica">
                                                        <i class="fas fa-clone"></i>
                                                    </button>
                                                    <button type="submit" name="elimina" value="<?php echo $r->Id;?>"
                                                        class="btn action-btn action-btn--delete" title="Elimina">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr style="background: linear-gradient(135deg, #e0f2fe, #bfdbfe);">
                                    <?php foreach ($column as $c){ ?>
                                    <th class="no-sort"
                                        style="<?php if(isset(${$c->COLUMN_NAME})) echo 'text-align:right; font-weight: 700;'?>border-color: #e5e7eb; border-width:1px; padding: 1rem 0.75rem; color: #1e40af;"><?php if (isset(${$c->COLUMN_NAME})) echo number_format(${$c->COLUMN_NAME}, 2, '.', ''); ?></th>
                                    <?php } ?>
                                    <th class="no-sort" style="border-color: #e5e7eb; border-width:1px"></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@include('common.footer')

<form method="post" onsubmit="return confirm('Sei sicuro di voler aggiungere la nuova Lead?')"
    enctype="multipart/form-data" action="/pipeline">
    @csrf
    <div class="modal fade" id="modal_aggiungi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Crea Pipeline</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php foreach ($column as $c){
                        if ($c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Id_Padre' && $c->COLUMN_NAME != 'Probabilita_Chiusura'){ ?>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>
                                        <?php if ($c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Inc_Canone_AS' && $c->COLUMN_NAME != 'Inc_Anno_Solare') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                        <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'Valore Vendita A/C'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone A/C'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Vinta') echo 'Trattativa'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Inc_Canone_AS') echo 'Incremento Canone A/S'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Inc_Anno_Solare') echo 'Incremento Anno Solare'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                    <b style="color:red">*</b></label>
                                    <?php if ($c->COLUMN_NAME != 'Note' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Motivazione' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Dipendente' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
                                <input
                                        <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Vendita_Budget') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Val_Ven_AC' || $c->COLUMN_NAME == 'Val_Can_AC' || $c->COLUMN_NAME == 'Vendita_Budget' || $c->COLUMN_NAME == 'Inc_Canone_AS' || $c->COLUMN_NAME == 'Inc_Anno_Solare') echo 'min="0"'; else if ($c->DATA_TYPE == 'float' || $c->DATA_TYPE == 'int') echo 'min="0"'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Ragione_Sociale') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Prodotto') echo 'required'; ?>
                                    <?php if ($c->DATA_TYPE == 'varchar' && $c->COLUMN_NAME != 'Note') echo 'onKeyUp="converti(\'' . $c->COLUMN_NAME . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" step="0.01" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" step="1" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'date' && $c->COLUMN_NAME == 'Data_contatto') echo 'value="' . date('Y-m-d', strtotime('now')) . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'date') echo 'style="width:100%" class="form-control" type="date" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>>

                                <?php } ?>

                                <?php if ($c->COLUMN_NAME == 'Ragione_Sociale') { ?>
                                <style>
                                    .select2-container .select2-selection--single {
                                        height: 50px;
                                    }
                                </style>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select id="clientiSelect" class="form-control select2" id="{{$c->COLUMN_NAME}}" name="{{$c->COLUMN_NAME}}"
                                            onchange="toggleAccordion()"></select>
                                        <div class="input-group-append">
                                            <button id="accordionButton" class="btn btn-outline-secondary" type="button"
                                                data-toggle="collapse" data-target="#accordionContent"
                                                aria-expanded="false" aria-controls="accordionContent" disabled>
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="accordionContent">
                                    <div class="card card-body" id="contenuto">
                                    </div>
                                </div>
                                <?php } ?>

                                <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <?php foreach ($operatori as $o){ ?>
                                    <option value="{{$o->username}}" <?php if ($o->username == $utente->username) echo
                                        'selected'; ?> >{{$o->username}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Vinta') { ?>
                                <select style="width:100%" class="form-control aggiungi_vinta"
                                        onchange="check_vinta('aggiungi_vinta')"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                        <?php foreach ($esito_trattativa as $e){ ?>
                                    <option value="{{$e->id}}">{{$e->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>

                                <?php if ($c->COLUMN_NAME == 'Categoria') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    @foreach($categoria as $c1)
                                        <option value="{{ $c1->descrizione }}">{{ $c1->descrizione }}</option>
                                    @endforeach
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Tipo_Cliente') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <option value="OLD">OLD
                                    </option>
                                    <option value="LEAD">LEAD
                                    </option>
                                    <option value="RIENTRO">RIENTRO
                                    </option>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                                <select style="width:100%" class="form-control aggiungi_segnalato"
                                    onchange="check_segnalato('aggiungi_segnalato')" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <?php foreach ($segnalato as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Motivazione') { ?>
                                <select style="width:100%" class="form-control aggiungi_motivazione" disabled="disabled"
                                    id="<?php echo $c->COLUMN_NAME;?>" name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <?php foreach ($motivazione as $m){ ?>
                                    <option value="{{$m->descrizione}}">{{$m->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Prodotto') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <?php foreach ($prodotto as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Dipendente') { ?>
                                <select style="width:100%" class="form-control aggiungi_dipendente" disabled="disabled"
                                    id="<?php echo $c->COLUMN_NAME;?>" name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <?php foreach ($dipendenti as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="25">25
                                    </option>
                                    <option value="50">50
                                    </option>
                                    <option value="75">75
                                    </option>
                                    <option value="100">100
                                    </option>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Note') { ?>
                                <textarea rows="8" cols="100"
                                    onKeyUp="converti(<?php echo '\''. $c->COLUMN_NAME . '\'';?>)" class="form-control"
                                    type="text" id="<?php echo  $c->COLUMN_NAME ;?>"
                                    name="<?php echo  $c->COLUMN_NAME ;?>"></textarea>

                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class=" clearfix">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary pull-right" name="aggiungi" value="Aggiungi"
                        style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>

<form method="post" enctype="multipart/form-data" action="/pipeline">
    @csrf
    <div class="modal fade" id="modal_filtra">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Filtra Pipeline</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php foreach ($column as $c){ ?>
                            <?php if ($c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Vendita_Budget' && $c->COLUMN_NAME != 'Inc_Canone_AS' && $c->COLUMN_NAME != 'Inc_Anno_Solare' && $c->COLUMN_NAME != 'Note'){ ?>

                            <?php if ($c->COLUMN_NAME != 'Sales'){ ?>

                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label><?php if ($c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Inc_Canone_AS' && $c->COLUMN_NAME != 'Inc_Anno_Solare') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                           <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'Valore Vendita A/C'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone A/C'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Vinta') echo 'Trattativa'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Inc_Canone_AS') echo 'Incremento Canone A/S'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Inc_Anno_Solare') echo 'Incremento Anno Solare'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                    <b
                                        style="color:red">*</b></label>
                                    <?php if ($c->COLUMN_NAME != 'Note' && $c->COLUMN_NAME != 'Ragione_Sociale' && $c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Motivazione' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Dipendente' && $c->DATA_TYPE != 'date' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
                                <input
                                        <?php if ($c->DATA_TYPE == 'varchar') echo 'value="Nessun Filtro..." onKeyUp="converti(\'' . $c->COLUMN_NAME . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" min="0" step="0.01" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" min="0" step="1" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                >


                                <?php } ?>
                                <?php if ($c->DATA_TYPE == 'date'){ ?>
                                <div style="display: flex">

                                    <input style="width:50%;" <?php
                                        echo 'style="width:100%" class="form-control" type="date" id="' .
                                        $c->COLUMN_NAME . '_i" name="' . $c->COLUMN_NAME . '_i"'; ?>>
                                    <input style="width:50%;" <?php
                                        echo 'style="width:100%" class="form-control" type="date" id="' .
                                        $c->COLUMN_NAME . '_f" name="' . $c->COLUMN_NAME . '_f"'; ?>>
                                </div>

                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Ragione_Sociale') { ?>
                                <input type="text" name="Ragione_Sociale" id="Ragione_Sociale"
                                       class="form-control" list="clienti">
                                <datalist id="clienti">
                                    @foreach($clienti as $c1)
                                    <option value="{{$c1->Ragione_Sociale}}">{{$c1->Ragione_Sociale}}</option>
                                    @endforeach
                                </datalist>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Vinta') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="undefined">Nessun Filtro...
                                    </option>
                                        <?php foreach ($esito_trattativa as $e){ ?>
                                    <option value="{{$e->id}}">{{$e->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>

                                <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                    <?php foreach ($segnalato as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Motivazione') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                    <?php foreach ($motivazione as $m){ ?>
                                    <option value="{{$m->descrizione}}">{{$m->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>

                                <?php if ($c->COLUMN_NAME == 'Prodotto') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                    <?php foreach ($prodotto as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>

                                <?php } ?>

                                <?php if ($c->COLUMN_NAME == 'Dipendente') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                    <?php foreach ($dipendenti as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Tipo_Cliente') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                    <option value="OLD">OLD
                                    </option>
                                    <option value="LEAD">LEAD
                                    </option>
                                    <option value="RIENTRO">RIENTRO
                                    </option>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Categoria') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                    @foreach($categoria as $c1)
                                        <option value="{{ $c1->descrizione }}">{{ $c1->descrizione }}</option>
                                    @endforeach
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                    name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="Nessun Filtro...">Nessun Filtro...
                                    </option>
                                    <option value="25">25
                                    </option>
                                    <option value="50">50
                                    </option>
                                    <option value="75">75
                                    </option>
                                    <option value="100">100
                                    </option>
                                </select>
                                <?php } ?>
                                <?php if ($c->COLUMN_NAME == 'Note') { ?>
                                <textarea rows="8" cols="100"
                                    onKeyUp="converti(<?php echo '\''. $c->COLUMN_NAME . '\'';?>)" class="form-control"
                                    type="text" id="<?php echo  $c->COLUMN_NAME ;?>"
                                    name="<?php echo  $c->COLUMN_NAME ;?>">Nessun Filtro...</textarea>

                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                            <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sales<b style="color:red">*</b></label>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="Nessun Filtro...">Nessun Filtro...
                                    </option>
                                        <?php foreach ($operatori as $o){ ?>
                                    <option value="{{$o->username}}">{{$o->username}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Zona <b style="color:red">*</b></label>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>_GRUPPO"
                                        name="<?php echo $c->COLUMN_NAME ;?>_GRUPPO">
                                    <option value="Nessun Filtro...">Nessun Filtro...
                                    </option>
                                        <?php foreach ($zone as $z){ ?>
                                    <option value="{{$z->descrizione}}">{{$z->descrizione}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                            <?php if ($c->COLUMN_NAME == 'Prodotto'){ ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gruppo Prodotto<b style="color:red">*</b></label>
                                <select style="width:100%" class="form-control" id="gruppo_prodotto"
                                    name="gruppo_prodotto">
                                    <option value="undefined">Nessun Filtro...
                                    </option>
                                    @foreach($gruppo as $g)
                                    <option value="{{ $g->prodotti }}">{{$g->gruppo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>


                    </div>
                    <div class=" clearfix">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary pull-right" name="filtra" value="Filtra"
                        style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>

<?php foreach ($rows as $r){ ?>
<form method="post" enctype="multipart/form-data" action="/pipeline">
    @csrf
    <div class="modal fade" id="modal_modifica_<?php echo $r->Id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Modifica richiesta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="ajax_modifica_<?php echo $r->Id;?>"></div>
                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="Id" value="<?php echo $r->Id;?>">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary pull-right" name="modifica" value="modifica"
                        style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>
<form method="post" enctype="multipart/form-data" action="/pipeline">
    @csrf
    <div class="modal fade" id="modal_duplica_<?php echo $r->Id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Duplica richiesta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="ajax_duplica_<?php echo $r->Id;?>"></div>
                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="Id_Padre" value="<?php echo $r->Id;?>">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary pull-right" name="duplica" value="Duplica"
                        style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>
<?php } ?>


<?php foreach ($rows as $r){ ?>
<?php if ($r->Note != ''){ ?>
<div class="modal fade" id="modal_nota_<?php echo $r->Id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titolo_modal_mgmov">Nota Record
                    <?php echo $r->Id ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $r->Note; ?>
                <div class=" clearfix">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>

<script>


    var cfSelected;
    var cfs = [];

    function toggleAccordion() {
        var selectElement = document.getElementById('clientiSelect');
        var accordionButton = document.getElementById('accordionButton');
        var accordionContent = document.getElementById('accordionContent');

        if (selectElement.value !== "") {
            var selectedValue = document.getElementById("clientiSelect").value;

            console.log(selectedValue);
             var result = cfs.filter((e) => e.Descrizione.includes(selectedValue))[0]
 
            accordionButton.removeAttribute('disabled');
            accordionContent.classList.add('show');
         
            var content = document.getElementById("contenuto").innerHTML = `
            <div class="form-group">
                    <label>Codice Sap</b>  </label>
                    <input class="form-control" value='${result.xCodSap}' disabled>
                </div>
                <div class="form-group">
                    <label>Partita Iva</b></label>
                    <input class="form-control" value='${result.PartitaIva}' disabled>
                </div>
                <div class="form-group">
                    <label>Canone Annualep</b></label>
                    <input class="form-control" value='${parseFloat(result.xImpAss).toFixed(2).replace('.', ',')} €' disabled>
            </div> 
            `

        } else {
           
            accordionButton.setAttribute('disabled', 'disabled');
            accordionContent.classList.remove('show');
        }
    }

    function fetchCF(callback) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'api/cf', true);
        xhr.onreadystatechange = function () {
            console.log(xhr.status);
            if (xhr.readyState === 4 && xhr.status === 200) {
                cfs = [];
                var data = JSON.parse(xhr.responseText);
                var clientiSelect = document.getElementById('clientiSelect');

                clientiSelect.innerHTML = '<option value=""> Seleziona un cliente </option>';

                data.forEach(function (cliente) {
                    var option = document.createElement('option');
                    option.value = cliente.Descrizione;
                    option.textContent = cliente.Descrizione;
                    clientiSelect.appendChild(option);
                });

                console.log(data);
                cfs = data;

                $('.select2').select2();
            }
        };
        xhr.send();
    }

    document.addEventListener('DOMContentLoaded', function () {
        fetchCF();
    });

</script>



<script type="text/javascript">
    function check_vinta(classname) {
        vinta = $('.' + classname).val();
        if (vinta == 1)
            $('.' + classname.replace('vinta', 'motivazione')).removeAttr('disabled');
        if (vinta != 1) {
            $('.' + classname.replace('vinta', 'motivazione')).attr('disabled', 'disabled');
        }
    }

    function check_segnalato(classname) {
        segnalato = $('.' + classname).val();
        if (segnalato == 'DIPENDENTE')
            $('.' + classname.replace('segnalato', 'dipendente')).removeAttr('disabled');
        if (segnalato != 'DIPENDENTE') {
            $('.' + classname.replace('segnalato', 'dipendente')).attr('disabled', 'disabled');
        }
    }

    function modifica_ajax(id) {

        $.ajax({
            url: '<?php echo URL::asset('ajax/modifica_ajax') ?>/' + id,
            type: "POST",
            //contentType: "application/json",
            data: {}
        }).done(function (result) {
                $('#ajax_modifica_' + id).html(result);
            });
    }

    function duplica_ajax(id) {
        $.ajax({
            url: '<?php echo URL::asset('ajax/duplica_ajax') ?>/' + id,
            type: "POST",
            contentType: "application/json",
            data: {}
        }).done(function (result) {
                $('#ajax_duplica_' + id).html(result);
            });
    }

    function aggiungi() {
        $('#modal_aggiungi').modal('show');
    }

    function nota(id) {
        $('#modal_nota_' + id).modal('show');
    }

    function filtra() {
        $('#modal_filtra').modal('show');
    }

    function modifica(id) {
        modifica_ajax(id);
        $('#modal_modifica_' + id).modal('show');
    }

    function duplica(id) {
        duplica_ajax(id);
        $('#modal_duplica_' + id).modal('show');
    }

    function converti(id) {
        document.getElementById(id).value = document.getElementById(id).value.toUpperCase();
    }

    function chiudi(id) {
        $('#modal_chiudi_' + id).modal('show');
    }
</script>