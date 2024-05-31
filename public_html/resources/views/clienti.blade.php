<?php $utente = session('utente'); ?>
@include('common.header')
<style>
    .obsoleto {
        background-color: #ffc0cb; /* Cambia il colore di sfondo a tuo piacimento */
    }
</style>
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
                PROMEDYA Sales Force
                <small>&nbsp;&nbsp;<b id="countdown"></b></small>
            </h1>
            <br>
        </section>
        <!-- Main content -->
       
        <section class="content" style="margin:5%;">
            <button class="form-control btn-primary" style="margin-bottom:5%;border-radius:25px" id="aggiungi_dipendente"
                    onclick="aggiungi()" name="aggiungi_dipendente">
                Aggiungi Nuovo Potenziale Cliente
            </button> 
            <table id="example3" class="table table-bordered datatable">
                <thead>
                <tr>
                    <th class="no-sort">Codice Sap</th>
                    <th class="no-sort">Ragione Sociale</th>
                    <th class="no-sort">Partita Iva</th>
                    <th class="no-sort">Canone Annuale</th>
                    {{-- <th class="no-sort">Obsoleto</th> --}}
                 </tr>
                </thead>
                <tbody>
                @foreach($table as $p)
                    <tr @if($p->Obsoleto == 1) class="table-danger" @endif>
                        <td>{{ $p->xCodSap }}</td>
                        <td>{{ $p->Descrizione }}</td>
                        <td>{{ $p->PartitaIva}}</td>
                        <td align="right">{{ number_format($p->xImpAss, 2, ',', '.') }}</td>
                        {{-- <th class="no-sort">{{$p->Obsoleto}}</th> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    @endif
</div>
<!-- /.container-fluid-->


@include('common.footer')

{{-- <?php foreach ($table as $p){ ?>
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
 --}}

{{-- <form method="post"
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
</form> --}}

@include('modal.new_cf')

<script type="text/javascript">

    function aggiungi() {
        $('#modalNewCF').modal('show');
    }

    function modifica(id) {
        $('#modal_modifica_' + id).modal('show');
    }

</script>
