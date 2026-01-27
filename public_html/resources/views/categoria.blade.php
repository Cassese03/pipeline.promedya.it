<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Gestione Categorie
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        @if ($utente->username == 'Giovanni Tutino')
            <div style="margin-bottom: 1.5rem;">
                <button class="btn btn-primary" style="padding: 0.75rem 2rem;"
                        id="aggiungi_categoria" onclick="aggiungi()" name="aggiungi_categoria">
                    <i class="fas fa-plus" style="margin-right: 0.5rem;"></i>
                    Aggiungi Nuova Categoria
                </button>
            </div>
        @endif

        <!-- Card per la tabella -->
        <div class="card animate-fadeIn">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tags" style="margin-right: 0.5rem;"></i>
                    Elenco Categorie
                </h3>
            </div>
            <div class="card-body">
                <style>
                    #example3_wrapper {
                        display: grid !important;
                        grid-template-columns: 1fr !important;
                    }
                    #example3_wrapper .row {
                        display: flex !important;
                        align-items: center !important;
                        gap: 1rem !important;
                        justify-content: flex-start !important;
                    }
                    #example3_wrapper .row:first-child {
                        order: 1 !important;
                        margin-bottom: 1.5rem !important;
                    }
                    #example3_wrapper .row:last-child {
                        order: 3 !important;
                        margin-top: 1.5rem !important;
                    }
                    #example3 {
                        order: 2 !important;
                        margin: 0 !important;
                    }
                    #example3_filter {
                        display: none !important;
                    }
                    #example3_length {
                        margin-bottom: 0 !important;
                    }
                    .dt-buttons {
                        display: flex !important;
                        gap: 0.5rem !important;
                    }
                    .dt-button {
                        padding: 0.5rem 0.75rem !important;
                        border: 1px solid #ddd !important;
                        border-radius: 0.25rem !important;
                        cursor: pointer !important;
                        background: white !important;
                        font-size: 0.875rem !important;
                    }
                    .dt-button:hover {
                        background: #f5f5f5 !important;
                    }
                    .paginate_button {
                        padding: 0.5rem 0.75rem !important;
                        border: 1px solid #ddd !important;
                        border-radius: 0.25rem !important;
                        cursor: pointer !important;
                        background: white !important;
                        display: inline-block !important;
                    }
                    .paginate_button.active {
                        background: #4366F6 !important;
                        color: white !important;
                        border-color: #4366F6 !important;
                    }
                    .paginate_button:hover {
                        background: #f5f5f5 !important;
                    }
                </style>
                <table id="example3" class="table table-bordered datatable" style="width: 100%; margin: 0;">
                    <thead>
                        <tr>
                            <th class="no-sort">ID</th>
                            <th class="no-sort">Descrizione</th>
                            <th class="no-sort" style="width: 120px; text-align: center;">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categoria as $p)
                        <tr>
                            <td style="font-weight: 600; color: #4366F6;">{{ $p->id}}</td>
                            <td style="font-weight: 500;">{{ $p->descrizione }}</td>
                            <td class="no-sort" style="text-align: center; white-space: nowrap;">
                                @if ($utente->username != 'Giovanni Tutino')
                                    <span style="color: #94A3B8; font-size: 0.875rem;">—</span>
                                @else
                                    <button type="button" onclick="modifica(<?php echo $p->id;?>)"
                                            class="btn btn-primary btn-sm" style="padding: 0.5rem 0.75rem; margin-right: 0.25rem;" title="Modifica">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" onclick="eliminaCategoria(<?php echo $p->id;?>)"
                                            class="btn btn-danger btn-sm" style="padding: 0.5rem 0.75rem;" title="Elimina">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@include('common.footer')

<?php foreach ($categoria as $p){ ?>
<form method="post" enctype="multipart/form-data" action="/categoria">
    @csrf
    <div class="modal fade" id="modal_modifica_<?php echo $p->id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifica Categoria</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descrizione">Descrizione</label>
                        <input class="form-control" name="descrizione" id="descrizione" value="{{ $p->descrizione }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?php echo $p->id;?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary" name="modifica" value="Modifica">
                </div>
            </div>
        </div>
    </div>
</form>
<?php } ?>

<form method="post" onsubmit="return confirm('Sei sicuro di voler aggiungere la nuova categoria?')" enctype="multipart/form-data" action="/categoria">
    @csrf
    <div class="modal fade" id="modal_aggiungi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crea Categoria</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descrizione">Descrizione</label>
                        <input class="form-control" name="descrizione" id="descrizione">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary" name="aggiungi" value="Aggiungi">
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function aggiungi() {
    $('#modal_aggiungi').modal('show');
}
function modifica(id) {
    $('#modal_modifica_' + id).modal('show');
}
function eliminaCategoria(id) {
    if (confirm('Sei sicuro di voler eliminare la riga selezionata?')) {
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = window.location.href;
        form.innerHTML = '<input type="hidden" name="_token" value="' + document.querySelector('input[name="_token"]').value + '">' +
                       '<input type="hidden" name="elimina" value="' + id + '">';
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
