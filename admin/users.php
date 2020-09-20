<?php
  require "../includes/DBConnection.php";
  require "plade/header.php";

  if (isset($_GET['flag'])) {
    $flag = $_GET['flag'];
  
?>

  <!-- Content Wrapper. Contains flag content -->
  <div class="content-wrapper">
    <!-- Content Header (flag header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">KHÁCH HÀNG</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">DANH SÁCH KHÁCH HÀNG</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead class="text-center">
                <tr>
                  <th>STT</th>
                  <th>HỌ TÊN</th>
                  <th>SỐ ĐIỆN THOẠI</th>
                  <th>EMAIL</th>
                  <th>TÀI KHOẢN</th>
                  <th>TẠO NGÀY</th>
                  <th>HÀNH ĐỘNG</th>
                </tr>
                </thead>
                <tbody class="text-center">

                <?php

                  $sql = "select * from tb_user order by id desc";
                  $query = mysqli_query($conn, $sql);
                  $i = 1;
                  while ($rows = mysqli_fetch_array($query)) {

                ?>

                <tr>
                  <td><?php echo $i; ?></td>
                  <td class="text-primary"><?php echo $rows['name']; ?></td>
                  <td><?php echo $rows['phone']; ?></td>
                  <td><?php echo $rows['email']; ?></td>
                  <!-- <td>
                    <?php
                      $gender = $rows['gender'];
                      if ($gender == 0) {
                        echo "Nam";
                      }
                      if ($gender == 1) {
                        echo "Nữ";
                      }
                    ?>
                  </td>
                  <td>
                    <?php
                      $date_string = $rows['birthday'];
                      if (!empty($date_string)) {
                        $date = date_create($date_string);
                        echo date_format($date, "d/m/Y");
                      }
                    ?>
                  </td> -->
                  <td>
                    <?php
                      $account = $rows['account_type'];
                      if ($account == 0) {
                        echo "Tài khoản từ SĐT";
                      }
                      if ($account == 1) {
                        echo "Tài khoản Facebook";
                      }
                      if ($account == 2) {
                        echo "Tài khoản Google";
                      }
                      if ($account == 3) {
                        echo "Tài khoản Twitter";
                      }
                    ?>
                  </td>
                  <td>
                    <?php
                      $date_string = $rows['created_at'];
                      $date = date_create($date_string);
                      echo date_format($date, "d/m/Y H:i:s");
                    ?>
                  </td>
                  <td class="py-0 align-middle">
                    <div class="btn-group-sm">
                      <!-- <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a> -->
                      <a href="handling/handling-delete-user.php?flag=<?php echo "$flag"; ?>&id=<?php echo $rows['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>
                </tr>

                <?php
                  $i++;
                  }
                ?>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    require "plade/footer.php";
    require "js-customs/js-product.php";
    }
  ?>
