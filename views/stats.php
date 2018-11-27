<?php include(ROOT."views/navbaradmin.php");
    if(isset($alert)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
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
          Estadisticas
        </button>
      </h5>
    </div>

    <form action = "<?= FRONT_ROOT ?>Stats/getamounts" method="post">
        <div class="form-group col-6">
            <label for="exampleFormControlFile1">Desde</label>
            <input type="date" class="form-control" name="dateFrom" id="dateFrom" required>
            <span class="validity"></span>
        </div>
        <div class="form-group col-6">
            <label for="exampleFormControlFile1">Hasta</label>
            <input type="date" class="form-control" name="dateTo" id="dateTo" required>
            <span class="validity"></span>
        </div>
        <button type="submit" class="btn btn-warning ">Obtener Estadistica</button>
    </form>
    <?php if(isset($stats)){ ?>    
    <table>
        <thead>
            <tr>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td> <?php echo 'Cantidad de entradas vendidas: '; ?></td>
              <td> <?php echo 'Cantidad de dinero recaudado: '; ?></td>
              <td>
                <div class="col-auto ">
                </div>
              </td>
              <td>
                
              </td>
            </tr>
            <tr>

              <td> <?php echo $stats[0]; ?></td>
              <td> <?php echo $stats[1]; ?></td>
              <td>
                <div class="col-auto ">
                </div>
              </td>
              <td>
                
              </td>
            </tr>
          
        </tbody>
    </table>
       

    <?php } ?>

   



<?php include(ROOT."views/footer.php"); ?>
