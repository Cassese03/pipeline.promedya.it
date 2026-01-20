<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Informazioni Sistema
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>

    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        <div class="row">
            <div class="col-xl-3 col-md-2"></div>
            <div class="col-xl-6 col-md-8">
                <div class="card animate-fadeIn">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>Dettagli Sistema</h3>
                    </div>
                    <div class="card-body">
                        <div style="text-align: center; margin-bottom: 2rem;">
                            <img style="width: 50%; height: auto;" src="<?php echo URL::asset('logo_softmaint.jpg') ?>" alt="LOGO">
                        </div>
                        
                        <div class="info-section" style="margin-bottom: 1.5rem;">
                            <h4 style="color: #EF4444; font-weight: 600; margin-bottom: 1rem;">Smart Sales Force</h4>
                            <div style="padding-left: 1rem;">
                                <p style="margin: 0.5rem 0; color: #4366F6;"><strong>Versione:</strong> GT.389.25</p>
                                <p style="margin: 0.5rem 0; color: #4366F6;"><strong>Piattaforma:</strong> WEB</p>
                                <p style="margin: 0.5rem 0; color: #4366F6; cursor: pointer;" onclick="top.location.href = 'https://softmaint.it'">
                                    <strong>Copyright:</strong> Softmaint SRL - IT 07374571219
                                </p>
                            </div>
                        </div>
                        
                        <div class="info-section">
                            <h4 style="color: #EF4444; font-weight: 600; margin-bottom: 1rem;">Informazioni Licenza</h4>
                            <div style="padding-left: 1rem;">
                                <p style="margin: 0.5rem 0; color: #4366F6;"><strong>Utente:</strong> Promedya SRL - IT 03144930645</p>
                                <p style="margin: 0.5rem 0; color: #4366F6;"><strong>Numero Licenza:</strong> 00124</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-2"></div>
        </div>
    </section>
</div>

@include('common.footer')
