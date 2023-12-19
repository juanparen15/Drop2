<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<title><?= tittleProducto ?></title>
<!-- <style type="text/css">
  #container {
    height: 400px;
    min-width: 310px;
    max-width: 700px;
    margin: 0 auto;
  }
</style> -->
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <?php require_once 'controllers/usuarioController.php' ?>

  <div class="container">
    <p class="titulo"><?= tittleProducto ?></p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b><?= productoRegistrado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <div class="alert alert-secondary text-primary p-1 text-center animated zoomIn faster" role="alert">
        <b><?= productoEditado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b><?= productoEliminado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'NoQuery') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b><?= imposibleEliminar ?> <i class="fas fa-exclamation-triangle"></i></b>
      </div>
    <?php elseif (isset($_SESSION['notData']) && $_SESSION['notData'] == 'ErrorDatos') : ?>
      <div class="alert alert-danger p-1 text-center animated zoomIn faster" role="alert">
        <?= vacios ?>
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <?php Utils::deleteSession('delete') ?>
    <?php Utils::deleteSession('notData') ?>
    <div class="row my-2">
      <div class="col-md-4 d-flex justify-content-center">
        <div class="card mb-3 border-0">
          <div class="card-header font-italic text-center bg-transparent text-danger">
            <?php $usuarios = UsuarioController::getUAll(); ?>
            <?php $rest = ProductoController::getAll(); ?>
            <?php $restaurant = RestauranteController::getAll(); ?>
            <?php if (isset($editar) && isset($proEdit) && is_object($proEdit)) : ?>
              <span class="titulo text-warning animated flash slower"><?= formTittleProducto2 ?> = <?= $proEdit->idproducto; ?></span>
              <?php $url_action = baseUrl . 'producto/registrar&id=' . $proEdit->idproducto; ?>
            <?php else : ?>
              <span class="titulo text-success"><?= formTittleProducto1 ?></span>
              <?php $url_action = baseUrl . 'producto/registrar'; ?>
            <?php endif; ?>
          </div>
          <div class="card-body">
            <form action="<?= $url_action; ?>" method="POST">
              <div class="form-label-group p-2">
                <label for="usuario"><?= nombreProducto ?></label>
                <?php $usuarios = UsuarioController::getUAll(); ?>
                <?php $rest = ProductoController::getAll(); ?>
                <?php $restaurant = RestauranteController::getAll(); ?>
                <select class="custom-select my-1 mr-sm-2" name="usuario" id="usuario">
                  <option>Elija...</option>
                  <?php while ($users = $usuarios->fetch_object()) : ?>
                    <?php if ($users->nombreRestaurante == $_SESSION['identity']->nombreRestaurante) : ?>
                      <option <?= isset($proEdit) && is_object($proEdit) && (int) $users->idusuarios == (int) $proEdit->usuario_idusuarios ? 'selected' : ''; ?> value="<?= $users->idusuarios; ?>">
                        <?= $users->nombre . ' ' . $users->apellido; ?>
                      </option>
                    <?php endif; ?>
                  <?php endwhile; ?>
                </select>
              </div>

              <?php if (isset($editar) && isset($proEdit) && is_object($proEdit)) : ?>
                <div class="form-label-group p-2">
                  <label for="precioTotal"><?= precioProductoTotal ?></label>
                  <input disabled type="number" id="precioTotal" name="precioTotal" class="form-control" value="<?= isset($proEdit) && is_object($proEdit) ? $proEdit->precioProductoTotal : ''; ?>">
                </div>
                <div class="form-label-group p-2">
                  <label for="precio"><?= deudaRestante ?></label>
                  <input disabled type="number" id="precio" name="precio" class="form-control" value="<?= isset($proEdit) && is_object($proEdit) ? $proEdit->precioProducto : ''; ?>">
                </div>
              <?php else : ?>
                <div class="form-label-group p-2">
                  <label for="precio"><?= precioProducto ?></label>
                  <input type="number" id="precio" name="precio" class="form-control" value="<?= isset($proEdit) && is_object($proEdit) ? $proEdit->precioProducto : ''; ?>">
                </div>
              <?php endif; ?>

              <div class="form-label-group p-2">
                <label for="meses"><?= mesesProducto ?></label>
                <input type="number" id="meses" name="meses" class="form-control" value="<?= isset($proEdit) && is_object($proEdit) ? $proEdit->numeroMeses : ''; ?>">
              </div>

              <div class="form-label-group p-2">
                <span class=""><?= selectInteres; ?> <i class="fas fa-porcent"></i></span><br>
                <?php $intereses = ProductoController::getIAll(); ?>
                <select class="custom-select my-1 mr-sm-2" name="interes" id="interes">
                  <!-- <option>Elija...</option> -->
                  <?php while ($inter = $intereses->fetch_object()) : ?>
                    <option <?= isset($proEdit) && is_object($proEdit) && (int) $inter->id == (int) $proEdit->interes_id ? 'selected' : ''; ?> value="<?= $inter->id; ?>">
                      <?= $inter->interes; ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="form-label-group p-2">
                <span class=""><?= selectRestaurante; ?> <i class="fas fa-user"></i></span><br>
                <?php $restaurants = RestauranteController::getAll(); ?>
                <select class="custom-select my-1 mr-sm-2" name="restaurante" id="restaurante">
                  <!-- <option>Elija...</option> -->
                  <?php while ($rest = $restaurants->fetch_object()) : ?>
                    <?php if ($rest->idrestaurante == $_SESSION['identity']->idrestaurante) : ?>
                      <option <?= isset($proEdit) && is_object($proEdit) && (int) $rest->idrestaurante == (int) $proEdit->restaurante_idrestaurante ? 'selected' : ''; ?> value="<?= $rest->idrestaurante; ?>">
                        <?= $rest->nombreRestaurante; ?></option>
                    <?php endif; ?>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="p-2 border-top">
                <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= isset($proEdit) && is_object($proEdit) ? actualizar : registrar; ?>">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-responsive-md table-hover" id="tabla">
          <caption class="text-center"><?= tittleTableProducto ?></caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col">ID</th>
              <th scope="col"><?= nombreProducto ?></th>
              <th scope="col"><?= precio ?></th>
              <th scope="col"><?= deuda ?></th>
              <th scope="col"><?= numeroMeses ?></th>
              <th scope="col"><?= interes ?></th>
              <th scope="col"><?= fecha ?></th>
              <th scope="col"><?= acciones ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $u = UsuarioController::getUAll(); ?>
            <?php $p = ProductoController::getAll(); ?>

            <?php while ($pro = $p->fetch_object()) : ?>
              <?php if ($pro->nombreRestaurante == $_SESSION['identity']->nombreRestaurante) : ?>
                <tr>
                  <th scope="row"><?= $pro->idproducto; ?></th>
                  <td><?= $pro->nombre; ?> <?= $pro->apellido; ?></td>
                  <td><?= $pro->precioProductoTotal; ?></td>
                  <td><?= $pro->precioProducto; ?></td>
                  <td><?= $pro->numeroMeses; ?></td>
                  <td><?= $pro->interes; ?></td>
                  <td><?= $pro->created_at; ?></td>
                  <td class="d-flex justify-content-around border border-light">
                    <a href="<?= baseUrl; ?>producto/editar&id=<?= $pro->idproducto; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen-nib"></i> <?= editar ?></a>
                    <a href="<?= baseUrl; ?>producto/eliminar&id=<?= $pro->idproducto; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> <?= eliminar ?></a>
                  </td>
                </tr>
              <?php endif; ?>
            <?php endwhile; ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>
  <script src="<?= baseUrl; ?>assets/js/validarProducto.js"></script>

</body>

</html>