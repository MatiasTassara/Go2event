<?php include("header.php") ?>
<body>
    <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     <span class="navbar-text">
       <div id= "logo">
        <!--  <a href="#" class="pull-left"><img class="img-responsive" src="Go2Event.png"></a> -->
        <!--strong>Go 2 Event </strong-->
        <a href="<?=FRONT_ROOT?>"><img class="img-responisve" src="<?=FRONT_ROOT?>img/Go2EventAdminLogo.png"> </a>
      </div>

     </span>

     <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link <?php if(ACTIVE == "Artist"){echo "active";} ?>" href="<?=FRONT_ROOT?>Artist">Artistas</a>
          </li>
          <li class="nav-item">
               <a class="nav-link <?php if(ACTIVE == "Category"){echo "active";} ?>" href="<?=FRONT_ROOT?>Category">Categorias</a>
          </li>
          <li class="nav-item">
               <a class="nav-link <?php if(ACTIVE == "Event"){echo "active";} ?>" href="<?=FRONT_ROOT?>Event">Eventos</a>
          </li>
          <li class="nav-item">
               <a class="nav-link <?php if(ACTIVE == "Calendar"){echo "active";} ?>" href="<?=FRONT_ROOT?>Calendar">Fechas</a>
          </li>
          <li class="nav-item">
               <a class="nav-link <?php if(ACTIVE == "Venue"){echo "active";} ?>" href="<?=FRONT_ROOT?>Venue">Lugares</a>
          </li>
          <li class="nav-item">
               <a class="nav-link <?php if(ACTIVE == "Seattype"){echo "active";} ?>" href="<?=FRONT_ROOT?>Seattype">Tipos de Plaza</a>
          </li>
     </ul>
     </div>
   </nav>


   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


   <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/debug.addIndicators.min.js"></script></body>
</html>
