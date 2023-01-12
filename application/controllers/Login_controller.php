<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Login_model");
	}
	

	public function index()
	{
		$this->load->view("header/loginHeader");
		$this->load->view('login');
		$this->load->view("footer/loginFooter");
	}

	public function dashborad(){
		$this->load->view("header/bodyHeader");
		$this->load->view("menu/menu");
		$this->load->view('dashboard');
		$this->load->view("footer/bodyFooter");	
	}


	public function Acreditar()
    {
        $this->form_validation->set_rules('username', 'nombre', 'required');
        $this->form_validation->set_rules('pwd', 'pass', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('?error=1');
        }
        else {
            $name = $this->input->get_post('username');
            $pass = md5($this->input->get_post('pwd'));
            $data['user'] = $this->Login_model->login($name, $pass);

            if ($data['user'] == 0) {
              redirect('?error=2');
            }
            else {
                $sessiondata = array(
                    'id' => $data['user'][0]['IdUsuario'],
                    'Rol' => $data['user'][0]['NombreRol'],
					'idArea' => $data['user'][0]['IdArea'],
					'Area' => $data['user'][0]['NombreArea'],
					'User' => $data['user'][0]['NombreUsuario'],
					'Name' => $data['user'][0]['Nombre'],
                    'Correo' => $data["user"][0]["Correo"],
                    'CorreoJefe' => $data["user"][0]["CorreoJefe"],
					'Puesto' => $data["user"][0]["Puesto"],
                    'Genero' => $data['user'][0]['Genero'],
                    'Autoriza' => $data['user'][0]['Autoriza'],
                    'imagen' => $data['user'][0]['ImagenPerfil'],
                    'Estado' => $data["user"][0]["Estado"],
					'IdRol' => $data['user'][0]['IdRol'],
                    'logged' => 1
                );
                $this->session->set_userdata($sessiondata);

                if ($this->session->userdata) {
                    $this->Login_model->conectadoLogin($this->session->userdata("id"),true);
                    switch ($this->session->userdata("IdRol")) {
                        case 1:
                            redirect('perfil'); //por el momentoInicioEmp 
                            break;
                         case 2:
                            redirect('perfil'); //por el momento
                            break;   
                        case 3:
                            redirect('perfil'); 
                            break;
						case 4:
							redirect('perfil');
							break;
                    }
                }
            }
        }
	}

	public function Salir()
    {
        $this->Login_model->conectadoLogin($this->session->userdata("id"),false);
        //$this->Login_model->mostrarConectados();
        $this->session->sess_destroy();
        $sessiondata = array('logged' => 0);
        redirect(base_url() . 'index.php', 'refresh');
	}

	public function mostrarConectados(){
        $this->Login_model->mostrarConectados();
    }

}
