<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_controller extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Roles_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        } 
    }
    

    public function index()
    {
        $data["roles"] = $this->Roles_model->getRoles();
        $this->load->view("header/bodyHeader");
		$this->load->view("menu/menu");
		$this->load->view('usuarios/roles', $data);
		$this->load->view("footer/bodyFooter");	
        $this->load->view("jsview/usuarios/jsRoles");	
    }

    public function guardarRol()     
    {
        $nombre = $this->input->get_post("nombreRol");
        $this->Roles_model->guardarRol($nombre);
    }

    public function actualizarRol()     
    {
        $idRol = $this->input->get_post("idRol");
        $nombre = $this->input->get_post("nombreRol");
        $this->Roles_model->actualizarRol($idRol,$nombre);
    }

    public function actualizarEstado(){
        $estadoupd = "";
        $idRol = $this->input->get_post("idRol");
        $estado = $this->input->get_post("estado");
        if($estado == "A"){
            $estadoupd = "I";
        }else{
            $estadoupd = "A";
        }
        $this->Roles_model->actualizarEstado($idRol,$estadoupd); 
    }

}

/* End of file Roles_controller.php */

?>