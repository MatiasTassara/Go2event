<?php include(ROOT."views/navbar.php"); ?>

<div class="container mb-5">
<?php if (isset($events) && !empty($events)) { ?>

 <h2 class="uk-heading-line uk-text-center"><span>Próximos</span></h2>
  <div class="card-columns">
    <?php foreach ($events as $key => $value) {?>
    <a href="<?=FRONT_ROOT?>Home/EventInfo/<?= $value->getId(); ?>">
    <div class="card">
      <img class="card-img-top" src="<?= FRONT_ROOT ?>images/<?php echo $value->getImgPath() ?>" alt="Card image cap">
      <div class="card-body">
        <h3 class="uk-margin-remove "><?= $value->getName(); ?></h3>
        <p class="uk-margin-remove uk-text-truncate uk-text-muted"> <?= $value->getDesc()?></p>
        </div>
    </div>
    </a>
    <?php  } ?>
  </div>
  <?php  } ?>

  <?php if (isset($eventsByName) && !empty($eventsByName)) { ?>

   <h2 class="uk-heading-line uk-text-center"><span>Resultados para <?= $text ?></span></h2>
    <div class="card-columns">
      <?php foreach ($eventsByName as $key => $value) {?>
      <a href="<?=FRONT_ROOT?>Home/EventInfo/<?= $value->getId(); ?>">
      <div class="card">
        <img class="card-img-top" src="<?= FRONT_ROOT ?>images/<?php echo $value->getImgPath() ?>" alt="Card image cap">
        <div class="card-body">
          <h3 class="uk-margin-remove "><?= $value->getName(); ?></h3>
          <p class="uk-margin-remove uk-text-truncate uk-text-muted"> <?= $value->getDesc()?></p>
          </div>
      </div>
      </a>
      <?php  } ?>
    </div>
    <?php  } ?>

    <?php if (isset($eventsByArtist) && !empty($eventsByArtist)) { ?>

     <h2 class="uk-heading-line uk-text-center"><span>Artistas para <?= $text ?></span></h2>
      <div class="card-columns">
        <?php foreach ($eventsByArtist as $key => $value) {?>
        <a href="<?=FRONT_ROOT?>Home/EventInfo/<?= $value->getId(); ?>">
        <div class="card">
          <img class="card-img-top" src="<?= FRONT_ROOT ?>images/<?php echo $value->getImgPath() ?>" alt="Card image cap">
          <div class="card-body">
            <h3 class="uk-margin-remove "><?= $value->getName(); ?></h3>
            <p class="uk-margin-remove uk-text-truncate uk-text-muted"> <?= $value->getDesc()?></p>
            </div>
        </div>
        </a>
        <?php  } ?>
      </div>
      <?php  } ?>

      <?php if (isset($eventsByCategory) && !empty($eventsByCategory)) { ?>

       <h2 class="uk-heading-line uk-text-center"><span>Categorias para <?= $text ?></span></h2>
        <div class="card-columns">
          <?php foreach ($eventsByCategory as $key => $value) {?>
          <a href="<?=FRONT_ROOT?>Home/EventInfo/<?= $value->getId(); ?>">
          <div class="card">
            <img class="card-img-top" src="<?= FRONT_ROOT ?>images/<?php echo $value->getImgPath() ?>" alt="Card image cap">
            <div class="card-body">
              <h3 class="uk-margin-remove "><?= $value->getName(); ?></h3>
              <p class="uk-margin-remove uk-text-truncate uk-text-muted"> <?= $value->getDesc()?></p>
              </div>
          </div>
          </a>
          <?php  } ?>
        </div>
        <?php  } ?>

  </div>


<?php include(ROOT."views/footer.php") ?>
