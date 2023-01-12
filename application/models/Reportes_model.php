<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Reportes_model extends CI_Model {
    
     
     public function __construct()
     {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->database();
     }

     public function mostrarAños($search)
     {  
        $qFilter = ""; $json = array(); $i = 0;
        if(isset($search)){
            $qFilter = 'Where (
                YEAR(fechaCrea) LIKE ' . "'%" . $search . "%'" . '
              )';
        }
        $query = $this->db->query("select YEAR(fechaCrea) as Anio from Solicitudes ".$qFilter." GROUP BY YEAR(fechaCrea)");
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key ) {
                $json[$i]["Anio"] = $key["Anio"];
                $i++;
            }
            echo json_encode($json);
        }
     }
        
     public function mostrarSolicitudesRpt($start, $length, $search,$mes,$anio)
     {
		 $srch         = "";
		 $filter       = "";
		 $join         = "";


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

			 $join = "INNER JOIN solicRechazadas t5 on t1.IdSolicitud = t5.idSolicitud
                     LEFT JOIN dbo.Usuarios AS t6 ON t5.idUsuarioRechaza = t6.idUsuario";
			 $filter = "AND t5.estado = 'A' ";
			 $nom    = ',t6.Nombre as RechazadoPor';

		 $qnr = "select count(1) as Cantidad FROM dbo.Solicitudes AS t1
                INNER JOIN dbo.Usuarios AS t2 ON t1.IdUsuario = t2.IdUsuario
                INNER JOIN dbo.Areas AS t3 ON t1.IdArea = t3.IdArea
                LEFT JOIN dbo.Usuarios AS t4 ON t1.IdJefe = t4.IdUsuario
                left JOIN dbo.Usuarios AS t7 ON t1.IdUsuarioAtencion = t7.IdUsuario
                
                WHERE MONTH(t1.FechaSolicitud) = ".$mes." and YEAR(t1.FechaSolicitud) = ".$anio."
                 " . $srch . " ";

		 $qnr = $this->db->query($qnr);
		 $qnr = $qnr->result_array()[0]["Cantidad"];

		 if ($length == -1) {
			 $q = $this->db->query("SELECT t1.*,t2.Nombre,t3.NombreArea,t3.Siglas,t4.Nombre as Jefe,t7.Nombre as PersonalCompra
                                
                                   FROM dbo.Solicitudes AS t1
                                   INNER JOIN dbo.Usuarios AS t2 ON t1.IdUsuario = t2.IdUsuario
                                   INNER JOIN dbo.Areas AS t3 ON t1.IdArea = t3.IdArea
                                   LEFT JOIN dbo.Usuarios AS t4 ON t1.IdJefe = t4.IdUsuario
                                   left JOIN dbo.Usuarios AS t7 ON t1.IdUsuarioAtencion = t7.IdUsuario
                                  
                                   WHERE MONTH(t1.FechaSolicitud) = ".$mes." and YEAR(t1.FechaSolicitud) = ".$anio."
									 " . $srch . "
                                   ORDER BY t1.IdSolicitud asc");
		 } else {
			 $q = $this->db->query("SELECT t1.*,t2.Nombre,t3.NombreArea,t3.Siglas,t4.Nombre as Jefe,
                                    t7.Nombre as PersonalCompra 
                                    FROM dbo.Solicitudes AS t1
                                    INNER JOIN dbo.Usuarios AS t2 ON t1.IdUsuario = t2.IdUsuario
                                    INNER JOIN dbo.Areas AS t3 ON t1.IdArea = t3.IdArea
                                    LEFT JOIN dbo.Usuarios AS t4 ON t1.IdJefe = t4.IdUsuario
                                    left JOIN dbo.Usuarios AS t7 ON t1.IdUsuarioAtencion = t7.IdUsuario
                                    
                                     WHERE MONTH(t1.FechaSolicitud) = ".$mes." and YEAR(t1.FechaSolicitud) = ".$anio."
									
									 " . $srch . "
                                    ORDER BY t1.IdSolicitud asc
                                    offset " . $start . " rows fetch next " . $length . " rows only;");
		 }
		 $retornar = array(
			 "numDataTotal" => $qnr,
			 "datos"        => $q,
		 );
		 return $retornar;
     }
    
    }
    
    /* End of file Reportes_model.php */
    
?>
