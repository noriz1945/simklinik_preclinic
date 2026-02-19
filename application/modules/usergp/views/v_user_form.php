<!doctype html>
<html>

<head>
	<?php $this->theme->head('theme_default'); ?>
</head>
<?php $this->theme->wrapper_open('theme_default'); ?>

<?php foreach($userData as $du) ?>
<br>

 <!-- page content -->
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
    <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>UBAH PASSWORD <small>user ID : <?php echo $du->username ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="<?php echo base_url(). 'usergp/usergp/updatedata_user'; ?>" method="post">

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" placeholder="Password Baru" type="text" name="password" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="login_pass_val" placeholder="Ketik ulang password baru" type="text" name="login_pass_val" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <br><br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <button type="submit" id="btnSubmit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                      <input  placeholder="Login User" type="text" class="form-control hide" name="username" value="<?php echo $du->username ?>" readonly>
                      <input  placeholder="Password Lama" type="text" class="form-control hide" name="password_lama_view" value="<?php echo $du->password ?>" readonly>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


<?php $this->theme->script('theme_default'); ?>
<script type="text/javascript">
        $(function () {
            $("#btnSubmit").click(function () {
                var password = $("#password").val();
                var confirmPassword = $("#login_pass_val").val();
                if (password != confirmPassword) {
                    alert("Password tidak sama.");
                    return false;
                }
                return true;
            });
        });
    </script>