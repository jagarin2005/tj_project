<div class="container-fluid" id="wrapper">
  <div class="row d-flex d-md-block flex-nowrap wrapper">
    <?php include_once(__DIR__ . "/components/sidebar.php"); ?>
    <main class="col-md-10 col-12 float-left col px-5 pl-md-2 pt-2 main" id="main">
      <a href="#" data-target="#sidebar" data-toggle="collapse" id="toggleSidebar"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a>
      <div class="page-header">
        <h2>ข้อมูลผู้ใช้ <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#insUserModal">เพิ่มพนักงาน</button></h2>
        
      </div>
      <hr>
      <div class="row">
        <div class="col">
          <table class="table table-hover table-sm" id="user_table">
            <thead>
              <tr>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">User</th>
                <th scope="col"><i class="fa fa-cog"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $user_stmt = $conn->prepare("SELECT * FROM `user` WHERE `user_level` < 99");
                $user_stmt->execute();
                while ($user_rows = $user_stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '
                    <tr>
                      <td scope="row">'.$user_rows["user_email"].'</td>
                      <td>'.$user_rows["user_name"].'</td>
                      <td>'.$user_rows["user_status"].'</td>
                      <td>'.$user_rows["user_level"].'</td>
                      <td></td>
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

<!-- Insert User Modal -->
<div class="modal fade" id="insUserModal" tabindex="-1" role="dialog" aria-labelledby="insUserModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insUserLabel">เพิ่มพนักงาน</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="form-group row">
            <label for="uEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="uEmail" value="">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">ปิด</button>
        <button class="btn btn-primary" type="submit" name="insUserBtn" value="true">เพิ่ม</button>
      </div>
    </div>
  </div>
</div>