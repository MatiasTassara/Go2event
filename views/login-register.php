<?php include(ROOT."views/navbar.php") ?>
<div class="uk-container uk-container-expand mt-3 mb-3">

  <div class="uk-position uk-visible-toggle">


    <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium" >

          <li><a class="uk-link-heading" href="#">Loguearse</a></li>
          <li><a class="uk-link-heading" href="#">Registrarse</a></li>

    </ul>
    <ul class="uk-switcher uk-margin">
        <li>
          <div class="container pr-5 pl-5">
          <form action="<?= FRONT_ROOT ?>Login/login" class="" method="post">
            <div class="form-group">
              <label class="uk-form-label text-center" for="exampleInputEmail1">Email</label>
              <input type="email" name="email" class="form-control uk-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese Email">
            </div>
            <div class="form-group">
              <label class="text-center uk-form-label" for="exampleInputPassword1">Contraseña</label>
              <input type="password" name="pass" class="form-control uk-input" id="exampleInputPassword1" placeholder="Ingrese Contraseña">
            </div>
            <div class="form-group">
              <button type="submit" class="uk-button btn-warning btn-block">Ingresar</button>
            </div>
          </form>
        </div>
        </li>

        <li>
          <div class="container pr-5 pl-5">
          <form action="<?= FRONT_ROOT ?>Signup/addUser" class="" method="post">
            <div class="form-group">
              <label class="uk-form-label text-center" for="exampleInputEmail1">Email</label>
              <input type="email" name="email" class="form-control uk-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese Email">
            </div>
            <div class="form-group">
              <label class="text-center uk-form-label" for="exampleInputPassword1">Contraseña</label>
              <input type="password" name="pass" class="form-control uk-input" id="exampleInputPassword1" placeholder="Ingrese Contraseña">
            </div>
            <div class="form-group">
              <label class="uk-form-label text-center" for="exampleInputEmail1">Nombre</label>
              <input type="text" name="name" class="form-control uk-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese Nombre">
            </div>
            <div class="form-group">
              <label class="uk-form-label text-center" for="exampleInputEmail1">Apellido</label>
              <input type="text" name="surname" class="form-control uk-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese Apellido">
            </div>
            <div class="form-group">
              <button type="submit" class="uk-button btn-warning btn-block">Registrarse</button>
            </div>
          </form>
          <!-- ACA ARRANCA FACEBOOK

          <script>
              var finished_rendering = function() {
                console.log("finished rendering plugins");
                var spinner = document.getElementById("spinner");
                spinner.removeAttribute("style");
                spinner.removeChild(spinner.childNodes[0]);
              }
              FB.Event.subscribe('xfbml.render', finished_rendering);
          </script>
          <div id="spinner" style="background: #4267b2; border-radius: 5px;color: white;height: 40px;text-align: center;width: 250px;">Loading<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-use-continue-as="true"></div>
              </div>
          ACA TERMINA FACEBOOK -->
        </div>
        </li>
      </ul>
    </div>
  </div>



  <?php include (ROOT."views/footer.php"); ?>
