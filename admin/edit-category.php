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
            <h1>DANH MỤC</h1>
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
              <h3 class="card-title">SỬA DANH MỤC</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="quickForm2" action="handling/handling-edit-category.php" method="post" enctype="multipart/form-data">

              <?php
                if (isset($_GET['id'])) {
                  $id = $_GET['id'];
                  $sql = "select * from tb_category where id = '".$id."'";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_row($result);
                
              ?>

              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">TÊN DANH MỤC</label>
                  <input type="text" name="id" value="<?php echo $id; ?>" hidden="hidden">
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NHẬP TÊN DANH MỤC" name="category_name" value="<?php echo $row[1]; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">BANNER DANH MỤC</label>
                  <br>
                  <img src="<?php echo $row[3]; ?>" height="150">
                  <br>
                  <br>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="banner" accept="image/png, image/jpg, image/jpeg">
                      <label class="custom-file-label" for="exampleInputFile">THAY ĐỔI BANNER</label>
                    </div>
                  </div>
                </div>
              </div>

              <?php
                }
              ?>

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
  require "js-customs/js-add-category.php";
?>
