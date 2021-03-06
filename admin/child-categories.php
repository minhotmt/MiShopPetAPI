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
              <h3 class="card-title">TOÀN BỘ DANH MỤC CON</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th>STT</th>
                  <th>TÊN DANH MỤC</th>
                  <th>ẢNH</th>
                  <th>LOẠI DANH MỤC</th>
                  <th>HÀNH ĐỘNG</th>
                </tr>
                </thead>
                <tbody>
                <?php

                  $sql = "select cc.id, cc.name as cc_name, cc.thumbnail_name, cc.thumbnail_url, c.name as c_name from tb_child_category cc, tb_category c where cc.category_id = c.id order by cc.id desc";
                  $query = mysqli_query($conn, $sql);

                  $i = 1;
                  while ($rows = mysqli_fetch_array($query)) {

                ?>
                <tr class="text-center">
                  <td><?php echo $i; ?></td>
                  <td><?php echo $rows['cc_name']; ?></td>
                  <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <img alt="child-category-thumbnail" src="<?php echo $rows['thumbnail_url']; ?>" width=auto height="100">
                        </li>
                    </ul>
                  </td>
                  <td>
                    <?php echo $rows['c_name']; ?>
                  </td>
                  <td class="project-actions text-right">
                      <a class="btn btn-info btn-sm" href="edit-child-category.php?id=<?php echo $rows['id']; ?>&flag=7">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Sửa
                      </a>
                      <a class="btn btn-danger btn-sm" href="handling/handling-delete-child-category.php?id=<?php echo $rows['id']; ?>">
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
    require "js-customs/js-category.php";
  ?>
