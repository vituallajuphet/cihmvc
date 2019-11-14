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
            <a href="<?=base_url("students/dashboard");?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                My Todos
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="<?=base_url("students/todos");?>" class="nav-link">
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
          <li class="nav-item">
            <a href="<?=base_url("students/takeexam");?>" class="nav-link active">
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
            <h1 class="m-0 text-dark">Examinition in <?= $exams[0]["category"] ;?></h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                       Please answer the following with your best answer:
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span for="">Total Of Questions: <strong> <?= count($exams) ;?></strong> </span>
                            </div>
                            <div class="col-md-12">
                                <span for="">Category: <strong> <?= $exams[0]["category"] ;?></strong> </span>
                            </div>
                           
                            <div class="col-md-12">
                            <hr>

                                <?php 
                                $count = 0;
                                    foreach($exams as $exam){
                                        $count++;
                                        if($exam["qtype"] =="Choices"){
                                            ?>
                                                <div class="row">
                                                        <div class="col-md-12">
                                                        <strong><?= $count ;?>.</strong> <span style="font-style:italic;"><?= $exam["question"] ;?></span>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <br>
                                                            <ul style="list-style:none;">
                                                                <li>A. <span><?= $exam["choiceA"] ;?></span></li>
                                                                <li>B. <span><?= $exam["choiceB"] ;?></span></li>
                                                                <li>C. <span><?= $exam["choiceC"] ;?></span></li>
                                                    

                                                            </ul>
                                                        </div>

                                                            <div class="col-md-2">
                                                            <br>
                                                            Answer: 
                                                            <select name="" id="" class="form-control myAnswer">
                                                                <option value="">Select Answer</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">c</option>
                                                            </select>
                                                            <br>
                                                            <button class="btn btn-primary btnCheckAnswer" rel="<?= $exam["question_id"]?>" ref="<?=  $exam["exam_id"] ;?>">Done</button>
                                                            <br>
                                                            <div style="display:none;" class="correcRes"> Correct</div>
                                                            </div>
                                                        <div class="col-md-12">
                                                        <hr>
                                                        </div>
                                                        </div>    
                                            <?php
                                        }else{
                                            ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <strong><?= $count ;?></strong> <span style="font-style:italic;"><?= $exam["question"] ;?></span>
                                                    </div>
                                                        <div class="col-md-3">
                                                        <br>
                                                        Answer:  <input type="text" class="form-control myAnswer">
                                                        <br>
                                                        <button class="btn btn-primary btnCheckAnswer" rel="<?= $exam["question_id"]?>" ref="<?=  $exam["exam_id"] ;?>" class="btnCheckAnswer">Done</button>
                                                        <br><div style="display:none;" class="correcRes">Correct</div>
                                                        </div>
                                                    <div class="col-md-12">
                                                    <hr>
                                                    </div>
                                                    </div>
                                            <?php
                                        }
                                    }
                                
                                ?>
                            </div>
                            <div class="col-md-12">
                                    <button class="BtnSubmitScore btn btn-success">Submit Score</button>
                            </div>
                        </div>

                        
                    </div>
                </div>
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