<div class="row">

    <div class="col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
        <div class="jarviswidget">
            <header>
                <h2><i class="fa fa-lock"></i> Login</h2>
            </header>
            <div>
                <div class="widget-body">
                    <?php if($this->session->flashdata('error_login')):?>
                    <p class="alert alert-danger animated bounce">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-exclamation-triangle"></i> <?=$this->session->flashdata('error_login')?>
                    </p>
                    <?php
                    endif;
                    $setup = array(
                        'class' => 'smart-form',
                        'id' => 'login_form'
                    );
                    ?>

                    <?=form_open('login/login_attempt', $setup); ?>
                    <section>
                        <label class="input">
                            <input type="text" name="username" placeholder="Username" autofocus
                                   autocomplete="off"/>
                        </label>
                    </section>

                    <section>
                        <label class="input">
                            <input type="password" name="password" placeholder="Password" autocomplete="off"/>
                        </label>
                    </section>

                    <footer class="reg">
                                <button type="submit" class="btn btn-vermilion btn-labeled reg-btn" name="login">
                <span class="btn-label">
                    <i class="fa fa-sign-in"></i>
                </span>Sign In
                                </button>
                            <span class="pull-right">
                                <a href="<?= base_url('register'); ?>" class="text-info"><i class="fa
                                 fa-pencil-square"></i>
                                    Create an account
                                </a>
                            </span>
                    </footer>

                    <?=form_close() ?>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $("#login_form").validate({
                    // Rules for form validation
                    rules: {
                        username: {
                            required: true
                        },
                        password: {
                            required: true
                        }
                    },
                    // Messages for form validation
                    messages: {
                        username: {
                            required: 'Please enter your username'
                        },
                        password: {
                            required: 'Please enter you password'
                        }
                    },
                    // Do not change code below
                    errorPlacement: function (error, element) {
                        error.insertAfter(element.parent());
                    }
                });
            });
        </script>
    </div>
</div>

<!--Social network signin-->
<div class="row">
    <div class="col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
        <div class="jarviswidget animated fadeInUp">
            <header>
                <h2><i class="fa fa-sign-in"></i> Signin using...</h2>
            </header>
            <div>
                <div class="widget-body">
                    <a href="#" onClick="fb_login(); return false;" class="btn btn-primary font-lg btn-block"><i
                            class="fa fa-facebook-square fa-lg"></i> Facebook</a>

                    <div id="status"></div>
                    <div id="fb-root"></div>

                    <div class="font-md text-align-center">Or</div>

                    <!-- sign in with google start -->
                    <a class="btn btn-block btn-danger font-lg" id="signinButton"><i class="fa fa-lg
                        fa-google-plus-square"></i>
                        Google</a>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
include(APPPATH . 'views/v_scripts/facebook_login.php');
include(APPPATH . 'views/v_scripts/google_login.php');
?>

