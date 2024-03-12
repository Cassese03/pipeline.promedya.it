<?php

namespace App\Http\Controllers;


use App\Models\Segnalato;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;


/**
 * Controller principale del webticket
 * Class HomeController
 * @package App\Http\Controllers
 */
class AjaxController extends Controller
{
    public function riga_ajax($id)
    {

        $riga = DB::select('SELECT * from pipeline where Id = ' . $id);
        $column = DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N\'pipeline\'');
        foreach ($riga as $r) { ?>

            <?php foreach ($column as $c) { ?>

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
                } ?>

                <td class="no-sort"
                    style="contain:content;
                    <?php if (($c->DATA_TYPE == 'varchar') && $c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Id_Padre' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria') echo 'text-align:left;';
                    if ($c->DATA_TYPE == 'int' || $c->DATA_TYPE == 'float') echo 'text-align:right;';
                    if ($c->DATA_TYPE == 'date') echo 'text-align:center;';
                    if ($c->COLUMN_NAME == 'Vinta' || $c->COLUMN_NAME == 'Note') echo 'text-align:center;'; ?>
                        border-color: grey; border-width:1px">
                    <?php if ($c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Note') {
                        if (($c->DATA_TYPE == 'int' || $c->DATA_TYPE == 'float') and $c->COLUMN_NAME != 'Id' and $c->COLUMN_NAME != 'Id_Padre' and $c->COLUMN_NAME != 'Probabilita_Chiusura') echo number_format($r->{$c->COLUMN_NAME}, 2, ',', '.'); else echo ($c->DATA_TYPE != 'date') ? $r->{$c->COLUMN_NAME} : date('d-m-Y', strtotime($r->{$c->COLUMN_NAME}));
                    } ?>
                    <?php if ($c->COLUMN_NAME == 'Vinta') {
                        if ($r->{$c->COLUMN_NAME} == 1) echo 'Si';
                        if ($r->{$c->COLUMN_NAME} == 0) echo 'No';
                        if ($r->{$c->COLUMN_NAME} == 2) echo 'IN CORSO';
                    } ?>
                    <?php if ($c->COLUMN_NAME == 'Note' && ($r->{$c->COLUMN_NAME} != '')) { ?>
                        <button class="form-control btn-default"
                                onclick="nota('<?php echo $r->Id; ?>');">NOTA
                        </button> <?php } ?>
                    <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') { ?>
                        <div class="progress-bar-label" style="text-align: center"><label
                                style="font-weight: bold"><?php echo $r->{$c->COLUMN_NAME} . '%'; ?></label>
                        </div>
                        <div class="progress"
                             style="height: 7px;color: rgba(46, 204, 113,0.6);background-color: lightgray">
                            <div class="progress-bar" role="progressbar"
                                 style="width: <?php echo $r->{$c->COLUMN_NAME}; ?>%;"
                                 aria-valuenow="50"
                                 aria-valuemin="0" aria-valuemax="100"></div>
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
                        <button type="button" onclick="modifica(<?php echo $r->Id; ?>)"
                                class="form-control btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                 fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path
                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </button>
                        <button type="button" onclick="duplica(<?php echo $r->Id; ?>)"
                                class="form-control btn-warning">D
                        </button>
                        <button type="submit" name="elimina" value="<?php echo $r->Id; ?>"
                                class="form-control btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                 fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </form>

        <?php }

    }

    public function duplica_ajax($id)
    {
        $r = DB::select('SELECT * from pipeline where Id = ' . $id)[0];
        $column = DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N\'pipeline\'');
        $operatori = DB::select('select * from operatori');
        $prodotto = DB::select('select * from prodotto ORDER BY descrizione');
        $dipendenti = DB::select('select * from dipendente ORDER BY descrizione');
        $motivazione = DB::select('select * from motivazione ORDER BY descrizione');
        $segnalato = Segnalato::all();
        foreach ($column as $c) {
            if ($c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Id_Padre') { ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php if ($c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Inc_Canone_AS') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                            <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'Valore Vendita A/C'; ?>
                            <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone A/C'; ?>
                            <?php if ($c->COLUMN_NAME == 'Inc_Canone_AS') echo 'Incremento Canone A/S'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                            <b
                                style="color:red">*</b></label>
                        <?php if ($c->COLUMN_NAME != 'Note' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Motivazione' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Dipendente' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Tipo_Cliente') { ?>
                            <input
                                <?php if ($c->DATA_TYPE == 'varchar') echo 'onKeyUp="converti(\'' . $c->COLUMN_NAME . $r->Id . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" min="0" step="0.01" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" min="0" step="1" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                <?php if ($c->DATA_TYPE == 'date') echo 'style="width:100%" class="form-control" type="date" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                value="<?php echo $r->{$c->COLUMN_NAME}; ?>">
                        <?php } ?>
                        <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                            <select style="width:100%" class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <?php foreach ($operatori as $o) { ?>
                                    <option
                                        value="<?php echo $o->username; ?>" <?php if ($o->username == $r->{$c->COLUMN_NAME}) echo 'selected'; ?> >
                                        <?php echo $o->username; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                        <?php if ($c->COLUMN_NAME == 'Vinta') { ?>
                            <select style="width:100%" class="form-control duplica_vinta"
                                    onchange="check_vinta('duplica_vinta')"
                                    id="<?php echo $c->COLUMN_NAME . $r->Id ?>"
                                    name="<?php echo $c->COLUMN_NAME ?>">
                                <option <?php if ($r->{
                                    $c->COLUMN_NAME
                                    } == 2)
                                    echo 'selected' ?> value="2">IN CORSO
                                </option>
                                <option <?php if ($r->{
                                    $c->COLUMN_NAME
                                    } == 1)
                                    echo 'selected' ?> value="1">SI
                                </option>
                                <option <?php if ($r->{
                                    $c->COLUMN_NAME
                                    } == 0)
                                    echo 'selected' ?> value="0">NO
                                </option>
                            </select>
                        <?php } ?>

                        <?php if ($c->COLUMN_NAME == 'Tipo_Cliente') { ?>
                            <select style="width:100%" class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <option value="">Inserisci Valore...
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'OLD') echo 'selected'; ?> value="OLD">
                                    OLD
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'LEAD') echo 'selected'; ?> value="LEAD">
                                    LEAD
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'RIENTRO') echo 'selected'; ?>
                                    value="RIENTRO">
                                    RIENTRO
                                </option>
                            </select>
                        <?php } ?>
                        <?php if ($c->COLUMN_NAME == 'Categoria') { ?>
                            <select style="width:100%" class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <option value="">Inserisci Valore...
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'COMMERCIALISTA') echo 'selected'; ?>
                                    value="COMMERCIALISTA">
                                    COMMERCIALISTA
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'AZIENDA') echo 'selected'; ?>
                                    value="AZIENDA">
                                    AZIENDA
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'CONSULENTE DEL LAVORO') echo 'selected'; ?>
                                    value="CONSULENTE DEL LAVORO">
                                    CONSULENTE DEL LAVORO
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'ALTRO') echo 'selected'; ?> value="ALTRO">
                                    ALTRO
                                </option>
                            </select>
                        <?php } ?>

                        <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                            <select style="width:100%" class="form-control duplica_segnalato"
                                    onchange="check_segnalato('duplica_segnalato')"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <option value="">Inserisci Valore...
                                </option>
                                <?php foreach ($segnalato as $s) { ?>
                                    <option
                                        value="<?php echo $s->descrizione; ?>" <?php if ($r->{$c->COLUMN_NAME} == $s->descrizione) echo 'selected'; ?>>
                                        <?php echo $s->descrizione; ?></option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                        <?php if ($c->COLUMN_NAME == 'Motivazione') { ?>
                            <select style="width:100%"
                                    class="form-control duplica_motivazione" <?php if ($r->Vinta != 0) echo ' disabled="disabled"'; ?>
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <option value="">Inserisci Valore...
                                </option>
                                <?php foreach ($motivazione as $m) { ?>
                                    <option
                                        value="<?php echo $m->descrizione; ?>" <?php if ($r->{$c->COLUMN_NAME} == $m->descrizione) echo 'selected'; ?>>
                                        <?php echo $m->descrizione; ?></option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                        <?php if ($c->COLUMN_NAME == 'Prodotto') { ?>
                            <select style="width:100%" class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <option value="">Inserisci Valore...
                                </option>
                                <?php foreach ($prodotto as $s) { ?>
                                    <option
                                        value="<?php echo $s->descrizione; ?>" <?php if ($r->{$c->COLUMN_NAME} == $s->descrizione) echo 'selected'; ?> >
                                        <?php echo $s->descrizione; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        <?php } ?>

                        <?php if ($c->COLUMN_NAME == 'Dipendente') { ?>
                            <select style="width:100%" class="form-control duplica_dipendente"
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
                            <select style="width:100% " class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
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
                        <?php if ($c->COLUMN_NAME == 'Note') { ?>

                            <textarea rows="8" cols="100"
                                      onKeyUp="converti(<?php echo '\'' . $c->COLUMN_NAME . '\''; ?>)"
                                      class="form-control" type="text" id="<?php echo $c->COLUMN_NAME; ?>"
                                      name="<?php echo $c->COLUMN_NAME; ?>"><?php echo $r->{
                                $c->COLUMN_NAME
                                }; ?></textarea>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php }
    }

    public
    function modifica_ajax($id)
    {
        $dati = file_get_contents("php://input");
        $json = json_decode($dati);

        $r = DB::select('SELECT * from pipeline where Id = ' . $id)[0];
        $column = DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N\'pipeline\'');
        $operatori = DB::select('select * from operatori');
        $prodotto = DB::select('select * from prodotto ORDER BY descrizione');
        $dipendenti = DB::select('select * from dipendente ORDER BY descrizione');
        $motivazione = DB::select('select * from motivazione ORDER BY descrizione');
        $segnalato = Segnalato::all();
        foreach ($column as $c) {
            if ($c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Id_Padre') {
                ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <?php if ($c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Inc_Canone_AS') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                            <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'Valore Vendita A/C'; ?>
                            <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone A/C'; ?>
                            <?php if ($c->COLUMN_NAME == 'Inc_Canone_AS') echo 'Incremento Canone A/S'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                            <b
                                style="color:red">*</b></label>
                        <?php if ($c->COLUMN_NAME != 'Note' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Motivazione' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Dipendente' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Tipo_Cliente') { ?>
                            <input
                                <?php if ($c->DATA_TYPE == 'varchar') echo 'onKeyUp="converti(\'' . $c->COLUMN_NAME . $r->Id . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" min="0" step="0.01" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" min="0" step="1" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                <?php if ($c->DATA_TYPE == 'date') echo 'style="width:100%" class="form-control" type="date" id="' . $c->COLUMN_NAME . $r->Id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                value="<?php echo $r->{$c->COLUMN_NAME}; ?>">
                        <?php } ?>
                        <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                            <select style="width:100%" class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <?php foreach ($operatori as $o) { ?>
                                    <option
                                        value="<?php echo $o->username; ?>"
                                        <?php if ($o->username == $r->{$c->COLUMN_NAME}) echo 'selected'; ?> >
                                        <?php echo $o->username; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                        <?php if ($c->COLUMN_NAME == 'Vinta') { ?>
                            <select style="width:100% " class="form-control modifica_vinta"
                                    onchange="check_vinta('modifica_vinta')"
                                    id="<?php echo $c->COLUMN_NAME . $r->Id ?>"
                                    name="<?php echo $c->COLUMN_NAME ?>">
                                <option <?php if ($r->{
                                    $c->COLUMN_NAME
                                    } == 2)
                                    echo 'selected' ?> value="2">IN CORSO
                                </option>
                                <option <?php if ($r->{
                                    $c->COLUMN_NAME
                                    } == 1)
                                    echo 'selected' ?> value="1">SI
                                </option>
                                <option <?php if ($r->{
                                    $c->COLUMN_NAME
                                    } == 0)
                                    echo 'selected' ?> value="0">NO
                                </option>
                            </select>
                        <?php } ?>

                        <?php if ($c->COLUMN_NAME == 'Tipo_Cliente') { ?>
                            <select style="width:100%" class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <option value="">Inserisci Valore...
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'OLD') echo 'selected'; ?> value="OLD">
                                    OLD
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'LEAD') echo 'selected'; ?> value="LEAD">
                                    LEAD
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'RIENTRO') echo 'selected'; ?>
                                    value="RIENTRO">
                                    RIENTRO
                                </option>
                            </select>
                        <?php } ?>
                        <?php if ($c->COLUMN_NAME == 'Categoria') { ?>
                            <select style="width:100%" class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <option value="">Inserisci Valore...
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'COMMERCIALISTA') echo 'selected'; ?>
                                    value="COMMERCIALISTA">
                                    COMMERCIALISTA
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'AZIENDA') echo 'selected'; ?>
                                    value="AZIENDA">
                                    AZIENDA
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'CONSULENTE DEL LAVORO') echo 'selected'; ?>
                                    value="CONSULENTE DEL LAVORO">
                                    CONSULENTE DEL LAVORO
                                </option>
                                <option <?php if ($r->{$c->COLUMN_NAME} == 'ALTRO') echo 'selected'; ?> value="ALTRO">
                                    ALTRO
                                </option>
                            </select>
                        <?php } ?>

                        <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                            <select style="width:100%" class="form-control modifica_segnalato"
                                    onchange="check_segnalato('modifica_segnalato')"
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
                        <?php if ($c->COLUMN_NAME == 'Motivazione') { ?>
                            <select style="width:100%"
                                    class="form-control modifica_motivazione" <?php if ($r->Vinta != 0) echo ' disabled="disabled"'; ?>
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <option value="">Inserisci Valore...
                                </option>
                                <?php foreach ($motivazione as $m) { ?>
                                    <option
                                        value="<?php echo $m->descrizione; ?>"
                                        <?php if ($r->{$c->COLUMN_NAME} == $m->descrizione) echo 'selected'; ?> >
                                        <?php echo $m->descrizione; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                        <?php if ($c->COLUMN_NAME == 'Prodotto') { ?>
                            <select style="width:100% " class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
                                <option value="">Inserisci Valore...
                                </option>
                                <?php foreach ($prodotto as $s) { ?>
                                    <option
                                        value="<?php echo $s->descrizione; ?>"
                                        <?php if ($r->{$c->COLUMN_NAME} == $s->descrizione) echo 'selected'; ?> >
                                        <?php echo $s->descrizione; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        <?php } ?>

                        <?php if ($c->COLUMN_NAME == 'Dipendente') { ?>
                            <select style="width:100% " class="form-control modifica_dipendente"
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
                            <select style="width:100% " class="form-control"
                                    id="<?php echo $c->COLUMN_NAME; ?>"
                                    name="<?php echo $c->COLUMN_NAME; ?>">
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
                        <?php if ($c->COLUMN_NAME == 'Note') { ?>

                            <textarea rows="8" cols="100"
                                      onKeyUp="converti(<?php echo '\'' . $c->COLUMN_NAME . '\''; ?>)"
                                      class="form-control" type="text" id="<?php echo $c->COLUMN_NAME; ?>"
                                      name="<?php echo $c->COLUMN_NAME; ?>"><?php echo $r->{
                                $c->COLUMN_NAME
                                }; ?></textarea>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php }

    public
    function modifica_ajax_DISDETTA($id)
    {
        $dati = file_get_contents("php://input");
        $json = json_decode($dati);
        $motivazione = DB::select('select * from motivazione ORDER BY descrizione');
        $r = DB::select('SELECT * from disdette where Id = ' . $id)[0];
        $column = DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N\'disdette\'');
        $operatori = DB::select('select * from operatori');
        foreach ($column as $c) {
            if ($c->COLUMN_NAME != 'id') {
                ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <?php echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                            <b
                                style="color:red">*</b></label>
                        <?php if ($c->COLUMN_NAME != 'Esito' && $c->COLUMN_NAME != 'Motivazione' && $c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Note') { ?>
                            <input
                                <?php if ($c->DATA_TYPE == 'varchar') echo 'onKeyUp="converti(\'' . $c->COLUMN_NAME . $r->id . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . $r->id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" min="0" step="0.01" id="' . $c->COLUMN_NAME . $r->id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" min="0" step="1" id="' . $c->COLUMN_NAME . $r->id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                <?php if ($c->DATA_TYPE == 'date') echo 'style="width:100%" class="form-control" type="date" id="' . $c->COLUMN_NAME . $r->id . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                value="<?php echo $r->{$c->COLUMN_NAME}; ?>">
                        <?php } else { ?>
                            <?php if ($c->COLUMN_NAME == 'Esito') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME; ?>"
                                        name="<?php echo $c->COLUMN_NAME; ?>">
                                    <option value="undefined">Nessun Esito...
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 2) echo 'selected'; ?> value="2">IN CORSO
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 1) echo 'selected'; ?> value="1">VINTA
                                    </option>
                                    <option <?php if ($r->{$c->COLUMN_NAME} == 0) echo 'selected'; ?> value="0">PERSA
                                    </option>
                                </select>
                            <?php } ?>
                            <?php if ($c->COLUMN_NAME == 'Motivazione') { ?>
                                <select style="width:100%"
                                        class="form-control"
                                        id="<?php echo $c->COLUMN_NAME; ?>"
                                        name="<?php echo $c->COLUMN_NAME; ?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <?php foreach ($motivazione as $m) { ?>
                                        <option
                                            value="<?php echo $m->descrizione; ?>"
                                            <?php if ($r->{$c->COLUMN_NAME} == $m->descrizione) echo 'selected'; ?> >
                                            <?php echo $m->descrizione; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                            <?php if ($c->COLUMN_NAME == 'Note') { ?>

                                <textarea rows="8" cols="100"
                                          onKeyUp="converti(<?php echo '\'' . $c->COLUMN_NAME . '\''; ?>)"
                                          class="form-control" type="text" id="<?php echo $c->COLUMN_NAME; ?>"
                                          name="<?php echo $c->COLUMN_NAME; ?>"><?php echo $r->{
                                    $c->COLUMN_NAME
                                    }; ?></textarea>
                            <?php } ?>
                            <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                                <select style="width:100%" class="form-control"
                                        id="<?php echo $c->COLUMN_NAME; ?>"
                                        name="<?php echo $c->COLUMN_NAME; ?>">
                                    <?php foreach ($operatori as $o) { ?>
                                        <option
                                            value="<?php echo $o->username; ?>" <?php if ($o->username == $r->{$c->COLUMN_NAME}) echo 'selected'; ?> >
                                            <?php echo $o->username; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            <?php } ?>


                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php }
}
