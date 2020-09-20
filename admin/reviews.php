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
              if ($flag == 16) {
                echo "<h1 class='m-0 text-dark'>ĐÁNH GIÁ ĐANG CHỜ DUYỆT</h1>";
                $status = 0;
              }
              if ($flag == 17) {
                echo "<h1 class='m-0 text-dark'>ĐÁNH GIÁ ĐÃ DUYỆT</h1>";
                $status = 1;
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
              <h3 class="card-title">KHÁCH HÀNG ĐÁNH GIÁ</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead class="text-center">
                <tr>
                  <th>STT</th>
                  <th>TÊN SẢN PHẨM</th>
                  <th>KHÁCH HÀNG</th>
                  <th>ĐÁNH GIÁ</th>
                  <th>NHẬN XÉT</th>
                  <th>NGÀY ĐÁNH GIÁ</th>
                  <th>THAO TÁC</th>
                </tr>
                </thead>
                <tbody class="text-center">

                <?php

                  $sql = "select rv.id as review_id, p.id as product_id, p.name as product_name, u.name as user_name, rv.rating, rv.comment, rv.created_at from tb_review rv, tb_product p, tb_user u where rv.product_id = p.id and rv.user_id = u.id and status = ".$status." order by rv.id desc";
                  $query = mysqli_query($conn, $sql);
                  $i = 1;
                  while ($rows = mysqli_fetch_array($query)) {

                ?>

                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $rows['product_name']; ?></td>
                  <td><?php echo $rows['user_name']; ?></td>
                  <td><b><?php echo $rows['rating'] . " ⭐️"; ?></b></td>
                  <td><?php echo $rows['comment']; ?></td>
                  <td>
                    <?php
                      $date_string = $rows['created_at'];
                      $date = date_create($date_string);
                      echo date_format($date, "d/m/Y H:i:s");
                    ?>
                  </td>
                  <td class="py-0 align-middle">
                    <div class="btn-group-sm">
                      <?php

                        if ($flag == 16) {

                      ?>
                      <a href="handling/handling-approved-review.php?id=<?php echo $rows['review_id']; ?>" class="btn btn-success"><i class="fas fa-check"></i></a>
                      <?php
                        }
                      ?>

                      <a href="handling/handling-delete-review.php?flag=<?php echo "$flag"; ?>&id=<?php echo $rows['review_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>

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
