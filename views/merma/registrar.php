</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>



  <div class="container p-3">
    <?php if (isset($editar) && isset($mr) && is_object($mr)) : ?>
      <span class="titulo"><?= tittleRegisMerma2 ?> = <?= $mr->idmerma; ?></span>
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
        <?php if (isset($mr) && is_object($mr)) : (isset($proEdit) && is_object($proEdit)) ?>
          <div class="col-12">
            <?= cantidadActualMerma ?> <b class="text-danger"> <?= $mr->cantidadMerma ?> </b>
          </div>

        <?php else : ?>


          <div class="col-6 py-2 mt-1">
            <span><?= selectProducto ?> <i class="fas fa-user"></i></span><br>
            <select class="form-control" name="producto" id="producto">
              <?php $usuarios = UsuarioController::getUAll(); ?>
              <?php $ptos = ProductoController::getAll(); ?>
              <?php $restaurant = RestauranteController::getAll(); ?>
              <option><?= elija ?></option>
              <?php while ($p = $ptos->fetch_object()) : ?>
                <?php if ($p->nombreRestaurante == $_SESSION['identity']->nombreRestaurante) : ?>
                  <?php if ($p->precioProducto <= '0') : ?>
                    <option hidden <?= isset($mr) && is_object($mr) && (int) $p->idproducto == (int) $mr->producto_idproducto ? 'selected' : ''; ?> value="<?= $p->idproducto; ?>" data-precio="<?= $p->precioProducto; ?>" " data-meses=" <?= $p->numeroMeses; ?>" " data-restaurante=" <?= $p->idrestaurante; ?>">
                      <?= $p->nombre . ' ' . $p->apellido; ?>
                    <?php else : ?>
                    <option <?= isset($mr) && is_object($mr) && (int) $p->idproducto == (int) $mr->producto_idproducto ? 'selected' : ''; ?> value="<?= $p->idproducto; ?>" data-precio="<?= $p->precioProducto; ?>" " data-meses=" <?= $p->numeroMeses; ?>" " data-restaurante=" <?= $p->idrestaurante; ?>">
                      <?= $p->nombre . ' ' . $p->apellido; ?>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endwhile; ?>
            </select>
          </div>

          <div class="col-6 py-2 mt-1">
            <span class=""><?= selectRestaurante; ?> <i class="fas fa-user"></i></span><br>
            <?php $restaurants = RestauranteController::getAll(); ?>
            <select disabled class="form-control" name="restaurante" id="restaurante">
              <!-- <option>Elija...</option> -->
              <?php while ($rest = $restaurants->fetch_object()) : ?>
                <?php if ($rest->idrestaurante == $_SESSION['identity']->idrestaurante) : ?>
                  <option value="<?= $rest->idrestaurante; ?>">
                    <?= $rest->nombreRestaurante; ?></option>
                <?php endif; ?>
              <?php endwhile; ?>
            </select>
          </div>



          <div class="col-6 py-2 mt-1">
            <label for="precio"><?= precioProducto ?></label>
            <input disabled type="number" id="precio" name="precio" class="form-control" value="<?= isset($proEdit) && is_object($proEdit) ? $proEdit->precioProducto : (isset($mr) && is_object($mr) ? $mr->precioProducto : ''); ?>">
          </div>

          <div class="col-6 py-2 mt-1">
            <label for="meses"><?= mesesProducto ?></label>
            <input disabled type="number" id="meses" name="meses" class="form-control" value="<?= isset($proEdit) && is_object($proEdit) ? $proEdit->numeroMeses : (isset($mr) && is_object($mr) ? $mr->numeroMeses : ''); ?>">
          </div>
        <?php endif; ?>


        <div class="form-label-group col-6 py-2">
          <label for="cantidad"><?= isset($mr) && is_object($mr) ? addMerma : cantidad; ?></label>
          <input type="number" id="cantidad" name="cantidad" class="form-control">
        </div>
        <div class="col-6 py-2 mt-1">
          <span><?= tipoMerma ?> <i class="fas fa-carrot"></i></span><br>
          <select class="form-control" name="tipoMerma" id="tipoMerma">
            <?php $tp = TipoMermaController::getAll(); ?>
            <option><?= elija ?></option>
            <?php while ($t = $tp->fetch_object()) : ?>
              <option <?= isset($mr) && is_object($mr) && (int) $t->idtipoMerma == (int) $mr->tipoMerma_idtipoMerma ? 'selected' : ''; ?> value="<?= $t->idtipoMerma; ?>">
                <?= $t->tipoMerma; ?></option>
            <?php endwhile; ?>
          </select>
        </div>

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
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

  <script>
    document.getElementById('producto').onchange = function() {
      /* Referencia al option seleccionado */
      var mOption = this.options[this.selectedIndex];
      /* Referencia a los atributos data de la opción seleccionada */
      var mData = mOption.dataset;

      /* Referencia al campo de precio */
      var precio = document.getElementById('precio');
      var meses = document.getElementById('meses');
      var restaurante = document.getElementById('restaurante');

      /* Asignamos el precio del producto al campo de precio */
      precio.value = mData.precio;
      meses.value = mData.meses;
      restaurante.value = mData.restaurante;
    };
  </script>

</body>