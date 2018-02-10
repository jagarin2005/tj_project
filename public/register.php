<section class="container" id="wrapper">
  <article class="row">
    <div class="card col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-xl-4 offset-xl-4">
      <div class="card-body">
        <h3 class="card-title text-center">REGISTER</h3><hr>
        <form method="post" id="reg">
          <div class="form-group">
            <input class="form-control form-control-lg" type="email" name="uemail" id="uemail" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <input class="form-control form-control-lg" type="password" name="upass" id="upass" placeholder="Password">
          </div>
          <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="uname" id="uname" placeholder="Full Name">
          </div>
          <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="utel" id="utel" placeholder="Tel">
          </div>
          <button class="btn btn-primary btn-lg btn-block" type="submit" form="reg" name="btnReg" value="true">Register</button>
        </form>
        <?php
          if (isset($user->user_alert)) {
            echo '<div class="alert alert-danger alert-dismissible fade show" style="margin-top: 1rem;" role="alert">
                    '.$user->user_alert.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                  </div>';
          }
        ?>
      </div>
    </div>
  </article>
</section>
<?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["btnReg"])) {
      if ($user->register($_POST["uemail"], $_POST["upass"], $_POST["uname"], $_POST["utel"], 1)) {
        $user->redirect("login");
      }
    }
  }
?>