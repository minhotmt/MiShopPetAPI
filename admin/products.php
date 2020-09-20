<?php
  require "../includes/DBConnection.php";
  require "plade/header.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>SẢN PHẨM</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">TOÀN BỘ SẢN PHẨM</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th>STT</th>
                  <th>HÌNH ẢNH</th>
                  <th>TÊN SẢN PHẨM</th>
                  <th>DANH MỤC</th>
                  <th>GIÁ</th>
                  <th>SALE</th>
                  <th>GIÁ SALE</th>
                  <th>THƯƠNG HIỆU</th>
                  <th>NGÀY TẠO</th>
                  <th>HÀNH ĐỘNG</th>
                </tr>
                </thead>
                <tbody>
                <?php

                  $sql = "select distinct(p.id) as p_id, p.name as p_name, price, is_sale, sale_price, p.brand_id, c.name as c_name, p.created_at from tb_product p, tb_child_category c where p.child_category_id = c.id order by p.id desc";
                  $query = mysqli_query($conn, $sql);

                  $i = 1;
                  while ($rows = mysqli_fetch_array($query)) {
                    // // get thumbnail product
                    $sql2 = "select * from tb_product_image where product_id = ".$rows['p_id']." order by id asc";
                    $query2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_row($query2);

                ?>
                <tr class="text-center">
                  <td><?php echo $i; ?></td>
                  <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <img alt="image" src="<?php echo $row2[2]; ?>" width= auto height="100">
                        </li>
                    </ul>
                  </td>
                  <td>
                      <?php echo $rows['p_name']; ?>
                  </td>
                  <td>
                      <?php echo $rows['c_name']; ?>
                  </td>
                  <td>
                      <?php
                        $price = $rows['price'];
                        $number_format = number_format($price);
                        echo $number_format . " ₫";
                      ?>
                  </td>
                  <td>
                      <?php
                        $is_sale = $rows['is_sale'];
                        if ($is_sale == 1) {
                          echo "<p class='text-success'>Có</p>";
                        }
                        else {
                          echo "<p class='text-danger'>Không</p>";
                        }
                      ?>
                  </td>
                  <td>
                      <?php
                        $sale_price = $rows['sale_price'];
                        $number_format = number_format($sale_price);
                        echo $number_format . " ₫";
                      ?>
                  </td>

                  <?php
                      if ($rows['brand_id'] == 0) {
                        echo "<td>No Brand</td>";
                      } else {
                        $sql3 = "select * from tb_brand where id = ".$rows['brand_id']."";
                        $query3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_row($query3);
                        echo "<td class='text-primary'>$row3[1]</td>";
                      }
                    ?>
                  <td>
                    <a>
                      <?php
                        $date_string = $rows['created_at'];
                        $date = date_create($date_string);
                        echo date_format($date, "d/m/Y H:i:s");
                      ?>
                    </a>
                  </td>
                  <td class="py-0 align-middle">
                    <div class="btn-group-sm">
                      <a href="edit-product.php?id=<?php echo $rows['p_id']; ?>&flag=9" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                      <a href="handling/handling-delete-product.php?id=<?php echo $rows['p_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
  ?>
