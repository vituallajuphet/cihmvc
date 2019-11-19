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
            <h1 class="m-0 text-dark">Create Exam</h1>
            
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
                <h3 class="card-title">Create Questions:</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
   
              <form role="form" method="post" action="<?=base_url("admin/save_todo")?>">
                <div class="card-body">
                  <div class="row">
                       
                       <div class="col-md-3"> 
                          <div class="form-group">
                              <label for="exampleInputEmail1">Category:</label>
                                <select name="examtype" id="examtype" class="form-control" >
                                    <option value="">Please Select</option>
                                    <?php 
                                      foreach ($exam_categories as $cat) {
                                        ?>
                                           <option value="<?= $cat["category_name"];?>"><?= $cat["category_name"];?></option>
                                        <?php
                                      }
                                    ?>
                                </select>
                                <a href="javascript:;" class="btnCategoryEdit"><i class="fa fa-edit"></i> Manage Category</a>
                            </div>
                       </div>
                       <div class="col-md-3"> </div> 
                
                        <div class="col-md-12">
                        <br>
                        <h5>Question List:</h5>
                        <div id="accordion">
                                
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
                  <button id="btnAddQuestion" type="button" class="btn btn-primary">Add Question</button>
                  <button type="button" id="btnSaveExam" class="btn btn-success" disabled > <i class="fa fa-check"></i> Done</button>
                  <a href="<?=base_url("admin/dashboard");?>" class="btn btn-danger" style="color:white;">Cancel</a>
                </div>
              </form>
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
   <!-- modal -->
   <div class="modal fade in" id="question_modal" style=" padding-right: 17px;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
           Question Form:
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
       
          </div>
          <div class="modal-body">
            <form action="" class="frmQuestion" method="POST" >
            <div class="row">
             <div class="col-md-5">
              <label for="exampleInputFile">Question Type:</label>
                <select name="frm" required id="selExamType" class="form-control">
                    <option value="">Please Select.</option>
                    <option value="Choices">Choices</option>
                    <option value="No Choices">No Choices</option>
                </select>
             </div>
                        
             <div class="col-md-12 selChoices"  style="display:none;">
             <br>
                <label for="exampleInputFile">Question:</label>
                <textarea required name="content" id="tbxQuestion" class="form-control"></textarea>
                <br>
                <label for="exampleInputFile">Choices:</label>
                <div class=row>
                    <div class="col-md-4">
                          A. <input id="tbxChoiceA" required type="text" name="choiceA" class="form-control">
                    </div>
                    <div class="col-md-4">
                          B. <input id="tbxChoiceB" required type="text" name="choiceB" class="form-control">
                    </div>
                    <div class="col-md-4">
                          C. <input id="tbxChoiceC" required type="text" name="choicec" class="form-control">
                    </div>
                </div>
              
           
              <label for="exampleInputFile">Answer:</label>
                <select name="frm" id="selAnswer" required class="form-control">
                    <option value="">Please Select answer.</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            
             </div>
             

             <div class="col-md-12 selNoChoices" style="display:none;"><br>
                <label for="exampleInputFile">Question:</label>
                <textarea required id="tbxQuestion2" name="content" class="form-control"></textarea>
                <br>
                <div class="row">
                        <div class="col-md-3">
                         <label for="exampleInputFile">Answer:</label>
                         <input id="tbxAnswer" required type="text" class="form-control">
                      </div>
                      <div class="col-md-9">
       
                      </div>
                </div>
             </div>
          

          <div class="col-md-12">
          <br>
          <div style="display:none;" class="alert alert-danger msgAlert" role="alert">
                   Please Input the required Fields!
         </div>
          </div>
          </div>
       
          
          </div>
          
          <div class="modal-footer">
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
             <button type="button" id="btnASaveQuestion" class="btn btn-primary pull-left" >Save</button>
            
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>  
    <!-- end modal -->

    <!-- start midal 2 -->
    <div class="modal fade in" id="modal_category" style=" padding-right: 17px; display:none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    Category List:
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                         <form class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" required class="form-control" id="tbxCategory" placeholder="Category name...">
                            </div>
                            <button type="button" class="btn btn-primary mb-2 btnSaveCategory">Save</button>
                          </form>

                          <div class="row">
                            <div class="col-md-12">
                            <table class="table table-striped tbl-category">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                
                                    foreach ($exam_categories as $cat) {
                                      ?>
                                        <tr>
                                          <th scope="row"><?= $cat["category_id"];?></th>
                                          <td><?= $cat["category_name"];?></td>
                                          <td><?= $cat["created_date"];?></td>
                                          <td><a href="javascript:;"><i class="fa fa-edit"></i></a> <a style='color:red' href="javascript:;"><i class="fa fa-trash"></i></a</td>
                                        </tr>
                                      <?php
                                    }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                            <div class="col-md-12" >
                              <div class="alertmsg" style="display:none;">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  That category name is already exist!
                                </div>
                              </div>
                              
                            </div>
                          </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <!-- <button type="button" id="" class="btn btn-primary pull-left" >Save</button> -->
                </div>
            </div>
        </div>
    </div>                     
    <!-- end modal 2 -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.1-pre
    </div>
  </footer>
</div>