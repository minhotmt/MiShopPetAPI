<?php
  require "../includes/DBConnection.php";
  require "plade/header.php";
?>

  <!-- Content Wrapper. Contains flag content -->
  <div class="content-wrapper">
    <!-- Content Header (flag header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">TỔNG QUAN</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php
                    $sql = "select * from tb_banner";
                    $query = mysqli_query($conn, $sql);
                    $rows_count = mysqli_num_rows($query);
                    echo $rows_count;
                  ?>
                </h3>
                <p>BANNERS</p>
              </div>
              <div class="icon">
                <i class="far fa-image"></i>
              </div>
              <a href="banners.php?flag=3" class="small-box-footer">CHI TIẾT <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php
                    $sql = "select * from tb_category";
                    $query = mysqli_query($conn, $sql);
                    $rows_count = mysqli_num_rows($query);
                    echo $rows_count;
                  ?>
                </h3>
                <p>DANH MỤC</p>
              </div>
              <div class="icon">
                <i class="fas fa-th"></i>
              </div>
              <a href="categories.php?flag=5" class="small-box-footer">CHI TIẾT <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php
                    $sql = "select * from tb_child_category";
                    $query = mysqli_query($conn, $sql);
                    $rows_count = mysqli_num_rows($query);
                    echo $rows_count;
                  ?>
                </h3>
                <p>DANH MỤC CON</p>
              </div>
              <div class="icon">
                <i class="fas fa-th"></i>
              </div>
              <a href="child-categories.php?flag=7" class="small-box-footer">CHI TIẾT <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php
                    $sql = "select * from tb_product";
                    $query = mysqli_query($conn, $sql);
                    $rows_count = mysqli_num_rows($query);
                    echo $rows_count;
                  ?>
                </h3>
                <p>SẢN PHẨM</p>
              </div>
              <div class="icon">
                <i class="fas fa-tshirt"></i>
              </div>
              <a href="products.php?flag=9" class="small-box-footer">CHI TIẾT <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php
                    $sql = "select * from tb_brand";
                    $query = mysqli_query($conn, $sql);
                    $rows_count = mysqli_num_rows($query);
                    echo $rows_count;
                  ?>
                </h3>
                <p>THƯƠNG HIỆU</p>
              </div>
              <div class="icon">
                <i class="fa fa-trademark"></i>
              </div>
              <a href="brands.php?flag=18" class="small-box-footer">CHI TIẾT <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php
                    $sql = "select * from tb_order where status = '3'";
                    $query = mysqli_query($conn, $sql);
                    $rows_count = mysqli_num_rows($query);
                    echo $rows_count;
                  ?>
                </h3>
                <p>ĐƠN HÀNG</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="orders.php?flag=12" class="small-box-footer">CHI TIẾT <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php
                    $sql = "select * from tb_user";
                    $query = mysqli_query($conn, $sql);
                    $rows_count = mysqli_num_rows($query);
                    echo $rows_count;
                  ?>
                </h3>
                <p>KHÁCH HÀNG</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="users.php?flag=15" class="small-box-footer">CHI TIẾT <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    require "plade/footer.php";
  ?>
