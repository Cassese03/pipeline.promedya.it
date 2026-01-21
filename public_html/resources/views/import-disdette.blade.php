<?php $utente = session('utente'); ?>
@include('common.header')
<style>
    .text-gradient {
        background: linear-gradient(135deg, #4f46e5, #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .modern-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 3rem 2rem;
        text-align: center;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .upload-area:hover {
        border-color: #4f46e5;
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.15);
    }

    .upload-area.dragover {
        border-color: #4f46e5;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        border-width: 3px;
    }

    .upload-icon {
        font-size: 3.5rem;
        color: #4f46e5;
        margin-bottom: 1rem;
        display: block;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .upload-text {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .upload-hint {
        font-size: 0.875rem;
        color: #64748b;
    }

    .file-input-hidden {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        cursor: pointer;
    }

    .info-box {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border: 2px solid #3b82f6;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-box-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #3b82f6;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .submit-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 12px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        background: linear-gradient(135deg, #059669, #047857);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .file-selected {
        display: none;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1rem;
        border: 2px solid #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }

    .file-selected.show {
        display: flex;
        align-items: center;
        justify-content: space-between;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .file-icon {
        font-size: 2rem;
        color: #10b981;
        margin-right: 1rem;
    }

    .file-info {
        flex-grow: 1;
    }

    .file-name {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .file-size {
        font-size: 0.875rem;
        color: #64748b;
    }

    .remove-file {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        color: #dc2626;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .remove-file:hover {
        background: #fee2e2;
        border-color: #fca5a5;
    }
</style>

<div class="content-wrapper">
    <section class="content-header" style="padding: 1.5rem;">
        <h1 class="text-gradient" style="font-size: 2rem; font-weight: 600; margin-bottom: 0;">
            Importa Disdette da Excel
            <small style="display: block; margin-top: 0.5rem; color: #64748B; font-size: 1rem;">&nbsp;&nbsp;<b id="countdown"></b></small>
        </h1>
    </section>
    
    <section class="content" style="padding: 0 1.5rem 1.5rem;">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="modern-card">
                    <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                        <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">
                            <i class="fas fa-file-excel" style="margin-right: 0.5rem; color: #10b981;"></i>
                            Carica File Excel
                        </h3>
                    </div>
                    <div style="padding: 2.5rem;">
                        <div class="info-box">
                            <div style="display: flex; align-items: flex-start;">
                                <div class="info-box-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div>
                                    <h4 style="margin: 0 0 0.75rem 0; font-size: 1.1rem; font-weight: 600; color: #1e40af;">Istruzioni per l'importazione</h4>
                                    <ul style="margin: 0; padding-left: 1.25rem; color: #1e293b; line-height: 1.6;">
                                        <li>Carica un file Excel (.xls o .xlsx) contenente le disdette</li>
                                        <li>I dati verranno aggiunti automaticamente alla tabella</li>
                                        <li>Assicurati che il file rispetti il formato richiesto</li>
                                        <li>Puoi trascinare il file nell'area sottostante o cliccare per selezionarlo</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <?php if(session('success')): ?>
                            <div class="alert alert-success animate-fadeIn" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); border: 2px solid #10b981; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem;">
                                <div style="display: flex; align-items: center;">
                                    <i class="fas fa-check-circle" style="font-size: 1.5rem; color: #059669; margin-right: 1rem;"></i>
                                    <span style="color: #065f46; font-weight: 500;">{{ session('success') }}</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger animate-fadeIn" style="background: linear-gradient(135deg, #fee2e2, #fecaca); border: 2px solid #ef4444; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem;">
                                <div style="display: flex; align-items: center;">
                                    <i class="fas fa-exclamation-circle" style="font-size: 1.5rem; color: #dc2626; margin-right: 1rem;"></i>
                                    <span style="color: #991b1b; font-weight: 500;">{{ session('error') }}</span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form action="{{ route('import-disdette.post') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf
                            <div class="upload-area" id="uploadArea">
                                <input type="file" name="file" id="file" class="file-input-hidden" accept=".xls,.xlsx" required>
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <div class="upload-text">Trascina qui il file Excel</div>
                                <div class="upload-hint">oppure clicca per selezionarlo dal computer</div>
                                <small style="display: block; margin-top: 1rem; color: #64748b; font-weight: 500;">
                                    <i class="fas fa-file-excel" style="margin-right: 0.25rem; color: #10b981;"></i>
                                    Formati supportati: .xls, .xlsx
                                </small>
                            </div>

                            <div class="file-selected" id="fileSelected">
                                <div style="display: flex; align-items: center;">
                                    <i class="fas fa-file-excel file-icon"></i>
                                    <div class="file-info">
                                        <div class="file-name" id="fileName"></div>
                                        <div class="file-size" id="fileSize"></div>
                                    </div>
                                </div>
                                <button type="button" class="remove-file" onclick="removeFile()">
                                    <i class="fas fa-times" style="margin-right: 0.25rem;"></i>
                                    Rimuovi
                                </button>
                            </div>
                            
                            <button type="submit" class="submit-btn" id="submitBtn" style="margin-top: 2rem;" disabled>
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

<script>
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('file');
    const fileSelected = document.getElementById('fileSelected');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const submitBtn = document.getElementById('submitBtn');
    const uploadForm = document.getElementById('uploadForm');

    // Click to select file
    uploadArea.addEventListener('click', () => {
        fileInput.click();
    });

    // File input change
    fileInput.addEventListener('change', (e) => {
        handleFile(e.target.files[0]);
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        
        const file = e.dataTransfer.files[0];
        if (file && (file.name.endsWith('.xls') || file.name.endsWith('.xlsx'))) {
            fileInput.files = e.dataTransfer.files;
            handleFile(file);
        } else {
            alert('Per favore carica solo file Excel (.xls o .xlsx)');
        }
    });

    function handleFile(file) {
        if (!file) return;

        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        
        fileSelected.classList.add('show');
        uploadArea.style.display = 'none';
        submitBtn.disabled = false;
    }

    function removeFile() {
        fileInput.value = '';
        fileSelected.classList.remove('show');
        uploadArea.style.display = 'block';
        submitBtn.disabled = true;
    }

    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
    }

    // Form submit animation
    uploadForm.addEventListener('submit', () => {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 0.75rem;"></i>Importazione in corso...';
        submitBtn.disabled = true;
    });
</script>

@include('common.footer')
