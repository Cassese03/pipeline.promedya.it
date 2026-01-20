<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Gestione Opening
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>

    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        @if ($utente->username == 'Giovanni Tutino')
            <div style="margin-bottom: 1.5rem;">
                <button class="btn btn-primary" style="padding: 0.75rem 2rem;" id="aggiungi_opening" onclick="aggiungi()">
                    <i class="fas fa-plus" style="margin-right: 0.5rem;"></i>
                    Aggiungi Nuovo Opening
                </button>
            </div>
        @endif

        <div class="card animate-fadeIn">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-door-open" style="margin-right: 0.5rem;"></i>Elenco Opening</h3>
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <table id="example3" class="table table-bordered datatable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="no-sort">ID</th>
                            <th class="no-sort">Valore Opening</th>
                            <th class="no-sort">Anno</th>
                            <th class="no-sort" style="width: 120px; text-align: center;">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $p)
                        <tr>
                            <td style="font-weight: 600; color: #4366F6;">{{ $p->id}}</td>
                            <td style="text-align: right; font-family: var(--font-mono);">{{ number_format($p->Val_Opening,2,',','') }} €</td>
                            <td style="font-weight: 500;">{{ $p->Anno }}</td>
                            @if ($utente->username != 'Giovanni Tutino')
                                <td style="text-align: center;"><span style="color: #94A3B8; font-size: 0.875rem;">—</span></td>
                            @else
                                <form enctype="multipart/form-data" method="post" onsubmit="return confirm('Sei sicuro di voler eliminare la riga selezionata?')">
                                    @csrf
                                    <td class="no-sort" style="background:white;">
                                        <div style="display:flex; gap: 0.5rem; justify-content: center;">
                                            <button type="button" onclick="modifica(<?php echo $p->id;?>)" class="btn btn-primary" style="padding: 0.5rem 0.75rem;" title="Modifica">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="submit" name="elimina" value="<?php echo $p->id;?>" class="btn btn-danger" style="padding: 0.5rem 0.75rem;" title="Elimina">
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

@include('common.footer')

<?php foreach ($table as $p){ ?>
<form method="post" enctype="multipart/form-data" action="/opening">
    @csrf
    <div class="modal fade" id="modal_modifica_<?php echo $p->id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifica Opening</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Val_Opening">Valore Opening</label>
                        <input type="number" step="0.01" class="form-control" name="Val_Opening" id="Val_Opening" value="{{ number_format($p->Val_Opening,2,'.','') }}">
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

<form method="post" onsubmit="return confirm('Sei sicuro di voler aggiungere il nuovo opening?')" enctype="multipart/form-data" action="/opening">
    @csrf
    <div class="modal fade" id="modal_aggiungi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crea Opening</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Val_Opening">Valore Opening</label>
                        <input class="form-control" name="Val_Opening" id="Val_Opening">
                    </div>
                    <div class="form-group">
                        <label for="Anno">Anno</label>
                        <input class="form-control" name="Anno" id="Anno">
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
function aggiungi() { $('#modal_aggiungi').modal('show'); }
function modifica(id) { $('#modal_modifica_' + id).modal('show'); }
</script>
