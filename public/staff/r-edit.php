<?php
  $rid = $_GET["p"];

  $r_stmt = $conn->prepare("SELECT * FROM `r_invoice` AS `r` INNER JOIN `staff` AS `s` ON `s`.`staff_id` = `r`.`staff_id` WHERE `r`.`r_id` = :rid");
  $r_stmt->bindParam(":rid", $rid);
  $r_stmt->execute();
  $r_row = $r_stmt->fetch(PDO::FETCH_ASSOC);

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["editRinvoiceBtn"])) {
      try {
        $edit_r_stmt = $conn->prepare("UPDATE `r_invoice` SET
                                       `r_date_fin` = :r_date_fin,
                                       `r_type` = :r_type,
                                       `r_type2` = :r_type2,
                                       `r_type2_desc` = :r_type2_desc,
                                       `r_model` = :r_model,
                                       `r_eq` = :r_eq,
                                       `r_eq2` = :r_eq2,
                                       `r_eq3` = :r_eq3,
                                       `r_cost` = :r_cost,
                                       `r_status` = :r_status
                                       WHERE `r_id` = :rid");
        $edit_r_stmt->bindParam(":r_date_fin", $_POST["r_date_fin"]);
        $edit_r_stmt->bindParam(":r_type", $_POST["r_type"]);
        $edit_r_stmt->bindParam(":r_type2", $_POST["r_type2"]);
        $edit_r_stmt->bindParam(":r_type2_desc", $_POST["r_type2_desc"]);
        $edit_r_stmt->bindParam(":r_model", $_POST["r_model"]);
        $edit_r_stmt->bindParam(":r_eq", $_POST["r_eq"]);
        $edit_r_stmt->bindParam(":r_eq2", $_POST["r_eq2"]);
        $edit_r_stmt->bindParam(":r_eq3", $_POST["r_eq3"]);
        $edit_r_stmt->bindParam(":r_cost", $_POST["r_cost"]);
        $edit_r_stmt->bindParam(":r_status", $_POST["r_status"]);
        $edit_r_stmt->bindParam(":rid", $rid);
        $edit_r_stmt->execute();
        $user->redirect("r-invoice");
      } catch (PDOException $e) {
        echo 'ERROR : '. $e->getMessage();
      }
    }
  }
?>

<div class="container-fluid" id="wrapper">
  <div class="row d-flex d-md-block flex-nowrap wrapper clearfix">
    <?php include_once(__DIR__ . "/components/sidebar.php"); ?>
    <main class="col-md-10 col-12 float-left col px-5 pl-md-2 pt-2 main" id="main">
      <a href="#" data-target="#sidebar" data-toggle="collapse" id="toggleSidebar"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a>
      <div class="page-header">
        <h2>แก้ไขข้อมูลงานซ่อม</h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="r-invoice">ข้อมูลงานซ่อม</a></li>
            <li class="breadcrumb-item active">แก้ไขงานซ่อม</li>
          </ol>
        </nav>
      </div>
      <hr>
      <div class="row">
        <div class="col px-5 mb-3">
          <form method="post" id="editRinvoiceForm">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="date_in">วันที่รับเครื่องซ่อม</label>
                <input class="form-control" type="date" name="r_date_in" id="r_date_in" value="<?php echo date('Y-m-d', strtotime($r_row["r_date_in"])); ?>" placeholder="วันที่รับเครื่องซ่อม" required readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="date_fin">วันที่นัดรับเครื่อง</label>
                <input class="form-control" type="date" name="r_date_fin" id="r_date_fin" value="<?php echo date('Y-m-d', strtotime($r_row["r_date_fin"])); ?>" placeholder="วันที่นัดรับเครื่อง" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="c_name">ชื่อลูกค้า</label>
                <input type="text" class="form-control" id="c_name" name="c_name" placeholder="ชื่อลูกค้า" value="<?php echo $r_row["user_name"]; ?>" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="c_name">เบอร์ลูกค้า</label>
                <input type="tel" class="form-control" id="c_tel" name="c_tel" placeholder="เบอร์ลูกค้า" value="<?php echo $r_row["user_tel"]; ?>" readonly>
              </div>
            </div>

            <hr>

            <div class="form-row">
              <div class="form-group col-md-6">
                <legend class="col-form-label pt-0">ประเภทเครื่อง</legend>
                <div class="col-md-12">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="r_type" id="r_type_1" value="PC" <?php echo ($r_row["r_type"] === "PC") ? "checked" : "" ; ?>>
                    <label class="form-check-label" for="r_type_1">
                      PC
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="r_type" id="r_type_2" value="NB" <?php echo ($r_row["r_type"] === "NB") ? "checked" : "" ; ?>>
                    <label class="form-check-label" for="r_type_2">
                      NB
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="r_type" id="r_type_3" value="อุปกรณ์" <?php echo ($r_row["r_type"] === "อุปกรณ์") ? "checked" : "" ; ?>>
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
                    <input class="form-check-input" type="radio" name="r_type2" id="r_type2_1" value="ซ่อม" <?php echo ($r_row["r_type2"] === "ซ่อม") ? "checked" : "" ; ?>>
                    <label class="form-check-label" for="r_type2_1">
                      ซ่อม
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="r_type2" id="r_type2_2" value="เคลม" <?php echo ($r_row["r_type2"] === "เคลม") ? "checked" : "" ; ?>>
                    <label class="form-check-label" for="r_type2_2">
                      เคลม
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="r_type2" id="r_type2_3" value="อื่นๆ" <?php echo ($r_row["r_type2"] === "อื่นๆ") ? "checked" : "" ; ?>>
                    <label class="form-check-label mr-3" for="r_type2_3">
                      อื่นๆ
                    </label>
                    <input class="form-control" type="text" name="r_type2_desc" id="r_type2_desc" value="<?php echo (isset($r_row["r_type2_desc"]) ? $r_row["r_type2_desc"] : ""); ?>" placeholder="">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="r_model">เครื่องรุ่น</label>
                <input class="form-control" type="text" name="r_model" id="r_model" value="<?php echo (isset($r_row["r_model"]) ? $r_row["r_model"] : ""); ?>" placeholder="เครื่องรุ่น">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="r_eq">อุปกรณ์ที่ติดมาด้วย</label>
                <textarea class="form-control" name="r_eq" id="r_eq" cols="30" rows="5" placeholder=""><?php echo (isset($r_row["r_eq"]) ? $r_row["r_eq"] : ""); ?></textarea>
              </div>
              <div class="form-group col-md-4">
                <label for="r_eq2">อาการแจ้งเสีย</label>
                <textarea class="form-control" name="r_eq2" id="r_eq2" cols="30" rows="5" placeholder=""><?php echo (isset($r_row["r_eq2"]) ? $r_row["r_eq2"] : ""); ?></textarea>
              </div>
              <div class="form-group col-md-4">
                <label for="r_eq3">อุปกรณ์ที่เปลี่ยนระหว่างซ่อม</label>
                <textarea class="form-control" name="r_eq3" id="r_eq3" cols="30" rows="5" placeholder=""><?php echo (isset($r_row["r_eq3"]) ? $r_row["r_eq3"] : ""); ?></textarea>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="r_cost">รวมราคา</label>
                <input class="form-control" type="number" name="r_cost" id="r_cost" min="0" max="" value="<?php echo (isset($r_row["r_cost"]) ? $r_row["r_cost"] : ""); ?>" placeholder="รวมราคา">
              </div>

              <div class="form-group col-md-6">
                <label for="r_staff">ช่างผู้ซ่อม</label>
                <select class="form-control" name="r_staff" id="r_staff" disabled>
                  <?php
                    $staff_stmt = $conn->prepare("SELECT * FROM `staff` AS `s` INNER JOIN `user` AS `u` ON `u`.`user_id` = `s`.`user_id`");
                    $staff_stmt->execute();
                    while ($staff_rows = $staff_stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo ($staff_rows["staff_id"] === $r_row["staff_id"])
                              ? '<option value="'.$staff_rows["staff_id"].'" selected>'.$staff_rows["user_name"].'</option>'
                              : '<option value="'.$staff_rows["staff_id"].'">'.$staff_rows["user_name"].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="r_status">สถานะการซ่อม</label>
                <select class="form-control" name="r_status" id="r_status">
                <?php
                  for ($i = 0; $i <= 4; $i++) {
                    echo '<option value="'.$i.'" '.(($r_row["r_status"] == $i) ? "selected" : "").'>'.$func->rStatus($i).'</option>';
                  }
                ?>
                </select>
              </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg" type="submit" name="editRinvoiceBtn" form="editRinvoiceForm" value="true">แก้ไข</button>
            </form>
        </div>
      </div>
    </main>
  </div>
</div>
