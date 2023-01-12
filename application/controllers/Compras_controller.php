<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_controller extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->model("Compras_model");
        $this->load->model("SapHanaModel");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        } 
    }
    

    public function index()
    {
        $this->load->view("header/bodyHeader");
		$this->load->view("menu/menu_sol");
		$this->load->view('Compras/atenderSolicitud');
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/compras/jsCompras");
    }

    public function ordenPago($idsolicitud)
    {
        $data["encabezado"] = $this->Compras_model->encabezadoOrden($idsolicitud);
        $this->load->view("header/bodyHeader");
		//$this->load->view("menu/menu_sol");
		$this->load->view('Compras/ordenPago',$data);
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/compras/jsOrdenPago");
    }

    public function ordenCompra($idsolicitud)
    {
        $data["encabezado"] = $this->Compras_model->encabezadoOrden($idsolicitud);
        $this->load->view("header/bodyHeader");
		//$this->load->view("menu/menu_sol");
		$this->load->view('Compras/ordenCompra',$data);
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/compras/jsOrdenCompra");
    }

    public function cajaChica($idsolicitud)
    {
        $data["encabezado"] = $this->Compras_model->encabezadoOrden($idsolicitud);
        $this->load->view("header/bodyHeader");
		//$this->load->view("menu/menu_sol");
		$this->load->view('Compras/CajaChica',$data);
		$this->load->view("footer/bodyFooter");
        $this->load->view("jsview/compras/jsCajaChica");
    }

    public function mostrarProveedoresSAPCH(){
        $var = $this->input->post("q");
        $this->SapHanaModel->mostrarProveedoresSAPCH($var);
    }


    public function mostrarProveedoresSAP(){
		$var = $this->input->post("q");
		$this->SapHanaModel->mostrarProveedoresSAP($var);
	}

    public function mostrarImpSAP(){
		$var = $this->input->post("q");
		$this->SapHanaModel->mostrarImpSAP($var);
	}

    public function SolicAutorizadas($estado,$selec){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];
        $cons = ($estado == "A") ? $this->input->get_post('columns')[0]["search"]['value'] : $this->input->get_post('columns')[1]["search"]['value'] ; 
        $fecha = ($estado == "A") ? $this->input->get_post('columns')[1]["search"]['value'] : $this->input->get_post('columns')[2]["search"]['value'] ;
        $desc = ($estado == "A") ? $this->input->get_post('columns')[2]["search"]['value'] : $this->input->get_post('columns')[3]["search"]['value'] ;
        $solic = ($estado == "A") ? $this->input->get_post('columns')[3]["search"]['value'] : $this->input->get_post('columns')[4]["search"]['value'] ;
        $area = ($estado == "A") ? $this->input->get_post('columns')[4]["search"]['value'] : $this->input->get_post('columns')[5]["search"]['value'] ;
        $priori = ($estado == "A") ? $this->input->get_post('columns')[5]["search"]['value'] : $this->input->get_post('columns')[6]["search"]['value'] ;

        $result = $this->Compras_model->SolicAutorizadas($start,$length,$search,$cons,$fecha,$desc,$solic,$area,$priori,$estado,$selec);
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

            if($key["Estado"] == "P"){
                $opcion = '<li><a onclick="detallesOrdenes('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."'".')" class="dropdown-item" href="javascript:void(0)">
                    <span class="svg-icon svg-icon-info svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="7" y="2" width="14" height="16" rx="3" fill="black"/>
                            <rect x="3" y="6" width="14" height="16" rx="3" fill="black"/>
                        </svg>
                    </span>
                    Detalle Ordenes</a></li>';

                    if($key["TipoSolicitud"] == "C"){
                        $opciones = '
                        <li><a class="dropdown-item" href="'.base_url("index.php/editSolicitud/".$key["IdSolicitud"]."").'">
                        <span class="svg-icon svg-icon-primary svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black"></path>
                                                                                                    <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black"></path>
                                                                                                    <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black"></path>
                                                                                                </svg>
                        </span>
                        Editar Solicitud</a></li>
                        <li><a onclick="anularSolicitud('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."', 'true'".')" class="dropdown-item" href="javascript:void(0)">
                        <span class="svg-icon svg-icon-danger svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                    </svg>
                        </span>
                        Anular Solicitud</a></li>';
                    }else{
                        $opciones = '
                    <li><a class="dropdown-item" href="'.base_url("index.php/editSolicitud/".$key["IdSolicitud"]."").'">
                    <span class="svg-icon svg-icon-primary svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black"></path>
                                                                                                <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black"></path>
                                                                                                <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black"></path>
                                                                                            </svg>
                    </span>
                    Editar Solicitud</a></li>
                    <li><a onclick="cerrarSolicitud('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."'".')" class="dropdown-item" href="javascript:void(0)">
                    <span class="svg-icon svg-icon-success svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                    <path opacity="0.5" d="M12.4343 12.4343L10.75 10.75C10.3358 10.3358 9.66421 10.3358 9.25 10.75C8.83579 11.1642 8.83579 11.8358 9.25 12.25L12.2929 15.2929C12.6834 15.6834 13.3166 15.6834 13.7071 15.2929L19.25 9.75C19.6642 9.33579 19.6642 8.66421 19.25 8.25C18.8358 7.83579 18.1642 7.83579 17.75 8.25L13.5657 12.4343C13.2533 12.7467 12.7467 12.7467 12.4343 12.4343Z" fill="black"></path>
                    <path d="M8.43431 12.4343L6.75 10.75C6.33579 10.3358 5.66421 10.3358 5.25 10.75C4.83579 11.1642 4.83579 11.8358 5.25 12.25L8.29289 15.2929C8.68342 15.6834 9.31658 15.6834 9.70711 15.2929L15.25 9.75C15.6642 9.33579 15.6642 8.66421 15.25 8.25C14.8358 7.83579 14.1642 7.83579 13.75 8.25L9.56569 12.4343C9.25327 12.7467 8.74673 12.7467 8.43431 12.4343Z" fill="black"></path>
                </svg>
                    </span>
                    Cerrar Solicitud</a></li>
                    <li><a onclick="anularSolicitud('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."', 'true'".')" class="dropdown-item" href="javascript:void(0)">
                    <span class="svg-icon svg-icon-danger svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                </svg>
                    </span>
                    Anular Solicitud</a></li>';
                    }
              }else if($key["Estado"] == "R"){
                if($this->session->userdata("IdRol")!=2){
                    if($this->session->userdata("Autoriza")==1){
                        $opciones = '
                        <!--<li><hr class="dropdown-divider"></li>-->
                        <li><a class="dropdown-item" href="'.base_url("index.php/editSolicitud/".$key["IdSolicitud"]."").'">
                          <span class="svg-icon svg-icon-primary svg-icon-2">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                      <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black"></path>
                                                                                                      <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black"></path>
                                                                                                      <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black"></path>
                                                                                                  </svg>
                          </span>
                          Editar Solicitud</a></li>
      
                        <li><a onclick="modalRechazo('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."', '".$key["RechazadoPor"]."','".$key["IdUsuario"]."'".')" class="dropdown-item" href="javascript:void(0)">
                          <span class="svg-icon svg-icon-warning svg-icon-2">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                          <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                          <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                      </svg>
                          </span>
                          Confirmar Solicitud</a></li>'; 
                    }else{
                        $opciones = '
                        <!--<li><hr class="dropdown-divider"></li>-->
                        <li><a class="dropdown-item" href="'.base_url("index.php/editSolicitud/".$key["IdSolicitud"]."").'">
                          <span class="svg-icon svg-icon-primary svg-icon-2">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                      <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black"></path>
                                                                                                      <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black"></path>
                                                                                                      <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black"></path>
                                                                                                  </svg>
                          </span>
                          Editar Solicitud</a></li>'; 
                    }
                }
              }else{
                  $opcion = '';
                  $opciones = '
                  <!--<li><hr class="dropdown-divider"></li>-->
                  <li><a class="dropdown-item" href="'.base_url("index.php/editSolicitud/".$key["IdSolicitud"]."").'">
                    <span class="svg-icon svg-icon-primary svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black"></path>
                                                                                                <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black"></path>
                                                                                                <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black"></path>
                                                                                            </svg>
                    </span>
                    Editar Solicitud</a></li>

                  <li><a onclick="modalRechazo('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."', '".$key["Nombre"]."','".$key["IdUsuario"]."'".')" class="dropdown-item" href="javascript:void(0)">
                    <span class="svg-icon svg-icon-warning svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                </svg>
                    </span>
                    Rechazar Solicitud</a></li>

                    <li><a onclick="anularSolicitud('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."', 'false'".')" class="dropdown-item" href="javascript:void(0)">
                  <span class="svg-icon svg-icon-danger svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                  <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                  <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
              </svg>
                  </span>
                  Anular Solicitud</a></li>';
              }

			if($key["Estado"] == "S"){
				$array["Opciones"] = '<div class="dropdown dropup">
                    <a href="javascript:void(0)" id="dropdownMenuButton" 
                     class="dropdown-toggle  me-5 mb-2" data-bs-toggle="dropdown" role="button"
                     aria-expanded="false" data-target="#">
                     <i class="fas fa-cogs text-primary"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" role="menu">
                        <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Acciones</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a onclick="detalles('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."'".')" class="dropdown-item" href="javascript:void(0)">
                            <span class="svg-icon svg-icon-info svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                                <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
                            </svg>
                        </span>
                            Detalle Solicitud</a></li>
                    </ul>
                </div>';
			}else if($key["Estado"] == "I"){
				$array["Opciones"] = '<div class="dropdown dropup">
                    <a href="javascript:void(0)" id="dropdownMenuButton" 
                     class="dropdown-toggle  me-5 mb-2" data-bs-toggle="dropdown" role="button"
                     aria-expanded="false" data-target="#">
                     <i class="fas fa-cogs text-primary"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" role="menu">
                        <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Acciones</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a onclick="detalles('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."'".')" class="dropdown-item" href="javascript:void(0)">
                            <span class="svg-icon svg-icon-info svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                                <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
                            </svg>
                        </span>
                            Detalle Solicitud</a></li>
                    </ul>
                </div>';
			}else if($key["Estado"] == "R"){
				if($this->session->userdata("IdRol") != 2){
                    $array["Opciones"] = '
                    <div class="dropdown dropup">
                        <a href="javascript:void(0)" id="dropdownMenuButton" 
                         class="dropdown-toggle  me-5 mb-2" data-bs-toggle="dropdown" role="button"
                         aria-expanded="false" data-target="#">
                         <i class="fas fa-cogs text-primary"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" role="menu">
                            <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Acciones</a></li>
                            <li><hr class="dropdown-divider"></li>
                            '.$opciones.'
                            <li><hr class="dropdown-divider"></li>
                            <li><a onclick="detalles('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."'".')" class="dropdown-item" href="javascript:void(0)">
                                <span class="svg-icon svg-icon-info svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                                    <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
                                </svg>
                            </span>
                                Detalle Solicitud</a></li>
                        </ul>
                    </div>
                    ';
                }else{
                    $array["Opciones"] = '<div class="dropdown dropup">
                    <a href="javascript:void(0)" id="dropdownMenuButton" 
                     class="dropdown-toggle  me-5 mb-2" data-bs-toggle="dropdown" role="button"
                     aria-expanded="false" data-target="#">
                     <i class="fas fa-cogs text-primary"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" role="menu">
                        <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Acciones</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a onclick="detalles('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."'".')" class="dropdown-item" href="javascript:void(0)">
                            <span class="svg-icon svg-icon-info svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                                <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
                            </svg>
                        </span>
                            Detalle Solicitud</a></li>
                    </ul>
                </div>';
                }
			}else{
				$array["Opciones"] = '
                    <div class="text-center d-flex gap-2 mb-2">
                        <div class="dropdown dropup">
                        <a href="javascript:void(0)" id="dropdownMenuButton1" 
                        class="dropdown-toggle  me-5 mb-2" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false" data-target="#">
                        <i class="fas fa-copy text-warning"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" role="menu">
                        <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Desglose</a></li>
                        <li><hr class="dropdown-divider"></li>
            
                        <li>
                            <a class="dropdown-item" href="'.base_url("index.php/ordenCompra/").$key["IdSolicitud"].'"> 
                                <span class="svg-icon svg-icon-info svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M3 3V17H7V21H15V9H20V3H3Z" fill="black"/>
                                        <path d="M20 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V21C21 21.6 20.6 22 20 22ZM19 4H4V8H19V4ZM6 18H4V20H6V18ZM6 14H4V16H6V14ZM6 10H4V12H6V10ZM10 18H8V20H10V18ZM10 14H8V16H10V14ZM10 10H8V12H10V10ZM14 18H12V20H14V18ZM14 14H12V16H14V14ZM14 10H12V12H14V10ZM19 14H17V20H19V14ZM19 10H17V12H19V10Z" fill="black"/>
                                    </svg>
                                </span>
                            Orden de compra
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="'.base_url("index.php/ordenPago/").$key["IdSolicitud"].'">
                                <span class="svg-icon svg-icon-info svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="black"/>
                                        <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="black"/>
                                        <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="black"/>
                                    </svg>
                                </span>
                            Orden de pago</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="'.base_url("index.php/cajaChica/").$key["IdSolicitud"].'">
                                <span class="svg-icon svg-icon-info svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M6 20C6 20.6 5.6 21 5 21C4.4 21 4 20.6 4 20H6ZM18 20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20H18Z" fill="black"/>
                                <path opacity="0.3" d="M21 20H3C2.4 20 2 19.6 2 19V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V19C22 19.6 21.6 20 21 20ZM12 10H10.7C10.5 9.7 10.3 9.50005 10 9.30005V8C10 7.4 9.6 7 9 7C8.4 7 8 7.4 8 8V9.30005C7.7 9.50005 7.5 9.7 7.3 10H6C5.4 10 5 10.4 5 11C5 11.6 5.4 12 6 12H7.3C7.5 12.3 7.7 12.5 8 12.7V14C8 14.6 8.4 15 9 15C9.6 15 10 14.6 10 14V12.7C10.3 12.5 10.5 12.3 10.7 12H12C12.6 12 13 11.6 13 11C13 10.4 12.6 10 12 10Z" fill="black"/>
                                <path d="M18.5 11C18.5 10.2 17.8 9.5 17 9.5C16.2 9.5 15.5 10.2 15.5 11C15.5 11.4 15.7 11.8 16 12.1V13C16 13.6 16.4 14 17 14C17.6 14 18 13.6 18 13V12.1C18.3 11.8 18.5 11.4 18.5 11Z" fill="black"/>
                                </svg>
                                </span>
                            Caja Chica</a>
                        </li>
                        <li><hr class="dropdown-divider"></li> 
                        <li><a onclick="detalles('."'".$key["IdSolicitud"]."', '".$key["Consecutivo"]."'".')" class="dropdown-item" href="javascript:void(0)">
                        <span class="svg-icon svg-icon-info svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                            <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
                        </svg>
                    </span>
                        Detalle Solicitud</a></li>
                        '.$opcion.'
                        </ul>
                    </div>
            
                    <div class="dropdown dropup">
                        <a href="javascript:void(0)" id="dropdownMenuButton" 
                        class="dropdown-toggle  me-5 mb-2" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false" data-target="#">
                        <i class="fas fa-cogs text-primary"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" role="menu">
                        <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Acciones</a></li>
                        <li><hr class="dropdown-divider"></li>
                        '.$opciones.'
                        </ul>
                    </div>
                    </div>
                ';
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

    public function getSolicitudesDetOrden($idsolicitud){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Compras_model->getSolicitudesDetOrden($idsolicitud,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAut = ""; //autorizada o rechazada

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();

            $array["IdDetallesSolicitud"] = $key["IdDetallesSolicitud"];
            $array["IdSolicitud"] = $key["IdSolicitud"];

            $array["DescripcionArticulo"] = $key["DescripcionArticulo"];

            $array["DescripcionProv"] = '<input type="text" class="form-control form-control-transparent" 
                                    id="descProv'.$key["IdDetallesSolicitud"].'" placeholder="Articulo"/>';
            
            $array["Proforma"] = '<input type="text" class="form-control form-control-transparent placeholder" 
                                    id="proforma'.$key["IdDetallesSolicitud"].'" value="" placeholder="proforma"/>';

            $array["CantidadAut"] = '<input readonly type="number" class="form-control form-control-transparent placeholder" 
            id="cantAut'.$key["IdDetallesSolicitud"].'" value="'.$key["CantidadDisponible"].'" min="0"/>';

            $array["CantidadComp"] = '<input onkeyup="subtotal('."'".$key["IdDetallesSolicitud"]."'".');descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');" 
                                            type="number" class="form-control form-control-transparent placeholder" 
                                            id="cantComp'.$key["IdDetallesSolicitud"].'" value="0" placeholder="cant comp" min="0"/>';

            $array["UnidadMedida"] = '<input type="text" class="form-control form-control-transparent" 
                                    id="umedida'.$key["IdDetallesSolicitud"].'" placeholder="'.$key["UnidadMedida"].'" value="'.$key["UnidadMedida"].'"/>';
            
            $array["Importe"] = '<input onkeyup="subtotal('."'".$key["IdDetallesSolicitud"]."'".');
                                                 descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
                                                 aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')" 
            type="number" class="form-control form-control-transparent placeholder" 
                                    id="importe'.$key["IdDetallesSolicitud"].'" value="0" placeholder="precio"/>';

            $array["porcDesc"] = '<input onkeyup="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
                                                  aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')" 
                                                  type="number" class="form-control form-control-transparent placeholder" 
                                    id="porcDesc'.$key["IdDetallesSolicitud"].'" value="0" placeholder="0"/>';

            $array["montoDesc"] = '<input type="number" readonly class="form-control form-control-transparent placeholder" 
                                    id="montoDesc'.$key["IdDetallesSolicitud"].'" value="0" placeholder="0"/>';
                                  
            $array["impuesto"] = '<select onchange="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
                                                    aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".');" 
                                                    id="lisImpuesto'.$key["IdDetallesSolicitud"].'" data-dropdown-css-class="w-100px"
                                    data-control="select2"
                                    class="form-select form-select-sm col-md-4 imp"> 
                                    <option selected value="0.00">EXE</option>
                                  </select>';  

            $array["moneda"] = '<select onchange="aplicarMoneda('."'".$key["IdDetallesSolicitud"]."'".')" id="lisMoneda'.$key["IdDetallesSolicitud"].'" data-dropdown-css-class="w-100px"
                                  data-control="select2"
                                  class="form-select form-select-sm col-md-4" data-control="select2" data-allow-clear="true"> 
                                  <option disabled value="C">C$</option>
                                  <option value="C">C$</option>
                                  <option  value="S">$</option>
                                </select>';     

            $array["subtotal"] = '<input keyup="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".')" type="number" readonly class="form-control form-control-transparent placeholder subtotal" 
                                    id="subtotal'.$key["IdDetallesSolicitud"].'" value="" placeholder="0"/>';

            $array["total"] = '<input type="text" readonly class="form-control form-control-transparent placeholder total" 
                                    id="total'.$key["IdDetallesSolicitud"].'" value="" placeholder="0"/>';                 

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

    public function saveOrdenPago(){
        $this->Compras_model->saveOrdenPago(
            $this->input->post("enc"),
            $this->input->post("detalle")
         );
    }

    public function updateOrdenPago(){
        $this->Compras_model->updateOrdenPago(
            $this->input->post("enc"),
            $this->input->post("detalle")
         );
    }

    public function updateOrdenCompra(){
        $this->Compras_model->updateOrdenCompra(
            $this->input->post("enc"),
            $this->input->post("detalle")
         );
    }

    public function updateCajaChica(){
        $this->Compras_model->updateCajaChica(
            $this->input->post("enc"),
            $this->input->post("detalle")
         );
    }

    public function saveOrdenCompra(){
        $this->Compras_model->saveOrdenCompra(
            $this->input->post("enc"),
            $this->input->post("detalle")
         );
    }

    public function addItemOP(){
        $this->Compras_model->addItemOP(
            $this->input->post("enc"),
            $this->input->post("detalle")
         );
    }

    public function addItemOC(){
        $this->Compras_model->addItemOC(
            $this->input->post("enc"),
            $this->input->post("detalle")
         );
    }

    public function addItemCH(){
        $this->Compras_model->addItemCH(
            $this->input->post("enc"),
            $this->input->post("detalle")
         );
    }

    public function mostrarOC($idsolicitud){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Compras_model->mostrarOC($idsolicitud,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();
            
            $array["IdOrdenCompra"] = $key["IdOrdenCompra"];
            $array["IdSolicitud"] = $key["IdSolicitud"];
            $array["Consecutivo"] = $key["ConsecutivoOC"];
            $array["FechaOC"] = date_format(new DateTime($key["FechaCrea"]), "Y-m-d H:i:s");
            $array["Direccion"] = $key["Direccion"];
            $array["Proveedor"] = $key["Proveedor"];
            $array["TiempoEntrega"] = $key["TiempoEntrega"];
            $array["Opciones"] = '
            <div class="dropdown dropup">
                                <a href="javascript:void(0)" id="dropdownMenuButton" class="dropdown-toggle  " data-bs-toggle="dropdown"
                                role="button" aria-expanded="false" data-target="#">
                                    <i class="fas fa-cogs text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" role="menu">
                                    <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Opciones</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a href="javascript:void(0)" class="dropdown-item detalles">
                                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                                <i class="fas fa-info-circle text-primary "></i>
                                                Ver Detalles
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                            <a href="javascript:void(0)" class="dropdown-item  imprimirOC">
                                                <span class="svg-icon svg-icon-primary svg-icon-2">
                                                    <i class="fas fa-print text-success"></i>
                                                    Imprimir Orden
                                                </span>
                                            </a>
                                    </li>  
                                    <li>
                                        <a href="viewAddItemOrder/1/'.$key["IdSolicitud"].'/'.$key["IdOrdenCompra"].'" class="dropdown-item ">
                                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                                    <i class="fas fa-plus-square text-warning"></i>
                                                    Agregar Articulos
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="jsbajaOrden('."'".$key["IdOrdenCompra"]."','".'1'."'".')" href="javascript:void(0)" class="dropdown-item">
                                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                                <i class="fas fa-trash text-danger "></i>
                                                Anular Orden
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>';
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

    public function mostrarDetOC($idOrdenCompra)
    {
        $this->Compras_model->mostrarDetOC($idOrdenCompra);
    }

    public function mostrarOP($idsolicitud){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Compras_model->mostrarOP($idsolicitud,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();
            
            $array["IdOrdenPago"] = $key["IdOrdenPago"];
            $array["ConsecutivoOP"] = $key["ConsecutivoOP"];
            $array["Proveedor"] = $key["Proveedor"];
            $array["NombreCheque"] = $key["NombreCheque"];
            $array["Cantidad"] = $key["Cantidad"];
            $array["CantidadDesc"] = $key["CantidadDesc"];
            $array["Concepto"] = $key["Concepto"];
            $array["Retiene"] = $key["Retiene"];
            $array["ComentarioRetiene"] = $key["ComentarioRetiene"];
            $array["FechaCrea"] = date_format(new DateTime($key["FechaCrea"]), "Y-m-d");
            $array["Opciones"] = '
                            <div class="dropdown dropup">
                                <a href="javascript:void(0)" id="dropdownMenuButton" class="dropdown-toggle  " data-bs-toggle="dropdown"
                                role="button" aria-expanded="false" data-target="#">
                                    <i class="fas fa-cogs text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" role="menu">
                                    <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Opciones</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a javascript:void(0) class="dropdown-item detallesOP">
                                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                                <i class="fas fa-info-circle text-primary"></i>
                                                Ver Detalles
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"  class="dropdown-item imprimirOP">
                                            <span class="svg-icon svg-icon-primary svg-icon-3">
                                                <i class="fas fa-print text-success"></i>
                                                Imprimir Orden
                                            </span>
                                        </a>
                                    </li>  
                                    <li>
                                        <a href="viewAddItemOrder/2/'.$key["IdSolicitud"].'/'.$key["IdOrdenPago"].'" class="dropdown-item">
                                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                                <i class="fas fa-plus-square text-warning "></i>
                                                Agregar Articulos
                                            </span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a onclick="jsbajaOrden('."'".$key["IdOrdenPago"]."','".'2'."'".')" href="javascript:void(0)" class="dropdown-item">
                                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                                <i class="fas fa-trash text-danger "></i>
                                                Anular Orden
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>';
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

    public function mostrarDetOP($idOrdenPago)
    {
        $this->Compras_model->mostrarDetOP($idOrdenPago);
    }

    public function saveCajaChica(){
        $this->Compras_model->saveCajaChica(
            $this->input->post("enc"),
            $this->input->post("detalle")
         );
    }

	public function mostrarCH($idsolicitud){
		$start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

		$result = $this->Compras_model->mostrarCH($idsolicitud,$start,$length,$search);
		$resultado = $result["datos"];
		$totalDatos = $result["numDataTotal"];

		$datos = array();

		foreach ($resultado->result_array() as $key) {
			$array = array();

			$array["IdCajaChica"] = $key["IdCajaChica"];
		    $array["IdSolicitud"] = $key["IdSolicitud"];
		    $array["consecutivoCH"] = $key["consecutivoCH"];
		    $array["fechaCrea"] = date_format(new DateTime($key["fechaRecibo"]), "Y-m-d");
		    $array["horaCrea"] = $key["horaCrea"];
		    $array["idUsuarioCrea"] = $key["idUsuarioCrea"];
		    $array["Proveedor"] = $key["Proveedor"];
            $array["Concepto"] = $key["Concepto"];
            $array["Total"] = $key["Total"];
            $array["Opciones"] = '
                            <div class="dropdown dropup">
                                <a href="javascript:void(0)" id="dropdownMenuButtonCH" class="dropdown-toggle  " data-bs-toggle="dropdown"
                                role="button" aria-expanded="false" data-target="#">
                                    <i class="fas fa-cogs text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonCH" role="menu">
                                    <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#"> Opciones</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a javascript:void(0) class="dropdown-item detallesCH">
                                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                                <i class="fas fa-info-circle text-primary"></i>
                                                Ver Detalles
                                            </span>
                                        </a>
                                    </li>
                                    <!--<li>
                                        <a href="javascript:void(0)"  class="dropdown-item imprimirCH">
                                            <span class="svg-icon svg-icon-primary svg-icon-3">
                                                <i class="fas fa-print text-success"></i>
                                                Imprimir Orden
                                            </span>
                                        </a>
                                    </li>  -->
                                    <li>
                                        <a href="viewAddItemOrder/3/'.$key["IdSolicitud"].'/'.$key["IdCajaChica"].'" class="dropdown-item">
                                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                                <i class="fas fa-plus-square text-warning "></i>
                                                Agregar Articulos
                                            </span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a onclick="jsbajaOrden('."'".$key["IdCajaChica"]."','".'3'."'".')" href="javascript:void(0)" class="dropdown-item">
                                            <span class="svg-icon svg-icon-primary svg-icon-2">
                                                <i class="fas fa-trash text-danger "></i>
                                                Anular Caja Chica
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>';
			$datos[] = $array;
		}

		$totalDatosObtenidos = $resultado->num_rows();
		$json_data = array(
			"draw" => intval($this->input->get_post('draw')),
			"recordsTotal" => intval($totalDatosObtenidos),
			"recordsFiltered" => intval($totalDatos),
			"data" => $datos
		);

		echo json_encode($json_data);
	}

	public function mostrarDetCH($idCH){
		$this->Compras_model->mostrarDetCH($idCH);
	}

	/*public function updateCajaChica(){
		$idDetCH = $this->input->get_post("idDetCH");
		$fecha = $this->input->get_post("fecha");
		$concepto = $this->input->get_post("concepto");
		$numFac = $this->input->get_post("numFac");
		$benef = $this->input->get_post("benef");
		$imp = $this->input->get_post("imp");
		$porcImp = $this->input->get_post("porcImp");
		$subTotal = $this->input->get_post("subTotal");
		$total = $this->input->get_post("total");
		$this->Compras_model->updateCajaChica($idDetCH,$fecha,$concepto,$numFac,$benef,$imp,$porcImp,$subTotal,$total);
	}*/

	public function cerraSolicitud($idSolicitud){
		$this->Compras_model->cerraSolicitud($idSolicitud);
	}

    public function viewEditOrder($tipo,$idsol,$idorden){
        $data["encabezado"] = $this->Compras_model->encabezadoOrden($idsol);
        $data["encOrden"] = $this->Compras_model->editOrdersEnc($tipo,$idorden);
        $this->load->view("header/bodyHeader");
		//$this->load->view("menu/menu_sol");
        if($tipo == 1){
            $this->load->view('Compras/editOC',$data);
        }else if($tipo == 2){
            $this->load->view('Compras/editOP',$data);
        }else if($tipo == 3){
            $this->load->view('Compras/editCH',$data);
        }
		$this->load->view("footer/bodyFooter");
        if($tipo == 1){
            $this->load->view("jsview/compras/jseditOC");
        }else if($tipo == 2){
            $this->load->view("jsview/compras/jseditOP");
        }else if($tipo == 3){
            $this->load->view("jsview/compras/jseditCH");
        }
    }

    public function viewAddItemOrder($tipo,$idsol,$idorden){
        $data["encabezado"] = $this->Compras_model->encabezadoOrden($idsol);
        $data["encOrden"] = $this->Compras_model->editOrdersEnc($tipo,$idorden);
        $this->load->view("header/bodyHeader");
		//$this->load->view("menu/menu_sol");
        if($tipo == 1){
            $this->load->view('Compras/addItemOC',$data);
        }else if($tipo == 2){
            $this->load->view('Compras/addItemOP',$data);
        }else if($tipo == 3){
            $this->load->view('Compras/addItemCH',$data);
        }
		$this->load->view("footer/bodyFooter");
        if($tipo == 1){
            $this->load->view("jsview/compras/jsAddItemOC");
        }else if($tipo == 2){
            $this->load->view("jsview/compras/jsAddItemOP");
        }else if($tipo == 3){
            $this->load->view("jsview/compras/jsAddItemCH");
        }
    }

    public function editOrders($tipo,$idSolic,$idOrden){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Compras_model->editOrders($tipo,$idSolic,$idOrden,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAut = ""; //autorizada o rechazada

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();

            $array["IdDetalleOP"] = $key["IdDetalleOP"]; 
            $array["IdDetallesSolicitud"] = $key["IdDetallesSolicitud"];
            $array["IdSolicitud"] = $key["IdSolicitud"];

            $array["DescripcionArticulo"] = $key["ArticuloOP"];

            $array["DescripcionProv"] = '<input value="'.$key["ArticuloProveedorOP"].'" type="text" class="form-control form-control-transparent" 
                                    id="descProv'.$key["IdDetallesSolicitud"].'" placeholder="Articulo"/>';
            
            $array["Proforma"] = '<input type="text" class="form-control form-control-transparent placeholder" 
                                    id="proforma'.$key["IdDetallesSolicitud"].'" value="'.$key["NumProformaOP"].'" placeholder="proforma"/>';

            $array["CantidadAut"] = '<input readonly type="number" class="form-control form-control-transparent placeholder" 
            id="cantAut'.$key["IdDetallesSolicitud"].'" value="'.$key["CantidadDisponible"].'" min="0"/>';

            $array["CantidadComp"] = '<input value="'.$key["CantidadOP"].'"
                                             onkeyup="subtotal('."'".$key["IdDetallesSolicitud"]."'".');descAndTotal('."'".$key["IdDetallesSolicitud"]."'".')" 
                                            type="number" class="form-control form-control-transparent placeholder" 
                                            id="cantComp'.$key["IdDetallesSolicitud"].'" placeholder="cant comp" min="0"/>';

            $array["UnidadMedida"] = '<input type="text" class="form-control form-control-transparent" 
                                    id="umedida'.$key["IdDetallesSolicitud"].'" placeholder="'.$key["UnidadMedida"].'" value="'.$key["UnidadMedida"].'"/>';
            
            $array["Importe"] = '<input value="'.$key["precioOP"].'" onkeyup="subtotal('."'".$key["IdDetallesSolicitud"]."'".');
            descAndTotal('."'".$key["IdDetallesSolicitud"]."'".'); aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')" 
            type="number" class="form-control form-control-transparent placeholder" 
                                    id="importe'.$key["IdDetallesSolicitud"].'" placeholder="precio"/>';

            $array["porcDesc"] = '<input onkeyup="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
                                                  aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')"" 
                                                  type="number" class="form-control form-control-transparent placeholder" 
                                    id="porcDesc'.$key["IdDetallesSolicitud"].'" value="'.number_format($key["porcentDescOP"],2).'" placeholder="0"/>';

            $array["montoDesc"] = '<input type="number" readonly class="form-control form-control-transparent placeholder" 
                                    id="montoDesc'.$key["IdDetallesSolicitud"].'" value="'.number_format($key["MontoDescOP"],2).'" placeholder="0"/>';
                                  
            $array["impuesto"] = '<select onchange="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
                                                    aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')" 
                                                    id="lisImpuesto'.$key["IdDetallesSolicitud"].'" data-dropdown-css-class="w-100px"
                                    data-control="select2"
                                    class="form-select form-select-sm col-md-4 imp"> 
                                    <option selected value="'.$key["PorcentImpuestoOP"].'">'.$key["CodImpuestoOP"].'</option>
                                  </select>';  

            $array["moneda"] = '<select onchange="aplicarMoneda('."'".$key["IdDetallesSolicitud"]."'".')" id="lisMoneda'.$key["IdDetallesSolicitud"].'" data-dropdown-css-class="w-100px"
                                  data-control="select2"
                                  class="form-select form-select-sm col-md-4" data-control="select2" data-allow-clear="true"> 
                                  <option selected value="C">C$</option>
                                  <option  value="S">$</option>
                                </select>';     

            $array["subtotal"] = '<input change="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".')" type="number" readonly class="form-control form-control-transparent placeholder subtotal" 
                                    id="subtotal'.$key["IdDetallesSolicitud"].'" value="'.$key["SubTotalOP"].'" placeholder="0"/>';

            $array["total"] = '<input type="text" readonly class="form-control form-control-transparent placeholder total" 
                                    id="total'.$key["IdDetallesSolicitud"].'" value="'.$key["TotalOP"].'" placeholder="0"/>';                 

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

    public function editOrdersC($tipo,$idSolic,$idOrden){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Compras_model->editOrders($tipo,$idSolic,$idOrden,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAut = ""; //autorizada o rechazada

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();

            $array["IdDetalleOC"] = $key["IdDetalleOC"];
            $array["IdDetallesSolicitud"] = $key["IdDetallesSolicitud"];
            $array["IdSolicitud"] = $key["IdSolicitud"];

            $array["DescripcionArticulo"] = $key["ArticuloOC"];

            $array["DescripcionProv"] = '<input value="'.$key["ArticuloProveedorOC"].'" type="text" class="form-control form-control-transparent" 
                                    id="descProv'.$key["IdDetallesSolicitud"].'" placeholder="Articulo"/>';
            
            $array["Proforma"] = '<input type="text" class="form-control form-control-transparent placeholder" 
                                    id="proforma'.$key["IdDetallesSolicitud"].'" value="'.$key["NumProformaOC"].'" placeholder="proforma"/>';

            $array["CantidadAut"] = '<input readonly type="number" class="form-control form-control-transparent placeholder" 
            id="cantAut'.$key["IdDetallesSolicitud"].'" value="'.$key["CantidadDisponible"].'" min="0"/>';

            $array["CantidadComp"] = '<input value="'.$key["CantidadOC"].'"
                                             onkeyup="subtotal('."'".$key["IdDetallesSolicitud"]."'".')" 
                                            onchange="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".')"
                                            type="number" class="form-control form-control-transparent placeholder" 
                                            id="cantComp'.$key["IdDetallesSolicitud"].'" placeholder="cant comp" min="0"/>';

            $array["UnidadMedida"] = '<input type="text" class="form-control form-control-transparent" 
                                    id="umedida'.$key["IdDetallesSolicitud"].'" placeholder="'.$key["UnidadMedida"].'" value="'.$key["UnidadMedida"].'"/>';
            
            $array["Importe"] = '<input value="'.number_format($key["precioOC"],2).'" 
                                onkeyup="subtotal('."'".$key["IdDetallesSolicitud"]."'".');
                                descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
                                aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')" 
            type="number" class="form-control form-control-transparent placeholder" 
                                    id="importe'.$key["IdDetallesSolicitud"].'" placeholder="precio"/>';

            $array["porcDesc"] = '<input onkeyup="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
                                                aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')" 
                                                type="number" class="form-control form-control-transparent placeholder" 
                                    id="porcDesc'.$key["IdDetallesSolicitud"].'" value="'.number_format($key["porcentDescOC"],2).'" placeholder="0"/>';

            $array["montoDesc"] = '<input type="number" readonly class="form-control form-control-transparent placeholder" 
                                    id="montoDesc'.$key["IdDetallesSolicitud"].'" value="'.number_format($key["MontoDescOC"],2).'" placeholder="0"/>';
                                  
            $array["impuesto"] = '<select onchange="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
            aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')" id="lisImpuesto'.$key["IdDetallesSolicitud"].'" data-dropdown-css-class="w-100px"
                                    data-control="select2"
                                    class="form-select form-select-sm col-md-4 imp"> 
                                    <option selected value="'.$key["PorcentImpuestoOC"].'">'.$key["CodImpuestoOC"].'</option>
                                  </select>';  

            $array["moneda"] = '<select id="lisMoneda'.$key["IdDetallesSolicitud"].'" data-dropdown-css-class="w-100px"
                                  data-control="select2"
                                  class="form-select form-select-sm col-md-4" data-control="select2" data-allow-clear="true"> 
                                  <option selected value="C">C$</option>
                                  <option  value="S">$</option>
                                </select>';     

            $array["subtotal"] = '<input change="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".')" type="number" readonly class="form-control form-control-transparent placeholder subtotal" 
                                    id="subtotal'.$key["IdDetallesSolicitud"].'" value="'.$key["SubTotalOC"].'" placeholder="0"/>';

            $array["total"] = '<input type="text" readonly class="form-control form-control-transparent placeholder total" 
                                    id="total'.$key["IdDetallesSolicitud"].'" value="'.$key["TotalOC"].'" placeholder="0"/>';                 

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

    public function editOrdersCH($tipo,$idSolic,$idOrden){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Compras_model->editOrders($tipo,$idSolic,$idOrden,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];

        $estadoAut = ""; //autorizada o rechazada

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            $array = array();

            $array["idDetCH"] = $key["idDetCH"]; 
            $array["IdDetallesSolicitud"] = $key["IdDetallesSolicitud"];
            $array["IdSolicitud"] = $key["IdSolicitud"];

            $array["DescripcionArticulo"] = $key["ArticuloCH"];

            $array["DescripcionProv"] = '<input value="'.$key["ArticuloProveedorCH"].'" type="text" class="form-control form-control-transparent" 
                                    id="descProv'.$key["IdDetallesSolicitud"].'" placeholder="Articulo"/>';
            
            $array["Proforma"] = '<input type="text" class="form-control form-control-transparent placeholder" 
                                    id="proforma'.$key["IdDetallesSolicitud"].'" value="'.$key["NumProformaCH"].'" placeholder="proforma"/>';

            $array["CantidadAut"] = '<input readonly type="number" class="form-control form-control-transparent placeholder" 
            id="cantAut'.$key["IdDetallesSolicitud"].'" value="'.$key["CantidadDisponible"].'" min="0"/>';

            $array["CantidadComp"] = '<input value="'.$key["CantidadCH"].'"
                                             onkeyup="subtotal('."'".$key["IdDetallesSolicitud"]."'".');descAndTotal('."'".$key["IdDetallesSolicitud"]."'".')" 
                                            type="number" class="form-control form-control-transparent placeholder" 
                                            id="cantComp'.$key["IdDetallesSolicitud"].'" placeholder="cant comp"/>';

            $array["UnidadMedida"] = '<input type="text" class="form-control form-control-transparent" 
                                    id="umedida'.$key["IdDetallesSolicitud"].'" placeholder="'.$key["UnidadMedida"].'" value="'.$key["UnidadMedida"].'"/>';
            
            $array["Importe"] = '<input value="'.$key["precioCH"].'" onkeyup="subtotal('."'".$key["IdDetallesSolicitud"]."'".');
            descAndTotal('."'".$key["IdDetallesSolicitud"]."'".'); aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')" 
            type="number" class="form-control form-control-transparent placeholder" 
                                    id="importe'.$key["IdDetallesSolicitud"].'" placeholder="precio" min="0"/>';

            $array["porcDesc"] = '<input onkeyup="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
                                                  aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')"" 
                                                  type="number" class="form-control form-control-transparent placeholder" 
                                    id="porcDesc'.$key["IdDetallesSolicitud"].'" value="'.number_format($key["porcentDescCH"],2).'" placeholder="0"/>';

            $array["montoDesc"] = '<input type="number" readonly class="form-control form-control-transparent placeholder" 
                                    id="montoDesc'.$key["IdDetallesSolicitud"].'" value="'.number_format($key["MontoDescCH"],2).'" placeholder="0"/>';
                                  
            $array["impuesto"] = '<select onchange="descAndTotal('."'".$key["IdDetallesSolicitud"]."'".');
                                                    aplicarImpuesto('."'".$key["IdDetallesSolicitud"]."'".')" 
                                                    id="lisImpuesto'.$key["IdDetallesSolicitud"].'" data-dropdown-css-class="w-100px"
                                    data-control="select2"
                                    class="form-select form-select-sm col-md-4 imp"> 
                                    <option selected value="'.$key["PorcentImpuestoCH"].'">'.$key["CodImpuestoCH"].'</option>
                                  </select>';  

            $array["moneda"] = '<select onchange="aplicarMoneda('."'".$key["IdDetallesSolicitud"]."'".')" id="lisMoneda'.$key["IdDetallesSolicitud"].'" data-dropdown-css-class="w-100px"
                                  data-control="select2"
                                  class="form-select form-select-sm col-md-4" data-control="select2" data-allow-clear="true"> 
                                  <option selected value="C">C$</option>
                                  <option  value="S">$</option>
                                </select>';     

            $array["subtotal"] = '<input change="subtotal('."'".$key["IdDetallesSolicitud"]."'".');descAndTotal('."'".$key["IdDetallesSolicitud"]."'".')" type="number" readonly class="form-control form-control-transparent placeholder subtotal" 
                                    id="subtotal'.$key["IdDetallesSolicitud"].'" value="'.$key["SubTotalCH"].'" placeholder="0"/>';

            $array["total"] = '<input type="text" readonly class="form-control form-control-transparent placeholder total" 
                                    id="total'.$key["IdDetallesSolicitud"].'" value="'.$key["TotalCH"].'" placeholder="0"/>';                 

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

    public function bajaSolicitud(){
        $idSolicitud = $this->input->get_post("idsolicitud");
        //$bandera = $this->input->get_post("orden");
        $this->Compras_model->bajaSolicitud($idSolicitud);
    }

    public function bajaOrden(){
        $idOrden = $this->input->get_post("idOrden");
        $tipo = $this->input->get_post("tipo");
        $this->Compras_model->bajaOrden($idOrden, $tipo);
    }

    public function bajaOrdenArticulos(){
        $idDetalle = $this->input->get_post("idDetalle");
        $tipo = $this->input->get_post("tipo");
        $this->Compras_model->bajaOrdenArticulos($idDetalle, $tipo);
    }
}

/* End of file Compras_controller.php */

?>
