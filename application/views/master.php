<!DOCTYPE html>
<html lang="en" ng-app="app">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Multi Purpose Tool</title>

    <!-- Bootstrap -->
    <link href="<?= URL::base() ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL::base() ?>assets/css/blog.css" rel="stylesheet">
    <link href="<?= URL::base() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= URL::base() ?>assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="<?= URL::base() ?>assets/css/jquery-ui.theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL::base() ?>bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <base href="<?= URL::base() ?>">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body ng-controller="globalCtrl" ng-cloak>
  <div class="blog-masthead">
  <div class="container">
    <nav class="blog-nav">
      <a class="blog-nav-item brand" href="/">Multi Purpose Tool</a>
      <a class="blog-nav-item" href="/" data-menu="ongkir">Ongkir</a>
      <a class="blog-nav-item" href="/twitter" data-menu="twitter">Twitter</a>
      <a class="blog-nav-item" href="/flight" data-menu="flight">Penerbangan</a>
      <a class="blog-nav-item" href="/flight/add" data-menu="add_flight">++Penerbangan</a>
      <a class="blog-nav-item" href="#">About</a>
    </nav>
  </div>
</div>
<div class="container" id="main">
  <?= $content ?>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= URL::base() ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?= URL::base() ?>bower_components/moment/min/moment.min.js"></script>
    <script src="<?= URL::base() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= URL::base() ?>bower_components/angular/angular.min.js"></script>
    <script type="text/javascript" src="<?= URL::base() ?>bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?= URL::base() ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?= URL::base() ?>assets/js/app.js"></script>
    <script src="<?= URL::base() ?>assets/js/script.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
  </body>
</html>