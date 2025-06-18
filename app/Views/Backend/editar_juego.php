<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Videojuego - Panel de Administración</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --bg-dark: #1a1a1a;
            --bg-darker: #121212;
            --bg-card: #2d2d2d;
            --bg-input: #3d3d3d;
            --text-primary: #e0e0e0;
            --text-secondary: #a0a0a0;
            --border-color: #444;
            --primary-color: #6f42c1;
            --primary-hover: #5a32a3;
        }
        
        body {
            background-color: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
        }
        
        .card {
            border-radius: 0.5rem;
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }
        
        .card-header {
            border-radius: 0.5rem 0.5rem 0 0 !important;
            background-color: var(--bg-darker) !important;
            border-bottom: 1px solid var(--border-color);
        }
        
        .form-control, .form-select, .form-control:focus, .form-select:focus {
            background-color: var(--bg-input);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
            border-color: var(--primary-color);
        }
        
        .input-group-text {
            background-color: var(--bg-input);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }
        
        .btn-outline-secondary {
            color: var(--text-secondary);
            border-color: var(--border-color);
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--bg-input);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .text-muted {
            color: var(--text-secondary) !important;
        }
        
        .bg-light {
            background-color: var(--bg-darker) !important;
            color: var(--text-primary) !important;
        }
        
        .alert {
            background-color: var(--bg-card);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        
        .alert-success {
            background-color: #1e3a1e;
            border-color: #2a4d2a;
            color: #b8f2b8;
        }
        
        .alert-danger {
            background-color: #3a1e1e;
            border-color: #4d2a2a;
            color: #f2b8b8;
        }
        
        .form-text {
            color: var(--text-secondary) !important;
        }
        
        .list-unstyled li {
            color: var(--text-primary);
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white py-3" style="background-color: var(--primary-color) !important;">
                        <h2 class="h4 mb-0"><i class="fas fa-edit me-2"></i>Editar Videojuego</h2>
                    </div>
                <div class="card-body">
                    <?php if (!empty($validation)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Error de validación</h5>
                            <ul class="mb-0">
                                <?php foreach ($validation as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session('mensaje')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?= session('mensaje') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-lg-8">
                            <?php 
                            $validation = \Config\Services::validation();
                            echo form_open_multipart('actualizar_videojuego/'.$videojuego['id_videojuego'], ['class' => 'needs-validation', 'novalidate' => '']); 
                            ?>
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header py-2" style="background-color: var(--bg-darker) !important;">
                                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información Básica</h5>
                                    </div>
                                    <div class="card-body">
                                            <div class="mb-3">
                                                <label for="titulo" class="form-label fw-bold">Título del Juego <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light"><i class="fas fa-heading"></i></span>
                                                    <?php 
                                                    $value = set_value('titulo', $videojuego["titulo_videojuego"]);
                                                    echo form_input([
                                                        'name' => 'titulo', 
                                                        'id' => 'titulo', 
                                                        'type' => 'text', 
                                                        'class' => 'form-control ' . ($validation->hasError('titulo') ? 'is-invalid' : ''), 
                                                        'placeholder' => 'Ej: The Legend of Zelda: Breath of the Wild', 
                                                        'value' => $value,
                                                        'required' => 'required',
                                                        'maxlength' => '150'
                                                    ]); 
                                                    if ($validation->hasError('titulo')) {
                                                        echo '<div class="invalid-feedback">' . esc($validation->getError('titulo')) . '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label fw-bold">Descripción <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light align-items-start pt-2"><i class="fas fa-align-left"></i></span>
                                                    <?php 
                                                    $value = set_value('descripcion', $videojuego['descripcion_videojuego']);
                                                    echo form_textarea([
                                                        'name' => 'descripcion', 
                                                        'id' => 'descripcion', 
                                                        'class' => 'form-control ' . ($validation->hasError('descripcion') ? 'is-invalid' : ''), 
                                                        'rows' => '4', 
                                                        'placeholder' => 'Describa el videojuego...',
                                                        'required' => 'required',
                                                        'maxlength' => '650'
                                                    ], $value);
                                                    if ($validation->hasError('descripcion')) {
                                                        echo '<div class="invalid-feedback">' . esc($validation->getError('descripcion')) . '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="desarrollador" class="form-label fw-bold">Desarrollador <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light"><i class="fas fa-code"></i></span>
                                                        <?php 
                                                    $value = set_value('desarrollador', $videojuego["desarrollador_videojuego"]);
                                                    echo form_input([
                                                        'name' => 'desarrollador', 
                                                        'id' => 'desarrollador', 
                                                        'type' => 'text', 
                                                        'class' => 'form-control ' . ($validation->hasError('desarrollador') ? 'is-invalid' : ''), 
                                                        'placeholder' => 'Ej: Nintendo EPD', 
                                                        'value' => $value,
                                                        'required' => 'required',
                                                        'maxlength' => '100'
                                                    ]);
                                                    if ($validation->hasError('desarrollador')) {
                                                        echo '<div class="invalid-feedback">' . esc($validation->getError('desarrollador')) . '</div>';
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="distribuidor" class="form-label fw-bold">Distribuidor <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light"><i class="fas fa-truck"></i></span>
                                                        <?php 
                                                    $value = set_value('distribuidor', $videojuego["distribuidor_videojuego"]);
                                                    echo form_input([
                                                        'name' => 'distribuidor', 
                                                        'id' => 'distribuidor', 
                                                        'type' => 'text', 
                                                        'class' => 'form-control ' . ($validation->hasError('distribuidor') ? 'is-invalid' : ''), 
                                                        'placeholder' => 'Ej: Nintendo', 
                                                        'value' => $value,
                                                        'required' => 'required',
                                                        'maxlength' => '100'
                                                    ]);
                                                    if ($validation->hasError('distribuidor')) {
                                                        echo '<div class="invalid-feedback">' . esc($validation->getError('distribuidor')) . '</div>';
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-4 border-0 shadow-sm">
                                        <div class="card-header py-2" style="background-color: var(--bg-darker) !important;">
                                            <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Detalles del Producto</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label for="precio" class="form-label fw-bold">Precio ($) <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">$</span>
                                                        <?php 
                                                    $value = set_value('precio', $videojuego["precio_videojuego"]);
                                                    echo form_input([
                                                        'name' => 'precio', 
                                                        'id' => 'precio', 
                                                        'type' => 'number', 
                                                        'step' => '0.01', 
                                                        'min' => '0', 
                                                        'class' => 'form-control ' . ($validation->hasError('precio') ? 'is-invalid' : ''), 
                                                        'placeholder' => '0.00', 
                                                        'value' => $value,
                                                        'required' => 'required',
                                                        'oninput' => 'validarPrecio(this)',
                                                        'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46'
                                                    ]);
                                                    if ($validation->hasError('precio')) {
                                                        echo '<div class="invalid-feedback">' . esc($validation->getError('precio')) . '</div>';
                                                    } else {
                                                        echo '<div class="invalid-feedback">El precio debe ser un número mayor o igual a 0</div>';
                                                    }
                                                    ?>
                                                    <script>
                                                    function validarPrecio(input) {
                                                        const valor = parseFloat(input.value);
                                                        if (isNaN(valor) || valor < 0) {
                                                            input.setCustomValidity('El precio debe ser un número mayor o igual a 0');
                                                        } else {
                                                            input.setCustomValidity('');
                                                        }
                                                    }
                                                    </script>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="stock" class="form-label fw-bold">Stock <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light"><i class="fas fa-boxes"></i></span>
                                                        <?php 
                                                    $value = set_value('stock', $videojuego['videojuego_stock'] ?? 0);
                                                    echo form_input([
                                                        'name' => 'stock', 
                                                        'id' => 'stock', 
                                                        'type' => 'number', 
                                                        'min' => '0',
                                                        'step' => '1',
                                                        'class' => 'form-control ' . ($validation->hasError('stock') ? 'is-invalid' : ''), 
                                                        'value' => $value,
                                                        'required' => 'required',
                                                        'oninput' => 'validarStock(this)',
                                                        'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'
                                                    ]);
                                                    if ($validation->hasError('stock')) {
                                                        echo '<div class="invalid-feedback">' . esc($validation->getError('stock')) . '</div>';
                                                    } else {
                                                        echo '<div class="invalid-feedback">El stock debe ser un número entero mayor o igual a 0</div>';
                                                    }
                                                    ?>
                                                    <script>
                                                    function validarStock(input) {
                                                        const valor = parseInt(input.value);
                                                        if (isNaN(valor) || valor < 0 || !Number.isInteger(valor)) {
                                                            input.setCustomValidity('El stock debe ser un número entero mayor o igual a 0');
                                                        } else {
                                                            input.setCustomValidity('');
                                                        }
                                                    }
                                                    </script>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="categoria" class="form-label fw-bold">Categoría <span class="text-danger">*</span></label>
                                                    <?php 
                                                        $lista = [];
                                                        $selected = set_value('categoria', $videojuego['id_categoria']);
                                                        foreach($categoria as $row){
                                                            $categoria_id = $row['id'];
                                                            $categoria_desc = $row['categoria_descripcion'];
                                                            $lista[$categoria_id] = $categoria_desc;
                                                        }
                                                        echo form_dropdown('categoria', $lista, $selected, 'class="form-select ' . ($validation->hasError('categoria') ? 'is-invalid' : '') . '" id="categoria" required');
                                                        if ($validation->hasError('categoria')) {
                                                            echo '<div class="invalid-feedback">' . esc($validation->getError('categoria')) . '</div>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                        
                                            <div class="mt-4">
                                                <label for="imagen" class="form-label fw-bold">Imagen del Juego</label>
                                                <div class="input-group mb-2">
                                                    <?php 
                                                    echo form_upload([
                                                        'name' => 'imagen', 
                                                        'id' => 'imagen', 
                                                        'class' => 'form-control ' . ($validation->hasError('imagen') ? 'is-invalid' : ''), 
                                                        'onchange' => 'previewImage(this)',
                                                        'accept' => 'image/*'
                                                    ]);
                                                    if ($validation->hasError('imagen')) {
                                                        echo '<div class="invalid-feedback">' . esc($validation->getError('imagen')) . '</div>';
                                                    }
                                                    ?>
                                                    <label class="input-group-text bg-light" for="imagen"><i class="fas fa-upload"></i></label>
                                                </div>
                                                <div class="form-text">Formatos: JPG, PNG, GIF (Máx. 2MB). Dejar en blanco para mantener la imagen actual.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="<?= base_url('gestionar_juegos') ?>" class="btn btn-outline-secondary">
                                            <i class="fas fa-arrow-left me-1"></i> Volver
                                        </a>
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="fas fa-save me-1"></i> Guardar Cambios
                                        </button>
                                    </div>

                                <?php echo form_close(); ?>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header py-2" style="background-color: var(--bg-darker) !important;">
                                        <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Vista Previa</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="mb-4">
                                            <?php 
                                            $imagen = isset($videojuego['imagen_videojuego']) && !empty($videojuego['imagen_videojuego']) 
                                                ? base_url('assets/img/' . $videojuego['imagen_videojuego'])
                                                : base_url('assets/img/default-game.jpg');
                                            ?>
                                            <img id="imagePreview" src="<?= $imagen ?>" alt="Vista previa de la imagen" class="img-fluid rounded shadow" style="max-height: 220px; width: 100%; object-fit: cover;">
                                            <div class="mt-3">
                                                <h5 class="card-title" style="color: var(--text-primary) !important;"><?= esc($videojuego['titulo_videojuego']) ?></h5>
                                                <div class="d-flex justify-content-center align-items-center mb-2">
                                                    <span class="badge bg-primary me-2"><?= $lista[$videojuego['id_categoria']] ?? 'Sin categoría' ?></span>
                                                    <span class="badge bg-<?= ($videojuego['videojuego_stock'] ?? 0) > 0 ? 'success' : 'danger' ?> fs-6">
                                                        <?= $videojuego['videojuego_stock'] ?? 0 ?> en stock
                                                    </span>
                                                </div>
                                                <h4 class="text-primary fw-bold">$<?= number_format($videojuego['precio_videojuego'] ?? 0, 2) ?></h4>
                                            </div>
                                        </div>
                                        <div class="card p-3 text-start" style="background-color: var(--bg-darker) !important;">
                                            <h6 class="text-muted mb-2">Detalles del producto:</h6>
                                            <ul class="list-unstyled small mb-0">
                                                <li class="mb-1"><i class="fas fa-code me-2 text-primary"></i> <strong>Desarrollador:</strong> <?= esc($videojuego['desarrollador_videojuego']) ?></li>
                                                <li class="mb-1"><i class="fas fa-truck me-2 text-primary"></i> <strong>Distribuidor:</strong> <?= esc($videojuego['distribuidor_videojuego']) ?></li>
                                                <li class="mb-0"><i class="fas fa-info-circle me-2 text-primary"></i> <strong>ID:</strong> <?= $videojuego['id_videojuego'] ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const previewContainer = preview.parentElement;
            
            if (input.files && input.files[0]) {
                // Validar tamaño máximo (2MB)
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (input.files[0].size > maxSize) {
                    alert('La imagen es demasiado grande. El tamaño máximo permitido es de 2MB.');
                    input.value = '';
                    return;
                }
                
                // Validar tipo de archivo
                const fileType = input.files[0].type;
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(fileType)) {
                    alert('Por favor, selecciona un archivo de imagen válido (JPG, PNG o GIF).');
                    input.value = '';
                    return;
                }
                
                // Mostrar previsualización
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    // Actualizar el contenedor de la imagen
                    if (previewContainer.querySelector('img')) {
                        previewContainer.querySelector('img').style.display = 'block';
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Validación de formulario
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
