<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Solicitudes_model");
        $this->load->model("Compras_model");
        $this->load->model("Reportes_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view("header/bodyHeader");
        $this->load->view("menu/menu_sol");
        $this->load->view('Reportes/reportes');
        $this->load->view("footer/bodyFooter");
    }

    public function historialSolicitudes()
    {
        $this->load->view("header/bodyHeader");
        $this->load->view("menu/menu_sol");
        $this->load->view('Reportes/historialSolic');
        $this->load->view("footer/bodyFooter");
        $this->load->view('jsview/jsReporteHistorial');
    }

    public function iSolicitudes()
    {
        $this->load->view("header/bodyHeader");
       // $this->load->view("menu/menu_sol");
        $this->load->view('Reportes/informes/ISolicitudes');
        $this->load->view("footer/bodyFooter");
        //$this->load->view("footer/footerPivot");
        $this->load->view('jsview/jsInformes');
    }

    public function mostrarAños(){
        $var = $this->input->post("q");
        $this->Reportes_model->mostrarAños($var);
    }

    public function mostrarHistorial($fechainicio, $fechaFin)
    {
        $estadoAct  = "";
        $datos      = array();
        $ribbon     = '';
        $prioridad  = '';
        $start      = $this->input->get_post('start');
        $length     = $this->input->get_post('length');
        $search     = $this->input->get_post('search')['value'];
        $result     = $this->Solicitudes_model->mostrarHistorial($fechainicio, $fechaFin, $start, $length, $search);
        $resultado  = $result["datos"];
        $totalDatos = $result["numDataTotal"];
        foreach ($resultado->result_array() as $key) {
            $array = array();
            switch ($key["Estado"]) {
                case 'A':
                    $estadoAct = '<span class="badge badge-primary fs-7 fw-bold">Abierta</span>';
                    break;
                case 'P':
                    $estadoAct = '<span class="badge badge-warning fs-7 fw-bold">En proceso</span>';
                    break;
                case 'C':
                    $estadoAct = '<span class="badge badge-info fs-7 fw-bold">Cheque</span>';
                    break;
                case 'S':
                    $estadoAct = '<span class="badge badge-success fs-7 fw-bold">Cerrada</span>';
                    break;
                case 'I':
                    $estadoAct = '<span class="badge badge-danger fs-7 fw-bold">Anulada</span>';
                    break;
                case 'R':
                    $estadoAct = '<span class="badge badge-info fs-7 fw-bold">En revision</span>';
                    break;
                default:
                    $estadoAct = '<span class="badge badge-secondary fs-7 fw-bold">En espera</span>';
                    break;
            }

            switch ($key["Prioridad"]) {
                case 1:
                    $prioridad = '';
                    $ribbon    = '';
                    break;
                case 2:
                    $prioridad = 'ribbon ribbon-end ribbon-clip';
                    $ribbon    = '<div style="font-size: 8pt;" class="ribbon-label">Alta
                                <span class="ribbon-inner bg-warning"></span></div>';
                    break;
                case 3:
                    $prioridad = 'ribbon ribbon-end ribbon-clip';
                    $ribbon    = '<div style="font-size: 8pt;" class="ribbon-label">Urgente
                                <span class="ribbon-inner bg-danger"></span></div>';
                    break;
                default:
                    $prioridad = '';
                    $ribbon    = '';
                    break;
            }
            $array["Usuario"]              = $key["Nombre"];
            $array["Consecutivo"]          = $key["Consecutivo"];
            $array["FechaSolicitud"]       = date_format(new DateTime($key["FechaAutoriza"]), "Y-m-d H:i");
            $array["DescripcionSolicitud"] = $key["DescripcionSolicitud"];
            $array["estadoAct"]            = $estadoAct;
            $array["ribbon"]               = $ribbon;
            $array["ClassPri"]             = $prioridad;
            $array["Opciones"]             = "
                    <div class='text-center'>
                        <a data-bs-toggle='tooltip' title='Ver detalles'
                         href='javascript:void(0)' onclick='detalles(" . '"' . $key["IdSolicitud"] . '","' . $key["Consecutivo"] . '"' . ")'
                         class='btn btn-icon btn-warning btn-sm btn-hover-rise me-5'>
                            <span class='svg-icon svg-icon-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <path d='M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z' fill='black'/>
                                    <path opacity='0.3' d='M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z' fill='black'/>
                                </svg>
                            </span>
                        </a>
                    </div>
                ";
            $datos[] = $array;
        }

        $totalDatosObtenidos = $resultado->num_rows(); //cantidad total de registros
        $json_data           = array(
            "draw"            => intval($this->input->get_post('draw')),
            "recordsTotal"    => intval($totalDatosObtenidos),
            "recordsFiltered" => intval($totalDatos),
            "data"            => $datos,
        );

        echo json_encode($json_data);
    }

    public function mostrarHistorialChart($fechainicio, $fechaFin)
    {
        $this->Solicitudes_model->mostrarHistorialChart($fechainicio, $fechaFin);
    }

    public function historialChartPie($fechainicio, $fechaFin)
    {
        $this->Solicitudes_model->historialChartPie($fechainicio, $fechaFin);
    }
    public function historialPrioridad($fechainicio, $fechaFin)
    {
        $this->Solicitudes_model->historialPrioridad($fechainicio, $fechaFin);
    }
    public function rptOrdenesHistorial()
    {
        $datos       = array();
        $start       = $this->input->get_post('start');
        $length      = $this->input->get_post('length');
        $search      = $this->input->get_post('search')['value'];
        $cons        = $this->input->get_post("cons");
        $fechaInicio = $this->input->get_post("fechaInicio");
        $fechaFinal  = $this->input->get_post("fechaFinal");
        $proveedor   = $this->input->get_post("proveedor");
        /* $cons = ($estado == "A") ? $this->input->get_post('columns')[0]["search"]['value'] : $this->input->get_post('columns')[1]["search"]['value'] ;
        $fecha = ($estado == "A") ? $this->input->get_post('columns')[1]["search"]['value'] : $this->input->get_post('columns')[2]["search"]['value'] ;
        $desc = ($estado == "A") ? $this->input->get_post('columns')[2]["search"]['value'] : $this->input->get_post('columns')[3]["search"]['value'] ;
        $solic = ($estado == "A") ? $this->input->get_post('columns')[3]["search"]['value'] : $this->input->get_post('columns')[4]["search"]['value'] ;
        $area = ($estado == "A") ? $this->input->get_post('columns')[4]["search"]['value'] : $this->input->get_post('columns')[5]["search"]['value'] ;
        $priori = ($estado == "A") ? $this->input->get_post('columns')[5]["search"]['value'] : $this->input->get_post('columns')[6]["search"]['value'] ;*/

        $result     = $this->Compras_model->rptOrdenesHistorial($start, $length, $search, $cons, $fechaInicio, $fechaFinal, $proveedor);
        $resultado  = $result["datos"];
        $totalDatos = $result["numDataTotal"];
        foreach ($resultado->result_array() as $key) {
            $array                     = array();
            $array["Consecutivo"]      = $key["Consecutivo"];
            $array["ConsecutivoOrden"] = $key["ConsecutivoOrden"];
            $array["IdProveedor"]      = $key["IdProveedor"];
            $array["Proveedor"]        = $key["Proveedor"];
            $array["Concepto"]         = $key["Concepto"];
            $array["FechaCrea"]        = $key["FechaCrea"];
            $array["Acciones"]         = "";
            $datos[]                   = $array;
        }

        $totalDatosObtenidos = $resultado->num_rows(); //cantidad total de registros
        $json_data           = array(
            "draw"            => intval($this->input->get_post('draw')),
            "recordsTotal"    => intval($totalDatosObtenidos),
            "recordsFiltered" => intval($totalDatos),
            "data"            => $datos,
        );

        echo json_encode($json_data);
    }

    public function mostrarSolicitudesRpt($mes,$anio){
		$start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];
		$result = $this->Reportes_model->mostrarSolicitudesRpt($start, $length, $search,$mes,$anio);
		$resultado = $result["datos"];
		$totalDatos = $result["numDataTotal"];

		$estadoAct = ""; //anulada o activa
		$estadoAut = ""; //autorizada o rechazada
		$opcion = "";
		$opciones = "";
		$prioridad = "";
		$ribbon = '';

		$datos = array();

		foreach ($resultado->result_array() as $key) {
			$array = array();
			switch($key["Estado"]){
				case 'A':
					$estadoAct = '<span class="badge badge-primary fs-7 fw-bold">Abierta</span>';
					break;
				case 'P':
					$estadoAct = '<span class="badge badge-warning fs-7 fw-bold">En proceso</span>';
					break;
				case 'C':
					$estadoAct = '<span class="badge badge-info fs-7 fw-bold">Cheque</span>';
					break;
				case 'S':
					$estadoAct = '<span class="badge badge-success fs-7 fw-bold">Cerrada</span>';
					break;
				case 'I':
					$estadoAct = '<span class="badge badge-danger fs-7 fw-bold">Anulada</span>';
					break;
				case 'R':
					$estadoAct = '<span class="badge badge-info fs-7 fw-bold">Rechazada</span>';
					break;
				default:
					$estadoAct = '<span class="badge badge-secondary fs-7 fw-bold">En espera</span>';
					break;
			}

			switch($key["Prioridad"]){
				case 1:
					$prioridad = '';
					$ribbon ='';
					break;
				case 2:
					$prioridad = 'ribbon ribbon-end ribbon-clip';
					$ribbon = '<div style="font-size: 8pt;" class="ribbon-label">Alta 
                                <span class="ribbon-inner bg-warning"></span></div>';
					break;
				case 3:
					$prioridad = 'ribbon ribbon-end ribbon-clip';
					$ribbon = '<div style="font-size: 8pt;" class="ribbon-label">Urgente 
                                <span class="ribbon-inner bg-danger"></span></div>';
					break;
				default:
					$prioridad = '';
					$ribbon = '';
					break;
			}

			if($key["EstadoAutorizado"] == "Y"){
				$estadoAut = '<span class="badge badge-success fs-7 fw-bold">Autorizada</span>';
			}else if($key["EstadoAutorizado"] == "P"){
				$estadoAut = '<span class="badge badge-warning fs-7 fw-bold">En espera</span>';
			}
			else{
				$estadoAut = '<span class="badge badge-danger fs-7 fw-bold">Rechazada</span>';
			}
			$fechaaut = '';
			if($key["FechaAutoriza"]!=""){
				$fechaaut = date_format(new DateTime($key["FechaAutoriza"]), "Y-m-d H:i:s");
			}else{
				$fechaaut = '';
			}
			$array["IdSolicitud"] = $key["IdSolicitud"];
			$array["Consecutivo"] = $key["Consecutivo"];
			$array["FechaSolicitud"] = $fechaaut;
			$array["DescripcionSolicitud"] = $key["DescripcionSolicitud"];
			$array["Solicitante"] = ($key["Nombre"]);
			$array["Area"] = $key["NombreArea"];
			$array["Jefe"] = $key["Jefe"];
			$array["Estado"] = $estadoAct;
			$array["Prioridad"] = $key["Prioridad"];
			$array["ribbon"] = $ribbon;
			$array["ClassPri"] = $prioridad;
			$array["PersonalCompra"] = $key["PersonalCompra"];

			//onclick='baja(".'"'.$key["IdArea"].'","'.$key["Estado"].'"'.")'
			$datos[] = $array;
		}

		$totalDatosObtenidos = $resultado->num_rows(); //cantidad total de registros
		$json_data = array(
			"draw" => intval($this->input->get_post('draw')),
			"recordsTotal" => intval($totalDatosObtenidos),
			"recordsFiltered" => intval($totalDatos),
			"data" => $datos
		);

		echo json_encode($json_data);
    }
}

/* End of file Reportes_controller.php */
