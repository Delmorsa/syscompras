<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function mostrarSolicitudesJefe(){
        $json = array(); $i = 0; $tipo = "";
        $query = $this->db->query("SELECT TOP 10 DATEDIFF(SECOND, t1.FechaCrea, getdate()) segundos,
                                    DATEDIFF(minute, t1.FechaCrea, getdate()) minutos,
                                    DATEDIFF(HOUR, t1.FechaCrea, getdate()) Horas,
                                    DATEDIFF(DAY, t1.FechaCrea, getdate()) Dias,
                                    t1.*,t2.Nombre from Solicitudes t1
                                    inner join Usuarios t2 on t1.IdUsuario = t2.IdUsuario
                                    where t1.IdJefe = '".$this->session->userdata("id")."'
                                    and t1.Estado = 'N' ");

        $query2 = $this->db->query("select count(*) Solicitudes from Solicitudes t1
                                    where t1.IdJefe= '".$this->session->userdata("id")."'
                                     and t1.Estado = 'N' ");
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                if($key["segundos"] < 60){
                    $tiempo = $key["segundos"]." seg";
                }else if($key["segundos"] >= 60 && $key["minutos"] < 60){
                    $tiempo = $key["minutos"]." min";
                }else if($key["Horas"] < 24){
                    $tiempo = $key["Horas"]." hrs";
                }else{
                    $tiempo = $key["Dias"]." dias";
                }
                if($key["TipoSolicitud"] == "C"){
                    $tipo = "Compras";
                }else{
                    $tipo = "Servicio";
                }
                $json[$i]["Nombre"] = $key["Nombre"];
                $json[$i]["Tipo"] = $tipo;        
                $json[$i]["Descripcion"] = $key["DescripcionSolicitud"];  
                $json[$i]["Solicitudes"] = $query2->result_array()[0]["Solicitudes"];
                $json[$i]["TiempoActivo"] = $tiempo;
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function mostrarSolicitudesAut(){
        $json = array(); $i = 0; $tipo = "";
        $query = ""; $query2= ""; $tiempo = 0;
        if($this->session->userdata("IdRol") == 2){
            $query = $this->db->query("SELECT TOP 10 DATEDIFF(SECOND, ISNULL(FechaAutoriza, FechaCrea), getdate()) segundos,
            DATEDIFF(minute, ISNULL(FechaAutoriza, FechaCrea), getdate()) minutos,
            DATEDIFF(HOUR, ISNULL(FechaAutoriza, FechaCrea), getdate()) Horas,
            DATEDIFF(DAY, ISNULL(FechaAutoriza, FechaCrea), getdate()) Dias,
            t1.* from Solicitudes t1
            where t1.Estado = 'A' AND DATEDIFF(DAY, ISNULL(FechaAutoriza, FechaCrea), getdate()) <= 3");

            $query2 = $this->db->query("select count(*) Solicitudes from Solicitudes t1
            where t1.Estado = 'A' ");
        }else if($this->session->userdata("Autoriza") == 1){
            $query = $this->db->query("SELECT TOP 10 DATEDIFF(SECOND, ISNULL(FechaAutoriza, FechaCrea), getdate()) segundos,
            DATEDIFF(minute, ISNULL(FechaAutoriza, FechaCrea), getdate()) minutos,
            DATEDIFF(HOUR, ISNULL(FechaAutoriza, FechaCrea), getdate()) Horas,
            DATEDIFF(DAY, ISNULL(FechaAutoriza, FechaCrea), getdate()) Dias,
            t1.* from Solicitudes t1
            where t1.IdUsuario = '".$this->session->userdata("id")."' AND DATEDIFF(DAY, ISNULL(FechaAutoriza, FechaCrea), getdate()) <= 3
            and t1.Estado = 'P' ");

            $query2 = $this->db->query("select count(*) Solicitudes from Solicitudes t1
                                    where t1.IdUsuario = '".$this->session->userdata("id")."'
                                     and t1.Estado = 'P' ");
        }else{
            $query = $this->db->query("SELECT TOP 10 DATEDIFF(SECOND, ISNULL(FechaAutoriza, FechaCrea), getdate()) segundos,
            DATEDIFF(minute, ISNULL(FechaAutoriza, FechaCrea), getdate()) minutos,
            DATEDIFF(HOUR, ISNULL(FechaAutoriza, FechaCrea), getdate()) Horas,
            DATEDIFF(DAY, ISNULL(FechaAutoriza, FechaCrea), getdate()) Dias,
            t1.* from Solicitudes t1
            where t1.IdUsuario = '".$this->session->userdata("id")."' AND DATEDIFF(DAY, ISNULL(FechaAutoriza, FechaCrea), getdate()) <= 3
            and t1.Estado = 'A' ");

            $query2 = $this->db->query("select count(*) Solicitudes from Solicitudes t1
                                    where t1.IdUsuario = '".$this->session->userdata("id")."'
                                     and t1.Estado = 'A' ");
        }

        
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                if($key["segundos"] < 60){
                    $tiempo = $key["segundos"]." seg";
                }else if($key["segundos"] >= 60 && $key["minutos"] < 60){
                    $tiempo = $key["minutos"]." min";
                }else if($key["Horas"] < 24){
                    $tiempo = $key["Horas"]." hrs";
                }else{
                    $tiempo = $key["Dias"]." dias";
                }
                if($key["TipoSolicitud"] == "C"){
                    $tipo = "Compras";
                }else{
                    $tipo = "Servicio";
                }
                $json[$i]["Consecutivo"] = $key["Consecutivo"];
                $json[$i]["Tipo"] = $tipo;        
                $json[$i]["Descripcion"] = $key["DescripcionSolicitud"];  
                $json[$i]["Solicitudes"] = $query2->result_array()[0]["Solicitudes"];
                $json[$i]["TiempoActivo"] = $tiempo;
                $i++;
            }
            echo json_encode($json);
        }
    }

    public function mostrarSolicitudesAnul(){
        $json = array(); 
        $query2 = $this->db->query("SELECT count(1) Anulaciones  from AnulacionSolictudes t1
                                    where t1.IdJefe = '".$this->session->userdata("id")."'
                                    and t1.Estado = 'A' ");
        if($query2->num_rows()>0){
            $json[0]["SolicitudesAnula"] = $query2->result_array()[0]["Anulaciones"];
            echo json_encode($json);
        }                            
    }


    public function mostrarSolicitudesRechazadas(){
        $json = array(); $i = 0;
        $query = ""; $query2= ""; $tiempo = 0;
        if($this->session->userdata("IdRol") == 2){
            $query = $this->db->query("SELECT TOP 10 DATEDIFF(SECOND, ISNULL(fechaConfirma, fechaConfirma), getdate()) segundos,
            DATEDIFF(minute, ISNULL(fechaConfirma, fechaConfirma), getdate()) minutos,
            DATEDIFF(HOUR, ISNULL(fechaConfirma, fechaConfirma), getdate()) Horas,
            DATEDIFF(DAY, ISNULL(fechaConfirma, fechaConfirma), getdate()) Dias,
            * from SolicRechazadas 
            where Estado = 'I' AND DATEDIFF(DAY, ISNULL(fechaConfirma, fechaConfirma), getdate()) < 3
            and idUsuarioRechaza = '".$this->session->userdata("id")."' ");

            $query2 = $this->db->query("select count(*) SolicRechazadas from SolicRechazadas t1
            where t1.Estado = 'I' and idUsuarioRechaza = '".$this->session->userdata("id")."' 
             AND DATEDIFF(DAY, ISNULL(fechaConfirma, fechaConfirma), getdate()) < 3");
        }else{
            $query = $this->db->query("SELECT TOP 10 DATEDIFF(SECOND, ISNULL(fechaRechazo, fechaRechazo), getdate()) segundos,
            DATEDIFF(minute, ISNULL(fechaRechazo, fechaRechazo), getdate()) minutos,
            DATEDIFF(HOUR, ISNULL(fechaRechazo, fechaRechazo), getdate()) Horas,
            DATEDIFF(DAY, ISNULL(fechaRechazo, fechaRechazo), getdate()) Dias,
            * from SolicRechazadas 
            where Estado = 'A' AND idSolicitante = '".$this->session->userdata("id")."'");

            $query2 = $this->db->query("select count(*) SolicRechazadas from SolicRechazadas
                                    where idSolicitante = '".$this->session->userdata("id")."'
                                     and Estado = 'A' ");
        }

        
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                if($key["segundos"] < 60){
                    $tiempo = $key["segundos"]." seg";
                }else if($key["segundos"] >= 60 && $key["minutos"] < 60){
                    $tiempo = $key["minutos"]." min";
                }else if($key["Horas"] < 24){
                    $tiempo = $key["Horas"]." hrs";
                }else{
                    $tiempo = $key["Dias"]." dias";
                }
                if($this->session->userdata("IdRol") == 2){ 
                    $json[$i]["Consecutivo"] = "La solicitud ".$key["consecutivo"]." ha sido corregida y confirmada"; 
                    $json[$i]["solicitante"] = $key["solicitante"];      
                    $json[$i]["comentario"] = $key["comentarioConfirma"];  
                }else{
                    $json[$i]["Consecutivo"] = "La solicitud ".$key["consecutivo"]." ha sido rechazada";
                    $json[$i]["solicitante"] = "";      
                    $json[$i]["comentario"] = $key["comentarioRechazo"];  
                } 
                $json[$i]["Solicitudes"] = $query2->result_array()[0]["SolicRechazadas"];
                $json[$i]["TiempoActivo"] = $tiempo;
                $i++;
            }
            echo json_encode($json);
        }
    }
}

/* End of file Notificaiones_model.php */

?>