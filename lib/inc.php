<?php
  $inc =  "";
  $title = "";
  if ($node === "") {
    $inc = "./public/home.php";
    $title = "Excellent Computer";
  } else if ($node === "home") {
    $inc = "./public/home.php";
    $title = "Excellent Computer";
  } else if ($node === "register") {
    $inc = "./public/register.php";
    $title = "Excellent Computer - Register";
  } else if ($node === "login") {
    $inc = "./public/login.php";
    $title = "Excellent Computer - Login";
  } else if ($node === "contact") {
    $inc = "./public/contact.php";
    $title = "Excellent Computer - Contact us";
  } else if ($node === "service") {
    $inc = "./public/service.php";
    $title = "Excellent Computer - Service";
  } else if ($node === "about") {
    $inc = "./public/about.php";
    $title = "Excellent Computer - About";
  } else if ($user->isAdmin()) {
    if ($node === "dashboard") {
      $inc = "./public/admin/index.php";
      $title = "Excellent Computer - Admin";
    } else if ($node === "manage-user") {
      $inc = "./public/admin/m-user.php";
      $title = "Excellent Computer - ข้อมูลผู้ใช้";
    } else if ($node === "manage-check") {
      $inc = "./public/admin/m-check.php";
      $title = "Excellent Computer - ข้อมูลงานซ่อม";
    } else if ($node === "map") {
      $inc = "./public/admin/map.php";
      $title = "Excellent Computer - แผนที่";
    } else if ($node === "edit-user") {
      $inc = "./public/admin/e-user.php";
      $title = "Excellent Computer - แก้ไขผู้ใช้";
    } else if ($node === "edit-check") {
      $inc = "./public/admin/e-check.php";
      $title = "Excellent Computer - แก้ไขงานซ่อม";
    } else if ($node === "r-print") {
      $inc = "./public/admin/r-print.php";
      $title = "Excellent Computer - ใบแจ้งซ่อม";
    }

  } else if ($user->isStaff()) {
    if ($node === "dashboard") {
      $inc = "./public/staff/index.php";
      $title = "Excellent Computer - ".$_SESSION["name"];
    } else if ($node === "r-invoice") {
      $inc = "./public/staff/r-invoice.php";
      $title = "Excellent Computer - ".$_SESSION["name"];
    } else if ($node === "r-edit") {
      $inc = "./public/staff/r-edit.php";
      $title = "Excellent Computer - ".$_SESSION["name"];
    } else if ($node === "r-print") {
      $inc = "./public/staff/r-print.php";
      $title = "Excellent Computer - ".$_SESSION["name"];
    } else if ($node === "profile") {
      $inc = "./public/staff/profile.php";
      $title = "Excellent Computer - ".$_SESSION["name"];
    }

  } else if ($user->isUser()) {
    if ($node === "dashboard") {
      $inc = "./public/user/index.php";
      $title = "Excellent Computer - ".$_SESSION["name"];
    } else if ($node === "profile") {
      $inc = "./public/user/profile.php";
      $title = "Excellent Conputer - ".$_SESSION["name"];
    } else if ($node === "r-list") {
      $inc = "./public/user/r-order.php";
      $title = "Excellent Computer - ".$_SESSION["name"];
    }

  } else {
    $inc =  "./public/404.php";
    $title = "Excellent Computer - Error 404 : Not found";
  }
?>
