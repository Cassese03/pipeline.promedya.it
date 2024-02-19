<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    @if ($utente->username != 'Giovanni Tutino')
        <div style="display: flex;justify-content: center;align-items: center;padding-top: 5%;">
            <img alt="WORK IN PROGRESS" style="min-height: 25vh;min-width: 25vw;"
                 src="https://www.b-fast.it/wp-content/uploads/2021/08/come-correggere-errore-siamo-spiacenti-non-sei-autorizzato-ad-accedere-a-questa-pagina-in-wordpress.jpg">
        </div>
    @else
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                PROMEDYA | Sales Force
                <small>&nbsp;&nbsp;<b id="countdown"></b></small>
            </h1>
            <br>
        </section>
        <!-- Main content -->
        <section class="content" style="margin:5%;">
            <table id="example3" class="table table-bordered datatable">
                <thead>
                <tr>
                    <th class="no-sort">Id</th>
                    <th class="no-sort">Valore</th>
                    <th class="no-sort">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @foreach($mail as $m)
                    <tr>
                        <td>{{ $m->id}}</td>
                        <td>@if($m->valore == 1) Mail Attive @endif @if($m->valore == 0) Mail Disattivate @endif</td>
                        <form enctype="multipart/form-data" method="post"
                              onsubmit="return confirm('Sei sicuro di voler eliminare la riga selezionata?')">
                            @csrf
                            <td class="no-sort"
                                style="background:white;border-width:1px">
                                <div style="display:flex;gap: 2px;">
                                    <button type="button" onclick="modifica(<?php echo $m->id;?>)"
                                            class="form-control btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                             fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path
                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    @endif
</div>
<!-- /.container-fluid-->


@include('common.footer')

<?php foreach ($mail as $m){ ?>
<form method="post" enctype="multipart/form-data" action="/mail">
    @csrf
    <div class="modal fade" id="modal_modifica_<?php echo $m->id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Modifica MAIL</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="descrizione">
                        Valore
                    </label>
                    <input class="form-control" type="number" min="0" step="1" max="1" name="valore" id="valore"
                           value="{{ $m->valore }}">
                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?php echo $m->id;?>">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary pull-right" name="modifica" value="Modifica"
                           style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>
<?php } ?>

<script type="text/javascript">


    function modifica(id) {
        $('#modal_modifica_' + id).modal('show');
    }

</script>
