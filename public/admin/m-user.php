<?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["insUserBtn"])) {
      $ins_user_stmt = $conn->prepare("INSERT INTO `user` VALUES (NULL, :pass, :name, :email, 1, 2)");
      $ins_user_stmt->bindParam(":pass", $_POST["uPass"]);
      $ins_user_stmt->bindParam(":name", $_POST["uName"]);
      $ins_user_stmt->bindParam(":email", $_POST["uEmail"]);
      $ins_user_stmt->execute();

      $check_stmt = $conn->prepare("SELECT `user_id` FROM `user` WHERE `user_email` LIKE :email AND `user_name` LIKE :name");
      $check_stmt->bindParam(":email", $_POST["uEmail"]);
      $check_stmt->bindParam(":name", $_POST["uName"]);
      $check_stmt->execute();
      $check_row = $check_stmt->fetch(PDO::FETCH_ASSOC);

      $ins_staff_stmt = $conn->prepare("INSERT INTO `staff` VALUES (NULL, :name, :tel, :uid)");
      $ins_staff_stmt->bindParam(":name", $_POST["uName"]);
      $ins_staff_stmt->bindParam(":tel", $_POST["uTel"]);
      $ins_staff_stmt->bindParam(":uid", $check_row["user_id"]);
      $ins_staff_stmt->execute();
    }

    if (isset($_POST["delUserBtn"])) {
      if ($_POST["lvl"] == 1) {
        try {
          $del_user_stmt = $conn->prepare("DELETE FROM `user` WHERE `user_id` = :uid");
          $del_user_stmt->bindParam(":uid", $_POST["uid"]);
          $del_user_stmt->execute();
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      } else if ($_POST["lvl"] == 2) {
        try {
          $del_staff_stmt = $conn->prepare("DELETE FROM `staff` WHERE `user_id` = :uid");
          $del_staff_stmt->bindParam(":uid", $_POST["uid"]);
          $del_staff_stmt->execute();

          $del_user_stmt = $conn->prepare("DELETE FROM `user` WHERE `user_id` = :uid");
          $del_user_stmt->bindParam(":uid", $_POST["uid"]);
          $del_user_stmt->execute();
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      } 
    }
  }
  
?>
<div class="container-fluid" id="wrapper">
  <div class="row d-flex d-md-block flex-nowrap wrapper">
    <?php include_once(__DIR__ . "/components/sidebar.php"); ?>
    <main class="col-md-10 col-12 float-left col px-5 pl-md-2 pt-2 main" id="main">
      <a href="#" data-target="#sidebar" data-toggle="collapse" id="toggleSidebar"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a>
      <div class="page-header">
        <h2>ข้อมูลผู้ใช้ <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#insUserModal">เพิ่มพนักงาน</button></h2>        
      </div>
      <hr>
      <nav class="nav nav-pills nav-justified">
        <a class="nav-item nav-link active" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="nav-user" aria-selected="true">ผู้ใช้</a>
        <a class="nav-item nav-link" id="nav-staff-tab" data-toggle="tab" href="#nav-staff" role="tab" aria-controls="nav-staff" aria-selected="false">พนักงาน</a>
      </nav>
      <br>
      <div class="tab-content" id="nav-tabContents">

        <div class="tab-pane fade show active" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
          <div class="row">
            <div class="col">
              <table class="table table-hover table-sm" id="user_table">
                <thead>
                  <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col"><i class="fa fa-cog"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $user_stmt = $conn->prepare("SELECT * FROM `user` WHERE `user_level` = 1");
                    $user_stmt->execute();
                    while ($user_rows = $user_stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo '
                        <tr>
                          <td scope="row">'.$user_rows["user_email"].'</td>
                          <td>'.$user_rows["user_name"].'</td>
                          <td>'.$user->checkStatus($user_rows["user_status"]).'</td>
                          <td>
                            <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delUserModal" data-uid="'.$user_rows["user_id"].'" data-lvl="'.$user_rows["user_level"].'"><i class="fa fa-times fa-fw"></i> ลบ</button>
                          </td>
                        </tr>
                      ';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="nav-staff" role="tabpanel" aria-labelledby="nav-staff-tab">
          <div class="row">
            <div class="col">
              <table class="table table-hover table-sm" id="staff_table">
                <thead>
                  <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Tel</th>
                    <th scope="col">Status</th>
                    <th scope="col"><i class="fa fa-cog"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $staff_stmt = $conn->prepare("SELECT * FROM `user` INNER JOIN `staff` ON `staff`.`user_id` = `user`.`user_id` WHERE `user_level` = 2");
                    $staff_stmt->execute();
                    while ($staff_rows = $staff_stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo '
                        <tr>
                          <td scope="row">'.$staff_rows["user_email"].'</td>
                          <td>'.$staff_rows["user_name"].'</td>
                          <td>'.$staff_rows["staff_tel"].'</td>
                          <td>'.$user->checkStatus($staff_rows["user_status"]).'</td>
                          <td>
                            <a href="edit-user?p='.$staff_rows["user_id"].'"><button class="btn btn-outline-info btn-sm"><i class="fa fa-edit fa-fw"></i> แก้ไข</button></a>
                            <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delUserModal" data-uid="'.$staff_rows["user_id"].'" data-lvl="'.$staff_rows["user_level"].'"><i class="fa fa-times fa-fw"></i> ลบ</button>
                          </td>
                        </tr>
                      ';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
        
    </main>
  </div>
</div>

<!-- Insert User Modal -->
<div class="modal fade" id="insUserModal" tabindex="-1" role="dialog" aria-labelledby="insUserModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insUserLabel">เพิ่มพนักงาน</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form method="post" id="insUser">

          <div class="form-group row">
            <label for="uEmail" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="uEmail" name="uEmail" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="uPass" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="uPass" name="uPass" value="">
            </div>
          </div>

          <hr>

          <div class="form-group row">
            <label for="uName" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="uName" name="uName" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="uTel" class="col-sm-3 col-form-label">Tel.</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="uTel" name="uTel" value="">
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">ปิด</button>
        <button class="btn btn-primary" type="submit" name="insUserBtn" form="insUser" value="true">เพิ่ม</button>
      </div>
    </div>
  </div>
</div>
<!-- /Inert User Modal -->

<!-- Delete User Modal -->
<div class="modal fade" id="delUserModal" tabindex="-1" role="dialog" aria-labelledby="delUserModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delUserLabel">ลบผู้ใช้</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form method="post" id="delUser">
          <p>Are you sure to delete user <strong id="delUserText"></strong> ? </p>
          <input type="hidden" name="uid" value="">
          <input type="hidden" name="lvl" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">ปิด</button>
        <button class="btn btn-danger" type="submit" name="delUserBtn" form="delUser" value="true">ลบ</button>
      </div>
    </div>
  </div>
</div>
<!-- /Delete User Modal -->