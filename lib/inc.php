<?php
  $title = "Excellent Computer";
  $inc = "";
  if ($node === "reg") {
    $inc = "./public/register.php";
    $title = "Excellent Computer - Register";
  } else if ($node === "lgn") {
    $inc = "./public/login.php";
    $title = "Excellent Computer - Login";
  } else if ($node === "prc") {
    $inc = "./public/pricing.php";
    $title = "Excellent Computer - Pricing";
  } else if ($node === "sv") {
    $inc = "./public/service.php";
    $title = "Excellent Computer - Service";
  } else {
    $inc =  "./public/home.php";
    $title = "Excellent Computer - Home";
  }
?>