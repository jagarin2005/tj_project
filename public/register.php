<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["btnReg"])) {
      if ($user->register($_POST["uemail"], $_POST["upass"], $_POST["uname"], 1)) {
        $user->redirect("index.php?n=lgn");
      }
    }
  }
?>

<article class="row">
    <div class="card" style="padding: 30px 40px;margin: auto; top: 20vh;">
      <div class="card-body">
        <h3 class="card-title text-center">Register</h3><hr>
        <form method="post" id="reg">
          <div class="form-group">
            <input class="form-control form-control-lg" type="email" name="uemail" id="uemail" placeholder="Email">
          </div>
          <div class="form-group">
            <input class="form-control form-control-lg" type="password" name="upass" id="upass" placeholder="Password">
          </div>
          <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="uname" id="uname" placeholder="Full Name">
          </div>
          <button class="btn btn-primary btn-lg btn-block" type="submit" form="reg" name="btnReg" value="true">Register</button>
        </form>
      </div>
    </div>

    <?php
    if (isset($user->user_alert)) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>เกิดช้อผิดพลาด</strong> '.$user->user_alert.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>';
    }
    ?>
</article>
