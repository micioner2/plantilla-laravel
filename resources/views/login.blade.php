<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ingreso al Sistema</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/Ionicons/css/ionicons.min.css")}}">


    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/AdminLTE.min.css")}}">

    <link rel="stylesheet" href="{{asset("assets/css/login.css")}}">

</head>

<body class="hold-transition login-page">
    <div id="app">
        <div class="login-box">
           
            <div class="login-logo">
                <a href="#"><b>Control</b> Inicial</a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Ingreso al sistema</p>

                <form action="login" method="post">
                    {{ csrf_field() }}

                    <div class="form-group has-feedback">
                        <input type="text" v-model="login.usuario" class="form-control" placeholder="Digite su documento" >
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" v-model="login.clave" class="form-control" placeholder="Digite su documento">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="row">

                        <div class="col-xs-12">
                            <button @click="iniciarSesion()" type="button" class="btn btn-info btn-block btn-flat ">Ingresar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="application/javascript" src="{{asset("assets/js/app.js")}}"></script>
    <script src="{{asset("assets/js/plantilla.js")}}"></script>

</body>

</html>
