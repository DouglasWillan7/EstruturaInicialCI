<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct(){
		parent::__construct();

		init_painel();
	}

	public function index()
	{
		$this->gerenciar();
	}

	public function login(){
		login();
		$this->form_validation->set_rules('usuario','USUARIO','trim|required|min_length[4]|strtolower');
		$this->form_validation->set_rules('senha','SENHA','trim|required|min_length[4]|strtolower');
		if ($this->form_validation->run()== TRUE):
			$usuario = $this->input->post('usuario', TRUE);
			$senha = md5($this->input->post('senha', TRUE));
			$redirect = $this->input->post('redirect', TRUE);
			if($this->usuarios->do_login($usuario, $senha) == TRUE):
				$query = $this->usuarios->get_bylogin($usuario)->row();
				$dados = array(
					'user_id' => $query->id,
					'user_nome' => $query->nome,
					'user_admin' => $query->adm,
					'cargo' => $query->cargo,
					'unidade_de_atendimento' => $query->unidade_de_atendimento,
					'user_logado' => TRUE,
				);
				$this->session->set_userdata($dados);
				auditoria('Login no Sistema', 'Login efetuado com sucesso');
				if ($redirect != ''):
					redirect($redirect);
				else:
					redirect('painel');
				endif;
				redirect('painel');
			else:
				$query = $this->usuarios->get_bylogin($usuario)->row();
				if (empty($query)):
					set_msg('<div class="alert alert-warning"><p><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Usuário inexistente</p></div>');
				elseif($query->senha != $senha):
					set_msg('<div class="alert alert-warning"><p>Senha Incorreta</p></div>');
				elseif($query->ativo==0):
					set_msg('<div class="alert alert-danger"><p>Esse Usuario esta Inativo</p></div>');
				else:
					set_msg('<div class="alert alert-danger"><p>Erro Desconhecido contate o administrador</p></div>');
				endif;
					redirect('usuarios/login');
			endif;
		endif;
		set_tema('titulo', 'Login');
		set_tema('conteudo', load_modulo('usuarios', 'login'));
		set_tema('rodape', '');
		load_templade();
	}

	public function logoff(){
		auditoria('Logoff no Sistema', 'Logoff efetuado com sucesso');
		$this->session->unset_userdata(array('user_id'=>'','user_nome'=>'', 'user_admin'=>'', 'user_logado'=>''));
		$this->session->sess_destroy();
		set_msg('logoffok', 'Logoff efetuado com sucesso', 'sucesso');

		redirect('usuarios/login');
	}

	public function cadastrar(){
		esta_logado();
		if(cargo()==1 || cargo()==2):
			$this -> form_validation -> set_message('is_unique', 'Este %s ja esta cadastrado no sistema');
			$this -> form_validation -> set_message('matches','O campo %s está diferente do campo %s');
			$this -> form_validation -> set_rules('nome', 'NOME', 'trim|required|ucwords');
			$this -> form_validation -> set_rules('email', 'EMAIL', 'trim|required|valid_email|is_unique[usuarios.email]|strtolower');
			$this -> form_validation -> set_rules('login', 'login', 'trim|required|min_length[4]|is_unique[usuarios.login]|strtolower');
			$this -> form_validation -> set_rules('senha', 'SENHA', 'trim|required|min_length[4]|strtolower');
			$this -> form_validation -> set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[4]|strtolower|matches[senha]');
			$this -> form_validation -> set_rules('telefone', 'TELEFONE', 'trim|required');

			if($this->form_validation->run() == FALSE):
				if(validation_errors()):
					set_msg('<div class="alert alert-warning"><p>'.validation_errors().'</p></div>');
				endif;

			else:
				$dados = elements(array('nome', 'email', 'login','telefone'), $this->input->post());

				$dados['senha'] = md5($this->input->post('senha'));

				if (cargo()==1 || cargo()==2) $dados['adm'] = ($this->input->post('adm')==1) ? 1 : 0;
				$this->usuarios->do_insert($dados);

			endif;

		else:
			$CI = &get_instance();
			$CI->session->set_userdata(array('redir_para'=>current_url()));
			set_msg('msgerro', 'Seu Usuario não tem acesso', 'erro');
			redirect(base_url());
		endif;

		set_tema('titulo', 'Cadastro de Usuarios');
		set_tema('conteudo', load_modulo('usuarios', 'cadastrar'));
		load_templade();
	}
	public function gerenciar(){
		esta_logado();
		if(cargo()==1 || cargo()==2):

			set_tema('headerinc', load_css(array('dataTables.bootstrap4.min')), FALSE);
			set_tema('footerinc', load_js(array('jquery.datatables')), FALSE);
			set_tema('titulo', 'Listagem de usuários');
			set_tema('conteudo', load_modulo('usuarios', 'gerenciar'));
			load_templade();

		else:
			$CI = &get_instance();
			$CI->session->set_userdata(array('redir_para'=>current_url()));
			set_msg('msgerro', 'Seu Usuario não tem acesso', 'erro');
			redirect(base_url());
		endif;
	}

	public function alterar_senha(){
		esta_logado();
		$this -> form_validation -> set_rules('senha', 'SENHA', 'trim|required|min_length[4]|strtolower');
		$this -> form_validation -> set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[4]|strtolower|matches[senha]');
		$this -> form_validation -> set_message('matches','O campo %s está diferente do campo %s');
		if($this->form_validation->run()==TRUE):
			$dados['senha'] = md5($this->input->post('senha'));
			$this->usuarios->do_update($dados, array('id'=>$this->input->post('idusuario')));
			set_msg('<div class="alert alert-danger"><p>Erro Desconhecido contate o administrador</p></div>');
		endif;
		set_tema('titulo', 'Alteração de senha');
		set_tema('conteudo', load_modulo('usuarios', 'alterar_senha'));
		load_templade();
	}

	public function editar(){
		esta_logado();
		$this -> form_validation -> set_rules('nome', 'NOME', 'trim|required|ucwords');
		$this -> form_validation -> set_rules('telefone', 'TELEFONE', 'trim|required');
		if($this->form_validation->run()==TRUE):
			$upload = $this->usuarios->do_upload('arquivo');

			if (is_array($upload) && $upload['file_name']!= ''):
				$dados['ativo'] = ($this->input->post('ativo')==1 ? 1 : 0);
				$dados['nome'] = $this->input->post('nome');
				$dados['telefone'] = $this->input->post('telefone');
				$dados['arquivo'] = $upload['file_name'];
			endif;
				
			if (cargo()==1) $dados['adm'] = ($this->input->post('adm')==1) ? 1 : 0;
			$this->usuarios->do_update($dados, array('id'=>$this->input->post('idusuario')));
			set_msg('<div class="alert alert-danger"><p>Erro Desconhecido contate o administrador</p></div>');
		endif;
		set_tema('titulo', 'Alteção de Usuarios');
		set_tema('conteudo', load_modulo('usuarios', 'editar'));
		load_templade();
	}

	public function excluir(){
		esta_logado();
		if (cargo()==1):
			$iduser = $this->uri->segment(3);
			if ($iduser != NULL):
				$query = $this->usuarios->get_byid($iduser);
				if ($query->num_rows()==1):
					$query = $query->row();
					if ($query->id != 1):
						$this->usuarios->do_delete(array('id'=>$query->id), FALSE);
					else:
						set_msg('<div class="alert alert-danger"><p>Este Usuario não pode ser excluido</p></div>');
					endif;
				else:
					set_msg('<div class="alert alert-danger"><p>Usuario não encontrado para exclusão</p></div>');
				endif;
			else:
				set_msg('<div class="alert alert-danger"><p>Escolha um usuario para excluir</p></div>');
			endif;
		endif;
		redirect('usuarios/gerenciar');
	}
}
