<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rechazadas_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Rechazadas_model");
        if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        } 
    }
    

    public function index()
    {
        $this->load->view("header/bodyHeader");
        //if($this->session->userdata("IdRol") == 2){
            $this->load->view("menu/menu_sol");
        //}
		$this->load->view('rechazadas/rechazadas');
		$this->load->view("footer/bodyFooter");	
        $this->load->view("jsview/rechazadas/jsrechazadas");
    }

    public function guardarSolRechazada(){
        $idSolicitud = $this->input->get_post("idSolicitud");
        $consecutivo = $this->input->get_post("consecutivo");
        $idSolicitante = $this->input->get_post("idSolicitante");
        $solicitante = $this->input->get_post("solicitante");
        $comentarioRechazo = $this->input->get_post("comentarioRechazo");
        $this->Rechazadas_model->guardarSolRechazada($idSolicitud,$consecutivo,$idSolicitante,$solicitante,$comentarioRechazo);
    }

    public function SolicConfirmar(){
        $idSolicitud = $this->input->get_post("idSolicitud");
        $comentarioConfirma = $this->input->get_post("comentarioConfirma");
        $this->Rechazadas_model->SolicConfirmar($idSolicitud,$comentarioConfirma);
    }

}

/* End of file Rechazadas_controller.php */

?>