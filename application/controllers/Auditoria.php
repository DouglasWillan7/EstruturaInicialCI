<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria extends CI_Controller {

	public function __construct(){
		parent::__construct();

		init_painel();
		esta_logado();
		$this->load->model('auditoria_model', 'auditoria');
	}

	public function index()
    {
        $this->gerenciar();
    }

	public function gerenciar(){
		if (cargo()==1 || cargo()==2):

			
			set_tema('titulo', 'Registros de auditoria');
			set_tema('conteudo', load_modulo('auditoria', 'gerenciar'));
			load_templade();

		else:
			$CI = &get_instance();
			$CI->session->set_userdata(array('redir_para'=>current_url()));
			set_msg('msgerro', 'Seu Usuario não tem acesso', 'erro');
			redirect(base_url());

		endif;
	}

	
}
