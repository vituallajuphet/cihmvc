<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Register</b> Account</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?=base_url("user/register_account");?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="fullname" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Age" name="age">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="username" type="text" class="form-control" placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
       
        <div class="row">
       
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->

          
        </div>
      </form>

    

      <a href="<?= base_url("login");?>" class="text-center">I already have a membership</a>
    <br><br>
      <div class="row">
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
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>