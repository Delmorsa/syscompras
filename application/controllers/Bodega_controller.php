<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bodega_controller extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Managua");
        $this->load->model("Bodega_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }
    

    public function index()
    {
        $this->load->view("header/bodyHeader");
		$this->load->view("menu/menu_sol");
		$this->load->view('Bodega/bodega');
		$this->load->view("footer/bodyFooter");	
        $this->load->view("jsview/bodega/jsbodega");
    }

    public function mostrarOCBodega(){
		$start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];
		$result = $this->Bodega_model->mostrarOCBodega($start,$length,$search);
		$resultado = $result["datos"];
		$totalDatos = $result["numDataTotal"];
		$datos = array();

		foreach ($resultado->result_array() as $key) {
			$array = array();
			$array["IdOrdenPago"] = $key["IdOrdenCompra"];
			$array["IdSolicitud"] = $key["IdSolicitud"];
			$array["Consecutivo"] = $key["Consecutivo"];
			$array["ConsecutivoOC"] = $key["ConsecutivoOC"];
			$array["Proveedor"] = $key["Proveedor"];
			$array["Direccion"] = $key["Direccion"];
			$array["TiempoEntrega"] = $key["TiempoEntrega"];
			$array["Area"] = $key["NombreArea"];
            $array["Solicitante"] = $key["Nombre"];
            $array["Personal"] = $key["Personal"];
            $array["Total"] = number_format($key["Total"],2);
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

                            <li><a onclick="autorizar('."'".$key["IdOrdenCompra"]."', '".$key["Consecutivo"]."', '".$key["Correo"]."', '".$key["ConsecutivoOC"]."',
                            '".$key["CorreoCompra"]."','".$key["IdSolicitud"]."'".')" 
                                class="dropdown-item" href="javascript:void(0)">
                                <span class="svg-icon svg-icon-info svg-icon-2">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black"/>
                                        <path d="M7 16H6C5.4 16 5 15.6 5 15V13H8V15C8 15.6 7.6 16 7 16Z" fill="black"/>
                                        <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black"/>
                                        <path d="M18 16H17C16.4 16 16 15.6 16 15V13H19V15C19 15.6 18.6 16 18 16Z" fill="black"/>
                                        <path opacity="0.3" d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black"/>
                                        <path d="M7 5H6C5.4 5 5 4.6 5 4V2H8V4C8 4.6 7.6 5 7 5Z" fill="black"/>
                                        <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black"/>
                                        <path d="M18 5H17C16.4 5 16 4.6 16 4V2H19V4C19 4.6 18.6 5 18 5Z" fill="black"/>
                                    </svg>
                                </span>
                                Recepcionar articulos</a></li>

                            <li>
                            <!--<hr class="dropdown-divider"></li>-->
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
			/*$array["Opciones"] = '<div class="dropdown">
            <a href="javascript:void(0)" id="dropdownMenuButton1"
               class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" role="button"
               aria-expanded="false" data-target="#">
              Opciones
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" role="menu">
            <li><a class="dropdown-item" href="javascript:void(0)">
              <span class="svg-icon svg-icon-muted svg-icon-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                  <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
              </svg>
          </span>
              Detalle Orden</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">
              <span class="svg-icon svg-icon-muted svg-icon-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                  <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
              </svg>
          </span>
              Detalle Solicitud</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item disabled" tabindex="-1" aria-disabled="true" href="#">Adjuntar documentos</a></li>
              <li><hr class="dropdown-divider"></li>

              <li>
                <a class="dropdown-item" href="javascript:void(0)" onclick="modalUpload('."'1','".$key["IdOrdenPago"]."','".$key["IdSolicitud"]."'".')">
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M3 3V17H7V21H15V9H20V3H3Z" fill="black"/>
                            <path d="M20 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V21C21 21.6 20.6 22 20 22ZM19 4H4V8H19V4ZM6 18H4V20H6V18ZM6 14H4V16H6V14ZM6 10H4V12H6V10ZM10 18H8V20H10V18ZM10 14H8V16H10V14ZM10 10H8V12H10V10ZM14 18H12V20H14V18ZM14 14H12V16H14V14ZM14 10H12V12H14V10ZM19 14H17V20H19V14ZM19 10H17V12H19V10Z" fill="black"/>
                        </svg>
                    </span>
                   Cuadro Comparativo
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0)" onclick="modalUpload('."'2','".$key["IdOrdenPago"]."','".$key["IdSolicitud"]."'".')">
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="black"/>
                            <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="black"/>
                            <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="black"/>
                        </svg>
                    </span>
                  Cotizaciones</a>
               </li>
               <li>
                <a class="dropdown-item" href="javascript:void(0)" onclick="modalUpload('."'3','".$key["IdOrdenPago"]."','".$key["IdSolicitud"]."'".')">
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M6 20C6 20.6 5.6 21 5 21C4.4 21 4 20.6 4 20H6ZM18 20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20H18Z" fill="black"/>
                      <path opacity="0.3" d="M21 20H3C2.4 20 2 19.6 2 19V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V19C22 19.6 21.6 20 21 20ZM12 10H10.7C10.5 9.7 10.3 9.50005 10 9.30005V8C10 7.4 9.6 7 9 7C8.4 7 8 7.4 8 8V9.30005C7.7 9.50005 7.5 9.7 7.3 10H6C5.4 10 5 10.4 5 11C5 11.6 5.4 12 6 12H7.3C7.5 12.3 7.7 12.5 8 12.7V14C8 14.6 8.4 15 9 15C9.6 15 10 14.6 10 14V12.7C10.3 12.5 10.5 12.3 10.7 12H12C12.6 12 13 11.6 13 11C13 10.4 12.6 10 12 10Z" fill="black"/>
                      <path d="M18.5 11C18.5 10.2 17.8 9.5 17 9.5C16.2 9.5 15.5 10.2 15.5 11C15.5 11.4 15.7 11.8 16 12.1V13C16 13.6 16.4 14 17 14C17.6 14 18 13.6 18 13V12.1C18.3 11.8 18.5 11.4 18.5 11Z" fill="black"/>
                     </svg>
                    </span>
                  Cédula</a>
               </li>
               <li>
                <a class="dropdown-item" href="javascript:void(0)" onclick="modalUpload('."'4','".$key["IdOrdenPago"]."','".$key["IdSolicitud"]."'".')">
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M6 20C6 20.6 5.6 21 5 21C4.4 21 4 20.6 4 20H6ZM18 20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20H18Z" fill="black"/>
                      <path opacity="0.3" d="M21 20H3C2.4 20 2 19.6 2 19V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V19C22 19.6 21.6 20 21 20ZM12 10H10.7C10.5 9.7 10.3 9.50005 10 9.30005V8C10 7.4 9.6 7 9 7C8.4 7 8 7.4 8 8V9.30005C7.7 9.50005 7.5 9.7 7.3 10H6C5.4 10 5 10.4 5 11C5 11.6 5.4 12 6 12H7.3C7.5 12.3 7.7 12.5 8 12.7V14C8 14.6 8.4 15 9 15C9.6 15 10 14.6 10 14V12.7C10.3 12.5 10.5 12.3 10.7 12H12C12.6 12 13 11.6 13 11C13 10.4 12.6 10 12 10Z" fill="black"/>
                      <path d="M18.5 11C18.5 10.2 17.8 9.5 17 9.5C16.2 9.5 15.5 10.2 15.5 11C15.5 11.4 15.7 11.8 16 12.1V13C16 13.6 16.4 14 17 14C17.6 14 18 13.6 18 13V12.1C18.3 11.8 18.5 11.4 18.5 11Z" fill="black"/>
                     </svg>
                    </span>
                  Constancias</a>
               </li>
               <li>
                <a class="dropdown-item" href="javascript:void(0)" onclick="modalUpload('."'5','".$key["IdOrdenPago"]."','".$key["IdSolicitud"]."'".')">
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M6 20C6 20.6 5.6 21 5 21C4.4 21 4 20.6 4 20H6ZM18 20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20H18Z" fill="black"/>
                      <path opacity="0.3" d="M21 20H3C2.4 20 2 19.6 2 19V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V19C22 19.6 21.6 20 21 20ZM12 10H10.7C10.5 9.7 10.3 9.50005 10 9.30005V8C10 7.4 9.6 7 9 7C8.4 7 8 7.4 8 8V9.30005C7.7 9.50005 7.5 9.7 7.3 10H6C5.4 10 5 10.4 5 11C5 11.6 5.4 12 6 12H7.3C7.5 12.3 7.7 12.5 8 12.7V14C8 14.6 8.4 15 9 15C9.6 15 10 14.6 10 14V12.7C10.3 12.5 10.5 12.3 10.7 12H12C12.6 12 13 11.6 13 11C13 10.4 12.6 10 12 10Z" fill="black"/>
                      <path d="M18.5 11C18.5 10.2 17.8 9.5 17 9.5C16.2 9.5 15.5 10.2 15.5 11C15.5 11.4 15.7 11.8 16 12.1V13C16 13.6 16.4 14 17 14C17.6 14 18 13.6 18 13V12.1C18.3 11.8 18.5 11.4 18.5 11Z" fill="black"/>
                     </svg>
                    </span>
                  N° cuentas</a>
               </li>
              </ul>
          </div>';*/
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

    public function mostrarOPBodega(){
		$start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];
		$result = $this->Bodega_model->mostrarOPBodega($start,$length,$search);
		$resultado = $result["datos"];
		$totalDatos = $result["numDataTotal"];
		$datos = array();

		foreach ($resultado->result_array() as $key) {
			$array = array();
			$array["IdOrdenPago"] = $key["IdOrdenPago"];
			$array["IdSolicitud"] = $key["IdSolicitud"];
			$array["Consecutivo"] = $key["Consecutivo"];
			$array["ConsecutivoOP"] = $key["ConsecutivoOP"];
			$array["Proveedor"] = $key["Proveedor"];
			$array["NombreCheque"] = $key["NombreCheque"];
			$array["Concepto"] = $key["Concepto"];
			$array["Area"] = $key["NombreArea"];
            $array["Solicitante"] = $key["Nombre"];
            $array["Total"] = number_format($key["Total"],2);
            $array["Personal"] = $key["Personal"];
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

                            <li><a onclick="autorizarOP('."'".$key["IdOrdenPago"]."', '".$key["Consecutivo"]."', '".$key["Correo"]."', '".$key["ConsecutivoOP"]."',
                            '".$key["CorreoCompra"]."','".$key["IdSolicitud"]."'".')" 
                                class="dropdown-item" href="javascript:void(0)">
                                <span class="svg-icon svg-icon-info svg-icon-2">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black"/>
                                        <path d="M7 16H6C5.4 16 5 15.6 5 15V13H8V15C8 15.6 7.6 16 7 16Z" fill="black"/>
                                        <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black"/>
                                        <path d="M18 16H17C16.4 16 16 15.6 16 15V13H19V15C19 15.6 18.6 16 18 16Z" fill="black"/>
                                        <path opacity="0.3" d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black"/>
                                        <path d="M7 5H6C5.4 5 5 4.6 5 4V2H8V4C8 4.6 7.6 5 7 5Z" fill="black"/>
                                        <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black"/>
                                        <path d="M18 5H17C16.4 5 16 4.6 16 4V2H19V4C19 4.6 18.6 5 18 5Z" fill="black"/>
                                    </svg>
                                </span>
                                Recepcionar articulos</a></li>

                            <li>
                            <!--<hr class="dropdown-divider"></li>-->
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

    public function mostrarCHBodega(){
		$start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];
		$result = $this->Bodega_model->mostrarCHBodega($start,$length,$search);
		$resultado = $result["datos"];
		$totalDatos = $result["numDataTotal"];
		$datos = array();

		foreach ($resultado->result_array() as $key) {
			$array = array();
			$array["IdCajaChica"] = $key["IdCajaChica"];
			$array["IdSolicitud"] = $key["IdSolicitud"];
			$array["Consecutivo"] = $key["Consecutivo"];
			$array["ConsecutivoCH"] = $key["consecutivoCH"];
			$array["Proveedor"] = $key["Proveedor"];
			$array["fechaRecibo"] = $key["fechaRecibo"];
			$array["Concepto"] = $key["Concepto"];
			$array["Area"] = $key["NombreArea"];
            $array["Solicitante"] = $key["Nombre"];
            $array["Total"] = number_format($key["Total"],2);
            $array["Personal"] = $key["Personal"];
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

                            <li><a onclick="autorizarCH('."'".$key["IdCajaChica"]."', '".$key["Consecutivo"]."', '".$key["Correo"]."', '".$key["consecutivoCH"]."',
                            '".$key["CorreoCompra"]."','".$key["IdSolicitud"]."'".')" 
                                class="dropdown-item" href="javascript:void(0)">
                                <span class="svg-icon svg-icon-info svg-icon-2">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black"/>
                                        <path d="M7 16H6C5.4 16 5 15.6 5 15V13H8V15C8 15.6 7.6 16 7 16Z" fill="black"/>
                                        <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black"/>
                                        <path d="M18 16H17C16.4 16 16 15.6 16 15V13H19V15C19 15.6 18.6 16 18 16Z" fill="black"/>
                                        <path opacity="0.3" d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black"/>
                                        <path d="M7 5H6C5.4 5 5 4.6 5 4V2H8V4C8 4.6 7.6 5 7 5Z" fill="black"/>
                                        <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black"/>
                                        <path d="M18 5H17C16.4 5 16 4.6 16 4V2H19V4C19 4.6 18.6 5 18 5Z" fill="black"/>
                                    </svg>
                                </span>
                                Recepcionar articulos</a></li>

                            <li>
                            <!--<hr class="dropdown-divider"></li>-->
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

    public function getDetOrdenOC($idOrdenOc){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Bodega_model->getDetOrdenOC($idOrdenOc,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];
        $checked = "";

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            if($key["Cantidad"] == $key["CantidadRecibida"]){
                $checked = "checked disabled";
            }else{
                $checked = "";
            }
            $array = array();
            $array["IdDetalleOC"] = $key["IdDetalleOC"];
            $array["IdOrdenCompra"] = $key["IdOrdenCompra"];
            $array["IdDetalleSolicitud"] = $key["IdDetalleSolicitud"];

            $array["comentarios"] = '<input type="text" value="'.$key["Comentarios"].'" class="form-control form-control-transparent placeholder" 
            id="Comment'.$key["IdDetalleOC"].'" placeholder="comentario"/>';

            $array["ArticuloProveedor"] = $key["ArticuloProveedor"];
            $array["NumProforma"] = $key["NumProforma"];
            $array["UnidadMedida"] = $key["UnidadMedida"];
            $array["Cantidad"] = '<input readonly type="number" value="'.str_replace(",","",number_format($key["Cantidad"],2)).'" class="form-control form-control-transparent placeholder" 
            id="cantSolic'.$key["IdDetalleOC"].'" placeholder="0" min="0"/>';
            $array["PrecioAntDescuento"] = $key["PrecioAntDescuento"];
            $array["MontoDesc"] = $key["MontoDesc"];
            $array["CodImpuesto"] = $key["CodImpuesto"];
            if($key["Moneda"] == "C"){
                $array["Moneda"] = "Córdobas";
            }else if($key["Moneda"] == "S"){
                $array["Moneda"] = "Dolares";
            }
            $array["IVA"] = $key["IVA"];
            $array["SubTotal"] = $key["SubTotal"];
            $array["Total"] = $key["Total"];
            $array["CantidadRec"] = '<input type="number" value="'.str_replace(",","",number_format($key["CantidadRecibida"],2)).'" onkeyup="cantRecepcion('."'".$key["IdDetalleOC"]."'".')" class="form-control form-control-transparent placeholder" 
            id="cantReceived'.$key["IdDetalleOC"].'" placeholder="0" min="0"/>';

            /*$array["CantidadSolicitud"] = '<input type="number" min="0" readonly class="form-control form-control-transparent" 
            id="cantSolic'.$key["IdDetallesSolicitud"].'" value="'.$key["CantidadSolicitud"].'"/>';

            $array["UnidadMedida"] = '<input type="text" min="0" readonly class="form-control form-control-transparent" 
                                    id="umedida'.$key["IdDetallesSolicitud"].'" value="'.$key["UnidadMedida"].'"/>';

            $array["CantidadAut"] = '<input onkeyup="cantAutInput('."'".$key["IdDetallesSolicitud"]."'".')" type="number" class="form-control form-control-transparent placeholder" 
                                      id="cantAut'.$key["IdDetallesSolicitud"].'" placeholder="'.$key["CantidadAut"].'" min="0"/>
                                      
                                      <span id="badge'.$key["IdDetallesSolicitud"].'" style="display:none;" class="badge badge-danger badge-valida">cantidad no permitida</span>';
            $array["DescripcionArticulo"] = $key["DescripcionArticulo"];*/

            $array["Acciones"] = '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input '.$checked.' id="chk'.$key["IdDetalleOC"].'" class="form-check-input check" type="checkbox" value="" />
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

    public function getDetOrdenOP($idOrdenOp){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Bodega_model->getDetOrdenOP($idOrdenOp,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];
        $checked = "";

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            if($key["Cantidad"] == $key["CantidadRecibida"]){
                $checked = "checked disabled";
            }else{
                $checked = "";
            }
            $array = array();
            $array["IdDetalleOP"] = $key["IdDetalleOP"];
            $array["IdOrdenPago"] = $key["IdOrdenPago"];
            $array["IdDetalleSolicitud"] = $key["IdDetalleSolicitud"];

            $array["comentarios"] = '<input type="text" value="'.$key["Comentarios"].'" class="form-control form-control-transparent placeholder" 
            id="CommentOP'.$key["IdDetalleOP"].'" placeholder="comentario"/>';

            $array["ArticuloProveedor"] = $key["ArticuloProveedor"];
            $array["NumProforma"] = $key["NumProforma"];
            $array["UnidadMedida"] = $key["UnidadMedida"];
            $array["Cantidad"] = '<input readonly type="number" value="'.str_replace(",","",number_format($key["Cantidad"],2)).'" class="form-control form-control-transparent placeholder" 
            id="cantSolicOP'.$key["IdDetalleOP"].'" placeholder="0" min="0"/>';
            $array["PrecioAntDescuento"] = $key["PrecioAntDescuento"];
            $array["MontoDesc"] = $key["MontoDesc"];
            $array["CodImpuesto"] = $key["CodImpuesto"];
            if($key["Moneda"] == "C"){
                $array["Moneda"] = "Córdobas";
            }else if($key["Moneda"] == "S"){
                $array["Moneda"] = "Dolares";
            }
            $array["IVA"] = $key["IVA"];
            $array["SubTotal"] = $key["SubTotal"];
            $array["Total"] = $key["Total"];
            $array["CantidadRec"] = '<input type="number" value="'.str_replace(",","",number_format($key["CantidadRecibida"],2)).'" onkeyup="cantRecepcionOP('."'".$key["IdDetalleOP"]."'".')" class="form-control form-control-transparent placeholder" 
            id="cantReceivedOP'.$key["IdDetalleOP"].'" placeholder="0" min="0"/>';

            /*$array["CantidadSolicitud"] = '<input type="number" min="0" readonly class="form-control form-control-transparent" 
            id="cantSolic'.$key["IdDetallesSolicitud"].'" value="'.$key["CantidadSolicitud"].'"/>';

            $array["UnidadMedida"] = '<input type="text" min="0" readonly class="form-control form-control-transparent" 
                                    id="umedida'.$key["IdDetallesSolicitud"].'" value="'.$key["UnidadMedida"].'"/>';

            $array["CantidadAut"] = '<input onkeyup="cantAutInput('."'".$key["IdDetallesSolicitud"]."'".')" type="number" class="form-control form-control-transparent placeholder" 
                                      id="cantAut'.$key["IdDetallesSolicitud"].'" placeholder="'.$key["CantidadAut"].'" min="0"/>
                                      
                                      <span id="badge'.$key["IdDetallesSolicitud"].'" style="display:none;" class="badge badge-danger badge-valida">cantidad no permitida</span>';
            $array["DescripcionArticulo"] = $key["DescripcionArticulo"];*/

            $array["Acciones"] = '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input '.$checked.' id="chkOP'.$key["IdDetalleOP"].'" class="form-check-input checkOP" type="checkbox" value="" />
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

    public function getDetOrdenCH($idOrdenOp){
        $start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];

        $result = $this->Bodega_model->getDetOrdenCH($idOrdenOp,$start,$length,$search);
        $resultado = $result["datos"];
        $totalDatos = $result["numDataTotal"];
        $checked = "";

        $datos = array();

        foreach ($resultado->result_array() as $key) {
            if($key["Cantidad"] == $key["CantidadRecibida"]){
                $checked = "checked disabled";
            }else{
                $checked = "";
            }
            $array = array();
            $array["idDetCH"] = $key["idDetCH"];
            $array["IdCajaChica"] = $key["IdCajaChica"];
            $array["IdDetalleSolicitud"] = $key["IdDetalleSolicitud"];

            $array["comentarios"] = '<input type="text" value="'.$key["Comentarios"].'" class="form-control form-control-transparent placeholder" 
            id="CommentCH'.$key["idDetCH"].'" placeholder="comentario"/>';

            $array["ArticuloProveedor"] = $key["ArticuloProveedor"];
            $array["NumFactura"] = $key["NumFactura"];
            $array["UnidadMedida"] = $key["UnidadMedida"];
            $array["Cantidad"] = '<input readonly type="number" value="'.str_replace(",","",number_format($key["Cantidad"],2)).'" class="form-control form-control-transparent placeholder" 
            id="cantSolicCH'.$key["idDetCH"].'" placeholder="0" min="0"/>';
            $array["PrecioAntDescuento"] = $key["PrecioAntDescuento"];
            $array["MontoDesc"] = $key["MontoDesc"];
            $array["CodImpuesto"] = $key["CodImpuesto"];
            if($key["Moneda"] == "C"){
                $array["Moneda"] = "Córdobas";
            }else if($key["Moneda"] == "S"){
                $array["Moneda"] = "Dolares";
            }
            $array["IVA"] = $key["IVA"];
            $array["SubTotal"] = $key["SubTotal"];
            $array["Total"] = $key["Total"];
            $array["CantidadRec"] = '<input type="number" value="'.str_replace(",","",number_format($key["CantidadRecibida"],2)).'" onkeyup="cantRecepcionCH('."'".$key["idDetCH"]."'".')" class="form-control form-control-transparent placeholder" 
            id="cantReceivedCH'.$key["idDetCH"].'" placeholder="0" min="0"/>';

            /*$array["CantidadSolicitud"] = '<input type="number" min="0" readonly class="form-control form-control-transparent" 
            id="cantSolic'.$key["IdDetallesSolicitud"].'" value="'.$key["CantidadSolicitud"].'"/>';

            $array["UnidadMedida"] = '<input type="text" min="0" readonly class="form-control form-control-transparent" 
                                    id="umedida'.$key["IdDetallesSolicitud"].'" value="'.$key["UnidadMedida"].'"/>';

            $array["CantidadAut"] = '<input onkeyup="cantAutInput('."'".$key["IdDetallesSolicitud"]."'".')" type="number" class="form-control form-control-transparent placeholder" 
                                      id="cantAut'.$key["IdDetallesSolicitud"].'" placeholder="'.$key["CantidadAut"].'" min="0"/>
                                      
                                      <span id="badge'.$key["IdDetallesSolicitud"].'" style="display:none;" class="badge badge-danger badge-valida">cantidad no permitida</span>';
            $array["DescripcionArticulo"] = $key["DescripcionArticulo"];*/

            $array["Acciones"] = '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input '.$checked.' id="chkCH'.$key["idDetCH"].'" class="form-check-input checkCH" type="checkbox" value="" />
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

    public function recepcionarArticulos(){
        $idsolicitud = $this->input->get_post("idsolicitud");
        $detalles = $this->input->get_post("detalles");
        $tipo = $this->input->get_post("tipo");
        $this->Bodega_model->recepcionarArticulos($idsolicitud,$detalles,$tipo);
    }
    
}

/* End of file Bodega_controller.php */

?>