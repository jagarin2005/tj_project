<?php include_once("./lib/conn.php"); ?>
<?php 
  $node = (isset($_GET["n"]) ? $_GET["n"] : "" );
  $inc = ($node == "reg") 
    ? "./public/register.php" 
    : (($node == "lgn")
    ? "./public/login.php"
    : "./home.php");
  
?>
<?php 
  ob_start();
  include_once("./components/head.php"); 
  $buffer = ob_get_contents();
  ob_end_clean();

  $title = "หน้าหลัก";
  $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

  echo $buffer;

?>

<body>
  
  <!-- navbar -->
  <?php include_once("./components/navbar.php"); ?>
  <!-- /navbar -->

  <section class="container" id="wrapper">
  <?php 
    include_once($inc);
  ?>
  </section>

  <!-- footer -->
  <?php include_once("./components/foot.php"); ?>
  <!-- /footer -->
</body>

</html>