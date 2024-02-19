<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                PROMEDYA | Sales Force
                <small>&nbsp;&nbsp;<b id="countdown"></b></small>
            </h1>
            <br>
            @if ($utente->username == 'Giovanni Tutino')
                <button class="form-control btn-primary" style="border-radius:25px" id="aggiungi_concessionario"
                        onclick="aggiungi()" name="aggiungi_concessionario">
                    Aggiungi
                    Nuovo
                    Contatto
                </button>
                <br>
            @endif
            <button class="form-control btn-danger" style="border-radius:25px" id="filtra_concessionario"
                    onclick="filtra()"
                    name="filtra_concessionario">
                Filtri / Ricerca
            </button>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="content-wrapper" style="margin:1% 1% 0 1%!important;">
                <div class="row">
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
                                                <?php if ($c->COLUMN_NAME != 'Val_Licenza_AC' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Costo_Canone_AS_WKI') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                                <?php if ($c->COLUMN_NAME == 'Val_Licenza_AC') echo 'Valore Licenza'; ?>
                                                <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone'; ?>
                                                <?php if ($c->COLUMN_NAME == 'Costo_Canone_AS_WKI') echo 'Costo Canone WKI'; ?>
                                                <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                        </th>
                                        <?php } ?>

                                        @if ($utente->username == 'Giovanni Tutino')
                                            <th class="no-sort"
                                                style="text-align: center;background-color: lightblue;!important;border-color: grey; border-width:1px">
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

                                        <td class="no-sort"
                                            style="contain:content;
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
                                                <td class="no-sort"
                                                    style="background:white;border-color: grey; border-width:1px">
                                                    <div style="display:flex;gap: 2px;">
                                                        <button type="button" onclick="modifica(<?php echo $r->Id;?>)"
                                                                class="form-control btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                 height="14"
                                                                 fill="currentColor" class="bi bi-pencil"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                            </svg>
                                                        </button>
                                                        <button type="submit" name="elimina"
                                                                value="<?php echo $r->Id;?>"
                                                                class="form-control btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                 height="14"
                                                                 fill="currentColor" class="bi bi-trash"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                                <path
                                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                            </svg>
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
                                        <th class="no-sort"
                                            style="<?php if ($c->COLUMN_NAME == 'Costo_Licenza_WKI' ||$c->COLUMN_NAME == 'Costo_Canone_AS_WKI') echo 'color:red;';if($c->COLUMN_NAME == 'Ricavi_Canone' || $c->COLUMN_NAME == 'Ricavi_Licenza') echo 'color:green;'?><?php if(isset(${$c->COLUMN_NAME})) echo 'text-align:right;'?>width:20px;border-color: grey; border-width:1px"><?php if (isset(${$c->COLUMN_NAME})) echo number_format(${$c->COLUMN_NAME}, 2, ',', '.'); ?></th>
                                        <?php } ?>
                                        @if ($utente->username == 'Giovanni Tutino')

                                            <th class="no-sort"
                                                style="width:20px;border-color: grey; border-width:1px"></th>
                                        @endif
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
                                    <?php if ($c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
                                <input
                                    onchange="calcola_ricavi()"
                                        <?php if ($c->COLUMN_NAME == 'Val_Licenza_AC') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Ragione_Sociale') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Prodotto') echo 'required'; ?>
                                    <?php if ($c->DATA_TYPE == 'varchar') echo 'onKeyUp="converti(\'' . $c->COLUMN_NAME . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" min="0" step="0.01" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" min="0" step="1" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
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
                                    <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                                <select style="width:100%" class="form-control"
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
                                    <?php if ($c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Tipo_Cliente' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Segnalato' && $c->DATA_TYPE != 'date' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
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
                                    <?php if ($c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Tipo_Cliente' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
                                <input
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
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                        <?php foreach ($segnalato as $s){ ?>
                                    <option
                                        value="{{$s->descrizione}}" <?php if ($r->{$c->COLUMN_NAME} == $s->descrizione) echo 'selected'; ?> >{{$s->descrizione}}</option>
                                    <?php } ?>
                                    {{--<option <?php if ($r->{$c->COLUMN_NAME} == 'COMMERCIALISTA') echo 'selected'; ?> value="COMMERCIALISTA">
                                        COMMERCIALISTA
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'Ragione_Sociale') echo 'selected'; ?> value="Ragione_Sociale">
                                        Ragione_Sociale
                                    </option>
                                    --}}{{--<option <?php if ($r->{$c->COLUMN_NAME} == 'PASSA_PAROLA') echo 'selected'; ?> value="PASSA_PAROLA">
                                        PASSA PAROLA
                                    </option>
                                    --}}{{--
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'OCCASIONALE') echo 'selected'; ?> value="OCCASIONALE">
                                        OCCASIONALE
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'WEB') echo 'selected'; ?> value="WEB">
                                        WEB
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 'CONTO_TERZI') echo 'selected'; ?> value="CONTO_TERZI">
                                        CONTO TERZI
                                    </option>--}}
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
