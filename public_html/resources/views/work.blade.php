<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Work in Progress
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>

    <div style="display: flex;justify-content: center;align-items: center;margin-top: 5rem;">
        <div class="card" style="max-width: 600px; text-align: center;">
            <div class="card-body" style="padding: 3rem;">
                <i class="fas fa-tools" style="font-size: 4rem; color: #4366F6; margin-bottom: 1.5rem;"></i>
                <h2 style="color: #1E293B; margin-bottom: 1rem;">Sezione in Sviluppo</h2>
                <p style="color: #64748B; font-size: 1.1rem;">Questa funzionalità sarà disponibile a breve.</p>
            </div>
        </div>
    </div>
</div>

@include('common.footer')
