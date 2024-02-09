<?php $utente = session('utente'); ?>
@include('common.header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PROMEDYA Sales Force
            <small>&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
        <br>
    </section>
    <!-- Main content -->

    <div class="row">
        <div class="col-xl-4 col-2"></div>
        <div class="col-xl-4 col-8" style="display: flex;justify-content: center;flex-direction:column;">
            <a class="nav-link"
               style="font-size: 1.10rem;color:blue;display:flex;justify-content:center;align-content:center;">
                <img style="display:block;height: auto;width: 50%;justify-content:center"
                     src="<?php echo URL::asset('logo_softmaint.jpg') ?>" alt="LOGO">
            </a>
            <a class="nav-link"
               style="font-size: 1.10rem;color:blue;display:flex;justify-content:center;align-content:center;">
                <p>Copyright : Softmaint SRL</p>
            </a>
            <a class="nav-link"
               style="font-size: 1.10rem;color:blue;display:flex;justify-content:center;align-content:center;">
                <p>Prodotto : SALES FORCE</p>
            </a>
            <a class="nav-link"
               style="font-size: 1.10rem;color:blue;display:flex;justify-content:center;align-content:center;">
                <p>Versione : GT.321.24</p>
            </a>
            <a class="nav-link"
               style="font-size: 1.10rem;color:blue;display:flex;justify-content:center;align-content:center;">
                <p>Manuale : Sales Force GT 3231 24</p>
            </a>
            <a class="btn btn-primary" onclick="window.open('<?php echo URL::ASSET('ManualeSalesForceGT32124.pdf')?>')"
               style="width: 100%;justify-content: center">Download</a>
        </div>
        <div class="col-xl-4 col-2"></div>
    </div>
</div>
<!-- /.container-fluid-->


@include('common.footer')
