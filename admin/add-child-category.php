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
            <h1>DANH MỤC CON</h1>
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
              <h3 class="card-title">THÊM MỚI DANH MỤC CON</h3>
            </div>
            <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="handling/handling-add-child-category.php" method="post" enctype="multipart/form-data" id="quickForm">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">TÊN DANH MỤC</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NHẬP TÊN DANH MỤC" name="category_name">
            </div>
            <div class="form-group">
              <label for="exampleInputFile">HÌNH ẢNH DANH MỤC</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="thumbnail" accept="image/png, image/jpg, image/jpeg">
                  <label class="custom-file-label" for="exampleInputFile">CHỌN HÌNH ẢNH</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>LOẠI DANH MỤC</label>
              <select class="form-control select2" style="width: 100%;" name="select">
                <option selected="selected" disabled="disabled" hidden="hidden">CHỌN LOẠI DANH MỤC</option>

                <?php

                  $sql = "select * from tb_category order by id desc";
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
    require "js-customs/js-add-child-category.php";
  ?>
