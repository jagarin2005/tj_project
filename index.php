<?php include_once("./lib/conn.php"); ?>
<?php 
  $node = trim((isset($_GET["n"]) ? $_GET["n"] : "" ));
  $param1 = trim((isset($_GET["p"]) ? $_GET["p"] : ""));
  include_once("./lib/inc.php");
  
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
  <link rel="manifest" href="manifest.json">
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
  <meta name="theme-color" content="#ffffff">
  <script src="bundle.js"></script>
</head>

<body>

  <?php include_once("./components/navbar.php"); ?>

  <?php include_once($inc); ?>

  <?php include_once("./components/footer.php"); ?>

</body>

</html>