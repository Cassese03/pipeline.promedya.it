<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Gestione Incentivi
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>

    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        @if ($utente->username == 'Giovanni Tutino')
            <div style="margin-bottom: 1.5rem;">
                <button class="btn btn-primary" style="padding: 0.75rem 2rem;" id="aggiungi_incentivo" onclick="aggiungi()">
                    <i class="fas fa-plus" style="margin-right: 0.5rem;"></i>
                    Aggiungi Nuovo Incentivo
                </button>
            </div>
        @endif

        <div class="card animate-fadeIn">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-award" style="margin-right: 0.5rem;"></i>Elenco Incentivi</h3>
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <table id="example3" class="table table-bordered datatable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="no-sort">ID</th>
                            <th class="no-sort">Obiettivo</th>
                            <th class="no-sort">Target</th>
                            @if ($utente->username == 'Giovanni Tutino')
                                <th class="no-sort">Incentivo</th>
                                <th class="no-sort">Anno</th>
                                <th class="no-sort">Semestre</th>
                            @endif
                            <th class="no-sort" style="width: 150px; text-align: center;">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $p)
                        <tr>
                            <td style="font-weight: 600; color: #4366F6;">{{ $p->id}}</td>
                            <td>{{ $p->desc_obiettivo}}</td>
                            <td style="text-align: right; font-family: var(--font-mono);">{{ $p->target }}</td>
                            @if ($utente->username != 'Giovanni Tutino')
                                <td style="text-align: center;"><span style="color: #94A3B8; font-size: 0.875rem;">—</span></td>
                            @else
                                <td style="text-align: right; font-family: var(--font-mono);">{{ $p->incentivo }}</td>
                                <td style="font-weight: 500;">{{ $p->anno }}</td>
                                <td><span class="badge" style="background: #4366F6; color: white; padding: 0.375rem 0.75rem;">{{ $p->semestre }}°</span></td>
                                <form enctype="multipart/form-data" method="post" onsubmit="return confirm('Sei sicuro di voler eliminare la riga selezionata?')">
                                    @csrf
                                    <td class="no-sort" style="background:white;">
                                        <div style="display:flex; gap: 0.5rem; justify-content: center;">
                                            <button type="button" onclick="modifica(<?php echo $p->id;?>)" class="btn btn-primary" style="padding: 0.5rem 0.75rem;" title="Modifica">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" onclick="duplica(<?php echo $p->id;?>)" class="btn btn-warning" style="padding: 0.5rem 0.75rem;" title="Duplica">
                                                <i class="fa fa-clone"></i>
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
<form method="post" enctype="multipart/form-data" action="/incentivi">
    @csrf
    <div class="modal fade" id="modal_modifica_<?php echo $p->id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifica Incentivo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="desc_obiettivo">Descrizione Obiettivo</label>
                        <input class="form-control" name="desc_obiettivo" id="desc_obiettivo" value="{{ $p->desc_obiettivo }}">
                    </div>
                    <div class="form-group">
                        <label for="target">Target</label>
                        <input class="form-control" type="number" step="0.01" min="0" name="target" id="target" value="{{ $p->target }}">
                    </div>
                    <div class="form-group">
                        <label for="incentivo">Incentivo</label>
                        <input class="form-control" type="number" step="0.01" min="0" name="incentivo" id="incentivo" value="{{ $p->incentivo }}">
                    </div>
                    <div class="form-group">
                        <label for="semestre">Semestre</label>
                        <input class="form-control" type="number" step="1" min="1" max="2" name="semestre" id="semestre" value="{{ $p->semestre }}">
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

<form method="post" onsubmit="return confirm('Sei sicuro di voler aggiungere il nuovo incentivo?')" enctype="multipart/form-data" action="/incentivi">
    @csrf
    <div class="modal fade" id="modal_aggiungi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crea Incentivo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="desc_obiettivo_agg">Descrizione Obiettivo</label>
                        <input class="form-control" name="desc_obiettivo" id="desc_obiettivo_agg">
                    </div>
                    <div class="form-group">
                        <label for="target_agg">Target</label>
                        <input class="form-control" type="number" step="0.01" min="0" name="target" id="target_agg">
                    </div>
                    <div class="form-group">
                        <label for="incentivo_agg">Incentivo</label>
                        <input class="form-control" type="number" step="0.01" min="0" name="incentivo" id="incentivo_agg">
                    </div>
                    <div class="form-group">
                        <label for="semestre_agg">Semestre</label>
                        <input class="form-control" type="number" step="1" min="1" max="2" name="semestre" id="semestre_agg">
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
function duplica(id) {
    duplica_ajax(id);
}
function duplica_ajax(id) {
    $.ajax({
        url: '<?php echo URL::asset('ajax/duplica_ajax_INCENTIVI') ?>/' + id,
        type: "POST",
        data: {}
    }).done(function (result) {
        $('#modal_aggiungi').modal('show');
        eval(result);
    });
}
</script>
