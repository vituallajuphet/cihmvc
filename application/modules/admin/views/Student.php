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
      
          <li class="nav-item">
            <a href="<?=base_url("admin/dashboard");?>" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Todos
            
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url("admin/students");?>" class="nav-link active">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Student
            
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url("admin/exams");?>" class="nav-link">
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
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Students</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <a class="btn btn-primary" href="<?=base_url("admin/addstudent")?>"><i class="fa fa-plus"></i> Add Student</a>
            <a class="btn btn-warning" href="<?=base_url("admin/pendingstudent/")?>"><i class="fa fa-user"></i> Pending Student</a>
            <br><br>
          </div>
          
         
        <!-- start -->
        <div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Student ID</th>  
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Student Name</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Age</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Email</th>
            
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Action</th>
              </tr>
                <tbody>
                  
                  <?php 
                  
                    foreach ($students as $student) {
                      ?>
                        <tr role="row">
                          <td class="sorting_1"><?= $student["user_id"];?></td>
                          <td class="sorting_1"><?= $student["fullname"];?></td>
                          <td class="sorting_1"><?= $student["age"];?></td>
                          <td class="sorting_1"><?= $student["email"];?></td>
                          <td>
                          <a href="<?= base_url("admin/editstudent/". $student["user_id"]);?>"><i class="fa fa-edit"></i>Edit</a>
                          <a style="color:#a42828;display:inline-block;margin-left:10px;" href="<?= base_url("admin/deletestudent/". $student["user_id"]);?>"><i class="fa fa-trash"></i>Delete</a>
                          <a style="display:inline-block;margin-left:10px;" href="<?= base_url("admin/studenttodos/".$student["user_id"]); ?>"><i class="fa fa-eye"></i>View Todos</a>
                          </td>
                      </tr>
                      <?php
                    }
                  ?>

                

              </tbody>
              </table></div>
             

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