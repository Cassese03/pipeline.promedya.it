<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pipeline | Promedya SRL</title>
    <link rel="icon" href="<?php echo URL::asset('img/ico.png') ?>">
    <link rel="shortcut icon" href="<?php echo URL::asset('logo_promedya.png') ?>">
    <link rel="apple-touch-icon" sizes="128x128" href="<?php echo URL::asset('img/icona.png') ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?php echo URL::asset('img/icona.png') ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Fonts - Modern Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

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
    <link rel="stylesheet" href="<?php echo URL::asset('datetimepicker/css/bootstrap-datetimepicker.css') ?>">
    <link rel="stylesheet"
          href="<?php echo URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
    <link href="<?php echo URL::asset('fullcalendar-5.6.0/lib/main.css') ?>" rel='stylesheet'/>

    <!-- Custom Modern Design System -->
    <link rel="stylesheet" href="<?php echo URL::asset('css/custom-design.css') ?>">

    <script src="<?php echo URL::asset('fullcalendar-5.6.0/lib/main.js') ?>"></script>
    <script src="<?php echo URL::asset('fullcalendar-5.6.0/lib/locales-all.js') ?>"></script>
    <script src="<?php echo URL::asset('backend/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <style>
        @media only screen and (min-width: 700px) {

            .telefonino {
                display: none!important;
            }
        }

        @media only screen and (max-width: 700px) {
            .large_device {
                display: none !important;
            }
        }

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
        .form-control {
            font-size: 0.8rem!important;
            height: auto!important;
            padding: 0.375rem 0.75rem!important;
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

            <div class="brand-logo-container">
                <img src="<?php echo URL::asset('logo_promedya.png') ?>"
                     alt="Promedya Logo"
                     class="brand-logo">
            </div>

            <div class="user-panel" style="margin-top:10px; text-align: center;">
                <div class="image" style="display: inline-block; float: none;">
                    <img src="<?php echo URL::asset($utente->immagine) ?>" style="border-radius: 0;" class="img-circle"
                         alt="">
                </div>
                <div class="info" style="display: inline-block; float: none;">
                    <p>{{ $utente->nome.' '.$utente->cognome }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?php echo URL::asset('pipeline') ?>" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Agenzia</p>
                        </a>
                    </li>

                    @if ($utente->username == 'Giovanni Tutino' || $utente->username == 'Francesco Napolitano')
                    <li class="nav-item">
                        <a href="<?php echo URL::asset('concessionario') ?>" class="nav-link">
                            <i class="nav-icon fas fa-pen-nib"></i>
                            <p>Concessionario</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="<?php echo URL::asset('disdette') ?>" class="nav-link">
                            <i class="nav-icon fas fa-phone"></i>
                            <p>Gestione Disdette</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo URL::asset('') ?>" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Statistiche (KPI)</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo URL::asset('budget') ?>" class="nav-link">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>Budget</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo URL::asset('budget_annuale/'.date('Y',strtotime('now'))) ?>" class="nav-link">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>Budget Storico</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a class="nav-link" href="javascript:void(0)">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>Tabelle</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('dipendenti') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-user-check"></i>
                                    <p>Dipendenti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('motivazione') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-circle-notch"></i>
                                    <p>Motivazioni</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('esito') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-check"></i>
                                    <p>Esito Trattativa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('incentivi') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chart-area"></i>
                                    <p>Incentivi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('opening') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Opening</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('prodotti') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>Prodotti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('categoria') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-ad"></i>
                                    <p>Categoria</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('segnalato') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-exclamation"></i>
                                    <p>Segnalato</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('operatori') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Sales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('mail') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-envelope"></i>
                                    <p>Mail</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a class="nav-link" href="javascript:void(0)">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>Servizi</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo URL::asset('import-disdette') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-file-excel"></i>
                                    <p>Import Excel Disdette</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if ($utente->username != 'Generoso Pelosi' && $utente->username != 'Francesco Sanseverino')
                    <li class="nav-item">
                        <a href="https://provvigioni.promedya.it" class="nav-link">
                            <i class="nav-icon fas fa-euro-sign"></i>
                            <p>Provvigioni</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="<?php echo URL::asset('info') ?>" class="nav-link">
                            <i class="nav-icon fas fa-info"></i>
                            <p>Info</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo URL::asset('logout') ?>" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p> Logout</p>
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

