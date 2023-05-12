<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Motors Wheels </title>
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css" type="text/css">
    <link rel="stylesheet" href="../../dist/css/bootstrap-docs.css" type="text/css">
    <link rel="stylesheet" href="../../libs/slick/slick.css" type="text/css">
    <link rel="stylesheet" href="../../dist/css/app.min.css" type="text/css">
</head>

<body>
    <div class="preloader">
        <img src="https://vetra.laborasyon.com/assets/images/logo.svg" alt="logo">
        <div class="preloader-icon"></div>
    </div>
    <?php require_once('../../configuracion/Menu.php') ?>
    <div class="layout-wrapper">
        <div class="header">
            <div class="menu-toggle-btn">
                <a href="#">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <div class="page-title">Motors Wheels</div>
        </div>
        
        <div class="content">
            <div class="mb-4">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <i class="bi bi-globe2 small me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Categorías</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Buscar" required autocomplete="off" id="buscar">
                                </div>
                                <div class="col-sm-6 d-grid gap-2">
                                    <button data-bs-toggle="modal" data-bs-target="#Registrar" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <br>
                        <div id="mensaje"></div>
                        <table class="table table-custom table-lg mb-0">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="lista-categorias">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="Registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registrar Categoría</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formulario-registrar">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre: *</label>
                                            <input type="text" class="form-control" placeholder="Nombre Categoría" name="nombre" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Foto: *</label>
                                            <input type="file" class="form-control" placeholder="Foto" name="foto" required autocomplete="off">
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="Editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Categoría</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formulario-editar">
                                        <input type="hidden" name="id">
                                        <input type="hidden" name="foto_anterior">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre: *</label>
                                            <input type="text" class="form-control" placeholder="Nombre Categoría" name="nombre" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Foto: *</label>
                                            <input type="file" class="form-control" placeholder="Foto" autocomplete="off" name="foto">
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">Editar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../libs/bundle.js"></script>
    <script src="../../libs/charts/apex/apexcharts.min.js"></script>
    <script src="../../libs/slick/slick.min.js"></script>
    <script src="../../dist/js/examples/dashboard.js"></script>
    <script src="../../dist/js/app.min.js"></script>
    <script src="../scripts/index.js"></script>
</body>

</html>