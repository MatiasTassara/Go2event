<?php include("header.php") ?>

<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky" >
  <nav class="uk-navbar uk-navbar uk-navbar-container" uk-navbar="dropbar: true;">
    <div class="uk-navbar-left">
      <a class="uk-navbar-toggle" uk-toggle="target: #offcanvas-nav-admin">
        <span uk-navbar-toggle-icon class="icon-index" uk-icon-navbar></span>
      </a>
      <span class="uk-margin-small-left"><a href="<?=FRONT_ROOT?>"><img class="img-responisve" src="<?=FRONT_ROOT?>img/Go2EventLogo.png"></a></span>
    </div>

    <div class="uk-navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="<?=FRONT_ROOT?>Artist"><button class="uk-button uk-button-text">Artistas</button></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=FRONT_ROOT?>Category"><button class="uk-button uk-button-text">Categorias</button></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=FRONT_ROOT?>Event"><button class="uk-button uk-button-text">Eventos</button></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=FRONT_ROOT?>Calendar"><button class="uk-button uk-button-text">Fechas</button></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=FRONT_ROOT?>Venue"><button class="uk-button uk-button-text">Lugares</button></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=FRONT_ROOT?>SeatType"><button class="uk-button uk-button-text">Tipos de Plaza</button></a>
      </li>

    </div>
  </nav>
</div>

<div id="offcanvas-nav-admin" uk-offcanvas="overlay: true">
  <div class="uk-offcanvas-bar">

    <div class="uk-width-1-2@s uk-width-2-5@m">
      <ul class="uk-nav uk-nav-default">
        <li class="uk-active"><a href="<?=FRONT_ROOT?>">Inicio</a></li>
        <li><a href="<?=FRONT_ROOT?>">Próximos</a></li>
        <li><a href="<?=FRONT_ROOT?>">Más Vendidos</a></li>
       <?php if (!isset($_SESSION["Client"])) { ?>
         <li><a href="<?=FRONT_ROOT?>Home/Login">Iniciar Sesion</a></li>
       <?php  }else{ ?>
         <li><a href="<?=FRONT_ROOT?>Login/logOut">Cerrar Sesion</a></li>
       <?php if(($_SESSION["Client"]->isAdmin() == 1)){ ?>
        <li><a href="<?=FRONT_ROOT?>Artist">Menu Admin</a></li>
      <?php } }?>

      </ul>
    </div>

  </div>
</div>
