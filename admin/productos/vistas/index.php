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
                        <li class="breadcrumb-item active" aria-current="page">Productos</li>
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
                    <div id="mensaje"></div>
                    <div class="table-responsive">
                        <table class="table table-custom table-lg mb-0" id="products">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="lista-productos">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="Registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registrar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formulario-registrar">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre: *</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre producto" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Categoría: *</label>
                                            <select class="form-select" name="categoria" id="categoria">
                                                <option selected>Seleccione</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Descripción: *</label>
                                            <textarea class="form-control" rows="3" name="descripcion" id="descripcion"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Precio: *</label>
                                            <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio producto" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Precio Promoción: *</label>
                                            <input type="number" class="form-control" name="precio_promocion" id="precio_promocion" placeholder="Precio promoción" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Stock: *</label>
                                            <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Foto: *</label>
                                            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" required autocomplete="off">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formulario_editar">
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="foto_anterior" id="foto_anterior">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre: *</label>
                                            <input type="text" class="form-control" placeholder="Nombre producto" required autocomplete="off" name="nombre" id="nombre">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Categoría: *</label>
                                            <select class="form-select" name="categoria" id="categoria_editar">
                                                <option selected>Seleccione</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Descripción: *</label>
                                            <textarea class="form-control" rows="3" name="descripcion" id="descripcion"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Precio: *</label>
                                            <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio producto" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Precio Promoción: *</label>
                                            <input type="number" class="form-control" name="precio_promocion" id="precio_promocion" placeholder="Precio promoción" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Stock: *</label>
                                            <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Foto: *</label>
                                            <input type="file" class="form-control" placeholder="Foto" autocomplete="off" name="foto" value="foto">
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