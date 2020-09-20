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
            <h1>THUỘC TÍNH SẢN PHẨM</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">THÊM MỚI MÀU SẮC</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="quickForm1" action="handling/handling-add-color.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">MÀU SẮC</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="TÊN MÀU" name="color_name">
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

        <div class="col-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">THÊM MỚI SIZE</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="quickForm2" action="handling/handling-add-size.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">SIZE</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="SIZE" name="size_name">
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
        <div class="col-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">MÀU SẮC ĐÃ THÊM</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th>STT</th>
                  <th>TÊN MÀU</th>
                  <th>HÀNH ĐỘNG</th>
                </tr>
                </thead>
                <tbody>
                <?php

                  $sql = "select * from tb_color order by name asc";
                  $query = mysqli_query($conn, $sql);

                  $i = 1;
                  while ($rows = mysqli_fetch_array($query)) {

                ?>
                <tr class="text-center">
                  <td><?php echo $i; ?></td>
                  <td>
                    <a>
                      <?php
                        echo $rows['name'];
                      ?>
                    </a>
                  </td>
                  <td class="project-actions text-center">
                      <a class="btn btn-danger btn-sm" href="handling/handling-delete-color.php?id=<?php echo $rows['id']; ?>">
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

        <div class="col-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">SIZE ĐÃ THÊM</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th>STT</th>
                  <th>SIZE</th>
                  <th>HÀNH ĐỘNG</th>
                </tr>
                </thead>
                <tbody>
                <?php

                  $sql = "select * from tb_size order by name asc";
                  $query = mysqli_query($conn, $sql);

                  $i = 1;
                  while ($rows = mysqli_fetch_array($query)) {

                ?>
                <tr class="text-center">
                  <td><?php echo $i; ?></td>
                  <td>
                    <a>
                      <?php
                        echo $rows['name'];
                      ?>
                    </a>
                  </td>
                  <td class="project-actions text-center">
                      <a class="btn btn-danger btn-sm" href="handling/handling-delete-size.php?id=<?php echo $rows['id']; ?>">
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
  require "js-customs/js-add-attribute.php";
?>
