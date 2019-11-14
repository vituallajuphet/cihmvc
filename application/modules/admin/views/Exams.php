<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>


    </ul>

 

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> User
   
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          <div class="dropdown-divider"></div>
          <a href="<?= base_url("logout");?>" class="dropdown-item">
            <i class="fas fa-close"></i> Logout
           
          </a>
      
         
      
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Todo App (Admin)</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url();?>/static/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $user["fullname"];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
          <li class="nav-item active">
            <a href="<?=base_url("admin/dashboard");?>" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Todos
            
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url("admin/students");?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Student
            
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url("admin/exams");?>" class="nav-link active">
              <i class="nav-icon fas fa-poll-h"></i>
              <p>
               Exams
            
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Exams</h1>
            
          </div><!-- /.col -->
          <div class="col-mb-3">
          <br>
            <a href="<?=base_url("admin/createexam");?>" class="btn btn-primary">Create Exam</a>
          </div>
        
          <div class="col-sm-12">
          <br>
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                 <thead>
                <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Exam ID</th>  
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Category</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Created Date</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Action</th>
              </tr>
            <tbody>
                  
                  <?php 
        
                    if(count($exams) > 0){
                      foreach ($exams as $exam) {
                        ?>
                          <tr role="row">
                            <td class="sorting_1"><?= $exam["exam_id"];?></td>
                            <td style="width:40%;"><?= $exam["category"];?></td>
                            <td class="sorting_1"><?=$exam["created_date"] ; ?></td>
                            <td>
                            <a href="<?=base_url("admin/viewexam/");?><?= $exam["exam_id"];?>"><i class="fa fa-eye"></i> View</a>
                            <!-- <a style="color:#a42828;display:inline-block;margin-left:10px;" href="<?= base_url("");?>"><i class="fa fa-trash"></i>Delete</a> -->
                            </td>
                        </tr>
                        <?php
                      }
                    }
                    else{
                      ?>
                        <tr>
                          <td colspan="4">
                            no data found!
                          </td>
                        </tr>
                      <?php
                    }
                  ?>

                

              </tbody>  
              </table>
              </div>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
 
        <!-- start -->
        <div class="col-sm-12">

        </div>
        <!-- end -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.1-pre
    </div>
  </footer>
</div>