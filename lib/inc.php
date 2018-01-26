<?php
  $inc =  "";
  $title = "";
  if ($node === "") {
    $inc = "./public/home.php";
    $title = "Excellent Computer";
  } else if ($node === "reg") {
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

  } else if ($user->isAdmin()) {
    if ($node === "dshb") {
      $inc = "./public/admin/index.php";
      $title = "Excellent Computer - Admin";
    } else if ($node === "muser") {
      $inc = "./public/admin/m-user.php";
      $title = "Excellent Computer - ข้อมูลผู้ใช้";
    } else if ($node === "check") {
      $inc = "./public/admin/m-check.php";
      $title = "Excellent Computer - ข้อมูลงานซ่อม";
    } else if ($node === "map") {
      $inc = "./public/admin/map.php";
      $title = "Excellent Computer - แผนที่";
    }
    
  } else if ($user->isStaff()) {
    if ($node === "dshb") {
      $inc = "./public/staff/index.php";
      $title = "Excellent Computer - Staff";
    }
    
  } else if ($user->isUser()) {
    if ($node === "dshb") {
      $inc = "./public/user/index.php";
      $title = "Excellent Computer - User";
    } 

  } else {
    $inc =  "./public/home.php";
    $title = "Excellent Computer - Home";
  }
?>