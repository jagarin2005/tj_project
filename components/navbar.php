<!-- navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="./index.php">
      Excellent 
      <span class="fa-stack fa-1x fa-fw" style="font-size: 0.75em;">
        <i class="fa fa-desktop fa-stack-2x"></i>
        <i class="fa fa-wrench fa-flip-horizontal fa-stack-1x" style="top: -0.4125em;font-size: 0.8em;"></i>
      </span> 
      Computer
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto mx-auto">
        <li class="nav-item px-3 <?php echo ($node == "") ? 'active' : "" ?>">
          <a class="nav-link" href="index.php"><?php echo ($node == "") ? '<i class="fa fa-home fa-fw"></i>' : "" ?> Home <?php echo ($node == "") ? '<span class="sr-only">(current)</span>' : "" ?></a>
        </li>
        <li class="nav-item px-3 <?php echo ($node == "sv") ? 'active' : "" ?>">
          <a class="nav-link" href="index.php?n=sv"><?php echo ($node == "sv") ? '<i class="fa fa-wrench fa-fw"></i>' : "" ?> Service <?php echo ($node == "sv") ? '<span class="sr-only">(current)</span>' : "" ?></a>
        </li>
        <li class="nav-item px-3 <?php echo ($node == "prc") ? 'active' : "" ?>">
          <a class="nav-link" href="index.php?n=prc"><?php echo ($node == "prc") ? '<i class="fa fa-tags fa-fw"></i>' : "" ?> Pricing <?php echo ($node == "prc") ? '<span class="sr-only">(current)</span>' : "" ?></a>
        </li>
      </ul>
      <?php 
      if (!$user->isLogin()) {
        echo '<ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item';  echo ($node == "reg") ? ' active' : ""; echo '">
            <a class="nav-link" href="./index.php?n=reg"> '; echo ($node == "reg") ? '<i class="fa fa-user-circle fa-fw"></i>' : ""; echo ' Register '; echo ($node == "reg") ? '<span class="sr-only">(current)</span>' : ""; echo '</a>
          </li>
          <li class="nav-item '; echo ($node == "lgn") ? ' active' : ""; echo '">
            <a class="nav-link" href="./index.php?n=lgn"> '; echo ($node == "lgn") ? '<i class="fa fa-sign-in fa-fw"></i>' : ""; echo ' Login '; echo ($node == "lgn") ? '<span class="sr-only">(current)</span>' : ""; echo '</a>
          </li>
        </ul>';
      } else {
        echo '<ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user fa-fw"></i> '.$_SESSION["name"].'
                  </a>
                  <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#"><i class="fa fa-id-card-o fa-fw"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-cog fa-fw"></i> Setting</a>
                    ';
                    echo '<a class="dropdown-item" href="index.php?n=dshb"><i class="fa fa-cog fa-fw"></i> Dashboard</a>';
                    echo '<div class="dropdown-divider"></div>
                    <form id="lgt" method="post">
                      <button class="dropdown-item" name="lgt" value="true" form="lgt" type="submit" style="cursor: pointer;"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </form>
                  </div>
                </li>
              </ul>';
      }
      ?>
  </div>
</nav>
<!-- /navbar -->
<?php 
  if (isset($_SERVER["REQUEST_METHOD"])) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      if (isset($_POST["lgt"])) {
        if ($user->logout()) {
          $user->redirect();
        }
      }
    }
  }
?>