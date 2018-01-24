<?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["btnLgn"])) {
      if ($user->login($_POST["ue"], $_POST["up"])) {
        
      }
    }
  }
?>

<article class="row">
    <div class="card" style="padding: 30px 40px;margin: auto; top: 20vh;">
      <div class="card-body">
        <h3 class="card-title text-center">Login</h3><hr>
        <form method="post" id="lgn">
          <div class="form-group">
            <input class="form-control form-control-lg" type="email" name="ue" id="ue" placeholder="Email">
          </div>
          <div class="form-group">
            <input class="form-control form-control-lg" type="password" name="up" id="up" placeholder="Password">
          </div>
          <button class="btn btn-primary btn-lg btn-block" type="submit" form="lgn" name="btnLgn" value="true">Login</button>
        </form>
      </div>
    </div>
</article>

<?php 
  
?>