<?php
  require "../includes/DBConnection.php";
  require "plade/header.php";
?>

  <?php

    if (isset($_GET['id']) && isset($_GET['flag'])) {

      $id = $_GET['id'];
      $flag = $_GET['flag'];

      $sql = "select distinct(o.order_id), o.order_date, o.status, o.shipping_method, o.payment_method, oa.recipient_name, oa.phone_number, oa.street, cwt.name as cwt_name, d.name as d_name, pc.name as pc_name, o.provisional_price, o.transport_fee, o.total_money from tb_order o, tb_order_detail od, tb_order_address oa, tb_commune_ward_town cwt, tb_district d, tb_province_city pc where od.order_id = o.order_id and oa.order_id = o.order_id and oa.province_city_id = pc.id and oa.district_id = d.id and oa.commune_ward_town_id = cwt.id and o.order_id = ".$id."";
      $query = mysqli_query($conn, $sql);
      $row = mysqli_fetch_row($query);

  ?>

  <!-- Content Wrapper. Contains flag content -->
  <div class="content-wrapper">
    <!-- Content Header (flag header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">CHI TIẾT ĐƠN HÀNG</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <div class="row">
                <div class="col-sm-6 invoice-col">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>Đơn hàng:</th>
                        <th><?php echo $row[0]; ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Ngày đặt hàng:</td>
                        <td>
                          <?php
                            $date_string = $row[1];
                            $date = date_create($date_string);
                            echo date_format($date, "d/m/Y H:i:s");
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Trạng thái:</td>
                        <td>
                          <?php
                            $payment_method = $row[4];
                            $status = $row[2];
                            if ($payment_method == 1) {
                              if ($status == 3) {
                                echo "<text class='text-success'>Đã thanh toán</text>";
                              } else {
                                echo "<text class='text-warning'>Chưa thanh toán</text>";
                              }
                              
                            }
                            if ($payment_method == 2) {
                              echo "<text class='text-success'>Đã thanh toán</text>";
                            }
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Hình thức thanh toán:</td>
                        <td>
                          <?php
                            $payment_method = $row[4];
                            if ($payment_method == 1) {
                              echo "Thanh toán khi nhận hàng";
                            }
                            if ($payment_method == 2) {
                              echo "Thanh toán qua thẻ Tín dụng";
                            }
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Hình thức giao hàng:</td>
                        <td>
                          <?php
                            $shipping_method = $row[3];
                            if ($shipping_method == 1) {
                              echo "Giao hàng tiêu chuẩn";
                            }
                            if ($shipping_method == 2) {
                              echo "Giao hàng nhanh";
                            }
                          ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 invoice-col">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>Địa chỉ giao hàng</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $row[5]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $row[6]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $row[7] . ", " . $row[8] . ", " . $row[9] . ", " . $row[10]; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.row -->
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered text-center">
                    <thead class="thead-dark">
                    <tr>
                      <th>STT</th>
                      <th>SẢN PHẨM</th>
                      <th>GIÁ</th>
                      <th>SỐ LƯỢNG</th>
                      <th>TỔNG TẠM TÍNH</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        
                        $sql2 = "select p.name as product_name, od.product_id, od.attribute_id, od.price, od.quantity from tb_order o, tb_order_detail od, tb_product p where od.order_id = o.order_id and o.order_id = ".$id." and od.product_id = p.id order by od.id desc";
                          $query2 = mysqli_query($conn, $sql2);

                          $i = 1;

                          while ($rows = mysqli_fetch_array($query2)) {

                            $p['id'] = $rows['product_id'];
                            $p['attributeId'] = $rows['attribute_id'];

                      ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td>
                        <?php

                          if (!empty($p['attributeId'])) {
                            $attributes = mysqli_query($conn, "select * from tb_product_attribute where product_id = ".$p['id']." and id = ".$p['attributeId']."");
                            $r = mysqli_fetch_row($attributes);

                            if (empty($r[2])) { // color_id = null
                              $sql3 = "select * from tb_size where id = ".$r[3]."";
                              $query3 = mysqli_query($conn,$sql3);
                              $row3 = mysqli_fetch_row($query3);

                              $p['name'] = $rows['product_name'] . " - " . $row3[1];

                              echo $p['name'];
                            } else if (empty($r[3])) { // size_id = null
                                $sql3 = "select * from tb_color where id = ".$r[2]."";
                                $query3 = mysqli_query($conn,$sql3);
                                $row3 = mysqli_fetch_row($query3);

                                $p['name'] = $rows['product_name'] . " - " . $row3[1];

                                echo $p['name'];
                              } else {
                                $sql3 = "select c.name as color_name, s.name as size_name from tb_color c, tb_size s where c.id = ".$r[2]." and s.id = ".$r[3]."";
                                $query3 = mysqli_query($conn, $sql3);
                                $row3 = mysqli_fetch_row($query3);

                                $p['name'] = $rows['product_name'] . " - " . $row3[0] . " - " . $row3[1];

                                echo $p['name'];
                              }

                          } else {
                            $attributes = mysqli_query($conn, "select name from tb_product where id = ".$p['id']."");
                            $row4 = mysqli_fetch_row($attributes);

                            $p['name'] = $row4[0];

                            echo $p['name'];
                          }

                        ?>
                      </td>
                      <td>
                        <?php
                          $number_format = number_format($rows['price']);
                          echo $number_format . " ₫";
                        ?>
                      </td>
                      <td><?php echo $rows['quantity']; ?></td>
                      <td>
                        <?php
                          $provisional_price = $rows['price'] * $rows['quantity'];
                          $number_format = number_format($provisional_price);
                          echo $number_format . " ₫";
                        ?>
                      </td>
                    </tr>

                    <?php
                      $i++;
                      }
                    ?>

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-8">
                </div>
                <div class="col-4">
                  <div class="table-borderless">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Tổng tạm tính:</th>
                        <td class="text-right">
                          <?php
                            $number_format = number_format($row[11]);
                            echo $number_format . " ₫";
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Phí vận chuyển:</th>
                        <td class="text-right">
                          <?php
                            $number_format = number_format($row[12]);
                            echo $number_format . " ₫";
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Tổng thanh toán:</th>
                        <td class="text-right" style="font-size: 24px; font-weight: bold;">
                          <?php
                            $number_format = number_format($row[13]);
                            echo $number_format . " ₫";
                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">

                  <?php
                    if ($flag == 10) {

                  ?>
                  <a href="handling/handling-cancelled-order.php?flag=<?php echo "$flag"; ?>&id=<?php echo $row[0]; ?>" class="btn btn-danger float-right" style="margin-left: 10px;">HUỶ ĐƠN HÀNG</a>

                  <a href="handling/handling-approved-order.php?id=<?php echo $row[0]; ?>" class="btn btn-success float-right">GIAO HÀNG</a>

                  <?php
                    }
                    if ($flag == 11) {

                  ?>
                  <a href="handling/handling-cancelled-order.php?flag=<?php echo "$flag"; ?>&id=<?php echo $row[0]; ?>" class="btn btn-danger float-right" style="margin-left: 10px;">HUỶ ĐƠN HÀNG</a>

                  <a href="handling/handling-paid-order.php?id=<?php echo $row[0]; ?>" class="btn btn-success float-right">ĐÃ THANH TOÁN</a>

                  <?php
                    }
                  ?>

                </div>
              </div>
              
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    }
  ?>

  <footer class="main-footer">
    <strong>Copyright &copy; 2019-2020.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.3-pre
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/flags/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
