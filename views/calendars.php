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
            Listado de Eventos
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          <div class="col-auto form-group">
            <section id="listado" class="p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Evento</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Flyer</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if(isset($calendars)){
                    foreach ($calendars as $key => $value) {?>
                      <tr>
                        <td> <?php echo $value->getId(); ?></td>
                        <td> <?php echo $value->getEvent()->getName(); ?></td>
                        <td> <?php echo $value->getDateFront();?></td>
                        <td><img src="<?= FRONT_ROOT ?>images/<?php echo $value->getEvent()->getImgPath() ?>" width="150" heigth="150"></td>
                        <td>
                          <div class="col-auto ">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModifyModal">
                              Modificar
                            </button>
                          </div>
                        </td>
                        <td>
                          <div class="col-auto ">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteModal">
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
        </div>
      </div>
    </div>
    <div class="card rounded-0">
      <div class="card-header p-0" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn collapsed btn-lg btn-block btn-light rounded-0 p-3" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Agregar Fecha a Evento
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <form action = "<?=FRONT_ROOT?>Calendar/addCalendar" method="post">
            <div class="form-row ml-2 mr-2">
              <div class="form-group col-6">
                <label for="inputEmail4">Evento</label>
                <select class="js-example-basic-single" name="event" required>
                  <?php foreach ($events as $key => $value) {?>
                    <option value="<?= $value->getId()?>"><?= $value->getName()?></option>
                  <?php  } ?>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="inputPassword4">Lugar</label>
                <select class="js-example-basic-single" name="venue" required>
                  <?php foreach ($venues as $key => $value) {?>
                    <option value="<?= $value->getId()?>"><?= $value->getName()?></option>
                  <?php  } ?>
                </select>
              </div>
            </div>
            <div class="form-row ml-2 mr-2">
              <div class="form-group col-6">
                <label for="exampleFormControlSelect2">Artistas</label>
                <select class="js-example-basic-multiple form-control" name="artists[]" multiple="multiple" required>
                  <?php foreach ($artists as $key => $value) {?>
                    <option value="<?= $value->getId()?>"><?= $value->getName()?></option>
                  <?php  } ?>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="exampleFormControlFile1">Fecha</label>
                <input type="date" class="form-control" name="date" id="exampleFormControlFile1" required>
                <span class="validity"></span>
              </div>
            </div>
            <div class="form-group ">
              <button type="button" class="btn btn-warning mx-auto" data-toggle="modal" data-target="#exampleModalLong">
                Agregar Tipos de Plaza a la Venta
              </button>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Tipos de Plaza a la Venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php if (is_array($seattypes)) {
                      foreach ($seattypes as $key => $value) { ?>
                        <div class="form-group row">
                          <label for="inputSeattype" class="col-sm-2 col-form-label"><?=$value->getName();?></label>
                          <input type="hidden" name="type[]" value="<?=$value->getId()?>">
                          <div class="col-sm-5">
                            <input type="number" min = 0 name="quant[]" value = 0 class="form-control" id="inputSeattype" placeholder="Cantidad">
                          </div>
                          <div class="col-sm-5">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                              </div>
                              <input type="number" min = 0 name="price[]" value = 0 class="form-control" id="inlineFormInputGroupUsername" placeholder="Precio">
                            </div>
                          </div>
                        </div>
                        <hr class="uk-divider-icon">
                      <?php  }
                    }
                    else {
                      echo "No hay tipos de plaza disponibles para la venta";
                    } ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Listo</button>
                  </div>
                </div>
              </div>
            </div>
            <div class=" form-group">
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

    <!-- MODIFY Modal-->
    <div class="modal fade" id="ModifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Modificar Evento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Proximamente...
          </div>
        </div>
      </div>
    </div>
    <!-- DELETE Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Evento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Proximamente...
          </div>
        </div>
      </div>
    </div>


    <?php include("footer.php") ?>
    <!--script> let alert = <?php $alert ?>
    $( document ).ready(function(){
      if (alert !== null){
        UIkit.notification({
        message: alert,
        status: 'warning',
        pos: 'top-center',
        timeout: 5000
      });
      }
    })  </script-->
  
