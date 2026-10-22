<div class="form-box" id="login-box">
    <div class="header">Welcome back</div>
    <p class="auth__lead">Sign in with the username and password provided by the school.</p>
    <form method="post">
        <div class="body white-bg">
        <?php
            if($form_validation == "No"){
            } else {
                if(customCompute($form_validation)) {
                    echo "<div class=\"alert alert-danger alert-dismissable\">
                        <i class=\"fa fa-exclamation-circle\"></i>
                        <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                        $form_validation
                    </div>";
                }
            }
            if($this->session->flashdata('reset_success')) {
                $message = $this->session->flashdata('reset_success');
                echo "<div class=\"alert alert-success alert-dismissable\">
                    <i class=\"fa fa-check-circle\"></i>
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    $message
                </div>";
            }
        ?>
            <div class="form-group">
                <label class="auth__label" for="username">Username</label>
                <div class="auth__field">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input class="form-control" id="username" placeholder="Enter your username" name="username" type="text" autocomplete="username" autocapitalize="none" autofocus value="<?=set_value('username')?>">
                </div>
            </div>
            <div class="form-group">
                <label class="auth__label" for="password">Password</label>
                <div class="auth__field">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input class="form-control has-toggle" id="password" placeholder="Enter your password" name="password" type="password" autocomplete="current-password">
                    <button class="auth__toggle" type="button" aria-label="Show password" data-toggle-password><i class="fa fa-eye"></i></button>
                </div>
            </div>

            <div class="auth__row">
                <label>
                    <input type="checkbox" value="Remember Me" name="remember">
                    <span>Remember me</span>
                </label>
                <a href="<?=base_url('reset/index')?>">Forgot password?</a>
            </div>

            <?php if(isset($siteinfos->captcha_status) && $siteinfos->captcha_status == 0) { ?>
                <div class="form-group">
                    <?php echo $recaptcha['widget']; echo $recaptcha['script']; ?>
                </div>
            <?php } ?>

            <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign in" />
        </div>
    </form>
</div>
