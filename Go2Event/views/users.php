<?php include(ROOT."views/navbaradmin.php") ?>
  <div id="accordion">
    <div class="card rounded-0">
      <div class="card-header p-0" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-lg btn-block btn-light rounded-0 p-3" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Listado de Usuarios
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Email</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Rol</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(is_array($users) && sizeof($users)>0){
            foreach ($users as $key => $value) {
              ?>
              <tr>
                <td class= ""> <?php echo $value->getMail(); ?></td>
                <td class= "uk-text-truncate"> <?php echo $value->getName();?></td>
                <td class= "uk-text-truncate"> <?php echo $value->getSurname(); ?></td>
                <td class= ""> <?php echo $value->getRole()->getName();?></td>

                <?php if($value->getRole()->getId() == 2){ ?>
                <td>
                  <button type="button" name="id-obj" value="" class="btn btn-warning <?php if($value->getId() == $_SESSION["user"]->getId()){echo disabled;} ?>" data-toggle="modal" data-target="#makeAdmin<?= $value->getId();?>">
                    Hacer Administrador
                  </button>
                </td>
                <!-- MAKE ADMIN Modal -->
                <div class="modal fade" id="makeAdmin<?= $value->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hacer Administrador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>¿Esta seguro que quiere hacer administrador a <?= $value->getName() .' '. $value->getSurname(); ?>?</p>
                      </div>
                      <div class="modal-footer">
                        <form class="" action="<?= FRONT_ROOT ?>User/MakeAdmin" method="post">
                          <input type="hidden" name="id" value="<?=$value->getId();?>">
                          <button type="submit" class="btn btn-warning">Aceptar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }else if ($value->getRole()->getId() == 1) { ?>
              <td>
                <button type="button" name="id-obj" value="" class="btn btn-warning <?php if($value->getId() == $_SESSION["user"]->getId()){echo disabled;} ?>" data-toggle="modal" data-target="#makeClient<?= $value->getId();?>">
                  Hacer Cliente
                </button>
              </td>
              <!-- MAKE CLIENT Modal -->
              <div class="modal fade" id="makeClient<?= $value->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Hacer Administrador</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>¿Esta seguro que quiere hacer administrador a <?= $value->getName() .' '. $value->getSurname(); ?>?</p>
                    </div>
                    <div class="modal-footer">
                      <form class="" action="<?= FRONT_ROOT ?>User/MakeClient" method="post">
                        <input type="hidden" name="id" value="<?=$value->getId();?>">
                        <button type="submit" class="btn btn-warning">Aceptar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php  } ?>
              <?php if($value->getRole()->getId() != 3){ ?>
                <td>
                  <button type="button"  name="id-obj" value="" class="btn btn-danger <?php if($value->getId() == $_SESSION["user"]->getId()){echo disabled;} ?>" data-toggle="modal" data-target="#unsuscribe<?= $value->getId();?>">
                    Dar de Baja
                  </button>
                </td>
              </tr>
              <!-- UNSUSCRIBE Modal -->
              <div class="modal fade" id="unsuscribe<?= $value->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Dar de Baja</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>¿Esta seguro que quiere dar de baja a <?= $value->getName() .' '. $value->getSurname(); ?>?</p>
                    </div>
                    <div class="modal-footer">
                      <form class="" action="<?= FRONT_ROOT ?>User/Unsuscribe" method="post">
                        <input type="hidden" name="id" value="<?=$value->getId();?>">
                        <button type="submit" class="btn btn-danger">Dar de Baja</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php if($value->getRole()->getId() == 3){ ?>
                <td>
                  <button type="button"  name="id-obj" value="" class="btn btn-warning disabled" >
                    Hacer Administrador
                  </button>
                </td>
                <td>
                  <button type="button"  name="id-obj" value="" class="btn btn-success" data-toggle="modal" data-target="#suscribe<?= $value->getId();?>">
                    Dar de Alta
                  </button>
                </td>
              </tr>
              <!-- SUSCRIBE Modal -->
              <div class="modal fade" id="suscribe<?= $value->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Dar de Alta</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>¿Esta seguro que quiere dar de alta a <?= $value->getName() .' '. $value->getSurname(); ?>?</p>
                    </div>
                    <div class="modal-footer">
                      <form class="" action="<?= FRONT_ROOT ?>User/MakeClient" method="post">
                        <input type="hidden" name="id" value="<?=$value->getId();?>">
                        <button type="submit" class="btn btn-success">Dar de Alta</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
            <?php  } ?>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php include("footer.php") ?>
