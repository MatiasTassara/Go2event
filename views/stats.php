<?php include(ROOT."views/navbaradmin.php") ?>
<?php if(isset($alert)) { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo $alert ?>
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
          Eventos que mas recaudaron
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Categoria</th>
            <th scope="col">Flyer</th>
            <th scope="col">Total Recaudado</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(!empty($moreMoney['events'])){
            foreach ($moreMoney['events'] as $key => $value) {?>
              <tr>
                <td> <?php echo $value->getName(); ?></td>
                <td> <?php echo $value->getCategory()->getName()?></td>
                <td><img src="<?= FRONT_ROOT ?>images/<?php echo $value->getImgPath() ?>" width="150" heigth="150"></td>
                <td> $<?php echo $moreMoney['total'][$key] ?></td>
              <?php }
            }?>

          </tbody>
        </table>

      </div>
    </div>
    <div class="card rounded-0">
      <div class="card-header p-0" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn collapsed btn-lg btn-block btn-light rounded-0 p-3" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Eventos que menos recaudaron
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Categoria</th>
              <th scope="col">Flyer</th>
              <th scope="col">Total Recaudado</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(!empty($lessMoney['events'])){
              foreach ($lessMoney['events'] as $key => $value) {?>
                <tr>
                  <td> <?php echo $value->getName(); ?></td>
                  <td> <?php echo $value->getCategory()->getName()?></td>
                  <td><img src="<?= FRONT_ROOT ?>images/<?php echo $value->getImgPath() ?>" width="150" heigth="150"></td>
                  <td> $<?php echo $lessMoney['total'][$key] ?></td>
                <?php }
              }?>

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card rounded-0">
      <div class="card-header p-0" id="headingFour">
        <h5 class="mb-0">
          <button class="btn collapsed btn-lg btn-block btn-light rounded-0 p-3" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            Totales Recaudados por Categoria
          </button>
        </h5>
      </div>
      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Categoria</th>
              <th scope="col">Total Recaudado</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(!empty($categories['categories'])){
              foreach ($categories['categories'] as $key => $value) {?>
                <tr>
                  <td> <?php echo $value->getName(); ?></td>
                  <td> $<?php echo $categories['total'][$key] ?></td>
                </tr>
              <?php }
            }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card rounded-0">
    <div class="card-header p-0" id="headingThree">
      <h5 class="mb-0">
        <button class="btn collapsed btn-lg btn-block btn-light rounded-0 p-3" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Totales
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Cantidad de tickets vendidos</th>
            <th scope="col">Total Recaudado</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td> <?= $totalSold ?></td>
            <td> $<?= $totalBilled ?></td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include("footer.php") ?>
