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
            <h1>THƯƠNG HIỆU</h1>
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
              <h3 class="card-title">THÊM MỚI THƯƠNG HIỆU</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="quickForm" action="handling/handling-add-brand.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">TÊN THƯƠNG HIỆU</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="TÊN THƯƠNG HIỆU" name="brand_name">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">HÌNH ẢNH THƯƠNG HIỆU</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="thumbnail" accept="image/png, image/jpg, image/jpeg">
                      <label class="custom-file-label" for="exampleInputFile">CHỌN HÌNH ẢNH</label>
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
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">THƯƠNG HIỆU ĐÃ THÊM</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th>STT</th>
                  <th>HÌNH ẢNH THƯƠNG HIỆU</th>
                  <th>TÊN THƯƠNG HIỆU</th>
                  <th>HÀNH ĐỘNG</th>
                </tr>
                </thead>
                <tbody>
                <?php

                  $sql = "select * from tb_brand order by name asc";
                  $query = mysqli_query($conn, $sql);

                  $i = 1;
                  while ($rows = mysqli_fetch_array($query)) {

                ?>
                <tr class="text-center">
                  <td><?php echo $i; ?></td>
                  <td>
                    <img alt="image" src="<?php echo $rows['thumbnail_url']; ?>" width= auto height="80">
                  </td>
                  <td>
                    <a>
                      <?php
                        echo $rows['name'];
                      ?>
                    </a>
                  </td>
                  <td class="project-actions text-center">
                    <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Sửa
                    </a>
                    <a class="btn btn-danger btn-sm" href="handling/handling-delete-brand.php?id=<?php echo $rows['id']; ?>">
                      <i class="fas fa-trash">
                      </i>
                      Xoá
                    </a>
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
  require "js-customs/js-add-brand.php";
?>
