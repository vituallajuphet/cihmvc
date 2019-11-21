<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Todo</b> App</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
       <?php $msg = $this->session->flashdata('results');?>
      <form action="<?=base_url("user/verify")?>" method="post">
        <div class="input-group mb-3">
          <input type="text" value="<?=$msg["username"];?>" name="username" required class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" required class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
         
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <div class="col-6">
            <a href="<?= base_url("/user/register");?>" class="btn btn-success btn-block">Register</a>
          </div>
          <div class="col-md-12">
          <br>
            <a href="<?=base_url("forgotpassword");?>">Forgot Password?</a>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div style="text-align:center;margin-top:10px;">
        <?php
        
        echo $msg['err']; ?>
      </div>
    
      <!-- /.social-auth-links -->

   
    </div>
    <!-- /.login-card-body -->
  </div>
</div>