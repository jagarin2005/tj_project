<?php
  class User {
    private $db;
    private $uname;
    private $uid;
    private $permission;
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

    public function login($email, $pass) {
      $check_stmt = $this->db->prepare("SELECT * FROM `user` WHERE `user_email` = :email AND `user_password` = :pass");
      $check_stmt->bindParam(":email", $email);
      $check_stmt->bindParam(":pass", $pass);
      $check_stmt->execute();
      $check = $check_stmt->fetch(PDO::FETCH_ASSOC);
      if ( $check_stmt->rowCount() == 1 ) {
        if ( $check["user_status"] == 1 ) {
          if ( $check["user_level"] == 1 ) {
            $_SESSION["uid"] = $check["user_id"];
            $_SESSION["name"] = $check["user_name"];
            $_SESSION["email"] = $check["user_email"];
            $_SESSION["permission"] = "user";
            return true;

          } else if ( $check["user_level"] == 2 ) {
            $_SESSION["uid"] = $check["user_id"];
            $_SESSION["name"] = $check["user_name"];
            $_SESSION["email"] = $check["user_email"];
            $_SESSION["permission"] = "staff";
            return true;

          } else if ( $check["user_level"] == 99 ) {
            $_SESSION["uid"] = $check["user_id"];
            $_SESSION["name"] = $check["user_name"];
            $_SESSION["email"] = $check["user_email"];
            $_SESSION["permission"] = "admin";
            return true;

          } else {
            return false;
          }
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    public function isLogin () {
      if (isset($_SESSION["uid"])) {
        return true;
      } else {
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

    public function checkLevel($lvl) : string {
      switch ($lvl) {
        case 1:
          return "ผู้ใช้";
          break;
        
        case 2: 
          return "พนักงาน";
          break;

        case 99:
          return "ผู้ดูแล";
          break;

        default:
          return "-";
          break;
      }
    }

    public function checkStatus($status) : string {
      switch ($status) {
        case 1:
          return "เปิด";
          break;

        case 0:
          return "ปิด";
          break;

        default:
          return "-";
          break;
      }
    }
    
    public function redirect ($uri = "home") {
      header("Location: " . $uri);
    }

    public function logout () {
      session_destroy();
      session_unset($_SESSION["uid"]);
      session_unset($_SESSION["name"]);
      session_unset($_SESSION["email"]);
      session_unset($_SESSION["permission"]);
      return true;
    }

  }
?>