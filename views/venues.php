<?php include(ROOT."views/navbaradmin.php") ?>
<div id="accordion">
  <div class="card rounded-0">
    <div class="card-header p-0" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-lg btn-block btn-light rounded-0 p-3" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Listado de Lugares
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Capacidad Máxima</th>
            <th scope="col">Ciudad</th>
            <th scope="col">Direccion</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(!empty($venues)){
            foreach ($venues as $key => $value) {?>
              <tr>
                <td> <?php echo $value->getId(); ?></td>
                <td> <?php echo $value->getName(); ?></td>
                <td> <?php echo $value->getCapacityLimit();?></td>
                <td> <?php echo $value->getCity(); ?></td>
                <td> <?php echo $value->getAddress();?></td>
                <td>
                  <td>
                    <button type="button" name="id-obj" value="" class="btn btn-warning" data-toggle="modal" data-target="#modify<?= $value->getId();?>" disabled>
                      Modificar
                    </button>
                  </td>

                  <td>
                    <button type="button"  name="id-obj" value="" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $value->getId();?>" disabled>
                      Eliminar
                    </button>
                  </td>

                </tr>

                <!-- MODIFY Modal -->

                <div class="modal fade" id="modify<?= $value->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Modificar Artista</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action = "<?= FRONT_ROOT ?>Venue/addVenue" method="post">
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Nombre</label>
                              <input type="text" name="name" value="<?= $value->getName();?>"class="form-control" id="inputEmail4" placeholder="Ej: Estadio GEBA">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputPassword4">Capacidad Máxima</label>
                              <input type="text" name="maxCapacity" value="<?= $value->getCapacityLimit() ?>"  class="form-control" id="inputPassword4" placeholder="Ej: 12000" readonly>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputAddress">Ciudad</label>
                            <input type="text"name="city" class="form-control" id="inputAddress" placeholder="Ej: CABA">
                          </div>
                          <div class="form-group">
                            <label for="inputAddress2">Dirección</label>
                            <input type="text" name="dir" class="form-control" id="inputAddress2" placeholder="Ej: Marcelino Freyre 3831">
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Modificar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- DELETE Modal -->
                <div class="modal fade" id="delete<?= $value->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Lugar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        ¿Esta seguro que quiere eliminar?
                      </div>
                      <div class="modal-footer">
                        <form class="" action="<?= FRONT_ROOT ?>Venue/deleteVenue" method="post">
                          <input type="hidden" name="id" value="<?=$value->getId();?>">
                          <button type="submit" class="btn btn-danger">Eliminar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </tr>
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
          Agregar Lugar
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <form action = "<?= FRONT_ROOT ?>Venue/addVenue" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Nombre</label>
              <input type="text" name="name" class="form-control" id="inputEmail4" placeholder="Ej: Estadio GEBA">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Capacidad Máxima</label>
              <input type="text" name="maxCapacity" class="form-control" id="inputPassword4" placeholder="Ej: 12000">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Ciudad</label>
            <input type="text"name="city" class="form-control" id="inputAddress" placeholder="Ej: CABA">
          </div>
          <div class="form-group">
            <label for="inputAddress2">Dirección</label>
            <input type="text" name="dir" class="form-control" id="inputAddress2" placeholder="Ej: Marcelino Freyre 3831">
          </div>
          <div class="col-auto form-group">
            <div class="form-group row">
              <div class="form-group">
                <div class="col-auto ">
                  <button type="submit" class="btn btn-warning ">Agregar</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include("footer.php") ?>
