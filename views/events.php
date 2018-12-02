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

                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Flyer</th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(is_array($events) && sizeof($events)>0){
                      foreach ($events as $key => $value) {?>
                        <tr>
                          <td> <?php echo $value->getId(); ?></td>
                          <td> <?php echo $value->getName(); ?></td>
                          <td> <?php echo $value->getDesc ();?></td>
                          <td> <?php echo $value->getCategory()->getName()?></td>
                          <td><img src="<?= FRONT_ROOT ?>images/<?php echo $value->getImgPath() ?>" width="150" heigth="150"></td>

                          <td>
                            <button type="button" name="id-obj" value="" class="btn btn-warning" data-toggle="modal" data-target="#modify<?= $value->getId();?>">
                              Modificar
                            </button>
                          </td>

                          <td>
                            <button type="button"  name="id-obj" value="" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $value->getId();?>">
                              Eliminar
                            </button>
                          </td>

                        </tr>

                        <!-- MODIFY Modal -->

                        <div class="modal fade" id="modify<?= $value->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Modificar Evento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="<?= FRONT_ROOT ?>Event/modifyEvent" method="post">
                                  <input type="hidden" name="id" value = "<?= $value->getId();?>">
                                  <div class="form-row ml-2 mr-2">
                                    <div class="form-group col-6">
                                      <label for="inputEmail4">Nombre</label>
                                      <input type="text" name="name" value="<?= $value->getName(); ?>"class="form-control" id="inputEmail4" placeholder="Ej: Roger Water's Us + Them..."required>
                                    </div>
                                    <div class="form-group col-6">
                                      <label for="inputPassword4">Categoria</label>
                                      <select class="js-example-basic-single" name="state">
                                        <?php foreach ($categories as $k => $v) {?>
                                          <option <?php if($value->getCategory() == $v){echo "selected";}?> value="<?= $v->getId()?>"><?= $v->getName()?></option>
                                        <?php  } ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-row ml-2 mr-2">
                                    <div class="col-12 form-group">
                                      <label for="exampleFormControlTextarea1">Descripcion:</label>
                                      <textarea class="form-control" id="exampleFormControlTextarea1"  name="desc" rows="2" placeholder="Ej: Us + Them Tour es una gira musical del músico británico Roger Waters. La gira comenzó el 21 de mayo de 2017 con un concierto en la ciudad de East Rutherford. El tour tiene la finalidad de promocionar el nuevo disco de Water titulado Is This the Life We Really Want?"required><?= $value->getDesc() ?></textarea>
                                    </div>
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
                                <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Artista</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                ¿Esta seguro que quiere eliminar?
                              </div>
                              <div class="modal-footer">
                                <form class="" action="<?= FRONT_ROOT ?>Artist/deleteArtist" method="post">
                                  <input type="hidden" name="id" value="<?=$value->getId();?>">
                                  <button type="submit" class="btn btn-danger">Eliminar</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                          </td>
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
            Agregar Evento
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <form action = "<?=FRONT_ROOT?>Event/addEvent" method="post" enctype="multipart/form-data">
            <div class="form-row ml-2 mr-2">
              <div class="form-group col-6">
                <label for="inputEmail4">Nombre</label>
                <input type="text" name="name" class="form-control" id="inputEmail4" placeholder="Ej: Roger Water's Us + Them..."required>
              </div>
              <div class="form-group col-6">
                <label for="inputPassword4">Categoria</label>
                <select class="js-example-basic-single" name="state">
                  <?php foreach ($categories as $key => $value) {?>
                    <option value="<?= $value->getId()?>"><?= $value->getName()?></option>
                  <?php  } ?>
                </select>
              </div>
            </div>
            <div class="form-row ml-2 mr-2">
              <div class="col-8 form-group">
                <label for="exampleFormControlTextarea1">Descripcion:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="desc" rows="2" placeholder="Ej: Us + Them Tour es una gira musical del músico británico Roger Waters. La gira comenzó el 21 de mayo de 2017 con un concierto en la ciudad de East Rutherford. El tour tiene la finalidad de promocionar el nuevo disco de Water titulado Is This the Life We Really Want?"required></textarea>
              </div>
              <div class="col-auto form-group">
                <label for="exampleFormControlFile1">Flyer del Evento</label>
                <input type="file" multiple accept="image/*" class="form-control-file" name="fileToUpload" id="fileToUpload" required>
              </div>
              <div class="col-2 form-group">
                <div class="form-group row">
                  <div class="form-group">
                    <div class="col-auto ">
                      <button type="submit" class="btn btn-warning ">Agregar</button>
                    </div>
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
