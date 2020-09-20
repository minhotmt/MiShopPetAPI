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
            <?php
              if ($flag == 10) {
                echo "<h1 class='m-0 text-dark'>ĐƠN HÀNG CHỜ XỬ LÝ</h1>";
                $status = 1;
              }
              if ($flag == 11) {
                echo "<h1 class='m-0 text-dark'>ĐƠN HÀNG ĐANG GIAO</h1>";
                $status = 2;
              }
              if ($flag == 12) {
                echo "<h1 class='m-0 text-dark'>ĐƠN HÀNG THÀNH CÔNG</h1>";
                $status = 3;
              }
              if ($flag == 13) {
                echo "<h1 class='m-0 text-dark'>ĐƠN HÀNG ĐÃ HUỶ</h1>";
                $status = 4;
              }
            ?>
            
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
              <h3 class="card-title">DANH SÁCH ĐƠN HÀNG</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead class="text-center">
                <tr>
                  <th>STT</th>
                  <th>MÃ ĐƠN HÀNG</th>
                  <th>KHÁCH HÀNG</th>
                  <th>TỔNG TIỀN</th>
                  <th>HÌNH THỨC THANH TOÁN</th>
                  <th>THAO TÁC</th>
                </tr>
                </thead>
                <tbody class="text-center">

                <?php

                  $sql = "select o.order_id, o.order_date, u.name as user_name, o.payment_method, o.total_money from tb_order o, tb_user u where o.user_id = u.id and status = ".$status." order by o.id desc";
                  $query = mysqli_query($conn, $sql);
                  $i = 1;
                  while ($rows = mysqli_fetch_array($query)) {

                ?>

                <tr>
                  <td><?php echo $i; ?></td>
                  <td><b><?php echo $rows['order_id']; ?></b></td>
                  <!-- <td>
                    <?php
                      $date_string = $rows['order_date'];
                      $date = date_create($date_string);
                      echo date_format($date, "d/m/Y H:i:s");
                    ?>
                  </td> -->
                  <td class="text-primary">
                    <a href="#"><?php echo $rows['user_name']; ?></a>
                  </td>
                  <td><b>
                    <?php
                      $number_format = number_format($rows['total_money']);
                      echo $number_format . " ₫";
                    ?>
                  </b></td>
                  <td>
                    <?php

                      if ($rows['payment_method'] == 1) {
                        echo "<text class='text-warning'>Tiền mặt</text>";
                      } else {
                        echo "<text class='text-success'>Qua thẻ</text>";
                      }

                    ?>
                  </td>
                  <!-- <td>
                    <?php
                      $status = $rows['payment_method'];
                      if ($status == 1) {
                        echo "<text class='text-warning'>Chưa thanh toán</text>";
                      }
                      if ($status == 2) {
                        echo "<text class='text-success'>Đã thanh toán</text>";
                      }
                    ?>
                  </td> -->
                  <td class="py-0 align-middle">
                    <div class="btn-group-sm">
                      <a href="order-details.php?id=<?php echo $rows['order_id']; ?>&flag=<?php echo "$flag"; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                      <a href="handling/handling-delete-order.php?flag=<?php echo "$flag"; ?>&id=<?php echo $rows['order_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
