<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CF;
class CFController extends Controller
{
    function index() {
         return view('clienti', ['table' => CF::all()]);
    }

    function all() {
         // Ottieni i dati dalla tabella CF
               // Ottieni i dati dalla tabella CF
        $data = CF::all()->toArray();

        // Converte tutti i valori in UTF-8 in modo sicuro
        array_walk_recursive($data, function (&$value) {
            $value = mb_convert_encoding($value, 'UTF-8', null);
        });

        // Restituisci i dati come JSON
        return response()->json($data);
    }

    public function salvaDati(Request $request)
    {        
        $request->validate([
            'ragione_sociale' => 'required',
            'partita_iva' => 'required',
            //'telefono' => 'required',
        ]);       

        $ultimoCF = CF::where('cd_Cf', 'LIKE', 'P%')->latest('Id_CF')->first();
        
 

        // Verifica se è stato trovato un CF che soddisfa i criteri
        if ($ultimoCF) {
            // Puoi fare qualcosa con il CF trovato qui, ad esempio restituirlo come risposta JSON
            $numero = (int) str_replace('P', '', $ultimoCF->Cd_CF) + 1;

            // Costruisci il nuovo valore per Cd_CF
            $nuovoCdCF = 'P' . str_pad($numero, strlen($ultimoCF->Cd_CF) - 1, '0', STR_PAD_LEFT);
            
            $addCF = new CF();
            $addCF->Descrizione =  $request->ragione_sociale;
            $addCF->Cd_Provincia = "NA";
            $addCF->Cd_Nazione = "IT";
            $addCF->PartitaIva = $request->partita_iva;
            $addCF->Cd_CF =  $nuovoCdCF;
            $addCF->save();

            return $this->index();

        } else {
            // Nessun CF trovato che soddisfi i criteri
            return response()->json(['message' => 'Nessun CF trovato che inizia con "P"', 'ultimo' => $ultimoCF]);
        }
     
    }
}
