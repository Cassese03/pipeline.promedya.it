<?php $utente = session('utente'); ?>
@include('common.header')

<div class="content-wrapper">
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Importa Disdette da Excel
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>
    
    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card animate-fadeIn">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-file-excel" style="margin-right: 0.5rem;"></i>Carica File Excel</h3>
                    </div>
                    <div class="card-body" style="padding: 2.5rem;">
                        <div class="alert alert-info" style="background: #E8F4FD; border: 1px solid #4366F6; color: #1E293B; border-radius: var(--radius-md);">
                            <i class="fas fa-info-circle" style="color: #4366F6;"></i>
                            <strong>Istruzioni:</strong>
                            <p style="margin: 0.5rem 0 0 0;">Carica un file Excel (.xls, .xlsx) con le disdette da importare. I dati verranno aggiunti automaticamente alla tabella. Assicurati che il file rispetti il formato richiesto.</p>
                        </div>

                        <?php if(session('success')): ?>
                            <div class="alert alert-success animate-fadeIn" style="margin-top: 1.5rem;">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </div>
                        <?php endif; ?>
                        
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger animate-fadeIn" style="margin-top: 1.5rem;">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            </div>
                        <?php endif; ?>

                        <form action="{{ route('import-disdette.post') }}" method="POST" enctype="multipart/form-data" style="margin-top: 2rem;">
                            @csrf
                            <div class="form-group" style="margin-bottom: 2rem;">
                                <label for="file" style="font-weight: 600; color: #1E293B; margin-bottom: 0.75rem; display: block;">
                                    <i class="fas fa-upload" style="margin-right: 0.5rem; color: #4366F6;"></i>
                                    Seleziona file Excel
                                </label>
                                <input type="file" name="file" id="file" class="form-control" accept=".xls,.xlsx" required style="padding: 0.75rem;">
                                <small style="color: #64748B; margin-top: 0.5rem; display: block;">Formati supportati: .xls, .xlsx</small>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-lg" style="width: 100%; padding: 1rem; font-size: 1.1rem;">
                                <i class="fas fa-cloud-upload-alt" style="margin-right: 0.75rem;"></i>
                                Importa Disdette
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('common.footer')
