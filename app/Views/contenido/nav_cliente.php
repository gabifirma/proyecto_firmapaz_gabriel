<section>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
         <!-- Ícono y Nombre -->
         <a class="navbar-brand" href="<?php echo base_url('/'); ?>">
            <img src="assets/img/icono.png" alt="FCBox" width="40" height="40">
            <span class="brand-text">FCBox</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('/'); ?>">Principal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('comercializacion'); ?>">Comercializacion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('quienes_somos'); ?>">Quienes somos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('terminos'); ?>">Términos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('contacto'); ?>">Contacto</a>
            </li>            
          </ul>

          <div class="btn-group dropstart">
            <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <?= session()->get('nombre'); ?>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo base_url(''); ?>" role="button">Ver carrito</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?php echo base_url(''); ?>" role="button">Perfil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>" role="button">Cerrar Sesión</a></li>
            </ul>
          </div>
          
        </div>
      </div>
    </nav>

</section>

</header>