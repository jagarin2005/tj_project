<?php
  class Func {

    public function rStatus ($status) {
      switch ($status) {
        case 0:
          return "ยกเลิก";
          break;

        case 1:
          return "รอซ่อม";
          break;

        case 2:
          return "ดำเนินการซ่อม";
          break;

        case 3:
          return "เสร็จสิ้นการซ่อม";
          break;

        case 4:
          return "ลูกค้ารับเครื่องแล้ว";
          break;
      }
    }

    public function toDate($date) {
      $res =  date('d/m/Y', strtotime($date));
      return $res;
    }

  }
?>
