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
              <h3 class="card-title">THÊM MỚI SẢN PHẨM</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="handling/handling-add-product.php" method="post" enctype="multipart/form-data" id="quickForm">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">TÊN SẢN PHẨM</label>
                      <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Nhập tên sản phẩm" name="name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">GIÁ BÁN</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Nhập giá bán sản phẩm" name="price">
                    </div>
                    <div class="form-group clearfix">
                      <input type="checkbox" id="checkboxPrimary1" name="checkbox">
                        <label for="checkboxPrimary1"> &nbsp;KHUYẾN MÃI</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập giá khuyến mãi" name="sale_price">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>DANH MỤC</label>
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
                      <label>THƯƠNG HIỆU</label>
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
                      <label>Màu sắc</label>
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
                      <label>Size</label>
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
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
                <button type="submit" class="btn btn-success" name="submit">THÊM</button>
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
