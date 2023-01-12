<?php

class Documentos_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Managua");
		$this->load->database();
	}

	public function mostrarOPDoc($idUsuario,$start,$length,$search){
		$srch = "";
		$filter = "";
		$doc = "";
		if($search){
			$srch = "AND (
                      t1.Consecutivo like '%".$search."%' OR 
                      t0.ConsecutivoOP like '%".$search."%' OR
                      t0.Proveedor like '%".$search."%' OR 
                      t0.NombreCheque like '%".$search."%' OR
                      t0.Cantidad like '%".$search."%' OR 
                      t0.CantidadDesc like '%".$search."%' OR 
                      t0.Concepto like '%".$search."%' OR
                      t0.Retiene like '%".$search."%' OR
                      t0.ComentarioRetiene like '%".$search."%' OR
                      cast(t0.FechaCrea as date) like '%".$search."%' 
                    ) ";
		}

		if($this->session->userdata("IdRol") == 2){
			$doc = "INNER JOIN Usuarios t3 on t3.IdUsuario = t0.IdUsuarioCrea
			where t0.IdUsuarioCrea = '".$idUsuario."' and t0.Estado not in ('I')";
		}else if($this->session->userdata("IdRol") == 4){
			$doc = "inner join Documentos t2 on t2.idOrden = t0.IdOrdenPago
			INNER JOIN Usuarios t3 on t3.IdUsuario = t0.IdUsuarioCrea
			where t0.Estado not in ('I')
			 group by t0.IdOrdenPago,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
  t0.ConsecutivoOP,t0.Proveedor,t0.NombreCheque,t0.Cantidad,t0.CantidadDesc,
  t0.Concepto,t0.Retiene,t0.ComentarioRetiene,t0.FechaCrea,t3.Nombre ";
		}else if($this->session->userdata("Autoriza") == 1){
			$doc = "INNER JOIN Usuarios t3 on t3.IdUsuario = t0.IdUsuarioCrea
					where t0.Estado not in ('I')";
		}

		$qnr = "select count(t0.IdORdenPago) as Cantidad FROM OrdenPago t0 
										LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
										".$doc."
										 ".$srch." ";

		$qnr = $this->db->query($qnr);
		$qnr = $qnr->result_array()[0]["Cantidad"];

		if($length == -1){
			$q = $this->db->query("SELECT t0.IdOrdenPago,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
										t0.ConsecutivoOP,t0.Proveedor,t0.NombreCheque,t0.Cantidad,t0.CantidadDesc,
										t0.Concepto,t0.Retiene,t0.ComentarioRetiene,t0.FechaCrea,t3.Nombre 
										FROM OrdenPago t0 
										LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
										".$doc."
										".$srch." 
										ORDER BY t0.IdOrdenPago asc");
		}else{
			$q = $this->db->query("SELECT t0.IdOrdenPago,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
										t0.ConsecutivoOP,t0.Proveedor,t0.NombreCheque,t0.Cantidad,t0.CantidadDesc,
										t0.Concepto,t0.Retiene,t0.ComentarioRetiene,t0.FechaCrea,t3.Nombre
										FROM OrdenPago t0 
										LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
										".$doc."
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

	public function mostrarOCDoc($idUsuario,$start,$length,$search){
		$srch = "";
		$filter = "";
		$doc='';
		if($search){
			$srch = "AND (
                      t1.Consecutivo like '%".$search."%' OR 
                      t0.ConsecutivoOC like '%".$search."%' OR
                      t0.Proveedor like '%".$search."%' OR 
                      t0.Direccion like '%".$search."%' OR 
                      t0.TiempoEntrega like '%".$search."%' OR
                      cast(t0.FechaCrea as date) like '%".$search."%' 
                    ) ";
		}

		if($this->session->userdata("IdRol") == 2){
			$doc = "INNER JOIN Usuarios t3 on t3.IdUsuario = t0.IdUsuarioCrea  
			where t0.IdUsuarioCrea = '".$idUsuario."' and t0.Estado not in ('I')";
		}else if($this->session->userdata("IdRol") == 4){
			$doc = "inner join Documentos t2 on t2.idOrden = t0.IdOrdenCompra
			INNER JOIN Usuarios t3 on t3.IdUsuario = t0.IdUsuarioCrea  
			where t0.Estado not in ('I')
			 group by t0.IdOrdenCompra,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
			 t0.ConsecutivoOC,t0.Proveedor,t0.Direccion,t0.TiempoEntrega,t0.FechaCrea,t3.Nombre ";
		}else if($this->session->userdata("Autoriza") == 1){
			$doc = "INNER JOIN Usuarios t3 on t3.IdUsuario = t0.IdUsuarioCrea  
			where t0.Estado not in ('I')";
		}

		$qnr = "select count(t0.IdOrdenCompra) as Cantidad FROM OrdenCompra t0 
										LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
										".$doc." ".$srch." ";

		$qnr = $this->db->query($qnr);
		$qnr = $qnr->result_array()[0]["Cantidad"];

		if($length == -1){
			$q = $this->db->query("SELECT t0.IdOrdenCompra,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
										t0.ConsecutivoOC,t0.Proveedor,t0.Direccion,t0.TiempoEntrega,t0.FechaCrea,t3.Nombre  
										FROM OrdenCompra t0 
										LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud
										".$doc."
										".$srch." 
										ORDER BY t0.IdOrdenCompra asc");
		}else{
			$q = $this->db->query("SELECT t0.IdOrdenCompra,t0.IdSolicitud,t0.IdProveedor,t1.Consecutivo,
										t0.ConsecutivoOC,t0.Proveedor,t0.Direccion,t0.TiempoEntrega,t0.FechaCrea,t3.Nombre  
										FROM OrdenCompra t0 
										LEFT JOIN Solicitudes t1 on t1.IdSolicitud = t0.IdSolicitud 
										".$doc." 
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

	public function subirDocumentos($idorden,$idsolicitud,$documento,$parametro){
		$this->db->trans_begin();
		$mensaje = array();
		try {
			$idDoc = $this->db->query("SELECT ISNULL(MAX(idDocumento),0)+1 as idDocumento FROM Documentos");
			$data = array(
				"idDocumento" => $idDoc->result_array()[0]["idDocumento"],
				"idSolicitud" => $idsolicitud,
				"idOrden" => $idorden,
				"documento" => $documento,
				"tipoDocumento" => $parametro,
				"fechaCrea" => date("Y-m-d H:i:s"),
				"idUsuarioCrea" => $this->session->userdata("id"),
				"estado" => "A"
			);

			$insert = $this->db->insert("Documentos",$data);
			if($insert){
				$mensaje[0]["mensaje"] = "El documento se guardó con éxito";
				$mensaje[0]["tipo"] = "success";
				echo json_encode($mensaje);
			}else{
				$mensaje[0]["mensaje"] = "Se produjo un error al intentar guardar el documento. 
				Favor póngase en contacto con el depto. de IT";
				$mensaje[0]["tipo"] = "warning";
				echo json_encode($mensaje);
			}

		}catch (Exception $ex) {
			$mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
			$mensaje[0]["tipo"] = "error";
			echo json_encode($mensaje);
			$this->db->trans_rollback();
		}

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
	}

	public function getDocCuadros($idOrden,$tipo){
		$json = array();
		$i = 0; $estado = ""; $opcion = "";
		$query = $this->db->query("select idDocumento,documento,fechaCrea,estado from Documentos
  										where idOrden = '".$idOrden."' and tipoDocumento = '".$tipo."' ");
		if($query->num_rows()>0){
			foreach ($query->result_array() as $key) {
				$file = explode(".",$key["documento"]);
				$extension = $file["1"];

				if($key["estado"] == "A"){
					$estado = '<span class="badge badge-success fs-8 fw-bold ms-2">activo</span>';
					if($this->session->userdata("IdRol") == 2){
						$opcion = '<div class=""><a onclick="bajaCuadros('."'".$key["idDocumento"]."'".')" href="javascript:void(0)" ><i class="fas fa-trash text-danger"></i></a></div>';
					}else{
						$opcion = '';
					}
				}else{
					$estado = '<span class="badge badge-danger fs-8 fw-bold ms-2">baja</span>';
					$opcion = '';
				}
				$ruta = "assets/documentos/cuadros_comp/";
				$json[$i]["idDocumento"] = $key["idDocumento"];
				$json[$i]["documento"] = $key["documento"];
				$json[$i]["documentoruta"] = base_url().$ruta.$key["documento"];
				$json[$i]["estado"] = $estado;
				$json[$i]["fecha"] = date_format(new DateTime($key["fechaCrea"]), "Y-m-d H:i:s");
				$json[$i]["opcion"] = $opcion;
				if(in_array($extension, array("xlsx","csv","xls"))){
					$json[$i]["extension"] = "excel";
					$json[$i]["clase"] = "success";
				}else if($extension == "pdf"){
					$json[$i]["extension"] = "pdf";
					$json[$i]["clase"] = "danger";
				}else if(in_array($extension,array("jpg","jpeg","png"))){
					$json[$i]["extension"] = "image";
					$json[$i]["clase"] = "primary";
				}
				$i++;
			}
			echo json_encode($json);
		}
	}

	public function bajaCuadro($idDoc){
		$this->db->trans_begin();
		try {
			$this->db->where("idDocumento",$idDoc);
			$data = array(
				"estado" => "I"
			);
			$updte = $this->db->update("Documentos",$data);
			if($updte){
				$mensaje[0]["mensaje"] = "Documento dado de baja con éxito";
				$mensaje[0]["tipo"] = "success";
				echo json_encode($mensaje);
			}else{
				$mensaje[0]["mensaje"] = "Se produjo un error al intentar procesar el documento. 
				Favor póngase en contacto con el depto. de IT";
				$mensaje[0]["tipo"] = "warning";
				echo json_encode($mensaje);
			}

		}catch (Exception $ex){
			$mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
			$mensaje[0]["tipo"] = "error";
			echo json_encode($mensaje);
			$this->db->trans_rollback();
		}
		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
	}

	/***************************************************************************************/
	public function getDocumentos($idOrden,$tipo){
		$json = array();
		$i = 0; $estado = ""; $opcion = ""; $ruta = "";
		$query = $this->db->query("select idDocumento,documento,fechaCrea,estado,tipoDocumento from Documentos
  										where idOrden = '".$idOrden."' and tipoDocumento = '".$tipo."' ");
		if($query->num_rows()>0){
			foreach ($query->result_array() as $key) {
				switch (intval($key["tipoDocumento"])) {
						case 1:
							$ruta = "assets/documentos/cuadros_comp/";
							break;
						case 2:
							$ruta = "assets/documentos/cotizaciones/";
							break;
						case 3:
							$ruta = "assets/documentos/otros/";
							break;
						case 4:
							$ruta = "assets/documentos/constancias/";
							break;
						case 5:
							$ruta = "assets/documentos/otros/";
							break;
						default:
							$ruta = "assets/documentos/";
							break;
					}

				$file = explode(".",$key["documento"]);
				$extension = $file["1"];

				$json[$i]["idDocumento"] = $key["idDocumento"];
				$json[$i]["documento"] = $key["documento"];
				$json[$i]["documentoruta"] = base_url().$ruta.$key["documento"];
				$json[$i]["fecha"] = date_format(new DateTime($key["fechaCrea"]), "Y-m-d H:i:s");
				if($this->session->userdata("IdRol") == 2){
					$json[$i]["opcion"] = '<div class=""><a onclick="eliminarDoc('."'".$key["idDocumento"]."','".$key["tipoDocumento"]."','".$key["documento"]."'".')" 
													  href="javascript:void(0)" ><i class="fas fa-trash text-danger"></i></a></div>';
				}else{
					$json[$i]["opcion"] = '';
				}
				if(in_array($extension, array("xlsx","csv","xls"))){
					$json[$i]["extension"] = "excel";
					$json[$i]["clase"] = "success";
				}else if($extension == "pdf"){
					$json[$i]["extension"] = "pdf";
					$json[$i]["clase"] = "danger";
				}else if(in_array($extension,array("jpg","jpeg","png"))){
					$json[$i]["extension"] = "image";
					$json[$i]["clase"] = "primary";
				}

				$i++;
			}
			echo json_encode($json);
		}
	}

	public function elmiminarDoc($idDoc){
		$this->db->trans_begin();
		try {
			$this->db->where("idDocumento",$idDoc);
			$updte = $this->db->delete("Documentos");
			if($updte){
				$mensaje[0]["mensaje"] = "Documento dado de baja con éxito";
				$mensaje[0]["tipo"] = "success";
				echo json_encode($mensaje);
			}else{
				$mensaje[0]["mensaje"] = "Se produjo un error al intentar procesar el documento. 
				Favor póngase en contacto con el depto. de IT";
				$mensaje[0]["tipo"] = "warning";
				echo json_encode($mensaje);
			}

		}catch (Exception $ex){
			$mensaje[0]["mensaje"] = $ex->getMessage() . "... Código " . $ex->getCode();
			$mensaje[0]["tipo"] = "error";
			echo json_encode($mensaje);
			$this->db->trans_rollback();
		}
		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
	}

/******************************************************************************************************************/
	public function printDoc($idOrden,$cod){
		if($cod == 1){
			$query = $this->db->query("select t0.*,t1.Nombre,t2.Consecutivo, t2.FechaAutoriza from OrdenCompra t0
											inner join Usuarios t1 on t1.IdUsuario = t0.IdUsuarioCrea
											inner join Solicitudes t2 on t2.IdSolicitud = t0.IdSolicitud
											where t0.IdOrdenCompra = '".$idOrden."' ");
			//$this->db->where("IdOrdenCompra", $idOrden)->get("OrdenCompra");
		}else{
			$query = $this->db->query("select t0.*,t1.Nombre,t2.Consecutivo, t2.FechaAutoriza from OrdenPago t0 
											inner join Usuarios t1 on t1.IdUsuario = t0.IdUsuarioCrea
											inner join Solicitudes t2 on t2.IdSolicitud = t0.IdSolicitud
											where t0.IdOrdenPago = '".$idOrden."' ");
			//$this->db->where("IdOrdenPago", $idOrden)->get("OrdenPago");
		}
		if($query->num_rows()>0){
			return $query->result_array();
		}
		return 0;
	}

	public function printDocDet($idOrden,$cod){
		if($cod == 1){
			$query = $this->db->where("IdOrdenCompra", $idOrden)->where("Estado",'A')->get("DetalleOrdenCompra");
		}else{
			$query = $this->db->where("IdOrdenPago", $idOrden)->where("Estado",'A')->get("DetalleOrdenPago");
		}
		if($query->num_rows()>0){
			return $query->result_array();
		}
		return 0;
	}

	public function imprimirSolicitud($idSolicitud){
		$query = $this->db->query("select t0.*,t1.Nombre,t2.Nombre as Autoriza from Solicitudes t0
										inner join Usuarios t1 on t1.IdUsuario = t0.IdUsuario
										left join Usuarios t2 on t2.IdUsuario = t0.IdJefe
										where IdSolicitud = '".$idSolicitud."' ");
			//this->db->where("IdSolicitud", $idSolicitud)->get("Solicitudes");
		if($query->num_rows()>0){
			return $query->result_array();
		}
		return 0;
	}

	public function imprimirSolicitudDet($idSolicitud){
		$query = $this->db->where("IdSolicitud", $idSolicitud)->get("DetalleSolicitud");
		if($query->num_rows()>0){
			return $query->result_array();
		}
		return 0;
	}
}
