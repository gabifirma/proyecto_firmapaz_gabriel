<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card bg-dark text-white shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <div class="checkmark-circle">
                            <div class="checkmark"></div>
                        </div>
                    </div>
                    <h1 class="display-4 text-success mb-4 fw-bold">¡Compra Exitosa!</h1>
                    <p class="lead mb-4 text-light">Tu pedido ha sido procesado correctamente.</p>
                    <p class="text-light-50 mb-4">Gracias por tu compra. Hemos enviado un correo de confirmación con los detalles de tu pedido.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="<?= base_url('catalogo_cliente') ?>" class="btn btn-primary btn-lg px-4 me-md-2">
                            <i class="fas fa-arrow-left me-2"></i> Volver al catálogo
                        </a>
                        <a href="<?= base_url('mis_compras') ?>" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-shopping-bag me-2"></i> Ver mis compras
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background-color: #121212;
    color: #f8f9fa;
}

.card {
    background: #1e1e1e;
    border: 1px solid #333;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3) !important;
}

.checkmark-circle {
    width: 120px;
    height: 120px;
    position: relative;
    display: inline-block;
    margin: 0 auto 20px;
}

.checkmark-circle .checkmark {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    display: block;
    stroke-width: 8;
    stroke: #4bb71b;
    stroke-miterlimit: 10;
    box-shadow: 0 0 0 rgba(75, 183, 27, 0.4);
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both, pulse 2s infinite;
    position: relative;
    margin: 0 auto;
    background: rgba(75, 183, 27, 0.1);
}

.checkmark-circle .checkmark:after {
    content: '';
    position: absolute;
    left: 35%;
    top: 55%;
    width: 25px;
    height: 45px;
    border: solid #4bb71b;
    border-width: 0 5px 5px 0;
    transform: rotate(45deg) translate(-50%, -50%);
    animation: checkmark 0.6s ease-in-out 0.9s backwards;
}

@keyframes checkmark {
    0% { height: 0; width: 0; opacity: 1; }
    20% { height: 0; width: 25px; opacity: 1; }
    40% { height: 45px; width: 25px; opacity: 1; }
    100% { height: 45px; width: 25px; opacity: 1; }
}

@keyframes fill {
    0% { 
        box-shadow: inset 0 0 0 100px rgba(75, 183, 27, 0.1);
        stroke-dasharray: 314;
        stroke-dashoffset: 0;
    }
    100% { 
        box-shadow: inset 0 0 0 0 rgba(75, 183, 27, 0.1);
        stroke-dasharray: 314;
        stroke-dashoffset: 0;
    }
}

@keyframes scale {
    0%, 100% { transform: none; }
    50% { transform: scale3d(1.1, 1.1, 1); }
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(75, 183, 27, 0.4);
    }
    70% {
        box-shadow: 0 0 0 15px rgba(75, 183, 27, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(75, 183, 27, 0);
    }
}

.btn-primary {
    background-color: #4bb71b;
    border-color: #3da015;
}

.btn-primary:hover {
    background-color: #3da015;
    border-color: #2f7c0f;
}

.btn-outline-light:hover {
    color: #121212;
}

.text-light-50 {
    color: rgba(255, 255, 255, 0.7) !important;
}
</style>
