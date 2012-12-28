<?php
require_once 'index.php';
/*
 * Ejemplo de uso de DPA con limite de 5 por defecto
 */

$aData = array('limit' => 5, 'offset' => 0);
?>
<h1>DPA, División Político Administrativo</h1>
<ul>
    <h2>Regiones</h2>
    <?php
    $objDPA = new DPA();
    $aRegiones = $objDPA->Regiones($aData);
    foreach ($aRegiones as $r):
        echo '<li>' . $r->nombre . '<br />';
        
        $aData['codigo'] = $r->codigo;
        $region = $objDPA->Region($aData);
        echo 'lat:' . $region->lat . ' long:' . $region->lng . '<br />';

        $aProvincias = $objDPA->RegionProvincias($aData);
        echo (count($aProvincias)) ? '<h2>Provincias</h2>' : '';
        echo '<ul>';
        foreach ($aProvincias as $p) :
            echo '<li>';
            echo $p->nombre . '<br />';
            $aData['codigo'] = $p->codigo;
            $aData['limit'] = 10;
            $aComunas = $objDPA->ProvinciaComunas($aData);
            echo (count($aProvincias)) ? '<h2>Comunas</h2>' : '';
            echo '<ul>';
            foreach ($aComunas as $c):
                echo '<li>' . $c->nombre . '</li>';
            endforeach;
            echo '</ul>';
            echo '</li>';
        endforeach;
        echo '</ul>';
        echo '</li>';
    endforeach;
    ?>
</ul>
