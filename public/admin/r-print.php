<?php 
  $rid = $_GET["p"];
  $r_stmt = $conn->prepare("SELECT * FROM `r_invoice` WHERE `r_id` = :rid");
  $r_stmt->bindParam(":rid", $rid);
  $r_stmt->execute();
  $row = $r_stmt->fetch(PDO::FETCH_ASSOC);
?>

<style type="text/css" media="print"> 
  @page { size: A4 landscape; margin: 0mm; }
  @media print {
    header, footer, nav, aside, title{
      display: none;
    }
  }
  html { margin: 0px; }
</style>

<div class="A4 landscape">
  <section class="sheet padding-10mm">
    <article class="container-fluid">
      <div class="row">

        <div class="col-6" style="border: 1px solid #000">
          <div class="clearfix">
            <div class="pull-right"><span class="lead"><?php echo "เลขที่ใบแจ้งซ่อม : ".$row["r_id"]; ?></span></div>
          </div>
          <div class="clearfix">
            <div class="pull-left"><span><?php echo "<strong>ชื่อลูกค้า : </strong>".$row["user_name"]; ?></span></div>
            <div class="pull-right"><span><?php echo "<strong>วันที่รับซ่อม : </strong>".$func->toDate($row["r_date_in"]); ?></span></div>
          </div>
          <div class="clearfix">
            <div class="pull-left"><span><?php echo "<strong>เบอร์ลูกค้า : </strong>".$row["user_tel"]; ?></span></div>
            <div class="pull-right"><span><?php echo "<strong>วันที่นัดรับ : </strong>".$func->toDate($row["r_date_fin"]); ?></span></div>
          </div>
          <hr>
          <div class="">
            <div class="">
              <span><?php echo "<strong>ประเภทเครื่อง : </strong>".$row["r_type"]; ?></span>
            </div>
            <div class="">
              <span><?php echo "<strong>ประเภทการซ่อม : </strong>".$row["r_type2"]; ?></span>
            </div>
            <div class="">
              <span><?php echo "<strong>เครื่องรุ่น : </strong>".$row["r_model"]; ?></span>
            </div>
            <br>
            <div class="row">
              <div class="col-6" style="height: 40mm;overflow-y: hidden;">
                <span class=""><strong>อุปกรณ์ที่ติดมาด้วย (ถ้ามี)</strong></span>
                <br>
                <span class=""><?php echo $row["r_eq"]; ?></span>
              </div>
              <div class="col-6" style="height: 40mm;overflow-y: hidden;">
                <span class=""><strong>อาการแจ้งเสีย</strong></span>
                <br>
                <span class=""><?php echo $row["r_eq2"]; ?></span>
              </div>
            </div>
            <div style="height: 60mm;overflow-y: hidden;">
              <span><strong>อุปกรณ์ที่เปลี่ยนระหว่างซ่อม</strong></span>
              <br>
              <span><?php echo $row["r_eq3"]; ?></span>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="clearfix">
                  <?php  
                    $staff_stmt = $conn->prepare("SELECT * FROM `user` INNER JOIN `staff` ON `staff`.`user_id` = `user`.`user_id` WHERE `staff`.`staff_id` LIKE :sid");
                    $staff_stmt->bindParam(":sid", $row["staff_id"]);
                    $staff_stmt->execute();
                    $staff_row = $staff_stmt->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <div class="">
                    <span><?php echo "<p><strong>ช่างผู้ซ่อม : </strong>".$staff_row["user_name"]."</p>"; ?></span>
                    <div class=""><span><?php echo "<strong>สถานะการซ่อม : </strong>".$func->rStatus($row["r_status"]); ?></span></div><br>
                  </div>
                  
                </div>
              </div>
              <div class="col-6">
                <div class="clearfix">
                  <div class=""><span class="lead"><?php echo "รวมค่าซ่อม : ".$row["r_cost"]." บาท"; ?></span></div>
                </div>
              </div>
              <br>
            </div>
          </div>
        </div>
        
        <div class="col-6" style="border: 1px solid #000">
          <div class="clearfix">
            <div class="pull-right"><span class="lead"><?php echo "เลขที่ใบแจ้งซ่อม : ".$row["r_id"]; ?></span></div>
          </div>
          <div class="clearfix">
            <div class="pull-left"><span><?php echo "<strong>ชื่อลูกค้า : </strong>".$row["user_name"]; ?></span></div>
            <div class="pull-right"><span><?php echo "<strong>วันที่รับซ่อม : </strong>".$func->toDate($row["r_date_in"]); ?></span></div>
          </div>
          <div class="clearfix">
            <div class="pull-left"><span><?php echo "<strong>เบอร์ลูกค้า : </strong>".$row["user_tel"]; ?></span></div>
            <div class="pull-right"><span><?php echo "<strong>วันที่นัดรับ : </strong>".$func->toDate($row["r_date_fin"]); ?></span></div>
          </div>
          <hr>
          <div class="">
            <div class="">
              <span><?php echo "<strong>ประเภทเครื่อง : </strong>".$row["r_type"]; ?></span>
            </div>
            <div class="">
              <span><?php echo "<strong>ประเภทการซ่อม : </strong>".$row["r_type2"]; ?></span>
            </div>
            <div class="">
              <span><?php echo "<strong>เครื่องรุ่น : </strong>".$row["r_model"]; ?></span>
            </div>
            <br>
            <div class="row">
              <div class="col-6" style="height: 40mm;overflow-y: hidden;">
                <span class=""><strong>อุปกรณ์ที่ติดมาด้วย (ถ้ามี)</strong></span>
                <br>
                <span class=""><?php echo $row["r_eq"]; ?></span>
              </div>
              <div class="col-6" style="height: 40mm;overflow-y: hidden;">
                <span class=""><strong>อาการแจ้งเสีย</strong></span>
                <br>
                <span class=""><?php echo $row["r_eq2"]; ?></span>
              </div>
            </div>
            <div style="height: 60mm;overflow-y: hidden;">
              <span><strong>อุปกรณ์ที่เปลี่ยนระหว่างซ่อม</strong></span>
              <br>
              <span><?php echo $row["r_eq3"]; ?></span>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="clearfix">
                  <?php  
                    $staff_stmt = $conn->prepare("SELECT * FROM `user` INNER JOIN `staff` ON `staff`.`user_id` = `user`.`user_id` WHERE `staff`.`staff_id` LIKE :sid");
                    $staff_stmt->bindParam(":sid", $row["staff_id"]);
                    $staff_stmt->execute();
                    $staff_row = $staff_stmt->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <div class="">
                    <span><?php echo "<p><strong>ช่างผู้ซ่อม : </strong>".$staff_row["user_name"]."</p>"; ?></span>
                    <div class=""><span><?php echo "<strong>สถานะการซ่อม : </strong>".$func->rStatus($row["r_status"]); ?></span></div><br>
                  </div>
                  
                </div>
              </div>
              <div class="col-6">
                <div class="clearfix">
                  <div class=""><span class="lead"><?php echo "รวมค่าซ่อม : ".$row["r_cost"]." บาท"; ?></span></div>
                </div>
              </div>
              <br>
            </div>
          </div>
        </div>

      </div>
    </article>
  </section>
</div>