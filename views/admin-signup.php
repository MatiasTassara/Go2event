
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

        <!--div class="card-header">
        <input onkeydown="filterMethod()"type="text" id="filter" class="form-control" placeholder="Busca tu artista ya :P" aria-label="Recipient's username" aria-describedby="button-addon2">

      </div!-->



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
                <td class= "uk-text-truncate"> <?php echo $value->getRole()->getName();?></td>
                <td>
                  <button type="button" name="id-obj" value="" class="btn btn-warning" data-toggle="modal" data-target="#modify<?= $value->getId();?>">
                    Hacer Administrador
                  </button>
                </td>
                <td>
                  <button type="button"  name="id-obj" value="" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $value->getId();?>">
                    Dar de Baja
                  </button>
                </td>
              </tr>
              <!-- MODIFY Modal -->
              <div class="modal fade" id="modify<?= $value->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                      <form class="" action="<?= FRONT_ROOT ?>Artist/deleteArtist" method="post">
                        <input type="hidden" name="id" value="<?=$value->getId();?>">
                        <button type="submit" class="btn btn-warning">Aceptar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
                      <h5 class="modal-title" id="exampleModalCenterTitle">Dar de Baja</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>¿Esta seguro que quiere dar de baja a <?= $value->getName() .' '. $value->getSurname(); ?>?</p>
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
            <?php  } ?>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php include("footer.php") ?>
