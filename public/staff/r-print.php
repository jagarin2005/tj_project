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

<div class="d-print-none" id="print_tab"><i class="fa fa-print fa-fw"></i> Print</div>
<div class="A4 landscape" style="font-family: Tahoma, Geneva, sans-serif;">
  <div class="d-print-none mb-5 py-3"></div>

  <section class="sheet padding-10mm">
    <article class="container-fluid">
      <div class="row">

        <div class="col-6 border border-dark">
          <div class="clearfix">
            <div class="text-center"><h2>ใบประเมินราคา</h2></div>
          </div>
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

        <div class="col-6 border border-dark">
          <div class="clearfix">
            <div class="text-center"><h2>ใบประเมินราคา</h2></div>
          </div>
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

  <section class="sheet padding-10mm">
    <div class="container-fluid">
      <div class="row">

        <div class="col-6 border border-dark py-3 px-5">
          <div class="text-center">
            <h3 class="" href="#">
              Excellent
              <span class="fa-stack fa-1x fa-fw" style="font-size: 0.75em;">
                <i class="fa fa-desktop fa-stack-2x"></i>
                <i class="fa fa-wrench fa-flip-horizontal fa-stack-1x" style="top: -0.4215em;font-size: 0.8em;left: 0.075em;"></i>
              </span>
              Computer
            </h3>
            <h4>ใบเสร็จรับเงิน</h4>
          </div>
          <div class="clearfix">
            <span class="pull-left">ชื่อลูกค้า : <?php echo $row["user_name"]; ?></span>
            <span class="pull-right">เลขที่  : <?php echo $row["r_id"]; ?></span>
          </div>
          <span class=""></span>
          <p class="lead" style="margin-bottom: -3px;">รายการซ่อม</p>
          <div class="border border-dark rounded py-3 px-3" style="height: 100mm;">
            <div class="">
              <?php echo $row["r_eq3"]; ?>
            </div>
          </div>
          <div class="clearfix mt-3">
            <span>รวมเป็นเงิน</span>
            <div class="pull-right border border-dark rounded" style="min-width: 50mm; height: 10mm;"><span class="pull-right px-2" style="padding-top: 1.5mm;"><?php echo $row["r_cost"] . " บาท"; ?></span></div>
          </div>
          <div class="clearfix mt-5 mb-3">
            <div class="pull-left text-center">
              <span>...................................</span><br>
              <span>ผู้รับเงิน</span>
            </div>
            <div class="pull-right text-center">
              <span>...................................</span><br>
              <span>ลูกค้า</span>
            </div>
          </div>
        </div>

        <div class="col-6 border border-dark py-3 px-5">
          <div class="text-center">
            <h3 class="" href="#">
              Excellent
              <span class="fa-stack fa-1x fa-fw" style="font-size: 0.75em;">
                <i class="fa fa-desktop fa-stack-2x"></i>
                <i class="fa fa-wrench fa-flip-horizontal fa-stack-1x" style="top: -0.4215em;font-size: 0.8em;left: 0.075em;"></i>
              </span>
              Computer
            </h3>
            <h4>ใบเสร็จรับเงิน</h4>
          </div>
          <div class="clearfix">
            <span class="pull-left">ชื่อลูกค้า : <?php echo $row["user_name"]; ?></span>
            <span class="pull-right">เลขที่  : <?php echo $row["r_id"]; ?></span>
          </div>
          <span class=""></span>
          <p class="lead" style="margin-bottom: -3px;">รายการซ่อม</p>
          <div class="border border-dark rounded py-3 px-3" style="height: 100mm;">
            <div class="">
              <?php echo $row["r_eq3"]; ?>
            </div>
          </div>
          <div class="clearfix mt-3">
            <span>รวมเป็นเงิน</span>
            <div class="pull-right border border-dark rounded" style="min-width: 50mm; height: 10mm;"><span class="pull-right px-2" style="padding-top: 1.5mm;"><?php echo $row["r_cost"] . " บาท"; ?></span></div>
          </div>
          <div class="clearfix mt-5 mb-3">
            <div class="pull-left text-center">
              <span>...................................</span><br>
              <span>ผู้รับเงิน</span>
            </div>
            <div class="pull-right text-center">
              <span>...................................</span><br>
              <span>ลูกค้า</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

</div>
