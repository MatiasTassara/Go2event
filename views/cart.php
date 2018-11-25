<?php include(ROOT."views/navbar.php") ?>
<?php if(isset($alert)) { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>¡Error!</strong> <?php echo $alert ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>
<div id="accordion">
  <div class="card rounded-0">
    <div class="card-header p-0" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-lg btn-block btn-light rounded-0 p-3" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Carrito de compras
        </button>
      </h5>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Evento</th>
          <th scope="col">Dia</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Precio unitario</th>
          <th scope="col">Sub total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(!empty($_SESSION['purchaseItems'])){
          $acumTotal = 0;
          foreach ($_SESSION['purchaseItems'] as $key => $value) {?>
            <tr>
              <td> <?php echo $value->getSeat()->getCalendar()->getEvent()->getName(); ?></td>
              <td> <?php echo $value->getSeat()->getCalendar()->getDateFront(); ?></td>
              <td> <?php echo $value->getQuantity(); ?></td>
              <td> <?php echo '$' .  $value->getSeat()->getPrice(); ?></td>
              <td> <?php echo '$' . ($value->getSeat()->getPrice()) * $value->getQuantity(); ?></td>
              <?php $acumTotal = $acumTotal + (($value->getSeat()->getPrice()) * $value->getQuantity());?>
              <td>
                <div class="col-auto ">
                </div>
              </td>
              <td>
                <div class="col-auto ">
                  <?php echo $key ?>
                  <a href="<?= FRONT_ROOT?>Purchase/RemoveFromCart/<?= $key ?>" class="uk-icon-button" uk-icon="trash"></a>
                </div>
              </td>
            </tr>
          <?php } ?>

          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td> <strong>Total</strong> $<?= $acumTotal ?></td>
        <?php } ?>
      </tbody>
    </table>
    <?php if (empty($_SESSION['purchaseItems'])){ ?>
      <h5 class="text-center">No hay tickets en el carrito</h5>
    <?php } ?>



  </div>
</div>
<div class="container col-5 p-2">
  <button type="button" class="btn btn-warning btn-lg btn-block ">Comprar</button>
</div>


<?php include(ROOT."views/footer.php"); ?>
