<div class="row">

    <div class="col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
        <div class="jarviswidget" id="wid-id-0">
            <header>
                <h2><strong><i class="fa fa-edit"></i> Create account</strong></h2>
            </header>

            <div>
                <div class="widget-body">
                    <?php
                    echo validation_errors();
                    $setup = array(
                        'class' => 'smart-form form',
                        'id' => 'reg_form')
                    ?>

                    <?php echo form_open('javascript:void(0);', $setup); ?>

                        <section>
                            <label class="input">
                                <i class="icon-prepend fa fa-user"></i>
                                <input type="text" name="fname" placeholder="First Name" autofocus
                                       autocomplete="off"/>
                            </label>
                        </section>

                        <section>
                            <label class="input">
                                <i class="icon-prepend fa fa-user"></i>
                                <input type="text" name="sname" placeholder="Second Name"
                                       autocomplete="off"/>
                            </label>
                        </section>


                    <section>
                        <label class="input">
                            <i class="icon-prepend fa fa-user"></i>
                            <input type="text" name="username" placeholder="Username" autocomplete="off"/>
                        </label>
                    </section>

                    <section>
                        <label class="input">
                            <i class="icon-prepend fa fa-envelope"></i>
                            <input type="email" name="email" placeholder="Email" autocomplete="off"/>
                        </label>
                    </section>

                    <section>
                        <label class="input">
                            <i class="icon-prepend fa fa-key"></i>
                            <input type="password" name="password" placeholder="Password" autocomplete="off"
                                   id="password"/>
                        </label>
                    </section>

                    <section>
                        <label class="input">
                            <i class="icon-prepend fa fa-key"></i>
                            <input type="password" name="cpassword" placeholder="Confirm Password"
                                   autocomplete="off"/>
                        </label>
                    </section>

                    <footer class="reg">
                        <button type="submit" class="btn btn-vermilion btn-labeled reg-btn" name="login">
                <span class="btn-label">
                    <i class="fa fa-pencil"></i>
                </span>Register
                        </button>

                        <span class="pull-right">
                            <a href="<?= base_url('login'); ?>" class="text-info"><i class="fa
                             fa-sign-in"></i>
                                Already registered? Login
                            </a>
                        </span>
                    </footer>

                    <?php echo form_close() ?>
                </div>
            </div>

        </div>

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

<script type="text/javascript">
    $(document).ready(function () {

        $("#reg_form").validate({

            // Rules for form validation
            rules: {
                fname: {
                    required: true
                },
                sname: {
                    required: true
                },
                username: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                cpassword: {
                    required: true,
                    equalTo: "#password"
                }
            },
            // Messages for form validation
            messages: {
                fname: {
                    required: 'Enter your first name'
                },
                sname: {
                    required: 'Enter you last name'
                },
                username: {
                    required: 'Enter your username'
                },
                email: {
                    required: 'Enter your email',
                    email: 'Enter a valid email'
                },
                password: {
                    required: 'Enter your secret password'
                },
                cpassword: {
                    required: 'Re-enter the password',
                    equalTo: 'The password must match'
                }
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            },

            // if the validation passes, submit using ajax
            submitHandler: function (comment_form) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('register/register_user');?>",
                    data: $(comment_form).serialize(),
                    success: function (data) {
                        //window.location.reload();
                        window.location.href = 'home/index';
                    }
                });

            }
        });
    });
</script>