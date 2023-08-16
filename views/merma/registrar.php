</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container p-3">
    <?php if (isset($editar) && isset($mr) && is_object($mr)) : ?>
      <span class="titulo"><?= tittleRegisMerma2 ?> = <?= $mr->nombreProducto; ?></span>
      <?php $url_action = baseUrl . 'merma/registrar&id=' . $mr->idmerma; ?>
    <?php else : ?>
      <span class="titulo"><?= tittleRegisMerma1 ?></span>
      <?php $url_action = baseUrl . 'merma/registrar'; ?>
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
        <?php if (isset($mr) && is_object($mr)) : ?>
          <div class="col-12">
            <?= cantidadActualMerma ?> <b class="text-danger"> <?= $mr->cantidadMerma ?> </b>
          </div>
        <?php else : ?>
          <div class="col-6 py-2 mt-1">
            <span><?= selectProducto ?> <i class="fas fa-user"></i></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="producto" id="producto">
              <?php $usuarios = UsuarioController::getUAll(); ?>
              <?php $ptos = ProductoController::getAll(); ?>
              <?php $restaurant = RestauranteController::getAll(); ?>
              <option><?= elija ?></option>
              <?php while ($p = $ptos->fetch_object()) : ?>
                <?php if ($p->nombreRestaurante == $_SESSION['identity']->nombreRestaurante) : ?>
                  <option <?= isset($mr) && is_object($mr) && (int) $p->idusuarios == (int) $mr->usuario_idusuarios ? 'selected' : ''; ?> value="<?= $p->idusuarios; ?>">
                    <?= $p->nombre . ' ' . $p->apellido; ?>
                  <?php endif; ?>
                <?php endwhile; ?>
            </select>
          </div>
        <?php endif; ?>


        <div class="form-label-group col-6 py-2">
          <label for="cantidad"><?= isset($mr) && is_object($mr) ? addMerma : cantidad; ?></label>
          <input type="number" id="cantidad" name="cantidad" class="form-control">
        </div>
        <div class="col-6 py-2 mt-1">
          <span><?= tipoMerma ?> <i class="fas fa-carrot"></i></span><br>
          <select class="custom-select mr-sm-2 mt-1" name="tipoMerma" id="tipoMerma">
            <?php $tp = TipoMermaController::getAll(); ?>
            <option><?= elija ?></option>
            <?php while ($t = $tp->fetch_object()) : ?>
              <option <?= isset($mr) && is_object($mr) && (int) $t->tipoMerma_idtipoMerma == (int) $mr->idtipoMerma ? 'selected' : ''; ?> value="<?= $t->idtipoMerma; ?>">
                <?= $t->tipoMerma; ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- //CREAR UN CAMPO DE FECHA PARA SABER LOS DIAS SEMANAS O MESES QUE PAGA-->
       




        <!-- <div class="form-label-group col-6 py-2">
          <label for="motivo"><?= motivo ?> <span class="maxN"></span></label>
          <textarea class="form-control" id="motivo" name="motivo"><?= isset($mr) && is_object($mr) ? $mr->motivoMerma : ''; ?></textarea>
        </div> -->
        <div class="col-6 offset-3 py-2">
          <input type="submit" class="btn btn-outline-primary btn-block" id="enviar" value="<?= isset($mr) && is_object($mr) ? actualizar : registrar; ?>">
        </div>
      </div>
    </form>
  </div>
  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>
  <?php if (!isset($_GET['id'])) : ?>
    <script src="<?= baseUrl; ?>assets/js/validarMerma.js"></script>
  <?php endif; ?>
  <script src="<?= baseUrl; ?>assets/js/validarMermaEdit.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- <script>
    $(document).ready(function() {
      $('#producto').change(function() {
        var selectedProductId = $(this).val();
        var selectedProductPrice = getProductPrice(selectedProductId); // Debes definir esta función para obtener el precio del producto por su ID

        if (selectedProductPrice !== null) {
          $('#precio-correspondiente').text('Precio: ' + selectedProductPrice);
        } else {
          $('#precio-correspondiente').text('');
        }
      });

      function getProductPrice(productId) {
        $getPrecio();
        // Aquí deberías hacer una llamada a tu backend para obtener el precio del producto por su ID
        // y luego retornar ese valor. Por ejemplo:
        // return fetchedPrice;
        return precio; // Cambia esto con la lógica real para obtener el precio
      }
    });
  </script> -->

</body>