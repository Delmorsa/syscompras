<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }
    
    public function getRoles()
    {
        $query = $this->db->get("Roles");
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return 0;
    }

    public function guardarRol($nombre)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $idRol = $this->db->query("SELECT ISNULL(MAX(IdRol),0)+1 as IdRol FROM Roles");
            $data = array(
                "IdRol" => $idRol->result_array()[0]["IdRol"],
                "NombreRol" => $nombre,
                "Estado" => "A",
                "FechaGuarda" => date("Y-m-d H:i:s") 
            );

            $save = $this->db->insert("Roles", $data);

            if($save){
                $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                $mensaje[0]["tipo"] = "success";
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

    public function actualizarRol($idRol,$nombre)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $this->db->where("IdRol", $idRol);
            $data = array(
                "NombreRol" => $nombre,
                "FechaEdita" => date("Y-m-d H:i:s") 
            );

            $save = $this->db->update("Roles", $data);

            if($save){
                $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                $mensaje[0]["tipo"] = "success";
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

    public function actualizarEstado($idRol,$estado)
    {
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $this->db->where("IdRol", $idRol);
            $data = array(
                "Estado" => $estado,
                "FechaBaja" => date("Y-m-d H:i:s")
            );

            $save = $this->db->update("Roles", $data);

            if($save){
                $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                $mensaje[0]["tipo"] = "success";
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

/* End of file Roles_model.php */

?>