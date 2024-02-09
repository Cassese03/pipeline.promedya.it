<?php $utente = session('utente'); ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pipeline | Promedya SRL</title>
    <link rel="icon" href="<?php echo URL::asset('img/ico.png') ?>">
    <link rel="shortcut icon" href="<?php echo URL::asset('logo_promedya.png') ?>">
    <link rel="apple-touch-icon" sizes="128x128" href="<?php echo URL::asset('img/icona.png') ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?php echo URL::asset('img/icona.png') ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo URL::asset('backend/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('backend/plugins/fullcalendar/main.css') ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
          href="<?php echo URL::asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

    <link rel="stylesheet" href="<?php echo URL::asset('backend/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet"
          href="<?php echo URL::asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('backend/plugins/daterangepicker/daterangepicker.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('backend/plugins/summernote/summernote-bs4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('backend/plugins/select2/css/select2.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('dist/css/skins/_all-skins.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <link rel="stylesheet" href="<?php echo URL::asset('backend/dist/css/print.min.css') ?>">
    <link rel="stylesheet"
          href="<?php echo URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.6/nv.d3.min.js">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo URL::asset('datetimepicker/css/bootstrap-datetimepicker.css') ?>">
    <link rel="stylesheet"
          href="<?php echo URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
    <link href="<?php echo URL::asset('fullcalendar-5.6.0/lib/main.css') ?>" rel='stylesheet'/>
    <script src="<?php echo URL::asset('fullcalendar-5.6.0/lib/main.js') ?>"></script>
    <script src="<?php echo URL::asset('fullcalendar-5.6.0/lib/locales-all.js') ?>"></script>
    <script src="<?php echo URL::asset('backend/plugins/jquery/jquery.min.js') ?>"></script>

    <style>
        .scroll {
            width: 1px;
            height: 1px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .charts-css.legend li:nth-child(10n+1)::before {
            background-color: lightyellow;
        }

        .charts-css.legend li:nth-child(10n+2)::before {
            background-color: #ff6666;
        }

        .charts-css.legend li:nth-child(10n+3)::before {
            background-color: lightgreen;
        }

        .charts-css.legend li {
            margin: 2%;
        }

        .charts-css:not(.legend-inline) {
            flex-direction: row;
        }

        .charts-css.legend {
            border: transparent;
        }

        .dataTables_length {
            float: left;
            margin-right: 10px;
        }

        .dt-buttons {
            float: left;
        }

        .dt-button {
            background-color: #00a65a;
            border-radius: 3px;
            color: white;
            border: 0;
            padding: 5px 10px;
            box-shadow: 1px 1px 1px #aaa;
        }

        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 150%;
            left: 50%;
            margin-left: -60px;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: black transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #3c8dbc;
        }

        .skin-blue .main-header .navbar {
            background-color: #222d32;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: lightblue !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            background: blue !important;
        }

    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse" id="body">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-dark">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">

            <img src="<?php echo URL::asset('logo_promedya.png') ?>"
                 style="width:100%;height:auto;margin:0 auto;display:block;padding:20px">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="<?php echo URL::asset('login') ?>" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p> Login</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>


    <div
        style="position: fixed;top: 0px;left: 0px;width: 100%;height: 100%;background: rgba(255, 255, 255,1);z-index: 1000000000;display: none;"
        id="ajax_loader">
        <img src="<?php echo URL::asset('logo_promedya.png') ?>"
             style="width:100px; margin:250px auto 0 auto;display:block">
    </div>


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
        <div style="display: flex;justify-content: center;align-items: center;">

            <pre><br/>    Cookie policy per pipeline.promedya.it<br/>    Uso dei cookie<br/>    L ' "APP" utilizza i Cookie per rendere i propri servizi semplici e efficienti per l&rsquo;utenza che visiona le pagine di promedya.salesforce.Gli utenti che visionano il Sito, vedranno inserite delle quantit&agrave; minime di informazioni nei dispositivi in uso, che siano computer e periferiche mobili, in piccoli file di testo denominati &ldquo;cookie&rdquo; salvati nelle directory utilizzate dal browser web dell&rsquo;Utente.Vi sono vari tipi di cookie, alcuni per rendere pi&ugrave; efficace l&rsquo;uso del Sito, altri per abilitare determinate funzionalit&agrave;.<br/><br/>    Analizzandoli in maniera particolareggiata i nostri cookie permettono di:<br/><br/>    memorizzare le preferenze inserite;<br/>    evitare di reinserire le stesse informazioni pi&ugrave; volte durante la visita quali ad esempio nome utente e password;<br/>    analizzare l&rsquo;utilizzo dei servizi e dei contenuti forniti da promedya.salesforce per ottimizzarne l&rsquo;esperienza di navigazione e i servizi offerti.<br/>    Tipologie di Cookie<br/>    Cookie tecnici<br/>    Questa tipologia di cookie permette il corretto funzionamento di alcune sezioni del Sito. Sono di due categorie: persistenti e di sessione:<br/><br/>    persistenti: una volta chiuso il browser non vengono distrutti ma rimangono fino ad una data di scadenza preimpostata<br/>    di sessione: vengono distrutti ogni volta che il browser viene chiuso<br/>    Questi cookie, inviati sempre dal nostro dominio, sono necessari a visualizzare correttamente il sito e in relazione ai servizi tecnici offerti, verranno quindi sempre utilizzati e inviati, a meno che l&rsquo;utenza non modifichi le impostazioni nel proprio browser (inficiando cos&igrave; la visualizzazione delle pagine del sito).<br/><br/>    Cookie analitici<br/>    I cookie in questa categoria vengono utilizzati per collezionare informazioni sull&rsquo;uso del sito. Promedya.salesforce user&agrave; queste informazioni in merito ad analisi statistiche anonime al fine di migliorare l&rsquo;utilizzo del Sito e per rendere i contenuti pi&ugrave; interessanti e attinenti ai desideri dell&rsquo;utenza. Questa tipologia di cookie raccoglie dati in forma anonima sull&rsquo;attivit&agrave; dell&rsquo;utenza e su come &egrave; arrivata sul Sito. I cookie analitici sono inviati dal Sito Stesso o da domini di terze parti.<br/><br/>    Cookie di analisi di servizi di terze parti<br/>    Questi cookie sono utilizzati al fine di raccogliere informazioni sull&rsquo;uso del Sito da parte degli utenti in forma anonima quali: pagine visitate, tempo di permanenza, origini del traffico di provenienza, provenienza geografica, et&agrave;, genere e interessi ai fini di campagne di marketing. Questi cookie sono inviati da domini di terze parti esterni al Sito.<br/><br/>    Cookie per integrare prodotti e funzioni di software di terze parti<br/>    Questa tipologia di cookie integra funzionalit&agrave; sviluppate da terzi all&rsquo;interno delle pagine del Sito come le icone e le preferenze espresse nei social network al fine di condivisione dei contenuti del sito o per l&rsquo;uso di servizi software di terze parti (come i software per generare le mappe e ulteriori software che offrono servizi aggiuntivi). Questi cookie sono inviati da domini di terze parti e da siti partner che offrono le loro funzionalit&agrave; tra le pagine del Sito.<br/><br/>    Cookie di profilazione<br/>    Sono quei cookie necessari a creare profili utenti al fine di inviare messaggi pubblicitari in linea con le preferenze manifestate dall&rsquo;utente all&rsquo;interno delle pagine del Sito.<br/><br/>    Promedya.salesforce, secondo la normativa vigente, non &egrave; tenuto a chiedere consenso per i cookie tecnici e di analytics, in quanto necessari a fornire i servizi richiesti.<br/><br/>    Per tutte le altre tipologie di cookie il consenso pu&ograve; essere espresso dall&rsquo;Utente con una o pi&ugrave; di una delle seguenti modalit&agrave;:<br/><br/>    Mediante specifiche configurazioni del browser utilizzato o dei relativi programmi informatici utilizzati per navigare le pagine che compongono il Sito.<br/>    Mediante modifica delle impostazioni nell&rsquo;uso dei servizi di terze parti<br/>    Entrambe queste soluzioni potrebbero impedire all&rsquo;utente di utilizzare o visualizzare parti del Sito.<br/><br/>    Siti Web e servizi di terze parti<br/>    Il Sito potrebbe contenere collegamenti ad altri siti Web che dispongono di una propria informativa sulla privacy che pu&ograve; essere diversa da quella adottata da promedya.salesforce che quindi non risponde di questi siti.<br/><br/>    Ultimo aggiornamento 26/01/2024<br/><br/><br/><br/>    Come disabilitare i cookie mediante configurazione del browser<br/>    Se desideri approfondire le modalit&agrave; con cui il tuo browser memorizza i cookies durante la tua navigazione, ti invitiamo a seguire questi link sui siti dei rispettivi fornitori.<br/><br/>    Mozilla Firefox https://support.mozilla.org/it/kb/Gestione%20dei%20cookie<br/>    Google Chrome   https://support.google.com/chrome/answer/95647?hl=it<br/>    Internet Explorer   http://windows.microsoft.com/it-it/windows-vista/block-or-allow-cookies<br/>    Safari 6/7 Mavericks    https://support.apple.com/kb/PH17191?viewlocale=it_IT&amp;locale=it_IT<br/>    Safari 8 Yosemite   https://support.apple.com/kb/PH19214?viewlocale=it_IT&amp;locale=it_IT<br/>    Safari su iPhone, iPad, o iPod touch    https://support.apple.com/it-it/HT201265<br/>    Nel caso in cui il tuo browser non sia presente all'interno di questo elenco puoi richiedere maggiori informazioni inviando una email all'indirizzo info@nibirumail.com. Provvederemo a fornirti le informazioni necessarie per una navigazione anonima e sicura.<br/><br/>    Questa pagina &egrave; stata generata ed &egrave; ospitata sul portale nibirumail.com - Il contenuto di questa pagina &egrave; stato generato attraverso il servizio Cookie Policy Generator. Il marchio Nibirumail e le aziende ad esso collegate non sono responsabili per informazioni erronee o non pi&ugrave; aggiornate. Se desideri ricevere una versione aggiornata di questi contenuti contatta il proprietario di dalla pagina precedente.&lt;/div&gt;</pre>
        </div>
        <!-- Comments are visible in the HTML source only -->
    </div>
    <!-- /.container-fluid-->


@include('common.footer')
