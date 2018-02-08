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
  <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
  <meta name="theme-color" content="#ffffff">
  <script src="bundle.js"></script>
</head>

<body>

  <?php include_once("./components/navbar.php"); ?>

  <?php include_once($inc); ?>

  <?php include_once("./components/footer.php"); ?>

  <script>

    var config = {
      apiKey: "AIzaSyCBHrFjKrr_E3aQnyrI1-7lns_Tlz_ckMk",
      authDomain: "tj-project-57865.firebaseapp.com",
      databaseURL: "https://tj-project-57865.firebaseio.com",
      projectId: "tj-project-57865",
      storageBucket: "tj-project-57865.appspot.com",
      messagingSenderId: "883397627167"
    };

    firebase.initializeApp(config);
    var firebaseRef = firebase.database();

    /**
     * get staff location and save on firebase
     */
    (function() {

      var user_type = "<?php echo $_SESSION["permission"]; ?>";
      var username = "<?php echo ((isset($_SESSION["permission"]) && $_SESSION["permission"] === "staff" ) ? $_SESSION["name"] : "Guest" ); ?>";

      var getLocation = function() {
        if (typeof navigator !== "undefined" && typeof navigator.geolocation !== "undefined") {
          console.log("Asking user to get their location");
          navigator.geolocation.getCurrentPosition(geolocationCallback, errorHandler);
        } else {
          console.log("Your browser does not support the HTML5 Geolocation API, so this app not work.");
        }
      };

      var geolocationCallback = function (location) {
        let lat = location.coords.latitude;
        let lng = location.coords.longitude;
        console.log("Retrieved user's location : [" + lat + ", " + lng + "]");

        firebaseRef.ref("staff/" + username).set({
          name: username,
          pos: {
            lat: lat,
            lng: lng
          },
          timestamp: +new Date()
        });
        console.log("send location to firebase");
        // firebaseRef.child(username).onDisconnect().remove();
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

      if (user_type === "staff") {
        setInterval(function() {
          getLocation();
        }, 5000);
      }

    })(); 

    /**
     * init map and staff's marker 
     */
    function initMap() {

      var bangkok_pos = new google.maps.LatLng(13.736717, 100.523186);
      var fashionI_pos = new google.maps.LatLng(13.8252695, 100.6762325);

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: fashionI_pos
      });

      var staffPosition = firebaseRef.ref("staff/");

      staffPosition.on("value", function(snapshot) {
        _.map(snapshot.val(), function(staff) {
          // console.log(staff);
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(staff.pos.lat, staff.pos.lng),
            map: map,
            title: staff.name
          });
          console.log(marker);
        })
      }, function(err) {
        console.log(err.code);
      });
    }
  </script>
  
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBHrFjKrr_E3aQnyrI1-7lns_Tlz_ckMk&callback=initMap">
  </script>

</body>

</html>