<?php include(ROOT."views/navbar.php") ?>

<?php if(isset($alert)) { ?>
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
          Mis Tickets
        </button>
      </h5>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Fecha de Compra</th>
          <th scope="col">Evento</th>
          <th scope="col">Día</th>
          <th scope="col">Tipo de Entrada</th>
          <th scope="col">Precio</th>
          <th scope="col">QR</th>
        </tr>
      </thead>
          <tbody>
            

              <?php foreach ($arrayTickets as $key => $value){ ?>
                <tr>
                  <td> <?= $value['purchaseDates'] ?></td>
                  <td> <?= $value['eventNames'] ?></td>
                  <td> <?= $value['eventDates'] ?></td>
                  <td> <?= $value['seatTypes'] ?> </td>
                  <td> $<?= $value['prices'] ?> </td>
                  <td><img src="<?= FRONT_ROOT ?><?= $value['qrImgPaths'] ?>" width="100" heigth="100"> </td>
                </tr>
              <?php }?>
        </tbody>
        </table>

  </div>
</div>
<?php include(ROOT."views/footer.php"); ?>
