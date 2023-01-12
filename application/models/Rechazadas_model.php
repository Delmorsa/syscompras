<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rechazadas_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("America/Managua");
    }
    
    public function guardarSolRechazada($idSolicitud,$consecutivo,$idSolicitante,$solicitante,$comentarioRechazo){
        $this->db->trans_begin();
        $mensaje = array();
        $arrayCorreo = array();
        try {
            $idRechazada = $this->db->query("SELECT ISNULL(MAX(idRechazada),0)+1 as idRechazada FROM SolicRechazadas");
            $data = array(
                "idRechazada" => $idRechazada->result_array()[0]["idRechazada"],
                "idSolicitud" => $idSolicitud,
                "consecutivo" => $consecutivo,
                "idSolicitante" => $idSolicitante,
                "solicitante" => $solicitante,
                "idUsuarioRechaza" => $this->session->userdata("id"),
                "comentarioRechazo" => $comentarioRechazo,
                "estado" => "A",
                "fechaRechazo" => date("Y-m-d H:i:s")
            );

            $save = $this->db->insert("SolicRechazadas", $data);

            if($save){
                $this->db->where("IdSolicitud", $idSolicitud);
                $dataup = array(
                    "Estado" => "R"
                );
                $up = $this->db->update("Solicitudes",$dataup);

                if($up){
                    /**************VERIFICAR CORREOS DE USUARIO AL QUE SE LE RECHAZA***************** */
                    $correos = $this->db->query("select t1.Correo from Solicitudes t0 
                    inner join Usuarios t1 on t0.IdUsuario = t1.IdUsuario
                    where t0.IdSolicitud = '".$idSolicitud."' ");
                    foreach ($correos->result_array() as $key) {
                        $arrayCorreo[] = $key["Correo"];
                    }
                    array_push($arrayCorreo,"logistica@delmor.com.ni","asistentecompras@delmor.com.ni"); 
                    /********************************************************************************************** */

                    $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    $mensaje[0]["correo"] = $arrayCorreo;
                    echo json_encode($mensaje);
                }

            }else{
                $mensaje[0]["mensaje"] = "Ocurrió un error al intentar guardar los datos favor pongase en conctacto con el administrador";
                $mensaje[0]["tipo"] = "error";
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

    public function SolicConfirmar($idSolicitud,$comentarioConfirma){
        $this->db->trans_begin();
        $mensaje = array();
        if(date("H")  >= 17){
            $mensaje[0]["mensaje"] = "No se permite modificar solicitudes despues de la 5:00 P.M.";
            $mensaje[0]["tipo"] = "error";
            echo json_encode($mensaje);
        }else{
            $arrayCorreo = array();
            try {
                $this->db->where("idSolicitud",$idSolicitud);
                $data = array(
                    "idUsuarioConfirma" => $this->session->userdata("id"),
                    "comentarioConfirma" => $comentarioConfirma,
                    "estado" => "I",
                    "fechaConfirma" => date("Y-m-d H:i:s")
                );

                $save = $this->db->update("SolicRechazadas", $data);

                if($save){
                    $this->db->where("IdSolicitud", $idSolicitud);
                    $dataup = array(
                        "Estado" => "A"
                    );
                    $up = $this->db->update("Solicitudes",$dataup);

                    if($up){
                        /**************VERIFICAR CORREOS DE COMPRAS QUE RECHAZA***************** */
                        $correos = $this->db->query("select distinct t1.Correo from SolicRechazadas t0 
                        inner join Usuarios t1 on t0.idUsuarioRechaza = t1.IdUsuario
                        where t0.IdSolicitud = '".$idSolicitud."' ");
                        foreach ($correos->result_array() as $key) {
                            $arrayCorreo[] = $key["Correo"];
                        }
                        /********************************************************************************************** */
                        $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                        $mensaje[0]["tipo"] = "success";
                        $mensaje[0]["correo"] = $arrayCorreo;
                        echo json_encode($mensaje);
                    }

                }else{
                    $mensaje[0]["mensaje"] = "Ocurrió un error al intentar actualizar los datos favor pongase en conctacto con el administrador";
                    $mensaje[0]["tipo"] = "error";
                    echo json_encode($mensaje);
                }

            } catch (Exception $ex) {
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

}

/* End of file Rechazadas_model.php */

?>