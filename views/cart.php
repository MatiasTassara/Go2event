<?php include(ROOT."views/navbaradmin.php") ?>
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
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          <form action = "<?=FRONT_ROOT?>Purchase/removeFromCart" method="post">
            <div class="col-auto form-group">
              <section id="listado" class="p-0">
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
                      foreach ($_SESSION['purchaseItems'] as $key => $value) {?>
                        <tr>
                          <td> <?php echo $value->getSeat()->getCalendar()->getEvent()->getName(); ?></td>
                          <td> <?php echo $value->getSeat()->getCalendar()->getDate(); ?></td>
                          <td> <?php echo $value->getQuantity(); ?></td>
                          <td> <?php echo '$' .  $value->getSeat()->getPrice(); ?></td>
                          <td> <?php echo '$' . ($value->getSeat()->getPrice()) * $value->getQuantity(); ?></td>
                          
                          <td>
                            <div class="col-auto ">
                             
                            </div>
                          </td>
                          <td>
                            <div class="col-auto ">
                              <button type="submit" class="btn btn-danger" name="item" value="<?php $key?>" >
                                 Eliminar
                              </button>
                            </div>
                          </td>
                        </tr>
                      <?php }
                    }?>
                  </tbody>
                </table>
              </section>
            </div>
          </form>
        </div>
      </div>
    </div>