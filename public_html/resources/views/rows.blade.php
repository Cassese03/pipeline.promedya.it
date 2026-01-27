<?php $utente = session('utente'); ?>
@include('common.header')
<style>
    .action-btn {
        padding: 0.55rem 0.85rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: none;
        color: #fff !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.12s ease, box-shadow 0.12s ease;
        will-change: transform;
        transform: translateZ(0);
    }

    .action-btn i {
        color: #fff !important;
    }

    .action-btn:hover {
        transform: translateY(-1px) translateZ(0);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .action-btn:active {
        transform: translateY(0) translateZ(0);
    }

    .action-btn--edit {
        background: #4f46e5;
    }

    .action-btn--duplicate {
        background: #f59e0b;
    }

    .action-btn--delete {
        background: #ef4444;
    }

    .header-btn {
        padding: 0.75rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.15s ease;
        transform: translateZ(0);
    }

    .header-btn:hover {
        transform: translateY(-2px) translateZ(0);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .header-btn--primary {
        background: #4f46e5;
        color: white;
    }

    .header-btn--filter {
        background: #ef4444;
        color: white;
    }

    .text-gradient {
        color: #4f46e5;
    }

    .modern-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
        overflow: hidden;
        contain: layout style paint;
    }

    .legend-modern {
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        display: flex;
        gap: 2rem;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .legend-modern li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
        color: #374151;
    }

    .legend-modern li::before {
        content: '';
        width: 12px;
        height: 12px;
        border-radius: 3px;
        display: inline-block;
    }

    .legend-modern li:nth-child(1)::before {
        background: #fef08a;
    }

    .legend-modern li:nth-child(2)::before {
        background: #ff6666;
    }

    .legend-modern li:nth-child(3)::before {
        background: #90ee90;
    }

    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        will-change: transform;
    }

    .modal-header {
        background: #4f46e5;
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 1.5rem;
        border: none;
    }

    .modal-header .modal-title {
        font-weight: 600;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color:white!important;
    }

    .modal-header .close {
        color: white;
        opacity: 0.9;
        text-shadow: none;
        font-size: 1.8rem;
        font-weight: 300;
    }

    .modal-header .close:hover {
        opacity: 1;
        color: white;
    }

    .modal-body {
        padding: 2rem;
        background: #f9fafb;
    }

    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid #e5e7eb;
        background: white;
        border-radius: 0 0 20px 20px;
    }

    /* Classi per ottimizzare larghezza colonne */
    .col-narrow-xs {
        width: 100px !important;
        max-width: 100px !important;
        min-width: 100px !important;
    }

    .col-narrow-sm {
        width: 130px !important;
        max-width: 130px !important;
        min-width: 130px !important;
    }

    .col-narrow-md {
        width: 160px !important;
        max-width: 160px !important;
        min-width: 160px !important;
    }

    .filter-form-group {
        margin-bottom: 1.5rem;
    }

    .filter-form-group label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.95rem;
    }

    .filter-form-group .form-control,
    .filter-form-group select {
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
        background: white;
        color: #1f2937;
        font-size: 0.95rem;
        font-weight: 500;
        min-height: 48px;
        line-height: 1.5;
        height: auto;
    }

    .filter-form-group .form-control::placeholder {
        color: #9ca3af;
        font-weight: 400;
    }

    .filter-form-group .form-control:focus,
    .filter-form-group select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        outline: none;
        background: white;
    }

    .filter-form-group select option {
        color: #1f2937;
        background: white;
        padding: 0.5rem;
    }

    .filter-form-group input[type="date"] {
        color: #1f2937;
    }

    .filter-accumulated {
        display: flex;
        gap: 0.5rem;
        align-items: stretch;
        position: relative;
    }

    .filter-accumulated select {
        flex: 0 0 40%;
    }

    .filter-accumulated input[type="text"] {
        flex: 1;
        background: #f3f4f6;
        font-weight: 600;
        color: #1f2937;
    }

    .filter-accumulated input[type="text"]:read-only {
        cursor: not-allowed;
        opacity: 0.8;
    }

    .custom-dropdown {
        position: relative;
        flex: 1;
    }

    .dropdown-trigger {
        width: 100%;
        padding: 0.75rem 1rem;
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        text-align: left;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.2s;
    }

    .dropdown-trigger:hover {
        border-color: #4f46e5;
    }

    .dropdown-trigger i {
        transition: transform 0.3s;
    }

    .dropdown-trigger.open i {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        right: auto;
        min-width: 500px;
        background: white;
        border: 2px solid #4f46e5;
        border-radius: 10px;
        margin-top: 0.25rem;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: none;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-item {
        padding: 0.75rem 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: background 0.2s;
    }

    .dropdown-item:hover {
        background: #f3f4f6;
    }

    .dropdown-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #4f46e5;
    }

    .dropdown-item label {
        margin: 0;
        cursor: pointer;
        flex: 1;
        font-weight: 500;
    }

    .dropdown-actions {
        padding: 0.5rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 0.5rem;
        background: #f9fafb;
    }

    .dropdown-actions button {
        flex: 1;
        padding: 0.5rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-apply {
        background: #4f46e5;
        color: white;
    }

    .btn-apply:hover {
        background: #4338ca;
    }

    .btn-cancel {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-cancel:hover {
        background: #d1d5db;
    }

    .filter-toggle {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .filter-toggle input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #ef4444;
    }

    .filter-toggle label {
        margin: 0;
        cursor: pointer;
        font-weight: 500;
        color: #ef4444;
    }

    .btn-clear-filter {
        padding: 0.5rem 1rem;
        background: #6b7280;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-clear-filter:hover {
        background: #4b5563;
    }

    .modal-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        border: none;
        transition: transform 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transform: translateZ(0);
    }

    .modal-btn--primary {
        background: #4f46e5;
        color: white;
        box-shadow: 0 2px 6px rgba(79, 70, 229, 0.2);
        cursor: pointer;
    }

    .modal-btn--primary:hover {
        transform: translateY(-2px) translateZ(0);
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
        color: white;
    }

    .modal-btn--primary:active {
        transform: translateY(0) translateZ(0);
    }

    .modal-btn--secondary {
        background: #f3f4f6;
        color: #374151;
        border: 2px solid #e5e7eb;
        cursor: pointer;
    }

    .modal-btn--secondary:hover {
        background: #e5e7eb;
        transform: translateY(-1px) translateZ(0);
        color: #1f2937;
    }

    .modal-btn--secondary:active {
        transform: translateY(0) translateZ(0);
    }

    .date-range-container {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .date-range-container input {
        flex: 1;
    }

    .date-range-separator {
        color: #9ca3af;
        font-weight: 600;
    }

    .checkbox-cell {
        width: 50px;
        text-align: center;
        vertical-align: middle;
    }

    .row-checkbox {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #4f46e5;
    }

    .selection-bar {
        position: fixed;
        top: 80px;
        right: 20px;
        background: #4f46e5;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        z-index: 9999;
        display: none;
        align-items: center;
        gap: 1rem;
        animation: slideInRight 0.3s ease;
        will-change: transform;
        transform: translateZ(0);
    }

    .selection-bar.active {
        display: flex;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .selection-bar-text {
        font-weight: 600;
        font-size: 1rem;
    }

    .selection-bar-count {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-weight: 700;
    }

    .selection-bar-btn {
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transform: translateZ(0);
    }

    .selection-bar-btn--delete {
        background: #ef4444;
        color: white;
    }

    .selection-bar-btn--delete:hover {
        background: #dc2626;
        transform: scale(1.05) translateZ(0);
    }

    .selection-bar-btn--cancel {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .selection-bar-btn--cancel:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 1rem;">
            Smart Sales Force | Agenzia
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b
                    id="countdown"></b></small>
        </h1>
        <div style="display: flex; gap: 1rem; margin-top: 1rem; flex-wrap: wrap;">
            <button class="header-btn header-btn--primary" id="aggiungi_pipeline" onclick="aggiungi()"
                    name="aggiungi_pipeline">
                <i class="fas fa-plus"></i>
                Aggiungi Nuovo Contatto
            </button>
            <button class="header-btn header-btn--filter" id="filtra_pipeline" onclick="filtra()"
                    name="filtra_pipeline">
                <i class="fas fa-filter"></i>
                Filtri / Ricerca
            </button>
            @if(isset($filtersActive) && $filtersActive)
            <button class="header-btn" id="clear_filters" onclick="window.location.href='/pipeline'"
                    style="background: #f59e0b; color: white;">
                <i class="fas fa-times-circle"></i>
                Togli Filtri
            </button>
            @endif
        </div>
    </section>
    <!-- Main content -->
    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        <div style="margin: 0 auto; max-width: 100%;">
            <div class="legend-modern">
                <li>In Corso</li>
                <li>Persa</li>
                <li>Vinta</li>
            </div>

            <div class="modern-card">
                <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                    <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">
                        <i class="fas fa-chart-line" style="margin-right: 0.5rem; color: #4f46e5;"></i>
                        Pipeline Vendite
                    </h3>
                </div>
                <div style="overflow-x: auto;">
                    <table id="example11" class="table table-bordered datatable"
                           style="border-color: #e5e7eb; border-width:1px; margin: 0;">
                        <thead>
                        <tr>
                            <?php foreach ($column as $c){ ?>
                            <th class="no-sort
                                <?php 
                                    // Colonne strette per valori piccoli
                                    if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo ' col-narrow-xs';
                                    if ($c->COLUMN_NAME == 'Segnalato') echo ' col-narrow-sm';
                                    if ($c->COLUMN_NAME == 'Vinta') echo ' col-narrow-md';
                                    if ($c->COLUMN_NAME == 'Data_Probabile_Chiusura' || $c->COLUMN_NAME == 'Data_Contatto') echo ' col-narrow-md';
                                    if ($c->COLUMN_NAME == 'Vendita_Budget' || $c->COLUMN_NAME == 'Inc_Canone_AS' || $c->COLUMN_NAME == 'Inc_Anno_Solare') echo ' col-narrow-md';
                                ?>"
                                style="text-align: center; background: #dbeafe; font-weight: 600; color: #1e40af; border-color: #e5e7eb; border-width:1px; padding: 0.75rem 0.5rem; word-wrap: break-word; vertical-align: middle; line-height: 1.3;">
                                    <?php if ($c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Inc_Canone_AS' && $c->COLUMN_NAME != 'Inc_Anno_Solare' && $c->COLUMN_NAME != 'Probabilita_Chiusura') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                    <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'Valore Vendita A/C'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone A/C'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Vinta') echo 'Trattativa'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Inc_Canone_AS') echo 'Incremento Canone A/S'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Inc_Anno_Solare') echo 'Incremento Anno Solare'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo 'Prob. Chiusura%'; ?>
                            </th>
                            <?php } ?>
                            <th class="no-sort checkbox-cell"
                                style="text-align: center; background: #dbeafe; font-weight: 600; color: #1e40af; border-color: #e5e7eb; border-width:1px; padding: 1rem 0.75rem;">
                                <input type="checkbox" id="selectAll" class="row-checkbox"
                                       title="Seleziona/Deseleziona tutto">
                            </th>
                            <th class="no-sort"
                                style="text-align: center; background: #dbeafe; font-weight: 600; color: #1e40af; border-color: #e5e7eb; border-width:1px; padding: 1rem 0.75rem; white-space: nowrap;">
                                Azioni
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $r){ ?>
                        <tr style="background: <?php if($r->Vinta == 2) echo 'lightgreen'; if($r->Vinta == 1) echo '#ff6666'; if($r->Vinta != 1 && $r->Vinta != 2) echo 'lightyellow';?>;"
                            data-row-id="<?php echo $r->Id; ?>">
                                <?php foreach ($column as $c){ ?>

                                <?php
                                if ($c->COLUMN_NAME == 'Val_Ven_AC') {
                                    if (isset(${$c->COLUMN_NAME}))
                                        ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                    else
                                        ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                }
                                if ($c->COLUMN_NAME == 'Val_Can_AC') {
                                    if (isset(${$c->COLUMN_NAME}))
                                        ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                    else
                                        ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                }
                                if ($c->COLUMN_NAME == 'Vendita_Budget') {
                                    if (isset(${$c->COLUMN_NAME}))
                                        ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                    else
                                        ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                }
                                if ($c->COLUMN_NAME == 'Inc_Canone_AS') {
                                    if (isset(${$c->COLUMN_NAME}))
                                        ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                    else
                                        ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                }
                                if ($c->COLUMN_NAME == 'Inc_Anno_Solare') {
                                    if (isset(${$c->COLUMN_NAME}))
                                        ${$c->COLUMN_NAME} = ${$c->COLUMN_NAME} + floatval($r->{$c->COLUMN_NAME});
                                    else
                                        ${$c->COLUMN_NAME} = floatval($r->{$c->COLUMN_NAME});
                                } ?>

                            <td class="no-sort
                                <?php 
                                    // Colonne strette per valori piccoli
                                    if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo ' col-narrow-xs';
                                    if ($c->COLUMN_NAME == 'Segnalato') echo ' col-narrow-sm';
                                    if ($c->COLUMN_NAME == 'Vinta') echo ' col-narrow-md';
                                    if ($c->COLUMN_NAME == 'Data_Probabile_Chiusura' || $c->COLUMN_NAME == 'Data_Contatto') echo ' col-narrow-md';
                                    if ($c->COLUMN_NAME == 'Vendita_Budget' || $c->COLUMN_NAME == 'Inc_Canone_AS' || $c->COLUMN_NAME == 'Inc_Anno_Solare') echo ' col-narrow-md';
                                ?>" style="contain:content; padding: 0.75rem 0.5rem; word-wrap: break-word; vertical-align: middle; line-height: 1.4;
                                        <?php if(($c->DATA_TYPE == 'varchar') && $c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Id_Padre' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria') echo 'text-align:left;';
                                            if($c->DATA_TYPE=='int'||$c->DATA_TYPE=='float') echo 'text-align:right;' ;
                                            if($c->DATA_TYPE=='date') echo 'text-align:center;' ;
                                            if($c->COLUMN_NAME =='Vinta' || $c->COLUMN_NAME == 'Note') echo 'text-align:center;' ;?>
                                                border-color: #e5e7eb; border-width:1px">
                                    <?php if ($c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Note') {
                                    if (($c->DATA_TYPE == 'int' || $c->DATA_TYPE == 'float') and $c->COLUMN_NAME != 'Id' and $c->COLUMN_NAME != 'Id_Padre' and $c->COLUMN_NAME != 'Probabilita_Chiusura') echo number_format($r->{$c->COLUMN_NAME}, 2, '.', ''); else echo ($c->DATA_TYPE != 'date') ? $r->{$c->COLUMN_NAME} : date('d-m-Y', strtotime($r->{$c->COLUMN_NAME}));
                                } ?>
                                    <?php if ($c->COLUMN_NAME == 'Vinta') {

                                    foreach ($esito_trattativa as $e) {
                                        if ($r->{$c->COLUMN_NAME} == $e->id) echo $e->descrizione;
                                    }
                                } ?>
                                    <?php if ($c->COLUMN_NAME == 'Note' && ($r->{$c->COLUMN_NAME} != '')) { ?>
                                <button class="btn btn-sm"
                                        style="background: #6b7280; color: white; border: none; border-radius: 8px; padding: 0.4rem 1rem; font-weight: 500;"
                                        onclick="nota('<?php echo $r->Id; ?>');">
                                    <i class="fas fa-sticky-note" style="margin-right: 0.3rem;"></i>NOTA
                                </button>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') { ?>
                                <div class="progress-bar-label" style="text-align: center"><label
                                        style="font-weight: bold">
                                            <?php echo $r->{$c->COLUMN_NAME} . '%'; ?>
                                    </label>
                                </div>
                                <div class="progress"
                                     style="height: 7px;color: rgba(46, 204, 113,0.6);background-color: lightgray">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo $r->{$c->COLUMN_NAME};?>%;"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <?php } ?>

                            </td>
                            <?php } ?>
                            <td class="checkbox-cell"
                                style="border-color: #e5e7eb; border-width:1px; padding: 0.75rem; background: white;">
                                <input type="checkbox" class="row-checkbox row-select" data-id="<?php echo $r->Id; ?>">
                            </td>
                            <form enctype="multipart/form-data" method="post"
                                  onsubmit="return confirm('Sei sicuro di voler eliminare la riga selezionata?')">
                                @csrf
                                <td class="no-sort"
                                    style="background:white; border-color: #e5e7eb; border-width:1px; padding: 0.75rem;">
                                    <div style="display:flex;gap: 0.5rem; justify-content: center;">
                                        <button type="button" onclick="modifica(<?php echo $r->Id;?>)"
                                                class="btn action-btn action-btn--edit" title="Modifica">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" onclick="duplica(<?php echo $r->Id;?>)"
                                                class="btn action-btn action-btn--duplicate" title="Duplica">
                                            <i class="fas fa-clone"></i>
                                        </button>
                                        <button type="submit" name="elimina" value="<?php echo $r->Id;?>"
                                                class="btn action-btn action-btn--delete" title="Elimina">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr style="background: #dbeafe;">
                            <?php foreach ($column as $c){ ?>
                            <th class="no-sort"
                                style="<?php if(isset(${$c->COLUMN_NAME})) echo 'text-align:right; font-weight: 700;'?>border-color: #e5e7eb; border-width:1px; padding: 1rem 0.75rem; color: #1e40af;"><?php if (isset(${$c->COLUMN_NAME})) echo number_format(${$c->COLUMN_NAME}, 2, '.', ''); ?></th>
                            <?php } ?>
                            <th class="no-sort checkbox-cell" style="border-color: #e5e7eb; border-width:1px;"></th>
                            <th class="no-sort" style="border-color: #e5e7eb; border-width:1px"></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
</div>
</div>
</section>
<!-- /.content -->
</div>

<!-- Barra Selezione Multipla -->
<div class="selection-bar" id="selectionBar">
    <span class="selection-bar-text">Selezione Multipla attiva</span>
    <span class="selection-bar-count" id="selectedCount">0</span>
    <button class="selection-bar-btn selection-bar-btn--delete" onclick="deleteSelectedRows()">
        <i class="fas fa-trash"></i>
        Elimina Selezionate
    </button>
    <button class="selection-bar-btn selection-bar-btn--cancel" onclick="clearSelection()">
        <i class="fas fa-times"></i>
        Annulla
    </button>
</div>

<!-- Form per eliminazione multipla
<form id="deleteMultipleForm" method="post" action="/pipeline" style="display: none;">
    @csrf
<input type="hidden" name="elimina_multiple" id="deleteMultipleIds" value="">
</form> -->

@include('common.footer')

<form method="post" onsubmit="return confirm('Sei sicuro di voler aggiungere la nuova Lead?')"
      enctype="multipart/form-data" action="/pipeline">
    @csrf
    <div class="modal fade" id="modal_aggiungi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Inserimento Contatto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php foreach ($column as $c){
                        if ($c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Id_Padre' && $c->COLUMN_NAME != 'Probabilita_Chiusura'){ ?>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>
                                        <?php if ($c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Inc_Canone_AS' && $c->COLUMN_NAME != 'Inc_Anno_Solare') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                        <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'Valore Vendita A/C'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone A/C'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Vinta') echo 'Trattativa'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Inc_Canone_AS') echo 'Incremento Canone A/S'; ?>
                                        <?php if ($c->COLUMN_NAME == 'Inc_Anno_Solare') echo 'Incremento Anno Solare'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                    <b style="color:red">*</b></label>
                                    <?php if ($c->COLUMN_NAME != 'Note' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Motivazione' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Dipendente' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
                                <input
                                        <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Vendita_Budget') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Val_Ven_AC' || $c->COLUMN_NAME == 'Val_Can_AC' || $c->COLUMN_NAME == 'Vendita_Budget' || $c->COLUMN_NAME == 'Inc_Canone_AS' || $c->COLUMN_NAME == 'Inc_Anno_Solare') echo 'min="0"'; else if ($c->DATA_TYPE == 'float' || $c->DATA_TYPE == 'int') echo 'min="0"'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Ragione_Sociale') echo 'required'; ?>
                                    <?php if ($c->COLUMN_NAME == 'Prodotto') echo 'required'; ?>
                                    <?php if ($c->DATA_TYPE == 'varchar' && $c->COLUMN_NAME != 'Note') echo 'onKeyUp="converti(\'' . $c->COLUMN_NAME . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" step="0.01" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" step="1" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'date' && $c->COLUMN_NAME == 'Data_contatto') echo 'value="' . date('Y-m-d', strtotime('now')) . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'date') echo 'style="width:100%" class="form-control" type="date" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>>

                                <?php } ?>



                                    <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                        <?php foreach ($operatori as $o){ ?>
                                    <option value="{{$o->username}}" <?php if ($o->username == $utente->username) echo
                                    'selected'; ?> >{{$o->username}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Vinta') { ?>
                                <select style="width:100%" class="form-control aggiungi_vinta"
                                        onchange="check_vinta('aggiungi_vinta')"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                        <?php foreach ($esito_trattativa as $e){ ?>
                                    <option value="{{$e->id}}">{{$e->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Categoria') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    @foreach($categoria as $c1)
                                        <option value="{{ $c1->descrizione }}">{{ $c1->descrizione }}</option>
                                    @endforeach
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Tipo_Cliente') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                    <option value="OLD">OLD
                                    </option>
                                    <option value="LEAD">LEAD
                                    </option>
                                    <option value="RIENTRO">RIENTRO
                                    </option>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                                <select style="width:100%" class="form-control aggiungi_segnalato"
                                        onchange="check_segnalato('aggiungi_segnalato')"
                                        id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                        <?php foreach ($segnalato as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Motivazione') { ?>
                                <select style="width:100%" class="form-control aggiungi_motivazione" disabled="disabled"
                                        id="<?php echo $c->COLUMN_NAME;?>" name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                        <?php foreach ($motivazione as $m){ ?>
                                    <option value="{{$m->descrizione}}">{{$m->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Prodotto') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                        <?php foreach ($prodotto as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Dipendente') { ?>
                                <select style="width:100%" class="form-control aggiungi_dipendente" disabled="disabled"
                                        id="<?php echo $c->COLUMN_NAME;?>" name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="">Inserisci Valore...
                                    </option>
                                        <?php foreach ($dipendenti as $s){ ?>
                                    <option value="{{$s->descrizione}}">{{$s->descrizione}}</option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') { ?>
                                <select style="width:100%" class="form-control" id="<?php echo $c->COLUMN_NAME;?>"
                                        name="<?php echo $c->COLUMN_NAME ;?>">
                                    <option value="25">25
                                    </option>
                                    <option value="50">50
                                    </option>
                                    <option value="75">75
                                    </option>
                                    <option value="100">100
                                    </option>
                                </select>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Note') { ?>
                                <textarea rows="8" cols="100"
                                          onKeyUp="converti(<?php echo '\''. $c->COLUMN_NAME . '\'';?>)"
                                          class="form-control"
                                          type="text" id="<?php echo  $c->COLUMN_NAME ;?>"
                                          name="<?php echo  $c->COLUMN_NAME ;?>"></textarea>

                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
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

<form method="post" enctype="multipart/form-data" action="/pipeline">
    @csrf
    <div class="modal fade" id="modal_filtra">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">
                        <i class="fas fa-filter"></i>
                        Filtri di Ricerca
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php foreach ($column as $c){ ?>
                            <?php if ($c->COLUMN_NAME != 'Id' && $c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Vendita_Budget' && $c->COLUMN_NAME != 'Inc_Canone_AS' && $c->COLUMN_NAME != 'Inc_Anno_Solare' && $c->COLUMN_NAME != 'Note'){ ?>

                            <?php if ($c->COLUMN_NAME != 'Sales'){ ?>

                        <div class="col-md-6">
                            <div class="filter-form-group">
                                <label><?php if ($c->COLUMN_NAME != 'Val_Ven_AC' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Val_Can_AC' && $c->COLUMN_NAME != 'Inc_Canone_AS' && $c->COLUMN_NAME != 'Inc_Anno_Solare') echo str_replace('_', ' ', $c->COLUMN_NAME); ?>
                                           <?php if ($c->COLUMN_NAME == 'Val_Ven_AC') echo 'Valore Vendita A/C'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Val_Can_AC') echo 'Valore Canone A/C'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Vinta') echo 'Trattativa'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Inc_Canone_AS') echo 'Incremento Canone A/S'; ?>
                                           <?php if ($c->COLUMN_NAME == 'Inc_Anno_Solare') echo 'Incremento Anno Solare'; ?><?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') echo '%'; ?>
                                    <b
                                        style="color:red">*</b></label>
                                    <?php if ($c->COLUMN_NAME != 'Note' && $c->COLUMN_NAME != 'Ragione_Sociale' && $c->COLUMN_NAME != 'Sales' && $c->COLUMN_NAME != 'Vinta' && $c->COLUMN_NAME != 'Segnalato' && $c->COLUMN_NAME != 'Motivazione' && $c->COLUMN_NAME != 'Prodotto' && $c->COLUMN_NAME != 'Dipendente' && $c->DATA_TYPE != 'date' && $c->COLUMN_NAME != 'Probabilita_Chiusura' && $c->COLUMN_NAME != 'Categoria' && $c->COLUMN_NAME != 'Tipo_Cliente'){ ?>
                                <input
                                        <?php if ($c->DATA_TYPE == 'varchar') echo 'value="Nessun Filtro..." onKeyUp="converti(\'' . $c->COLUMN_NAME . '\')" style="width:100%" class="form-control" type="text" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'float') echo 'style="width:100%" class="form-control" type="number" min="0" step="0.01" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                    <?php if ($c->DATA_TYPE == 'int') echo 'style="width:100%" class="form-control" type="number" min="0" step="1" id="' . $c->COLUMN_NAME . '" name="' . $c->COLUMN_NAME . '"'; ?>
                                >


                                <?php } ?>
                                    <?php if ($c->DATA_TYPE == 'date'){ ?>
                                <div class="date-range-container">
                                    <input <?php echo 'class="form-control" type="date" id="' .
                                        $c->COLUMN_NAME . '_i" name="' . $c->COLUMN_NAME . '_i"'; ?>>
                                    <span class="date-range-separator">—</span>
                                    <input <?php echo 'class="form-control" type="date" id="' .
                                        $c->COLUMN_NAME . '_f" name="' . $c->COLUMN_NAME . '_f"'; ?>>
                                </div>

                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Ragione_Sociale') { ?>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Ragione_Sociale')">
                                            <span>Seleziona Cliente...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Ragione_Sociale">
                                            @php $rsIndex = 0; @endphp
                                            @foreach($clienti as $c1)
                                                @php $rsIndex++; @endphp
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="ragione_{{$rsIndex}}" value="{{$c1->Ragione_Sociale}}">
                                                    <label for="ragione_{{$rsIndex}}">{{$c1->Ragione_Sociale}}</label>
                                                </div>
                                            @endforeach
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Ragione_Sociale', 'Ragione_Sociale_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Ragione_Sociale')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Ragione_Sociale_values" name="Ragione_Sociale" placeholder="Selezioni" readonly value="{{ $appliedFilters['Ragione_Sociale'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Ragione_Sociale_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Ragione_Sociale" name="exclude_Ragione_Sociale" value="1" {{ isset($appliedFilters['exclude_Ragione_Sociale']) ? 'checked' : '' }}>
                                    <label for="exclude_Ragione_Sociale"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Vinta') { ?>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Vinta')">
                                            <span>Seleziona Trattativa...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Vinta">
                                            <?php foreach ($esito_trattativa as $e){ ?>
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="vinta_{{$e->id}}" value="{{$e->id}}">
                                                    <label for="vinta_{{$e->id}}">{{$e->descrizione}}</label>
                                                </div>
                                            <?php } ?>
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Vinta', 'Vinta_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Vinta')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Vinta_values" name="Vinta" placeholder="Selezioni" readonly>
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Vinta_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Vinta" name="exclude_Vinta" value="1">
                                    <label for="exclude_Vinta"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Segnalato') { ?>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Segnalato')">
                                            <span>Seleziona Segnalato...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Segnalato">
                                            <?php foreach ($segnalato as $s){ ?>
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="segnalato_{{$s->id}}" value="{{$s->descrizione}}">
                                                    <label for="segnalato_{{$s->id}}">{{$s->descrizione}}</label>
                                                </div>
                                            <?php } ?>
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Segnalato', 'Segnalato_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Segnalato')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Segnalato_values" name="Segnalato" placeholder="Selezioni" readonly value="{{ $appliedFilters['Segnalato'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Segnalato_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Segnalato" name="exclude_Segnalato" value="1" {{ isset($appliedFilters['exclude_Segnalato']) ? 'checked' : '' }}>
                                    <label for="exclude_Segnalato"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Motivazione') { ?>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Motivazione')">
                                            <span>Seleziona Motivazione...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Motivazione">
                                            <?php foreach ($motivazione as $m){ ?>
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="motivazione_{{$m->id}}" value="{{$m->descrizione}}">
                                                    <label for="motivazione_{{$m->id}}">{{$m->descrizione}}</label>
                                                </div>
                                            <?php } ?>
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Motivazione', 'Motivazione_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Motivazione')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Motivazione_values" name="Motivazione" placeholder="Selezioni" readonly value="{{ $appliedFilters['Motivazione'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Motivazione_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Motivazione" name="exclude_Motivazione" value="1" {{ isset($appliedFilters['exclude_Motivazione']) ? 'checked' : '' }}>
                                    <label for="exclude_Motivazione"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Prodotto') { ?>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Prodotto')">
                                            <span>Seleziona Prodotto...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Prodotto">
                                            <?php foreach ($prodotto as $s){ ?>
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="prodotto_{{$s->id}}" value="{{$s->descrizione}}">
                                                    <label for="prodotto_{{$s->id}}">{{$s->descrizione}}</label>
                                                </div>
                                            <?php } ?>
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Prodotto', 'Prodotto_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Prodotto')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Prodotto_values" name="Prodotto" placeholder="Selezioni" readonly value="{{ $appliedFilters['Prodotto'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Prodotto_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Prodotto" name="exclude_Prodotto" value="1" {{ isset($appliedFilters['exclude_Prodotto']) ? 'checked' : '' }}>
                                    <label for="exclude_Prodotto"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>

                                <?php } ?>

                                    <?php if ($c->COLUMN_NAME == 'Dipendente') { ?>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Dipendente')">
                                            <span>Seleziona Dipendente...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Dipendente">
                                            <?php foreach ($dipendenti as $s){ ?>
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="dipendente_{{$s->id}}" value="{{$s->descrizione}}">
                                                    <label for="dipendente_{{$s->id}}">{{$s->descrizione}}</label>
                                                </div>
                                            <?php } ?>
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Dipendente', 'Dipendente_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Dipendente')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Dipendente_values" name="Dipendente" placeholder="Selezioni" readonly value="{{ $appliedFilters['Dipendente'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Dipendente_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Dipendente" name="exclude_Dipendente" value="1" {{ isset($appliedFilters['exclude_Dipendente']) ? 'checked' : '' }}>
                                    <label for="exclude_Dipendente"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Tipo_Cliente') { ?>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Tipo_Cliente')">
                                            <span>Seleziona Tipo Cliente...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Tipo_Cliente">
                                            <div class="dropdown-item">
                                                <input type="checkbox" id="tipo_OLD" value="OLD">
                                                <label for="tipo_OLD">OLD</label>
                                            </div>
                                            <div class="dropdown-item">
                                                <input type="checkbox" id="tipo_LEAD" value="LEAD">
                                                <label for="tipo_LEAD">LEAD</label>
                                            </div>
                                            <div class="dropdown-item">
                                                <input type="checkbox" id="tipo_RIENTRO" value="RIENTRO">
                                                <label for="tipo_RIENTRO">RIENTRO</label>
                                            </div>
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Tipo_Cliente', 'Tipo_Cliente_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Tipo_Cliente')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Tipo_Cliente_values" name="Tipo_Cliente" placeholder="Selezioni" readonly value="{{ $appliedFilters['Tipo_Cliente'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Tipo_Cliente_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Tipo_Cliente" name="exclude_Tipo_Cliente" value="1" {{ isset($appliedFilters['exclude_Tipo_Cliente']) ? 'checked' : '' }}>
                                    <label for="exclude_Tipo_Cliente"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Categoria') { ?>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Categoria')">
                                            <span>Seleziona Categoria...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Categoria">
                                            @foreach($categoria as $c1)
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="categoria_{{ $c1->id }}" value="{{ $c1->descrizione }}">
                                                    <label for="categoria_{{ $c1->id }}">{{ $c1->descrizione }}</label>
                                                </div>
                                            @endforeach
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Categoria', 'Categoria_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Categoria')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Categoria_values" name="Categoria" placeholder="Selezioni" readonly value="{{ $appliedFilters['Categoria'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Categoria_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Categoria" name="exclude_Categoria" value="1" {{ isset($appliedFilters['exclude_Categoria']) ? 'checked' : '' }}>
                                    <label for="exclude_Categoria"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Probabilita_Chiusura') { ?>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Probabilita_Chiusura')">
                                            <span>Seleziona %...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Probabilita_Chiusura">
                                            <div class="dropdown-item">
                                                <input type="checkbox" id="prob_25" value="25">
                                                <label for="prob_25">25</label>
                                            </div>
                                            <div class="dropdown-item">
                                                <input type="checkbox" id="prob_50" value="50">
                                                <label for="prob_50">50</label>
                                            </div>
                                            <div class="dropdown-item">
                                                <input type="checkbox" id="prob_75" value="75">
                                                <label for="prob_75">75</label>
                                            </div>
                                            <div class="dropdown-item">
                                                <input type="checkbox" id="prob_100" value="100">
                                                <label for="prob_100">100</label>
                                            </div>
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Probabilita_Chiusura', 'Probabilita_Chiusura_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Probabilita_Chiusura')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Probabilita_Chiusura_values" name="Probabilita_Chiusura" placeholder="Selezioni" readonly value="{{ $appliedFilters['Probabilita_Chiusura'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Probabilita_Chiusura_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Probabilita_Chiusura" name="exclude_Probabilita_Chiusura" value="1" {{ isset($appliedFilters['exclude_Probabilita_Chiusura']) ? 'checked' : '' }}>
                                    <label for="exclude_Probabilita_Chiusura"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                                <?php } ?>
                                    <?php if ($c->COLUMN_NAME == 'Note') { ?>
                                <textarea rows="8" cols="100"
                                          onKeyUp="converti(<?php echo '\''. $c->COLUMN_NAME . '\'';?>)"
                                          class="form-control"
                                          type="text" id="<?php echo  $c->COLUMN_NAME ;?>"
                                          name="<?php echo  $c->COLUMN_NAME ;?>">Nessun Filtro...</textarea>

                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                            <?php if ($c->COLUMN_NAME == 'Sales') { ?>
                        <div class="col-md-6">
                            <div class="filter-form-group">
                                <label>Sales<b style="color:red">*</b></label>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Sales')">
                                            <span>Seleziona Sales...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Sales">
                                            <?php foreach ($operatori as $o){ ?>
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="sales_{{$o->id}}" value="{{$o->username}}">
                                                    <label for="sales_{{$o->id}}">{{$o->username}}</label>
                                                </div>
                                            <?php } ?>
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Sales', 'Sales_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Sales')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Sales_values" name="Sales" placeholder="Selezioni" readonly value="{{ $appliedFilters['Sales'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Sales_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Sales" name="exclude_Sales" value="1" {{ isset($appliedFilters['exclude_Sales']) ? 'checked' : '' }}>
                                    <label for="exclude_Sales"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                            </div>
                        </div>
                            <?php } ?>
                            <?php if ($c->COLUMN_NAME == 'Sales_GRUPPO') { ?>
                        <div class="col-md-6">
                            <div class="filter-form-group">
                                <label>Zona <b style="color:red">*</b></label>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_Sales_GRUPPO')">
                                            <span>Seleziona Zona...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_Sales_GRUPPO">
                                            <?php $zIndex = 0; foreach ($zone as $z){ $zIndex++; ?>
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="zona_{{$zIndex}}" value="{{$z->descrizione}}">
                                                    <label for="zona_{{$zIndex}}">{{$z->descrizione}}</label>
                                                </div>
                                            <?php } ?>
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_Sales_GRUPPO', 'Sales_GRUPPO_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_Sales_GRUPPO')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="Sales_GRUPPO_values" name="Sales_GRUPPO" placeholder="Selezioni" readonly value="{{ $appliedFilters['Sales_GRUPPO'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('Sales_GRUPPO_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_Sales_GRUPPO" name="exclude_Sales_GRUPPO" value="1" {{ isset($appliedFilters['exclude_Sales_GRUPPO']) ? 'checked' : '' }}>
                                    <label for="exclude_Sales_GRUPPO"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                            <?php if ($c->COLUMN_NAME == 'Prodotto'){ ?>
                        <div class="col-md-6">
                            <div class="filter-form-group">
                                <label>Gruppo Prodotto<b style="color:red">*</b></label>
                                <div class="filter-accumulated">
                                    <div class="custom-dropdown">
                                        <button type="button" class="dropdown-trigger" onclick="toggleCustomDropdown('dropdown_gruppo_prodotto')">
                                            <span>Seleziona Gruppo...</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown_gruppo_prodotto">
                                            @php $gIndex = 0; @endphp
                                            @foreach($gruppo as $g)
                                                @php $gIndex++; @endphp
                                                <div class="dropdown-item">
                                                    <input type="checkbox" id="gruppo_{{$gIndex}}" value="{{ $g->prodotti }}">
                                                    <label for="gruppo_{{$gIndex}}">{{$g->gruppo}}</label>
                                                </div>
                                            @endforeach
                                            <div class="dropdown-actions">
                                                <button type="button" class="btn-apply" onclick="applyCustomDropdown('dropdown_gruppo_prodotto', 'gruppo_prodotto_values')">
                                                    <i class="fas fa-check"></i> Applica
                                                </button>
                                                <button type="button" class="btn-cancel" onclick="cancelCustomDropdown('dropdown_gruppo_prodotto')">
                                                    <i class="fas fa-times"></i> Annulla
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="gruppo_prodotto_values" name="gruppo_prodotto" placeholder="Selezioni" readonly value="{{ $appliedFilters['gruppo_prodotto'] ?? '' }}">
                                    <button type="button" class="btn-clear-filter" onclick="clearFilter('gruppo_prodotto_values')" title="Pulisci"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="filter-toggle">
                                    <input type="checkbox" id="exclude_gruppo_prodotto" name="exclude_gruppo_prodotto" value="1" {{ isset($appliedFilters['exclude_gruppo_prodotto']) ? 'checked' : '' }}>
                                    <label for="exclude_gruppo_prodotto"><i class="fas fa-ban"></i> Escludi invece di includere</label>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>


                    </div>
                    <div class=" clearfix">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal-btn modal-btn--secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Chiudi
                    </button>
                    <button type="submit" class="modal-btn modal-btn--primary" value="filtra" name="filtra">
                        <i class="fas fa-search"></i>
                        Applica Filtri
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php foreach ($rows as $r){ ?>
<form method="post" enctype="multipart/form-data" action="/pipeline">
    @csrf
    <div class="modal fade" id="modal_modifica_<?php echo $r->Id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Modifica richiesta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_modifica_<?php echo $r->Id;?>').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="ajax_modifica_<?php echo $r->Id;?>"></div>
                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="Id" value="<?php echo $r->Id;?>">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" onclick="$('#modal_modifica_<?php echo $r->Id;?>').modal('hide');">Chiudi</button>
                    <input type="submit" class="btn btn-primary pull-right" name="modifica" value="modifica"
                           style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>
<form method="post" enctype="multipart/form-data" action="/pipeline">
    @csrf
    <div class="modal fade" id="modal_duplica_<?php echo $r->Id;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titolo_modal_mgmov">Duplica richiesta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_duplica_<?php echo $r->Id;?>').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="ajax_duplica_<?php echo $r->Id;?>"></div>
                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="Id_Padre" value="<?php echo $r->Id;?>">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" onclick="$('#modal_duplica_<?php echo $r->Id;?>').modal('hide');">Chiudi</button>
                    <input type="submit" class="btn btn-primary pull-right" name="duplica" value="Duplica"
                           style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>
<?php } ?>


<?php foreach ($rows as $r){ ?>
    <?php if ($r->Note != ''){ ?>
<div class="modal fade" id="modal_nota_<?php echo $r->Id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titolo_modal_mgmov">Nota Record
                        <?php echo $r->Id ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <?php echo $r->Note; ?>
                <div class=" clearfix">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>


<script type="text/javascript">
    function check_vinta(classname) {
        vinta = $('.' + classname).val();
        if (vinta == 1)
            $('.' + classname.replace('vinta', 'motivazione')).removeAttr('disabled');
        if (vinta != 1) {
            $('.' + classname.replace('vinta', 'motivazione')).attr('disabled', 'disabled');
        }
    }

    function check_segnalato(classname) {
        segnalato = $('.' + classname).val();
        if (segnalato == 'DIPENDENTE')
            $('.' + classname.replace('segnalato', 'dipendente')).removeAttr('disabled');
        if (segnalato != 'DIPENDENTE') {
            $('.' + classname.replace('segnalato', 'dipendente')).attr('disabled', 'disabled');
        }
    }

    function modifica_ajax(id) {
        // Mostra un loader minimale
        $('#ajax_modifica_' + id).html('<div style="text-align:center;padding:2rem;"><i class="fas fa-spinner fa-spin fa-2x" style="color:#4f46e5;"></i></div>');
        
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo URL::asset('ajax/modifica_ajax') ?>/' + id, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                $('#ajax_modifica_' + id).html(xhr.responseText);
            } else {
                console.error('Errore AJAX modifica:', xhr.status);
                alert('Errore nel caricamento dei dati');
            }
        };
        
        xhr.onerror = function() {
            console.error('Errore di rete AJAX modifica');
            alert('Errore nel caricamento dei dati');
        };
        
        xhr.send();
    }

    function duplica_ajax(id) {
        // Mostra un loader minimale
        $('#ajax_duplica_' + id).html('<div style="text-align:center;padding:2rem;"><i class="fas fa-spinner fa-spin fa-2x" style="color:#4f46e5;"></i></div>');
        
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo URL::asset('ajax/duplica_ajax') ?>/' + id, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                $('#ajax_duplica_' + id).html(xhr.responseText);
            } else {
                console.error('Errore AJAX duplica:', xhr.status);
                alert('Errore nel caricamento dei dati');
            }
        };
        
        xhr.onerror = function() {
            console.error('Errore di rete AJAX duplica');
            alert('Errore nel caricamento dei dati');
        };
        
        xhr.send();
    }

    function aggiungi() {
        $('#modal_aggiungi').modal('show');
    }

    function nota(id) {
        $('#modal_nota_' + id).modal('show');
    }

    function filtra() {
        $('#modal_filtra').modal('show');
    }

    function modifica(id) {
        modifica_ajax(id);
        $('#modal_modifica_' + id).modal('show');
    }

    function duplica(id) {
        duplica_ajax(id);
        $('#modal_duplica_' + id).modal('show');
    }

    function converti(id) {
        document.getElementById(id).value = document.getElementById(id).value.toUpperCase();
    }

    function chiudi(id) {
        $('#modal_chiudi_' + id).modal('show');
    }

    // Gestione Selezione Multipla
    $(document).ready(function () {
        const selectionBar = document.getElementById('selectionBar');
        const selectedCount = document.getElementById('selectedCount');
        const selectAll = document.getElementById('selectAll');

        // Funzione per accumulo filtri con dropdown custom
        window.toggleCustomDropdown = function(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const trigger = dropdown.previousElementSibling;
            const menu = dropdown;
            
            // Pre-seleziona checkbox in base al textfield
            const inputId = dropdownId.replace('dropdown_', '') + '_values';
            const input = document.getElementById(inputId);
            if (input && input.value) {
                const appliedValues = input.value.split(',').map(v => v.trim());
                const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(cb => {
                    cb.checked = appliedValues.includes(cb.value);
                });
            }
            
            menu.classList.toggle('show');
            trigger.classList.toggle('open');
            
            // Chiudi altri dropdown aperti
            document.querySelectorAll('.dropdown-menu.show').forEach(m => {
                if (m !== menu) {
                    m.classList.remove('show');
                    m.previousElementSibling.classList.remove('open');
                }
            });
        };

        window.applyCustomDropdown = function(dropdownId, inputId) {
            const checkboxes = document.querySelectorAll(`#${dropdownId} input[type="checkbox"]:checked`);
            const values = Array.from(checkboxes).map(cb => cb.value);
            const input = document.getElementById(inputId);
            
            input.value = values.join(', ');
            
            // Chiudi dropdown
            document.getElementById(dropdownId).classList.remove('show');
            document.getElementById(dropdownId).previousElementSibling.classList.remove('open');
        };

        window.cancelCustomDropdown = function(dropdownId) {
            document.getElementById(dropdownId).classList.remove('show');
            document.getElementById(dropdownId).previousElementSibling.classList.remove('open');
        };

        // Chiudi dropdown quando clicchi fuori
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-dropdown')) {
                document.querySelectorAll('.dropdown-menu.show').forEach(m => {
                    m.classList.remove('show');
                    if (m.previousElementSibling) {
                        m.previousElementSibling.classList.remove('open');
                    }
                });
            }
        });

        // Funzione per pulire un filtro
        window.clearFilter = function(inputId) {
            document.getElementById(inputId).value = '';
        };

        // Funzione per ottenere ID selezionati
        function getSelectedIds() {
            const checkboxes = document.querySelectorAll('.row-select:checked');
            return Array.from(checkboxes).map(cb => cb.dataset.id);
        }

        // Funzione per aggiornare UI
        function updateSelectionUI() {
            const selectedIds = getSelectedIds();
            const totalCheckboxes = document.querySelectorAll('.row-select').length;

            if (selectedIds.length > 0) {
                selectionBar.classList.add('active');
                selectedCount.textContent = selectedIds.length;
            } else {
                selectionBar.classList.remove('active');
            }

            // Aggiorna stato checkbox "seleziona tutto"
            selectAll.checked = totalCheckboxes > 0 && totalCheckboxes === selectedIds.length;
        }

        // Checkbox singolo - event delegation
        document.querySelector('tbody').addEventListener('change', function(e) {
            if (e.target.classList.contains('row-select')) {
                updateSelectionUI();
            }
        });

        // Seleziona/Deseleziona tutto
        selectAll.addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.row-select').forEach(cb => cb.checked = isChecked);
            updateSelectionUI();
        });

        // Funzione per eliminare righe selezionate
        window.deleteSelectedRows = function () {
            const currentSelectedIds = getSelectedIds();

            if (currentSelectedIds.length === 0) {
                alert('Nessuna riga selezionata!');
                return;
            }

            const message = `Sei sicuro di voler eliminare ${currentSelectedIds.length} ${currentSelectedIds.length === 1 ? 'riga' : 'righe'} selezionate?`;

            if (confirm(message)) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/ajax/elimina_multiple', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
                
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert('Errore: ' + response.message);
                        }
                    } else {
                        alert('Errore durante l\'eliminazione');
                    }
                };
                
                xhr.send(JSON.stringify({ids: currentSelectedIds}));
            }
        };

        // Funzione per annullare selezione
        window.clearSelection = function () {
            document.querySelectorAll('.row-select').forEach(cb => cb.checked = false);
            selectAll.checked = false;
            updateSelectionUI();
        };
    });
</script>
