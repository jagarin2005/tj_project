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

        <div class="col-6">
          
        </div>
        
      </div>
    </article>
  </section>
</div>