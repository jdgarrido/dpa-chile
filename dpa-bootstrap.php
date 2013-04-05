<?php
require_once 'dpa-api.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>DPA Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row-fluid">
        
        <div class="span8">
          <table class="table table-striped table-hover">
            <caption>División Político Administrativa</caption>
            <thead>
              <tr>
                <th>Nro</th>
                <th>Región</th>
                <th>Provincias</th>
                <th>Comunas</th>
                <th>Mapa</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $objDPA = new DPA();
              
              $aData = array('limit' => 0, 'offset' => 0, 'geolocation' => TRUE, 'callback' => '');

              $aRegiones = $objDPA->Regiones($aData);
              foreach ($aRegiones as $r){
              ?>
              <tr>
                <td><?php echo $r->codigo ?></td>
                <td><?php echo $r->nombre ?></td>
                <td>
                  <ul>
                    <?php
                    $aData['codigo'] = $r->codigo;
                    $aProvincias = $objDPA->RegionProvincias($aData);
                    foreach ($aProvincias as $p) {
                      ?>
                      <li><?php echo $p->nombre ?></li>
                      <?php
                    }
                    ?>
                  </ul>
                </td>
                <td>
                  <ul>
                    <?php
                    $aComunas = $objDPA->RegionComunas($aData);
                    $markers = '';
                    foreach ($aComunas as $c) {
                      ?>
                      <li><?php echo $c->nombre; ?></li>
                      <?php
                      $markers .= '|'.$c->lat.','.$c->lng;
                    }
                    ?>
                  </ul>
                </td>
                <td>
                  <?php
                  $zoom = 7;
                  if($r->codigo == 13)
                    $zoom = 9;
                  ?>
                  <img src="http://maps.googleapis.com/maps/api/staticmap?size=400x400&markers=size:tiny%7Ccolor:blue%7Clabel:C%7C<?php echo $markers ?>&sensor=false" class="img-polaroid visible-desktop">
                </td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>