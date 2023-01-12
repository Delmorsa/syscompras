<?php

class Documentos_controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Managua");
		$this->load->model("Documentos_model");
		if ($this->session->userdata("logged") != 1) {
			redirect(base_url() . 'index.php', 'refresh');
		}
	}

	public function index()
	{
		$this->load->view("header/bodyHeader");
		$this->load->view("menu/menu_sol");
		$this->load->view('documentos/documentos');
		$this->load->view("footer/bodyFooter");
		$this->load->view("jsview/documentos/jsdocumentos");
	}

	public function mostrarOPDoc(){
		$start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];
		$result = $this->Documentos_model->mostrarOPDoc($this->session->userdata("id"),$start,$length,$search);
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
			$array["Cantidad"] = number_format($key["Cantidad"],0);
			$array["CantidadDesc"] = $key["CantidadDesc"];
			$array["Concepto"] = $key["Concepto"];
			$array["Retiene"] = $key["Retiene"];
			$array["ComentarioRetiene"] = $key["ComentarioRetiene"];
			$array["FechaCrea"] = date_format(new DateTime($key["FechaCrea"]), "Y-m-d");
			$array["Nombre"] = $key["Nombre"];
			if($this->session->userdata("idArea") != 11){
				$array["Opciones"] = '<a href="javascript:void(0)" onclick="detallesDoc('."'".$key["IdOrdenPago"]."','".$key["ConsecutivoOP"]."'".')" class="btn btn-icon btn-light-warning me-3">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
				<i class="fas fa-file-upload"></i>
				<!--end::Svg Icon-->
			</a>';
			}else{
				$array["Opciones"] = '<a href="javascript:void(0)" onclick="modalUpload('."'".$key["IdOrdenPago"]."','".$key["IdSolicitud"]."'".')" class="btn btn-icon btn-light-primary me-3">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
												<span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black"></rect>
														<path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black"></path>
														<path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4"></path>
													</svg>
												</span>
												<!--end::Svg Icon-->
											</a>
											<a href="javascript:void(0)" onclick="detallesDoc('."'".$key["IdOrdenPago"]."','".$key["ConsecutivoOP"]."'".')" class="btn btn-icon btn-light-warning me-3">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
												<i class="fas fa-file-upload"></i>
												<!--end::Svg Icon-->
											</a>';
			}
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

	public function mostrarOCDoc(){
		$start = $this->input->get_post('start');
		$length = $this->input->get_post('length');
		$search = $this->input->get_post('search')['value'];
		$result = $this->Documentos_model->mostrarOCDoc($this->session->userdata("id"),$start,$length,$search);
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
			$array["FechaCrea"] = date_format(new DateTime($key["FechaCrea"]), "Y-m-d");
			$array["Nombre"] = $key["Nombre"];
			if($this->session->userdata("idArea") != 11){
				$array["Opciones"] = '
			<a href="javascript:void(0)" onclick="detallesDoc('."'".$key["IdOrdenCompra"]."','".$key["ConsecutivoOC"]."'".')" class="btn btn-icon btn-light-warning me-3">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
				<i class="fas fa-file-upload"></i>
				<!--end::Svg Icon-->
			</a>';
			}else{
				$array["Opciones"] = '<a href="javascript:void(0)" onclick="modalUpload('."'".$key["IdOrdenCompra"]."','".$key["IdSolicitud"]."'".')" class="btn btn-icon btn-light-primary me-3">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
												<span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black"></rect>
														<path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black"></path>
														<path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4"></path>
													</svg>
												</span>
												<!--end::Svg Icon-->
											</a>
											<a href="javascript:void(0)" onclick="detallesDoc('."'".$key["IdOrdenCompra"]."','".$key["ConsecutivoOC"]."'".')" class="btn btn-icon btn-light-warning me-3">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
												<i class="fas fa-file-upload"></i>
												<!--end::Svg Icon-->
											</a>';
			}
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


	public function subirDocumentos(){
		$mensaje = array();
		//$old_filename = $this->input->get_post("old_image");
		$parametro = $this->input->get_post("parametro");
		$new_filename = $_FILES["new_image"]["name"];
		$ruta = "";

		if($new_filename == TRUE){

			switch (intval($parametro)) {
				case 1:
					$ruta = "./assets/documentos/cuadros_comp/";
					break;
				case 2:
					$ruta = "./assets/documentos/cotizaciones/";
					break;
				case 3:
					$ruta = "./assets/documentos/otros/";
					break;
				case 4:
					$ruta = "./assets/documentos/constancias/";
					break;
				case 5:
					$ruta = "./assets/documentos/otros/";
					break;
				default:
					$ruta = "./assets/documentos/";
					break;
			}

			$update_filename = time()."-".str_replace([' ','_'],'-',$_FILES["new_image"]["name"]);
			$file = explode(".",$new_filename);
			$extension = $file["1"];
			$img_types = array("jpg","jpeg","png","xlsx","csv","xls","pdf");

			$config = [
				'upload_path' => $ruta, //TODO: verficar ruta segun parametro
				'allowed_types' => "jpg|png|jpeg|xlsx|csv|xls|pdf",
				'max_size' => 5120,
				'file_name' => $update_filename
			];

			if(in_array($extension, $img_types)){
				$this->load->library("upload", $config);
				if($this->upload->do_upload("new_image")){
					/*if(file_exists($ruta.$old_filename)){
						unlink($ruta.$old_filename);
					}*/
				}
			}else{
				$mensaje[0]["mensaje"] = "EL tipo de archivo que intenta guardar no es compatible.";
				$mensaje[0]["tipo"] = "error";
				echo json_encode($mensaje);
			}

		}/*else{
			$update_filename = $old_filename;
		}*/

		if(in_array($extension,$img_types)){
			$documento = $update_filename;
			$idorden = $this->input->get_post("idorden");
			$idsolicitud = $this->input->get_post("idsolicitud");
			$this->Documentos_model->subirDocumentos($idorden,$idsolicitud,$documento,$parametro);
		}
	}

	public function getDocCuadros($idOrden,$tipo){
		$this->Documentos_model->getDocCuadros($idOrden,$tipo);
	}

	public function bajaCuadro(){
		$idDoc = $this->input->get_post("idDoc");
		$this->Documentos_model->bajaCuadro($idDoc);
	}

	public function getDocumentos($idOrden,$tipo){
		$this->Documentos_model->getDocumentos($idOrden,$tipo);
	}

	public function elmiminarDoc(){
		$ruta = "";
		$idDoc = $this->input->get_post("idDoc");
		$parametro = $this->input->get_post("tipo");
		$filename = $this->input->get_post("documento");

		switch (intval($parametro)) {
			case 1:
				$ruta = "./assets/documentos/cuadros_comp/";
				break;
			case 2:
				$ruta = "./assets/documentos/cotizaciones/";
				break;
			case 3:
				$ruta = "./assets/documentos/otros/";
				break;
			case 4:
				$ruta = "./assets/documentos/constancias/";
				break;
			case 5:
				$ruta = "./assets/documentos/otros/";
				break;
			default:
				$ruta = "./assets/documentos/";
				break;
		}
		if(file_exists($ruta.$filename)){
			unlink($ruta.$filename);
		}
		$this->Documentos_model->elmiminarDoc($idDoc);
	}

	public function imprimir($idOrden,$tipo){
		$data["enc"] = $this->Documentos_model->printDoc($idOrden,$tipo);
		$data["det"] = $this->Documentos_model->printDocDet($idOrden,$tipo);
		$this->load->view("header/bodyHeader");
		$this->load->view('documentos/imprimirDoc', $data);
		$this->load->view("footer/bodyFooter");
	}

	public function imprimirSolic($idSolicitud){
		$data["enc"] = $this->Documentos_model->imprimirSolicitud($idSolicitud);
		$data["det"] = $this->Documentos_model->imprimirSolicitudDet($idSolicitud);
		$this->load->view("header/bodyHeader");
		$this->load->view('documentos/imprimirSolicitud',$data);
		$this->load->view("footer/bodyFooter");
	}
}
