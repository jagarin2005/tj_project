<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">
      <span class="fa-stack fa-1x fa-fw" style="font-size: 0.75em;">
        <i class="fa fa-desktop fa-stack-2x"></i>
        <i class="fa fa-wrench fa-flip-horizontal fa-stack-1x" style="top: -0.4125em;font-size: 0.8em;"></i>
      </span> Excellent Computer</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php echo ($node == "") ? 'active' : "" ?>">
          <a class="nav-link" href="index.php">Home <?php echo ($node == "") ? '<span class="sr-only">(current)</span>' : "" ?></a>
        </li>
        <li class="nav-item <?php echo ($node == "p2") ? 'active' : "" ?>">
          <a class="nav-link" href="#">Service <?php echo ($node == "p2") ? '<span class="sr-only">(current)</span>' : "" ?></a>
        </li>
        <li class="nav-item <?php echo ($node == "p3") ? 'active' : "" ?>">
          <a class="nav-link" href="#">Pricing <?php echo ($node == "p3") ? '<span class="sr-only">(current)</span>' : "" ?></a>
        </li>
      </ul>
      <ul class="navbar-nav my-2 my-lg-0">
        <li class="nav-item <?php echo ($node == "reg") ? 'active' : "" ?>">
          <a class="nav-link" href="./index.php?n=reg"> Register <?php echo ($node == "reg") ? '<span class="sr-only">(current)</span>' : "" ?></a>
        </li>
        <li class="nav-item <?php echo ($node == "lgn") ? 'active' : "" ?>">
          <a class="nav-link" href="./index.php?n=lgn"> Login <?php echo ($node == "lgn") ? '<span class="sr-only">(current)</span>' : "" ?></a>
        </li>
      </ul>
  </div>
</nav>