<?php $utente = session('utente'); ?>
@include('common.header')
<style>
    .obsoleto {
        background-color: #ffc0cb;
    }
</style>
<div class="content-wrapper">
    @if ($utente->username != 'Giovanni Tutino')
        <div style="display: flex;justify-content: center;align-items: center;padding-top: 5%;">
            <div class="card" style="max-width: 600px; text-align: center;">
                <div class="card-body" style="padding: 3rem;">
                    <i class="fas fa-lock" style="font-size: 4rem; color: #EF4444; margin-bottom: 1.5rem;"></i>
                    <h2 style="color: #1E293B; margin-bottom: 1rem;">Accesso Negato</h2>
                    <p style="color: #64748B; font-size: 1.1rem;">Non hai i permessi per accedere a questa sezione.</p>
                </div>
            </div>
        </div>
    @else
        <!-- Content Header -->
        <section class="content-header" style="padding: 1.5rem;">
            <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 1rem;">
                Gestione Clienti
                <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
            </h1>
            <button class="btn btn-primary" style="padding: 0.75rem 2rem; margin-bottom: 1.5rem;" id="aggiungi_dipendente" onclick="aggiungi()" name="aggiungi_dipendente">
                <i class="fas fa-user-plus" style="margin-right: 0.5rem;"></i>
                Aggiungi Nuovo Potenziale Cliente
            </button>
        </section>
       
        <section class="content" style="padding: 0 1.5rem 1.5rem;">
            <div class="card animate-fadeIn">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-building" style="margin-right: 0.5rem;"></i>Elenco Clienti</h3>
                </div>
                <div class="card-body" style="overflow-x: auto;">
 
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
                </div>
            </div>
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
