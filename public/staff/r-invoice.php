<?php 
  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["insRinvoiceBtn"])) {
      if ($_POST["c_reg"] == "true") {
        try {
          $user_stmt = $conn->prepare("SELECT * FROM `user` WHERE `user_email` LIKE :cemail");
          $user_stmt->bindParam(":cemail", $_POST["c_email"]);
          $user_stmt->execute();
          $user_row = $user_stmt->fetch(PDO::FETCH_ASSOC);

          $ins_r_stmt = $conn->prepare("INSERT INTO `r_invoice` VALUES (NULL, :uid, :uname, :utel, 
                                                                        :r_date_in, :r_date_fin, NULL,
                                                                        :r_type, :r_type2, :r_type2_desc, :r_model, 
                                                                        :r_eq, :r_eq2, :r_eq3, 
                                                                        :r_cost, 1, :staff)");
          $ins_r_stmt->bindParam(":uid", $user_row["user_id"]);
          $ins_r_stmt->bindParam(":uname", $user_row["user_name"]);
          $ins_r_stmt->bindParam(":utel", $user_row["user_tel"]);
          $ins_r_stmt->bindParam(":r_date_in", $_POST["r_date_in"]);
          $ins_r_stmt->bindParam(":r_date_fin", $_POST["r_date_fin"]);
          $ins_r_stmt->bindParam(":r_type", $_POST["r_type"]);
          $ins_r_stmt->bindParam(":r_type2", $_POST["r_type2"]);
          $ins_r_stmt->bindParam(":r_type2_desc", $_POST["r_type2_desc"]);
          $ins_r_stmt->bindParam(":r_model", $_POST["r_model"]);
          $ins_r_stmt->bindParam(":r_eq", $_POST["r_eq"]);
          $ins_r_stmt->bindParam(":r_eq2", $_POST["r_eq2"]);
          $ins_r_stmt->bindParam(":r_eq3", $_POST["r_eq3"]);
          $ins_r_stmt->bindParam(":r_cost", $_POST["r_cots"]);
          $ins_r_stmt->bindParam(":staff", $_POST["r_staff"]);
          $ins_r_stmt->execute();
          $user->redirect("manage-check");
        } catch (PDOException $e) {
          echo 'ERROR : '. $e->getMessage();
        }

      } else if ($_POST["c_reg"] == "false") {
        try {
          $ins_r_stmt = $conn->prepare("INSERT INTO `r_invoice` VALUES (NULL, NULL, :uname, :utel, 
                                                                        :r_date_in, :r_date_fin, NULL,
                                                                        :r_type, :r_type2, :r_type2_desc, :r_model, 
                                                                        :r_eq, :r_eq2, :r_eq3, 
                                                                        :r_cost, 1, :staff)");
          $ins_r_stmt->bindParam(":uname", $_POST["c_name"]);
          $ins_r_stmt->bindParam(":utel", $_POST["c_tel"]);
          $ins_r_stmt->bindParam(":r_date_in", $_POST["r_date_in"]);
          $ins_r_stmt->bindParam(":r_date_fin", $_POST["r_date_fin"]);
          $ins_r_stmt->bindParam(":r_type", $_POST["r_type"]);
          $ins_r_stmt->bindParam(":r_type2", $_POST["r_type2"]);
          $ins_r_stmt->bindParam(":r_type2_desc", $_POST["r_type2_desc"]);
          $ins_r_stmt->bindParam(":r_model", $_POST["r_model"]);
          $ins_r_stmt->bindParam(":r_eq", $_POST["r_eq"]);
          $ins_r_stmt->bindParam(":r_eq2", $_POST["r_eq2"]);
          $ins_r_stmt->bindParam(":r_eq3", $_POST["r_eq3"]);
          $ins_r_stmt->bindParam(":r_cost", $_POST["r_cost"]);
          $ins_r_stmt->bindParam(":staff", $_POST["r_staff"]);
          $ins_r_stmt->execute();
          $user->redirect("manage-check");
        } catch (PDOException $e) {
          echo 'ERROR : '. $e->getMessage();
        }
      }
    }

    if (isset($_POST["delRinvoiceBtn"])) {
      try {
        $del_r_stmt = $conn->prepare("DELETE FROM `r_invoice` WHERE `r_id` = :rid");
        $del_r_stmt->bindParam(":rid", $_POST["rid"]);
        $del_r_stmt->execute();
        $user->redirect("manage-check");
      } catch (PDOException $e) {
        echo 'ERROR : '. $e->getMessage();
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
        <h2>ข้อมูลงานซ่อม <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#insRinvoiceModal"> เพิ่มใบแจ้งซ่อม</button></h2>
      </div>
      <hr>
      <div class="row">
        <div class="col">
          <table class="table table-hover table-sm" id="user_table">
            <thead>
              <tr>
                <th>เลขที่ใบซ่อม</th>
                <th>ชื่อลูกค้า</th>
                <th>เบอร์ลูกค้า</th>
                <th>วันที่รับซ่อม</th>
                <th>ช่างผู้ซ่อม</th>
                <th>สถานะการซ่อม</th>
                <th><i class="fa fa-cog"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $check_stmt = $conn->prepare("SELECT * FROM `r_invoice` AS `r`
                                              INNER JOIN `staff` AS `s` ON `s`.`staff_id` = `r`.`staff_id`
                                              ORDER BY `r_date_in` DESC");
                $check_stmt->execute();
                while ($check_rows = $check_stmt->fetch(PDO::FETCH_ASSOC)) {
                  $date_in = date('d/m/Y', strtotime($check_rows["r_date_in"]));
                  $staff_name_stmt = $conn->prepare("SELECT `user_name` FROM `user` AS `u` INNER JOIN `staff` AS `s` ON `s`.`user_id` = `u`.`user_id` WHERE `s`.`staff_id` = ".$check_rows["staff_id"]);
                  $staff_name_stmt->execute();
                  $staff_name = $staff_name_stmt->fetch(PDO::FETCH_ASSOC);
                  echo '
                    <tr>
                      <td scope="row">'.$check_rows["r_id"].'</td>
                      <td>'.$check_rows["user_name"].'</td>
                      <td>'.$check_rows["user_tel"].'</td>
                      <td>'.$date_in.'</td>
                      <td>'.$staff_name["user_name"].'</td>
                      <td>'.$func->rStatus($check_rows["r_status"]).'</td>
                      <td>
                        <a href="r-print?p='.$check_rows["r_id"].'"><button class="btn btn-outline-info btn-sm"><i class="fa fa-eye fa-fw"></i> ดู</button></a>
                        <a href="edit-check?p='.$check_rows["r_id"].'"><button class="btn btn-outline-success btn-sm"><i class="fa fa-edit fa-fw"></i> แก้ไข</button></a>
                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delRinvoiceModal" data-rid="'.$check_rows["r_id"].'"><i class="fa fa-times fa-fw"></i> ลบ</button>
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

<!-- Insert R-Invoice Modal -->
<div class="modal fade" id="insRinvoiceModal" tabindex="-1" role="dialog" aria-labelledby="insRinvoiceModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insRinvoiceLabel">เพิ่มใบแจ้งซ่อม</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form method="post" id="insRinvoice">

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="date_in">วันที่รับเครื่องซ่อม</label>
              <input class="form-control" type="date" name="r_date_in" id="r_date_in" value="<?php echo date('Y-m-d'); ?>" placeholder="วันที่รับเครื่องซ่อม" required>
            </div>
            <div class="form-group col-md-6">
              <label for="date_fin">วันที่นัดรับเครื่อง</label>
              <input class="form-control" type="date" name="r_date_fin" id="r_date_fin" value="" placeholder="วันที่นัดรับเครื่อง" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="c_reg" id="reg" value="true" checked>
                <label class="form-check-label" for="reg">
                  เป็นสมาชิก
                </label>
              </div>
              <input type="email" class="form-control" id="c_email" name="c_email" placeholder="Email">
            </div>

            <div class="form-group col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="c_reg" id="unreg" value="false">
                <label class="form-check-label" for="unreg">
                  ไม่ได้เป็นสมาชิก
                </label>
              </div>
              <input type="text" class="form-control" id="c_name" name="c_name" placeholder="ชื่อลูกค้า">
              <input type="tel" class="form-control" id="c_tel" name="c_tel" placeholder="เบอร์ลูกค้า">
            </div>
          </div>

          <hr>

          <div class="form-row">
            <div class="form-group col-md-6">
              <legend class="col-form-label pt-0">ประเภทเครื่อง</legend>
              <div class="col-md-12">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="r_type" id="r_type_1" value="PC" checked>
                  <label class="form-check-label" for="r_type_1">
                    PC
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="r_type" id="r_type_2" value="NB">
                  <label class="form-check-label" for="r_type_2">
                    NB
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="r_type" id="r_type_3" value="อุปกรณ์">
                  <label class="form-check-label" for="r_type_3">
                    อุปกรณ์
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group col-md-6">
              <legend class="col-form-label pt-0">ประเภทการซ่อม</legend>
              <div class="col-md-12">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="r_type2" id="r_type2_1" value="ซ่อม" checked>
                  <label class="form-check-label" for="r_type2_1">
                    ซ่อม
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="r_type2" id="r_type2_2" value="เคลม">
                  <label class="form-check-label" for="r_type2_2">
                    เคลม
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="r_type2" id="r_type2_3" value="อื่นๆ">
                  <label class="form-check-label mr-3" for="r_type2_3">
                    อื่นๆ
                  </label>
                  <input class="form-control" type="text" name="r_type2_desc" id="r_type2_desc" value="" placeholder="">
                </div>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="r_model">เครื่องรุ่น</label>
              <input class="form-control" type="text" name="r_model" id="r_model" value="" placeholder="เครื่องรุ่น">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="r_eq">อุปกรณ์ที่ติดมาด้วย</label>
              <textarea class="form-control" name="r_eq" id="r_eq" cols="30" placeholder=""></textarea>
            </div>
            <div class="form-group col-md-4">
              <label for="r_eq2">อาการแจ้งเสีย</label>
              <textarea class="form-control" name="r_eq2" id="r_eq2" cols="30" placeholder=""></textarea>
            </div>
            <div class="form-group col-md-4">
              <label for="r_eq3">อุปกรณ์ที่เปลี่ยนระหว่างซ่อม</label>
              <textarea class="form-control" name="r_eq3" id="r_eq3" cols="30" placeholder=""></textarea>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="r_cost">รวมราคา</label>
              <input class="form-control" type="number" name="r_cost" id="r_cost" min="0" max="" value="" placeholder="รวมราคา">
            </div>

            <div class="form-group col-md-6">
              <label for="r_staff">ช่างผู้ซ่อม</label>
              <select class="form-control" name="r_staff" id="r_staff">
                <?php 
                  $staff_stmt = $conn->prepare("SELECT * FROM `staff` AS `s` INNER JOIN `user` AS `u` ON `u`.`user_id` = `s`.`user_id`");
                  $staff_stmt->execute();
                  while ($staff_rows = $staff_stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'.$staff_rows["staff_id"].'">'.$staff_rows["user_name"].'</option>';
                  }
                ?>
              </select>
            </div>
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">ปิด</button>
        <button class="btn btn-primary" type="submit" name="insRinvoiceBtn" form="insRinvoice" value="true">เพิ่ม</button>
      </div>
    </div>
  </div>
</div>
<!-- /Inert R-Invoice Modal -->

<!-- Delete R-Invoice Modal -->
<div class="modal fade" id="delRinvoiceModal" tabindex="-1" role="dialog" aria-labelledby="delRinvoiceModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delRinvoiceLabel">ลบผู้ใช้</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form method="post" id="delRinvoice">
          <p>Are you sure to delete Repair Invoice <strong id="delRinvoiceText"></strong> ? </p>
          <input type="hidden" name="rid" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">ปิด</button>
        <button class="btn btn-danger" type="submit" name="delRinvoiceBtn" form="delRinvoice" value="true">ลบ</button>
      </div>
    </div>
  </div>
</div>
<!-- /Delete R-Invoice Modal -->