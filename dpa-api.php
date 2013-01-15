<?php
/*
 * División Político Administrativa
 * Está Clase te permitirá obtener la División Político Administrativa de Chile.
 * http://apis.modernizacion.cl/dpa/
 * 
 * José Damián Garrido Muñoz (@jgarrido)
 * GitHub https://github.com/jdgarrido/
 * Copyleft http://creativecommons.org/licenses/by-nc-sa/3.0/deed.es_CL
 */

class DPA {

    public static $baseUri = 'http://apis.modernizacion.cl/dpa/';

    private function Options($aData) {
        $url_options = '';
        if (count($aData)) {
            $url_options = '?';
            if ($aData['limit'])
                $url_options .= 'limit=' . $aData['limit'];
            if ($aData['offset'])
                $url_options .= '&offset=' . $aData['offset'];
            if ($aData['geolocation']==TRUE) {
                $separador = strlen($url_options) ? '&' : '';
                $url_options .= $separador.'geolocation=' . $aData['geolocation'];
            }
            if ($aData['callback']) {
                $separador = strlen($url_options) ? '&' : '';
                $url_options .= $separador.'callback=' . $aData['callback'];
            }
        }

        return $url_options;
    }

    /*
     * Listado de las regiones
     */

    public function Regiones($aData = array()) {
        $url_options = self::Options($aData);

        $json_regiones = json_decode(file_get_contents(self::$baseUri . 'regiones' . $url_options));

        return $json_regiones;
    }

    /*
     * Representación de una única Región
     */

    public function Region($aData = array()) {
        $url_options = self::Options($aData);

        $json_region = json_decode(file_get_contents(self::$baseUri . 'regiones/' . $aData['codigo'] . $url_options));

        return $json_region;
    }

    /*
     * Listado de las Provincias
     */

    public function Provincias($aData = array()) {
        $url_options = self::Options($aData);

        $json_provincias = json_decode(file_get_contents(self::$baseUri . 'provincias' . $url_options));

        return $json_provincias;
    }

    /*
     * Representación de una única Provincia
     */

    public function Provincia($aData = array()) {
        $url_options = self::Options($aData);

        $json_region = json_decode(file_get_contents(self::$baseUri . 'provincias/' . $codigo . $url_options));

        return $json_region;
    }

    /*
     * Listado de las Provincias pertenecientes a una Región
     */

    public function RegionProvincias($aData = array()) {
        $url_options = self::Options($aData);

        $json_region_provincias = json_decode(file_get_contents(self::$baseUri . 'regiones/' . $aData['codigo'] . '/provincias' . $url_options));

        return $json_region_provincias;
    }

    /*
     * Representación de una única Provincia perteneciente a una Región
     */

    public function RegionProvincia($aData = array()) {
        $url_options = self::Options($aData);

        $json_region_provincia = json_decode(file_get_contents(self::$baseUri . 'regiones/' . $aData['region'] . '/provincias/' . $aData['provincia'] . $url_options));

        return $json_region_provincia;
    }

    /*
     * Listado de las Comunas
     */

    public function Comunas($aData = array()) {
        $url_options = self::Options($aData);

        $json_comunas = json_decode(file_get_contents(self::$baseUri . 'comunas' . $url_options));

        return $json_comunas;
    }

    /*
     * Representación de una única Comuna
     */

    public function Comuna($aData = array()) {
        $url_options = self::Options($aData);

        $json_comuna = json_decode(file_get_contents(self::$baseUri . 'comunas/' . $aData['codigo'] . $url_options));

        return $json_comuna;
    }

    /*
     * Listado de las Comunas pertenecientes a una Provincia
     */

    public function ProvinciaComunas($aData) {
        $url_options = self::Options($aData);

        $json_provincia_comunas = json_decode(file_get_contents(self::$baseUri . 'provincias/' . $aData['codigo'] . '/comunas' . $url_options));

        return $json_provincia_comunas;
    }

    /*
     * Representación de una única Comuna perteneciente a una Provincia
     */

    public function ProvinciaComuna($aData = array()) {
        $url_options = self::Options($aData);

        $json_provincia_comuna = json_decode(file_get_contents(self::$baseUri . 'provincias/' . $aData['provincia'] . '/comunas/' . $aData['comuna'] . $url_options));

        return $json_provincia_comuna;
    }

    /*
     * Listado de las Comunas pertenecientes a una Región
     */

    public function RegionComunas($aData = array()) {
        $url_options = self::Options($aData);

        $json_region_comunas = json_decode(file_get_contents(self::$baseUri . 'regiones/' . $aData['codigo'] . '/comunas' . $url_options));

        return $json_region_comunas;
    }

    /*
     * Representación de una única Comuna perteneciente a una Región
     */

    public function RegionComuna($aData) {
        $url_options = self::Options($aData);

        $json_region_comuna = json_decode(file_get_contents(self::$baseUri . 'regiones/' . $aData['region'] . '/comunas/' . $aData['comuna'] . $url_options));

        return $json_region_comuna;
    }

    /*
     * Listado de las Comunas pertenecientes a una Provincia que a su vez pertenece a una Región
     */

    public function RegionProvinciaComunas($aData = array()) {
        $url_options = self::Options($aData);

        $json_region_provincia_comunas = json_decode(file_get_contents(self::$baseUri . 'regiones/' . $aData['region'] . '/provincias/' . $aData['provincia'] . '/comunas' . $url_options));

        return $json_region_provincia_comunas;
    }

    /*
     * Representación de una única Comuna perteneciente a una Provincia que a su vez pertenece a una Región
     */

    public function RegionProvinciaComuna($aData = array()) {
        $url_options = self::Options($aData);

        $json_region_provincia_comuna = json_decode(file_get_contents(self::$baseUri . 'regiones/' . $aData['region'] . '/provincias/' . $aData['provincia'] . '/comunas/' . $aData['comuna'] . $url_options));

        return $json_region_provincia_comuna;
    }

}

?>