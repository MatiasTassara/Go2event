<?php
 include(ROOT."views/header.php") ?>
  <body>
      <?php include(ROOT."views/navbaradmin.php") ?>

      <?php
        if(isset($exito))
      { ?>
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
          <p class="text-center"><strong>¡Éxito!</strong> <?php echo $exito ?></p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
        </div>
      <?php  } ?>

    <div id="accordion">
      <div class="card rounded-0">
        <div class="card-header p-0" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-lg btn-block btn-light rounded-0 p-3" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Listado de Artistas
            </button>
          </h5>
        </div>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
            <!--div class="card-header">
              <input onkeydown="filterMethod()"type="text" id="filter" class="form-control" placeholder="Busca tu artista ya :P" aria-label="Recipient's username" aria-describedby="button-addon2">

            </div!-->
              <div class="col-auto form-group">
                <section id="listado" class="">

                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                  <tbody>
                  <?php

                  if(is_array($artists) && sizeof($artists)>0){

                         foreach ($artists as $key => $value) {
                           ?>
                           <tr>
                             <td> <?php echo $value->getId(); ?></td>
                             <td class= "uk-text-truncate"> <?php echo $value->getName(); ?></td>
                             <td class= "uk-text-truncate"> <?php echo $value->getDesc();?></td>
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
                                 <h5 class="modal-title" id="exampleModalCenterTitle">Modificar Artista</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                               </div>
                               <div class="modal-body">
                                 <form action="<?= FRONT_ROOT ?>Artist/modifyArtist" method="post">
                                   <input type="hidden" name="id" value = "<?= $value->getId();?>">
                                   <div class="col-auto form-group">
                                     <label for="exampleFormControlInput1">Nombre Artista:</label>
                                     <input type="text" name="name" value = "<?=$value->getName();?>" class="form-control" id="exampleFormControlInput1" placeholder="Ej: Encias Sangrantes Murphy">
                                   </div>
                                   <div class="col-auto form-group">
                                     <label for="exampleFormControlTextarea1">Descripcion:</label>
                                     <textarea class="form-control"  id="exampleFormControlTextarea1" name="desc" rows="2" placeholder="Ej: Encías Sangrantes Murphy es un saxofonista de jazz conocido por su gran álbum: 'Sax on the Beach'."required><?= $value->getDesc();?></textarea>
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
                      <?php  } ?>
                       <?php }?>
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
              Agregar Artista
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
            <form action = "<?= FRONT_ROOT ?>Artist/addArtist" method="post">
              <div class="col-auto form-group">
                <label for="exampleFormControlInput1">Nombre Artista:</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Ej: Encias Sangrantes Murphy"required>
              </div>
              <div class="col-auto form-group">
                <label for="exampleFormControlTextarea1">Descripcion:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="desc" rows="2" placeholder="Ej: Encías Sangrantes Murphy es un saxofonista de jazz conocido por su gran álbum: 'Sax on the Beach'."required></textarea>
              </div>
              <div class="col-auto form-group">
                <div class="form-group row">
                  <div class="form-group">
                    <div class="col-auto ">
                      <button type="submit" value="Submit" class="btn btn-warning ">Agregar</button>
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--script type="text/javascript">
   function filterMethod(){
     const filter=document.querySelector('#filter');
     var artists=<?php echo json_encode($artists);?>;
                =json_decode()
     const artistfilter=artists.filter((artist) => artist.name === filter.value);
     console.log(obj);
  }
</script!-->
  </body>

</html>
