<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Update your password, please fillup the form below.</p>

      <form action="<?=base_url("update-password");?>" method="post">
        <div class="input-group mb-3">
          <input name="password"  required type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" required name="password2" class="form-control" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
 
        </div>
      </form>

      <?php $msg = $this->session->flashdata('results');?>
      <?php if($msg){?> 
        <div class="alert alert-danger mt-3" role="alert">
           <?= $msg['msg']?>
        </div>
       <?php }?>
    </div>

  </div>