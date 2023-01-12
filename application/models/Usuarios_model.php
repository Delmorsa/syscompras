<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
    }

    //mostrar usuarios con permiso de autorizacion para asignar como jefes
    public function getUserJefe($search)
    {
        $qfilter = "";
        if(isset($search)){
            $qfilter = "AND Nombre LIKE '%".$search."%' ";
        }else{
            $qfilter = "";
        }

        $query = $this->db->query("SELECT TOP 5 IdUsuario, Nombre FROM Usuarios
                                    WHERE Estado = 'A' AND Autoriza = 'true'
                                    AND IdRol <> 1
                                    ".$qfilter." 
                                    ORDER BY Nombre");
        $json = array();
        $i = 0;
        if($query->num_rows()>0){
            foreach ($query->result_array() as $key) {
                $json[$i]["IdUsuario"] = $key["IdUsuario"];
                $json[$i]["Nombre"] = $key["Nombre"];
                $i++;
            } 
            echo json_encode($json);
        }
    }

    //mostrar usuarios por server side en datatable
    public function getUsuariosAjax($start,$length,$search){
        $srch = ""; 
        if($search){
            $srch = "where (
                      t1.NombreUsuario like '%".$search."%' OR 
                      t1.Nombre like '%".$search."%' OR 
                      t2.NombreRol like '%".$search."%' OR 
                      t3.NombreArea like '%".$search."%' OR 
                      t1.Correo like '%".$search."%' OR 
                      t1.Solicita like '%".$search."%' OR 
                      t1.Autoriza like '%".$search."%' 
                    ) ";
        }

        $qnr = "select count(1) as Cantidad from
                (select t1.* from Usuarios t1
                inner join Roles t2 on t1.IdRol= t2.IdRol
                inner join Areas t3 on t1.IdArea= t3.IdArea 
                ".$srch." ) 
                as tabla";
        $qnr = $this->db->query($qnr);
        $qnr = $qnr->result_array()[0]["Cantidad"];

        if($length == -1){
			$q = $this->db->query("SELECT t1.*,t2.NombreRol,t3.NombreArea,t4.IdJefe ,t5.Nombre as Jefe
                                    from Usuarios t1
                                    inner join Roles t2 on t1.IdRol= t2.IdRol
                                    inner join Areas t3 on t1.IdArea= t3.IdArea 
                                    left join Autorizados t4 on t1.IdUsuario = t4.IdSolicitante
                                    left join Usuarios t5 on t4.IdJefe = t5.IdUsuario
                                    ".$srch." 
                                    ORDER BY t1.IdUsuario desc");
		}else{
			$q = $this->db->query("SELECT t1.*,t2.NombreRol,t3.NombreArea,t4.IdJefe ,t5.Nombre as Jefe
                                    from Usuarios t1
                                    inner join Roles t2 on t1.IdRol= t2.IdRol
                                    inner join Areas t3 on t1.IdArea= t3.IdArea 
                                    left join Autorizados t4 on t1.IdUsuario = t4.IdSolicitante
                                    left join Usuarios t5 on t4.IdJefe = t5.IdUsuario
                                    ".$srch." 
                                    ORDER BY t1.IdUsuario desc
                                    offset ".$start." rows fetch next ".$length." rows only;");
		}

		$retornar = array(
			"numDataTotal" => $qnr,
			"datos" => $q
		);
		return $retornar;
    }

    public function guardarUser($idRol,$idArea,$user,$pass,$nombre,$puesto,$correo,$genero,$solicita,$autoriza,$jefe){
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $idUser = $this->db->query("SELECT ISNULL(MAX(IdUsuario),0)+1 as IdUsuario FROM Usuarios");
            $data = array(
                "IdUsuario" => $idUser->result_array()[0]["IdUsuario"],
                "IdRol" => $idRol,
                "IdArea" => $idArea,
                "NombreUsuario" => $user,
                "Password" => md5($pass),
                "Nombre" => $nombre,
                "Puesto" => $puesto,
                "Correo" => $correo,
                "Genero" => $genero,
                "Estado" => "A",
                "Conectado" => FALSE,
                "Solicita" => $solicita,
                "Autoriza" => $autoriza,
                "FechaCrea" => date("Y-m-d H:i:s")
            );

            $save = $this->db->insert("Usuarios", $data);

            if($save){

                if($jefe != ""){
                    $dataAuth = array(
                        "IdJefe" => $jefe,
                        "IdSolicitante" => $idUser->result_array()[0]["IdUsuario"]
                    );

                    $saveAut = $this->db->insert("Autorizados", $dataAuth);
                    if(!$saveAut){
                        $mensaje[0]["mensaje"] = "Error al asignar el jefe";
                        $mensaje[0]["tipo"] = "error";
                        echo json_encode($mensaje);
                    }else{
                        $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                        $mensaje[0]["tipo"] = "success";
                        echo json_encode($mensaje);
                    }
                }else{
                    $mensaje[0]["mensaje"] = "Datos almacenados con éxito";
                    $mensaje[0]["tipo"] = "success";
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

    public function actualizarUser($idUser,$idRol,$idArea,$user,$nombre,$puesto,$correo,$genero,$solicita,$autoriza,$jefe){
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $this->db->where("IdUsuario", $idUser);
            $data = array(
                "IdRol" => $idRol,
                "IdArea" => $idArea,
                "NombreUsuario" => $user,
                "Nombre" => $nombre,
                "Puesto" => $puesto,
                "Correo" => $correo,
                "Genero" => $genero,
                "Solicita" => $solicita,
                "Autoriza" => $autoriza,
                "FechaActualiza" => date("Y-m-d H:i:s")
            );

            $save = $this->db->update("Usuarios", $data);

            if($save){

                if($jefe != ""){
                    $this->db->where("IdSolicitante", $idUser);
                    $dataAuth = array(
                        "IdJefe" => $jefe
                    );

                    $saveAut = $this->db->update("Autorizados", $dataAuth);
                    if(!$saveAut){
                        $mensaje[0]["mensaje"] = "Error al asignar el jefe";
                        $mensaje[0]["tipo"] = "error";
                        echo json_encode($mensaje);
                    }else{
                        $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                        $mensaje[0]["tipo"] = "success";
                        echo json_encode($mensaje);
                    }
                }else{
                    $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                    $mensaje[0]["tipo"] = "success";
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

    public function bajaUser($idUser,$estado){
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $this->db->where("IdUsuario", $idUser);
            $data = array(
                "Estado" => $estado,
                "FechaBaja" => date("Y-m-d H:i:s")
            );

            $save = $this->db->update("Usuarios", $data);

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

    public function actualizarPass($pass,$newPass){
        $this->db->trans_begin();
        $mensaje = array();

        try {
            $confirmPass = $this->db->query("select Password from Usuarios 
                                            where IdUsuario = '".$this->session->userdata("id")."'
                                            and Password = '".$pass."' "); 

            if($confirmPass->num_rows() > 0){
                $this->db->where("IdUsuario", $this->session->userdata("id"));
                $data = array(
                    "Password" => $newPass,
                );
    
                $save = $this->db->update("Usuarios", $data);
    
                if($save){
                    $mensaje[0]["mensaje"] = "Datos actualizados con éxito";
                    $mensaje[0]["tipo"] = "success";
                    echo json_encode($mensaje);
                }
            }else{
                $mensaje[0]["mensaje"] = "La contraseña que intenta modificar no existe. Verifique que esté escrita correctamente";
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


    /**//////////////////////////////// */

    public function datosSolic(){
        $json = array(); $i = 0;
        if($this->session->userdata("IdRol") == 2){
            $query = $this->db->query("select COUNT(1) as totalSolic, COUNT(case when Estado = 'P' then 1 else Null end) as nuevasSolic,
                                   COUNT(case when Estado = 'S' then 1 else Null end) as solicAtendidas
                                   from Solicitudes where IdUsuarioAtencion = '".$this->session->userdata("id")."' ");
        
            $queryAnul = $this->db->query("select 
            COUNT(case when Estado = 'I' then 1 else Null end) as solicAnuladas
            from Solicitudes where IdUsuarioBaja = '".$this->session->userdata("id")."' ");
        
            foreach ($query->result_array() as $key) {
                $json[$i]["totalSolic"] = $key["totalSolic"];
                $json[$i]["nuevasSolic"] = $key["nuevasSolic"];
                $json[$i]["solicAtendidas"] = $key["solicAtendidas"];
                $json[$i]["solicAnuladas"] = $queryAnul->result_array()[0]["solicAnuladas"];
            }
        }

        echo json_encode($json);

    }

    /*************************************************************************************** */
    public function estadoSolcitudes()
    {
        $json = array(); $i = 0;
        $query = $this->db->query("SELECT * FROM VIEW_ESTADO_SOLICITUDES");
        foreach ($query->result_array() as $key) {
            $json[substr($key["Nombre"],0,1)]["Abiertas"] = $key["Abiertas"];
            $json[substr($key["Nombre"],0,1)]["Proceso"] = $key["Proceso"];
            $json[substr($key["Nombre"],0,1)]["Cerrada"] = $key["Cerrada"];
            $json[substr($key["Nombre"],0,1)]["Rechazada"] = $key["Rechazada"];
            $json[substr($key["Nombre"],0,1)]["Anuladas"] = $key["Anuladas"];
            $json[substr($key["Nombre"],0,1)]["Nombre"] = $key["Nombre"];
            $i++;
        }

        echo json_encode($json);
    }

    public function contadorSolic(){
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
        group by Estado");
        foreach ($query->result_array() as $key) {
            $json[$i]["Estado"] = $key["Estado"];
            $json[$i]["CantSolicitudes"] = $key["CantSolicitudes"];
            $i++;
        }

        echo json_encode($json);
    }
}

/* End of file Usuarios_model.php */

?>