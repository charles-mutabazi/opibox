<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$loggedin_id = $this->session->userdata('user_id');
if($loggedin_id){
    $loggedObj = user_model::get_user_by_id($loggedin_id);

    $avatar = base_url() . "images/profile_pic/avatar.png";
    if ($loggedObj->profile_pic != ""){
        $logged_pic_path = base_url() . "images/profile_pic/".$loggedObj->profile_pic;
    }else{
        $logged_pic_path = $avatar;
    }
}
?>

<html>
<head>
    <title>OpiBox :: <?=$page_title?></title>

    <!-- Use the correct meta names below for your web application
         Ref: http://davidbcalhoun.com/2010/viewport-metatag-->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Basic Styles -->

    <meta name="google-signin-clientid" content="330710704611-qc5qdbgl6qsu5fpu6ihv621d2rhhqhur.apps.googleusercontent.com" />
    <meta name="google-signin-scope" content="https://www.googleapis.com/auth/plus.login" />
    <meta name="google-signin-requestvisibleactions" content="http://schema.org/AddAction" />
    <meta name="google-signin-cookiepolicy" content="single_host_origin" />
    <!-- loads the render() function for google sign in -->

    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() . "styling/css/bootstrap.min.css"; ?>" >
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() . "styling/css/font-awesome.min.css"; ?>" >
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() . "styling/css/my_style.css"; ?>" >


    <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url() . "styling/css/error_page.css"; ?>" > -->
    <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() . "styling/css/smartadmin-production-plugins.min.css"; ?>" >
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() . "styling/css/smartadmin-production.min.css"; ?>" >
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() . "styling/css/smartadmin-skins.min.css"; ?>" >
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() . "styling/css/jasny-bootstrap.css"; ?>" >

    <script src="<?php echo base_url('styling/js/libs/jquery-2.1.1.min.js') ?>"></script>
    <script src="https://apis.google.com/js/client:platform.js" async defer></script>
    <!--    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
    <link rel="shortcut icon" type="image/png" href="<?=base_url('images/favicon_sm.png')?>"/>
</head>

<body>
<header class="navbar vermilion-bar navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapsing">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar nav-bar-icon"></span>
                <span class="icon-bar nav-bar-icon"></span>
                <span class="icon-bar nav-bar-icon"></span>
            </button>
            <a href="<?php echo base_url("home") ?>" class="navbar-brand"><img src="<?=base_url
                ('images/logo.png') ?>" width="108" height="37" style="margin-top: -8px"></a>

        </div>


        <div class="collapse navbar-collapse" id="navbar-collapsing" role="navigation">
            <ul class="nav navbar-nav navbar-right">
                <li class="margin-right-5 hidden-xs add-btn" style="display: none">
                    <button type="button" style="margin-top: 12px" class="btn btn-labeled btn-default navbar-btn" data-toggle="modal"
                            data-target="#post_modal">
                        <span class="btn-label"><i class="fa fa-pencil"></i></span> Demand</button>
                </li>
                <li><a href="<?php echo base_url("home") ?>"><span class="fa fa-home fa-lg"></span> Home</a></li>
                <li><a href="#"><i class="fa fa-bullhorn fa-lg"></i> Announcements</a></li>
                <?php if ($loggedin_id): ?>
                    <li class="dropdown">
                        <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                           role="menuitem" aria-expanded="false" class="nav-prof-pic">
                            <img src="<?php echo $logged_pic_path; ?>" alt=""
                                 class="img-rounded small-pic">
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?= base_url('user/' . $loggedin_id) ?>"><i class="fa fa-user"></i>
                                    <?= $loggedObj->first_name ?> </a></li>
                            <li><a href="<?= base_url('user/' . $loggedin_id . '/account'); ?>"><i
                                        class="fa fa-gear"></i> Account</a></li>
                            <li><a href="<?= base_url('login/logout') ?>"><i class="fa fa-sign-out"></i> Sign Out</a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>
        </div>

    </div>
</header>

<div class="container">
    <?php $this->load->view($content) ?>

    <!-- New post Modal-->
    <?php include(APPPATH .'views/modals/new_post_modal.php');?>
</div>

<script src="<?php echo base_url('styling/js/placeholder/holder.js') ?>"></script>
<script src="<?php echo base_url('styling/js/bootstrap/bootstrap.min.js') ?>"></script>

<!--IMAGE HOLDER JS-->
<script src="<?php echo base_url('styling/js/plugin/jquery-validate/jquery.validate.min.js') ?>"></script>
<script src="<?php echo base_url('styling/js/jasny-bootstrap.min.js') ?>"></script>

<!--Collapse JS-->
<script src="<?php echo base_url('styling/js/bootstrap/collapse.js') ?>"></script>

</body>

<script>

    $(document).ready(function () {

        //Check to see if the window is top if not then display button
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.add-btn').fadeIn();
            } else {
                $('.add-btn').fadeOut();
            }
        });

        //Click event to scroll to top
//        $('#add-btn').click(function(){
//            $('html, body').animate({scrollTop : 0},800);
//            return false;
//        });

    });
</script>

</html>