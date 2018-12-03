<?php include(ROOT."views/navbar.php") ?>
<form action="<?=FRONT_ROOT?>Home/Search" method="post">
  <div class="uk-cover-container uk-height-medium ">
    <!--<iframe src="https://www.youtube.com/embed/XVHe6mgBWBk?playlist=XVHe6mgBWBk&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=0&modestbranding=1&nologo=1&widgetid=1" width="560" height="355" frameborder="0" allowfullscreen = "1" uk-cover></iframe>-->
    <video autoplay loop muted playsinline uk-cover>
      <source src="<?= FRONT_ROOT ?>img/goToHeader.mp4" type="video/mp4">
      </video>
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto" style="top: 96px;left: 0px;">
            <p class="uk-text-large uk-text-bold uk-text-middle uk-text-center text-white">ENCONTRA TU EVENTO IDEAL</p>
            <div class="input-group mx-auto">
              <input type="text" name="text" class="form-control" placeholder="Buscá por evento, artista o categoría..." aria-label="Recipient's username" aria-describedby="button-addon2">
              <div class="input-group-append">
                <button class="btn btn-warning" type="submit" id="button-addon2"><span class="icon-index" uk-icon="icon: search"></span></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <?php if(isset($alert)) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $alert ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php } ?>
  <?php if(isset($events)){ ?>
    <div class="uk-container uk-container-expand mt-3 mb-3">

      <h2 class="uk-heading-line uk-text-center"><span>Próximos</span></h2>

      <div class="uk-position-relative uk-visible-toggle uk-light" uk-slider="clsActivated: uk-transition-active; center: true; pause-on-hover: true; autoplay: true; autoplay-interval: 3000">
        <ul class="uk-slider-items uk-grid">
          <?php foreach ($events as $key => $value) {?>

            <li class="uk-width-1-2">
              <a href="<?=FRONT_ROOT?>Home/EventInfo/<?= $value->getId();?>">
                <div class="uk-panel">
                  <img src="<?= FRONT_ROOT ?>images/<?php echo $value->getImgPath() ?>">
                  <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                    <h3 class="uk-margin-remove"><?= $value->getName(); ?></h3>
                    <p class="uk-margin-remove uk-text-truncate"><?= $value->getDesc()?></p>
                  </div>
                </div>
              </a>
            </li>
          <?php } ?>
        </div></div>

        <?php if(isset($mostSold)){ ?>
          <div class="uk-container uk-container-expand mt-3 mb-3">

            <h2 class="uk-heading-line uk-text-center"><span>Mas vendidos</span></h2>

            <div class="uk-position-relative uk-visible-toggle uk-light" uk-slider="clsActivated: uk-transition-active; center: true; pause-on-hover: true; autoplay: true; autoplay-interval: 2500">
              <ul class="uk-slider-items uk-grid">
                <?php foreach ($mostSold as $key => $value) {?>

                  <li class="uk-width-1-2">
                    <a href="<?=FRONT_ROOT?>Home/EventInfo/<?= $value->getId();?>">
                      <div class="uk-panel">
                        <img src="<?= FRONT_ROOT ?>images/<?php echo $value->getImgPath() ?>">
                        <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                          <h3 class="uk-margin-remove"><?= $value->getName(); ?></h3>
                          <p class="uk-margin-remove uk-text-truncate"><?= $value->getDesc()?></p>
                        </div>
                      </div>
                    </a>
                  </li>-->
                <?php }
              }?>



            </ul>


            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

          </div>

        </div>
      <?php } ?>



      <?php include("navfooter.php"); ?>
      <?php include("footer.php"); ?>
