<!-- content menu -->
<div class="slimscroll-menu" id="remove-scroll">
  <!--- Sidemenu -->
  <div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu" id="side-menu">
      <?php if ($this->session->userdata('tipo_usu') && $this->session->userdata('tipo_usu') == "SA") : ?>
        <li class="menu-title">Super Admin</li>
        <li>
          <a href="javascript: void(0);">
            <i class="fi-air-play"></i><span> Administrator </span>
          </a>
          <ul class="nav-second-level" aria-expanded=false>
            <li><a href="<?= site_url() ?>admin">Admin</a></li>
            <li><a href="<?= site_url() ?>admin/configurator">Configurador</a></li>
          </ul>
        </li>
      <?php endif ?>
      <?php if (($this->session->userdata('tipo_usu') && $this->session->userdata('tipo_usu') == "SA") || $this->session->userdata('tipo_usu') == "AD") : ?>
        <li class="menu-title">Administrador</li>
        <li>
          <a href="javascript: void(0);">
            <i class="dripicons-user-group"></i><?= $this->session->userdata('count_suscribers') ?  '<span class="badge badge-warning pull-right">' . $this->session->userdata('count_suscribers') . '</span>' : "" ?><span>Usuarios</span>
          </a>
          <ul class="nav-second-level" aria-expanded=false>
            <li><a href="<?= site_url() ?>usuarios/usuarios_reg">Recien Registrados<?= $this->session->userdata('count_suscribers') ?  '<span class="badge badge-warning pull-right">' . $this->session->userdata('count_suscribers') . '</span>' : "" ?></a></li>
            <li><a href="<?= site_url() ?>usuarios/">Todos Usuarios</a></li>
          </ul>
        </li>
        <li>
          <a href="javascript: void(0);"><i class="fa fa-address-book-o"></i><span>Cat Trabajador</span></a>
          <ul class="nav-second-level" aria-expanded=false>
            <li><a class="menu_dynamic" onclick="redirect_menu('<?= site_url() ?>form/create','Type_working', 'Categoría de Trabajador')" href="#">Registrar</a></li>
            <li><a class="menu_dynamic" onclick="redirect_menu('<?= site_url() ?>form/listar','Type_working', 'Categoría de Trabajador')" href="#">Listar </a></li>
          </ul>
        </li>
        <li>
          <a href="<?= site_url() ?>permisos">
            <i class="fa fa-drivers-license-o"></i><span> Permisos</span>
          </a>
        </li>
      <?php endif ?>

      <li class="menu-title" id="navigation">Navigation</li>
      <?php if (isset($menu_tables) && $menu_tables) : ?>
        <?php foreach ($menu_tables as $value) : ?>
          <?php if (isset($value->escritura) && isset($value->lectura) && ($value->escritura != 0 || $value->lectura != 0)) : ?>
            <li id="<?= $value->nameTable; ?>">
              <a href="javascript: void(0);">
                <i class="fi-paper"></i><span><?= $value->aliasTable ?></span>
              </a>
              <ul class="nav-second-level" aria-expanded=false>
                <?php if ($value->escritura == 1 && $value->lectura == 1) : ?>
                  <li><a class="menu_dynamic" onclick="redirect_menu('<?= site_url() ?>form/create','<?= $value->nameTable ?>', '<?= $value->aliasTable ?>')" href="#">Registrar</a></li>
                  <li><a class="menu_dynamic" onclick="redirect_menu('<?= site_url() ?>form/listar','<?= $value->nameTable ?>', '<?= $value->aliasTable ?>')" href="#">Listar </a></li>
                <?php elseif ($value->escritura == 0 && $value->lectura == 1) : ?>
                  <li><a class="menu_dynamic" onclick="redirect_menu('<?= site_url() ?>form/listar','<?= $value->nameTable ?>', '<?= $value->aliasTable ?>')" href="#">Listar </a></li>
                <?php elseif ($value->escritura == 1 && $value->lectura == 0) : ?>
                  <li><a class="menu_dynamic" onclick="redirect_menu('<?= site_url() ?>form/create','<?= $value->nameTable ?>', '<?= $value->aliasTable ?>')" href="#">Registrar</a></li>
                  <li><a class="menu_dynamic" onclick="redirect_menu('<?= site_url() ?>form/listar','<?= $value->nameTable ?>', '<?= $value->aliasTable ?>')" href="#">Listar </a></li>
                <?php endif ?>
              </ul>
            </li>
          <?php elseif (!isset($value->escritura)) : ?>
            <li id="<?= $value->nameTable; ?>">
              <a href="javascript: void(0);">
                <i class="fi-paper"></i><span><?= $value->aliasTable ?></span>
              </a>
              <ul class="nav-second-level" aria-expanded=false>
                <li><a class="menu_dynamic" onclick="redirect_menu('<?= site_url() ?>form/create','<?= $value->nameTable ?>', '<?= $value->aliasTable ?>')" href="#">Registrar</a></li>
                <li><a class="menu_dynamic" onclick="redirect_menu('<?= site_url() ?>form/listar','<?= $value->nameTable ?>', '<?= $value->aliasTable ?>')" href="#">Listar </a></li>
              </ul>
            </li>
          <?php endif ?>
        <?php endforeach ?>
      <?php endif ?>
      <li class="menu-title" id="">Lugares Turisticos</li>
      <li>
        <a href="javascript: void(0);">
          <i class="fa fa-globe"></i><span>Lugares Turisticos</span>
        </a>
        <ul class="nav-second-level" aria-expanded=false>
          <li><a href="<?= site_url() ?>lugar_turistico/register">Registrar</a></li>
          <li><a href="<?= site_url() ?>lugar_turistico/listar">Listar </a></li>
        </ul>
      </li>
      <li>
        <a href="javascript: void(0);">
          <i class="fa fa-image"></i><span>Fotos Lugares</span>
        </a>
        <ul class="nav-second-level" aria-expanded=false>
          <li><a href="<?= site_url() ?>foto_lugar/register">Registrar</a></li>
          <li><a href="<?= site_url() ?>foto_lugar/listar">Listar </a></li>
        </ul>
      </li>
      <li class="menu-title" id="">Festividades</li>
      <li>
        <a href="javascript: void(0);">
          <i class="fi-star"></i><span>Festividades</span>
        </a>
        <ul class="nav-second-level" aria-expanded=false>
          <li><a href="<?= site_url() ?>festividad/register">Registrar</a></li>
          <li><a href="<?= site_url() ?>festividad/listar">Listar </a></li>
        </ul>
      </li>
      <li>
        <a href="javascript: void(0);">
          <i class="fa fa-image"></i><span>Fotos Festividades</span>
        </a>
        <ul class="nav-second-level" aria-expanded=false>
          <li><a href="<?= site_url() ?>foto_fest/register">Registrar</a></li>
          <li><a href="<?= site_url() ?>foto_fest/listar">Listar </a></li>
        </ul>
      </li>
      <li class="menu-title" id="">Avisos</li>
      <li>
        <a href="<?= site_url() ?>publicidad">
          <i  class="fa fa-paper"></i><span>Modulo Publicidad</span>
        </a>
      </li>
      <li class="menu-title">Config</li>
      <li>
        <a href="<?php echo site_url('login/logout'); ?>">
          <i class="mdi mdi-logout"></i><span> Cerrar sesión</span>
        </a>
      </li>

    </ul>
  </div>
  <!-- Sidebar -->
  <div class="clearfix"></div>

</div>
<!-- content menu -->