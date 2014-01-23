<!DOCTYPE html>
<!--[if IE 8]> <html lang="ch" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="ch" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="ch"> <!--<![endif]-->
<head>
   <meta charset="utf-8" />
   <title>Metronic | Admin Dashboard Template</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   
   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
   <!-- data table -->

   <!-- END PAGE LEVEL PLUGIN STYLES -->

   <!-- BEGIN THEME STYLES --> 
   <link href="/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="/assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->

   <script src="/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
 
   <link rel="shortcut icon" href="favicon.ico" />
</head>

<!-- BEGIN BODY -->
<body class="page-header-fixed">

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="header-inner">
    <!-- BEGIN LOGO -->  
    <a class="navbar-brand" href="index.html">
    <img src="/assets/img/logo.png" alt="logo" class="img-responsive" />
    </a>
  </div>
</div> <!--header-->


<div class="clearfix"></div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->        
      <?php $this->widget('application.modules.main.widgets.LeftMenuMetro', array('userid' => $this->userid)); ?>
      <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
    
    <!-- BEGIN PAGE -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
          <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
            <?php $this->widget('application.modules.main.widgets.PageTitleMetro', array('userid' => $this->userid)); ?>
            <!-- END PAGE TITLE & BREADCRUMB--> 
          </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="row">
          <?php echo $content;?>
        </div>
    </div>
    <!-- END PAGE -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        2013 &copy; Metronic by keenthemes.
    </div>
    <div class="footer-tools">
        <span class="go-top">
        <i class="fa fa-angle-up"></i>
        </span>
    </div>
</div>
<!-- END FOOTER -->



  <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
  <!-- BEGIN CORE PLUGINS -->   
  <!--[if lt IE 9]>
  <script src="assets/plugins/respond.min.js"></script>
  <script src="assets/plugins/excanvas.min.js"></script> 
  <![endif]-->   
  <script src="/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>   
  <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
  <script src="/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
  <script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
  <script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <script src="/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
  <script src="/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
  <script src="/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
  <!-- END CORE PLUGINS -->

  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <script type="text/javascript" src="/assets/plugins/data-tables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/assets/plugins/data-tables/DT_bootstrap.js"></script><!-- data table -->
  <script type="text/javascript" src="/assets/plugins/select2/select2.min.js"></script>

  <!-- END PAGE LEVEL PLUGINS -->

  <!-- BEGIN PAGE LEVEL SCRIPTS -->
  <script src="/assets/scripts/app.js" type="text/javascript"></script>

  <!-- END PAGE LEVEL SCRIPTS -->  
  <script>
    jQuery(document).ready(function() {    
       App.init(); // initlayout and core plugins
       //Index.init();
       //TableAjax.init();
       /*
       Index.initJQVMAP(); // init index page's custom scripts
       Index.initCalendar(); // init index page's custom scripts
       Index.initCharts(); // init index page's custom scripts
       Index.initChat();
       Index.initMiniCharts();
       Index.initDashboardDaterange();
       Index.initIntro();
       Tasks.initDashboardWidget();
       */
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
</html>
