<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitudes_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Solicitudes_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        } 
    }

    public function index(){
        $this->load->view("header/bodyHeader");
		$this->load->view("menu/menu_sol");
		$this->load->view('Solicitantes/solicitudes');
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/solicitantes/jsSolicitudes");
    }

    public function autSolicitudes(){
        $this->load->view("header/bodyHeader");
		$this->load->view("menu/menu_sol");
		$this->load->view('Solicitantes/autorizarSolic');
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/solicitantes/jsAutSolicitudes");
    }

    public function anularSolicitudes(){
        $this->load->view("header/bodyHeader");
		$this->load->view("menu/menu_sol");
		$this->load->view('Solicitantes/anularSolicitudes');
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/solicitantes/jsAnulSolicitudes");
    }

    public function editSolicitud()
    {
        $data["area"] = $this->Solicitudes_model->getAreaSolic();
        $this->load->view("header/bodyHeader");
		//$this->load->view("menu/menu_sol");
		$this->load->view('Solicitantes/editSolicitud',$data);
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/solicitantes/jsEditSolicitud");
    }

    public function getSolicitudesAjax(){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Solicitudes_model->getSolicitudesAjax($start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAct = ""; //anulada o activa
        $estadoAut = ""; //autorizada o rechazada

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
                        $estadoAct = '<span class="badge badge-info fs-7 fw-bold">En revision</span>';	
                        break;
                default:
                    $estadoAct = '<span class="badge badge-secondary fs-7 fw-bold">En espera</span>';	
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
            $array["Consecutivo"] = $key["Consecutivo"];
            $array["FechaSolicitud"] = date_format(new DateTime($key["FechaAutoriza"]), "Y-m-d H:i");
            $array["DescripcionSolicitud"] = $key["DescripcionSolicitud"];
            $array["FechaCrea"] = date_format(new DateTime($key["FechaCrea"]), "Y-m-d");
            $array["estadoAct"] = $estadoAct;
            $array["estadoAut"] = $estadoAut;

             if($key["Estado"] == "N" && $key["EstadoAutorizado"] == "P"){
                $array["Opciones"] = "
                <div class='text-center'>
                <a href='javascript:void(0)' onclick='detalles(".'"'.$key["IdSolicitud"].'","'.$key["Consecutivo"].'"'.")' class='btn btn-sm btn-hover-rise'>
                    <!--<span class='svg-icon svg-icon-3'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                            <path d='M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z' fill='black'/>
                            <path opacity='0.3' d='M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z' fill='black'/>
                        </svg>
                    </span>-->
                    <i class='fas fa-search text-warning'></i>
                </a>

                <a class='btn btn-sm btn-hover-rise' href='".base_url("index.php/editSolicitud/".$key["IdSolicitud"]."")."'>
                    <i class='fas fa-edit text-primary'></i>
                </a>

                <a href='javascript:void(0)' onclick='baja(".'"'.$key["IdSolicitud"].'","'.$key["Estado"].'","'.$key["EstadoAutorizado"].'","'.$key["Consecutivo"].'"'.")' class='btn btn-icon btn-sm btn-hover-rise'>
                    <!--<span class='svg-icon svg-icon-3'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                            <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>
                            <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>
                            <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>
                        </svg>
                    </span>-->
                    <i class='fas fa-trash text-danger'></i>
                </a>
            </div>
                ";       //idSolicitud,idUsuarioSolicita,comentarioSolic,anula,estado,estadoau   
            }else if($key["Estado"] == "A" && $key["EstadoAutorizado"] == "Y"){
                $array["Opciones"] = "
                    <div class='text-center'>
                        <a href='javascript:void(0)' onclick='detalles(".'"'.$key["IdSolicitud"].'","'.$key["Consecutivo"].'"'.")' class='btn btn-sm btn-hover-rise'>
                            <!--<span class='svg-icon svg-icon-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <path d='M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z' fill='black'/>
                                    <path opacity='0.3' d='M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z' fill='black'/>
                                </svg>
                            </span>-->
                            <i class='fas fa-search text-warning'></i>
                        </a>

                        <a class='btn btn-sm btn-hover-rise' href='".base_url("index.php/editSolicitud/".$key["IdSolicitud"]."")."'>
                            <i class='fas fa-edit text-primary'></i>
                        </a>

                        <a href='javascript:void(0)' onclick='baja(".'"'.$key["IdSolicitud"].'","'.$key["Estado"].'","'.$key["EstadoAutorizado"].'","'.$key["Consecutivo"].'"'.")' class='btn btn-icon btn-sm btn-hover-rise'>
                            <!--<span class='svg-icon svg-icon-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>
                                    <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>
                                    <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>
                                </svg>
                            </span>-->
                            <i class='fas fa-trash text-danger'></i>
                        </a>
                    </div>
            ";    
            }else{
                $array["Opciones"] = "
                    <div class='text-center'>
                        <!--<a href='javascript:void(0)' onclick='detalles(".'"'.$key["IdSolicitud"].'","'.$key["Consecutivo"].'"'.")' class='btn btn-sm btn-hover-rise'>
                            <span class='svg-icon svg-icon-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <path d='M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z' fill='black'/>
                                    <path opacity='0.3' d='M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z' fill='black'/>
                                </svg>
                            </span>
                        </a>-->
                        <a href='javascript:void(0)' onclick='detalles(".'"'.$key["IdSolicitud"].'","'.$key["Consecutivo"].'"'.")' class='btn btn-sm btn-hover-rise'>
                            <i class='fas fa-search text-warning'></i>
                        </a>
                    </div>
                ";         
            }
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

    public function getSolicitudesAutAjax(){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Solicitudes_model->getSolicitudesAutAjax($start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAct = ""; //anulada o activa
        $estadoAut = ""; //autorizada o rechazada

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
                        $estadoAct = '<span class="badge badge-info fs-7 fw-bold">En revision</span>';	
                        break;
                default:
                    $estadoAct = '<span class="badge badge-secondary fs-7 fw-bold">En espera</span>';	
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
            $array["Consecutivo"] = $key["Consecutivo"];
            $array["FechaSolicitud"] = date_format(new DateTime($key["FechaAutoriza"]), "Y-m-d H:i");
            $array["DescripcionSolicitud"] = $key["DescripcionSolicitud"];
            $array["FechaCrea"] = $key["Nombre"];
            $array["estadoAct"] = $estadoAct;
            $array["estadoAut"] = $estadoAut;

             if($key["Estado"] == "N"){
                $array["Opciones"] = "
                    <div class='text-center'>
                        <a data-bs-toggle='tooltip' title='Ver detalles'
                         href='javascript:void(0)' onclick='detalles(".'"'.$key["IdSolicitud"].'","'.$key["Consecutivo"].'"'.")' 
                         class='btn btn-icon btn-warning btn-sm btn-hover-rise me-5'>
                            <span class='svg-icon svg-icon-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <path d='M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z' fill='black'/>
                                    <path opacity='0.3' d='M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z' fill='black'/>
                                </svg>
                            </span>
                        </a>

                        <button type='button'  onclick='autorizar(".'"'.$key["IdSolicitud"].'","'.$key["Consecutivo"].'","'.$key["Correo"].'"'.")'
                            class='btn btn-icon btn-primary btn-sm btn-hover-rise me-5' data-bs-toggle='tooltip' title='Autorizar solicitud'>
                            <span class='svg-icon svg-icon-muted svg-icon-2'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                <path d='M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z' fill='black'/>
                                <path opacity='0.3' d='M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z' fill='black'/>
                            </svg>
                            </span>
                        </button>
                    </div>
                ";       //idSolicitud,idUsuarioSolicita,comentarioSolic,anula,estado,estadoau   
            }
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

    public function getSolicitudesDetAjax($idsolicitud){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Solicitudes_model->getSolicitudesDetAjax($idsolicitud,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAut = ""; //autorizada o rechazada

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();
           
            if($key["EstadoAutorizado"] == "Y"){
                $estadoAut = '<span class="badge badge-success fs-7 fw-bold">Autorizada</span>';	
            }else if($key["EstadoAutorizado"] == "P"){
                $estadoAut = '<span class="badge badge-warning fs-7 fw-bold">En espera</span>';	
            }
            else{
                $estadoAut = '<span class="badge badge-danger fs-7 fw-bold">Rechazada</span>';	
            }
            $array["IdDetallesSolicitud"] = $key["IdDetallesSolicitud"];
            $array["IdSolicitud"] = $key["IdSolicitud"];
            $array["CantidadSolicitud"] = $key["CantidadSolicitud"];
            $array["UnidadMedida"] = $key["UnidadMedida"];
            $array["CantidadAut"] = $key["CantidadAut"];
            $array["DescripcionArticulo"] = $key["DescripcionArticulo"];
            $array["estadoAut"] = $estadoAut;
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

    public function getSolicitudesAutDetAjax($idsolicitud){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Solicitudes_model->getSolicitudesDetAjax($idsolicitud,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAut = ""; //autorizada o rechazada

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();
           
            if($key["EstadoAutorizado"] == "Y"){
                $estadoAut = '<span class="badge badge-success fs-7 fw-bold">Autorizada</span>';	
            }else if($key["EstadoAutorizado"] == "P"){
                $estadoAut = '<span class="badge badge-warning fs-7 fw-bold">En espera</span>';	
            }
            else{
                $estadoAut = '<span class="badge badge-danger fs-7 fw-bold">Rechazada</span>';	
            }
            $array["IdDetallesSolicitud"] = $key["IdDetallesSolicitud"];
            $array["IdSolicitud"] = $key["IdSolicitud"];
            $array["CantidadSolicitud"] = '<input type="number" min="0" readonly class="form-control form-control-transparent" 
            id="cantSolic'.$key["IdDetallesSolicitud"].'" value="'.$key["CantidadSolicitud"].'"/>';

            $array["UnidadMedida"] = '<input type="text" min="0" readonly class="form-control form-control-transparent" 
                                    id="umedida'.$key["IdDetallesSolicitud"].'" value="'.$key["UnidadMedida"].'"/>';

            $array["CantidadAut"] = '<input onkeyup="cantAutInput('."'".$key["IdDetallesSolicitud"]."'".')" type="number" class="form-control form-control-transparent placeholder" 
                                      id="cantAut'.$key["IdDetallesSolicitud"].'" placeholder="'.$key["CantidadAut"].'" min="0"/>
                                      
                                      <span id="badge'.$key["IdDetallesSolicitud"].'" style="display:none;" class="badge badge-danger badge-valida">cantidad no permitida</span>';
            $array["DescripcionArticulo"] = $key["DescripcionArticulo"];
            $array["estadoAut"] = $estadoAut;
            $array["Acciones"] = '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input id="chk'.$key["IdDetallesSolicitud"].'" class="form-check-input check" type="checkbox" value="" />
                                </div>';
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

    public function dashboardSolicitantes(){
        $this->load->view("header/bodyHeader");
		$this->load->view("menu/menu_sol");
		$this->load->view('Solicitantes/DashboardSol');
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/solicitantes/jsDashboard");
    }

    public function nuevaSolic(){
        $data["area"] = $this->Solicitudes_model->getAreaSolic();
        $this->load->view("header/bodyHeader");
		$this->load->view("jsview/solicitantes/imageuploadifycss");
		$this->load->view("menu/menu_sol");
		$this->load->view('Solicitantes/nuevaSolic',$data);
		$this->load->view("footer/bodyFooter");
		$this->load->view("jsview/solicitantes/imageuploadify");
        $this->load->view("jsview/solicitantes/jsNuevaSolicitud");
    }

    public function guardarSolicitud(){
        $this->Solicitudes_model->guardarSolicitud(
            $this->input->post("encabezado"),
            $this->input->post("detalles")
        );
    }

    public function bajaSolicitud(){
        $idSolicitud = $this->input->get_post("idSolicitud");
        $idUsuarioSolicita = $this->session->userdata("id");
        $comentarioSolic = $this->input->get_post("comentarioSolic");
        $anula = $this->input->get_post("anula");

        $this->Solicitudes_model->bajaSolicitud($idSolicitud,$idUsuarioSolicita,$comentarioSolic,$anula);
    }

    public function autorizarSolicitud(){
        $this->Solicitudes_model->autorizarSolicitud(
            $this->input->post("datos"),
			$this->input->post("prioridad")
        );
    }

    public function cargarSolicAnula(){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Solicitudes_model->cargarSolicAnula($start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();

            $array["Consecutivo"] = $key["Consecutivo"];
            $array["FechaSolicitud"] = $key["FechaCreaAnula"];
            $array["DescripcionSolicitud"] = $key["ComentarioSolicAnula"];
            $array["Nombre"] = $key["Nombre"];
            $array["Opciones"] = "
                    <div class='text-center'>
                        <a data-bs-toggle='tooltip' title='Ver detalles'
                         href='javascript:void(0)' onclick='detalles(".'"'.$key["IdSolicitud"].'","'.$key["Consecutivo"].'"'.")' 
                         class='btn btn-sm btn-hover-rise'>
                            <!--<span class='svg-icon svg-icon-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <path d='M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z' fill='black'/>
                                    <path opacity='0.3' d='M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z' fill='black'/>
                                </svg>
                            </span>-->
                            <i class='fas fa-search text-warning'></i>
                        </a>
                        <a href='javascript:void(0)' onclick='anular(".'"'.$key["IdSolicitud"].'","'.$key["Consecutivo"].'"'.")' 
                        class='btn btn-sm btn-hover-rise '>
                            <!--<span class='svg-icon svg-icon-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                    <path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>
                                    <path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>
                                    <path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>
                                </svg>
                            </span>-->
                            <i class='fas fa-trash text-danger'></i>
                        </a>
                        </div>";
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

    public function anularSolicitud(){
        $idSolicitud = $this->input->get_post("idSolicitud");
        $comentarioAnula = $this->input->get_post("comentarioAnula");
        $this->Solicitudes_model->anularSolicitud($idSolicitud,$comentarioAnula);
    }

    public function editSolicitudAjax($idsolicitud){
        $this->Solicitudes_model->editSolicitud($idsolicitud);
    }

    public function actualizarSolicitud(){
        $this->Solicitudes_model->actualizarSolicitud(
            $this->input->post("idSolicitud"),
            $this->input->post("detalles")
        );
    }

    public function denegarSolicitud($idSolicitud){
        $this->Solicitudes_model->denegarSolicitud($idSolicitud);
    }

}

/* End of file Solicitudes_controller.php */

?>
