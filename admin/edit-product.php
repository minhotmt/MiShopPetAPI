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

    <?php

      if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $sql2 = "select * from tb_product where id = '".$id."'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_row($result2);

      }

    ?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">SỬA SẢN PHẨM</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="handling/handling-edit-product.php" method="post" enctype="multipart/form-data" id="quickForm2">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputEmail2" placeholder="ID" name="id" value="<?php echo $row2[0]; ?>" hidden="hidden">
                      <label for="exampleInputEmail1">TÊN SẢN PHẨM</label>
                      <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Nhập tên sản phẩm" name="name" value="<?php echo $row2[1]; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">GIÁ BÁN</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Nhập giá bán sản phẩm" name="price" value="<?php echo $row2[2]; ?>">
                    </div>
                    <div class="form-group clearfix">
                      <input type="checkbox" id="checkboxPrimary1" name="checkbox" <?php

                        if ($row2[3] == 1) {
                          echo "checked";
                        }

                      ?>>
                        <label for="checkboxPrimary1"> &nbsp;KHUYẾN MÃI</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập giá khuyến mãi" name="sale_price" value="<?php echo $row2[4]; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>DANH MỤC: &nbsp; &nbsp; &nbsp;</label>
                      <?php

                        $sql3 = "select * from tb_child_category where id = '".$row2[5]."'";
                        $result3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_row($result3);

                        echo "<i> $row3[1] </i>";

                      ?>
                      
                      <select class="form-control select2" style="width: 100%;" name="category">
                        <option selected="selected" disabled="disabled" hidden="hidden">Chọn danh mục</option>

                        <?php

                          $sql = "select * from tb_child_category order by id desc";
                          $query = mysqli_query($conn, $sql);

                          while ($rows = mysqli_fetch_array($query)) {

                        ?>

                        <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>

                        <?php
                          }
                        ?>

                      </select>
                    </div>
                    <div class="form-group">
                      <label>THƯƠNG HIỆU: &nbsp; &nbsp; &nbsp;</label>
                      <?php

                        $sql4 = "select * from tb_brand where id = '".$row2[7]."'";
                        $result4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_row($result4);

                        if ($row4 > 0) {
                          echo "<i> $row4[1] </i>";  
                        } else {
                          echo "<i> No Brand </i>";
                        }

                      ?>

                      <select class="form-control select2" style="width: 100%;" name="brand">
                        <option selected="selected" disabled="disabled" hidden="hidden">Chọn thương hiệu</option>

                        <?php

                          $sql = "select * from tb_brand order by id desc";
                          $query = mysqli_query($conn, $sql);

                          while ($rows = mysqli_fetch_array($query)) {

                        ?>

                        <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>

                        <?php
                          }
                        ?>

                      </select>
                    </div>

                    <div class="form-group">
                      <label>Màu sắc: &nbsp; &nbsp; &nbsp;</label>
                      <?php

                        $sql7 = "select distinct(name) from tb_product_attribute pa, tb_color c where pa.color_id = c.id and pa.product_id = '".$row2[0]."'";
                        $result7 = mysqli_query($conn, $sql7);
                        while ($rows3 = mysqli_fetch_array($result7)) {
                          if ($rows3 > 0) {
                            echo $rows3['name'] . ", ";  
                          }
                        }
                      ?>

                      <select class="select2" multiple="multiple" data-placeholder="Chọn màu sắc" style="width: 100%;" name="color[]">
                        <?php
                          $sql = "select * from tb_color order by id asc";
                          $query = mysqli_query($conn, $sql);
                          while ($rows = mysqli_fetch_array($query)) {
                          
                        ?>
                        <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>

                        <?php
                          }
                        ?>

                      </select>
                    </div>

                    <div class="form-group">
                      <label>Size: &nbsp; &nbsp; &nbsp;</label>
                      <?php

                        $sql6 = "select distinct(name) from tb_product_attribute pa, tb_size s where pa.size_id = s.id and pa.product_id = '".$row2[0]."'";
                        $result6 = mysqli_query($conn, $sql6);
                        while ($rows2 = mysqli_fetch_array($result6)) {
                          if ($rows2 > 0) {
                            echo $rows2['name'] . ", ";  
                          }
                        }
                      ?>

                      <select class="select2" multiple="multiple" data-placeholder="Chọn size" style="width: 100%;" name="size[]">
                        <?php
                          $sql = "select * from tb_size order by id asc";
                          $query = mysqli_query($conn, $sql);
                          while ($rows = mysqli_fetch_array($query)) {
                          
                        ?>
                        <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>

                        <?php
                          }
                        ?>
                      </select>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">HÌNH ẢNH</label>
                      <br>
                      <?php

                        $sql5 = "select * from tb_product_image where product_id = '".$row2[0]."'";
                        $result5 = mysqli_query($conn, $sql5);
                        while ($rows = mysqli_fetch_array($result5)) {

                      ?>
                      <img src="<?php echo $rows['image_url']; ?>" width="200"> &nbsp;

                      <?php
                        }
                      ?>

                      <br>
                      <br>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input form-control" id="customFile" name="img[]" accept="image/png, image/jpg, image/jpeg" multiple>
                        <label class="custom-file-label" for="customFile">Chọn hình ảnh</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-outline card-info">
                      <div class="card-header">
                        <h3 class="card-title">
                          MÔ TẢ SẢN PHẨM
                        </h3>
                        <!-- tools box -->
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                  title="Collapse">
                            <i class="fas fa-minus"></i></button>
                          <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                  title="Remove">
                            <i class="fas fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body pad">
                        <div class="mb-3">
                          <textarea name="description" placeholder="Place some text here"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $row2[6]; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.col-->
                </div>
                <!-- ./row -->

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success" name="submit">CẬP NHẬT</button>
              </div>
            </form>
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
    require "js-customs/js-add-product.php";
  ?>
