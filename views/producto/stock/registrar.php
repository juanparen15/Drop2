</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <?php require_once 'controllers/productoController.php'; ?>

  <div class="container p-3">
    <?php if (isset($editar) && isset($stock) && is_object($stock)) : ?>
      <span class="titulo"><?= tittleRegisStock2 ?> = <?= $stock->idProducto; ?></span>
      <?php $url_action = baseUrl . 'stock/registrar&id=' . $stock->idProducto->nombreProducto; ?>
    <?php else : ?>
      <span class="titulo"><?= tittleRegisStock1 ?></span>
      <?php $url_action = baseUrl . 'stock/registrar'; ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Vacios') : ?>
      <div class="alert alert-danger p-1 text-center animated zoomIn faster" role="alert">
        <?= vacios ?>
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Yuca') : ?>
      <div class="alert alert-secondary p-1 text-center text-danger animated zoomIn faster" role="alert">
        <?= mensajeCantidad ?>
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Existe') : ?>
      <div class="alert alert-secondary p-1 text-center animated zoomIn faster" role="alert">
        <?= existStock ?> <i class="fas fa-layer-group"></i> <a href="<?= baseUrl ?>stock/consultar" class="btn btn-outline-dark btn-sm">Consultar</a>
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <form action="<?= $url_action; ?>" method="POST" class="pb-3" id="miFormulario">
      <div class="row">
        <?php if (isset($stock) && is_object($stock)) : ?>
          <div class="col-12">
            <?= cantidadActualStock ?> <b class="text-danger"> <?= $stock->cantidadProducto ?> </b>
          </div>
        <?php else : ?>
          <div class="col-6 py-2 mt-1">
            <span><?= selectDeudor ?> <i class="fas fa-carrot"></i></span><br>
            <?php $ptos = usuarioController::getUAll(); ?>
            <select class="custom-select mr-sm-2 mt-1" name="usuario" id="usuario">
              <option><?= elija ?></option>
              <?php while ($p = $ptos->fetch_object()) : ?>
            <?php if ($p->nombreRestaurante == $_SESSION['identity']->nombreRestaurante) : ?>
                <option value="<?= $p->idusuarios; ?>"><?= $p->nombre . ' ' . $p->apellido; ?></option>
              <?php endif; ?>
              <?php endwhile; ?>
            </select>
          </div>
        <?php endif; ?>
        <div class="form-label-group col-6 py-2">
          <label for="cantidad"><?= isset($stock) && is_object($stock) ? addStock : cantidad; ?></label>
          <input type="number" id="cantidad" name="cantidad" class="form-control" value="">
        </div>
        <hr>
        <div class="form-label-group col-6 py-2">
          <label for="fecha"><?= fechaVenciProducto ?> </label>
          <input type="date" id="fecha" name="fecha" class="form-control" value="<?= isset($stock) && is_object($stock) ? $stock->fechaVencimiento : ''; ?>">
        </div>
        <div class="form-label-group col-6 py-2">
          <label for="lote"><?= loteStock ?></label>
          <input type="number" id="lote" name="lote" class="form-control" value="<?= isset($stock) && is_object($stock) ? $stock->lote : ''; ?>">
        </div>
        <div class="col-6 offset-3 py-2">
          <input type="submit" class="btn btn-outline-primary btn-block" id="enviar" value="<?= isset($stock) && is_object($stock) ? actualizar : registrar; ?>">
        </div>
      </div>
    </form>
  </div>
  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>
  <?php if (!isset($_GET['id'])) : ?>
    <script src="<?= baseUrl; ?>assets/js/validarStock.js"></script>
  <?php endif; ?>
  <script src="<?= baseUrl; ?>assets/js/validarStockEdit.js"></script>
</body>














