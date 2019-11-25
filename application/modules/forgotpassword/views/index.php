<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="<?=base_url("forgotpassword/requestpassword")?>" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?=base_url("login");?>">Login</a>
      </p>
      <p class="mb-0">
        <a href="<?=base_url("register");?>" class="text-center">Register account</a>
      </p>
      <?php $msg = $this->session->flashdata('results');?>
      <?php if($msg){?> 
        <div class="alert alert-danger mt-3" role="alert">
           <?= $msg['msg']?>
        </div>
       <?php }?>
    </div>
    <!-- /.login-card-body -->
  </div>