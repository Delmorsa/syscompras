<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bodega_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function mostrarOCBodega($start,$length,$search){
		$srch = "";
		$filter = "";
		if($search){
			$srch = "AND (
                      t2.NombreArea like '%".$search."%' OR
                      t3.Nombre like '%".$search."%' OR
                      t1.Consecutivo like '%".$search."%' OR 
                      t0.ConsecutivoOC like '%".$search."%' OR
                      t0.Proveedor like '%".$search."%' OR 
                      t0.Direccion like '%".$search."%' OR 
                      t0.TiempoEntrega like '%".$search."%' 
                    ) ";
		}

		$qnr = "select count(t0.IdOrdenCompra) as Cantidad FROM OrdenCompra t0 
										LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
                                        inner join Areas t2 on t1.IdArea = t2.IdArea
                                        inner join Usuarios t3 on t1.IdUsuario = t3.IdUsuario
                                        inner join Usuarios t4 on t0.IdUsuarioCrea = t4.IdUsuario
                                        where t0.Estado =  'A'
                                         ".$srch." ";

		$qnr = $this->db->query($qnr);
		$qnr = $qnr->result_array()[0]["Cantidad"];

		if($length == -1){
			$q = $this->db->query("SELECT t0.IdOrdenCompra,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
                                        t0.ConsecutivoOC,t0.Proveedor,t0.Direccion,t0.TiempoEntrega,t0.FechaCrea,
                                        t2.NombreArea,t3.Nombre,t3.Correo,t4.Correo as CorreoCompra,t4.Nombre as Personal,
                                        (select SUM(Total) from DetalleOrdenCompra where IdOrdenCompra = t0.IdOrdenCompra) as Total
                                        FROM OrdenCompra t0 
                                        LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
                                        inner join Areas t2 on t1.IdArea = t2.IdArea
                                        inner join Usuarios t3 on t1.IdUsuario = t3.IdUsuario                                        
										inner join Usuarios t4 on t0.IdUsuarioCrea = t4.IdUsuario
                                        where t0.Estado =  'A'
										".$srch." 
										ORDER BY t0.IdOrdenCompra asc");
		}else{
			$q = $this->db->query("SELECT t0.IdOrdenCompra,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
                                        t0.ConsecutivoOC,t0.Proveedor,t0.Direccion,t0.TiempoEntrega,t0.FechaCrea,
                                        t2.NombreArea,t3.Nombre,t3.Correo,t4.Correo as CorreoCompra,t4.Nombre as Personal,
                                        (select SUM(Total) from DetalleOrdenCompra where IdOrdenCompra = t0.IdOrdenCompra) as Total
                                        FROM OrdenCompra t0 
                                        LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
                                        inner join Areas t2 on t1.IdArea = t2.IdArea
                                        inner join Usuarios t3 on t1.IdUsuario = t3.IdUsuario                                        
                                        inner join Usuarios t4 on t0.IdUsuarioCrea = t4.IdUsuario
                                        where t0.Estado =  'A'
                                        ".$srch." 
                                        ORDER BY t0.IdOrdenCompra asc
                                        offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
	}
    

    public function getDetOrdenOC($idOrdenOc,$start,$length,$search){
        $srch = "";
		if($search){
			$srch = "AND (
                      IdArticulo like '%".$search."%' OR
                      ArticuloProveedor like '%".$search."%' OR
                      NumProforma like '%".$search."%' OR 
                      UnidadMedida like '%".$search."%' OR
                      Cantidad like '%".$search."%' OR 
                      SubTotal like '%".$search."%' OR 
                      Total like '%".$search."%' 
                    ) ";
		}

		$qnr = "select count(IdDetalleOC) as Cantidad FROM DetalleOrdenCompra ".$srch." ";

		$qnr = $this->db->query($qnr);
		$qnr = $qnr->result_array()[0]["Cantidad"];

		if($length == -1){
			$q = $this->db->query("SELECT IdDetalleOC,IdOrdenCompra,IdDetalleSolicitud,IdArticulo,ArticuloProveedor,NumProforma,
                                  UnidadMedida,Cantidad,CantidadRecibida,PrecioAntDescuento,MontoDesc,CodImpuesto,Moneda,IVA,SubTotal,Total,
                                  Comentarios
                                  FROM DetalleOrdenCompra
                                  where IdOrdenCompra = '".$idOrdenOc."' 
                                  and Estado in ('A','B','P')
								  ".$srch." 
								  ORDER BY IdDetalleOC asc");
		}else{
			$q = $this->db->query("SELECT IdDetalleOC,IdOrdenCompra,IdDetalleSolicitud,IdArticulo,ArticuloProveedor,NumProforma,
                                    UnidadMedida,Cantidad,CantidadRecibida,PrecioAntDescuento,MontoDesc,CodImpuesto,Moneda,IVA,SubTotal,Total,
                                    Comentarios
                                    FROM DetalleOrdenCompra
                                    where IdOrdenCompra = '".$idOrdenOc."' 
                                    and Estado in ('A','B','P')
                                    ".$srch." 
                                    ORDER BY IdDetalleOC asc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    public function recepcionarArticulos($idSolicitud,$detalle,$tipo){
        $this->db->trans_begin();
        $mensaje = array();
        $bandera = false; $cerrarOrden = false;
        try {
            if($tipo == 1){
                $det = json_decode($detalle, true);
                $idOC = "";
                foreach ($det as $obj) {
                    $idOC = $obj[4];
                    $this->db->where("IdDetalleOC", $obj[0]);
               
                    $dataOC = array(
                        "CantidadRecibida" => $obj[1],
                        "Comentarios" => $obj[2],
                        "Estado" => $obj[3]
                    ); 
                    $upOC = $this->db->update("DetalleOrdenCompra", $dataOC);
                    
                    if($upOC){
                       $bandera = true;
                    }
                }
                if($bandera){
                    $buscarParcial = $this->db->query("SELECT COUNT(t1.IdDetalleOC) as cantidad
                                    FROM OrdenCompra t0
                                    inner join DetalleOrdenCompra t1 on t1.IdOrdenCompra = t0.IdOrdenCompra
                                    where t1.Estado <> 'B' and t1.Estado <> 'I' and t0.IdOrdenCompra = '".$idOC."' ");
                    
                    if($buscarParcial->result_array()[0]["cantidad"] == 0){
                        $this->db->where("IdOrdenCompra",$idOC);
                        $data = array(
                            "Estado" => 'B'
                        );
                        $up = $this->db->update("OrdenCompra", $data);
                        if($up){
                            $cerrarOrden = true;
                        }
                    }

                    if(!$cerrarOrden){
                        $mensaje[0]["mensaje"] = "Recepción de articulos exitosa. La orden de compra se cerrará una vez se recepcionen todos los artículos";
                        $mensaje[0]["icon"] = "success";
                        $mensaje[0]["cerrar"] = false;
                        echo json_encode($mensaje);
                    }
                }
            }elseif ($tipo == 2) {
                $detOP = json_decode($detalle, true);
                $idOP = "";
                foreach ($detOP as $obj) {
                    $idOP = $obj[4];
                    $this->db->where("IdDetalleOP", $obj[0]);
               
                    $dataOP = array(
                        "CantidadRecibida" => $obj[1],
                        "Comentarios" => $obj[2],
                        "Estado" => $obj[3]
                    ); 
                    $upOP = $this->db->update("DetalleOrdenPago", $dataOP);
                    
                    if($upOP){
                       $bandera = true;
                    }
                }
                if($bandera){
                    $buscarParcial = $this->db->query("SELECT COUNT(t1.IdDetalleOP) as cantidad
                                    FROM OrdenPago t0
                                    inner join DetalleOrdenPago t1 on t1.IdOrdenPago = t0.IdOrdenPago
                                    where t1.Estado <> 'B' and t1.Estado <> 'I' and t0.IdOrdenPago = '".$idOP."' ");
                    
                    if($buscarParcial->result_array()[0]["cantidad"] == 0){
                        $this->db->where("IdOrdenPago",$idOP);
                        $data = array(
                            "Estado" => 'B'
                        );
                        $up = $this->db->update("OrdenPago", $data);
                        if($up){
                            $cerrarOrden = true;
                        }
                    }

                    if(!$cerrarOrden){
                        $mensaje[0]["mensaje"] = "Recepción de articulos exitosa. La orden de pago se cerrará una vez se recepcionen todos los artículos";
                        $mensaje[0]["icon"] = "success";
                        $mensaje[0]["cerrar"] = false;
                        echo json_encode($mensaje);
                    }
                }
            }elseif ($tipo == 3) {
                $detCH = json_decode($detalle, true);
                $idCH = "";
                foreach ($detCH as $obj) {
                    $idCH = $obj[4];
                    $this->db->where("idDetCH", $obj[0]);
               
                    $dataCH = array(
                        "CantidadRecibida" => $obj[1],
                        "Comentarios" => $obj[2],
                        "Estado" => $obj[3]
                    ); 
                    $upCH = $this->db->update("DetalleCajaChica", $dataCH);
                    
                    if($upCH){
                       $bandera = true;
                    }
                }
                if($bandera){
                    $buscarParcial = $this->db->query("SELECT COUNT(t1.idDetCH) as cantidad
                                    FROM CajaChica t0
                                    inner join DetalleCajaChica t1 on t1.IdCajaChica = t0.IdCajaChica
                                    where t1.Estado <> 'B' and t1.Estado <> 'I' and t0.IdCajaChica = '".$idCH."' ");
                    
                    if($buscarParcial->result_array()[0]["cantidad"] == 0){
                        $this->db->where("IdCajaChica",$idCH);
                        $data = array(
                            "Estado" => 'B'
                        );
                        $up = $this->db->update("CajaChica", $data);
                        if($up){
                            $cerrarOrden = true;
                        }
                    }

                    if(!$cerrarOrden){
                        $mensaje[0]["mensaje"] = "Recepción de articulos exitosa. La caja chica se cerrará una vez se recepcionen todos los artículos";
                        $mensaje[0]["icon"] = "success";
                        $mensaje[0]["cerrar"] = false;
                        echo json_encode($mensaje);
                    }
                }
            }

            if($cerrarOrden){
                $cerrarSolicitud = $this->db->query("SELECT IdSolicitud,Consecutivo,DescripcionSolicitud,
                                (select COUNT(IdOrdenCompra) from OrdenCompra where IdSolicitud = '".$idSolicitud."' and Estado <> 'B' and Estado <> 'I') as OC,
                                (select COUNT(IdOrdenPago) from OrdenPago where IdSolicitud = '".$idSolicitud."' and Estado <> 'B' and Estado <> 'I') as OP,
                                (select COUNT(IdCajaChica) from CajaChica where IdSolicitud = '".$idSolicitud."' and Estado <> 'B' and Estado <> 'I') as CH
                                from Solicitudes
                                where IdSolicitud = '".$idSolicitud."' ");

                $itemsDisponibles = $this->db->query("select sum(CantidadDisponible) CantidadDisponible from (select 
                t1.CantidadAut-(isnull(sum(t2.Cantidad),0)+isnull(sum(t4.Cantidad),0)+isnull(SUM(t6.Cantidad),0)) as CantidadDisponible
                from Solicitudes t0
                inner join DetalleSolicitud t1 on t1.IdSolicitud = t0.IdSolicitud
                left join DetalleOrdenPago t2 on t2.IdDetalleSolicitud = t1.IdDetallesSolicitud and (t2.Estado  is null or t2.Estado in ('A','B','P') )
                left join OrdenPago t3 on t2.IdOrdenPago = t3.IdOrdenPago
                left join DetalleOrdenCompra t4 on t4.IdDetalleSolicitud = t1.IdDetallesSolicitud AND (t4.Estado is null or t4.Estado in ('A','B','P'))
                left join OrdenCompra t5 on t4.IdOrdenCompra= t5.IdOrdenCompra
                left join DetalleCajaChica t6 on t6.IdDetalleSolicitud = t1.IdDetallesSolicitud AND (t6.Estado is null or t6.Estado in ('A','B','P'))
                left join CajaChica t7 on t6.IdCajaChica= t7.IdCajaChica
                where t0.IdSolicitud = '".$idSolicitud."' AND t1.EstadoAutorizado = 'Y'
                group by t1.IdDetallesSolicitud,t1.IdSolicitud,t1.CantidadSolicitud,t1.UnidadMedida,
                t1.CantidadAut,t1.DescripcionArticulo,t1.EstadoAutorizado 
                having t1.CantidadAut-(isnull(sum(t2.Cantidad),0)+isnull(sum(t4.Cantidad),0)+isnull(SUM(t6.Cantidad),0)) <> 0
                ) as tabla");

                if($cerrarSolicitud->result_array()[0]["OC"] == 0 && $cerrarSolicitud->result_array()[0]["OP"] == 0 
                && $cerrarSolicitud->result_array()[0]["CH"] == 0 && $itemsDisponibles->result_array()[0]["CantidadDisponible"] == 0){
                    $this->db->where("IdSolicitud", $idSolicitud);
                    $dataSol = array(
                        "Estado" => "S",
                        "FechaCierre" => date("Y-m-d H:i:s")
                    );
                    $upSolic = $this->db->update("Solicitudes", $dataSol);
                    if($upSolic){
                        $mensaje[0]["mensaje"] = "Solicitud cerrada con éxito!";
                        $mensaje[0]["icon"] = "success";
                        $mensaje[0]["cerrar"] = true;
                        echo json_encode($mensaje);
                    }else{
                        $mensaje[0]["mensaje"] = "Error al cerrar la solicitud póngase en contacto con el administrador";
                        $mensaje[0]["icon"] = "error";
                        $mensaje[0]["cerrar"] = false;
                        echo json_encode($mensaje);
                    }
                }else{
                    if($itemsDisponibles->result_array()[0]["CantidadDisponible"] > 0){
                        $mensaje[0]["mensaje"] = "Recepción de articulos exitosa. Orden cerrada!. No se pudo cerrar la solicitud porque tiene artículos con existencias";
                        $mensaje[0]["icon"] = "success";
                        $mensaje[0]["cerrar"] = false;
                        echo json_encode($mensaje);
                    }else{
                        $mensaje[0]["mensaje"] = "Recepción de articulos exitosa. Orden cerrada!";
                        $mensaje[0]["icon"] = "success";
                        $mensaje[0]["cerrar"] = false;
                        echo json_encode($mensaje);
                    }
                }
            }

        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage(). "... Código ".$ex->getCode();
            $mensaje[0]["icon"] = "error";
            $mensaje[0]["cerrar"] = false;
            echo json_encode($mensaje);
        }

       if ($this->db->trans_status() === FALSE){
               $this->db->trans_rollback();
       }else{
               $this->db->trans_commit();
       }
    }

    /************************************************************************************************ */

    public function mostrarOPBodega($start,$length,$search){
		$srch = "";
		$filter = "";
		if($search){
			$srch = "AND (
                      t2.NombreArea like '%".$search."%' OR
                      t3.Nombre like '%".$search."%' OR
                      t1.Consecutivo like '%".$search."%' OR 
                      t0.ConsecutivoOP like '%".$search."%' OR
                      t0.Proveedor like '%".$search."%' OR 
                      t0.NombreCheque like '%".$search."%' OR 
                      t0.Concepto like '%".$search."%' 
                    ) ";
		}

		$qnr = "select count(t0.IdOrdenPago) as Cantidad FROM OrdenPago t0 
                LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
                inner join Areas t2 on t1.IdArea = t2.IdArea
                inner join Usuarios t3 on t1.IdUsuario = t3.IdUsuario
                inner join Usuarios t4 on t0.IdUsuarioCrea = t4.IdUsuario
                where t0.Estado =  'A'
                ".$srch." ";

		$qnr = $this->db->query($qnr);
		$qnr = $qnr->result_array()[0]["Cantidad"];

		if($length == -1){
			$q = $this->db->query("SELECT t0.IdOrdenPago,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
                                    t0.ConsecutivoOP,t0.Proveedor,t0.NombreCheque,t0.Concepto,t0.FechaCrea,
                                    t2.NombreArea,t3.Nombre,t3.Correo,t4.Correo as CorreoCompra,t4.Nombre as Personal,
                                    (select SUM(Total) from DetalleOrdenPago where IdOrdenPago= t0.IdOrdenPago) as Total
                                    FROM OrdenPago t0 
                                    LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
                                    inner join Areas t2 on t1.IdArea = t2.IdArea
                                    inner join Usuarios t3 on t1.IdUsuario = t3.IdUsuario                                        
                                    inner join Usuarios t4 on t0.IdUsuarioCrea = t4.IdUsuario
                                    where t0.Estado =  'A'
										".$srch." 
										ORDER BY t0.IdOrdenPago asc");
		}else{
			$q = $this->db->query("SELECT t0.IdOrdenPago,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
                                    t0.ConsecutivoOP,t0.Proveedor,t0.NombreCheque,t0.Concepto,t0.FechaCrea,
                                    t2.NombreArea,t3.Nombre,t3.Correo,t4.Correo as CorreoCompra,t4.Nombre as Personal,
                                    (select SUM(Total) from DetalleOrdenPago where IdOrdenPago= t0.IdOrdenPago) as Total
                                    FROM OrdenPago t0 
                                    LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
                                    inner join Areas t2 on t1.IdArea = t2.IdArea
                                    inner join Usuarios t3 on t1.IdUsuario = t3.IdUsuario                                        
                                    inner join Usuarios t4 on t0.IdUsuarioCrea = t4.IdUsuario
                                    where t0.Estado =  'A'
                                        ".$srch." 
                                        ORDER BY t0.IdOrdenPago asc
                                        offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
	}

    public function getDetOrdenOP($idOrdenOp,$start,$length,$search){
        $srch = "";
		if($search){
			$srch = "AND (
                      IdArticulo like '%".$search."%' OR
                      ArticuloProveedor like '%".$search."%' OR
                      NumProforma like '%".$search."%' OR 
                      UnidadMedida like '%".$search."%' OR
                      Cantidad like '%".$search."%' OR 
                      SubTotal like '%".$search."%' OR 
                      Total like '%".$search."%' 
                    ) ";
		}

		$qnr = "select count(IdDetalleOC) as Cantidad FROM DetalleOrdenCompra ".$srch." ";

		$qnr = $this->db->query($qnr);
		$qnr = $qnr->result_array()[0]["Cantidad"];

		if($length == -1){
			$q = $this->db->query("SELECT IdDetalleOP,IdOrdenPago,IdDetalleSolicitud,IdArticulo,ArticuloProveedor,NumProforma,
                                  UnidadMedida,Cantidad,CantidadRecibida,PrecioAntDescuento,MontoDesc,CodImpuesto,Moneda,IVA,SubTotal,Total,
                                  Comentarios
                                  FROM DetalleOrdenPago
                                  where IdOrdenPago = '".$idOrdenOp."' 
                                  and Estado in ('A','B','P')
								  ".$srch." 
								  ORDER BY IdDetalleOP asc");
		}else{
			$q = $this->db->query("SELECT IdDetalleOP,IdOrdenPago,IdDetalleSolicitud,IdArticulo,ArticuloProveedor,NumProforma,
                                    UnidadMedida,Cantidad,CantidadRecibida,PrecioAntDescuento,MontoDesc,CodImpuesto,Moneda,IVA,SubTotal,Total,
                                    Comentarios
                                    FROM DetalleOrdenPago
                                    where IdOrdenPago = '".$idOrdenOp."' 
                                    and Estado in ('A','B','P')
                                    ".$srch." 
                                    ORDER BY IdDetalleOP asc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    /************************************************************************************************** */
    public function mostrarCHBodega($start,$length,$search){
		$srch = "";
		$filter = "";
		if($search){
			$srch = "AND (
                      t2.NombreArea like '%".$search."%' OR
                      t3.Nombre like '%".$search."%' OR
                      t1.Consecutivo like '%".$search."%' OR 
                      t0.ConsecutivoCH like '%".$search."%' OR
                      t0.Proveedor like '%".$search."%' OR 
                      t0.Concepto like '%".$search."%' 
                    ) ";
		}

		$qnr = "select count(t0.IdCajaChica) as Cantidad FROM CajaChica t0 
                LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
                inner join Areas t2 on t1.IdArea = t2.IdArea
                inner join Usuarios t3 on t1.IdUsuario = t3.IdUsuario
                inner join Usuarios t4 on t0.IdUsuarioCrea = t4.IdUsuario
                where t0.Estado =  'A'
                ".$srch." ";

		$qnr = $this->db->query($qnr);
		$qnr = $qnr->result_array()[0]["Cantidad"];

		if($length == -1){
			$q = $this->db->query("SELECT t0.IdCajaChica,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
                                    t0.consecutivoCH,t0.Proveedor,t0.fechaRecibo,t0.Concepto,t0.FechaCrea,
                                    t2.NombreArea,t3.Nombre,t3.Correo,t4.Correo as CorreoCompra,t4.Nombre as Personal,
                                    (select SUM(Total) from DetalleCajaChica where IdCajaChica= t0.IdCajaChica) as Total
                                    FROM CajaChica t0 
                                    LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
                                    inner join Areas t2 on t1.IdArea = t2.IdArea
                                    inner join Usuarios t3 on t1.IdUsuario = t3.IdUsuario                                        
                                    inner join Usuarios t4 on t0.IdUsuarioCrea = t4.IdUsuario
                                    where t0.Estado =  'A'
										".$srch." 
										ORDER BY t0.IdCajaChica asc");
		}else{
			$q = $this->db->query("SELECT t0.IdCajaChica,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
                                        t0.consecutivoCH,t0.Proveedor,t0.fechaRecibo,t0.Concepto,t0.FechaCrea,
                                        t2.NombreArea,t3.Nombre,t3.Correo,t4.Correo as CorreoCompra,t4.Nombre as Personal,
                                        (select SUM(Total) from DetalleCajaChica where IdCajaChica= t0.IdCajaChica) as Total
                                        FROM CajaChica t0 
                                        LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
                                        inner join Areas t2 on t1.IdArea = t2.IdArea
                                        inner join Usuarios t3 on t1.IdUsuario = t3.IdUsuario                                        
                                        inner join Usuarios t4 on t0.IdUsuarioCrea = t4.IdUsuario
                                        where t0.Estado =  'A'
                                        ".$srch." 
                                        ORDER BY t0.IdCajaChica asc
                                        offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
	}

    public function getDetOrdenCH($idOrdenCH,$start,$length,$search){
        $srch = "";
		if($search){
			$srch = "AND (
                      IdArticulo like '%".$search."%' OR
                      ArticuloProveedor like '%".$search."%' OR
                      NumFactura like '%".$search."%' OR 
                      UnidadMedida like '%".$search."%' OR
                      Cantidad like '%".$search."%' OR 
                      SubTotal like '%".$search."%' OR 
                      Total like '%".$search."%' 
                    ) ";
		}

		$qnr = "select count(idDetCH) as Cantidad FROM DetalleCajaChica ".$srch." ";

		$qnr = $this->db->query($qnr);
		$qnr = $qnr->result_array()[0]["Cantidad"];

		if($length == -1){
			$q = $this->db->query("SELECT idDetCH,IdCajaChica,IdDetalleSolicitud,IdArticulo,ArticuloProveedor,NumFactura,
                                  UnidadMedida,Cantidad,CantidadRecibida,PrecioAntDescuento,MontoDesc,CodImpuesto,Moneda,IVA,SubTotal,Total,
                                  Comentarios
                                  FROM DetalleCajaChica
                                  where IdCajaChica = '".$idOrdenCH."' 
                                  and Estado in ('A','B','P')
								  ".$srch." 
								  ORDER BY idDetCH asc");
		}else{
			$q = $this->db->query("SELECT idDetCH,IdCajaChica,IdDetalleSolicitud,IdArticulo,ArticuloProveedor,NumFactura,
                                    UnidadMedida,Cantidad,CantidadRecibida,PrecioAntDescuento,MontoDesc,CodImpuesto,Moneda,IVA,SubTotal,Total,
                                    Comentarios
                                    FROM DetalleCajaChica
                                    where IdCajaChica = '".$idOrdenCH."' 
                                    and Estado in ('A','B','P')
                                    ".$srch." 
                                    ORDER BY idDetCH asc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

}

/* End of file Bodega_model.php */

?>