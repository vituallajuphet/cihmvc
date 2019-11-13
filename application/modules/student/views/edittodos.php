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
      <span class="brand-text font-weight-light">Todo App (Student)</span>
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
            <a href="<?=base_url("admin/dashboard");?>" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                My Todos
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="<?=base_url("admin/dashboard");?>" class="nav-link ">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
               Todos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('students/profile');?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Profile
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
            <h1 class="m-0 text-dark">Update Todo</h1>
          </div><!-- /.col -->

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
            <!-- formstart -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Todo Information:</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
              <form role="form" method="post" action="<?=base_url("students/updatetodo");?>">
                <div class="card-body">
                  <div class="row">
                    <input type="hidden" name="todo_id" value="<?=  $todos[0]["todo_id"]; ?>">
                     
                      <div class="col-md-6">
                             <div class="form-group">
                            <label for="exampleInputEmail1">Status:</label>
                            <br><span style="color:#4884e1"><?= $todos[0]["completed"]; ?></span>
                            </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputFile" name="student">Assigned to: </label><br>
                          <span><?php echo $user["fullname"];?></span>

                          </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputFile">Update Todo Status:</label>
                          <select name="completed" required  class="form-control">    
                                  <option value="Pending">Pending</option>
                                  <option value="Break">Break</option>
                                 <option value="In-Progress">In-Progress</option>
                                 <option value="For QA">For QA</option>
                              
                          </select>
                          </div>
                      </div>
       
                 

                      
                  </div>
               
                  
            
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="<?=base_url("students/dashboard");?>" class="btn btn-danger" style="color:white;">Cancel</a>
                </div>
              </form>
            </div>
            <!-- end start -->
        </div>

        <div class="col-md-12">
        <?php 
                      $count =1;
                      ?>
                       <div class="col-md-12">
                       <hr>
                        <div class="card card-success card-instruction">
                                    <div class="card-header">
                                      <h3 class="card-title">Instruction <?php echo $count++ ;?></h3>

                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                        </button>
                                      </div>
                                      <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="display:none;">
                                      <?=  $todos[0]["content"];?>
                                    </div>
                                    <!-- /.card-body -->
                              </div>
                              </div>
                      <?php
                        foreach ($todo_details as $todo_detail ) {
                         ?>
                            <div class="col-md-12">
                              <div class="card card-success card-instruction">
                                    <div class="card-header">
                                      <h3 class="card-title">Instruction <?php echo $count++ ;?></h3>

                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                        </button>
                                      </div>
                                      <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="display:none;">
                                      <?=  $todo_detail["instruction"];?>
                                    </div>
                                    <!-- /.card-body -->
                              </div>
                            </div>
                         <?php
                        }

                      ?>
    <br>
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
  </footer></div>