<?php
  $uid = $param1;
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["btnEditUser"])) {
      try {

        $edit_user_stmt = $conn->prepare("UPDATE `user` AS `u` SET 
                                        `u`.`user_password` = :pass, 
                                        `u`.`user_name` = :name, 
                                        `u`.`user_email` = :email,
                                        `u`.`user_tel` = :tel 
                                        WHERE `u`.`user_id` = :uid");
        $edit_user_stmt->bindParam(":pass", $_POST["ePass"]);
        $edit_user_stmt->bindParam(":name", $_POST["eName"]);
        $edit_user_stmt->bindParam(":email", $_POST["eEmail"]);
        $edit_user_stmt->bindParam(":tel", $_POST["eTel"]);
        $edit_user_stmt->bindParam(":uid", $uid);
        $edit_user_stmt->execute();
        
        $user->redirect("manage-user");
      } catch (PDOException $e) {

      }
    }
  }
?>
<div class="container-fluid" id="wrapper">
  <div class="row d-flex d-md-block flex-nowrap wrapper">
    <?php include_once(__DIR__ . "/components/sidebar.php"); ?>
    <main class="col-md-10 col-12 float-left col px-5 pl-md-2 pt-2 main" id="main">
      <a href="#" data-target="#sidebar" data-toggle="collapse" id="toggleSidebar"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a>
      <div class="page-header"><h2>แก้ไขผู้ใช้</h2></div>
      <nav aria-lebel="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="manage-user">ข้อมูลผู้ใช้</a></li>
          <li class="breadcrumb-item active" aria-current="page">แก้ไขผู้ใช้</li>
        </ol>
      </nav>
      <hr>
      <?php
      $user_stmt = $conn->prepare("SELECT * FROM `user` AS `u` WHERE `u`.`user_id` = :uid");
      $user_stmt->bindParam(":uid", $uid);
      $user_stmt->execute();
      $user_row = $user_stmt->fetch(PDO::FETCH_ASSOC);
      if ($user_row["user_level"] == 2) {
        echo '<form class="mx-5 px-5" method="post" id="editUser">
        <div class="form-group row">
          <label for="uEmail" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-9">
            <input type="email" class="form-control" id="eEmail" name="eEmail" value="'.$user_row["user_email"].'">
          </div>
        </div>

        <div class="form-group row">
          <label for="uPass" class="col-sm-3 col-form-label">Password</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="ePass" name="ePass" value="'.$user_row["user_password"].'">
          </div>
        </div>

        <hr>

        <div class="form-group row">
          <label for="uName" class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="eName" name="eName" value="'.$user_row["user_name"].'">
          </div>
        </div>

        <div class="form-group row">
          <label for="uTel" class="col-sm-3 col-form-label">Tel.</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="eTel" name="eTel" value="'.$user_row["user_tel"].'">
          </div>
        </div>
        <button class="btn btn-primary btn-block" type="submit" form="editUser" name="btnEditUser" value="true">แก้ไข</button>
      </form>';
      }
      ?>
    </main>
  </div>
</div>
