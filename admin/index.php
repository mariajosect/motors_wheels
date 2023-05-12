<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Motors Wheels</title>
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="dist/icons/themify-icons/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="dist/css/app.min.css" type="text/css">
</head>

<body class="auth">
    <div class="preloader">
        <div class="preloader-icon"></div>
    </div>
    <div class="form-wrapper">
        <div class="container">
            <div class="card">
                <div class="row g-0">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="d-block d-lg-none text-center text-lg-start">
                                    <img width="120" src="https://vetra.laborasyon.com/assets/images/logo.svg" alt="logo">
                                </div>
                                <div class="my-5 text-center text-lg-start">
                                    <h1 class="display-8">Iniciar Sesión</h1>
                                </div>
                                <form class="mb-5" id="formulario_inicio">
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Correo" name="email" required id="email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Contraseña" name="password" required id="password" autocomplete="on">
                                    </div>
                                    <div class="text-center text-lg-start">
                                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                    </div>
                                    <br>
                                    <div id="mensaje">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
                        <div class="logo">
                            <img width="120" src="https://vetra.laborasyon.com/assets/images/logo.svg" alt="logo">
                        </div>
                        <div>
                            <h3 class="fw-bold">Bienvenido a Motors Wheels!</h3>
                            <p class="lead my-5">¿Listo para tu nueva moto o carro?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="usuarios/scripts/index.js"></script>
    <script src="libs/bundle.js"></script>
    <script src="dist/js/app.min.js"></script>
</body>

</html>