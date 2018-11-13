<?php include("header.php") ?>

<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky" >
  <nav class="uk-navbar uk-navbar uk-navbar-container" uk-navbar="dropbar: true;">
    <div class="uk-navbar-left">
      <a class="uk-navbar-toggle" uk-toggle="target: #offcanvas-nav">
        <span uk-navbar-toggle-icon class="icon-index" uk-icon-navbar></span>
      </a>
      <span class="uk-margin-small-left"><a href="<?=FRONT_ROOT?>"><img class="img-responisve" src="<?=FRONT_ROOT?>img/Go2EventLogo.png"></a></span>
    </div>
    <div class="uk-navbar-center">
      <ul class="uk-navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?=FRONT_ROOT?>"><button class="uk-button uk-button-text">Inicio</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=FRONT_ROOT?>Artist"><button class="uk-button uk-button-text">Proximos</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=FRONT_ROOT?>Artist"><button class="uk-button uk-button-text">Mas Vendidos</button></a>
        </li>

      </ul>
    </div>
    <div class="uk-navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="<?=FRONT_ROOT?>Home/Login"><button class="uk-button uk-button-text">Iniciar Sesion</button></a>
      </li>

    </div>
  </nav>

</div>
<div id="offcanvas-nav" uk-offcanvas="overlay: true">
  <div class="uk-offcanvas-bar">

    <div class="uk-width-1-2@s uk-width-2-5@m">
      <ul class="uk-nav uk-nav-default">
        <li class="uk-active"><a href="#">Inicio</a></li>
        <li><a href="#">Próximos</a></li>
        <li><a href="#">Más Vendidos</a></li>
        <li style="padding-top: 450px;"><a href="#">Menu Admin</a></li>
        <li><a href="#">Iniciar Sesion</a></li>
      </ul>
    </div>

  </div>
</div>
