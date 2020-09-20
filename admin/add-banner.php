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
            <h1>BANNER</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">THÊM MỚI</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" id="quickForm" action="handling/handling-add-banner.php" method="post" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="banner" accept="image/png, image/jpg, image/jpeg">
                  <label class="custom-file-label" for="exampleInputFile">CHỌN BANNER</label>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success" name="submit">THÊM</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    require "plade/footer.php";
    require "js-customs/js-add-banner.php";
  ?>
