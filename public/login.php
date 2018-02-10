<?php 
  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["btnLgn"])) {
      if ($user->login($_POST["ue"], $_POST["up"])) {
        if ($user->isAdmin()) {
          $user->redirect();
        } else if ($user->isStaff()) {
          $user->redirect();
        } else if ($user->isUser()) {
          $user->redirect();
        } else {
          $user->user_alert = "ไม่สามารถเข้าสู่ระบบได้";
        }
      }
    }

  }
?>

<section class="container" id="wrapper">
  <article class="row">
    <div class="card col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-xl-4 offset-xl-4">
      <div class="card-body">
        <h3 class="card-title text-center">LOGIN</h3><hr>
        <form method="post" id="lgn">
          <div class="form-group">
            <input class="form-control form-control-lg" type="email" name="ue" id="ue" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <input class="form-control form-control-lg" type="password" name="up" id="up" placeholder="Password">
          </div>
          <button class="btn btn-primary btn-lg btn-block" type="submit" form="lgn" name="btnLgn" value="true">Login</button>
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

