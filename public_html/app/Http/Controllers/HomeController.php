<?php

namespace App\Http\Controllers;

use App\Models\Segnalato;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**<
 * Controller principale della pipeline
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    public function primapagina(Request $request)
    {
        return Redirect::to('statistiche');
    }

    public function disdette(Request $request)
    {
        $dati = $request->all();

        if (isset($dati['aggiungi'])) {
            if (isset($dati['_token'])) unset($dati['_token']);
            if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
            $id = DB::table('disdette')->insertGetId($dati);
            $mail_send = 'Salve <br>
            è stata inserita la <strong>DISDETTA</strong> ' . $id . '
            <br><br> SALES : ' . $dati['Sales'] . '
            <br> RAGIONE SOCIALE : ' . $dati['Ragione_Sociale'] . '
            <br> PRODOTTO : ' . $dati['Prodotto'] . '
            <br> DATA DISDETTA : ' . date('d-m-Y', strtotime($dati['Data_Disdetta'])) . '
            <br> VALORE : ' . number_format($dati['Valore_Contratto'], 2, ',', '.') . ' €
            <br> Motivazione : ' . $dati['Motivazione'] . '
            <br>
            <br> Grazie
            <br> Promedya SRL
            <br> Team Smart Sales Force';
            $mail = new  PHPMailer();
            $mail->isSMTP();
            $mail->CharSet = 'utf-8';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'posta.promedya.it';
            $mail->Port = '465';
            $mail->Username = 'hd.sviluppo@promedya.it';
            $mail->Password = '!!promedya@@2023';
            $mail->setFrom('commerciale@promedya.it');
            $mail->addBCC('umberto.limone@promedya.it');
            $mail->addBCC('alessandro.aniello@promedya.it');
            $mail->addBCC('dino.fioretti@promedya.it');
            $mail->addBCC('francesco.napolitano@promedya.it');
            $mail->addBCC('daniela.dellacorte@promedya.it');
            $mail->addBCC('giovanni.tutino@promedya.it');
            $mail->addBCC('giuseppe.manuguerra@wolterskluwer.com');
            $mail->addBCC('generoso.pelosi@promedya.it');
            $mail->addBCC('lorenzo.cassese@promedya.it');
            $mail->addAddress('promedya.srl@gmail.com');
            $mail->IsHTML(true);
            $mail->Subject = 'PROMEDYA SRL - Smart Sales Force | DISDETTA';
            $mail->Body = '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">' . $mail_send . '</span>';
            $send = DB::SELECT('SELECT valore from mail')[0]->valore;
            if ($send == 1) $mail->send();
            return Redirect::to('disdette');
        }
        if (isset($dati['duplica'])) {
            if (isset($dati['_token'])) unset($dati['_token']);
            if (isset($dati['duplica'])) unset($dati['duplica']);
            if (isset($dati['Id'])) unset($dati['Id']);
            if (isset($dati['Id_Padre'])) unset($dati['Id_Padre']);
            $id = DB::table('disdette')->insertGetId($dati);
            return Redirect::to('disdette');
        }
        if (isset($dati['elimina'])) {
            DB::table('disdette')->delete($dati['elimina']);
            return Redirect::to('disdette');
        }
        if (isset($dati['modifica'])) {
            if (isset($dati['_token'])) unset($dati['_token']);
            if (isset($dati['modifica'])) unset($dati['modifica']);
            if (isset($dati['Id'])) {
                $id = $dati['Id'];
                unset($dati['Id']);
            }
            DB::table('disdette')->where(['Id' => $id])->update($dati);
            return Redirect::to('disdette');

        }
        if (session()->has('utente')) {
            $utente = session('utente');
            $column = DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N\'disdette\'');
            if (isset($dati['filtra'])) {
                $dati = array_filter($dati, static function ($var) {
                    return $var !== null;
                });
                foreach ($column as $c) {
                    if ($c->COLUMN_NAME != 'Id' && $c->DATA_TYPE != 'date') {
                        if (isset($dati[$c->COLUMN_NAME]) && ($dati[$c->COLUMN_NAME] == 'Nessun Filtro...' || $dati[$c->COLUMN_NAME] == '' || $dati[$c->COLUMN_NAME] == 'undefined' || $dati[$c->COLUMN_NAME] == null)) {
                            unset($dati[$c->COLUMN_NAME]);
                        }
                    }
                }
                $where = [];
                $prodotti = '';
                $search = 0;
                if ($dati['gruppo_prodotto'] == 'undefined') unset($dati['gruppo_prodotto']); else {
                    $prodotti = $dati['gruppo_prodotto'];
                    if ($search == 2) $search = 3; else $search = 1;
                    unset($dati['gruppo_prodotto']);
                }
                if ($dati['Sales_GRUPPO'] == 'undefined' || $dati['Sales_GRUPPO'] == 'Nessun Filtro...') unset($dati['Sales_GRUPPO']); else {
                    $sales = $dati['Sales_GRUPPO'];
                    if ($search == 1) $search = 3; else $search = 2;
                    unset($dati['Sales_GRUPPO']);
                }
                if (isset($dati['Data_contatto_i'])) {
                    $new_filter = ['column' => 'Data_Contatto', 'operator' => '>=', 'value' => $dati['Data_contatto_i']];
                    array_push($where, $new_filter);
                    unset($dati['Data_contatto_i']);
                }
                if (isset($dati['Data_contatto_f'])) {
                    $new_filter = ['column' => 'Data_Contatto', 'operator' => '<=', 'value' => $dati['Data_contatto_f']];
                    array_push($where, $new_filter);
                    unset($dati['Data_contatto_f']);
                }
                if (isset($dati['Data_Disdetta_i'])) {
                    $new_filter = ['column' => 'Data_Disdetta', 'operator' => '>=', 'value' => $dati['Data_Disdetta_i']];
                    array_push($where, $new_filter);
                    unset($dati['Data_Disdetta_i']);
                }
                if (isset($dati['Data_Disdetta_f'])) {
                    $new_filter = ['column' => 'Data_Disdetta', 'operator' => '<=', 'value' => $dati['Data_Disdetta_f']];
                    array_push($where, $new_filter);
                    unset($dati['Data_Disdetta_f']);
                }
                if (isset($dati['Data_Chiusura_i'])) {
                    $new_filter = ['column' => 'Data_Chiusura', 'operator' => '>=', 'value' => $dati['Data_Chiusura_i']];
                    array_push($where, $new_filter);
                    unset($dati['Data_Chiusura_i']);
                }
                if (isset($dati['Data_Chiusura_f'])) {
                    $new_filter = ['column' => 'Data_Chiusura', 'operator' => '<=', 'value' => $dati['Data_Chiusura_f']];
                    array_push($where, $new_filter);
                    unset($dati['Data_Chiusura_f']);
                }
                if (isset($dati['Ragione_Sociale'])) {
                    $new_filter = ['column' => 'Ragione_Sociale', 'operator' => 'like', 'value' => '%' . $dati['Ragione_Sociale'] . '%'];
                    array_push($where, $new_filter);
                    unset($dati['Ragione_Sociale']);
                }
                unset($dati['_token']);
                unset($dati['filtra']);
                if ($search == 0)
                    $rows = DB::TABLE('disdette')->select(DB::raw('*'))->where($dati)->where($where)->orderBy('Id', 'desc')->get();
                if ($search == 1)
                    $rows = DB::TABLE('disdette')->select(DB::raw('*'))->where($dati)->where($where)->whereIn('Prodotto', explode(',', $prodotti))->orderBy('Id', 'desc')->get();
                if ($search == 2)
                    $rows = DB::TABLE('disdette')->select(DB::raw('pipeline.*'))->leftJoin('operatori', 'pipeline.sales', '=', 'operatori.username')->where($dati)->where($where)->where('operatori.gruppo', '=', $sales)->orderBy('pipeline.Id', 'desc')->get();
                if ($search == 3)
                    $rows = DB::TABLE('disdette')->select(DB::raw('pipeline.*'))->leftJoin('operatori', 'pipeline.sales', '=', 'operatori.username')->where($dati)->where($where)->whereIn('Prodotto', explode(',', $prodotti))->where('operatori.gruppo', '=', $sales)->orderBy('pipeline.Id', 'desc')->get();
                $operatori = DB::select('select * from operatori');
                $motivazione = DB::select('select * from motivazione ORDER BY descrizione');
                $clienti = DB::select('select Ragione_Sociale from pipeline group by Ragione_Sociale order by Ragione_Sociale ASC');
                $prodotto = DB::select('select * from prodotto ORDER BY descrizione');
                $gruppo = DB::select('SELECT p.gruppo ,GROUP_CONCAT(p.descrizione) as prodotti FROM prodotto p GROUP BY p.gruppo ');
                $zone = DB::SELECT('SELECT gruppo as descrizione from operatori WHERE gruppo is not null group by gruppo');
                $dipendenti = DB::select('select * from dipendente ORDER BY descrizione');
                $segnalato = Segnalato::all();
                return View::make('disdette', compact('utente', 'segnalato', 'zone', 'motivazione', 'prodotto', 'dipendenti', 'rows', 'operatori', 'column', 'clienti', 'gruppo'));
            }
            $rows = DB::select('select * from disdette order by DATE_FORMAT(Data_Disdetta, \'%Y\') desc,DATE_FORMAT(Data_Disdetta, \'%m\') desc,DATE_FORMAT(Data_Disdetta, \'%d\') desc');
            $operatori = DB::select('select * from operatori');
            $dipendenti = DB::select('select * from dipendente ORDER BY descrizione');
            $prodotto = DB::select('select * from prodotto ORDER BY descrizione');
            $motivazione = DB::select('select * from motivazione ORDER BY descrizione');
            $segnalato = Segnalato::all();
            $zone = DB::SELECT('SELECT gruppo as descrizione from operatori WHERE gruppo is not null group by gruppo');
            $gruppo = DB::select('SELECT p.gruppo ,GROUP_CONCAT(p.descrizione)  as prodotti FROM prodotto p GROUP BY p.gruppo ');
            $clienti = DB::select('select Ragione_Sociale from pipeline group by Ragione_Sociale order by Ragione_Sociale ASC');
            return View::make('disdette', compact('utente', 'rows', 'zone', 'motivazione', 'prodotto', 'dipendenti', 'operatori', 'segnalato', 'column', 'clienti', 'gruppo'));
        } else {
            return Redirect::to('login');
        }
    }

    public function pipeline(Request $request)
    {
        $dati = $request->all();

        if (isset($dati['aggiungi'])) {
            if (isset($dati['_token'])) unset($dati['_token']);
            if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
            $id = DB::table('pipeline')->insertGetId($dati);
            DB::select('UPDATE pipeline SET id_padre = ' . $id . ' where id = ' . $id);
            if ($dati['Vinta'] == 1 || $dati['Vinta'] == 2) {
                $motivazione = '';
                if ($dati['Vinta'] == 2) $result = 'vinta'; else $result = 'persa';
                if ($dati['Vinta'] != 2) $motivazione = '<br> MOTIVAZIONE : ' . $dati['Motivazione'];
                $mail_send = 'Salve <br> la <strong>LEAD</strong> ' . $id . ' è stata <strong>' . strtoupper($result) . '</strong>.<br> <br> SALES : ' . $dati['Sales'] . '<br> RAGIONE SOCIALE : ' . $dati['Ragione_Sociale'] . '<br>TIPO : ' . $dati['Tipo_Cliente'] . '<br> CATEGORIA : ' . $dati['Categoria'] . '<br> PRODOTTO : ' . $dati['Prodotto'] . '<br> DATA CONTATTO : ' . date('d-m-Y', strtotime($dati['Data_contatto'])) . '<br> DATA CHIUSURA : ' . date('d-m-Y', strtotime($dati['Data_Probabile_Chiusura'])) . '<br> VALORE : ' . number_format($dati['Val_Ven_AC'], 2, ',', '.') . ' € ' . $motivazione . '.<br><br> Grazie <br> Promedya SRL <br> Team Smart Sales Force';
                $mail = new  PHPMailer();
                $mail->isSMTP();
                $mail->CharSet = 'utf-8';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'posta.promedya.it';
                $mail->Port = '465';
                $mail->Username = 'hd.sviluppo@promedya.it';
                $mail->Password = '!!promedya@@2023';
                $mail->setFrom('commerciale@promedya.it');
                $mail->addBCC('umberto.limone@promedya.it');
                $mail->addBCC('alessandro.aniello@promedya.it');
                $mail->addBCC('dino.fioretti@promedya.it');
                $mail->addBCC('francesco.napolitano@promedya.it');
                $mail->addBCC('daniela.dellacorte@promedya.it');
                $mail->addBCC('giovanni.tutino@promedya.it');
                $mail->addBCC('giuseppe.manuguerra@wolterskluwer.com');
                $mail->addBCC('generoso.pelosi@promedya.it');
                $mail->addBCC('lorenzo.cassese@promedya.it');
                $mail->addAddress('promedya.srl@gmail.com');
                $mail->IsHTML(true);
                $mail->Subject = 'PROMEDYA SRL - Smart Sales Force | VENDITA';
                $mail->Body = '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">' . $mail_send . '</span>';
                $send = DB::SELECT('SELECT valore from mail')[0]->valore;
                if ($send == 1) $mail->send();
            }

            return Redirect::to('pipeline');
        }
        if (isset($dati['duplica'])) {
            if (isset($dati['_token'])) unset($dati['_token']);
            if (isset($dati['duplica'])) unset($dati['duplica']);
            if (isset($dati['Id'])) unset($dati['Id']);
            $id = DB::table('pipeline')->insertGetId($dati);
            DB::select('UPDATE pipeline SET id = ' . $id . ' where id = ' . $id);
            if ($dati['Vinta'] == 1 || $dati['Vinta'] == 2) {
                $motivazione = '';
                if ($dati['Vinta'] == 2) $result = 'vinta'; else $result = 'persa';
                if ($dati['Vinta'] != 2) $motivazione = '<br> MOTIVAZIONE : ' . $dati['Motivazione'];
                $mail_send = 'Salve <br> la <strong>LEAD</strong> ' . $id . ' è stata <strong>' . strtoupper($result) . '</strong>.<br> <br> SALES : ' . $dati['Sales'] . '<br> RAGIONE SOCIALE : ' . $dati['Ragione_Sociale'] . '<br>TIPO : ' . $dati['Tipo_Cliente'] . '<br> CATEGORIA : ' . $dati['Categoria'] . '<br> PRODOTTO : ' . $dati['Prodotto'] . '<br> DATA CONTATTO : ' . date('d-m-Y', strtotime($dati['Data_contatto'])) . '<br> DATA CHIUSURA : ' . date('d-m-Y', strtotime($dati['Data_Probabile_Chiusura'])) . '<br> VALORE : ' . number_format($dati['Val_Ven_AC'], 2, ',', '.') . ' € ' . $motivazione . '.<br><br> Grazie <br> Promedya SRL <br> Team Smart Sales Force';
                $mail = new  PHPMailer();
                $mail->isSMTP();
                $mail->CharSet = 'utf-8';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'posta.promedya.it';
                $mail->Port = '465';
                $mail->Username = 'hd.sviluppo@promedya.it';
                $mail->Password = '!!promedya@@2023';
                $mail->setFrom('commerciale@promedya.it');
                $mail->addBCC('umberto.limone@promedya.it');
                $mail->addBCC('alessandro.aniello@promedya.it');
                $mail->addBCC('francesco.napolitano@promedya.it');
                $mail->addBCC('lorenzo.cassese@promedya.it');
                $mail->addBCC('daniela.dellacorte@promedya.it');
                $mail->addBCC('giovanni.tutino@promedya.it');
                $mail->addBCC('giuseppe.manuguerra@wolterskluwer.com');
                $mail->addBCC('generoso.pelosi@promedya.it');
                $mail->addAddress('promedya.srl@gmail.com');
                $mail->IsHTML(true);
                $mail->Subject = 'PROMEDYA SRL - Smart Sales Force';
                $mail->Body = '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">' . $mail_send . '</span>';
                $send = DB::SELECT('SELECT valore from mail')[0]->valore;
                if ($send == 1) $mail->send();
            }

            return Redirect::to('pipeline');
        }
        if (isset($dati['elimina'])) {
            DB::table('pipeline')->delete($dati['elimina']);
            return Redirect::to('pipeline');
        }
        if (isset($dati['modifica'])) {
            if (isset($dati['_token'])) unset($dati['_token']);
            if (isset($dati['modifica'])) unset($dati['modifica']);
            if (isset($dati['Id'])) {
                $id = $dati['Id'];
                unset($dati['Id']);
            }
            DB::table('pipeline')->where(['Id' => $id])->update($dati);
            if (isset($dati['Vinta'])) {
                if ($dati['Vinta'] == 1 || $dati['Vinta'] == 2) {
                    $motivazione = '';
                    if ($dati['Vinta'] == 2) $result = 'vinta'; else $result = 'persa';
                    if ($dati['Vinta'] != 2) $motivazione = '<br> MOTIVAZIONE : ' . $dati['Motivazione'];
                    $mail_send = 'Salve <br> la <strong>LEAD</strong> ' . $id . ' è stata <strong>' . strtoupper($result) . '</strong>.<br> <br> SALES : ' . $dati['Sales'] . '<br> RAGIONE SOCIALE : ' . $dati['Ragione_Sociale'] . '<br>TIPO : ' . $dati['Tipo_Cliente'] . '<br> CATEGORIA : ' . $dati['Categoria'] . '<br> PRODOTTO : ' . $dati['Prodotto'] . '<br> DATA CONTATTO : ' . date('d-m-Y', strtotime($dati['Data_contatto'])) . '<br> DATA CHIUSURA : ' . date('d-m-Y', strtotime($dati['Data_Probabile_Chiusura'])) . '<br> VALORE : ' . number_format($dati['Val_Ven_AC'], 2, ',', '.') . ' € ' . $motivazione . '.<br><br> Grazie <br> Promedya SRL <br> Team Smart Sales Force';
                    $mail = new  PHPMailer();
                    $mail->isSMTP();
                    $mail->CharSet = 'utf-8';
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'posta.promedya.it';
                    $mail->Port = '465';
                    $mail->Username = 'hd.sviluppo@promedya.it';
                    $mail->Password = '!!promedya@@2023';
                    $mail->setFrom('commerciale@promedya.it');
                    $mail->addBCC('umberto.limone@promedya.it');
                    $mail->addBCC('alessandro.aniello@promedya.it');
                    $mail->addBCC('dino.fioretti@promedya.it');
                    $mail->addBCC('francesco.napolitano@promedya.it');
                    $mail->addBCC('daniela.dellacorte@promedya.it');
                    $mail->addBCC('giovanni.tutino@promedya.it');
                    $mail->addBCC('giuseppe.manuguerra@wolterskluwer.com');
                    $mail->addBCC('generoso.pelosi@promedya.it');
                    $mail->addAddress('promedya.srl@gmail.com');
                    $mail->addBCC('lorenzo.cassese@promedya.it');
                    $mail->IsHTML(true);
                    $mail->Subject = 'PROMEDYA SRL - Smart Sales Force';
                    $mail->Body = '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">' . $mail_send . '</span>';
                    $send = DB::SELECT('SELECT valore from mail')[0]->valore;
                    if ($send == 1) $mail->send();
                }
            }
            return Redirect::to('pipeline');

        }
        if (session()->has('utente')) {
            $utente = session('utente');
            $column = DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N\'pipeline\'');
            if (isset($dati['filtra'])) {
                $dati = array_filter($dati, static function ($var) {
                    return $var !== null;
                });
                foreach ($column as $c) {
                    if ($c->COLUMN_NAME != 'Id' && $c->DATA_TYPE != 'date') {
                        if (isset($dati[$c->COLUMN_NAME]) && ($dati[$c->COLUMN_NAME] == 'Nessun Filtro...' || $dati[$c->COLUMN_NAME] == '' || $dati[$c->COLUMN_NAME] == 'undefined' || $dati[$c->COLUMN_NAME] == null)) {
                            unset($dati[$c->COLUMN_NAME]);
                        }
                    }
                }
                $where = [];
                $prodotti = '';
                $search = 0;
                if ($dati['gruppo_prodotto'] == 'undefined') unset($dati['gruppo_prodotto']); else {
                    $prodotti = $dati['gruppo_prodotto'];
                    if ($search == 2) $search = 3; else $search = 1;
                    unset($dati['gruppo_prodotto']);
                }
                if ($dati['Sales_GRUPPO'] == 'undefined' || $dati['Sales_GRUPPO'] == 'Nessun Filtro...') unset($dati['Sales_GRUPPO']); else {
                    $sales = $dati['Sales_GRUPPO'];
                    if ($search == 1) $search = 3; else $search = 2;
                    unset($dati['Sales_GRUPPO']);
                }
                if (isset($dati['Data_contatto_i'])) {
                    $new_filter = ['column' => 'Data_Contatto', 'operator' => '>=', 'value' => $dati['Data_contatto_i']];
                    array_push($where, $new_filter);
                    unset($dati['Data_contatto_i']);
                }
                if (isset($dati['Data_contatto_f'])) {
                    $new_filter = ['column' => 'Data_Contatto', 'operator' => '<=', 'value' => $dati['Data_contatto_f']];
                    array_push($where, $new_filter);
                    unset($dati['Data_contatto_f']);
                }
                if (isset($dati['Data_Probabile_Chiusura_i'])) {
                    $new_filter = ['column' => 'Data_Probabile_Chiusura', 'operator' => '>=', 'value' => $dati['Data_Probabile_Chiusura_i']];
                    array_push($where, $new_filter);
                    unset($dati['Data_Probabile_Chiusura_i']);
                }
                if (isset($dati['Data_Probabile_Chiusura_f'])) {
                    $new_filter = ['column' => 'Data_Probabile_Chiusura', 'operator' => '<=', 'value' => $dati['Data_Probabile_Chiusura_f']];
                    array_push($where, $new_filter);
                    unset($dati['Data_Probabile_Chiusura_f']);
                }
                if (isset($dati['Ragione_Sociale'])) {
                    $new_filter = ['column' => 'Ragione_Sociale', 'operator' => 'like', 'value' => '%' . $dati['Ragione_Sociale'] . '%'];
                    array_push($where, $new_filter);
                    unset($dati['Ragione_Sociale']);
                }
                unset($dati['_token']);
                unset($dati['filtra']);
                if ($search == 0)
                    $rows = DB::TABLE('pipeline')->select(DB::raw('*'))->where($dati)->where($where)->orderBy('Id', 'desc')->get();
                if ($search == 1)
                    $rows = DB::TABLE('pipeline')->select(DB::raw('*'))->where($dati)->where($where)->whereIn('Prodotto', explode(',', $prodotti))->orderBy('Id', 'desc')->get();
                if ($search == 2)
                    $rows = DB::TABLE('pipeline')->select(DB::raw('pipeline.*'))->leftJoin('operatori', 'pipeline.sales', '=', 'operatori.username')->where($dati)->where($where)->where('operatori.gruppo', '=', $sales)->orderBy('pipeline.Id', 'desc')->get();
                if ($search == 3)
                    $rows = DB::TABLE('pipeline')->select(DB::raw('pipeline.*'))->leftJoin('operatori', 'pipeline.sales', '=', 'operatori.username')->where($dati)->where($where)->whereIn('Prodotto', explode(',', $prodotti))->where('operatori.gruppo', '=', $sales)->orderBy('pipeline.Id', 'desc')->get();
                $operatori = DB::select('select * from operatori');
                $motivazione = DB::select('select * from motivazione ORDER BY descrizione');
                $clienti = DB::select('select Ragione_Sociale from pipeline group by Ragione_Sociale order by Ragione_Sociale ASC');
                $prodotto = DB::select('select * from prodotto ORDER BY descrizione');
                $gruppo = DB::select('SELECT p.gruppo ,GROUP_CONCAT(p.descrizione) as prodotti FROM prodotto p GROUP BY p.gruppo ');
                $zone = DB::SELECT('SELECT gruppo as descrizione from operatori WHERE gruppo is not null group by gruppo');
                $dipendenti = DB::select('select * from dipendente ORDER BY descrizione');
                $esito_trattativa = DB::select('select * from esito_trattativa ORDER BY descrizione');
                $segnalato = Segnalato::all();
                $categoria = DB::select('select * from categoria ORDER BY id');
                return View::make('rows', compact('utente', 'segnalato', 'esito_trattativa', 'categoria', 'zone', 'motivazione', 'prodotto', 'dipendenti', 'rows', 'operatori', 'column', 'clienti', 'gruppo'));
            }
            $rows = DB::select('select * from pipeline order by Id desc');
            $operatori = DB::select('select * from operatori');
            $dipendenti = DB::select('select * from dipendente ORDER BY descrizione');
            $prodotto = DB::select('select * from prodotto ORDER BY descrizione');
            $motivazione = DB::select('select * from motivazione ORDER BY descrizione');
            $esito_trattativa = DB::select('select * from esito_trattativa ORDER BY descrizione');
            $categoria = DB::select('select * from categoria ORDER BY id');
            $segnalato = Segnalato::all();
            $zone = DB::SELECT('SELECT gruppo as descrizione from operatori WHERE gruppo is not null group by gruppo');
            $gruppo = DB::select('SELECT p.gruppo ,GROUP_CONCAT(p.descrizione)  as prodotti FROM prodotto p GROUP BY p.gruppo ');
            $clienti = DB::select('select Ragione_Sociale from pipeline group by Ragione_Sociale order by Ragione_Sociale ASC');
            return View::make('rows', compact('utente', 'esito_trattativa', 'rows', 'zone', 'categoria', 'motivazione', 'prodotto', 'dipendenti', 'operatori', 'segnalato', 'column', 'clienti', 'gruppo'));
        } else {
            return Redirect::to('login');
        }
    }

    public function concessionario(Request $request)
    {

        $dati = $request->all();

        if (isset($dati['aggiungi'])) {
            if (isset($dati['_token'])) unset($dati['_token']);
            if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
            DB::table('pipeline_concessionario')->insert($dati);
            return Redirect::to('concessionario');
        }
        if (isset($dati['elimina'])) {
            DB::table('pipeline_concessionario')->delete($dati['elimina']);
            return Redirect::to('concessionario');
        }
        if (isset($dati['modifica'])) {
            if (isset($dati['_token'])) unset($dati['_token']);
            if (isset($dati['modifica'])) unset($dati['modifica']);
            if (isset($dati['Id'])) {
                $id = $dati['Id'];
                unset($dati['Id']);
            }
            DB::table('pipeline_concessionario')->where(['Id' => $id])->update($dati);
            return Redirect::to('concessionario');

        }
        if (session()->has('utente')) {
            $utente = session('utente');
            $column = DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N\'pipeline_concessionario\'');
            if (isset($dati['filtra'])) {
                foreach ($column as $c) {
                    if ($c->COLUMN_NAME != 'Id' && $c->DATA_TYPE != 'date') {
                        if ($dati[$c->COLUMN_NAME] == null) {
                            unset($dati[$c->COLUMN_NAME]);
                        }
                        if (isset($dati[$c->COLUMN_NAME]) && ($dati[$c->COLUMN_NAME] == 'Nessun Filtro...' || $dati[$c->COLUMN_NAME] == '' || $dati[$c->COLUMN_NAME] == 'undefined' || $dati[$c->COLUMN_NAME] == null)) {
                            unset($dati[$c->COLUMN_NAME]);
                        }
                    }
                }
                $where = [];
                if ($dati['Data_i'] == null) unset($dati['Data_i']); else {
                    $new_filter = ['column' => 'Data', 'operator' => '>=', 'value' => $dati['Data_i']];
                    array_push($where, $new_filter);
                    unset($dati['Data_i']);
                }
                if ($dati['Data_f'] == null) unset($dati['Data_f']); else {
                    $new_filter = ['column' => 'Data', 'operator' => '<=', 'value' => $dati['Data_f']];
                    array_push($where, $new_filter);
                    unset($dati['Data_f']);
                }
                unset($dati['_token']);
                unset($dati['filtra']);
                $rows = DB::TABLE('pipeline_concessionario')->select(DB::raw('*'))->where($dati)->where($where)->orderBy('Id', 'desc')->get();
                $operatori = DB::select('select * from operatori');
                $dipendenti = DB::select('select * from dipendente');
                $segnalato = Segnalato::all();
                return View::make('concessionario', compact('utente', 'dipendenti', 'rows', 'operatori', 'segnalato', 'column'));
            }
            $rows = DB::select('select * from pipeline_concessionario order by Id desc');
            $dipendenti = DB::select('select * from dipendente');
            $operatori = DB::select('select * from operatori');
            $prodotto = DB::select('select * from prodotto');
            $segnalato = Segnalato::all();
            $dipendenti = DB::select('select * from dipendente ORDER BY descrizione');
            return View::make('concessionario', compact('prodotto', 'utente', 'dipendenti', 'dipendenti', 'rows', 'operatori', 'segnalato', 'column'));
        } else {
            return Redirect::to('login');
        }
    }

    public function budget(Request $request)
    {
        $dati = $request->all();
        for ($i = 1; $i < 13; $i++) {
            if (isset($dati['budget_' . $i])) {
                if (strlen($i) == 1) {
                    $y = '0' . $i;
                } else {
                    $y = $i;
                }
                DB::select('UPDATE budget set budget = ' . $dati['budget_' . $i] . ' WHERE data_mese = \'2024-' . $y . '-01\' ');
                return Redirect::to('budget');
            }
        }
        if (session()->has('utente')) {
            $utente = session('utente');
            $vendite_annuale = DB::SELECT('SELECT Coalesce(SUM(Vendita_Budget),0) as Vendite FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'20241231\' and Data_Probabile_Chiusura >= \'20240101\' ')[0]->Vendite;
            $vendite_mensili = DB::SELECT('SELECT MONTH(Data_Probabile_Chiusura) AS Mese,Coalesce(SUM(Vendita_Budget),0) as Vendite FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'20241231\' and Data_Probabile_Chiusura >= \'20240101\' group by MONTH(Data_Probabile_Chiusura)');

            $budget = DB::SELECT('SELECT MONTH(data_mese) as data_mese,budget FROM budget where data_mese <= \'20241231\' and data_mese >= \'20240101\' ');

            $budget_annuale = DB::select('SELECT SUM(budget) as valore from budget where data_mese <= \'20241231\' and data_mese >= \'20240101\' ')[0]->valore;

            $budget_t3 = DB::select(' SELECT SUM(budget) as valore from budget where data_mese < \'20240331\' and data_mese >= \'20240101\' ')[0]->valore;
            $budget_t6 = DB::select(' SELECT SUM(budget) as valore from budget where data_mese < \'20240631\' and data_mese >= \'20240401\' ')[0]->valore;
            $budget_t9 = DB::select(' SELECT SUM(budget) as valore from budget where data_mese < \'20240931\' and data_mese >= \'20240701\' ')[0]->valore;
            $budget_t12 = DB::select('SELECT SUM(budget) as valore from budget where data_mese < \'20241231\' and data_mese >= \'20241001\' ')[0]->valore;

            $vendite_annuale = DB::SELECT('SELECT Coalesce(SUM(Vendita_Budget),0) as Vendite FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'20241231\' and Data_Probabile_Chiusura >= \'20240101\' ')[0]->Vendite;

            $vendite_t3 = DB::SELECT(' SELECT Coalesce(SUM(Vendita_Budget),0) as Vendite FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'20240331\' and Data_Probabile_Chiusura >= \'20240101\' ')[0]->Vendite;
            $vendite_t6 = DB::SELECT(' SELECT Coalesce(SUM(Vendita_Budget),0) as Vendite FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'20240631\' and Data_Probabile_Chiusura >= \'20240401\' ')[0]->Vendite;
            $vendite_t9 = DB::SELECT(' SELECT Coalesce(SUM(Vendita_Budget),0) as Vendite FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'20240931\' and Data_Probabile_Chiusura >= \'20240701\' ')[0]->Vendite;
            $vendite_t12 = DB::SELECT('SELECT Coalesce(SUM(Vendita_Budget),0) as Vendite FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'20241231\' and Data_Probabile_Chiusura >= \'20241001\' ')[0]->Vendite;

            $differenze_t3 = $vendite_t3 - $budget_t3;
            $differenze_t6 = $vendite_t6 - $budget_t6;
            $differenze_t9 = $vendite_t9 - $budget_t9;
            $differenze_t12 = $vendite_t12 - $budget_t12;

            return View::make('budget', compact('utente', 'vendite_annuale', 'vendite_mensili', 'budget', 'budget_annuale'
                , 'budget_t3', 'vendite_t3', 'differenze_t3'
                , 'budget_t6', 'vendite_t6', 'differenze_t6'
                , 'budget_t9', 'vendite_t9', 'differenze_t9'
                , 'budget_t12', 'vendite_t12', 'differenze_t12'));
        } else {
            return Redirect::to('login');
        }
    }

    public function work(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            $utente = session('utente');

            return View::make('work', compact('utente'));
        } else {
            return Redirect::to('login');
        }
    }

    public function categoria(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            if (isset($dati['modifica'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['modifica'])) unset($dati['modifica']);
                if (isset($dati['id'])) {
                    $id = $dati['id'];
                    unset($dati['id']);
                    DB::table('categoria')->where(['id' => $id])->update($dati);
                }
                return Redirect::to('categoria');
            }
            if (isset($dati['elimina'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['elimina'])) {
                    DB::table('categoria')->where(['id' => $dati['elimina']])->delete();
                }
                return Redirect::to('categoria');
            }
            if (isset($dati['aggiungi'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
                DB::table('categoria')->insert($dati);
                return Redirect::to('categoria');
            }
            $utente = session('utente');
            $categoria = DB::SELECT('SELECT * FROM categoria');
            return View::make('categoria', compact('utente', 'categoria'));
        } else {
            return Redirect::to('login');
        }
    }

    public function prodotti(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            if (isset($dati['modifica'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['modifica'])) unset($dati['modifica']);
                if (isset($dati['id'])) {
                    $id = $dati['id'];
                    unset($dati['id']);
                    DB::table('prodotto')->where(['id' => $id])->update($dati);
                }
                return Redirect::to('prodotti');
            }
            if (isset($dati['elimina'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['elimina'])) {
                    DB::table('prodotto')->where(['id' => $dati['elimina']])->delete();
                }
                return Redirect::to('prodotti');
            }
            if (isset($dati['aggiungi'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
                DB::table('prodotto')->insert($dati);
                return Redirect::to('prodotti');
            }
            $utente = session('utente');
            $prodotti = DB::SELECT('SELECT * FROM prodotto');
            return View::make('prodotti', compact('utente', 'prodotti'));
        } else {
            return Redirect::to('login');
        }
    }

    public function mail(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            if (isset($dati['modifica'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['modifica'])) unset($dati['modifica']);
                $id = 1;
                DB::table('mail')->where(['id' => $id])->update($dati);
                return Redirect::to('mail');
            }
            $utente = session('utente');
            $mail = DB::SELECT('SELECT * FROM mail');
            return View::make('mail', compact('utente', 'mail'));
        } else {
            return Redirect::to('login');
        }
    }

    public function motivazione(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            if (isset($dati['modifica'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['modifica'])) unset($dati['modifica']);
                if (isset($dati['id'])) {
                    $id = $dati['id'];
                    unset($dati['id']);
                    DB::table('motivazione')->where(['id' => $id])->update($dati);
                }
                return Redirect::to('motivazione');
            }
            if (isset($dati['elimina'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['elimina'])) {
                    DB::table('motivazione')->where(['id' => $dati['elimina']])->delete();
                }
                return Redirect::to('motivazione');
            }
            if (isset($dati['aggiungi'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
                DB::table('motivazione')->insert($dati);
                return Redirect::to('motivazione');
            }
            $utente = session('utente');
            $table = DB::SELECT('SELECT * FROM motivazione');
            return View::make('motivazione', compact('utente', 'table'));
        } else {
            return Redirect::to('login');
        }
    }

    public function esito(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            if (isset($dati['modifica'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['modifica'])) unset($dati['modifica']);
                if (isset($dati['id'])) {
                    $id = $dati['id'];
                    unset($dati['id']);
                    DB::table('esito_trattativa')->where(['id' => $id])->update($dati);
                }
                return Redirect::to('esito');
            }
            if (isset($dati['elimina'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['elimina'])) {
                    DB::table('esito_trattativa')->where(['id' => $dati['elimina']])->delete();
                }
                return Redirect::to('esito');
            }
            if (isset($dati['aggiungi'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
                DB::table('esito_trattativa')->insert($dati);
                return Redirect::to('esito');
            }
            $utente = session('utente');
            $table = DB::SELECT('SELECT * FROM esito_trattativa');
            return View::make('esito', compact('utente', 'table'));
        } else {
            return Redirect::to('login');
        }
    }

    public function opening(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            if (isset($dati['modifica'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['modifica'])) unset($dati['modifica']);
                if (isset($dati['id'])) {
                    $id = $dati['id'];
                    unset($dati['id']);
                    DB::table('opening')->where(['id' => $id])->update($dati);
                }
                return Redirect::to('opening');
            }
            if (isset($dati['elimina'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['elimina'])) {
                    DB::table('opening')->where(['id' => $dati['elimina']])->delete();
                }
                return Redirect::to('opening');
            }
            if (isset($dati['aggiungi'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
                DB::table('opening')->insert($dati);
                return Redirect::to('opening');
            }
            $utente = session('utente');
            $table = DB::SELECT('SELECT * FROM opening');
            return View::make('opening', compact('utente', 'table'));
        } else {
            return Redirect::to('login');
        }
    }

    public function dipendenti(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            if (isset($dati['modifica'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['modifica'])) unset($dati['modifica']);
                if (isset($dati['id'])) {
                    $id = $dati['id'];
                    unset($dati['id']);
                    DB::table('dipendente')->where(['id' => $id])->update($dati);
                }
                return Redirect::to('dipendenti');
            }
            if (isset($dati['elimina'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['elimina'])) {
                    DB::table('dipendente')->where(['id' => $dati['elimina']])->delete();
                }
                return Redirect::to('dipendenti');
            }
            if (isset($dati['aggiungi'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
                DB::table('dipendente')->insert($dati);
                return Redirect::to('dipendenti');
            }
            $utente = session('utente');
            $table = DB::SELECT('SELECT * FROM dipendente');
            return View::make('dipendente', compact('utente', 'table'));
        } else {
            return Redirect::to('login');
        }
    }

    public function segnalato(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            if (isset($dati['modifica'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['modifica'])) unset($dati['modifica']);
                if (isset($dati['id'])) {
                    $id = $dati['id'];
                    unset($dati['id']);
                    DB::table('segnalato')->where(['id' => $id])->update($dati);
                }
                return Redirect::to('segnalato');
            }
            if (isset($dati['elimina'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['elimina'])) {
                    DB::table('segnalato')->where(['id' => $dati['elimina']])->delete();
                }
                return Redirect::to('segnalato');
            }
            if (isset($dati['aggiungi'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
                DB::table('segnalato')->insert($dati);
                return Redirect::to('segnalato');
            }
            $utente = session('utente');
            $table = DB::SELECT('SELECT * FROM segnalato');
            return View::make('segnalato', compact('utente', 'table'));
        } else {
            return Redirect::to('login');
        }
    }

    public function operatori(Request $request)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            if (isset($dati['modifica'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['modifica'])) unset($dati['modifica']);
                if (isset($dati['id'])) {
                    $id = $dati['id'];
                    unset($dati['id']);
                    DB::table('operatori')->where(['id' => $id])->update($dati);
                }
                return Redirect::to('operatori');
            }
            if (isset($dati['elimina'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['elimina'])) {
                    DB::table('operatori')->where(['id' => $dati['elimina']])->delete();
                }
                return Redirect::to('operatori');
            }
            if (isset($dati['aggiungi'])) {
                if (isset($dati['_token'])) unset($dati['_token']);
                if (isset($dati['aggiungi'])) unset($dati['aggiungi']);
                DB::table('operatori')->insert($dati);
                return Redirect::to('operatori');
            }
            $utente = session('utente');
            $table = DB::SELECT('SELECT * FROM operatori');
            return View::make('operatori', compact('utente', 'table'));
        } else {
            return Redirect::to('login');
        }
    }

    public function statistiche(Request $request, $data = 0)
    {
        $dati = $request->all();
        if (session()->has('utente')) {
            $utente = session('utente');
            $column = DB::select('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N\'pipeline\'');
            $statistiche_disdetta_gruppo_annuale = DB::SELECT('SELECT CAST(SUM(Valore_Contratto) as Decimal(20,2)) as Val,
                                                      (SELECT gruppo from prodotto where descrizione = disdette.Prodotto) as gruppo,
                                                      IF(disdette.esito = 0,\'DISDETTA\',if(disdette.esito = 1,\'RIENTRO\',\'CONTATTATO\')) AS Esito
                                                      FROM   disdette
                                                      WHERE  (DATE_FORMAT(Data_Chiusura,\'%Y\') = DATE_FORMAT(NOW(),\'%Y\'))
                                                      GROUP  BY gruppo,disdette.esito
                                                      ORDER  BY gruppo,CAST(SUM(Valore_Contratto) as Decimal(20,2)) desc ');
            $statistiche_disdetta_sottogruppo_annuale = DB::SELECT('SELECT CAST(SUM(Valore_Contratto) as Decimal(20,2)) as Val,
                                                      (SELECT sottogruppo from prodotto where descrizione = disdette.Prodotto) as gruppo,
                                                      IF(disdette.esito = 0,\'DISDETTA\',if(disdette.esito = 1,\'RIENTRO\',\'CONTATTATO\')) AS Esito
                                                      FROM   disdette
                                                      WHERE  (DATE_FORMAT(Data_Chiusura,\'%Y\') = DATE_FORMAT(NOW(),\'%Y\'))
                                                      GROUP  BY gruppo,disdette.esito
                                                      ORDER  BY gruppo,CAST(SUM(Valore_Contratto) as Decimal(20,2)) desc ');
            $statistiche_budget = DB::SELECT('(SELECT SUM(budget) as valore, \'Budget\' as type from budget where data_mese <= \'20241231\' and data_mese >= \'20240101\') UNION ALL (SELECT Coalesce(SUM(Vendita_Budget),0) as valore,\'Vendite\' as type FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'20241231\' and Data_Probabile_Chiusura >= \'20240101\' )');
            $differenza = DB::SELECT('SELECT (SELECT Coalesce(SUM(Vendita_Budget),0) as valore FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'20241231\' and Data_Probabile_Chiusura >= \'20240101\' ) - (SELECT SUM(budget) as valore from budget where data_mese <= \'20241231\' and data_mese >= \'20240101\') as valore ');
            $statistiche_sales = DB::TABLE('pipeline')->select(DB::raw('Sales,CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val'))->groupBy('Sales')->get();
            $statistiche_sales_vinte = DB::TABLE('pipeline')->select(DB::raw('Sales,CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val'))->where('Vinta', '=', '2')->where('Data_Probabile_Chiusura', '>=', date('Y', strtotime('now')) . '-01-01')->groupBy('Sales')->get();
            $statistiche_sales_vinte_zona = DB::SELECT('SELECT * from (select o.Gruppo as Sales,CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val,(SELECT SUM(Val_Ven_AC) from pipeline where Vinta = 2 and Data_Probabile_Chiusura >= \'2024-01-01\') as Percentuale from pipeline left join  operatori o on o.username = pipeline.Sales where Vinta = 2 and Data_Probabile_Chiusura >= \'2024-01-01\' group by o.Gruppo) f order by f.Val DESC');
            $statistiche_categoria = DB::table('pipeline')
                ->select('Categoria', DB::raw("DATE_FORMAT(Data_contatto, '%Y - %M') AS Data"), DB::raw('SUM(Val_Ven_AC) AS Val'))
                ->whereNotNull('Categoria')
                ->groupBy('Categoria', DB::raw('DATE_FORMAT(Data_contatto, \'%Y - %M\')'))
                ->orderBy(DB::raw('DATE_FORMAT(Data_contatto, \'%Y\')'), 'DESC')
                ->orderBy(DB::raw('DATE_FORMAT(Data_contatto, \'%m\')'), 'DESC')
                ->get();
            $statistiche_categoria_chiusura =
                DB::SELECT('select Categoria, DATE_FORMAT(Data_Probabile_Chiusura, \'%Y - %M\') AS Data, SUM(Val_Ven_AC) AS Val from pipeline where Categoria is not null and DATE_FORMAT(Data_Probabile_Chiusura, \'%m\') >  DATE_FORMAT(NOW(), \'%m\') and DATE_FORMAT(Data_Probabile_Chiusura, \'%Y\') >= DATE_FORMAT(NOW(), \'%Y\') group by Categoria, DATE_FORMAT(Data_Probabile_Chiusura, \'%Y - %M\') order by DATE_FORMAT(Data_Probabile_Chiusura, \'%Y\') desc, DATE_FORMAT(Data_Probabile_Chiusura, \'%m\')');

            $statistiche_corrente_prodotto_annuale = DB::select('SELECT CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val,(SELECT gruppo from prodotto where descrizione = pipeline.Prodotto) as gruppo,
                                                      (SELECT SUM(Val_Ven_AC) from pipeline WHERE  ((Vinta = 2) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y\') = DATE_FORMAT(NOW(),\'%Y\'))) as Percentuale
                                                      FROM   pipeline
                                                      WHERE  ((Vinta = 2) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y\') = DATE_FORMAT(NOW(),\'%Y\'))
                                                      GROUP  BY gruppo
                                                      ORDER  BY CAST(SUM(Val_Ven_AC) as Decimal(20,2)) desc ');
            $statistiche_corrente_sottogruppo_annuale =
                DB::select('SELECT CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val,(SELECT sottogruppo from prodotto where descrizione = pipeline.Prodotto) as gruppo,
                                                      (SELECT SUM(Val_Ven_AC) from pipeline WHERE  ((Vinta = 2) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y\') = DATE_FORMAT(NOW(),\'%Y\'))) as Percentuale
                                                      FROM   pipeline
                                                      WHERE  ((Vinta = 2) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y\') = DATE_FORMAT(NOW(),\'%Y\'))
                                                      GROUP  BY gruppo
                                                      ORDER  BY CAST(SUM(Val_Ven_AC) as Decimal(20,2)) desc ');
            /*ORDER  BY CAST(SUM(Val_Ven_AC) as Decimal(20,2)) desc');*/
            $categoria = DB::SELECT('SELECT Categoria FROM pipeline where Categoria is not null GROUP BY Categoria');

            $statistiche_mensili = DB::table('pipeline')
                ->select(DB::raw("DATE_FORMAT(Data_contatto,'%Y - %M') AS Data"), DB::raw('CAST(SUM(Val_Ven_AC) as Decimal(20,2)) AS Val'))
                ->groupBy(DB::raw('DATE_FORMAT(Data_contatto,\'%Y - %M\') '))
                ->orderBy(DB::raw('DATE_FORMAT(Data_contatto, \'%Y\')'), 'DESC')
                ->orderBy(DB::raw('DATE_FORMAT(Data_contatto, \'%m\')'), 'DESC')
                ->get();
            if ($data == 0) {
                $statistiche_budget_mensile = DB::SELECT('(SELECT SUM(budget) as valore, \'Budget\' as type from budget where data_mese = \'' . date('Y-m-01', strtotime('now')) . '\') UNION ALL (SELECT Coalesce(SUM(Vendita_Budget),0) as valore,\'Vendite\' as type FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'' . date('Y-m-d', strtotime(date('Y-m-01', strtotime('+1 month')) . '-1 day')) . '\' and Data_Probabile_Chiusura >= \'' . date('Y-m-01', strtotime('now')) . '\' )');
                $statistiche_corrente = DB::select('SELECT Vinta,CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val
                                                      FROM   pipeline
                                                      WHERE  ((Vinta = 2 or Vinta != 1) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y - %M\') = DATE_FORMAT(NOW(),\'%Y - %M\')) or ((Vinta = 1) and DATE_FORMAT(Data_Contatto,\'%Y - %M\') = DATE_FORMAT(NOW(),\'%Y - %M\'))
                                                      GROUP  BY Vinta
                                                      ORDER  BY Vinta desc');
                $statistiche_corrente_prodotto = DB::select('SELECT CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val,(SELECT gruppo from prodotto where descrizione = pipeline.Prodotto) as gruppo
                                                      FROM   pipeline
                                                      WHERE  ((Vinta = 2) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y - %M\') = DATE_FORMAT(NOW(),\'%Y - %M\'))
                                                      GROUP  BY gruppo
                                                      HAVING gruppo is not null
                                                      ORDER  BY CAST(SUM(Val_Ven_AC) as Decimal(20,2)) desc');
                $statistiche_corrente_sales = DB::select('SELECT CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val,Sales
                                                      FROM   pipeline
                                                      WHERE  ((Vinta = 2) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y - %M\') = DATE_FORMAT(NOW(),\'%Y - %M\'))
                                                      GROUP  BY Sales
                                                      ORDER  BY CAST(SUM(Val_Ven_AC) as Decimal(20,2)) desc');
                // or (Vinta = 2 and DATE_FORMAT(Data_Contatto,\'%Y - %M\') = DATE_FORMAT(\'' . $data . '\',\'%Y - %M\'))
                $mese_usato = DB::SELECT('SELECT MONTH(NOW()) as mese')[0]->mese;
                $anno_usato = DB::SELECT('SELECT YEAR(NOW()) as anno')[0]->anno;
            } else {
                $statistiche_budget_mensile = DB::SELECT('(SELECT SUM(budget) as valore, \'Budget\' as type from budget where data_mese = \'' . date('Y-m-01', strtotime($data)) . '\') UNION ALL (SELECT Coalesce(SUM(Vendita_Budget),0) as valore,\'Vendite\' as type FROM pipeline where Vinta = 2 and Data_Probabile_Chiusura <= \'' . date('Y-m-d', strtotime(date('Y-m-01', strtotime($data)) . '+1 month -1 day')) . '\' and Data_Probabile_Chiusura >= \'' . date('Y-m-01', strtotime($data)) . '\' )');
                $statistiche_corrente = DB::select('SELECT Vinta,CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val
                                                      FROM   pipeline
                                                      WHERE  ((Vinta = 1 or Vinta = 2) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y - %M\') = DATE_FORMAT(\'' . $data . '\',\'%Y - %M\')) or ((Vinta != 2 && Vinta != 1) and DATE_FORMAT(Data_Contatto,\'%Y - %M\') = DATE_FORMAT(\'' . $data . '\',\'%Y - %M\'))
                                                      GROUP  BY Vinta
                                                      ORDER  BY Vinta desc');
                $statistiche_corrente_prodotto = DB::select('SELECT CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val,(SELECT gruppo from prodotto where descrizione = pipeline.Prodotto) as gruppo
                                                      FROM   pipeline
                                                      WHERE  ((Vinta = 2) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y - %M\') = DATE_FORMAT(\'' . $data . '\',\'%Y - %M\'))
                                                      GROUP  BY gruppo
                                                      HAVING gruppo is not null
                                                      ORDER  BY CAST(SUM(Val_Ven_AC) as Decimal(20,2)) desc');
                $statistiche_corrente_sales = DB::select('SELECT CAST(SUM(Val_Ven_AC) as Decimal(20,2)) as Val,Sales
                                                      FROM   pipeline
                                                      WHERE  ((Vinta = 2) and DATE_FORMAT(Data_Probabile_Chiusura,\'%Y - %M\') = DATE_FORMAT(\'' . $data . '\',\'%Y - %M\'))
                                                      GROUP  BY Sales
                                                      ORDER  BY CAST(SUM(Val_Ven_AC) as Decimal(20,2)) desc');
                $mese_usato = DB::SELECT('SELECT MONTH(\'' . $data . '\') as mese')[0]->mese;
                $anno_usato = DB::SELECT('SELECT YEAR(\'' . $data . '\') as anno')[0]->anno;
            }
            switch ($mese_usato) {
                case 1:
                    $mese_usato = 'Gennaio';
                    break;
                case 2:
                    $mese_usato = 'Febbraio';
                    break;
                case 3:
                    $mese_usato = 'Marzo';
                    break;
                case 4:
                    $mese_usato = 'Aprile';
                    break;
                case 5:
                    $mese_usato = 'Maggio';
                    break;
                case 6:
                    $mese_usato = 'Giugno';
                    break;
                case 7:
                    $mese_usato = 'Luglio';
                    break;
                case 8:
                    $mese_usato = 'Agosto';
                    break;
                case 9:
                    $mese_usato = 'Settembre';
                    break;
                case 10:
                    $mese_usato = 'Ottobre';
                    break;
                case 11:
                    $mese_usato = 'Novembre';
                    break;
                case 12:
                    $mese_usato = 'Dicembre';
                    break;
                default:
                    $mese_usato = '';
                    break;
            }

            $mese_usato = $mese_usato . ' - ' . $anno_usato;

            $opening = DB::SELECT('SELECT * FROM opening where Anno = YEAR(CURDATE())');

            $canone_successivo = DB::select('SELECT
              SUM(Inc_Canone_AS) as valore
            FROM
              pipeline
            WHERE
              (Vinta = 2)
              AND (
                Data_Probabile_Chiusura >= ' . $opening[0]->Anno . '0101
                AND Data_Probabile_Chiusura <= ' . $opening[0]->Anno . '1231
              )');
            $ricontrattati = DB::select('SELECT SUM(Valore_Ricontrattato) as valore  from disdette where Esito = 1 and  (Data_Disdetta >= ' . ($opening[0]->Anno - 1) . '0701 and Data_Disdetta <= ' . $opening[0]->Anno . '0630)');
            $valore_disdette = DB::SELECT('select if(Esito = 1,ABS(SUM(Valore_Contratto) - SUM(Valore_Ricontrattato)),SUM(Valore_Contratto)) AS valore,Esito from disdette where (Data_Disdetta >= ' . ($opening[0]->Anno - 1) . '0701 and Data_Disdetta <= ' . $opening[0]->Anno . '0630) group by esito');
            $differenza_opening = (($canone_successivo[0]->valore - ($valore_disdette[0]->valore + $valore_disdette[1]->valore + $valore_disdette[2]->valore)) * 100) / $opening[0]->Val_Opening;
            $opening_anno_successivo = $opening[0]->Val_Opening + ($canone_successivo[0]->valore - ($valore_disdette[0]->valore + $valore_disdette[1]->valore + $valore_disdette[2]->valore));
            return View::make('statistiche', compact('opening', 'ricontrattati', 'differenza_opening', 'opening_anno_successivo', 'statistiche_sales', 'valore_disdette', 'canone_successivo', 'statistiche_disdetta_sottogruppo_annuale', 'statistiche_disdetta_gruppo_annuale', 'statistiche_corrente_sottogruppo_annuale', 'statistiche_budget_mensile', 'statistiche_corrente_prodotto', 'statistiche_corrente_prodotto_annuale', 'statistiche_corrente_sales', 'statistiche_sales_vinte', 'statistiche_sales_vinte_zona', 'differenza', 'statistiche_budget', 'statistiche_categoria', 'statistiche_categoria_chiusura', 'mese_usato', 'categoria', 'statistiche_mensili', 'statistiche_corrente', 'column'));
        } else {
            return Redirect::to('login');
        }
    }

    public function logout(Request $request)
    {
        session()->flush();

        return Redirect::to('login');
    }

    public function privacy(Request $request)
    {
        return View::make('privacy');
    }

    public function info(Request $request)
    {
        return View::make('info');
    }

    public function login(Request $request)
    {


        $dati = $request->all();

        $error = '';

        if (isset($dati['login'])) {

            $utenti = DB::select('SELECT * from operatori where abilitato = 1 and email = \'' . htmlentities($dati['username'], 3, 'UTF-8' . '') . '\' and password = \'' . htmlentities($dati['password'], 3, 'UTF-8' . '') . '\'');

            if (sizeof($utenti) > 0) {

                $utente = $utenti[0];
                session(['utente' => $utente]);
                session()->save();

            } else $error = 'Inserisci email e password corretti';
            $utenti = DB::select('SELECT * from operatori where abilitato = 1 and username = \'' . htmlentities($dati['username'], 3, 'UTF-8' . '') . '\' and password = \'' . htmlentities($dati['password'], 3, 'UTF-8' . '') . '\'');

            if (sizeof($utenti) > 0) {

                $utente = $utenti[0];
                session(['utente' => $utente]);
                session()->save();

            } else $error = 'Inserisci username e password corretti';
        }

        if (session()->has('utente')) {
            return Redirect::to('');
        } else {
            return View::make('login', compact('error'));
        }
    }
}
