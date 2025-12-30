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
        <button class="form-control btn-primary" style="border-radius:25px" id="aggiungi_pipeline" onclick="aggiungi()"
            name="aggiungi_pipeline">Aggiungi Nuovo Contatto
        </button>

        <br>
        <button class="form-control btn-danger" style="border-radius:25px" id="filtra_pipeline" onclick="filtra()"
            name="filtra_pipeline">
            Filtri / Ricerca
        </button>

    </section>
    <!-- Main content -->
    <section class="content">
        <div class="content-wrapper" style="margin:1% 1% 0 1%!important;">
            <div class="row">
                <div style="display: flex;width: 100%;justify-content: center">
                    <div style="min-width: 360px;">
                        <ul class="charts-css legend legend-rectangle" style="flex-direction:row;">
                            <li>In Corso</li>
                            <li>Persa</li>
                            <li>Vinta</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example11" class="table table-bordered datatable"
                                style="border-color: grey; border-width:1px;">
                                <thead>
                                <tr>
                                    <?php foreach ($column as $c){ ?>
                                    <th class="no-sort"
                                        style="text-align: center;background-color: lightblue;!important;border-color: grey; border-width:1px">
                                            <?php if ($c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Inc_Canone_AS' && $c->COLUMN_NAME != 'Inc_Anno_Solare') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                            <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'Valore Vendita A/C'; ?>
                                            <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone A/C'; ?>
                                            <?php if ($c->COLUMN_NAME == 'Vinta') echo 'Trattativa'; ?>
                                            <?php if ($c->COLUMN_NAME == 'Inc_Canone_AS') echo 'Incremento Canone A/S'; ?>
                                            <?php if ($c->COLUMN_NAME == 'Inc_Anno_Solare') echo 'Incremento Anno Solare'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                    </th>
                                    <?php } ?>
                                    <th class="no-sort"
                                        style="text-align: center;background-color: lightblue;!important;border-color: grey; border-width:1px">
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

                                        <td class="no-sort" style="contain:content;
                                        <?php if(($c->DATA_TYPE == 'varchar') && $c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Id_Padre' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria') echo 'text-align:left;';
                                            if($c->DATA_TYPE=='int'||$c->DATA_TYPE=='float') echo 'text-align:right;' ;
                                            if($c->DATA_TYPE=='date') echo 'text-align:center;' ;
                                            if($c->COLUMN_NAME =='Vinta' || $c->COLUMN_NAME == 'Note') echo 'text-align:center;' ;?>
                                                border-color: grey; border-width:1px">
                                            <?php if ($c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Note') {
                                            if (($c->DATA_TYPE == 'int' || $c->DATA_TYPE == 'float') and $c->COLUMN_NAME != 'Id' and $c->COLUMN_NAME != 'Id_Padre' and $c->COLUMN_NAME != 'Probabilita_Chiusura') echo number_format($r->{$c->COLUMN_NAME}, 2, '.', ''); else echo ($c->DATA_TYPE != 'date') ? $r->{$c->COLUMN_NAME} : date('d-m-Y', strtotime($r->{$c->COLUMN_NAME}));
                                        } ?>
                                            <?php if ($c->COLUMN_NAME == 'Vinta') {

                                            foreach ($esito_trattativa as $e) {
                                                if ($r->{$c->COLUMN_NAME} == $e->id) echo $e->descrizione;
                                            }
                                        } ?>
                                            <?php if ($c->COLUMN_NAME == 'Note' && ($r->{$c->COLUMN_NAME} != '')) { ?>
                                            <button class="form-control btn-default"
                                                onclick="nota('<?php echo $r->Id; ?>');">NOTA
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
                                                style="background:white;border-color: grey; border-width:1px">
                                                <div style="display:flex;gap: 2px;">
                                                    <button type="button" onclick="modifica(<?php echo $r->Id;?>)"
                                                        class="form-control btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            fill="currentColor" class="bi bi-pencil"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                        </svg>
                                                    </button>
                                                    <button type="button" onclick="duplica(<?php echo $r->Id;?>)"
                                                        class="form-control btn-warning">
                                                        <i class="fa fa-clone" aria-hidden="true"
                                                            style="color: white"></i>
                                                    </button>
                                                    <button type="submit" name="elimina" value="<?php echo $r->Id;?>"
                                                        class="form-control btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                            <path
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr style="background-color: lightblue">
                                    <?php foreach ($column as $c){ ?>
                                    <th class="no-sort"
                                        style="<?php if(isset(${$c->COLUMN_NAME})) echo 'text-align:right;'?>width:20px;border-color: grey; border-width:1px"><?php if (isset(${$c->COLUMN_NAME})) echo number_format(${$c->COLUMN_NAME}, 2, '.', ''); ?></th>
                                    <?php } ?>
                                    <th class="no-sort" style="width:20px;border-color: grey; border-width:1px"></th>
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