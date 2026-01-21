<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header" style="padding: 1.5rem;">
            <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 1rem;">
                Smart Sales Force | Gestione Concessionario
                <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
            </h1>
            <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                @if ($utente->username == 'Giovanni Tutino')
                    <button class="btn btn-primary" style="padding: 0.75rem 2rem;" id="aggiungi_concessionario" onclick="aggiungi()" name="aggiungi_concessionario">
                        <i class="fas fa-plus" style="margin-right: 0.5rem;"></i>
                        Aggiungi Nuovo Contatto
                    </button>
                @endif
                <button class="btn btn-danger" style="padding: 0.75rem 2rem;" id="filtra_concessionario" onclick="filtra()" name="filtra_concessionario">
                    <i class="fas fa-filter" style="margin-right: 0.5rem;"></i>
                    Filtri / Ricerca
                </button>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="content-wrapper" style="margin:1% 1% 0 1%!important;">
                <div class="row">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="card animate-fadeIn">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-handshake" style="margin-right: 0.5rem;"></i>Elenco Concessionari</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="example11" class="table table-bordered datatable m-0" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <?php foreach ($column as $c){ ?>
                                            <th class="no-sort" style="text-align: center;background-color: lightblue;!important;border-color: grey; border-width:1px;white-space: nowrap;">
                                                    <?php if ($c->COLUMN_NAME != 'Val_Licenza_AC' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Costo_Canone_AS_WKI') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                                    <?php if ($c->COLUMN_NAME == 'Val_Licenza_AC') echo 'Valore Licenza'; ?>
                                                    <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone'; ?>
                                                    <?php if ($c->COLUMN_NAME == 'Costo_Canone_AS_WKI') echo 'Costo Canone WKI'; ?>
                                                    <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                            </th>
                                            <?php } ?>

                                            @if ($utente->username == 'Giovanni Tutino')
                                                <th class="no-sort" style="text-align: center;background-color: lightblue;!important;border-color: grey; border-width:1px;white-space: nowrap;">
                                                    Azioni
                                                </th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($rows as $r){ ?>
                                        <tr>
                                            <?php foreach ($column as $c){ ?>

                                            <?php
                                            if ($c->COLUMN_NAME == 'Val_Licenza_AC') {
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
                                            if ($c->COLUMN_NAME == 'Costo_Licenza_WKI') {
                                                if (isset(${$c->COLUMN_NAME}))
                                                    ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                                else
                                                    ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                            }
                                            if ($c->COLUMN_NAME == 'Ricavi_Licenza') {
                                                if (isset(${$c->COLUMN_NAME}))
                                                    ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                                else
                                                    ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                            }
                                            if ($c->COLUMN_NAME == 'Ricavi_Canone') {
                                                if (isset(${$c->COLUMN_NAME}))
                                                    ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                                else
                                                    ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                            }
                                            if ($c->COLUMN_NAME == 'Costo_Canone_AS_WKI') {
                                                if (isset(${$c->COLUMN_NAME}))
                                                    ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                                else
                                                    ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                            } ?>

                                        <td class="no-sort" style="white-space: nowrap;
                                        <?php if(($c->DATA_TYPE == 'varchar') && $c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria') echo 'text-align:left;';
                                            if($c->DATA_TYPE=='int'||$c->DATA_TYPE=='float') echo 'text-align:right;' ;
                                            if($c->DATA_TYPE=='date') echo 'text-align:center;' ;
                                            if($c->COLUMN_NAME == 'Costo_Canone_AS_WKI') echo 'color:red;' ;
                                            if($c->COLUMN_NAME == 'Costo_Licenza_WKI') echo 'color:red;' ;
                                            if($c->COLUMN_NAME == 'Ricavi_Canone') echo 'color:green;' ;
                                            if($c->COLUMN_NAME == 'Ricavi_Licenza') echo 'color:green;' ;
                                            ?>
                                                border-color: grey; border-width:1px">
                                                <?php if (($c->DATA_TYPE == 'int' || $c->DATA_TYPE == 'float') and $c->COLUMN_NAME != 'Id') echo number_format($r->{$c->COLUMN_NAME}, 2, ',', '.'); else echo ($c->DATA_TYPE != 'date') ? $r->{$c->COLUMN_NAME} : date('d-m-Y', strtotime($r->{$c->COLUMN_NAME})); ?>
                                        </td>
                                        <?php } ?>

                                            @if ($utente->username == 'Giovanni Tutino')
                                                <form enctype="multipart/form-data" method="post">
                                                    @csrf
                                                    <td class="no-sort" style="background:white;border-color: grey; border-width:1px;white-space: nowrap;">
                                                        <div style="display:flex;gap: 0.5rem; justify-content: center;">
                                                            <button type="button" onclick="modifica(<?php echo $r->Id;?>)" class="btn btn-primary" style="padding: 0.5rem 0.75rem;" title="Modifica">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="submit" name="elimina" value="<?php echo $r->Id;?>" class="btn btn-danger" style="padding: 0.5rem 0.75rem;" title="Elimina">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </form>
                                            @endif
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr style="background-color: lightblue">
                                            <?php foreach ($column as $c){ ?>
                                            <th class="no-sort" style="<?php if ($c->COLUMN_NAME == 'Costo_Licenza_WKI' ||$c->COLUMN_NAME == 'Costo_Canone_AS_WKI') echo 'color:red;';if($c->COLUMN_NAME == 'Ricavi_Canone' || $c->COLUMN_NAME == 'Ricavi_Licenza') echo 'color:green;'?><?php if(isset(${$c->COLUMN_NAME})) echo 'text-align:right;'?>border-color: grey; border-width:1px;white-space: nowrap;"><?php if (isset(${$c->COLUMN_NAME})) echo number_format(${$c->COLUMN_NAME}, 2, ',', '.'); ?></th>
                                            <?php } ?>
                                            @if ($utente->username == 'Giovanni Tutino')
                                                <th class="no-sort" style="border-color: grey; border-width:1px"></th>
                                            @endif
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>
</div>
<!-- /.container-fluid-->


@include('common.footer')

<form method="post"
      onsubmit="return confirm('Vuoi aggiungere questa nuova Lead?');"
      enctype="multipart/form-data" action="/concessionario">
    @csrf
    <div class="modal fade" id="modal_aggiungi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Crea concessionario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php foreach ($column as $c){
                        if ($c->COLUMN_NAME != 'Id'){ ?>
                        <div class="col-md-<?php if($c->COLUMN_NAME == 'Prodotto') echo '12';else echo '6';?>">
                            <div class="form-group">
                                <label>
                                        <?php if ($c->COLUMN_NAME != 'Val_Licenza_AC' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Costo_Canone_AS_WKI') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                        <?php if ($c->COLUMN_NAME == 'Val_Licenza_AC') echo 'Valore Licenza'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Costo_Canone_AS_WKI') echo 'Costo Canone WKI'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                    <b style="color:red">*</b></label>
                                    <?php if ($c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Dipendente' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
                                <input
                                    onchange="calcola_ricavi()"
                                        <?php if ($c->COLUMN_NAME == 'Val_Licenza_AC') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Ragione_Sociale') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Prodotto') echo 'required'; ?>
                                    <?php if ($c->DATA_TYPE == 'varchar') echo 'onKeyUp="converti(\'' . $c->COLUMN_NAME . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" min="0" step="0.01" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" min="0" step="1" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'date' && $c->COLUMN_NAME == 'Data') echo 'value="' . date('Y-m-d', strtotime('now')) . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'date') echo 'style="width:100%" class="form-control" type="date" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>>


                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Prodotto') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                        <?php foreach ($prodotto as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>

                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">

                                        <?php foreach ($operatori as $o){ ?>
                                    <option
                                        value="{{$o->username}}" <?php if ($o->username == $utente->username) echo 'selected'; ?> >{{$o->username}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Categoria') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <option value="COMMERCIALISTA">COMMERCIALISTA
                                    </option>
                                    <option value="AZIENDA">AZIENDA
                                    </option>
                                    <option value="CONSULENTE DEL LAVORO">CONSULENTE DEL LAVORO
                                    </option>
                                    <option value="ALTRO">ALTRO
                                    </option>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Tipo_Cliente') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
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
                                    <?php if ($c->COLUMN_NAME == 'Dipendente') { ?>
                                <select style="width:100%" class="form-control aggiungi_dipendente" disabled="disabled"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                        <?php foreach ($dipendenti as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                                <select style="width:100%" class="form-control aggiungi_segnalato"
                                        onchange="check_segnalato('aggiungi_segnalato')"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                        <?php foreach ($segnalato as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
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
                    <input type="submit" class="btn btn-primary pull-right"
                           name="aggiungi"
                           value="Aggiungi"
                           style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>

<form method="post" enctype="multipart/form-data" action="/concessionario">
    @csrf
    <div class="modal fade" id="modal_filtra">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Filtra concessionario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php foreach ($column as $c){
                        if ($c->COLUMN_NAME != 'Id'){ ?>
                        <div class="col-md-<?php if($c->COLUMN_NAME == 'Prodotto') echo '12';else echo '6';?>">
                            <div class="form-group">
                                <label><?php if ($c->COLUMN_NAME != 'Val_Licenza_AC' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Costo_Canone_AS_WKI') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                           <?php if ($c->COLUMN_NAME == 'Val_Licenza_AC') echo 'Valore Licenza'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Costo_Canone_AS_WKI') echo 'Costo Canone WKI'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                    <b style="color:red">*</b></label>
                                    <?php if ($c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Dipendente' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Segnalato' && $c->DATA_TYPE != 'date' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
                                <input
                                        <?php if ($c->DATA_TYPE == 'varchar') echo 'value="Nessun Filtro..." onKeyUp="converti(\'' . $c->COLUMN_NAME . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>

                                    <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" min="0" step="0.01" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" min="0" step="1" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                >


                                <?php } ?>
                                    <?php if ($c->DATA_TYPE == 'date'){ ?>
                                <div style="display: flex">

                                    <input
                                        style="width:50%;" <?php echo 'style="width:100%" class="form-control" type="date" id="' . $c->COLUMN_NAME . '_i" name="' . $c->COLUMN_NAME . '_i"'; ?>>
                                    <input
                                        style="width:50%;" <?php echo 'style="width:100%" class="form-control" type="date" id="' . $c->COLUMN_NAME . '_f" name="' . $c->COLUMN_NAME . '_f"'; ?>>
                                </div>

                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                        <?php foreach ($segnalato as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Dipendente') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                        <?php foreach ($dipendenti as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Tipo_Cliente') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
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
                                    <?php if ($c->COLUMN_NAME == 'Prodotto') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                        <?php foreach ($prodotto as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>

                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option
                                        value="Nessun Filtro...">Nessun Filtro...
                                    </option>
                                        <?php foreach ($operatori as $o){ ?>
                                    <option
                                        value="{{$o->username}}">{{$o->username}}</option>
                                    <?php } ?>
                                </select>
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
                    <input type="submit" class="btn btn-primary pull-right" name="filtra" value="Filtra"
                           style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>


<?php foreach ($rows as $r){ ?>
<form method="post" enctype="multipart/form-data" action="/concessionario">
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
                    <div class="row">
                            <?php foreach ($column as $c){
                        if ($c->COLUMN_NAME != 'Id'){ ?>
                        <div class="col-md-<?php if($c->COLUMN_NAME == 'Prodotto') echo '12';else echo '6';?>">
                            <div class="form-group">
                                <label><?php if ($c->COLUMN_NAME != 'Val_Licenza_AC' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Costo_Canone_AS_WKI') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                           <?php if ($c->COLUMN_NAME == 'Val_Licenza_AC') echo 'Valore Licenza'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Costo_Canone_AS_WKI') echo 'Costo Canone WKI'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                    <b
                                        style="color:red">*</b></label>
                                    <?php if ($c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Dipendente' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
                                <input onchange="calcola_ricavi_id('<?php echo $r->Id;?>')"
                                       <?php if ($c->DATA_TYPE == 'varchar') echo 'onKeyUp="converti(\'' . $c->COLUMN_NAME . $r->Id . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                           <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" min="0" step="0.01" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                           <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" min="0" step="1" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                           <?php if ($c->DATA_TYPE == 'date') echo 'style="width:100%" class="form-control" type="date" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                       value="<?php echo $r->{$c->COLUMN_NAME};?>">
                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Prodotto') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Nessun Filtro...
                                    </option>
                                        <?php foreach ($prodotto as $s){ ?>
                                    <option <?php if ($s->descrizione == $r->{$c->COLUMN_NAME}) echo 'selected'; ?> value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>

                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                        <?php foreach ($operatori as $o){ ?>
                                    <option
                                        value="{{$o->username}}" <?php if ($o->username == $r->{$c->COLUMN_NAME}) echo 'selected'; ?> >{{$o->username}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Tipo_Cliente') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'OLD') echo 'selected'; ?> value="OLD">
                                        OLD
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'LEAD') echo 'selected'; ?> value="LEAD">
                                        LEAD
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'RIENTRO') echo 'selected'; ?> value="RIENTRO">
                                        RIENTRO
                                    </option>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Categoria') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'COMMERCIALISTA') echo 'selected'; ?> value="COMMERCIALISTA">
                                        COMMERCIALISTA
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'AZIENDA') echo 'selected'; ?> value="AZIENDA">
                                        AZIENDA
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'CONSULENTE DEL LAVORO') echo 'selected'; ?> value="CONSULENTE DEL LAVORO">
                                        CONSULENTE DEL LAVORO
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'ALTRO') echo 'selected'; ?> value="ALTRO">
                                        ALTRO
                                    </option>
                                </select>
                                <?php } ?>


                                    <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                                <select style="width:100%" class="form-control modifica_segnalato<?php echo $r->Id; ?>"
                                        onchange="check_segnalato('modifica_segnalato<?php echo $r->Id; ?>')"
                                        id="<?php echo $c->COLUMN_NAME; ?>"
                                        name="<?php echo $c->COLUMN_NAME; ?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                        <?php foreach ($segnalato as $s) { ?>
                                    <option
                                        value="<?php echo $s->descrizione; ?>"
                                            <?php if ($r->{$c->COLUMN_NAME} == $s->descrizione) echo 'selected'; ?> >
                                            <?php echo $s->descrizione; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Dipendente') { ?>
                                <select style="width:100% " class="form-control modifica_dipendente<?php echo $r->Id;?>"
                                        <?php if ($r->Segnalato != 'DIPENDENTE') echo ' disabled="disabled"'; ?>
                                        id="<?php echo $c->COLUMN_NAME; ?>"
                                        name="<?php echo $c->COLUMN_NAME; ?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                        <?php foreach ($dipendenti as $s) { ?>
                                    <option
                                        value="<?php echo $s->descrizione; ?>"
                                            <?php if ($r->{$c->COLUMN_NAME} == $s->descrizione) echo 'selected'; ?> >
                                            <?php echo $s->descrizione; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option <?php if ($r->{
                                        $c->COLUMN_NAME
                                        } == 25) echo 'selected'; ?> value="25">25
                                    </option>
                                    <option <?php if ($r->{
                                        $c->COLUMN_NAME
                                        } == 50) echo 'selected'; ?> value="50">50
                                    </option>
                                    <option <?php if ($r->{
                                        $c->COLUMN_NAME
                                        } == 75) echo 'selected'; ?> value="75">75
                                    </option>
                                    <option <?php if ($r->{
                                        $c->COLUMN_NAME
                                        } == 100) echo 'selected'; ?> value="100">100
                                    </option>
                                </select>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
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
<?php } ?>


<script type="text/javascript">

    $(document).ready(function () {
        $('#ajax_loader').fadeIn(function () {
            var psw = prompt('Inserire Password per visualizzare');
            if (psw === 'goldrake') {
                $('#ajax_loader').fadeOut();
            } else {
                alert('password errata!');
                top.location.href = 'https://pipeline.promedya.it/';
            }
        });

    });

    function check_segnalato(classname) {
        segnalato = $('.' + classname).val();

        if (segnalato === 'DIPENDENTE')
            $('.' + classname.replace('segnalato', 'dipendente')).removeAttr('disabled');
        if (segnalato !== 'DIPENDENTE') {
            $('.' + classname.replace('segnalato', 'dipendente')).attr('disabled', 'disabled');
        }
    }

    function aggiungi() {
        $('#modal_aggiungi').modal('show');
    }

    function calcola_ricavi() {
        ricavi_canone = 0;
        ricavi_licenza = 0;
        Valore_Licenza = $('#Val_Licenza_AC').val();
        Costo_Licenza = $('#Costo_Licenza_WKI').val();
        Valore_Canone = $('#Val_Can_AC').val();
        Costo_Canone = $('#Costo_Canone_AS_WKI').val();
        if (Valore_Licenza != '' && Costo_Licenza != '')
            ricavi_licenza = parseFloat(Valore_Licenza) - parseFloat(Costo_Licenza);
        if (Valore_Canone != '' && Costo_Canone != '')
            ricavi_canone = parseFloat(Valore_Canone) - parseFloat(Costo_Canone);

        $('#Ricavi_Licenza').val(ricavi_licenza);
        $('#Ricavi_Canone').val(ricavi_canone);
    }

    function calcola_ricavi_id(id) {
        ricavi_canone = 0;
        ricavi_licenza = 0;
        Valore_Licenza = $('#Val_Licenza_AC' + id).val();
        Costo_Licenza = $('#Costo_Licenza_WKI' + id).val();
        Valore_Canone = $('#Val_Can_AC' + id).val();
        Costo_Canone = $('#Costo_Canone_AS_WKI' + id).val();
        if (Valore_Licenza != '' && Costo_Licenza != '')
            ricavi_licenza = parseFloat(Valore_Licenza) - parseFloat(Costo_Licenza);
        if (Valore_Canone != '' && Costo_Canone != '')
            ricavi_canone = parseFloat(Valore_Canone) - parseFloat(Costo_Canone);
        $('#Ricavi_Licenza' + id).val(ricavi_licenza);
        $('#Ricavi_Canone' + id).val(ricavi_canone);
    }

    function filtra() {
        $('#modal_filtra').modal('show');
    }

    function modifica(id) {
        $('#modal_modifica_' + id).modal('show');
    }

    function converti(id) {
        document.getElementById(id).value = document.getElementById(id).value.toUpperCase();
    }

    function chiudi(id) {
        $('#modal_chiudi_' + id).modal('show');
    }
</script>
