<?php include(ROOT."views/navbar.php") ?>
<div class="card text-center">
  <img class="card-img-top" src="<?= FRONT_ROOT ?>images/<?= $event->getImgPath();?>" alt="Card image cap">
  <div class="card-header">
  </div>
  <div class="card-body">
    <h2 class="card-title"><?= $event->getName();?></h2>
    <p class="card-text"><?= $event->getDesc();?></p>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Ciudad</th>
          <th scope="col">Lugar</th>
          <th scope="col">Fecha</th>
          <th scope="col">Artistas</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($calendars as $key => $value){ ?>
          <tr>
            <td ><?=$value->getVenue()->getCity();?></td>
            <td ><?=$value->getVenue()->getName();?></td>
            <td><?= $value->getDateFront();?></td>
            <td><?php foreach ($artistsPerCalendar[$value->getId()] as $k => $v) {
                echo $v->getName(); if((count($artistsPerCalendar[$value->getId()]) - 1) > $k){echo ", ";}
            } ?></td>
            <td><button class="btn btn-warning" <?php if(!isset($_SESSION["user"])){echo "disabled uk-tooltip=\"Inicie Sesion para Poder Comprar\"";} ?>>Comprar Entradas</button></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php include(ROOT."views/navfooter.php"); ?>
<?php include(ROOT."views/footer.php") ?>
