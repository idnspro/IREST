<script language="javascript" type="text/javascript">
    function validate(){
        document.frmLogin.submit();
    }
</script>

<div class="container">
    <div class="login-page">
        <div class="account_grid">
            <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
                <h3>NEW CUSTOMERS</h3>
                <p>By creating an account, you will be able to move through the checkout process faster, view and track your orders in your account and more.</p>
                <a class="acount-btn" href="register.php">Create an Account</a>
            </div>
            <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
                <h3>REGISTERED CUSTOMERS</h3>
                <p>If you have an account with us, please log in.</p>
                <?php
                if( ! empty( $form_array['name_error'] ) ) {
                ?>
                <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> <?php echo $form_array['name_error']; ?>.
                </div>
                <?php
                } elseif (  ! empty( $form_array['password_error'] ) ) {
                ?>
                <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> <?php echo $form_array['password_error']; ?>.
                </div>
                <?php
                }
                ?>
                <form action="<?php echo SITE_URL.'login.php'; ?>" method="post" name="frmLogin" id="frmLogin" onsubmit="return validate(); return false;">
                <input type="hidden" name="securityKey" value="<?php echo md5(USERLOGIN);?>" />
                <form>
                    <div>
                        <span>Email Address<label>*</label></span>
                        <input type="text" name="user_name" id="user_name" value="<?php echo trim($_POST['user_name']);?>" />
                    </div>
                    <div>
                        <span>Password<label>*</label></span>
                        <input type="password" name="user_password" id="user_password" value="<?php echo trim($_POST['user_password']);?>" />
                    </div>
                    <a class="forgot" href="<?php echo SITE_URL; ?>forget-password.php">Forgot Your Password?</a>
                    <input type="submit" value="Login">
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

