<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"  ng-app="app">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template</title>
    <link href="<?= URL::base() ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL::base() ?>assets/css/blog.css" rel="stylesheet">
    <link href="<?= URL::base() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= URL::base() ?>assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="<?= URL::base() ?>assets/css/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="<?= URL::base() ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL::base() ?>bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <base href="<?= URL::base() ?>">
      <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body  ng-controller="globalCtrl" ng-cloak>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a  class="navbar-brand" href="index.html">DesignBootstrap 

                </a>
            </div>

            <div class="notifications-wrapper">
<ul class="nav">
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                                <li>
                                    <a href="#">
                                        <div>
                                            <p>
                                                <strong>Task 1</strong>
                                                <span class="pull-right text-muted">60% Complete</span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                    <span class="sr-only">60% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <div>
                                            <p>
                                                <strong>Task 2</strong>
                                                <span class="pull-right text-muted">30% Complete</span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                                    <span class="sr-only">30% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <div>
                                            <p>
                                                <strong>Task 3</strong>
                                                <span class="pull-right text-muted">80% Complete</span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                    <span class="sr-only">80% Complete (warning)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <div>
                                            <p>
                                                <strong>Task 4</strong>
                                                <span class="pull-right text-muted">90% Complete</span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                                    <span class="sr-only">90% Complete (success)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a class="text-center" href="#">
                                        <strong>See Tasks List + </strong>
                                    </a>
                                </li>
                            </ul>
                </li>
              
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user-plus"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user-plus"></i> My Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/login/logout"><i class="fa fa-sign-out"></i> Logout</a>

                        </li>
                    </ul>
                </li>
            </ul>
               
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav  class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="assets/img/user.jpg" class="img-circle" />
                        </div>

                    </li>
                    <li>
                        <a  href="#"> <strong>  <?= Auth::instance()->get_user()->username ?> </strong></a>
                    </li>

                    <li data-menu="dashboard">
                        <a  href="/"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <li data-menu="twitter">
                        <a class="blog-nav-item" href="/twitter" data-menu="twitter">Twitter</a>
                    </li>
                    
                    <li data-menu="flight">
                        <a class="blog-nav-item" href="/flight" data-menu="flight"><i class="fa fa-plane"></i> Penerbangan</a>
                    </li>
                   
                     
                     <li data-menu="add_flight">
                        <a class="blog-nav-item" href="/flight/add" data-menu="add_flight"><i class="fa fa-plane"></i> ++Penerbangan</a>
                    </li>
                   
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i>Multilevel Link <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="#"><i class="fa fa-cogs "></i>Second  Link</a>
                            </li>
                             <li>
                                <a href="#"><i class="fa fa-bullhorn "></i>Second Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third  Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blank.html"><i class="fa fa-dashcube "></i>Blank Page</a>
                    </li>
                   
                </ul>
            </div>

        </nav>
        <!-- /. SIDEBAR MENU (navbar-side) -->
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                  <?= $content ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
        </div>
    <!-- /. WRAPPER  -->
    <footer >
        &copy; 2015 YourCompany | By : <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap</a>
    </footer>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="<?= URL::base() ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?= URL::base() ?>bower_components/moment/min/moment.min.js"></script>
    <script src="<?= URL::base() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= URL::base() ?>bower_components/angular/angular.min.js"></script>
    <script type="text/javascript" src="<?= URL::base() ?>bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?= URL::base() ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?= URL::base() ?>assets/js/app.js"></script>
    <script src="<?= URL::base() ?>assets/js/script.js"></script>
    <script src="<?= URL::base() ?>assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="<?= URL::base() ?>assets/js/custom.js"></script>

</body>
</html>
