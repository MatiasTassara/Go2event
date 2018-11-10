<?php
 include(ROOT."views/header.php") ?>
  <body>
      <?php include(ROOT."views/navbar.php") ?>

      <div class="uk-cover-container uk-height-medium ">
        <img src="<?=FRONT_ROOT?>img/imagen.jpg" uk-cover>
        <div class="container">
          <div class="row">
            <div class="col-md-8 mx-auto" style="top: 96px;left: 0px;">
              <p class="uk-text-large uk-text-bold uk-text-middle uk-text-center text-white">BUSCA TRANQUILO, YA SALIMOS HACIENDO LA VERTICAL</p>
              <div class="input-group mx-auto">
                <input type="text" class="form-control" placeholder="Buscá por evento o artista..." aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-warning" type="button" id="button-addon2"><span uk-icon="icon: search"></span></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
