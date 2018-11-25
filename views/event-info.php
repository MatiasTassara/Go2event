<?php include(ROOT."views/navbar.php") ?>
<?php if(isset($alert)) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>¡Muy Bien!</strong> <?php echo $alert ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>
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
            <?php if(!isset($_SESSION["user"])){?>
            <td><button type="button" class="btn btn-warning disabled" uk-tooltip="Inicie sesión para poder comprar" >Comprar Entradas</button></td>
          <?php }else{ ?>
            <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#buy<?= $value->getId(); ?>">Comprar Entradas</button></td>

            <!-- Modal -->
            <div class="modal fade" id="buy<?= $value->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Entradas al Carrito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="" action="<?=FRONT_ROOT?>Purchase/AddToCart" method="post">
                      <label for="inputPassword4">Tipo de entrada</label>
                      <select class="js-example-basic-single" name="type" required>
                        <?php foreach ($seats[$value->getId()] as $key => $value) {?>
                          <option value="<?= $value->getId()?>"><?= $value->getSeatType()->getName() . ": $".$value->getPrice()?> </option>
                        <?php  } ?>
                      </select>
                      <div class="mt-2">
                          <input type="number" min = "0" max="<?php $value->getRemaining()?>" name="quant" class="form-control"  style="text-align:center" id="inputSeattype" placeholder="Cantidad" required>
                        </div>
                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Agregar al Carrito</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php include(ROOT."views/navfooter.php"); ?>
<?php include(ROOT."views/footer.php") ?>
