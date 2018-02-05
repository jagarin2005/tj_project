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
  
  <script>

    function initMap() {

      if(navigator.geolocation) {
        let bangkok_pos = new google.maps.LatLng(13.736717, 100.523186);
        navigator.geolocation.getCurrentPosition(function(position) {
          geoFire.set("Person 1", [position.coords.latitude, position.coords.longitude]).then(function() {
            console.log("Location added");
          }).catch(function(err) {
            console.log(err);
          });
          
          var pos = new google.maps.LatLng(position.coords.latitude,
                                          position.coords.longitude);

          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: bangkok_pos
          });

          var marker = new google.maps.Marker({
            position: pos,
            map: map,
            title: 'Hello World!'
          });
        });
      }
      
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCkc5YY1gKzJuJKIJYJMXi_xSzAQYFi6Q&callback=initMap"></script>

</body>

</html>