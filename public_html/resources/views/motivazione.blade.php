<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="color:#007bff">
            PROMEDYA | Sales Force
            <small>&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
        <br>
    </section>
    <!-- Main content -->
    <section class="content" style="margin:5%;">
        @if ($utente->username != 'Giovanni Tutino')
            <div>
            </div>
        @else

            <button class="form-control btn-primary" style="margin-bottom:5%;border-radius:25px"
                    id="aggiungi_motivazione"
                    onclick="aggiungi()" name="aggiungi_motivazione">
                Aggiungi
                Nuova
                Motivazione
            </button>
        @endif
        <table id="example3" class="table table-bordered datatable">
            <thead>
            <tr>
                <th class="no-sort">Id</th>
                <th class="no-sort">Descrizione</th>
                <th class="no-sort">Azioni</th>
            </tr>
            </thead>
            <tbody>
            @foreach($table as $p)
                <tr>
                    <td>{{ $p->id}}</td>
                    <td>{{ $p->descrizione }}</td>
                    @if ($utente->username != 'Giovanni Tutino')
                        <td>
                        </td>
                    @else
                        <form enctype="multipart/form-data" method="post"
                              onsubmit="return confirm('Sei sicuro di voler eliminare la riga selezionata?')">
                            @csrf
                            <td class="no-sort"
                                style="background:white;border-width:1px">
                                <div style="display:flex;gap: 2px;">
                                    <button type="button" onclick="modifica(<?php echo $p->id;?>)"
                                            class="form-control btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                             fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path
                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </button>
                                    <button type="submit" name="elimina" value="<?php echo $p->id;?>"
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
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</div>
<!-- /.container-fluid-->


@include('common.footer')

<?php foreach ($table as $p){ ?>
<form method="post" enctype="multipart/form-data" action="/motivazione">
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
      onsubmit="return confirm('Sei sicuro di voler aggiungere la nuova motivazione?')" enctype="multipart/form-data"
      action="/motivazione">
    @csrf
    <div class="modal fade" id="modal_aggiungi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Crea motivazione</h4>
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
