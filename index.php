<?php include_once("./lib/conn.php"); ?>
<?php 
  $node = trim((isset($_GET["n"]) ? $_GET["n"] : "" ));
  $param1 = trim((isset($_GET["p"]) ? $_GET["p"] : ""));
  // $param2 = trim((isset($_GET["t"]) ? $_GET["t"] : ""));
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
  (function() {
    var config = {
      apiKey: "AIzaSyCBHrFjKrr_E3aQnyrI1-7lns_Tlz_ckMk",
      authDomain: "tj-project-57865.firebaseapp.com",
      databaseURL: "https://tj-project-57865.firebaseio.com",
      projectId: "tj-project-57865",
      storageBucket: "",
      messagingSenderId: "883397627167"
    };

    firebase.initializeApp(config);

    var firebaseRef = firebase.database().ref().push();
    var geoFire = new GeoFire(firebaseRef);

    var getLocation = function() {
      if (typeof navigator !== "undefined" && typeof navigator.geolocation !== "undefined") {
        console.log("Asking user to get their location");
        navigator.geolocation.getCurrentPosition(geolocationCallback, errorHandler);
      } else {
        console.log("Your browser does not support the HTML5 Geolocation API, so this app not work.");
      }
    };

    var geolocationCallback = function (location) {
      var lat = location.coords.latitude;
      var lng = location.coords.longitude;
      console.log("Retrieved user's location : [" + lat + ", " + lng + "]");

      var username = "<?php echo ((isset($_SESSION["permission"]) && $_SESSION["permission"] === "staff" ) ? $_SESSION["name"] : "Guest" ); ?>";
      geoFire.set(username, [lat,lng]).then(function() {
        console.log("Current user " + username + "'s location has been added to GeoFire");

        firebaseRef.child(username).onDisconnect().remove();
        console.log("Added handler to remove user " + username + "grom GeoFire when you leave this page.");
      }).catch(function(err) {
        console.log("Error adding user " + username + "'s location to GeoFire");
      });
    }

    var errorHandler = function(err) {
      if (err.code == 1) {
        console.log("Error: PERMISSION_DENIED: User denied access to their location");
      } else if (err.code === 2) {
        console.log("Error: POSITION_UNAVAILABLE: Network is down or positioning satellites cannot be reached");
      } else if (err.code === 3) {
        console.log("Error: TIMEOUT: Calculating the user's location too took long");
      } else {
        console.log("Unexpected error code")
      }
    };

    getLocation();

    // log
    // function log(message) {
    //   var childDiv = document.createElement("div");
    //   var textNode = document.createTextNode(message);
    //   childDev.appendChild(textNode);
    //   document.getElementById("log").appendChild(childDiv);
    // }
  })();

    function initMap() {

      if(navigator.geolocation) {
        let bangkok_pos = new google.maps.LatLng(13.736717, 100.523186);
        navigator.geolocation.getCurrentPosition(function(position) {       
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
  
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBHrFjKrr_E3aQnyrI1-7lns_Tlz_ckMk&callback=initMap">
  </script>

</body>

</html>