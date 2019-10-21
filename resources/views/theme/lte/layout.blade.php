<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet"  href="{{asset("assets/$theme/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet"  href="{{asset("assets/$theme/bower_components/Ionicons/css/ionicons.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet"  href="{{asset("assets/$theme/dist/css/AdminLTE.min.css")}}">

    <link rel="stylesheet"  href="{{asset("assets/$theme/dist/css/skins/_all-skins.min.css")}}">

    <link rel="stylesheet"  href="{{asset("assets/css/custom.css")}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  </head>

  <body class="hold-transition skin-blue fixed sidebar-mini">
    <div id="app">
        <div class="wrapper">
        
                {{-- INICIO HEADER --}}
                    @include("theme/$theme/header")
                {{-- FIN-HEADER --}}

                {{-- ASIDE --}}
                    @include("theme/$theme/aside")
                {{-- FIN-ASIDE --}}

                <div class="content-wrapper">
                    <section class="content">
                        
                      <template v-if="menu==0">
                          <inicio :enlace="enlace"></inicio>
                      </template>


                      <template v-if="menu==1">
                          <pregunta></pregunta>
                      </template>

                      <!-- @yield("contenido") -->

                      </section>
                </div>
                @include("theme/$theme/footer")
            </div>
        </div>

      <!-- jQuery 3 -->
      <script src="{{asset("assets/$theme/bower_components/jquery/dist/jquery.min.js")}}"></script>
      <!-- Intaciar Vue -->
       <script src="{{asset("assets/js/app.js")}}"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="{{asset("assets/$theme/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
      <!-- SlimScroll -->
      <script src="{{asset("assets/$theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
      <!-- FastClick -->
      <script src="{{asset("assets/$theme/bower_components/fastclick/lib/fastclick.js")}}"></script>
      <!-- AdminLTE App -->
      <script src="{{asset("assets/$theme/dist/js/adminlte.min.js")}}"></script>

      
 
  </body>
</html>
