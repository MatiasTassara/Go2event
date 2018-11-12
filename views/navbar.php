<?php include("header.php") ?>

<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky" >
    <nav class="uk-navbar uk-navbar uk-navbar-container uk-margin" uk-navbar="dropbar: true;">
      <div class="uk-navbar-left">
          <a class="uk-navbar-toggle" uk-toggle="target: #offcanvas-nav">
            <span uk-navbar-toggle-icon uk-icon-navbar></span>
        </a>
        <span class="uk-margin-small-left"><a href="<?=FRONT_ROOT?>"><img class="img-responisve" src="<?=FRONT_ROOT?>img/Go2EventLogo.png"></a></span>
      </div>
      <div class="uk-navbar-center">
        <ul class="uk-navbar-nav">
          <li class="nav-item">
               <a class="nav-link" href="<?=FRONT_ROOT?>Home/EventInfo"><button class="uk-button uk-button-text">Inicio</button></a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?=FRONT_ROOT?>Artist"><button class="uk-button uk-button-text">Artistas</button></a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?=FRONT_ROOT?>Artist"><button class="uk-button uk-button-text">Artistas</button></a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?=FRONT_ROOT?>Artist"><button class="uk-button uk-button-text">Artistas</button></a>
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

        <ul class="uk-nav uk-nav-default">
            <li class="uk-active"><a href="#">Active</a></li>
            <li class="uk-parent">
                <a href="#">Parent</a>
                <ul class="uk-nav-sub">
                    <li><a href="#">Sub item</a></li>
                    <li><a href="#">Sub item</a></li>
                </ul>
            </li>
            <li class="uk-nav-header">Header</li>
            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
            <li class="uk-nav-divider"></li>
            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: trash"></span> Item</a></li>
        </ul>

    </div>
</div>
