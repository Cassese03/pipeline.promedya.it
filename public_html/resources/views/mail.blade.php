<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Configurazione Mail
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>

    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        <div class="card animate-fadeIn">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-envelope-open-text" style="margin-right: 0.5rem;"></i>Impostazioni Email</h3>
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
                            <th class="no-sort">Valore</th>
                            <th class="no-sort" style="width: 120px; text-align: center;">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($mail as $m)
                        <tr>
                            <td style="font-weight: 600; color: #4366F6;">{{ $m->id}}</td>
                            <td>
                                @if($m->valore == 1)
                                    <span class="badge" style="background: #10B981; color: white; padding: 0.5rem 1rem; font-size: 0.95rem;">
                                        <i class="fas fa-check-circle"></i> Mail Attive
                                    </span>
                                @endif 
                                @if($m->valore == 0)
                                    <span class="badge" style="background: #EF4444; color: white; padding: 0.5rem 1rem; font-size: 0.95rem;">
                                        <i class="fas fa-times-circle"></i> Mail Disattivate
                                    </span>
                                @endif
                            </td>
                            <td class="no-sort" style="text-align: center; white-space: nowrap;">
                                <button type="button" onclick="modifica(<?php echo $m->id;?>)"
                                        class="btn btn-primary btn-sm" style="padding: 0.5rem 0.75rem;" title="Modifica">
                                    <i class="fas fa-edit"></i>
                                </button>
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

<?php foreach ($mail as $m){ ?>
<form method="post" enctype="multipart/form-data" action="/mail">
    @csrf
    <div class="modal fade" id="modal_modifica_<?php echo $m->id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifica Configurazione Mail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="valore">Valore (0 = Disattivate, 1 = Attive)</label>
                        <input class="form-control" type="number" min="0" step="1" max="1" name="valore" id="valore" value="{{ $m->valore }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?php echo $m->id;?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary" name="modifica" value="Modifica">
                </div>
            </div>
        </div>
    </div>
</form>
<?php } ?>

<script>
function modifica(id) { $('#modal_modifica_' + id).modal('show'); }
</script>
