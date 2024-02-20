  <!-- Modale Nuovo Cliente -->
  <div class="modal fade" id="modalNewCF" tabindex="-1" role="dialog" aria-labelledby="modalNewCFLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="api/cf" method="post">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inserimento Dati</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="ragioneSociale">Ragione Sociale*</label>
                            <input type="text" name="ragione_sociale" class="form-control" id="ragioneSociale" placeholder="Inserisci la Ragione Sociale" required>
                        </div>
                        <div class="form-group">
                            <label for="partitaIva">Partita IVA*</label>
                            <input type="text" name="partita_iva" class="form-control" id="partitaIva" placeholder="Inserisci la Partita IVA" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="telefono">Numero di Telefono*</label>
                            <input type="text" class="form-control" id="telefono" placeholder="Inserisci il Numero di Telefono" required>
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                      {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button> --}}
                    <input type="submit" onclick="close()" class="btn btn-primary" value="Conferma">
                </div>
            </div>
        </form>
    </div>
</div>

  <script>

    function close() {
        $('#modalNewCF').modal('hide');
    }
    // Funzione per gestire la conferma dei dati
    function confermaDati() {
        var ragioneSociale = document.getElementById('ragioneSociale').value;
        var partitaIva = document.getElementById('partitaIva').value;
        //var telefono = document.getElementById('telefono').value;

        // Controlla se i campi obbligatori sono stati inseriti
        if (ragioneSociale && partitaIva) {
                  // Dati da inviare nel corpo della richiesta
        var data = {
            ragione_sociale: ragioneSociale,
            partita_iva: partitaIva
        };

        // Esegui la chiamata HTTP POST utilizzando jQuery
        $.ajax({
            url: 'api/cf', // URL dell'endpoint
            type: 'POST',
            contentType: 'application/json', // Tipo di dati inviati nel corpo della richiesta
            data: JSON.stringify(data), // Converti i dati in formato JSON
            success: function(response, textStatus, xhr) {
                // Verifica lo stato della risposta
                if (xhr.status === 200) {
                    // Se lo stato è 200, la richiesta è andata a buon fine
                    console.log('Risposta dal server:', response);
                    newCF =  JSON.parse(response);
                    // Chiudi la modale
                    $('#modalNewCF').modal('hide');
                } else {
                    // Se lo stato non è 200, mostra un messaggio di errore con il corpo della risposta
                    console.error('Errore nella risposta:', response);
                 
                    // Mostra un messaggio di errore con il corpo della risposta
                    alert('Si è verificato un errore durante la richiesta. Dettagli: ' + JSON.stringify(response));
                }
            },
            error: function(xhr, status, error) {
                // Gestisci gli errori di connessione
                console.error('Errore nella richiesta:', error);

                // Mostra un messaggio di errore generico
                alert('Si è verificato un errore durante la richiesta.');
            }
        });
        } else {
            // Mostra un messaggio di errore se non tutti i campi obbligatori sono stati compilati
            alert("Tutti i campi obbligatori devono essere compilati.");
        }
    }
</script>