<!doctype html>
<html lang="en" ng-app="greedygames">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Test App</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ng-tags-input/3.0.0/ng-tags-input.bootstrap.min.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="css/style.css" media="screen" title="no title" charset="utf-8">
</head>

<body ng-controller="AppCtrl" ng-cloak>
  <!-- Fixed navbar -->
    <div class="navbar navbar-fixed-top" role="navigation">
      <div class="container-fluid margin-right-15">
        <div class="collapse navbar-collapse" id="nav-main-menu">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('/') }}">Music Tracks</a></li>
                <li><a href="{{ URL::to('/') }}/trackgenre">Track's Genres</a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mainview-animation" ng-view></div>
        </div>
    </div>

  <!-- SCRIPTS -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular-animate.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.4/ui-bootstrap-tpls.js" charset="utf-8"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular-route.min.js" charset="utf-8"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular-sanitize.min.js" charset="utf-8"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js" charset="utf-8"></script>

  <!-- Custom Scripts -->
  <!-- controllers -->
  <script src="scripts/app.js" charset="utf-8"></script>
  <script src="scripts/controllers/AppController.js" charset="utf-8"></script>

   <!-- services -->
   <script src="scripts/services/appService.js" charset="utf-8"></script>

  <script type="text/javascript">
    window.baseurl = "{{ URL::to('/') }}";
  </script>
</body>
</html>
