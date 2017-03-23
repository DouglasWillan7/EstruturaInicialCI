<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

	public function __construct(){
		parent::__construct();
		init_painel();
		$this->load->model('usuarios_model', 'usuarios');
		
	}

	public function index()
	{
		$this->inicio();
	}

	public function inicio(){
		
		if (esta_logado(FALSE)):
			
			set_tema('titulo','Início');
			set_tema('conteudo',load_modulo('painel', 'inicio'));
			load_templade();
		else:
			redirect('usuarios/login');
		endif;

	}
}
