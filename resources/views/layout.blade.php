<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  @section('css')
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css') }}">
    <!-- Datepicker css -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}" media="screen" title="no title">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('css/general.css') }}" media="screen" title="no title" />
  @show

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('partials/_header')
  @include('partials/_leftside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content" ng-app="app">
      @section('content')
      @show
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  @include('partials/_footer')
  @include('partials/_rightside')
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@section('js')
<!-- jQuery 3.1.0 -->
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/app.min.js') }}"></script>
<!-- Datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Jquery Mask Plugin -->
<script type="text/javascript" src="{{ asset('vendor/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
<!-- Main homemade JS -->
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<!-- Firebase -->
<script src="https://www.gstatic.com/firebasejs/3.4.0/firebase.js"></script>
<!-- Slimscroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- Angular for Firebase -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/angularFire/2.0.2/angularfire.min.js"></script>
<script>
 // Initialize Firebase
 // Comment il se connecte à la base "videos" de firebase
 var config = {
   apiKey: "AIzaSyARyRTdBC1a8PAjdAm5YcmgSi3gkrXOvIk",
   authDomain: "videos-7ddfb.firebaseapp.com",
   databaseURL: "https://videos-7ddfb.firebaseio.com",
   storageBucket: "videos-7ddfb.appspot.com",
   messagingSenderId: "920426966939"
 };
 firebase.initializeApp(config);
</script>
@show
</body>
</html>
