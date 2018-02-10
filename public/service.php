<?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["searchBtn"])) {
      $search_stmt = $conn->prepare("SELECT * FROM `r_invoice` WHERE `r_id` = :rid AND `r_status` < 4");
      $search_stmt->bindParam(":rid", $_POST["searchBox"]);
      $search_stmt->execute();
    }
  }
?>

<div class="jumbotron jumbotron-fluid mt-5 bg-primary text-white" style="margin-bottom: 0px;">
  <div class="container text-center py-3">
    <h1 class="display-4">ตรวจสอบสถานะการซ่อม <i class="fa fa-wrench fa-fw"></i></h1>
    <form class="needs-validation" method="post" id="searchR" novalidate>
      <div class="form-row align-items-center d-flex justify-content-center pt-3">
        <div class="col-auto">
          <div class="input-group">
            <input class="form-control form-control-lg" type="search" name="searchBox" id="searchBox" placeholder="เลขที่ใบแจ้งซ่อม" required>
            <div class="invalid-feedback">
              กรุณาระบุเลขใบแจ้งซ่อมให้ถูกต้อง
            </div>
            <div class="input-group-append">
              <button class="btn btn-dark btn-lg" type="submit" form="searchR" name="searchBtn" value="true"><i class="fa fa-search"></i> ค้นหา</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<section class="container" id="wrapper" style="margin-top: 5px;">
  <article class="row">
  <?php
  if (isset($search_stmt)) {
    if ($search_stmt->rowCount() > 0) {
      while ($search_rows = $search_stmt->fetch(PDO::FETCH_ASSOC)) {
        $date_fin = date('d/m/Y', strtotime($search_rows["r_date_fin"]));
        echo '
          <div class="card w-50 text-white bg-primary mb-3 mx-auto">
            <div class="card-header">เลขใบแจ้งซ่อม : '.$search_rows["r_id"].'</div>
            <div class="card-body">
              <h5 class="card-title">รุ่น : '.$search_rows["r_model"].'</h5>
              <p class="card-text">สถานะการซ่อม : '.$func->rStatus($search_rows["r_status"]).'</p>
              <p class="card-text">รวมค่าซ่อม : '.$search_rows["r_cost"].' บาท</p>
              <p class="card-text">วันที่นัดรับ : '.$date_fin.'</p>
            </div>
          </div>';
      }
    } else {
      echo '
            <div class="card w-50 text-dark bg-light mb-3 mx-auto">
              <div class="card-body">
                <h5 class="card-title">ไม่พบข้อมูลของเลขใบแจ้งซ่อม '.$_POST["searchBox"].'</h5>
                <p class="card-text">Not found</p>
              </div>
            </div>';
    }
  }
  ?>
  </article>
</section>

