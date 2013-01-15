<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'dpa-api.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="assets/chosen/chosen.css" />
    </head>
    <body>
        <div>
            <select data-placeholder="Selecciona una comuna" style="width:350px;" class="chzn-select" tabindex="-1">
                <option value=""></option>
                <?php
                $objDPA = new DPA();
                $aRegiones = $objDPA->Regiones($aData);
                foreach ($aRegiones as $r):
                    $aData['codigo'] = $r->codigo;
                    $aProvincias = $objDPA->RegionProvincias($aData);
                    foreach ($aProvincias as $p) :
                        echo (count($aProvincias)) ? '<optgroup label="' . $r->nombre . ' - ' . $p->nombre . '">'."\n\r" : '';
                        $aData['codigo'] = $p->codigo;
                        $aData['limit'] = 10;
                        $aComunas = $objDPA->ProvinciaComunas($aData);
                        foreach ($aComunas as $c):
                            echo '<option>' . $c->nombre . '</option>'."\n\r";
                        endforeach;
                        echo '</optgroup>'."\n\r";
                    endforeach;
                endforeach;
                ?>
            </select>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
        <script src="assets/chosen/chosen.jquery.js" type="text/javascript"></script>
        <script type="text/javascript"> 
            $(".chzn-select").chosen(); 
            $(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
        </script>
    </body>
</html>

