<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Compras_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("America/Managua");
    }

    public function encabezadoOrden($idsolicitud)
    {
        $query = $this->db->query("SELECT * FROM Solicitudes where idsolicitud = '" . $idsolicitud . "' ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    public function getSolicitudesDetOrden($idsolicitud, $start, $length, $search)
    {
        $srch = "";
        if ($search) {
            $srch = "AND (
                      CantidadSolicitud like '%" . $search . "%' OR
                      UnidadMedida like '%" . $search . "%' OR
                      CantidadAut like '%" . $search . "%' OR
                      DescripcionArticulo like '%" . $search . "%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from detalleSolicitud where
                idsolicitud = '" . $idsolicitud . "' AND EstadoAutorizado = 'Y' " . $srch . " ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if ($length == -1) {
            $q = $this->db->query("select t1.IdDetallesSolicitud,t1.IdSolicitud,t1.CantidadSolicitud,t1.UnidadMedida,
            t1.CantidadAut,t1.DescripcionArticulo,t1.EstadoAutorizado,
            isnull(sum(t2.Cantidad),0)+isnull(sum(t4.Cantidad),0)+isnull(SUM(t6.Cantidad),0) as cantidadOrdenada,
            t1.CantidadAut-(isnull(sum(t2.Cantidad),0)+isnull(sum(t4.Cantidad),0)+isnull(SUM(t6.Cantidad),0)) as CantidadDisponible
            from Solicitudes t0
            inner join DetalleSolicitud t1 on t1.IdSolicitud = t0.IdSolicitud
            left join DetalleOrdenPago t2 on t2.IdDetalleSolicitud = t1.IdDetallesSolicitud and (t2.Estado  is null or t2.Estado in ('A','B','P') )
            left join OrdenPago t3 on t2.IdOrdenPago = t3.IdOrdenPago
            left join DetalleOrdenCompra t4 on t4.IdDetalleSolicitud = t1.IdDetallesSolicitud AND (t4.Estado is null or t4.Estado in ('A','B','P'))
            left join OrdenCompra t5 on t4.IdOrdenCompra= t5.IdOrdenCompra
            left join DetalleCajaChica t6 on t6.IdDetalleSolicitud = t1.IdDetallesSolicitud AND (t6.Estado is null or t6.Estado in ('A','B','P'))
            left join CajaChica t7 on t6.IdCajaChica= t7.IdCajaChica
            where t0.IdSolicitud = '" . $idsolicitud . "' AND t1.EstadoAutorizado = 'Y'
            group by t1.IdDetallesSolicitud,t1.IdSolicitud,t1.CantidadSolicitud,t1.UnidadMedida,
            t1.CantidadAut,t1.DescripcionArticulo,t1.EstadoAutorizado
            having t1.CantidadAut-(isnull(sum(t2.Cantidad),0)+isnull(sum(t4.Cantidad),0)+isnull(SUM(t6.Cantidad),0)) <> 0
            ORDER BY t1.IdDetallesSolicitud asc");
        } else {
            $q = $this->db->query("select t1.IdDetallesSolicitud,t1.IdSolicitud,t1.CantidadSolicitud,t1.UnidadMedida,
            t1.CantidadAut,t1.DescripcionArticulo,t1.EstadoAutorizado,
            isnull(sum(t2.Cantidad),0)+isnull(sum(t4.Cantidad),0)+isnull(SUM(t6.Cantidad),0) as cantidadOrdenada,
            t1.CantidadAut-(isnull(sum(t2.Cantidad),0)+isnull(sum(t4.Cantidad),0)+isnull(SUM(t6.Cantidad),0)) as CantidadDisponible
            from Solicitudes t0
            inner join DetalleSolicitud t1 on t1.IdSolicitud = t0.IdSolicitud
            left join DetalleOrdenPago t2 on t2.IdDetalleSolicitud = t1.IdDetallesSolicitud and (t2.Estado  is null or t2.Estado in ('A','B','P') )
            left join OrdenPago t3 on t2.IdOrdenPago = t3.IdOrdenPago
            left join DetalleOrdenCompra t4 on t4.IdDetalleSolicitud = t1.IdDetallesSolicitud AND (t4.Estado is null or t4.Estado in ('A','B','P'))
            left join OrdenCompra t5 on t4.IdOrdenCompra= t5.IdOrdenCompra
            left join DetalleCajaChica t6 on t6.IdDetalleSolicitud = t1.IdDetallesSolicitud AND (t6.Estado is null or t6.Estado in ('A','B','P'))
            left join CajaChica t7 on t6.IdCajaChica= t7.IdCajaChica
            where t0.IdSolicitud = '" . $idsolicitud . "' AND t1.EstadoAutorizado = 'Y'
            group by t1.IdDetallesSolicitud,t1.IdSolicitud,t1.CantidadSolicitud,t1.UnidadMedida,
            t1.CantidadAut,t1.DescripcionArticulo,t1.EstadoAutorizado
            having t1.CantidadAut-(isnull(sum(t2.Cantidad),0)+isnull(sum(t4.Cantidad),0)+isnull(SUM(t6.Cantidad),0)) <> 0
            ORDER BY t1.IdDetallesSolicitud asc
            offset " . $start . " rows fetch next " . $length . " rows only;");
        }

        $retornar = array(
            "numDataTotal" => $qnr,
            "datos"        => $q,
        );
        return $retornar;
    }

    public function SolicAutorizadas($start, $length, $search, $cons, $fecha, $desc, $solic, $area, $priori, $estado, $selec)
    {
        $srch         = "";
        $filter       = "";
        $join         = "";
        $nom          = '';
        $selectFilter = ($selec != "null") ? "AND t1.TipoSolicitud = '" . $selec . "'" : "AND t1.TipoSolicitud in ('C','S')";

        $consFilter   = ($cons != "") ? "AND t1.Consecutivo like '%" . $cons . "%' " . $selectFilter . " " : "";
        $fechaFilter  = ($fecha != "") ? "AND cast(t1.FechaAutoriza as date) like '%" . $fecha . "%' " . $selectFilter . " " : "";
        $descFilter   = ($desc != "") ? "AND t1.DescripcionSolicitud like '%" . $desc . "%' " . $selectFilter . " " : "";
        $solicFilter  = ($solic != "") ? "AND t2.Nombre like '%" . $solic . "%' " . $selectFilter . " " : "";
        $areaFilter   = ($area != "") ? "AND t3.NombreArea like '%" . $area . "%' " . $selectFilter . " " : "";
        $prioriFilter = ($priori != "") ? "AND t1.Prioridad = '" . $priori . "' " . $selectFilter . " " : "";

        if ($search) {
            $srch = "AND (
                      t1.Consecutivo like '%" . $search . "%' OR
                      cast(t1.FechaAutoriza as date) like '%" . $search . "%' OR
                      t1.DescripcionSolicitud like '%" . $search . "%' OR
                      t2.Nombre like '%" . $search . "%' OR
                      t3.NombreArea like '%" . $search . "%' OR
                      t4.Nombre like '%" . $search . "%' OR
                      t7.Nombre like '%" . $search . "%'
                    ) ";
        }

        if ($this->session->userdata("IdRol") == 2) {
            if ($estado == "P" || $estado == "S") {
                $join   = "";
                $filter = "AND t1.IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ";
            } else if ($estado == "R") {
                $join   = "INNER JOIN solicRechazadas t5 on t1.IdSolicitud = t5.idSolicitud";
                $filter = "AND t5.idUsuarioRechaza = '" . $this->session->userdata("id") . "' ";
            } else {
                $join   = "";
                $filter = "";
            }

            $qnr = "select count(1) as Cantidad FROM dbo.Solicitudes AS t1
                INNER JOIN dbo.Usuarios AS t2 ON t1.IdUsuario = t2.IdUsuario
                INNER JOIN dbo.Areas AS t3 ON t1.IdArea = t3.IdArea
                LEFT JOIN dbo.Usuarios AS t4 ON t1.IdJefe = t4.IdUsuario
                left JOIN dbo.Usuarios AS t7 ON t1.IdUsuarioAtencion = t7.IdUsuario
                " . $join . "
                WHERE t1.Estado = '" . $estado . "' " . $consFilter . " " . $fechaFilter . " " . $descFilter . " " . $solicFilter . " " . $areaFilter . "
                " . $prioriFilter . " " . $selectFilter . "
                " . $filter . " " . $srch . " ";

            $qnr = $this->db->query($qnr);
            $qnr = $qnr->result_array()[0]["Cantidad"];

            if ($length == -1) {
                $q = $this->db->query("SELECT t1.*,t2.Nombre,t3.NombreArea,t3.Siglas,t4.Nombre as Jefe,t7.Nombre as PersonalCompra
                                   FROM dbo.Solicitudes AS t1
                                   INNER JOIN dbo.Usuarios AS t2 ON t1.IdUsuario = t2.IdUsuario
                                   INNER JOIN dbo.Areas AS t3 ON t1.IdArea = t3.IdArea
                                   LEFT JOIN dbo.Usuarios AS t4 ON t1.IdJefe = t4.IdUsuario
                                   left JOIN dbo.Usuarios AS t7 ON t1.IdUsuarioAtencion = t7.IdUsuario
                                   " . $join . "
                                   WHERE t1.Estado = '" . $estado . "' " . $consFilter . " " . $fechaFilter . " " . $descFilter . " " . $solicFilter . " " . $areaFilter . "
                                   " . $prioriFilter . " " . $selectFilter . " " . $filter . "  " . $srch . " ORDER BY t1.IdSolicitud asc");
            } else {
                $q = $this->db->query("SELECT t1.*,t2.Nombre,t3.NombreArea,t3.Siglas,t4.Nombre as Jefe,t7.Nombre as PersonalCompra
                                    FROM dbo.Solicitudes AS t1
                                    INNER JOIN dbo.Usuarios AS t2 ON t1.IdUsuario = t2.IdUsuario
                                    INNER JOIN dbo.Areas AS t3 ON t1.IdArea = t3.IdArea
                                    LEFT JOIN dbo.Usuarios AS t4 ON t1.IdJefe = t4.IdUsuario
                                    left JOIN dbo.Usuarios AS t7 ON t1.IdUsuarioAtencion = t7.IdUsuario
                                    " . $join . "
                                    WHERE t1.Estado = '" . $estado . "' " . $consFilter . " " . $fechaFilter . " " . $descFilter . " " . $solicFilter . " " . $areaFilter . "
                                    " . $prioriFilter . " " . $selectFilter . " " . $filter . " " . $srch . "
                                    ORDER BY t1.IdSolicitud asc
                                    offset " . $start . " rows fetch next " . $length . " rows only;");
            }

        } else {
            if ($estado == "R") {
                $join = "INNER JOIN solicRechazadas t5 on t1.IdSolicitud = t5.idSolicitud
                     LEFT JOIN dbo.Usuarios AS t6 ON t5.idUsuarioRechaza = t6.idUsuario";
                $filter = "AND t5.idSolicitante = '" . $this->session->userdata("id") . "' AND t5.estado = 'A' ";
                $nom    = ',t6.Nombre as RechazadoPor';
            } else {
                $nom = '';
            }

            $qnr = "select count(1) as Cantidad FROM dbo.Solicitudes AS t1
                INNER JOIN dbo.Usuarios AS t2 ON t1.IdUsuario = t2.IdUsuario
                INNER JOIN dbo.Areas AS t3 ON t1.IdArea = t3.IdArea
                LEFT JOIN dbo.Usuarios AS t4 ON t1.IdJefe = t4.IdUsuario
                left JOIN dbo.Usuarios AS t7 ON t1.IdUsuarioAtencion = t7.IdUsuario
                " . $join . "
                WHERE t1.Estado = '" . $estado . "' " . $consFilter . " " . $fechaFilter . " " . $descFilter . " " . $solicFilter . " " . $areaFilter . " " . $prioriFilter . " " . $selectFilter . " " . $filter . " " . $srch . " ";

            $qnr = $this->db->query($qnr);
            $qnr = $qnr->result_array()[0]["Cantidad"];

            if ($length == -1) {
                $q = $this->db->query("SELECT t1.*,t2.Nombre,t3.NombreArea,t3.Siglas,t4.Nombre as Jefe,t7.Nombre as PersonalCompra
                                " . $nom . "
                                   FROM dbo.Solicitudes AS t1
                                   INNER JOIN dbo.Usuarios AS t2 ON t1.IdUsuario = t2.IdUsuario
                                   INNER JOIN dbo.Areas AS t3 ON t1.IdArea = t3.IdArea
                                   LEFT JOIN dbo.Usuarios AS t4 ON t1.IdJefe = t4.IdUsuario
                                   left JOIN dbo.Usuarios AS t7 ON t1.IdUsuarioAtencion = t7.IdUsuario
                                   " . $join . "
                                   WHERE t1.Estado = '" . $estado . "' " . $consFilter . " " . $fechaFilter . " " . $descFilter . " " . $solicFilter . " " . $areaFilter . " " . $prioriFilter . " " . $selectFilter . " " . $filter . "  " . $srch . " ORDER BY t1.IdSolicitud asc");
            } else {
                $q = $this->db->query("SELECT t1.*,t2.Nombre,t3.NombreArea,t3.Siglas,t4.Nombre as Jefe,
                                    t7.Nombre as PersonalCompra " . $nom . "
                                    FROM dbo.Solicitudes AS t1
                                    INNER JOIN dbo.Usuarios AS t2 ON t1.IdUsuario = t2.IdUsuario
                                    INNER JOIN dbo.Areas AS t3 ON t1.IdArea = t3.IdArea
                                    LEFT JOIN dbo.Usuarios AS t4 ON t1.IdJefe = t4.IdUsuario
                                    left JOIN dbo.Usuarios AS t7 ON t1.IdUsuarioAtencion = t7.IdUsuario
                                    " . $join . "
                                    WHERE t1.Estado = '" . $estado . "' " . $consFilter . " " . $fechaFilter . " " . $descFilter . " " . $solicFilter . " " . $areaFilter . " " . $prioriFilter . " " . $selectFilter . " " . $filter . " " . $srch . "
                                    ORDER BY t1.IdSolicitud asc
                                    offset " . $start . " rows fetch next " . $length . " rows only;");
            }
        }
        $retornar = array(
            "numDataTotal" => $qnr,
            "datos"        => $q,
        );
        return $retornar;
    }

    public function saveOrdenPago($enc, $detalle)
    {
        $mensaje        = array();
        $atencionValida = "";
        $bandera        = false;
        $atencion       = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "' ");

        if ($atencion->result_array()[0]["IdUsuarioAtencion"] == "") {

            try {

                $this->db->where("IdSolicitud", $enc[0]);
                $updat = array(
                    "Estado"            => "P",
                    "IdUsuarioAtencion" => $this->session->userdata("id"),
                    "FechaAtencion"     => date("Y-m-d H:i:s"),
                );
                $up = $this->db->update("Solicitudes", $updat);

                if ($up) {
                    $idencOp     = $this->db->query("SELECT ISNULL(MAX(IdOrdenPago),0)+1 as IdOrdenPago FROM OrdenPago");
                    $consecutivo = "OP" . "-" . date("dmY") . "-" . $idencOp->result_array()[0]["IdOrdenPago"];
                    $encabezado  = array(
                        "IdOrdenPago"       => $idencOp->result_array()[0]["IdOrdenPago"],
                        "IdSolicitud"       => $enc[0],
                        "IdProveedor"       => $enc[1],
                        "ConsecutivoOP"     => $consecutivo,
                        "Proveedor"         => $enc[2],
                        "NombreCheque"      => $enc[9],
                        "Cantidad"          => $enc[5],
                        "CantidadDesc"      => $enc[4],
                        "Concepto"          => $enc[6],
                        "Retiene"           => $enc[7],
                        "ComentarioRetiene" => $enc[8],
                        "FechaCrea"         => date("Y-m-d H:i:s"),
                        "IdUsuarioCrea"     => $this->session->userdata("id"),
                        "Estado"            => "A",
                    );
                    $guardarEnc = $this->db->insert("OrdenPago", $encabezado);
                    if ($guardarEnc) {
                        $bandera = true;
                    } else {
                        $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }

                    if ($bandera == true) {
                        $bandera1 = false;
                        $idEnc    = $idencOp->result_array()[0]["IdOrdenPago"];
                        $det      = json_decode($detalle, true);
                        foreach ($det as $obj) {
                            $idDet     = $this->db->query("SELECT ISNULL(MAX(IdDetalleOP),0)+1 AS IdDetalleOP FROM DetalleOrdenPago");
                            $insertDet = array(
                                "IdDetalleOP"        => $idDet->result_array()[0]["IdDetalleOP"],
                                "IdOrdenPago"        => $idEnc,
                                "IdDetalleSolicitud" => $obj[16],
                                //"IdArticulo" => "",
                                "Estado"             => "A",
                                "Articulo"           => $obj[1],
                                "ArticuloProveedor"  => $obj[2],
                                "NumProforma"        => $obj[3],
                                "UnidadMedida"       => $obj[4],
                                "Cantidad"           => $obj[6],
                                "PrecioAntDescuento" => $obj[7],
                                "PorcentDescuento"   => $obj[8],
                                "MontoDesc"          => $obj[9],
                                "CodImpuesto"        => $obj[10],
                                "PorcentImpuesto"    => $obj[11],
                                "Moneda"             => $obj[12],
                                //"ISC" => $obj[],
                                "IVA"                => $obj[13],
                                "SubTotal"           => $obj[14],
                                "Total"              => $obj[15],
                            );
                            $guardarDet = $this->db->insert("DetalleOrdenPago", $insertDet);
                            if ($guardarDet) {
                                $bandera1 = true;
                            }
                        }

                        if ($bandera1) {
                            $mensaje[0]["mensaje"] = "Orden Pago generada con éxito. Consecutivo N° " . $consecutivo . " ";
                            $mensaje[0]["tipo"]    = "success";
                            echo json_encode($mensaje);
                        } else {
                            $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                        }
                    }
                }

            } catch (Exception $ex) {
                // $mensaje[0]["mensaje"] = "Guardando Orden de Pago primera vez";
                $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                $mensaje[0]["tipo"]    = "info";
                echo json_encode($mensaje);
            }

        } else {
            $atencionValida = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "'
                                      AND IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ");
            if ($atencionValida->num_rows() > 0) {

                try {

                    $idencOp     = $this->db->query("SELECT ISNULL(MAX(IdOrdenPago),0)+1 as IdOrdenPago FROM OrdenPago");
                    $consecutivo = "OP" . "-" . date("dmY") . "-" . $idencOp->result_array()[0]["IdOrdenPago"];
                    $encabezado  = array(
                        "IdOrdenPago"       => $idencOp->result_array()[0]["IdOrdenPago"],
                        "IdSolicitud"       => $enc[0],
                        "IdProveedor"       => $enc[1],
                        "ConsecutivoOP"     => $consecutivo,
                        "Proveedor"         => $enc[2],
                        "NombreCheque"      => $enc[9],
                        "Cantidad"          => $enc[5],
                        "CantidadDesc"      => $enc[4],
                        "Concepto"          => $enc[6],
                        "Retiene"           => $enc[7],
                        "ComentarioRetiene" => $enc[8],
                        "FechaCrea"         => date("Y-m-d H:i:s"),
                        "IdUsuarioCrea"     => $this->session->userdata("id"),
                        "Estado"            => "A",
                    );
                    $guardarEnc = $this->db->insert("OrdenPago", $encabezado);
                    if ($guardarEnc) {
                        $bandera = true;
                    } else {
                        $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }

                    if ($bandera == true) {
                        $bandera1 = false;
                        $idEnc    = $idencOp->result_array()[0]["IdOrdenPago"];
                        $det      = json_decode($detalle, true);
                        foreach ($det as $obj) {
                            $idDet     = $this->db->query("SELECT ISNULL(MAX(IdDetalleOP),0)+1 AS IdDetalleOP FROM DetalleOrdenPago");
                            $insertDet = array(
                                "IdDetalleOP"        => $idDet->result_array()[0]["IdDetalleOP"],
                                "IdOrdenPago"        => $idEnc,
                                "IdDetalleSolicitud" => $obj[16],
                                //"IdArticulo" => "",
                                "Estado"             => "A",
                                "Articulo"           => $obj[1],
                                "ArticuloProveedor"  => $obj[2],
                                "NumProforma"        => $obj[3],
                                "UnidadMedida"       => $obj[4],
                                "Cantidad"           => $obj[6],
                                "PrecioAntDescuento" => $obj[7],
                                "PorcentDescuento"   => $obj[8],
                                "MontoDesc"          => $obj[9],
                                "CodImpuesto"        => $obj[10],
                                "PorcentImpuesto"    => $obj[11],
                                "Moneda"             => $obj[12],
                                //"ISC" => $obj[],
                                "IVA"                => $obj[13],
                                "SubTotal"           => $obj[14],
                                "Total"              => $obj[15],
                            );
                            $guardarDet = $this->db->insert("DetalleOrdenPago", $insertDet);
                            if ($guardarDet) {
                                $bandera1 = true;
                            }
                        }

                        if ($bandera1) {
                            $mensaje[0]["mensaje"] = "Orden Pago generada con éxito. Consecutivo N° " . $consecutivo . " ";
                            $mensaje[0]["tipo"]    = "success";
                            echo json_encode($mensaje);
                        } else {
                            $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                        }
                    }

                } catch (Exception $ex) {
                    // $mensaje[0]["mensaje"] = "Guardando Orden de Pago primera vez";
                    $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                    $mensaje[0]["tipo"]    = "info";
                    echo json_encode($mensaje);
                }
            } else {
                $mensaje[0]["mensaje"] = "No se puede guardar esta Orden de Pago porque otro usuario ya esta atendiendo esta solicitud";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        }
    }

    public function saveOrdenCompra($enc, $detalle)
    {
        $mensaje        = array();
        $atencionValida = "";
        $bandera        = false;
        $atencion       = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "' ");

        if ($atencion->result_array()[0]["IdUsuarioAtencion"] == "") {

            try {

                $this->db->where("IdSolicitud", $enc[0]);
                $updat = array(
                    "Estado"            => "P",
                    "IdUsuarioAtencion" => $this->session->userdata("id"),
                    "FechaAtencion"     => date("Y-m-d H:i:s"),
                );
                $up = $this->db->update("Solicitudes", $updat);

                if ($up) {
                    $idencOc     = $this->db->query("SELECT ISNULL(MAX(IdOrdenCompra),0)+1 as IdOrdenCompra FROM OrdenCompra");
                    $consecutivo = "OC" . "-" . date("dmY") . "-" . $idencOc->result_array()[0]["IdOrdenCompra"];
                    $encabezado  = array(
                        "IdOrdenCompra" => $idencOc->result_array()[0]["IdOrdenCompra"],
                        "IdSolicitud"   => $enc[0],
                        "IdProveedor"   => $enc[1],
                        "ConsecutivoOC" => $consecutivo,
                        "Proveedor"     => $enc[2],
                        "Direccion"     => $enc[5],
                        "TiempoEntrega" => $enc[4],
                        "FechaCrea"     => date("Y-m-d H:i:s"),
                        "IdUsuarioCrea" => $this->session->userdata("id"),
                        "Estado"        => "A",
                    );
                    $guardarEnc = $this->db->insert("OrdenCompra", $encabezado);
                    if ($guardarEnc) {
                        $bandera = true;
                    } else {
                        $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }

                    if ($bandera == true) {
                        $bandera1 = false;
                        $idEnc    = $idencOc->result_array()[0]["IdOrdenCompra"];
                        $det      = json_decode($detalle, true);
                        foreach ($det as $obj) {
                            $idDet     = $this->db->query("SELECT ISNULL(MAX(IdDetalleOC),0)+1 AS IdDetalleOC FROM DetalleOrdenCompra");
                            $insertDet = array(
                                "IdDetalleOC"        => $idDet->result_array()[0]["IdDetalleOC"],
                                "IdOrdenCompra"      => $idEnc,
                                "IdDetalleSolicitud" => $obj[16],
                                //"IdArticulo" => "",
                                "Estado"             => "A",
                                "Articulo"           => $obj[1],
                                "ArticuloProveedor"  => $obj[2],
                                "NumProforma"        => $obj[3],
                                "UnidadMedida"       => $obj[4],
                                "Cantidad"           => $obj[6],
                                "PrecioAntDescuento" => $obj[7],
                                "PorcentDescuento"   => $obj[8],
                                "MontoDesc"          => $obj[9],
                                "CodImpuesto"        => $obj[10],
                                "PorcentImpuesto"    => $obj[11],
                                "Moneda"             => $obj[12],
                                //"ISC" => $obj[],
                                "IVA"                => $obj[13],
                                "SubTotal"           => $obj[14],
                                "Total"              => $obj[15],
                            );
                            $guardarDet = $this->db->insert("DetalleOrdenCompra", $insertDet);
                            if ($guardarDet) {
                                $bandera1 = true;
                            }
                        }

                        if ($bandera1) {
                            $mensaje[0]["mensaje"] = "Orden Compra generada con éxito. Consecutivo N° " . $consecutivo . " ";
                            $mensaje[0]["tipo"]    = "success";
                            echo json_encode($mensaje);
                        } else {
                            $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                        }
                    }
                }

            } catch (Exception $ex) {
                // $mensaje[0]["mensaje"] = "Guardando Orden de Compra primera vez";
                $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                $mensaje[0]["tipo"]    = "info";
                echo json_encode($mensaje);
            }

        } else {
            $atencionValida = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "'
                                      AND IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ");
            if ($atencionValida->num_rows() > 0) {

                try {

                    $idencOc     = $this->db->query("SELECT ISNULL(MAX(IdOrdenCompra),0)+1 as IdOrdenCompra FROM OrdenCompra");
                    $consecutivo = "OC" . "-" . date("dmY") . "-" . $idencOc->result_array()[0]["IdOrdenCompra"];
                    $encabezado  = array(
                        "IdOrdenCompra" => $idencOc->result_array()[0]["IdOrdenCompra"],
                        "IdSolicitud"   => $enc[0],
                        "IdProveedor"   => $enc[1],
                        "ConsecutivoOC" => $consecutivo,
                        "Proveedor"     => $enc[2],
                        "Direccion"     => $enc[5],
                        "TiempoEntrega" => $enc[4],
                        "FechaCrea"     => date("Y-m-d H:i:s"),
                        "IdUsuarioCrea" => $this->session->userdata("id"),
                        "Estado"        => "A",
                    );
                    $guardarEnc = $this->db->insert("OrdenCompra", $encabezado);
                    if ($guardarEnc) {
                        $bandera = true;
                    } else {
                        $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }

                    if ($bandera == true) {
                        $bandera1 = false;
                        $idEnc    = $idencOc->result_array()[0]["IdOrdenCompra"];
                        $det      = json_decode($detalle, true);
                        foreach ($det as $obj) {
                            $idDet     = $this->db->query("SELECT ISNULL(MAX(IdDetalleOC),0)+1 AS IdDetalleOC FROM DetalleOrdenCompra");
                            $insertDet = array(
                                "IdDetalleOC"        => $idDet->result_array()[0]["IdDetalleOC"],
                                "IdOrdenCompra"      => $idEnc,
                                "IdDetalleSolicitud" => $obj[16],
                                //"IdArticulo" => "",
                                "Estado"             => "A",
                                "Articulo"           => $obj[1],
                                "ArticuloProveedor"  => $obj[2],
                                "NumProforma"        => $obj[3],
                                "UnidadMedida"       => $obj[4],
                                "Cantidad"           => $obj[6],
                                "PrecioAntDescuento" => $obj[7],
                                "PorcentDescuento"   => $obj[8],
                                "MontoDesc"          => $obj[9],
                                "CodImpuesto"        => $obj[10],
                                "PorcentImpuesto"    => $obj[11],
                                "Moneda"             => $obj[12],
                                //"ISC" => $obj[],
                                "IVA"                => $obj[13],
                                "SubTotal"           => $obj[14],
                                "Total"              => $obj[15],
                            );
                            $guardarDet = $this->db->insert("DetalleOrdenCompra", $insertDet);
                            if ($guardarDet) {
                                $bandera1 = true;
                            }
                        }

                        if ($bandera1) {
                            $mensaje[0]["mensaje"] = "Orden Compra generada con éxito. Consecutivo N° " . $consecutivo . " ";
                            $mensaje[0]["tipo"]    = "success";
                            echo json_encode($mensaje);
                        } else {
                            $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                        }
                    }

                } catch (Exception $ex) {
                    // $mensaje[0]["mensaje"] = "Guardando Orden de Compra primera vez";
                    $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                    $mensaje[0]["tipo"]    = "info";
                    echo json_encode($mensaje);
                }
            } else {
                $mensaje[0]["mensaje"] = "No se puede guardar esta Orden de Compra porque otro usuario ya esta atendiendo esta solicitud";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        }
    }

    public function saveCajaChica($enc, $detalle)
    {
        $mensaje        = array();
        $atencionValida = "";
        $bandera        = false;
        $atencion       = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "' ");

        if ($atencion->result_array()[0]["IdUsuarioAtencion"] == "") {

            try {

                $this->db->where("IdSolicitud", $enc[0]);
                $updat = array(
                    "Estado"            => "P",
                    "IdUsuarioAtencion" => $this->session->userdata("id"),
                    "FechaAtencion"     => date("Y-m-d H:i:s"),
                );
                $up = $this->db->update("Solicitudes", $updat);

                if ($up) {
                    $idencOc     = $this->db->query("SELECT ISNULL(MAX(IdCajaChica),0)+1 as IdCajaChica FROM CajaChica");
                    $consecutivo = "CH" . "-" . date("dmY") . "-" . $idencOc->result_array()[0]["IdCajaChica"];
                    $encabezado  = array(
                        "IdCajaChica"   => $idencOc->result_array()[0]["IdCajaChica"],
                        "IdSolicitud"   => $enc[0],
                        "consecutivoCH" => $consecutivo,
                        "IdProveedor"   => $enc[1],
                        "Proveedor"     => $enc[2],
                        "fechaRecibo"   => $enc[3],
                        "Concepto"      => $enc[4],
                        "Total"         => $enc[5],
                        "fechaCrea"     => date("Y-m-d H:i:s"),
                        "horaCrea"      => date("H:i:s"),
                        "idUsuarioCrea" => $this->session->userdata("id"),
                        "Estado"        => "A",
                        "referencia"    => "",
                    );
                    $guardarEnc = $this->db->insert("CajaChica", $encabezado);
                    if ($guardarEnc) {
                        $bandera = true;
                    } else {
                        $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }

                    if ($bandera == true) {
                        $bandera1 = false;
                        $idEnc    = $idencOc->result_array()[0]["IdCajaChica"];
                        $det      = json_decode($detalle, true);
                        foreach ($det as $obj) {
                            $idDet     = $this->db->query("SELECT ISNULL(MAX(idDetCH),0)+1 AS idDetCH FROM DetalleCajaChica");
                            $insertDet = array(
                                "idDetCH"            => $idDet->result_array()[0]["idDetCH"],
                                "IdCajaChica"        => $idEnc,
                                "IdDetalleSolicitud" => $obj[16],
                                //"IdArticulo" => "",
                                "Estado"             => "A",
                                "Articulo"           => $obj[1],
                                "ArticuloProveedor"  => $obj[2],
                                "NumFactura"         => $obj[3],
                                "UnidadMedida"       => $obj[4],
                                "Cantidad"           => $obj[6],
                                "PrecioAntDescuento" => $obj[7],
                                "PorcentDescuento"   => $obj[8],
                                "MontoDesc"          => $obj[9],
                                "CodImpuesto"        => $obj[10],
                                "PorcentImpuesto"    => $obj[11],
                                "Moneda"             => $obj[12],
                                //"ISC" => $obj[],
                                "IVA"                => $obj[13],
                                "SubTotal"           => $obj[14],
                                "Total"              => $obj[15],
                            );
                            $guardarDet = $this->db->insert("DetalleCajaChica", $insertDet);
                            if ($guardarDet) {
                                $bandera1 = true;
                            }
                        }

                        if ($bandera1) {
                            $mensaje[0]["mensaje"] = "Caja chica generada con éxito. Consecutivo N° " . $consecutivo . " ";
                            $mensaje[0]["tipo"]    = "success";
                            echo json_encode($mensaje);
                        } else {
                            $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                        }
                    }
                }

            } catch (Exception $ex) {
                // $mensaje[0]["mensaje"] = "Guardando Orden de Compra primera vez";
                $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                $mensaje[0]["tipo"]    = "info";
                echo json_encode($mensaje);
            }

        } else {
            $atencionValida = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "'
                                      AND IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ");
            if ($atencionValida->num_rows() > 0) {

                try {

                    $idencOc     = $this->db->query("SELECT ISNULL(MAX(IdCajaChica),0)+1 as IdCajaChica FROM CajaChica");
                    $consecutivo = "CH" . "-" . date("dmY") . "-" . $idencOc->result_array()[0]["IdCajaChica"];
                    $encabezado  = array(
                        "IdCajaChica"   => $idencOc->result_array()[0]["IdCajaChica"],
                        "IdSolicitud"   => $enc[0],
                        "consecutivoCH" => $consecutivo,
                        "IdProveedor"   => $enc[1],
                        "Proveedor"     => $enc[2],
                        "fechaRecibo"   => $enc[3],
                        "Concepto"      => $enc[4],
                        "Total"         => $enc[5],
                        "fechaCrea"     => date("Y-m-d H:i:s"),
                        "horaCrea"      => date("H:i:s"),
                        "idUsuarioCrea" => $this->session->userdata("id"),
                        "Estado"        => "A",
                        "referencia"    => "",
                    );
                    $guardarEnc = $this->db->insert("CajaChica", $encabezado);
                    if ($guardarEnc) {
                        $bandera = true;
                    } else {
                        $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }

                    if ($bandera == true) {
                        $bandera1 = false;
                        $idEnc    = $idencOc->result_array()[0]["IdCajaChica"];
                        $det      = json_decode($detalle, true);
                        foreach ($det as $obj) {
                            $idDet     = $this->db->query("SELECT ISNULL(MAX(idDetCH),0)+1 AS idDetCH FROM DetalleCajaChica");
                            $insertDet = array(
                                "idDetCH"            => $idDet->result_array()[0]["idDetCH"],
                                "IdCajaChica"        => $idEnc,
                                "IdDetalleSolicitud" => $obj[16],
                                //"IdArticulo" => "",
                                "Estado"             => "A",
                                "Articulo"           => $obj[1],
                                "ArticuloProveedor"  => $obj[2],
                                "NumFactura"         => $obj[3],
                                "UnidadMedida"       => $obj[4],
                                "Cantidad"           => $obj[6],
                                "PrecioAntDescuento" => $obj[7],
                                "PorcentDescuento"   => $obj[8],
                                "MontoDesc"          => $obj[9],
                                "CodImpuesto"        => $obj[10],
                                "PorcentImpuesto"    => $obj[11],
                                "Moneda"             => $obj[12],
                                //"ISC" => $obj[],
                                "IVA"                => $obj[13],
                                "SubTotal"           => $obj[14],
                                "Total"              => $obj[15],
                            );
                            $guardarDet = $this->db->insert("DetalleCajaChica", $insertDet);
                            if ($guardarDet) {
                                $bandera1 = true;
                            }
                        }

                        if ($bandera1) {
                            $mensaje[0]["mensaje"] = "Caja chica generada con éxito. Consecutivo N° " . $consecutivo . " ";
                            $mensaje[0]["tipo"]    = "success";
                            echo json_encode($mensaje);
                        } else {
                            $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                            $mensaje[0]["tipo"]    = "error";
                            echo json_encode($mensaje);
                        }
                    }

                } catch (Exception $ex) {
                    // $mensaje[0]["mensaje"] = "Guardando Orden de Compra primera vez";
                    $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                    $mensaje[0]["tipo"]    = "info";
                    echo json_encode($mensaje);
                }
            } else {
                $mensaje[0]["mensaje"] = "No se puede guardar porque otro usuario ya esta atendiendo esta solicitud";
                $mensaje[0]["tipo"]    = "error";
                echo json_encode($mensaje);
            }
        }
    }
    /**********************editar ordenes******************************** */

    public function editOrdersEnc($tipo, $idOrden)
    {
        $query = "";
        if ($tipo == 1) {
            $query = $this->db->where("IdOrdenCompra", $idOrden)->get("OrdenCompra");
        } else if ($tipo == 2) {
            $query = $this->db->where("IdOrdenPago", $idOrden)->get("OrdenPago");
        } else if ($tipo == 3) {
            $query = $this->db->where("IdCajaChica", $idOrden)->get("CajaChica");
        }

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;

    }

    public function editOrders($tipo, $idSolic, $idOrden, $start, $length, $search)
    {
        $srch = "";
        $cond = "";
        if ($search) {
            $srch = "AND (
                      CantidadSolicitud like '%" . $search . "%' OR
                      UnidadMedida like '%" . $search . "%' OR
                      CantidadAut like '%" . $search . "%' OR
                      DescripcionArticulo like '%" . $search . "%'
                    ) ";
        }

        if ($tipo == 1) {
            $cond = "and IdOrdenCompra";
        } else if ($tipo == 2) {
            $cond = "and IdOrdenPago";
        } else if ($tipo == 3) {
            $cond = "and IdCajaChica";
        }

        $qnr = "select count(1) as Cantidad from view_editar_ordenes where
                IdSolicitud = '" . $idSolic . "'
                " . $cond . "  = '" . $idOrden . "'
                " . $srch . " ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if ($length == -1) {
            $q = $this->db->query("select * from view_editar_ordenes
                                        where
                                        IdSolicitud = '" . $idSolic . "'
                                         " . $cond . " = '" . $idOrden . "'
                                        order by IdDetallesSolicitud asc");
        } else {
            $q = $this->db->query("select * from view_editar_ordenes
                                        where
                                        IdSolicitud = '" . $idSolic . "'
                                        " . $cond . "  = '" . $idOrden . "'
                                        order by IdDetallesSolicitud asc
                                        offset " . $start . " rows fetch next " . $length . " rows only;");
        }

        $retornar = array(
            "numDataTotal" => $qnr,
            "datos"        => $q,
        );
        return $retornar;
    }

    public function updateOrdenPago($enc, $detalle)
    {
        $mensaje        = array();
        $atencionValida = "";
        $bandera        = false;
        $atencionValida = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "'
                                      AND IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ");
        if ($atencionValida->num_rows() > 0) {

            try {
                $this->db->where("IdOrdenPago", $enc[10]);
                $encabezado = array(
                    //"IdOrdenPago"=>  $idencOp->result_array()[0]["IdOrdenPago"],
                    //"IdSolicitud"=>  $enc[0],
                    "IdProveedor"        => $enc[1],
                    //"ConsecutivoOP"=>  $consecutivo,
                    "Proveedor"          => $enc[2],
                    "NombreCheque"       => $enc[9],
                    "Cantidad"           => $enc[5],
                    "CantidadDesc"       => $enc[4],
                    "Concepto"           => $enc[6],
                    "Retiene"            => $enc[7],
                    "ComentarioRetiene"  => $enc[8],
                    "FechaActualiza"     => date("Y-m-d H:i:s"),
                    "IdUsuarioActualiza" => $this->session->userdata("id"),
                );
                $guardarEnc = $this->db->update("OrdenPago", $encabezado);
                if ($guardarEnc) {
                    $bandera = true;
                } else {
                    $mensaje[0]["mensaje"] = "Se produjo un error al actualizar los datos. COD-1(ENC)";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }

                if ($bandera == true) {
                    $bandera1 = false;
                    // $idEnc = $idencOp->result_array()[0]["IdOrdenPago"];
                    $det = json_decode($detalle, true);
                    foreach ($det as $obj) {
                        //$idDet = $this->db->query("SELECT ISNULL(MAX(IdDetalleOP),0)+1 AS IdDetalleOP FROM DetalleOrdenPago");
                        $this->db->where("IdDetalleOP", $obj[17]);
                        $insertDet = array(
                            //"IdDetalleOP" => $idDet->result_array()[0]["IdDetalleOP"],
                            //"IdOrdenPago" => $idEnc,
                            //"IdDetalleSolicitud" => $obj[16],
                            //"IdArticulo" => "",
                            //"Estado" => "A",
                            "Articulo"           => $obj[1],
                            "ArticuloProveedor"  => $obj[2],
                            "NumProforma"        => $obj[3],
                            "UnidadMedida"       => $obj[4],
                            "Cantidad"           => $obj[6],
                            "PrecioAntDescuento" => $obj[7],
                            "PorcentDescuento"   => $obj[8],
                            "MontoDesc"          => $obj[9],
                            "CodImpuesto"        => $obj[10],
                            "PorcentImpuesto"    => $obj[11],
                            "Moneda"             => $obj[12],
                            //"ISC" => $obj[],
                            "IVA"                => $obj[13],
                            "SubTotal"           => $obj[14],
                            "Total"              => $obj[15],
                        );
                        $guardarDet = $this->db->update("DetalleOrdenPago", $insertDet);
                        if ($guardarDet) {
                            $bandera1 = true;
                        }
                    }

                    if ($bandera1) {
                        $mensaje[0]["mensaje"] = "Orden Pago actualizada con éxito.";
                        $mensaje[0]["tipo"]    = "success";
                        echo json_encode($mensaje);
                    } else {
                        $mensaje[0]["mensaje"] = "Se produjo un error al actualizar los datos. COD-2(DET)";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }
                }

            } catch (Exception $ex) {
                // $mensaje[0]["mensaje"] = "Guardando Orden de Pago primera vez";
                $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                $mensaje[0]["tipo"]    = "info";
                echo json_encode($mensaje);
            }
        } else {
            $mensaje[0]["mensaje"] = "No se puede actualizar esta Orden de Pago porque otro usuario ya esta atendiendo esta solicitud";
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
    }

    public function updateOrdenCompra($enc, $detalle)
    {
        $mensaje        = array();
        $atencionValida = "";
        $bandera        = false;

        $atencionValida = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "'
                                      AND IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ");
        if ($atencionValida->num_rows() > 0) {

            try {

                //$idencOc = $this->db->query("SELECT ISNULL(MAX(IdOrdenCompra),0)+1 as IdOrdenCompra FROM OrdenCompra");
                //$consecutivo = "OC"."-".date("dmY")."-".$idencOc->result_array()[0]["IdOrdenCompra"];
                $this->db->where("IdOrdenCompra", $enc[6]);
                $encabezado = array(
                    //"IdOrdenCompra"=>  $idencOc->result_array()[0]["IdOrdenCompra"],
                    "IdSolicitud"        => $enc[0],
                    "IdProveedor"        => $enc[1],
                    //"ConsecutivoOC"=>  $consecutivo,
                    "Proveedor"          => $enc[2],
                    "Direccion"          => $enc[5],
                    "TiempoEntrega"      => $enc[4],
                    "FechaActualiza"     => date("Y-m-d H:i:s"),
                    "IdUsuarioActualiza" => $this->session->userdata("id"),
                );
                $guardarEnc = $this->db->update("OrdenCompra", $encabezado);
                if ($guardarEnc) {
                    $bandera = true;
                } else {
                    $mensaje[0]["mensaje"] = "Se produjo un error al actualizar los datos. COD-1(ENC)";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }

                if ($bandera == true) {
                    $bandera1 = false;
                    //$idEnc = $idencOc->result_array()[0]["IdOrdenCompra"];
                    $det = json_decode($detalle, true);
                    foreach ($det as $obj) {
                        //$idDet = $this->db->query("SELECT ISNULL(MAX(IdDetalleOC),0)+1 AS IdDetalleOC FROM DetalleOrdenCompra");
                        $this->db->where("IdDetalleOC", $obj[17]);
                        $insertDet = array(
                            //"IdDetalleOC" => $idDet->result_array()[0]["IdDetalleOC"],
                            //"IdOrdenCompra" => $idEnc,
                            //"IdDetalleSolicitud" => $obj[16],
                            //"IdArticulo" => "",
                            //"Estado" => "A",
                            "Articulo"           => $obj[1],
                            "ArticuloProveedor"  => $obj[2],
                            "NumProforma"        => $obj[3],
                            "UnidadMedida"       => $obj[4],
                            "Cantidad"           => $obj[6],
                            "PrecioAntDescuento" => $obj[7],
                            "PorcentDescuento"   => $obj[8],
                            "MontoDesc"          => $obj[9],
                            "CodImpuesto"        => $obj[10],
                            "PorcentImpuesto"    => $obj[11],
                            "Moneda"             => $obj[12],
                            //"ISC" => $obj[],
                            "IVA"                => $obj[13],
                            "SubTotal"           => $obj[14],
                            "Total"              => $obj[15],
                        );
                        $guardarDet = $this->db->update("DetalleOrdenCompra", $insertDet);
                        if ($guardarDet) {
                            $bandera1 = true;
                        }
                    }

                    if ($bandera1) {
                        $mensaje[0]["mensaje"] = "Orden Compra actualizada con éxito.";
                        $mensaje[0]["tipo"]    = "success";
                        echo json_encode($mensaje);
                    } else {
                        $mensaje[0]["mensaje"] = "Se produjo un error al actualizar los datos. COD-2(DET)";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }
                }

            } catch (Exception $ex) {
                // $mensaje[0]["mensaje"] = "Guardando Orden de Compra primera vez";
                $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                $mensaje[0]["tipo"]    = "info";
                echo json_encode($mensaje);
            }
        } else {
            $mensaje[0]["mensaje"] = "No se puede actualizar esta Orden de Compra porque otro usuario ya esta atendiendo esta solicitud";
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
    }

    public function updateCajaChica($enc, $detalle)
    {
        $mensaje        = array();
        $atencionValida = "";
        $bandera        = false;
        $atencionValida = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "'
                                      AND IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ");
        if ($atencionValida->num_rows() > 0) {

            try {
                $this->db->where("IdCajaChica", $enc[6]);
                $encabezado = array(
                    //"IdOrdenPago"=>  $idencOp->result_array()[0]["IdOrdenPago"],
                    //"IdSolicitud"=>  $enc[0],
                    "IdProveedor" => $enc[1],
                    //"ConsecutivoOP"=>  $consecutivo,
                    "Proveedor"   => $enc[2],
                    "fechaRecibo" => $enc[3],
                    "Concepto"    => $enc[4],
                    "Total"       => $enc[5],
                );
                $guardarEnc = $this->db->update("CajaChica", $encabezado);
                if ($guardarEnc) {
                    $bandera = true;
                } else {
                    $mensaje[0]["mensaje"] = "Se produjo un error al actualizar los datos. COD-1(ENC)";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }

                if ($bandera == true) {
                    $bandera1 = false;
                    // $idEnc = $idencOp->result_array()[0]["IdOrdenPago"];
                    $det = json_decode($detalle, true);
                    foreach ($det as $obj) {
                        //$idDet = $this->db->query("SELECT ISNULL(MAX(IdDetalleOP),0)+1 AS IdDetalleOP FROM DetalleOrdenPago");
                        $this->db->where("idDetCH", $obj[17]);
                        $insertDet = array(
                            //"IdDetalleOP" => $idDet->result_array()[0]["IdDetalleOP"],
                            //"IdOrdenPago" => $idEnc,
                            //"IdDetalleSolicitud" => $obj[16],
                            //"IdArticulo" => "",
                            //"Estado" => "A",
                            "Articulo"           => $obj[1],
                            "ArticuloProveedor"  => $obj[2],
                            "NumFactura"         => $obj[3],
                            "UnidadMedida"       => $obj[4],
                            "Cantidad"           => $obj[6],
                            "PrecioAntDescuento" => $obj[7],
                            "PorcentDescuento"   => $obj[8],
                            "MontoDesc"          => $obj[9],
                            "CodImpuesto"        => $obj[10],
                            "PorcentImpuesto"    => $obj[11],
                            "Moneda"             => $obj[12],
                            //"ISC" => $obj[],
                            "IVA"                => $obj[13],
                            "SubTotal"           => $obj[14],
                            "Total"              => $obj[15],
                        );
                        $guardarDet = $this->db->update("DetalleCajaChica", $insertDet);
                        if ($guardarDet) {
                            $bandera1 = true;
                        }
                    }

                    if ($bandera1) {
                        $mensaje[0]["mensaje"] = "Caja Chica actualizada con éxito.";
                        $mensaje[0]["tipo"]    = "success";
                        echo json_encode($mensaje);
                    } else {
                        $mensaje[0]["mensaje"] = "Se produjo un error al actualizar los datos. COD-2(DET)";
                        $mensaje[0]["tipo"]    = "error";
                        echo json_encode($mensaje);
                    }
                }

            } catch (Exception $ex) {
                // $mensaje[0]["mensaje"] = "Guardando Orden de Pago primera vez";
                $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                $mensaje[0]["tipo"]    = "info";
                echo json_encode($mensaje);
            }
        } else {
            $mensaje[0]["mensaje"] = "No se puede actualizar esta Orden de Pago porque otro usuario ya esta atendiendo esta solicitud";
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
    }

    /***********************editar rodenes******************************* */

    public function mostrarOC($idsolicitud, $start, $length, $search)
    {
        $srch   = "";
        $filter = "";
        if ($search) {
            $srch = "AND (
                      ConsecutivoOC like '%" . $search . "%' OR
                      Proveedor like '%" . $search . "%' OR
                      Direccion like '%" . $search . "%' OR
                      TiempoEntrega like '%" . $search . "%' OR
                      cast(FechaCrea as date) like '%" . $search . "%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad FROM OrdenCompra where IdSolicitud = '" . $idsolicitud . "' and Estado = 'A' " . $srch . " ";

        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if ($length == -1) {
            $q = $this->db->query("SELECT IdOrdenCompra,IdSolicitud,IdProveedor,ConsecutivoOC
                                ,Proveedor,Direccion,TiempoEntrega,FechaCrea,IdUsuarioCrea
                               FROM OrdenCompra where IdSolicitud = '" . $idsolicitud . "' and Estado = 'A' " . $srch . " ORDER BY IdOrdenCompra asc");
        } else {
            $q = $this->db->query("SELECT IdOrdenCompra,IdSolicitud,IdProveedor,ConsecutivoOC
            ,Proveedor,Direccion,TiempoEntrega,FechaCrea,IdUsuarioCrea
           FROM OrdenCompra where IdSolicitud = '" . $idsolicitud . "' and Estado = 'A' " . $srch . " ORDER BY IdOrdenCompra asc
                                    offset " . $start . " rows fetch next " . $length . " rows only;");
        }

        $retornar = array(
            "numDataTotal" => $qnr,
            "datos"        => $q,
        );
        return $retornar;
    }

    public function mostrarDetOC($idOrdenCompra)
    {
        $query = $this->db->query("select * from DetalleOrdenCompra where IdOrdenCompra = '" . $idOrdenCompra . "' and Estado = 'A'");
        $json  = array();
        $i     = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $json[$i]["IdDetalleOC"]        = $key["IdDetalleOC"];
                $json[$i]["IdOrdenCompra"]      = $key["IdOrdenCompra"];
                $json[$i]["IdDetalleSolicitud"] = $key["IdDetalleSolicitud"];
                $json[$i]["IdArticulo"]         = $key["IdArticulo"];
                $json[$i]["Articulo"]           = $key["Articulo"];
                $json[$i]["ArticuloProveedor"]  = $key["ArticuloProveedor"];
                $json[$i]["NumProforma"]        = $key["NumProforma"];
                $json[$i]["UnidadMedida"]       = $key["UnidadMedida"];
                $json[$i]["Cantidad"]           = $key["Cantidad"];
                $json[$i]["PrecioAntDescuento"] = $key["PrecioAntDescuento"];
                $json[$i]["PorcentDescuento"]   = $key["PorcentDescuento"];
                $json[$i]["MontoDesc"]          = $key["MontoDesc"];
                $json[$i]["CodImpuesto"]        = $key["CodImpuesto"];
                $json[$i]["PorcentImpuesto"]    = $key["PorcentImpuesto"];
                $json[$i]["Moneda"]             = $key["Moneda"];
                $json[$i]["ISC"]                = $key["ISC"];
                $json[$i]["IVA"]                = $key["IVA"];
                $json[$i]["SubTotal"]           = $key["SubTotal"];
                $json[$i]["Total"]              = $key["Total"];
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function mostrarOP($idsolicitud, $start, $length, $search)
    {
        $srch   = "";
        $filter = "";
        if ($search) {
            $srch = "AND (
                      ConsecutivoOP like '%" . $search . "%' OR
                      Proveedor like '%" . $search . "%' OR
                      Direccion like '%" . $search . "%' OR
                      TiempoEntrega like '%" . $search . "%' OR
                      cast(FechaCrea as date) like '%" . $search . "%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad FROM OrdenPago where IdSolicitud = '" . $idsolicitud . "' and Estado = 'A' " . $srch . " ";

        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if ($length == -1) {
            $q = $this->db->query("SELECT [IdOrdenPago]
            ,[IdSolicitud]
            ,[IdProveedor]
            ,[ConsecutivoOP]
            ,[Proveedor]
            ,[NombreCheque]
            ,[Cantidad]
            ,[CantidadDesc]
            ,[Concepto]
            ,[Retiene]
            ,[ComentarioRetiene]
            ,[FechaCrea]
                               FROM OrdenPago where IdSolicitud = '" . $idsolicitud . "' and Estado= 'A' " . $srch . " ORDER BY IdOrdenPago asc");
        } else {
            $q = $this->db->query("SELECT [IdOrdenPago]
            ,[IdSolicitud]
            ,[IdProveedor]
            ,[ConsecutivoOP]
            ,[Proveedor]
            ,[NombreCheque]
            ,[Cantidad]
            ,[CantidadDesc]
            ,[Concepto]
            ,[Retiene]
            ,[ComentarioRetiene]
            ,[FechaCrea]
                               FROM OrdenPago where IdSolicitud = '" . $idsolicitud . "' and Estado= 'A' " . $srch . " ORDER BY IdOrdenPago asc
                                    offset " . $start . " rows fetch next " . $length . " rows only;");
        }

        $retornar = array(
            "numDataTotal" => $qnr,
            "datos"        => $q,
        );
        return $retornar;
    }

    public function mostrarDetOP($idOrdenPago)
    {
        $query = $this->db->where("IdOrdenPago", $idOrdenPago)->where("Estado", "A")->get("DetalleOrdenPago");
        $json  = array();
        $i     = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $json[$i]["IdDetalleOP"]        = $key["IdDetalleOP"];
                $json[$i]["IdOrdenPago"]        = $key["IdOrdenPago"];
                $json[$i]["IdDetalleSolicitud"] = $key["IdDetalleSolicitud"];
                $json[$i]["IdArticulo"]         = $key["IdArticulo"];
                $json[$i]["Articulo"]           = $key["Articulo"];
                $json[$i]["ArticuloProveedor"]  = $key["ArticuloProveedor"];
                $json[$i]["NumProforma"]        = $key["NumProforma"];
                $json[$i]["UnidadMedida"]       = $key["UnidadMedida"];
                $json[$i]["Cantidad"]           = $key["Cantidad"];
                $json[$i]["PrecioAntDescuento"] = number_format($key["PrecioAntDescuento"], 2);
                $json[$i]["PorcentDescuento"]   = number_format($key["PorcentDescuento"], 0);
                $json[$i]["MontoDesc"]          = number_format($key["MontoDesc"], 2);
                $json[$i]["CodImpuesto"]        = $key["CodImpuesto"];
                $json[$i]["PorcentImpuesto"]    = number_format($key["PorcentImpuesto"], 0);
                $json[$i]["Moneda"]             = $key["Moneda"];
                $json[$i]["ISC"]                = number_format($key["ISC"], 2);
                $json[$i]["IVA"]                = number_format($key["IVA"], 2);
                $json[$i]["SubTotal"]           = $key["SubTotal"];
                $json[$i]["Total"]              = $key["Total"];
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function mostrarCH($idsolicitud, $start, $length, $search)
    {
        $srch   = "";
        $filter = "";
        if ($search) {
            $srch = "AND (
                      ConsecutivoCH like '%" . $search . "%' OR
                      Proveedor like '%" . $search . "%' OR
                      Concepto like '%" . $search . "%' OR
                      cast(fechaRecibo as date) like '%" . $search . "%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad FROM CajaChica where IdSolicitud = '" . $idsolicitud . "' and Estado = 'A' " . $srch . " ";

        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if ($length == -1) {
            $q = $this->db->query("SELECT [IdCajaChica]
            ,[IdSolicitud]
            ,[consecutivoCH]
            ,[IdProveedor]
            ,[Proveedor]
            ,[fechaRecibo]
            ,[Concepto]
            ,[Total]
            ,[fechaCrea]
            ,[horaCrea]
            ,[idUsuarioCrea]
            ,[referencia]
            ,[Estado]
                               FROM CajaChica where IdSolicitud = '" . $idsolicitud . "' and Estado= 'A' " . $srch . " ORDER BY IdCajaChica asc");
        } else {
            $q = $this->db->query("SELECT [IdCajaChica]
            ,[IdSolicitud]
            ,[consecutivoCH]
            ,[IdProveedor]
            ,[Proveedor]
            ,[fechaRecibo]
            ,[Concepto]
            ,[Total]
            ,[fechaCrea]
            ,[horaCrea]
            ,[idUsuarioCrea]
            ,[referencia]
            ,[Estado]
                               FROM CajaChica where IdSolicitud = '" . $idsolicitud . "' and Estado= 'A' " . $srch . " ORDER BY IdCajaChica asc
                                    offset " . $start . " rows fetch next " . $length . " rows only;");
        }

        $retornar = array(
            "numDataTotal" => $qnr,
            "datos"        => $q,
        );
        return $retornar;
    }

    public function mostrarDetCH($idCH)
    {
        $opcionSelect = "";
        $value        = 0.00;
        $query        = $this->db->where("IdCajaChica", $idCH)->where("Estado", "A")->get("DetalleCajaChica");
        $json         = array();
        $i            = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $json[$i]["idDetCH"]            = $key["idDetCH"];
                $json[$i]["IdCajaChica"]        = $key["IdCajaChica"];
                $json[$i]["IdDetalleSolicitud"] = $key["IdDetalleSolicitud"];
                $json[$i]["IdArticulo"]         = $key["IdArticulo"];
                $json[$i]["Articulo"]           = $key["Articulo"];
                $json[$i]["ArticuloProveedor"]  = $key["ArticuloProveedor"];
                $json[$i]["NumFactura"]         = $key["NumFactura"];
                $json[$i]["UnidadMedida"]       = $key["UnidadMedida"];
                $json[$i]["Cantidad"]           = $key["Cantidad"];
                $json[$i]["PrecioAntDescuento"] = number_format($key["PrecioAntDescuento"], 2);
                $json[$i]["PorcentDescuento"]   = number_format($key["PorcentDescuento"], 0);
                $json[$i]["MontoDesc"]          = number_format($key["MontoDesc"], 2);
                $json[$i]["CodImpuesto"]        = $key["CodImpuesto"];
                $json[$i]["PorcentImpuesto"]    = number_format($key["PorcentImpuesto"], 0);
                $json[$i]["Moneda"]             = $key["Moneda"];
                $json[$i]["ISC"]                = number_format($key["ISC"], 2);
                $json[$i]["IVA"]                = number_format($key["IVA"], 2);
                $json[$i]["SubTotal"]           = $key["SubTotal"];
                $json[$i]["Total"]              = $key["Total"];
                $i++;
            }
            echo json_encode($json);
        }
    }

    /*public function updateCajaChica($idDetCH,$fecha,$concepto,$numFac,$benef,$imp,$porcImp,$subTotal,$total)
    {
    $mensaje = array();
    $bandera = false;
    try {

    $this->db->where("idDetCH",$idDetCH);
    $data = array(
    "fechaRecibo" => $fecha,
    "concepto" => $concepto,
    "numFactura" => $numFac,
    "beneficiario" => $benef,
    "impuesto" => $imp,
    "porcentajeImp" => $porcImp,
    "subTotal" => $subTotal,
    "total" => $total
    );
    $update = $this->db->update("DetalleCajaChica", $data);
    if($update){
    $bandera = true;
    }

    if($bandera){
    $mensaje[0]["mensaje"] = "Datos actualizados!";
    $mensaje[0]["tipo"] = "success";
    echo json_encode($mensaje);
    }else{
    $mensaje[0]["mensaje"] = "Error al actualizar los datos. Póngase en contacto con el administrador";
    $mensaje[0]["tipo"] = "error";
    echo json_encode($mensaje);
    }

    } catch (Exception $ex) {
    // $mensaje[0]["mensaje"] = "Guardando Orden de Compra primera vez";
    $mensaje[0]["mensaje"] = $ex->getMessage(). "... Código ".$ex->getCode();
    $mensaje[0]["tipo"] = "info";
    echo json_encode($mensaje);
    }
    }*/

    public function cerraSolicitud($idSolicitud)
    {
        try {
            $mensaje = array();
            $this->db->where("IdSolicitud", $idSolicitud);
            $data = array(
                "Estado"      => "S",
                "FechaCierre" => date("Y-m-d H:i:s"),
            );
            $up = $this->db->update("Solicitudes", $data);
            if ($up) {
                $mensaje[0]["mensaje"] = "Orden cerrada con éxito";
                $mensaje[0]["icon"]    = "success";
                echo json_encode($mensaje);
            } else {
                $mensaje[0]["mensaje"] = "Ocurrió un error al tratar de cerrar la solicitud.
             Póngase em contácto con el administrador";
                $mensaje[0]["icon"] = "error";
                echo json_encode($mensaje);
            }
        } catch (Exception $ex) {
            $mensaje[0]["mensaje"] = "Ocurrió un error al tratar de cerrar la solicitud. " . $ex->getMessage();
            $mensaje[0]["icon"]    = "error";
            echo json_encode($mensaje);
        }
    }

    public function addItemOP($enc, $detalle)
    {
        $mensaje        = array();
        $atencionValida = "";

        $atencionValida = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "'
                                      AND IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ");
        if ($atencionValida->num_rows() > 0) {

            try {
                $this->db->where("IdOrdenPago", $enc[1]);
                $up = array(
                    "Cantidad"     => $enc[2],
                    "CantidadDesc" => $enc[3],
                );

                $this->db->update("OrdenPago", $up);

                $bandera1 = false;
                //$idEnc = $idencOp->result_array()[0]["IdOrdenPago"];
                $det = json_decode($detalle, true);
                foreach ($det as $obj) {
                    $idDet     = $this->db->query("SELECT ISNULL(MAX(IdDetalleOP),0)+1 AS IdDetalleOP FROM DetalleOrdenPago");
                    $insertDet = array(
                        "IdDetalleOP"        => $idDet->result_array()[0]["IdDetalleOP"],
                        "IdOrdenPago"        => $enc[1],
                        "IdDetalleSolicitud" => $obj[16],
                        //"IdArticulo" => "",
                        "Estado"             => "A",
                        "Articulo"           => $obj[1],
                        "ArticuloProveedor"  => $obj[2],
                        "NumProforma"        => $obj[3],
                        "UnidadMedida"       => $obj[4],
                        "Cantidad"           => $obj[6],
                        "PrecioAntDescuento" => $obj[7],
                        "PorcentDescuento"   => $obj[8],
                        "MontoDesc"          => $obj[9],
                        "CodImpuesto"        => $obj[10],
                        "PorcentImpuesto"    => $obj[11],
                        "Moneda"             => $obj[12],
                        //"ISC" => $obj[],
                        "IVA"                => $obj[13],
                        "SubTotal"           => $obj[14],
                        "Total"              => $obj[15],
                    );
                    $guardarDet = $this->db->insert("DetalleOrdenPago", $insertDet);
                    if ($guardarDet) {
                        $bandera1 = true;
                    }
                }

                if ($bandera1) {
                    $mensaje[0]["mensaje"] = "Articulo(s) agregado(s) con éxito.";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }

            } catch (Exception $ex) {
                // $mensaje[0]["mensaje"] = "Guardando Orden de Pago primera vez";
                $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                $mensaje[0]["tipo"]    = "info";
                echo json_encode($mensaje);
            }
        } else {
            $mensaje[0]["mensaje"] = "No se puede guardar esta Orden de Pago porque otro usuario ya esta atendiendo esta solicitud";
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
    }

    public function addItemOC($enc, $detalle)
    {
        $mensaje        = array();
        $atencionValida = "";

        $atencionValida = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "'
                                      AND IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ");
        if ($atencionValida->num_rows() > 0) {

            try {

                $bandera1 = false;
                //$idEnc = $idencOc->result_array()[0]["IdOrdenCompra"];
                $det = json_decode($detalle, true);
                foreach ($det as $obj) {
                    $idDet     = $this->db->query("SELECT ISNULL(MAX(IdDetalleOC),0)+1 AS IdDetalleOC FROM DetalleOrdenCompra");
                    $insertDet = array(
                        "IdDetalleOC"        => $idDet->result_array()[0]["IdDetalleOC"],
                        "IdOrdenCompra"      => $enc[1],
                        "IdDetalleSolicitud" => $obj[16],
                        //"IdArticulo" => "",
                        "Estado"             => "A",
                        "Articulo"           => $obj[1],
                        "ArticuloProveedor"  => $obj[2],
                        "NumProforma"        => $obj[3],
                        "UnidadMedida"       => $obj[4],
                        "Cantidad"           => $obj[6],
                        "PrecioAntDescuento" => $obj[7],
                        "PorcentDescuento"   => $obj[8],
                        "MontoDesc"          => $obj[9],
                        "CodImpuesto"        => $obj[10],
                        "PorcentImpuesto"    => $obj[11],
                        "Moneda"             => $obj[12],
                        //"ISC" => $obj[],
                        "IVA"                => $obj[13],
                        "SubTotal"           => $obj[14],
                        "Total"              => $obj[15],
                    );
                    $guardarDet = $this->db->insert("DetalleOrdenCompra", $insertDet);
                    if ($guardarDet) {
                        $bandera1 = true;
                    }
                }

                if ($bandera1) {
                    $mensaje[0]["mensaje"] = "Orden Compra generada con éxito.";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }

            } catch (Exception $ex) {
                // $mensaje[0]["mensaje"] = "Guardando Orden de Compra primera vez";
                $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                $mensaje[0]["tipo"]    = "info";
                echo json_encode($mensaje);
            }
        } else {
            $mensaje[0]["mensaje"] = "No se puede guardar esta Orden de Compra porque otro usuario ya esta atendiendo esta solicitud";
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }

    }

    public function addItemCH($enc, $detalle)
    {
        $mensaje        = array();
        $atencionValida = "";

        $atencionValida = $this->db->query("SELECT IdUsuarioAtencion FROM Solicitudes
                                      WHERE IdSolicitud = '" . $enc[0] . "'
                                      AND IdUsuarioAtencion = '" . $this->session->userdata("id") . "' ");
        if ($atencionValida->num_rows() > 0) {

            try {
                $this->db->where("IdCajaChica", $enc[6]);
                $up = array(
                    "Total" => $enc[5],
                );

                $this->db->update("CajaChica", $up);

                $bandera1 = false;
                //$idEnc = $idencOp->result_array()[0]["IdCajaChica"];
                $det = json_decode($detalle, true);
                foreach ($det as $obj) {
                    $idDet     = $this->db->query("SELECT ISNULL(MAX(idDetCH),0)+1 AS idDetCH FROM DetalleCajaChica");
                    $insertDet = array(
                        "idDetCH"            => $idDet->result_array()[0]["idDetCH"],
                        "IdCajaChica"        => $enc[6],
                        "IdDetalleSolicitud" => $obj[16],
                        //"IdArticulo" => "",
                        "Estado"             => "A",
                        "Articulo"           => $obj[1],
                        "ArticuloProveedor"  => $obj[2],
                        "NumFactura"         => $obj[3],
                        "UnidadMedida"       => $obj[4],
                        "Cantidad"           => $obj[6],
                        "PrecioAntDescuento" => $obj[7],
                        "PorcentDescuento"   => $obj[8],
                        "MontoDesc"          => $obj[9],
                        "CodImpuesto"        => $obj[10],
                        "PorcentImpuesto"    => $obj[11],
                        "Moneda"             => $obj[12],
                        //"ISC" => $obj[],
                        "IVA"                => $obj[13],
                        "SubTotal"           => $obj[14],
                        "Total"              => $obj[15],
                    );
                    $guardarDet = $this->db->insert("DetalleCajaChica", $insertDet);
                    if ($guardarDet) {
                        $bandera1 = true;
                    }
                }

                if ($bandera1) {
                    $mensaje[0]["mensaje"] = "Articulo(s) agregado(s) con éxito.";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }

            } catch (Exception $ex) {
                // $mensaje[0]["mensaje"] = "Guardando Orden de Pago primera vez";
                $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
                $mensaje[0]["tipo"]    = "info";
                echo json_encode($mensaje);
            }
        } else {
            $mensaje[0]["mensaje"] = "No se puede guardar esta Orden de Pago porque otro usuario ya esta atendiendo esta solicitud";
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
    }

    public function bajaSolicitud($idSolicitud)
    {
        $this->db->trans_begin();
        $mensaje     = array();
        $bandera     = false;
        $arrayCorreo = array();
        try {

            //dar de baja si no tiene ninguna orden
            $this->db->where("IdSolicitud", $idSolicitud);
            $data = array(
                "Estado"           => "I",
                "EstadoAutorizado" => "N",
                "FechaBaja"        => date("Y-m-d H:i:s"),
                "IdUsuarioBaja"    => $this->session->userdata("id"),
            );

            $baja = $this->db->update("Solicitudes", $data);
            if ($baja) {
                $this->db->where("IdSolicitud", $idSolicitud);
                $data = array(
                    "EstadoAutorizado" => "N",
                );

                $baja1 = $this->db->update("DetalleSolicitud", $data);
                if ($baja1) {
                    $bandera = true;
                } else {
                    $bandera               = false;
                    $mensaje[0]["mensaje"] = "Error al intentar dar de baja la solicitud. COD 2 (DET)";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                }
            } else {
                $bandera               = false;
                $mensaje[0]["mensaje"] = "Error al intentar dar de baja la solicitud. COD 1 (ENC)";
                $mensaje[0]["tipo"]    = "success";
                echo json_encode($mensaje);
            }

            if ($bandera) {
                /**************VERIFICAR CORREOS DE USUARIO AL QUE SE LE RECHAZA***************** */
                $correos = $this->db->query("select t1.Correo from Solicitudes t0
                inner join Usuarios t1 on t0.IdUsuario = t1.IdUsuario
                where t0.IdSolicitud = '" . $idSolicitud . "' ");
                foreach ($correos->result_array() as $key) {
                    $arrayCorreo[] = $key["Correo"];
                }
                /********************************************************************************************** */
                $mensaje[0]["mensaje"] = "Datos de la solicitud actualizados con éxito";
                $mensaje[0]["tipo"]    = "success";
                $mensaje[0]["correo"]  = $arrayCorreo;
                echo json_encode($mensaje);
            }

        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function bajaOrden($idOrden, $tipo)
    {
        $this->db->trans_begin();
        $mensaje = array();
        $bandera = false;
        try {
            if ($tipo == 1) {
                $this->db->where("IdOrdenCompra", $idOrden);
                $data = array(
                    "Estado" => "I",
                );
                $enc = $this->db->update("OrdenCompra", $data);
                if ($enc) {
                    $this->db->where("IdOrdenCompra", $idOrden);
                    $datadet = array(
                        "Estado" => "I",
                    );
                    $det = $this->db->update("DetalleOrdenCompra", $datadet);
                    if ($det) {
                        $bandera = true;
                    }
                }
                if ($bandera) {
                    $mensaje[0]["mensaje"] = "Datos de orden actualizados!";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Ocurrio un error al intentar dar de baja la orden";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }
            } else if ($tipo == 2) {
                $this->db->where("IdOrdenPago", $idOrden);
                $dataop = array(
                    "Estado" => "I",
                );
                $enc = $this->db->update("OrdenPago", $dataop);
                if ($enc) {
                    $this->db->where("IdOrdenPago", $idOrden);
                    $datadetop = array(
                        "Estado" => "I",
                    );
                    $det = $this->db->update("DetalleOrdenPago", $datadetop);
                    if ($det) {
                        $bandera = true;
                    }
                }
                if ($bandera) {
                    $mensaje[0]["mensaje"] = "Datos de orden actualizados!";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Ocurrio un error al intentar dar de baja la orden";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }
            } else if ($tipo == 3) {
                $this->db->where("IdCajaChica", $idOrden);
                $dataop = array(
                    "Estado" => "I",
                );
                $enc = $this->db->update("CajaChica", $dataop);
                if ($enc) {
                    $this->db->where("IdCajaChica", $idOrden);
                    $datadetop = array(
                        "Estado" => "I",
                    );
                    $det = $this->db->update("DetalleCajaChica", $datadetop);
                    if ($det) {
                        $bandera = true;
                    }
                }
                if ($bandera) {
                    $mensaje[0]["mensaje"] = "Datos de caja chica actualizados!";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Ocurrio un error al intentar dar de baja la orden";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }
            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function bajaOrdenArticulos($idDetalle, $tipo)
    {
        $this->db->trans_begin();
        $mensaje = array();
        $bandera = false;
        try {
            if ($tipo == 1) {
                $this->db->where("IdDetalleOC", $idDetalle);
                $datadet = array(
                    "Estado" => "I",
                );
                $det = $this->db->update("DetalleOrdenCompra", $datadet);
                if ($det) {
                    $bandera = true;
                }
                if ($bandera) {
                    $mensaje[0]["mensaje"] = "Artículo dado de baja con éxito!";
                    $mensaje[0]["tipo"]    = "success";
                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Ocurrio un error al intentar dar de baja la orden";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }

            } else if ($tipo == 2) {
                //actualizar total de encabezado
                $CantEnc = "";
                $this->db->where("IdDetalleOP", $idDetalle);
                $datadetop = array(
                    "Estado" => "I", // cambiar estado a I
                );
                $det = $this->db->update("DetalleOrdenPago", $datadetop);
                if ($det) {
                    $bandera = true;
                }
                if ($bandera) {
                    $numero = $this->db->query("SELECT ISNULL(SUM(Total),0) as numero,Moneda FROM DetalleOrdenPago
                                                 WHERE IdOrdenPago = (SELECT IdOrdenPago FROM DetalleOrdenPago WHERE IdDetalleOP = " . $idDetalle . ") and Estado = 'A' group by Moneda");

                    $this->load->library("modelonumero");
                    $moneda = "";
                    if (@$numero->result_array()[0]["Moneda"] == "C") {
                        $moneda = "Cordobas";
                    } else if (@$numero->result_array()[0]["Moneda"] == "S") {
                        $moneda = "Dolares";
                    }
                    $num = $this->modelonumero->numtoletras(@$numero->result_array()[0]["numero"], $moneda, 'centavos');

                    $CantEnc = $this->db->query("UPDATE
                    [dbo].[OrdenPago]
                    SET
                    Cantidad = (
                    SELECT ISNULL(SUM(Total),0) FROM DetalleOrdenPago WHERE IdOrdenPago = (
                     SELECT IdOrdenPago FROM DetalleOrdenPago WHERE IdDetalleOP = " . $idDetalle . "
                    )
                    and Estado = 'A' ),
                    CantidadDesc = '" . $num . "'
                    WHERE
                    IdOrdenPago = ( SELECT IdOrdenPago FROM DetalleOrdenPago WHERE IdDetalleOP = " . $idDetalle . " )");
                    //echo $this->db->last_query();
                    if ($CantEnc) {
                        $mensaje[0]["mensaje"] = "Artículo dado de baja con éxito!";
                        $mensaje[0]["tipo"]    = "success";
                        echo json_encode($mensaje);
                    }
                } else {
                    $mensaje[0]["mensaje"] = "Ocurrio un error al intentar dar de baja la orden";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }

            } else if ($tipo == 3) {
                $this->db->where("idDetCH", $idDetalle);
                $datadet = array(
                    "Estado" => "I",
                );
                $det = $this->db->update("DetalleCajaChica", $datadet);
                if ($det) {
                    $bandera = true;
                }
                if ($bandera) {
                    $CantEncCH = $this->db->query("UPDATE
                                        [dbo].[CajaChica]
                                        SET
                                        Total = (
                                        SELECT ISNULL(SUM(Total),0) FROM DetalleCajaChica WHERE IdCajaChica = (
                                        SELECT IdCajaChica FROM DetalleCajaChica WHERE idDetCH = " . $idDetalle . "
                                        )
                                        and Estado = 'A' )
                                        WHERE
                                        IdCajaChica = ( SELECT IdCajaChica FROM DetalleCajaChica WHERE idDetCH = " . $idDetalle . " )");

                    if ($CantEncCH) {
                        $mensaje[0]["mensaje"] = "Artículo caja chica dado de baja con éxito!";
                        $mensaje[0]["tipo"]    = "success";
                        echo json_encode($mensaje);
                    }
                } else {
                    $mensaje[0]["mensaje"] = "Ocurrio un error al intentar dar de baja la orden";
                    $mensaje[0]["tipo"]    = "error";
                    echo json_encode($mensaje);
                }

            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
            $mensaje[0]["tipo"]    = "error";
            echo json_encode($mensaje);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function rptOrdenesHistorial($start, $length, $search, $cons, $fechaInicio, $fechaFinal, $proveedor)
    {
        $fechasFilter = ($fechaInicio != "" && $fechaFinal != "") ? "where cast(FechaCrea as date) >= '" . $fechaInicio . "' and cast(FechaCrea as date) <= '" . $fechaFinal . "' " : "";
        $consFilter   = ($cons != "") ? "and Consecutivo like '%" . $cons . "%' " : "";
        $provFilter   = ($proveedor != "") ? "and IdProveedor = '" . $proveedor . "' " : "";
        $srch         = "";

        if ($search) {
            $srch = "AND (
                       Consecutivo like '%" . $search . "%' OR
                       IdProveedor like '%" . $search . "%' OR
                       Proveedor like '%" . $search . "%' OR
                       ConsecutivoOrden like '%" . $search . "%' OR
                       CAST(FechaCrea AS DATE) like '%" . $search . "%' OR
                       Concepto like '%" . $search . "%' OR
                       Nombre like '%" . $search . "%'
                    ) ";
        }

        $qnr = "select COUNT(*) as Cantidad from
                (
                    select t2.Consecutivo,t1.IdOrdenCompra as IdOrden,t1.IdSolicitud,t1.IdProveedor,t1.Proveedor,
                    t1.ConsecutivoOC as ConsecutivoOrden,t1.FechaCrea,t1.Direccion as Concepto,t1.Estado,t3.Nombre
                    from OrdenCompra t1
                    inner join Solicitudes t2 on t1.IdSolicitud = t2.IdSolicitud
                    inner join Usuarios t3 on t1.IdUsuarioCrea = t3.IdUsuario
                    union
                    select t2.Consecutivo,t1.IdOrdenPago,t1.IdSolicitud,t1.IdProveedor,t1.Proveedor,
                    t1.ConsecutivoOP,t1.FechaCrea,t1.Concepto,t1.Estado,t3.Nombre
                    from OrdenPago t1
                    inner join Solicitudes t2 on t1.IdSolicitud = t2.IdSolicitud
                    inner join Usuarios t3 on t1.IdUsuarioCrea = t3.IdUsuario
                    union
                    select t2.Consecutivo,t1.IdCajaChica,t1.IdSolicitud,t1.IdProveedor,t1.Proveedor,
                    t1.consecutivoCH,t1.fechaCrea,t1.Concepto,t1.Estado,t3.Nombre
                    from CajaChica t1
                    inner join Solicitudes t2 on t1.IdSolicitud = t2.IdSolicitud
                    inner join Usuarios t3 on t1.IdUsuarioCrea = t3.IdUsuario
                ) as tabla " . $fechasFilter . " " . $consFilter . " " . $provFilter . " " . $srch . " ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if ($length == -1) {
            $q = $this->db->query("select * from
                                    (
                                        select t2.Consecutivo,t1.IdOrdenCompra as IdOrden,t1.IdSolicitud,t1.IdProveedor,t1.Proveedor,
                                        t1.ConsecutivoOC as ConsecutivoOrden,t1.FechaCrea,t1.Direccion as Concepto,t1.Estado,t3.Nombre
                                        from OrdenCompra t1
                                        inner join Solicitudes t2 on t1.IdSolicitud = t2.IdSolicitud
                                        inner join Usuarios t3 on t1.IdUsuarioCrea = t3.IdUsuario
                                        union
                                        select t2.Consecutivo,t1.IdOrdenPago,t1.IdSolicitud,t1.IdProveedor,t1.Proveedor,
                                        t1.ConsecutivoOP,t1.FechaCrea,t1.Concepto,t1.Estado,t3.Nombre
                                        from OrdenPago t1
                                        inner join Solicitudes t2 on t1.IdSolicitud = t2.IdSolicitud
                                        inner join Usuarios t3 on t1.IdUsuarioCrea = t3.IdUsuario
                                        union
                                        select t2.Consecutivo,t1.IdCajaChica,t1.IdSolicitud,t1.IdProveedor,t1.Proveedor,
                                        t1.consecutivoCH,t1.fechaCrea,t1.Concepto,t1.Estado,t3.Nombre
                                        from CajaChica t1
                                        inner join Solicitudes t2 on t1.IdSolicitud = t2.IdSolicitud
                                        inner join Usuarios t3 on t1.IdUsuarioCrea = t3.IdUsuario
                                    ) as tabla " . $fechasFilter . " " . $consFilter . " " . $provFilter . " " . $srch . "
                                    order by IdSolicitud");
        } else {
            $q = $this->db->query("select * from
                                    (
                                        select t2.Consecutivo,t1.IdOrdenCompra as IdOrden,t1.IdSolicitud,t1.IdProveedor,t1.Proveedor,
                                        t1.ConsecutivoOC as ConsecutivoOrden,t1.FechaCrea,t1.Direccion as Concepto,t1.Estado,t3.Nombre
                                        from OrdenCompra t1
                                        inner join Solicitudes t2 on t1.IdSolicitud = t2.IdSolicitud
                                        inner join Usuarios t3 on t1.IdUsuarioCrea = t3.IdUsuario
                                        union
                                        select t2.Consecutivo,t1.IdOrdenPago,t1.IdSolicitud,t1.IdProveedor,t1.Proveedor,
                                        t1.ConsecutivoOP,t1.FechaCrea,t1.Concepto,t1.Estado,t3.Nombre
                                        from OrdenPago t1
                                        inner join Solicitudes t2 on t1.IdSolicitud = t2.IdSolicitud
                                        inner join Usuarios t3 on t1.IdUsuarioCrea = t3.IdUsuario
                                        union
                                        select t2.Consecutivo,t1.IdCajaChica,t1.IdSolicitud,t1.IdProveedor,t1.Proveedor,
                                        t1.consecutivoCH,t1.fechaCrea,t1.Concepto,t1.Estado,t3.Nombre
                                        from CajaChica t1
                                        inner join Solicitudes t2 on t1.IdSolicitud = t2.IdSolicitud
                                        inner join Usuarios t3 on t1.IdUsuarioCrea = t3.IdUsuario
                                    ) as tabla " . $fechasFilter . " " . $consFilter . " " . $provFilter . " " . $srch . "
                                    order by IdSolicitud
                                    offset " . $start . " rows fetch next " . $length . " rows only;");
        }

        $retornar = array(
            "numDataTotal" => $qnr,
            "datos"        => $q,
        );
        return $retornar;
    }
}

/* End of file Compras_model.php */
