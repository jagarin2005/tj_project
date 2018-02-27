<?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["confirmBtn"])) {
      if ($_POST["confirmBtn"] == "true") {

        try {

          $confirm_stmt = $conn->prepare("UPDATE `r_invoice` SET `r_status` = 4 WHERE `r_id` = :rid");
          $confirm_stmt->bindParam(":rid", $_POST["rid"]);
          $confirm_stmt->execute();
          $user->redirect("r-list");

        } catch (PDOException $e) {

          echo "ERROR : CANNOT CHANGE STATUS : ".$_POST["rid"]."<br> ".$e->getMessage();

        }

      }
    }
  }
?>


<div class="container-fluid" id="wrapper">
  <div class="row d-flex d-md-block flex-nowrap wrapper  clearfix">
    <?php include_once(__DIR__ . "/components/sidebar.php"); ?>
    <main class="col-md-10 col-12 float-left col px-5 pl-md-2 pt-2 main" id="main">
    <a href="#" data-target="#sidebar" data-toggle="collapse" id="toggleSidebar"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a>
      <div class="page-header">
        <h2>รายการสั่งซ่อม</h2>
      </div>
      <hr>
      <div class="row">
        <div class="col">
          <table class="table table-hover table-sm" id="rlist_table">
            <thead>
              <tr>
                <th>เลขที่ใบซ่อม</th>
                <th>วันที่รับซ่อม</th>
                <th>ยี่ห้อเครื่อง</th>
                <th>ค่าซ่อม</th>
                <th>ช่างผู้ซ่อม</th>
                <th>สถานะการซ่อม</th>
                <th><i class="fa fa-cog"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $check_stmt = $conn->prepare("SELECT * FROM `r_invoice` AS `r`
                                              INNER JOIN `user` AS `u` ON `u`.`user_id` = `r`.`user_id`
                                              WHERE `r`.`user_id` = :user
                                              ORDER BY `r`.`r_date_in` DESC");
                $check_stmt->bindParam(":user", $_SESSION["uid"]);
                $check_stmt->execute();
                while ($check_rows = $check_stmt->fetch(PDO::FETCH_ASSOC)) {
                  $date_in = date('d/m/Y', strtotime($check_rows["r_date_in"]));
                  $staff_name_stmt = $conn->prepare("SELECT `user_name` FROM `user` AS `u` INNER JOIN `staff` AS `s` ON `s`.`user_id` = `u`.`user_id` WHERE `s`.`staff_id` = ".$check_rows["staff_id"]);
                  $staff_name_stmt->execute();
                  $staff_name = $staff_name_stmt->fetch(PDO::FETCH_ASSOC);
                  echo '
                    <tr>
                      <td scope="row">'.$check_rows["r_id"].'</td>
                      <td>'.$date_in.'</td>
                      <td>'.$check_rows["r_model"].'</td>
                      <td>'.$check_rows["r_cost"].'</td>
                      <td>'.$staff_name["user_name"].'</td>
                      <td>'.$func->rStatus($check_rows["r_status"]).'</td>
                      <td>
                        '.((( $check_rows["r_status"] === "4" )  ? '<span><i class="fa fa-check-circle-o fa-fw text-success"></i> ได้รับเครื่องแล้ว</span>' : (($check_rows["r_status"] === "3") ? '<button class="btn btn-outline-success btn-sm pull-right" data-toggle="modal" data-rid="'.$check_rows["r_id"].'" data-target="#confirmModal">ยืนยันการได้รับเครื่อง</button>' : '<span><i class="fa fa-clock-o fa-fw"></i> รอการซ่อม</span>' ))).'
                      </td>
                    </tr>
                  ';
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Confirm Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmLabel">ยืนยันการได้รับเครื่อง</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form method="post" id="confirm">
          <p>ยืนยันการได้รับเครื่องที่ส่งซ่อม หมายเลขการซ่อม <strong id="confirmText"></strong> ? </p>
          <input type="hidden" name="rid" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">ปิด</button>
        <button class="btn btn-primary" type="submit" name="confirmBtn" form="confirm" value="true">ยืนยัน</button></button>
      </div>
    </div>
  </div>
</div>
<!-- /Delete R-Invoice Modal -->
