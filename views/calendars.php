<?php include(ROOT."views/header.php") ?>
  <body>
    <?php include(ROOT."views/navbaradmin.php") ?>
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
                        <th scope="col">Plazas</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                  <tbody>
                  <?php
                  if(1 == 0){
                         foreach ($events as $key => $value) {?>
                           <tr>
                             <td> <?php echo $value->getId(); ?></td>
                             <td> <?php echo $value->getName(); ?></td>
                             <td> <?php echo $value->getDesc ();?></td>
                             <td> <?php echo $value->getCategory()->getName();?></td>
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
            <form action = "<?=FRONT_ROOT?>Calendar/show" method="post">
              <div class="form-row ml-2 mr-2">
                <div class="form-group col-6">
                  <label for="inputEmail4">Evento</label>
                  <select class="js-example-basic-single" name="event">
                  <?php foreach ($events as $key => $value) {?>
                       <option value="<?= $value->getId()?>"><?= $value->getName()?></option>
                  <?php  } ?>
                  </select>
                </div>
                <div class="form-group col-6">
                  <label for="inputPassword4">Lugar</label>
                  <select class="js-example-basic-single" name="venue">
                  <?php foreach ($venues as $key => $value) {?>
                       <option value="<?= $value->getId()?>"><?= $value->getName()?></option>
                  <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="form-row ml-2 mr-2">
                <div class="form-group col-6">
                  <label for="exampleFormControlSelect2">Artistas</label>
                  <select class="js-example-basic-multiple form-control" name="artists[]" multiple="multiple">
                    <?php foreach ($artists as $key => $value) {?>
                       <option value="<?= $value->getId()?>"><?= $value->getName()?></option>
                  <?php  } ?>
                  </select>
                </div>
                <div class="form-group col-6">
                 <label for="exampleFormControlFile1">Fecha</label>
                 <input type="date" class="form-control" name="date" id="exampleFormControlFile1">
               </div>
             </div>
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                Launch demo modal
              </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php foreach ($seattypes as $key => $value) { ?>
                      <div class="form-row">
                       <div class="col auto">
                         <label for="staticEmail" class=""><?= $value->getName() ?></label>
                         <input type="hidden" name="type[]" readonly class="form-control-plaintext" id="staticEmail" value="<?= $value->getId()?>">
                      </div>
                       </div>
                       <div class="col auto">
                         <input type="number" name="quant[]" class="form-control" placeholder="1234567890" min="1">
                       </div>
                       <div class="col auto">
                         <input type="number" name="price[]" class="form-control" placeholder="$$$$$$$$$$$$$$$" min="0">
                       </div>
                  <?php  } ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
