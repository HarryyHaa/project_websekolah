<style type="text/css">
    .row{
        margin-bottom: 5px !important;
    }
</style>

<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

//$school_profile = $this->profile_model->get_school_profile();

?>

<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta name="theme-color" content="#2196F3">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(''); ?>aila_cbt/css/materialize.min.css"  media="screen,projection"/>

        <!-- My CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>aila_cbt/css/style.css">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('aila_cbt/images/logo.png') ?>" />

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--title>UBK <?=strip_tags($school_profile->name).' - '.strip_tags($school_profile->district);?>  | Lolipop</title> --> 

        <title>UBK <?=strip_tags($this->config->item('cbt_name')).' - '.strip_tags($this->config->item('address'));?>  | CBT Lolipop</title> 

        <meta http-equiv="X-UA-Compatible" content="IE=Edge">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">

        <meta name="keywords" content="Ujian Online  <?=$this->config->item('cbt_name').' - '.$this->config->item('address');?>, Lolipop,
        Ujian Basis Komputer">

        <meta name="description" content="Ujian Basis Komputer  <?=$this->config->item('cbt_name').' - '.$this->config->item('address');?> | Lolipop">


        <meta content='indonesian' name='language'/>
        <meta content='id' name='geo.country'/>
        <meta content='indonesia' name='geo.placename'/>
        <meta content='never' name='expires'/>
        <meta content='always' name='revisit'/>
        <meta content='global' name='distribution'/>
        <meta content='general' name='rating'/>
        <meta content='true' name='MSSmartTagsPreventParsing'/>
        <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
        <meta content='index, follow' name='googlebot'/>
        <meta content='follow, all' name='Googlebot-Image'/>
        <meta content='follow, all' name='msnbot'/>
        <meta content='follow, all' name='Slurp'/>
        <meta content='follow, all' name='ZyBorg'/>
        <meta content='follow, all' name='Scooter'/>
        <meta content='all' name='spiders'/>
        <meta content='all' name='WEBCRAWLERS'/>
        <meta content='aeiwi, alexa, alltheWeb, altavista, aol netfind, anzwers, canada, directhit, euroseek, excite, overture, go, google, hotbot. infomak, kanoodle, lycos, mastersite, national directory, northern light, searchit, simplesearch, Websmostlinked, webtop, what-u-seek, aol, yahoo, webcrawler, infoseek, excite, magellan, looksmart, bing, cnet, googlebot' name='search engines'/>

        <meta property="og:image" content="" />
        <meta property="og:locale" content="id_ID"/>
        <meta property="og:title" content="UBK  <?=strip_tags($this->config->item('cbt_name')).' - '.strip_tags($this->config->item('address'));?>" />
    
        <meta property="og:type" content="article" />
        <meta property="og:image" content="" />
        
        <meta property="og:site_name" content=" <?=strip_tags($this->config->item('cbt_name')).' - '.strip_tags($this->config->item('address'));?>"/>
        <meta property="og:description" content="Ujian Basis Komputer  <?=strip_tags($this->config->item('cbt_name')).' - '.strip_tags($this->config->item('address'));?>" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>aila_cbt/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>aila_cbt/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>aila_cbt/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>aila_cbt/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>aila_cbt/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>aila_cbt/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url(); ?>aila_cbt/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>aila_cbt/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url(); ?>aila_cbt/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>aila_cbt/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>aila_cbt/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(''); ?>aila_cbt/css/materialize.min.css"  media="screen,projection"/>

        <!-- My CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>aila_cbt/css/style.css">

        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
        <!-- END HEAD -->

    <body class="login">

        <!-- BEGIN LOGO -->
        <div class="logo">
           <!-- <a href="index.html">-->
            <img src="<?php echo base_url(); ?>aila_cbt/images/logo.png" alt="" /> </a>
        </div>

        <?php $this->load->view($content); ?>

        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <!--<div class="content">
            <!-- BEGIN LOGIN FORM 
            <form class="login-form" action="<?php echo base_url('Auth_c/act_login'); ?>" method="post">
                <h3 class="form-title font-green">Sign In atuh</h3>
                <!--<div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any email and password. </span>
                </div>
                <?php if($this->session->flashdata('err_log') != "") { ?>
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <span> Email atau pasword salah. </span>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" required="" /> 
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions"> 
                     <button type="submit" name="login" class="btn waves-effect  primary  col s12">Login</button>
                   <!-- <button type="submit" class="btn green uppercase">Login</button>
                   
                </div> 
                 <a href="javascript:;" id="forget-password" class="btn red forget-password uppercase">Cetak Kartu</a>
                <div class="create-account">
                    <p>
                        2020 © jaja tri harja
                    </p>
                </div>
            </form>
            
        </div>-->
       
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>aila_cbt/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>aila_cbt/pages/scripts/login.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>aila_cbt/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>aila_cbt/pages/scripts/components-select2.min.js" type="text/javascript"></script> 

        <script type="text/javascript" src="<?php echo base_url(''); ?>aila_cbt/js/materialize.min.js"></script>

        <script>
            const sideNav = document.querySelectorAll('.sidenav');
            M.Sidenav.init(sideNav);  


            const scroll = document.querySelectorAll('.scrollspy');
            M.ScrollSpy.init(scroll,{
            scrollOffset : 50
            });
        </script>


        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>