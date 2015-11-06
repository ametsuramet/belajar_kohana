
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
    <section id="menu">
        <div class="container">
            
        <nav class="" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="main-menu">
                    <li class="active"><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                </ul>

            
            </div><!-- /.navbar-collapse -->
        </nav>
        </div>
    </section>
    <?= $content ?>

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