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
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">TOÀN BỘ BANNER</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th>STT</th>
                  <th>BANNER IMAGE</th>
                  <th>HÀNH ĐỘNG</th>
                </tr>
                </thead>
                <tbody>
                <?php

                  $sql = "select * from tb_banner order by id desc";
                  $query = mysqli_query($conn, $sql);

                  $i = 1;
                  while ($rows = mysqli_fetch_array($query)) {

                ?>
                <tr class="text-center">
                  <td><?php echo $i; ?></td>
                  <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <img alt="banner" src="<?php echo $rows['banner_url']; ?>" width= auto height="100">
                        </li>
                    </ul>
                  </td>
                  <td class="project-actions text-center">
                        <a class="btn btn-danger btn-sm" href="handling/handling-delete-banner.php?id=<?php echo $rows['id']; ?>">
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
  require "js-customs/js-banner.php";
?>
