<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Gestione Dipendenti
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        @if ($utente->username == 'Giovanni Tutino')
            <div style="margin-bottom: 1.5rem;">
                <button class="btn btn-primary" style="padding: 0.75rem 2rem;"
                        id="aggiungi_dipendente" onclick="aggiungi()" name="aggiungi_dipendente">
                    <i class="fas fa-plus" style="margin-right: 0.5rem;"></i>
                    Aggiungi Nuovo Dipendente
                </button>
            </div>
        @endif

        <!-- Card per la tabella -->
        <div class="card animate-fadeIn">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users" style="margin-right: 0.5rem;"></i>
                    Elenco Dipendenti
                </h3>
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <table id="example3" class="table table-bordered datatable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="no-sort">ID</th>
                            <th class="no-sort">Descrizione</th>
                            <th class="no-sort">Valore Annuale Lordo</th>
                            <th class="no-sort" style="width: 120px; text-align: center;">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $p)
                        <tr>
                            <td style="font-weight: 600; color: #4366F6;">{{ $p->id}}</td>
                            <td style="font-weight: 500;">{{ $p->descrizione }}</td>
                            <td style="text-align: right; font-family: var(--font-mono);">{{ number_format($p->Valore_Annuale_Lordo, 2, ',', '.') }} €</td>
                            @if ($utente->username != 'Giovanni Tutino')
                                <td style="text-align: center;">
                                    <span style="color: #94A3B8; font-size: 0.875rem;">—</span>
                                </td>
                            @else
                                <form enctype="multipart/form-data" method="post"
                                      onsubmit="return confirm('Sei sicuro di voler eliminare la riga selezionata?')">
                                    @csrf
                                    <td class="no-sort" style="background:white;">
                                        <div style="display:flex; gap: 0.5rem; justify-content: center;">
                                            <button type="button" onclick="modifica(<?php echo $p->id;?>)"
                                                    class="btn btn-primary" style="padding: 0.5rem 0.75rem;" title="Modifica">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="submit" name="elimina" value="<?php echo $p->id;?>"
                                                    class="btn btn-danger" style="padding: 0.5rem 0.75rem;" title="Elimina">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </form>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- /.container-fluid-->


@include('common.footer')

<?php foreach ($table as $p){ ?>
<form method="post" enctype="multipart/form-data" action="/dipendenti">
    @csrf
    <div class="modal fade" id="modal_modifica_<?php echo $p->id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Modifica Prodotto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="descrizione">
                        Descrizione
                    </label>
                    <input class="form-control" name="descrizione" id="descrizione" value="{{ $p->descrizione }}">
                    <label for="Valore_Annuale_Lordo">
                        Valore Annuale Lordo
                    </label>
                    <input class="form-control" name="Valore_Annuale_Lordo" id="Valore_Annuale_Lordo" value="{{ $p->Valore_Annuale_Lordo }}">
                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?php echo $p->id;?>">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary pull-right" name="modifica" value="Modifica"
                           style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>
<?php } ?>


<form method="post"
      onsubmit="return confirm('Sei sicuro di voler aggiungere il nuovo Dipendente?')" enctype="multipart/form-data"
      action="/dipendenti">
    @csrf
    <div class="modal fade" id="modal_aggiungi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Crea Dipendente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label for="descrizione">
                            Descrizione
                        </label>
                        <input class="form-control" name="descrizione" id="descrizione">
                        <label for="Valore_Annuale_Lordo">
                            Valore Annuale Lordo
                        </label>
                        <input class="form-control" name="Valore_Annuale_Lordo" id="Valore_Annuale_Lordo">
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

<script type="text/javascript">

    function aggiungi() {
        $('#modal_aggiungi').modal('show');
    }

    function modifica(id) {
        $('#modal_modifica_' + id).modal('show');
    }

</script>
