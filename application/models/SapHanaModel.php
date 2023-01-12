<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SapHanaModel extends CI_Model
{

    public $bd = 'SBO_DELMOR';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function open_DataBase_odbcSAP()
    {
        $conn = odbc_connect("HANAPHP", "DELMOR", "CazeheKuS2th", SQL_CUR_USE_ODBC);
        if (!$conn) {
            echo '<div class="row errorConexion white-text center">
                    ¡ERROR DE CONEXION CON EL SERVIDOR!
                </div>';
        } else {
            return $conn;
        }
    }
    // echo @odbc_errormsg($conn);

    public function mostrarProveedoresSAP($search)
    {
        $qfilter = "";
        if (isset($search)) {
            $qfilter = 'AND (
							LOWER("CardCode") LIKE ' . "'%" . $search . "%'" . ' OR
                              LOWER("CardName") LIKE ' . "'%" . $search . "%'" . ' OR
                              "CardName" LIKE ' . "'%" . $search . "%'" . '
                            )';
        }

        $conn  = $this->open_DataBase_odbcSAP();
        $query = 'SELECT "CardCode", "CardName" FROM ' . $this->bd . '.OCRD
				  WHERE "CardCode" LIKE  ' . "'%PL%'" . '

				  ' . $qfilter . '
				  ORDER BY "CardCode"
				  LIMIT 30';

        $resultado = @odbc_exec($conn, $query);
        $json      = array();
        $i         = 0;
        while ($fila = @odbc_fetch_array($resultado)) {
            $json[$i]["CardCode"] = $fila["CardCode"];
            $json[$i]["CardName"] = utf8_encode($fila["CardName"]);
            $i++;
        }

        echo json_encode($json);
        echo @odbc_error($conn);

    }

    public function mostrarProveedoresSAPCH($search)
    {
        $qfilter = "";
        if (isset($search)) {
            $qfilter = 'AND (
							  LOWER("CardCode") LIKE ' . "'%" . $search . "%'" . ' OR
                              LOWER("CardName") LIKE ' . "'%" . $search . "%'" . ' OR
                              "CardNameHANA" LIKE ' . "'%" . $search . "%'" . '
                            )';
        }

        $conn  = $this->open_DataBase_odbcSAP();
        $query = 'SELECT "CardCode", "CardName" FROM ' . $this->bd . '.OCRD
				  WHERE ("CardCode" LIKE  ' . "'%PL%'" . '
				  OR "CardCode" LIKE ' . "'%CH00007%'" . ')
				  ' . $qfilter . '
				  ORDER BY "CardCode"
				  LIMIT 30';

        $resultado = @odbc_exec($conn, $query);
        $json      = array();
        $i         = 0;
        while ($fila = @odbc_fetch_array($resultado)) {
            $json[$i]["CardCode"] = $fila["CardCode"];
            $json[$i]["CardName"] = utf8_encode($fila["CardName"]);
            $i++;
        }

        echo json_encode($json);
        echo @odbc_error($conn);

    }

    public function mostrarImpSAP($search)
    {
        $qfilter = "";
        if (isset($search)) {
            $qfilter = 'WHERE LOWER("Code") LIKE ' . "'%" . $search . "%'" . ' OR
                              "Code" LIKE ' . "'%" . $search . "%'" . '  ';
        }

        $conn  = $this->open_DataBase_odbcSAP();
        $query = 'SELECT "Code","Rate" FROM ' . $this->bd . '.OSTC
				  ' . $qfilter . '
				  ORDER BY "Code"';

        $resultado = @odbc_exec($conn, $query);
        $json      = array();
        $i         = 0;
        while ($fila = @odbc_fetch_array($resultado)) {
            $json[$i]["Code"] = strval($fila["Code"]);
            $json[$i]["Rate"] = number_format($fila["Rate"], 2);
            $i++;
        }

        echo json_encode($json);
        //echo @odbc_error($conn);

    }

    /*public function mostrarProductosSAP($search){
$qfilter = "";
if(isset($search)){
$qfilter = 'AND ( "ItemCode" LIKE ' . "'%" . $search . "%'" . '
OR "ItemName" LIKE ' . "'%" . $search . "%'" . '
OR LOWER("ItemName") LIKE ' . "'%" . $search . "%'" . ') ';
}

$conn = $this->open_DataBase_odbcSAP();
$query = 'SELECT "ItemCode", "ItemName" FROM ' . $this->bd . '.OITM
where "FrgnName" like ' . "'%MP%'" . '
and "ItmsGrpCod" = ' . "'104'" . '
' . $qfilter . '
LIMIT 10';

$resultado = @odbc_exec($conn, $query);
$json = array();
$i = 0;
while($fila = @odbc_fetch_array($resultado)){
$json[$i]["ItemCode"] = $fila["ItemCode"];
$json[$i]["ItemName"] = utf8_encode($fila["ItemName"]);
$i++;
}

echo json_encode($json);
//echo @odbc_error($conn);

}*/

}

/* End of file SAPHana_model.php */
