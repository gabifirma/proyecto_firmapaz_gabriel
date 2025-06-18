<section>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
         <!-- Ícono y Nombre -->
         <a class="navbar-brand" href="#">
            <img src="<?php echo base_url('assets/img/icono.png'); ?>" alt="FCBox" width="40" height="40">
            <span class="brand-text">FCBox</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('mostrar_consultas'); ?>">Ver consultas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('listar_ventas'); ?>">Listar ventas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('listar_videojuegos'); ?>">Listar juegos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('listar_usuarios'); ?>">Listar usuarios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('agregar_juego'); ?>">Agregar juegos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('gestionar_juegos'); ?>">Gestionar juegos</a>
            </li>      
          </ul>

          <div class="d-flex justify-content-end">
            <div >
              <button type="button" class="btn btn-outline-success dropdown-toggle "  data-bs-toggle="dropdown" aria-expanded="false">
                <?= session()->get('nombre'); ?>
              </button>
              <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end w-100">
                <li><a class="dropdown-item" href="<?php echo base_url('perfil_admin'); ?>" role="button">Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>" role="button">Cerrar Sesión</a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </nav>

</section>

</header>