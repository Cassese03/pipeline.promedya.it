<?php $utente = session('utente'); ?>
@include('common.header')

<div class="content-wrapper">
    <section class="content-header">
        <h1 style="color:#007bff; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-file-excel" style="color:#28a745;"></i>
            Importatore Excel Disdette
        </h1>
    </section>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="box" style="border: 2px solid #28a745; box-shadow: 0 4px 16px rgba(40,167,69,0.08); border-radius: 12px;">
                    <div class="box-body" style="padding: 2.5rem;">
                        <div class="mb-4" style="font-size: 1.1rem; color: #444;">
                            <i class="fas fa-info-circle text-info"></i>
                            Carica un file Excel (.xls, .xlsx) con le disdette da importare. I dati verranno aggiunti automaticamente alla tabella.<br>
                            <span style="font-size:0.95em;color:#888;">Assicurati che il file rispetti il formato richiesto.</span>
                        </div>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">{{ session('success') }}</div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        <?php endif; ?>
                        <form action="{{ route('import-disdette.post') }}" method="POST" enctype="multipart/form-data" style="margin-top: 1.5rem;">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="file" style="font-weight: 400;">Seleziona file Excel</label>
                                <input type="file" name="file" id="file" class="form-control" accept=".xls,.xlsx" required style="padding: 0.25rem;">
                            </div>
                            <button type="submit" class="btn btn-success btn-lg" style="width: 100%; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; gap: 10px;">
                                <i class="fas fa-upload"></i> Importa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('common.footer')
