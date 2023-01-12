<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitudes_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }

    //mostrar mis solicitudes (por cada usuario) creadas
    public function getSolicitudesAjax($start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "AND (
                      Consecutivo like '%".$search."%' OR 
                      FechaSolicitud like '%".$search."%' OR 
                      DescripcionSolicitud like '%".$search."%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from solicitudes where idusuario = '".$this->session->userdata("id")."'  ".$srch." ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("select * from solicitudes where idusuario = '".$this->session->userdata("id")."'  ".$srch." ORDER BY IdSolicitud desc");
		}else{
			$q = $this->db->query("select * from solicitudes where idusuario = '".$this->session->userdata("id")."'  ".$srch."
                                    ORDER BY IdSolicitud desc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    public function getSolicitudesAutAjax($start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "AND (
                      t1.Consecutivo like '%".$search."%' OR 
                      t1.FechaSolicitud like '%".$search."%' OR 
                      t2.Nombre like '%".$search."%' OR 
                      t1.DescripcionSolicitud like '%".$search."%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from solicitudes t1 
        inner join Usuarios t2 on t1.IdUsuario = t2.IdUsuario
        where t1.IdJefe = '".$this->session->userdata("id")."'
        and t1.Estado = 'N' ".$srch." ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("select t1.*,t2.Nombre,t2.Correo from Solicitudes t1 
            inner join Usuarios t2 on t1.IdUsuario = t2.IdUsuario
            where t1.IdJefe = '".$this->session->userdata("id")."'
            and t1.Estado = 'N'  ".$srch." ORDER BY IdSolicitud asc");
		}else{
			$q = $this->db->query("select t1.*,t2.Nombre,t2.Correo from Solicitudes t1 
            inner join Usuarios t2 on t1.IdUsuario = t2.IdUsuario
            where t1.IdJefe = '".$this->session->userdata("id")."'
            and t1.Estado = 'N'  ".$srch."
                                    ORDER BY IdSolicitud asc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    //mostrar detalle de articulos segun id solicitud
    public function getSolicitudesDetAjax($idsolicitud,$start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "AND (
                      CantidadSolicitud like '%".$search."%' OR 
                      UnidadMedida like '%".$search."%' OR 
                      CantidadAut like '%".$search."%' OR
                      DescripcionArticulo like '%".$search."%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from detalleSolicitud where 
                idsolicitud = '".$idsolicitud."' ".$srch." ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("select * from detalleSolicitud where  idsolicitud = '".$idsolicitud."' ".$srch." ORDER BY IdDetallesSolicitud asc");
		}else{
			$q = $this->db->query("select * from detalleSolicitud where idsolicitud = '".$idsolicitud."' ".$srch."
                                    ORDER BY IdDetallesSolicitud asc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    public function getAreaSolic(){
        $query = $this->db->query("SELECT t1.IdArea,t1.NombreArea,t1.Siglas,t3.IdJefe
                                    FROM areas t1
                                    INNER JOIN usuarios t2 on t1.IdArea = t2.IdArea
                                    left join autorizados t3 on t2.IdUsuario = t3.IdSolicitante
                                    WHERE t2.IdUsuario = '".$this->session->userdata("id")."' ");
        if($query->num_rows()>0){
            return $query->result_array();
        }
        return 0;
    }
    
    public function guardarSolicitud($enc, $detalle){

        $this->db->trans_begin();
		$mensaje = array();

		if(date("H") >= 18){ //permitir guardar hasta las 6 de la tarde
            $mensaje[0]["mensaje"] = "No se permite generar solicitudes despues de la 6:00 P.M.";
				$mensaje[0]["tipo"] = "error";
				echo json_encode($mensaje);
        }else{
            $banderaPrio = false;
           $valida = $this->db->query("select 
										COUNT(case when Prioridad = '".$enc[6]."' then 1 else Null end) as prioridad
										from Solicitudes
										where Estado not in ('S','I','B')
										and IdArea = '".$this->session->userdata("idArea")."'
										and Prioridad = '".$enc[6]."' ");
		if($enc[6] == "2"){
			if($valida->result_array()[0]["prioridad"] >= 6){
				$banderaPrio = true;
				$mensaje[0]["mensaje"] = "Solo puede crear 6 solictudes con este nivel de prioridad. 
										Ya ha excedido la cantidad permitida de solicitudes con nivel de prioridad Alta. 
										Debe esperar que el personal de compras cierre al menos una solicitud con este nivel
										para poder generar una nueva";
				$mensaje[0]["tipo"] = "error";
				echo json_encode($mensaje);
			}else{
				$banderaPrio = false;
			}
		}else if($enc[6] == "3"){
			if($valida->result_array()[0]["prioridad"] >= 4) {
				$banderaPrio = true;
				$mensaje[0]["mensaje"] = "Solo puede crear 4 solictudes con este nivel de prioridad. 
				Ya ha excedido la cantidad permitida de solicitudes con nivel de prioridad Urgente. 
				Debe esperar que el personal de compras cierre al menos una solicitud con este nivel
				para poder generar una nueva.";
				$mensaje[0]["tipo"] = "error";
				echo json_encode($mensaje);
			}
			else{
				$banderaPrio = false;
			}
		}else{
			$banderaPrio = false;
		}


		if(!$banderaPrio){
			$estado = "";
			try {
				$bandera = false;
				$idSolicitud = $this->db->query("SELECT t1.Siglas,
                                            (SELECT ISNULL(MAX(IdSolicitud),0)+1 FROM Solicitudes) as IdSolicitud
                                                from areas t1
                                            inner join usuarios t2 on t1.IdArea = t2.IdArea
                                            where t2.IdUsuario = '".$this->session->userdata("id")."' ");
				$consecutivo = $idSolicitud->result_array()[0]["Siglas"]."-".date("dmY")."-".$idSolicitud->result_array()[0]["IdSolicitud"];

				if($enc[5] == "P"){
					$estado = "N";
				}else{
					$estado = "A";
				}
				$encabezado = array(
					"IdSolicitud" => $idSolicitud->result_array()[0]["IdSolicitud"],
					"Consecutivo" => $consecutivo,
					"IdArea" => $enc[1],
					"IdUsuario" => $this->session->userdata("id"),
					"IdJefe" => $enc[0],
					"TipoSolicitud" => $enc[2],
					"FechaSolicitud" => date("Y-m-d"),
					"DescripcionSolicitud" => $enc[4],
					"Estado" => $estado,
					"EstadoAutorizado" => $enc[5],
					"Prioridad" => $enc[6],
					"FechaCrea" => date("Y-m-d H:i:s"),
                    "FechaAutoriza" => date("Y-m-d H:i:s")
				);
				$guardarEnc = $this->db->insert("Solicitudes", $encabezado);
				if($guardarEnc){
					$bandera = true;
				}else{
					$mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
					$mensaje[0]["tipo"] = "error";
					echo json_encode($mensaje);
				}

				if ($bandera == true) {
					$bandera1 = false;
					$cantJefe = 0;
					$idEnc = $idSolicitud->result_array()[0]["IdSolicitud"];
					$det = json_decode($detalle, true);
					foreach ($det as $obj) {
						$idDet = $this->db->query("SELECT ISNULL(MAX(IdDetallesSolicitud),0)+1 AS IdDetallesSolicitud FROM DetalleSolicitud");
						if($this->session->userdata("Autoriza") == 1){
							$cantJefe = $obj[0];
						}else{
							$cantJefe = $obj[2];
						}
						$insertDet = array(
							"IdDetallesSolicitud" => $idDet->result_array()[0]["IdDetallesSolicitud"],
							"IdSolicitud" => $idEnc,
							"CantidadSolicitud" => $obj[0],
							"UnidadMedida" => $obj[1],
							"CantidadAut" => $cantJefe,
							"DescripcionArticulo" => $obj[3],
							"EstadoAutorizado" => $enc[5],
							"ImagenReferencia" => ($obj[4])
						);
						$guardarDet = $this->db->insert("DetalleSolicitud", $insertDet);
						if ($guardarDet) {
							$bandera1 = true;
						}
					}

					if ($bandera1) {
                        /**************VERIFICAR CORREOS DE PERSONAL DE COMPRAS ACTIVOS***************** */
                        $arrayCorreo = array();
                        $correos = $this->db->query("SELECT * FROM Usuarios WHERE IdRol = 2 AND Estado = 'A'");
                        foreach ($correos->result_array() as $key) {
                            $arrayCorreo[] = $key["Correo"];
                        }
                        /********************************************************************************************** */
						$mensaje[0]["mensaje"] = "Solicitud generada con éxito. Consecutivo N° ".$consecutivo." ";
						$mensaje[0]["tipo"] = "success";
                        $mensaje[0]["cons"] = $consecutivo;
                        $mensaje[0]["correo"] = $arrayCorreo; // RETORNAR CORREOS DE PERSONALDE COMPRAS PARA ENVIO DE MAILS
						echo json_encode($mensaje);
					} else {
						$mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
						$mensaje[0]["tipo"] = "error";
						echo json_encode($mensaje);
					}
				}

			} catch (Exception $ex) {
				$this->db->trans_rollback();

				$mensaje[0]["mensaje"] = $ex->getMessage(). "... Código ".$ex->getCode();
				$mensaje[0]["tipo"] = "error";
				echo json_encode($mensaje);
			}
		}
 
        }
        if ($this->db->trans_status() === FALSE)
       {
               $this->db->trans_rollback();
       }
       else
       {
               $this->db->trans_commit();
       }
    }

    public function bajaSolicitud($idSolicitud,$idUsuarioSolicita,$comentarioSolic,$anula){
        $this->db->trans_begin();
        $mensaje = array();
        $bandera = false;
        $arrayCorreo = array();
        try {
            //validar si el estado es diferente de pendiente
            $validar = $this->db->query("SELECT Estado,EstadoAutorizado FROM Solicitudes where IdSolicitud = '".$idSolicitud."' ");
            
            if($this->session->userdata("Autoriza") == 1){
                $this->db->where("IdSolicitud", $idSolicitud);
                $data = array(
                    "Estado" => "I",
                    "EstadoAutorizado" => "I",
                );
                $baja = $this->db->update("Solicitudes",$data);

                if($baja){
                    $this->db->where("IdSolicitud", $idSolicitud);
                    $dataDet = array(
                        "EstadoAutorizado" => "I" //A: autorizado, R:rechazado, I:anulado, P:pendiente
                    );
                    $bajaDet = $this->db->update("DetalleSolicitud",$dataDet);
                    if($bajaDet){
                        $bandera = true;
                    }
                }

                if($bandera){
                    /**************VERIFICAR CORREOS DE PERSONAL DE COMPRAS ACTIVOS***************** */
                    $correos = $this->db->query("SELECT * FROM Usuarios WHERE IdRol = 2 AND Estado = 'A'");
                    foreach ($correos->result_array() as $key) {
                        $arrayCorreo[] = $key["Correo"];
                    }
                    /********************************************************************************************** */

                    $mensaje[0]["mensaje"] = "Se dio de baja la solicitud";
                    $mensaje[0]["tipo"] = "success";
                    $mensaje[0]["correo"] = $arrayCorreo;
                    $mensaje[0]["jefe"] = "Y";
                    echo json_encode($mensaje);
                }
            }else{
                //Anular 
                if($validar->result_array()[0]["Estado"] == "N" && $validar->result_array()[0]["EstadoAutorizado"] == "P"){
                    $this->db->where("IdSolicitud", $idSolicitud);
                    $data = array(
                        "Estado" => "I",
                        "EstadoAutorizado" => "I",
                    );
                    $baja = $this->db->update("Solicitudes",$data);

                    if($baja){
                        $this->db->where("IdSolicitud", $idSolicitud);
                        $dataDet = array(
                            "EstadoAutorizado" => "I" //A: autorizado, R:rechazado, I:anulado, P:pendiente
                        );
                        $bajaDet = $this->db->update("DetalleSolicitud",$dataDet);
                        if($bajaDet){
                            $bandera = true;
                        }
                    }

                    if($bandera){
                        /**************VERIFICAR CORREOS DE PERSONAL DE COMPRAS ACTIVOS***************** */
                        $correos = $this->db->query("SELECT * FROM Usuarios WHERE IdRol = 2 AND Estado = 'A'");
                        foreach ($correos->result_array() as $key) {
                            $arrayCorreo[] = $key["Correo"];
                        }
                    /********************************************************************************************** */
                        $mensaje[0]["mensaje"] = "Se dio de baja la solicitud";
                        $mensaje[0]["tipo"] = "success";
                        $mensaje[0]["correo"] = $arrayCorreo;
                        $mensaje[0]["jefe"] = "Y";
                        echo json_encode($mensaje);
                    }
                }
                //Solicitar anulacion a jefe
                else if($validar->result_array()[0]["Estado"] == "A"){ // && $validar->result_array()[0]["EstadoAutorizado"] == "Y"
                    if($anula){
                            $idAnul = $this->db->query("SELECT ISNULL(MAX(IdSolicitudAnula),0)+1 as IdSolicitudAnula from AnulacionSolictudes");
                            $idJefe = $this->db->query("SELECT IdJefe FROM Autorizados where IdSolicitante = '".$idUsuarioSolicita."' ");
        
                            $dataInsert = array(
                            "IdSolicitudAnula" => $idAnul->result_array()[0]["IdSolicitudAnula"],
                            "IdSolicitud" => $idSolicitud,
                            "IdUsuarioSolicita" => $idUsuarioSolicita,
                            "IdJefe" => $idJefe->result_array()[0]["IdJefe"],
                            "ComentarioSolicAnula" => $comentarioSolic,
                            "FechaCreaAnula" => date("Y-m-d H:i:s"),
                            "Estado" => "A"
                            );
        
                            $save = $this->db->insert("AnulacionSolictudes", $dataInsert);
                            if($save){
                                /**************VERIFICAR CORREO DE JEFE ASIGNADO***************** */
                                    $correos = $this->db->query("select t2.Correo from Autorizados t0
                                    inner join Usuarios t1 on t1.IdUsuario = t0.IdSolicitante
                                    inner join Usuarios t2 on t2.IdUsuario = t0.IdJefe
                                    where t1.IdUsuario = '".$this->session->userdata("id")."' AND t1.Estado = 'A'");
                                    foreach ($correos->result_array() as $key) {
                                        $arrayCorreo[] = $key["Correo"];
                                    }
                                /********************************************************************************************** */
                                $mensaje[0]["mensaje"] = "Solicitud Anulacion enviada.";
                                $mensaje[0]["tipo"] = "success";
                                $mensaje[0]["correo"] = $arrayCorreo;
                                $mensaje[0]["jefe"] = "N";
                                echo json_encode($mensaje);
                            }
        
                        }
                }else{
                    $mensaje[0]["mensaje"] = "Esta solicitud ya esta en proceso y no puede ser anulada";
                    $mensaje[0]["tipo"] = "warning";
                    echo json_encode($mensaje);
                }   

            }
        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage(). "... Código ".$ex->getCode();
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === FALSE)
       {
               $this->db->trans_rollback();
       }
       else
       {
               $this->db->trans_commit();
       }
    }

    public function autorizarSolicitud($data,$prioridad){
        $this->db->trans_begin();
        try{
            $mensaje = array();
            if(date("H") >= 17){
                $mensaje[0]["mensaje"] = "No se permite autorizar solicitudes despues de la 5:00 P.M.";
				$mensaje[0]["tipo"] = "error";
				echo json_encode($mensaje);
            }else{
                $bandera = false;
            $bandera1 = false;
            $idSolicitud = '';
            $banderaPrio = false;
            $arrayCorreo = array();	

            $det1 = json_decode($data, true);
            foreach ($det1 as $obj) {
                $idSolicitud = $obj[0];
            }
    
            $valida = $this->db->query("SELECT 
                                        COUNT(case when t0.Prioridad = '".$prioridad."' then 1 else Null end) as prioridad
                                        from Solicitudes t0
                                        where t0.Estado not in ('S','I','B')
                                        and t0.IdArea = (select --t0.*,t1.Nombre as jefe, t2.Nombre as subordinad,
                                        t2.IdArea as IdAreaSubordinad 
                                        --, t3.IdSolicitud
                                        from Autorizados t0
                                        inner join Usuarios t1 on t0.IdJefe = t1.IdUsuario 
                                        inner join Usuarios t2 on t0.IdSolicitante = t2.IdUsuario 
                                        inner join Solicitudes t3 on t2.IdUsuario = t3.IdUsuario
                                        where t0.IdJefe = '".$this->session->userdata("id")."' and t3.IdSolicitud = '".$idSolicitud."')
                                        and t0.Prioridad = '".$prioridad."' ");
                                        //echo $this->db->last_query();
            if($prioridad == "2"){
                if($valida->result_array()[0]["prioridad"] >= 4){
                    $banderaPrio = true;
                    $mensaje[0]["mensaje"] = "Solo puede crear 4 solictudes con este nivel de prioridad. 
                                            Ya ha excedido la cantidad permitida de solicitudes con nivel de prioridad Alta. 
                                            Debe esperar que el personal de compras cierre al menos una solicitud con este nivel
                                            para poder generar una nueva";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                }else{
                    $banderaPrio = false;
                }
            }else if($prioridad == "3"){
                if($valida->result_array()[0]["prioridad"] >= 2) {
                    $banderaPrio = true;
                    $mensaje[0]["mensaje"] = "Solo puede crear 2 solictudes con este nivel de prioridad. 
                    Ya ha excedido la cantidad permitida de solicitudes con nivel de prioridad Urgente. 
                    Debe esperar que el personal de compras cierre al menos una solicitud con este nivel
                    para poder generar una nueva.";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                }
                else{
                    $banderaPrio = false;
                }
            }else{
                $banderaPrio = false;
            }
            if(!$banderaPrio){
                $det = json_decode($data, true);
                foreach ($det as $obj) {
                    $this->db->where("IdSolicitud",$obj[0]);
                    //IdDetallesSolicitud
                    $updatSolic = array(
                        "Estado" => "A",
                        "EstadoAutorizado" => "Y",
                        "FechaAutoriza" => date("Y-m-d H:i:s"),
                        "Prioridad" => $prioridad
                    );
                    $updtEnc = $this->db->update("Solicitudes", $updatSolic);
                    
                    if ($updtEnc) {
                    $bandera = true;
                    }else{
                        $bandera = false;
                        $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-1(ENC)";
                        $mensaje[0]["tipo"] = "error";
                        echo json_encode($mensaje);
                    }

                    if($bandera){
                        $this->db->where("IdDetallesSolicitud",$obj[1]);
                        $updatSolicDet = array(
                            "CantidadAut" => intval($obj[2]),
                            "EstadoAutorizado" => $obj[3]
                        );
                        $updtEnc = $this->db->update("DetalleSolicitud", $updatSolicDet);
                        if($updtEnc){
                            $bandera1 = true;
                        }else{
                            $bandera1 = false;
                            $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                            $mensaje[0]["tipo"] = "error";
                            echo json_encode($mensaje);
                        }
                    }
                }
                
                if ($bandera1) {
                     /**************VERIFICAR CORREOS DE PERSONAL DE COMPRAS ACTIVOS***************** */
                     $correos = $this->db->query("SELECT Correo FROM Usuarios WHERE IdRol = 2 AND Estado = 'A'");
                     foreach ($correos->result_array() as $key) {
                         $arrayCorreo[] = $key["Correo"];
                     }
                     /********************************************************************************************** */

                    $mensaje[0]["mensaje"] = "Solicitud Autorizada";
                    $mensaje[0]["tipo"] = "success";
                    $mensaje[0]["correo"] = $arrayCorreo;

                    echo json_encode($mensaje);
                } else {
                    $mensaje[0]["mensaje"] = "Se produjo un error al guardar los datos. COD-2(DET)";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                }
            }
            }

        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage(). "... Código ".$ex->getCode();
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === FALSE)
       {
               $this->db->trans_rollback();
       }
       else
       {
               $this->db->trans_commit();
       }
    }

    /************************************************************ */
    public function cargarSolicAnula($start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "AND (
                      t2.Consecutivo like '%".$search."%' OR 
                      t3.Nombre like '%".$search."%' OR 
                      t1.ComentarioSolicAnula like '%".$search."%' OR
                      CAST(t1.FechaCreaAnula AS DATE) like '%".$search."%' 
                    ) ";
        }

        $qnr = "SELECT count(1) as Cantidad FROM dbo.AnulacionSolictudes AS t1
                INNER JOIN dbo.Solicitudes AS t2 ON t1.IdSolicitud = t2.IdSolicitud
                INNER JOIN dbo.Usuarios AS t3 ON t1.IdUsuarioSolicita = t3.IdUsuario
                where t1.Estado = 'A' and t1.IdJefe = '".$this->session->userdata("id")."'
                ".$srch." ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("SELECT t1.*,t2.Consecutivo,t3.Nombre FROM dbo.AnulacionSolictudes AS t1
                                INNER JOIN dbo.Solicitudes AS t2 ON t1.IdSolicitud = t2.IdSolicitud
                                INNER JOIN dbo.Usuarios AS t3 ON t1.IdUsuarioSolicita = t3.IdUsuario
                                where t1.Estado = 'A' and t1.IdJefe = '".$this->session->userdata("id")."' 
                                ".$srch." ORDER BY t1.IdSolicitudAnula asc");
		}else{
			$q = $this->db->query("SELECT t1.*,t2.Consecutivo,t3.Nombre FROM dbo.AnulacionSolictudes AS t1
                                    INNER JOIN dbo.Solicitudes AS t2 ON t1.IdSolicitud = t2.IdSolicitud
                                    INNER JOIN dbo.Usuarios AS t3 ON t1.IdUsuarioSolicita = t3.IdUsuario
                                    where t1.Estado = 'A' and t1.IdJefe = '".$this->session->userdata("id")."' ".$srch."
                                    ORDER BY t1.IdSolicitudAnula asc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    public function anularSolicitud($idSolicitud,$comentarioAnula){
        $this->db->trans_begin();
        $mensaje = array();
        $bandera = false;
        $arrayCorreo = array();
        $arrayCorreo1 = array();

        try {
            //validar si el estado es diferente de pendiente
            $validar = $this->db->query("SELECT Estado,EstadoAutorizado FROM Solicitudes where IdSolicitud = '".$idSolicitud."' ");
            
            if($validar->result_array()[0]["Estado"] == "A" && $validar->result_array()[0]["EstadoAutorizado"] == "Y"){

                $this->db->where("IdSolicitud", $idSolicitud);

                $datos = array(
                    "Estado" => "I",
                    "EstadoAutorizado" => "I"
                );
                $save = $this->db->update("Solicitudes", $datos);

                if($save){
                    $this->db->where("IdSolicitud", $idSolicitud);

                    $datosDet = array(
                        "EstadoAutorizado" => "I"
                    );
                    $saveDet = $this->db->update("DetalleSolicitud", $datosDet);
                    if($saveDet){
                        $bandera = true;
                    }else{
                        $bandera = false;
                    }
                }else{
                    $bandera = false;
                }     
                
                if($bandera){
                    $this->db->where("IdSolicitud", $idSolicitud);
                    $dataAnul = array(
                        "Estado" => "I",
                        "IdUsuarioAnula" => $this->session->userdata("id"),
                        "ComentarioAnula" => $comentarioAnula,
                        "FechaAnulacion" => date("Y-m-d H:i:s")
                    );
                    $updt = $this->db->update("AnulacionSolictudes",$dataAnul);

                    if($updt){
                        /**************VERIFICAR CORREOS DE SUBORDINADO***************** */
                        $correos = $this->db->query("select t1.Correo from Autorizados t0
                        inner join Usuarios t1 on t1.IdUsuario = t0.IdSolicitante
                        inner join Usuarios t2 on t2.IdUsuario = t0.IdJefe
                        INNER JOIN Solicitudes t3 on t1.IdUsuario = t3.IdUsuario
                        where t2.IdUsuario = '".$this->session->userdata("id")."'
                        and t3.IdSolicitud = '".$idSolicitud."' ");
                        foreach ($correos->result_array() as $key) {
                            $arrayCorreo[] = $key["Correo"];
                        }
                        /********************************************************************************************** */
                        /**************VERIFICAR CORREOS DE PERSONAL DE COMPRAS ACTIVOS***************** */
                        $correos1 = $this->db->query("SELECT * FROM Usuarios WHERE IdRol = 2 AND Estado = 'A'");
                        foreach ($correos1->result_array() as $key) {
                            $arrayCorreo1[] = $key["Correo"];
                        }
                        /********************************************************************************************** */


                        $mensaje[0]["mensaje"] = "Solicitud Anulada";
                        $mensaje[0]["tipo"] = "success";
                        $mensaje[0]["correo"] = $arrayCorreo;
                        $mensaje[0]["correoC"] = $arrayCorreo1;
                        echo json_encode($mensaje);
                    }
                }
            }else{
                $mensaje[0]["mensaje"] = "Esta solicitud ya esta en proceso y no puede ser anulada";
                $mensaje[0]["tipo"] = "warning";
                echo json_encode($mensaje);
            }   

        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage(). "... Código ".$ex->getCode();
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === FALSE)
       {
               $this->db->trans_rollback();
       }
       else
       {
               $this->db->trans_commit();
       }
    }

    /************************************************************ */

    public function editSolicitud($idSolicitud){
        $json = array(); $i = 0;
        $jsondet = array(); $idet = 0;
        $encabezado = $this->db->query("SELECT IdSolicitud,Consecutivo,IdArea,IdUsuario,IdJefe,
        TipoSolicitud,FechaSolicitud,DescripcionSolicitud,FechaCrea,Prioridad FROM Solicitudes WHERE IdSolicitud = '".$idSolicitud."' ");

        $detalle = $this->db->query("SELECT IdDetallesSolicitud,IdSolicitud,CantidadSolicitud,UnidadMedida,
                                    CantidadAut,DescripcionArticulo FROM DetalleSolicitud WHERE IdSolicitud = '".$idSolicitud."' 
                                    and EstadoAutorizado <> 'I'");

        if($encabezado->num_rows()>0){
            foreach ($encabezado->result_array() as $key) {
                $json[$i]["IdSolicitud"] = $key["IdSolicitud"];
                $json[$i]["Consecutivo"] = $key["Consecutivo"];
                $json[$i]["IdArea"] = $key["IdArea"];
                $json[$i]["IdUsuario"] = $key["IdUsuario"];
                $json[$i]["IdJefe"] = $key["IdJefe"];
                $json[$i]["TipoSolicitud"] = $key["TipoSolicitud"];
                $json[$i]["FechaSolicitud"] = $key["FechaSolicitud"];
                $json[$i]["DescripcionSolicitud"] = $key["DescripcionSolicitud"];
                $json[$i]["FechaCrea"] = $key["FechaCrea"];
                $json[$i]["Prioridad"] = $key["Prioridad"];
                $i++;
            }
            if($detalle->num_rows()>0){
                foreach ($detalle->result_array() as $key) {
                    $jsondet[$idet]["IdDetallesSolicitud"] = $key["IdDetallesSolicitud"];
                    $jsondet[$idet]["IdSolicitud"] = $key["IdSolicitud"];
                    $jsondet[$idet]["CantidadSolicitud"] = $key["CantidadSolicitud"];
                    $jsondet[$idet]["UnidadMedida"] = $key["UnidadMedida"];
                    $jsondet[$idet]["CantidadAut"] = $key["CantidadAut"];
                    $jsondet[$idet]["DescripcionArticulo"] = $key["DescripcionArticulo"];
                    $idet++;
                }
            }
        }

        $return = array(
            "enc" => $json,
            "det" => $jsondet
        );

        echo json_encode($return);
    }

    public function actualizarSolicitud($idSolicitud,$detalle){
        $this->db->trans_begin();
        $mensaje = array();
        if(date("H") >= 17){
            $mensaje[0]["mensaje"] = "No se permite modificar solicitudes despues de la 5:00 P.M.";
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }else{
            $arrayCorreo = array();
            $jefe = false;
            try{
                $delete = $this->db->where("IdSolicitud",$idSolicitud[0])->delete("DetalleSolicitud");   
                if($delete){
                        $bandera1 = false;
                        $solicita = "";
                        $det = json_decode($detalle, true);
                        if ($this->session->userdata("Autoriza") != 1) {
                            $this->db->where("IdSolicitud",$idSolicitud[0]);
                            $update = array(
                                "TipoSolicitud" => $idSolicitud[1],
                                "DescripcionSolicitud" => $idSolicitud[2],
                                "Prioridad" => $idSolicitud[3],
                                "Estado" => "N",
                                "EstadoAutorizado" => "P"
                            );
                            $this->db->update("Solicitudes", $update);
                            
                            $solicita = "P";
                            $jefe = false;
                            /**************VERIFICAR CORREOS DE JEFE ASIGNADO***************** */
                            $correos = $this->db->query("select t2.Correo from Autorizados t0
                            inner join Usuarios t1 on t1.IdUsuario = t0.IdSolicitante
                            inner join Usuarios t2 on t2.IdUsuario = t0.IdJefe
                            where t1.IdUsuario = '".$this->session->userdata("id")."' AND t1.Estado = 'A'");
                            foreach ($correos->result_array() as $key) {
                                $arrayCorreo[] = $key["Correo"];
                            }
                            /********************************************************************************************** */

                        }else {
                            $this->db->where("IdSolicitud",$idSolicitud[0]);
                            $update = array(
                                "TipoSolicitud" => $idSolicitud[1],
                                "DescripcionSolicitud" => $idSolicitud[2],
                                "Prioridad" => $idSolicitud[3],
                                "FechaAutoriza" => date("Y-m-d H:i:s")
                            );
                            $this->db->update("Solicitudes", $update);

                            $jefe = true;
                            /**************VERIFICAR CORREOS DE PERSONAL DE COMPRAS ACTIVOS***************** */
                            $correos = $this->db->query("SELECT * FROM Usuarios WHERE IdRol = 2 AND Estado = 'A'");
                            foreach ($correos->result_array() as $key) {
                                $arrayCorreo[] = $key["Correo"];
                            }
                            /********************************************************************************************** */

                            $solicita = "Y";
                        }
                        foreach ($det as $obj) {
                            $idDet = $this->db->query("SELECT ISNULL(MAX(IdDetallesSolicitud),0)+1 AS IdDetallesSolicitud FROM DetalleSolicitud");
                            $insertDet = array(
                                "IdDetallesSolicitud" => $idDet->result_array()[0]["IdDetallesSolicitud"],
                                "IdSolicitud" => $idSolicitud[0],
                                "CantidadSolicitud" => $obj[0],
                                "UnidadMedida" => $obj[1],
                                "CantidadAut" => $obj[2],
                                "DescripcionArticulo" => $obj[3],
                                "EstadoAutorizado" => $solicita
                            );
                            $guardarDet = $this->db->insert("DetalleSolicitud", $insertDet);
                            if ($guardarDet) {
                                $bandera1 = true;
                            }
                        }
                }
                if($bandera1){
                    $mensaje[0]["mensaje"] = "Datos de solicitud actualizados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    $mensaje[0]["correo"] = $arrayCorreo;
                    $mensaje[0]["aut"] = $jefe;
                    echo json_encode($mensaje);
                }   

            }catch (Exception $ex) {
                $this->db->trans_rollback();

                $mensaje[0]["mensaje"] = $ex->getMessage(). "... Código ".$ex->getCode();
                $mensaje[0]["tipo"] = "error";
                echo json_encode($mensaje);
            }
        }

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
        }
    }

/*********************************************************************************************************************** */
    public function mostrarHistorial($fechainicio,$fechaFin,$start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "AND (
                      t1.Consecutivo like '%".$search."%' OR 
                      CAST(t1.FechaAutoriza as date) like '%".$search."%' OR 
                      t2.Nombre like '%".$search."%' OR 
                      t1.DescripcionSolicitud like '%".$search."%'
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from Solicitudes t1
        inner join Usuarios t2 on t1.IdUsuario = t2.IdUsuario
        where t1.IdJefe = '".$this->session->userdata("id")."' and
        FechaAutoriza >= '".$fechainicio."' and FechaAutoriza <= '".$fechaFin."' ".$srch." ";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("select t1.*,t2.Nombre from Solicitudes t1
                                    inner join Usuarios t2 on t1.IdUsuario = t2.IdUsuario
                                    where t1.IdJefe = '".$this->session->userdata("id")."' and
                                    FechaAutoriza >= '".$fechainicio."' and FechaAutoriza <= '".$fechaFin."'
                                    ".$srch."
                                    ORDER BY t1.IdSolicitud asc");
		}else{
			$q = $this->db->query("select t1.*,t2.Nombre from Solicitudes t1
                                    inner join Usuarios t2 on t1.IdUsuario = t2.IdUsuario
                                    where t1.IdJefe = '".$this->session->userdata("id")."' and
                                    FechaAutoriza >= '".$fechainicio."' and FechaAutoriza <= '".$fechaFin."'
                                    ".$srch."
                                    ORDER BY t1.IdSolicitud asc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    public function mostrarHistorialChart($fechainicio,$fechaFin)    {
        $json = array(); $i = 0;
        $query = $this->db->query("SELECT
        T0_1.IdUsuario,
        T0_1.Nombre,
        SUM ( CASE WHEN T0_1.Estado = 'Rechazado' THEN 1 ELSE 0 END ) AS Rechazada,
        SUM ( CASE WHEN T0_1.Estado = 'A' THEN 1 ELSE 0 END ) AS Abiertas,
        SUM ( CASE WHEN T0_1.Estado = 'P' THEN 1 ELSE 0 END ) AS Proceso,
        SUM ( CASE WHEN T0_1.Estado = 'S' THEN 1 ELSE 0 END ) AS Cerrada,
        SUM ( CASE WHEN T0_1.Estado = 'I' THEN 1 ELSE 0 END ) AS Anuladas
        FROM
            (
        SELECT
            t0.Estado,
            ISNULL( t1.IdUsuario, - 1 ) AS IdUsuario,
            ISNULL( t1.Nombre, 'No Asignado' ) AS Nombre
        FROM
            dbo.Solicitudes AS t0
            LEFT OUTER JOIN dbo.Usuarios AS t1 ON t1.IdUsuario = t0.IdUsuario and t1.Estado = 'A'
            where t0.IdJefe= '".$this->session->userdata("id")."' and cast(t0.FechaAutoriza as date)>= '".$fechainicio."' 
            and CAST(t0.FechaAutoriza as date) <= '".$fechaFin."' 
            UNION ALL
        SELECT
            'Rechazado' AS Estado,
            ISNULL( t1.IdUsuario, - 1 ) AS IdUsuario,
            ISNULL( t1.Nombre, 'No Asignado' ) AS Nombre 
        FROM
            dbo.SolicRechazadas AS t0
            LEFT OUTER JOIN dbo.Usuarios AS t1 ON t1.IdUsuario = t0.idSolicitante 
            where (t0.estado = 'A') AND t1.Estado = 'A' 
            AND t1.IdUsuario IN (select IdUsuario from Solicitudes where IdJefe = '".$this->session->userdata("id")."')
        ) AS T0_1 
        GROUP BY T0_1.IdUsuario,T0_1.Nombre");
     
        if ($query->num_rows()>0) {
            foreach ($query->result_array() as $key) {
                $json[strval($i)]["Abiertas"] = $key["Abiertas"];
                $json[strval($i)]["Proceso"] = $key["Proceso"];
                $json[strval($i)]["Cerrada"] = $key["Cerrada"];
                $json[strval($i)]["Rechazada"] = $key["Rechazada"];
                $json[strval($i)]["Anuladas"] = $key["Anuladas"];
                $json[strval($i)]["Nombre"] = $key["Nombre"];
                $json[strval($i)]["valor"] = $i;
                $i++;
            }   

            echo json_encode($json);
        }

    }

    public function historialChartPie($fechainicio,$fechaFin)
    {
        $json = array(); $i = 0;
        $query = $this->db->query("select count (IdSolicitud)CantSolicitudes,
        case 
        when Estado='N' then 'Pendiente de Autorizar'
        when Estado='A' then 'Abierto'
        when Estado='P' then 'En Proceso'
        when Estado='S' then 'Cerrado'
        when Estado='I' then 'Inactivo'
        when Estado='R' then 'Rechazadas'
        else 'N/D' end 'Estado'
        from Solicitudes
		where IdJefe = '".$this->session->userdata("id")."' 
        and cast(FechaAutoriza as date)>= '".$fechainicio."' 
	    and CAST(FechaAutoriza as date) <= '".$fechaFin."'
        group by Estado");
        foreach ($query->result_array() as $key) {
            $json[$i]["Estado"] = $key["Estado"];
            $json[$i]["CantSolicitudes"] = $key["CantSolicitudes"];
            $i++;
        }
        echo json_encode($json);
    }

    public function historialPrioridad($fechainicio,$fechaFin)
    {
        $json = array(); $i = 0;
        $query = $this->db->query("select count (IdSolicitud)CantSolicitudes,
        case 
        when Prioridad = 1 then 'Normal'
        when Prioridad = 2 then 'Alta'
        when Prioridad = 3 then 'Urgente'
        else 'N/D' end 'Prioridad'
        from Solicitudes
		where IdJefe = '".$this->session->userdata("id")."' 
        and cast(FechaAutoriza as date)>= '".$fechainicio."' 
	    and CAST(FechaAutoriza as date) <= '".$fechaFin."'
        group by Prioridad");
        foreach ($query->result_array() as $key) {
            $json[$i]["Prioridad"] = $key["Prioridad"];
            $json[$i]["CantSolicitudes"] = $key["CantSolicitudes"];
            $i++;
        }
        echo json_encode($json);
    }

    public function denegarSolicitud($idSolicitud){
        $this->db->trans_begin();
        $mensaje = array();
        $bandera = false;
        $arrayCorreo = array();
        $arrayCorreo1 = array();

        try {
            $this->db->where("IdSolicitud", $idSolicitud);

            $datos = array(
                "Estado" => "I",
                "EstadoAutorizado" => "I"
            );
            $save = $this->db->update("Solicitudes", $datos);

            if($save){
                $this->db->where("IdSolicitud", $idSolicitud);

                $datosDet = array(
                    "EstadoAutorizado" => "I"
                );
                $saveDet = $this->db->update("DetalleSolicitud", $datosDet);
                if($saveDet){
                    $bandera = true;
                }else{
                    $bandera = false;
                }
            }else{
                $bandera = false;
            }     
            
            if($bandera){
                 /**************VERIFICAR CORREOS DE SUBORDINADO***************** */
                 $correos = $this->db->query("select t1.Correo from Autorizados t0
                 inner join Usuarios t1 on t1.IdUsuario = t0.IdSolicitante
                 inner join Usuarios t2 on t2.IdUsuario = t0.IdJefe
                 INNER JOIN Solicitudes t3 on t1.IdUsuario = t3.IdUsuario
                 where t2.IdUsuario = '".$this->session->userdata("id")."'
                 and t3.IdSolicitud = '".$idSolicitud."' ");
                 foreach ($correos->result_array() as $key) {
                     $arrayCorreo[] = $key["Correo"];
                 }
                 /********************************************************************************************** */
                 /**************VERIFICAR CORREOS DE PERSONAL DE COMPRAS ACTIVOS***************** */
                 $correos1 = $this->db->query("SELECT * FROM Usuarios WHERE IdRol = 2 AND Estado = 'A'");
                 foreach ($correos1->result_array() as $key) {
                     $arrayCorreo1[] = $key["Correo"];
                 }
                 /********************************************************************************************** */


                 $mensaje[0]["mensaje"] = "Solicitud denegada";
                 $mensaje[0]["tipo"] = "success";
                 $mensaje[0]["correo"] = $arrayCorreo;
                 $mensaje[0]["correoC"] = $arrayCorreo1;
                 echo json_encode($mensaje);
            } 

        } catch (Exception $ex) {
            $this->db->trans_rollback();

            $mensaje[0]["mensaje"] = $ex->getMessage(). "... Código ".$ex->getCode();
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }

        if ($this->db->trans_status() === FALSE)
       {
               $this->db->trans_rollback();
       }
       else
       {
               $this->db->trans_commit();
       }
    }
}

/* End of file Solicitudes_model.php */

?>
