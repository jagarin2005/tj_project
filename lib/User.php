<?php
  class User {
    private $db;
    public $user_alert;

    function __construct($db_con) {
      $this->db = $db_con;
    }

    public function register($email, $pass, $name, $lvl) {
      $check_stmt = $this->db->prepare("SELECT user_id FROM `user` WHERE `user_email` = :uemail");
      $check_stmt->bindParam(":uemail", $email);
      $check_stmt->execute();
      $check = $check_stmt->fetch(PDO::FETCH_ASSOC);
      if ($check_stmt->rowCount() == 0) {
        try {
          $reg_stmt = $this->db->prepare("INSERT INTO `user` VALUES (NULL, :pass, :name, :email, 1, :lvl)");
          $reg_stmt->bindParam(":pass", $pass);
          $reg_stmt->bindParam(":name", $name);
          $reg_stmt->bindParam(":email", $email);
          $reg_stmt->bindParam(":lvl", $lvl);
          $reg_stmt->execute();

          return true;
        } catch (PDOException $e) {
          $user_alert = "ไม่สามารถสมัครสมาชิกได้";
          return false;
        }
      } else {
        $user_alert = "พบอีเมลนี้ในระบบแล้ว";
        return false;
      }
    }

    public function isLogin () {
      if (isset($_SESSION["uid"])) {
        return true;
      } else {
        $this->user_alert = "คุณยังไม่ได้เข้าสู่ระบบ";
        return false;
      }
    }

    public function isAdmin() {
      if(isset($_SESSION["uid"]) && $_SESSION["permission"] == "admin") {
        return true;
      }else{
        $this->user_error = "คุณไม่มีสิทธิ์เข้าถึงส่วนนี้";
        return false;
      }
    }

    public function isStaff() {
      if(isset($_SESSION["uid"]) && $_SESSION["permission"] == "staff") {
        return true;
      }else{
        $this->user_error = "คุณไม่มีสิทธิ์เข้าถึงส่วนนี้";
        return false;
      }
    }

    public function isUser() {
      if(isset($_SESSION["uid"]) && $_SESSION["permission"] == "user") {
        return true;
      }else{
        $this->user_error = "คุณไม่มีสิทธิ์เข้าถึงส่วนนี้";
        return false;
      }
    }
    
    public function redirect ($uri) {
      header("Location: ".$uri);
    }

  }
?>