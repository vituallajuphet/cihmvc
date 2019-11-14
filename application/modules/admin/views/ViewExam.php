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
            <h1 class="m-0 text-dark">View Exam</h1>
            
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
                <h3 class="card-title">Examination Information:</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
   
                <div class="card-body">
                  <div class="row">
                       
                       <div class="col-md-3"> 
                          <div class="form-group">
                              <label for="exampleInputEmail1">Category:</label><br>
                               <span><?= $exams[0]["category"]; ?></span>
                            </div>
                       </div>
                       <div class="col-md-3"> 
                          <div class="form-group">
                              <label for="exampleInputEmail1">Created Date:</label><br>
                               <span><?= $exams[0]["created_date"]; ?></span>
                            </div>
                       </div>
                       <div class="col-md-6"> </div> 
                
                        <div class="col-md-12">
      
                        <label for="exampleInputEmail1">Questionaire:</label><br>
                         
                        <div id="accordion">

                            <?php 
                                if(count($exams) > 0){

                                
                                    $count =0;
                                    foreach($exams as $exam){
                                        $count++;
                                        ?>

                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                <h6 class="mb-0">
                                                    <a style="display:block;"href="#" data-toggle="collapse" data-target="#collapse<?=$count;?>" aria-expanded="true" aria-controls="collapseOne">Question <?=  $count;?></a>
                                                </h6>
                                                </div>

                                                <div id="collapse<?=$count;?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <h6>Question:</h6>
                                                        <p style="font-style:italic;"><?= $exam["question"] ;?></p>

                                                        <?php if($exam["qtype"] == "Choices"){?> 
                                                            <div>
                                                                <ul style="list-style:none;">
                                                                    <li>A: <?= $exam["choiceA"]  ;?></li>
                                                                    <li>B: <?= $exam["choiceB"]  ;?></li>
                                                                    <li>C: <?= $exam["choiceC"]  ;?></li>
                                                                    </ul>
                                                            </div>
                                                        <?php }?>

                                                        <h6>Answer: <strong><?= $exam["answer"] ;?></strong></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                            
                        </div>
                        </div>

                      <div class="col-md-12">
                        <?php 
                        $msg =  $this->session->flashdata('flashdata');

                          if($msg){
                            $class=$msg["err"] ? "danger" : "success";
                          ?>
                            <div class="alert alert-<?=$class?> alert-dismissible fade show" role="alert">
                              <?= $msg["message"] ?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <?php
                        }
                      ?>
                      </div>
                  </div>
               
                  
            
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
               
                </div>

            </div>
            <!-- end start -->
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