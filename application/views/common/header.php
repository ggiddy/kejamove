<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<html>

    <head>

        <title>KejaMove</title>

        <!-- Meta -->

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <meta name="description" content="Moving has never been easier."/>

        <meta name="author" content=""/>

        <!-- Facebook Meta tags -->

        <meta property="og:url"           content="<?=base_url();?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="Kejamove" />
        <meta property="og:description"   content="I am using KejaMove to move to my new house!" />
        <meta property="og:image"         content="<?=base_url();?>images/logos/kejamove1.png" />
       
        <!--Links-->

        <link rel="shortcut icon" href="<?php echo base_url('images/logos/favicon.ico');?>">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/app.css');?>" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/app-responsive.css');?>" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <![endif]-->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdnqpjOHWoYyakUwAbI0Cf0-plL-cyghE&libraries=places"></script>
        
    <script type="text/javascript" src="<?php echo base_url('js/vendor/handlebars.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/moment-with-locales.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/jquery.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/jquery-migrate.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/bootstrap.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/bootstrap-hover-dropdown.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/jquery.inview.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/isMobile.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/back-to-top.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/jquery.placeholder.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/bootstrap-select.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/pace.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/jquery.nicescroll.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/jquery.autosize.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/datetimepicker.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/vendor/animations.js'); ?>"></script>  

    <script type="text/javascript" src="<?php echo base_url('js/app/core/app.js'); ?>"></script>  

    <body class="panel app-container<?php if(isset($body_class)) echo " $body_class"; ?>">

        <!-- Facebook Like button script starts -->
        <section class="content">

        <!-- Facebook Like button script ends -->

            <!-- ******HEADER****** -->

            <?php if(!isset($no_header) || !$no_header): ?>
            <header id="header" class="app-header<?php if(isset($alt_logo) && $alt_logo) echo ' shadow-less'; ?>">

                <div class="container animated fadeInDown">

                    <h1 class="logo pull-left">

                        <a href="<?php echo base_url(); ?>">

                            <?php $logo = 'images/logos/kejamove-logo.png'; ?>
                            <?php if(isset($alt_logo) && $alt_logo) $logo = 'images/logos/kejamove-logo-alt.png'; ?>

                            <span class="logo-title-inner">
                                <img src="<?php echo base_url($logo); ?>">
                            </span>

                        </a>

                    </h1><!--//logo-->

                    <nav id="main-nav" class="main-nav navbar-right" role="navigation">

                        <div class="navbar-header">

                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">

                                <span class="sr-only">Toggle navigation</span>

                                <span class="icon-bar"></span>

                                <span class="icon-bar"></span>

                                <span class="icon-bar"></span>

                            </button><!--//nav-toggle-->

                            </div><!--//navbar-header-->

                            <div class="navbar-collapse collapse" id="navbar-collapse">

                                <ul style="text-transform:lower-case" class="nav navbar-nav">
                                
                                    <li class="nav-item <?php echo (isset($alt_logo) ? 'fa-black' : 'fa-white'); ?>">

                                        <a style="color: #fd852d" href="<?=base_url('app/howitworks/');?>">How it works</a>

                                    </li>

                                    <li class="nav-item <?php echo (isset($alt_logo) ? 'fa-black' : 'fa-white'); ?>">

                                        <a style="color: #fd852d" href="<?=base_url();?>">Home</a>

                                    </li>

                                </ul><!--//nav-->

                            </div><!--//navabr-collapse-->

                        </nav><!--//main-nav-->

                    </div><!--//container-->

                </header><!--//header-->
            <?php endif; ?>