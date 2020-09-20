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
              <h3 class="card-title">SỬA DANH MỤC CON</h3>
            </div>
            <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="handling/handling-edit-child-category.php" method="post" enctype="multipart/form-data" id="quickForm2">

          <?php
            if (isset($_GET['id'])) {

              $id = $_GET['id'];

              $sql = "select * from tb_child_category where id = '".$id."'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_row($result);

          ?>

          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">TÊN DANH MỤC</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NHẬP TÊN DANH MỤC" name="category_name" value="<?php echo $row[1]; ?>">
              <input type="text" name="id" value="<?php echo $id; ?>" hidden="hidden">
            </div>
            <div class="form-group">
              <label for="exampleInputFile">HÌNH ẢNH DANH MỤC</label>
              <br>
              <img src="<?php echo $row[3]; ?>" width="150">
              <br>
              <br>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="thumbnail" accept="image/png, image/jpg, image/jpeg">
                  <label class="custom-file-label" for="exampleInputFile">THAY ĐỔI HÌNH ẢNH</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>LOẠI DANH MỤC</label>
              <br>
              <?php

                $sql3 = "select name from tb_category where id = '".$row[4]."'";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_row($result3);

                echo "<i>$row3[0]</i>";

              ?>
              
              <br><br>
              <select class="form-control select2" style="width: 100%;" name="select">
                <option selected="selected" disabled="disabled" hidden="hidden">CHỌN DANH MỤC</option>

                <?php

                  $sql2 = "select * from tb_category order by id desc";
                  $query2 = mysqli_query($conn, $sql2);

                  while ($rows = mysqli_fetch_array($query2)) {

                ?>

                <option value="<?php echo $rows['id']; ?>" name="select"><?php echo $rows['name']; ?></option>

                <?php
                  }
                ?>

              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <?php
            }
          ?>

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
    require "js-customs/js-add-child-category.php";
  ?>
