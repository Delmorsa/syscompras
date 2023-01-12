<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }
    

    public function login($name,$pass){
        if ($name != FALSE && $pass != FALSE) {

            $query = $this->db->query("SELECT t1.*,t2.NombreRol,t3.IdArea,t3.NombreArea,t5.Correo as CorreoJefe
                                        FROM Usuarios t1 
                                        INNER JOIN Roles t2 ON t1.IdRol = t2.IdRol
                                        INNER JOIN Areas t3 ON t1.IdArea= t3.IdArea
                                        left join Autorizados t4 on t1.IdUsuario = t4.IdSolicitante
                                        left join Usuarios t5 on t4.IdJefe = t5.IdUsuario
                                       WHERE t1.Estado = 'A' AND t1.NombreUsuario = '".$name."' AND t1.Password = '".$pass."' ");
            if ($query->num_rows() == 1) {
                return $query->result_array();
            }    
            return 0;
        }
    }
    
    public function conectadoLogin($idusuario,$activo){
        $this->db->where("IdUsuario",$idusuario);
        $data = array(
            "Conectado" => $activo,
            "FechaConectado" => date("Y-m-d H:i:s") 
        );
        $this->db->update("Usuarios", $data);
    }

    public function mostrarConectados(){
        $json = array(); $i = 0; $tiempo = "";
        $query = $this->db->query("select DATEDIFF(SECOND, FechaConectado, getdate()) segundos,
                                    DATEDIFF(minute, FechaConectado, getdate()) minutos,
                                    DATEDIFF(HOUR, FechaConectado, getdate()) Horas,
                                    DATEDIFF(DAY, FechaConectado, getdate()) Dias,
                                    * from Usuarios where Conectado = 'true'
                                    and IdUsuario <> '".$this->session->userdata("id")."' ");

        $query2 = $this->db->query("select count(*) Conectados from Usuarios 
                                    where Conectado = 'true' and IdUsuario <> '".$this->session->userdata("id")."' ");
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                if($key["segundos"] < 60){
                    $tiempo = $key["segundos"]." seg";
                }else if($key["segundos"] >= 60 && $key["minutos"] < 60){
                    $tiempo = $key["minutos"]." min";
                }else if($key["Horas"]<24){
                    $tiempo = $key["Horas"]." hrs";
                }else{
                    $tiempo = $key["Dias"]." dia(s)";
                }
                $json[$i]["NombreUsuario"] = $key["NombreUsuario"];
                $json[$i]["Nombre"] = $key["Nombre"];        
                $json[$i]["Correo"] = $key["Correo"];
                $json[$i]["Genero"] = intval($key["Genero"]);     
                $json[$i]["Conectados"] = $query2->result_array()[0]["Conectados"];
                $json[$i]["TiempoActivo"] = $tiempo;
                $i++;
            }
            echo json_encode($json);
        }
    }

}

/* End of file Login_model.php */

?>
