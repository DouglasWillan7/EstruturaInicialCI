<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function do_update($dados=NULL, $condicao=NULL, $redir=TRUE){
		if($dados !=NULL && is_array($condicao)):
			$this->db->update('usuarios', $dados, $condicao);
			if($this->db->affected_rows()>0):
				set_msg('<div class="alert alert-success"><p>Senha alterada com Sucesso</p></div>');
				auditoria('Alteração de usuários', 'Um foi usuario alterado no sistema');
				
			else:
				set_msg('<div class="alert alert-danger"><p>erro desconhecido</p></div>');
			endif;
			if($redir) redirect(current_url());
		endif;
	}


	public function do_insert($dados=NULL, $redir=FALSE){
		if($dados != NULL):
			$this->db->insert('usuarios', $dados);
			if($this->db->affected_rows()>0):
				auditoria('Inclusão de usuários', 'Um novo usuario foi incluso no sistema');
				set_msg('<div class="alert alert-success"><p>Cadastro Efetuado com sucesso</p></div>');
			else:
				set_msg('msgerro', 'Erro ao inserir dados', 'erro');
			endif;
			if ($redir) redirect(current_url());
		endif;
	}

	public function do_delete($condicao=NULL, $redir=TRUE){
		if($condicao != NULL && is_array($condicao)):
			$this->db->delete('usuarios', $condicao);
			if ($this->db->affected_rows()>0):
				auditoria('Exlusão de usuários', 'Um foi excluido no sistema');
				set_msg('<div class="alert alert-success"><p>Usuario Excluido com Sucesso</p></div>');
			else:
				set_msg('<div class="alert alert-danger"><p>Erro ao excluir registro</p></div>');
			endif;

			set_msg('<div class="alert alert-success"><p>Registro excluido com sucesso</p></div>');
			if($redir) redirect(current_url());
		endif;
	}

	public function do_upload($campo) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 5120;
        $this -> load -> library('upload', $config);
        if ($this -> upload -> do_upload($campo)) :
            return $this -> upload -> data();
        else :
            return $this -> upload -> display_erros();
        endif;
    }

	public function do_login($usuario=NULL, $senha=NULL){
		if ($usuario && $senha):
			$this->db->where('login',$usuario);
			$this->db->where('senha',$senha);
			$this->db->where('ativo', 1);
			$query = $this->db->get('usuarios');
			if($query->num_rows() == 1):
				return TRUE;
			else:
				return FALSE;
			endif;
		else:
			return FALSE;
		endif;
	}

	public function get_bylogin($login=NULL){
		if($login!=NULL):
			$this->db->where('login', $login);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		else:
			return FALSE;
		endif;
	}

	public function get_byemail($email=NULL){
		if($email!= NULL):
			$this->db->where('email', $email);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		else:
			return FALSE;
		endif;
	}

	public function get_byid($id=NULL){
		if($id!= NULL):
			$this->db->where('id', $id);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		else:
			return FALSE;
		endif;
	}

	public function get_all(){
		return $this->db->get('usuarios');
	}
}
