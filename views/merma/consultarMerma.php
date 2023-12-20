<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<style type="text/css">
  #container {
    height: 400px;
    min-width: 310px;
    max-width: 800px;
    margin: 0 auto;
  }
</style>
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo"><?= tittleMerma ?></p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b><?= mermaRegistrado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <div class="alert alert-secondary text-primary p-1 text-center animated zoomIn faster" role="alert">
        <b><?= mermaEditado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b><?= mermaEliminado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <?php Utils::deleteSession('delete') ?>
    <a href="<?= baseUrl; ?>merma/registro" class="btn btn-outline-success"><i class="fas fa-plus"></i> <?= regisNuevaMerma ?></a>
    <div class="mt-3 p-2">
      <table class="table table-bordered table-responsive-lg table-hover" id="tabla">
        <caption class="text-center py-1"><?= tittleTableMerma ?> <a href="<?= baseUrl; ?>merma/pdf" target="blank" class="btn btn-danger"><?= generarPDF ?> <i class="fas fa-file-pdf"></i></a></caption>
        <thead class="table-dark">
          <tr class="font-italic">
            <!-- <th scope="col">ID</th> -->
            <th scope="col"><?= selectNombreDeudor ?></th>
            <!-- <th scope="col"><?= precio ?></th> -->
            <th scope="col"><?= tipoMerma ?></th>
            <th scope="col"><?= precioProductoTotal ?></th>
            <!-- <th scope="col"><?= precioProducto ?></th> -->
            <th scope="col"><?= cantidad ?></th>
            <th scope="col"><?= perdida ?></th>
            <th scope="col"><?= fechaMerma ?></th>
            <!-- <th scope="col"><?= acciones ?></th> -->
          </tr>
        </thead>
        <tbody>
          <?php $mer = MermaController::getAll(); ?>
          <?php $proController = new ProductoController(); ?>
          <?php $tipoController = new TipoMermaController(); ?>


          <?php while ($merma = $mer->fetch_object()) : ?>
            <?php if ($merma->restaurante_idrestaurante == $_SESSION['identity']->idrestaurante) : ?>
              <tr>
                <!-- <td><?= $merma->idmerma; ?></td> -->
                <?php
                // Buscar el producto correspondiente al ID de producto en la merma actual
                $producto = $proController->findProductoID($merma->producto_idproducto); // Utiliza el método findProductoID
                ?>
                <td><?= $producto->nombre; ?> <?= $producto->apellido; ?></td>
                <!-- <td>$ <?= $producto->precioProducto; ?></td> -->
                <?php
                // Buscar el tipo de merma correspondiente al ID de tipo de merma en la merma actual
                $tipoMerma = $tipoController->findTipoMermaId($merma->tipoMerma_idtipoMerma);
                ?>
                <td><?= $tipoMerma->tipoMerma; ?></td>
                <td><?= $producto->precioProductoTotal; ?></td>
                <!-- <td><?= $producto->precioProducto; ?></td> -->
                <td>$ <?= $merma->cantidadMerma; ?></td>
                <td>$ <?= $merma->perdida; ?></td>
                <td><?= $merma->created_at; ?></td>
                <!-- <td class="d-flex justify-content-around d-flex"> -->
                <!-- <a href="<?= baseUrl; ?>merma/editar&id=<?= $merma->idmerma; ?>" class="btn btn-warning btn-sm"><?= editar ?> <i class="fas fa-pencil-alt"></i></a> -->
                <!-- <a href="<?= baseUrl; ?>merma/eliminar&id=<?= $merma->idmerma; ?>" class="btn btn-outline-danger btn-sm"><?= eliminar ?> <i class="far fa-trash-alt"></i></a> -->
                </td>
              </tr>
            <?php endif; ?>

          <?php endwhile; ?>

        </tbody>
      </table>
    </div>
    <hr>
    <div id="container" style="height: 400px" class="my-3"></div>
  </div>

  <!-- GRAFICA -->
  <script type="text/javascript">
    $(function() {
      $('#container').highcharts({
        chart: {
          type: 'column',
          margin: 75,
          options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
          }
        },
        title: {
          text: 'Pago Registrado'
        },
        plotOptions: {
          column: {
            depth: 20,
          },
        },
        xAxis: {
          categories: [
            <?php
            foreach ($merma as $m) {
            ?>

              ['<?php echo $m['nombre']; ?>', '<?php echo $m['apellido ']; ?>'],

            <?php
            }
            ?>
          ]
        },
        yAxis: {
          title: {
            text: 'Cantidad'
          }
        },
        series: [{
          name: 'Productos',
          data: [
            <?php
            foreach ($merma as $m) {
            ?>

              [<?= $m['cantidadMerma'] ?>],

            <?php
            }
            ?>
          ]
        }]
      });
    });
  </script>
  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts-3d.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/modules/exporting.js"></script>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>

</body>

</html>