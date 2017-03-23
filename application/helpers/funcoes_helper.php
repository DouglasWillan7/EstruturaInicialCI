<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//carrega um modulo do sistema devolvendo a tela solicitada
function load_modulo($modulo = NULL, $tela = NULL, $diretorio = 'painel') {
	$CI = &get_instance();
	if ($modulo != NULL) :
		return $CI -> load -> view("$diretorio/$modulo", array('tela' => $tela), TRUE);
	else :
		return FALSE;
	endif;
}
//seta valores ao array $tema da classe sistema
function set_tema($prop, $valor, $replace = TRUE) {
	$CI = &get_instance();
	$CI -> load -> library('Sistema');
	if ($replace) :
		$CI -> sistema -> tema[$prop] = $valor;
	else :
		if (!isset($CI -> sistema -> tema[$prop])) $CI -> sistema -> tema[$prop] = '';
			$CI -> sistema -> tema[$prop] .= $valor;
		endif;

	}
//retorna os valores do array $tema da classe sistema
function get_tema(){
	$CI = &get_instance();
	$CI -> load -> library('Sistema');
	return $CI->sistema->tema;
}

//inicializa o painel adm carregando os recursos necessarios
function login(){
	$CI = &get_instance();
	$CI -> load -> library(array('sistema', 'session', 'form_validation'));
	$CI -> load -> helper(array('form', 'url', 'array', 'text'));
	//carregamento dos models
	$CI->load->model('Usuarios_model', 'usuarios');


	set_tema("titulo_padrao", "Teste");
	set_tema('rodape', '<p>&copy; 2017 | Todos os direitos reservadors para **********');
	set_tema('templade', 'login_view');

	set_tema('headerinc', load_css(array('')), FALSE);
	set_tema('headerinc', load_js(array('')), FALSE);
	set_tema('footerinc', load_js(array('')), FALSE);
}


function init_painel(){
	$CI = &get_instance();
	$CI -> load -> library(array('sistema', 'session', 'form_validation'));
	$CI -> load -> helper(array('form', 'url', 'array', 'text'));
	//carregamento dos models
	$CI->load->model('Usuarios_model', 'usuarios');


	set_tema("titulo_padrao", "Teste");
	set_tema('rodape', '<p>&copy; 2017 | Todos os direitos reservadors para **********');
	set_tema('templade', 'painel_view');

	set_tema('headerinc', load_css(array('bootstrap.min')), FALSE);
	set_tema('headerinc', load_js(array('')), FALSE);
	set_tema('footerinc', load_js(array('bootstrap.min')), FALSE);
}

//carrega um templade passando o array tema como parametro
function load_templade(){
	$CI = &get_instance();
	$CI -> load -> library('sistema');
	$CI -> parser -> parse($CI->sistema->tema['templade'], get_tema());
}

//carrega um ou varios arquivos .css de uma pasta
function load_css($arquivo=NULL, $pasta='css', $media='all'){
	if($arquivo!=NULL):
		$CI = &get_instance();
		$CI -> load -> helper('url');
		$retorno = '';
		if (is_array($arquivo)):
			foreach($arquivo as $css):
				$retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("dist/$pasta/$css.css").'" media="'.$media.'" />';
			endforeach;
		else:
			$retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("dist/$pasta/$arquivo.css").'" media="'.$media.'" />';
		endif;
	endif;
	return $retorno;
}

//carrega um ou varios arquivos .js de uma pasta ou servidor remoto
function load_js($arquivo=NULL, $pasta='js', $remoto=FALSE){
	if($arquivo!=NULL):
		$CI = &get_instance();
		$CI -> load -> helper('url');
		$retorno = '';
		if (is_array($arquivo)):
			foreach($arquivo as $js):
				if($remoto):
					$retorno .='<script type="text/javascript" src="'.$js.'"></script>';
				else:
					$retorno .='<script type="text/javascript" src="'.base_url("dist/$pasta/$js.js").'"></script>';
				endif;
				endforeach;
		else:
			if($remoto):
					$retorno .='<script type="text/javascript" src="'.$arquivo.'"></script>';
				else:
					$retorno .='<script type="text/javascript" src="'.base_url("dist/$pasta/$arquivo.js").'"></script>';
		endif;
	endif;
	endif;
	return $retorno;
}

//mostra erros de validação em forms
function erros_validacao(){
	if (validation_errors()) echo '<div class="alert alert-warning">'.validation_errors('<p>', '</p>').'</div>';
}

//verifica se o usuario esta logado no sistema
function esta_logado($redir=TRUE){
	$CI = &get_instance();
	$CI -> load -> library('session');
	$user_status = $CI->session->userdata('user_logado');
	if(!isset($user_status) || $user_status != TRUE):

		if($redir):
			$CI->session->set_userdata(array('redir_para'=>current_url()));
			set_msg('<div class="alert alert-danger"><p>Acesso restrito, Efetue o Login para continuar</p></div>');
			redirect('usuarios/login');
		else:
			return FALSE;
		endif;
	else:
		return TRUE;
	endif;
}

//define uma mensagem para ser exibida na próxima tela carregada
function set_msg($msg=NULL){
	$CI = &get_instance();
	$CI -> session -> set_userdata('aviso',$msg);
}

//verifica se existe uma mensagem para ser exibida na tela atual
function get_msg($destroy=TRUE){
	$CI = &get_instance();
	$retorno = $CI->session->userdata('aviso');
	if($destroy) $CI->session->unset_userdata('aviso');
	return $retorno;
}

//verifica se o usuario atual é administrador


function cargo(){
	$CI =& get_instance();
	return $CI->session->userdata('cargo');
}

//gera um breadcrumb com base no controller atual
function breadcrumb(){
	$CI =& get_instance();
	$CI->load->helper('url');
	$classe = ucfirst($CI->router->class);
	if ($classe == 'Painel'):
		$classe = anchor($CI->router->class, 'Início');
	else:
		$classe = anchor($CI->router->class, $classe);
	endif;
			$metodo = ucwords(str_replace('_', ' ', $CI->router->method));
			if ($metodo && $metodo != 'Index'):
				$metodo = anchor($CI->router->class."/".$CI->router->method, $metodo);
			else:
				$metodo = '';
			endif;

			return '
			<ol class="breadcrumb">
		  			<li><a href="#"><i class="pe-7s-home"></i> '.anchor('painel', 'Painel').'</a></li>
					<li><a href="#">'.$classe.'</a></li>
					<li class="active">'.$metodo.'</li>
				</ol>';
}

//seta um registro na tabela de auditoria
function auditoria($operacao, $obs, $query=TRUE){
	$CI = &get_instance();
	$CI -> load -> library('session');
	$CI ->load -> model('auditoria_model', 'auditoria');
	if ($query):
		$last_query = $CI->db->last_query();
	else:
		$last_query = '';
	endif;
	if (esta_logado(FALSE)):
		$user_id = $CI->session->userdata('user_id');
		$user_login = $CI->usuarios->get_byid($user_id)->row()->login;
	else:
		$user_login = 'Desconhecido';
	endif;

	$dados = array(
		'usuario' => $user_login,
		'operacao' => $operacao,
		'query' => $last_query,
		'observacao' => $obs,
	);
	$CI->auditoria->do_insert($dados);
}


//troca a ordem da data para o formato brasileiro
function dataBR($umadata) {

    $brdata = substr($umadata,8,2)."/".substr($umadata,5,2)."/".substr($umadata,0,4);

	return $brdata;
}

//gera uma miniatura de uma imagem caso ela ainda nao exista
function thumb($imagem=NULL, $largura=100, $altura=75, $class=NULL, $geratag=TRUE){
	$CI =& get_instance();
	$CI->load->helper('file');
	$thumb = $largura.'x'.$altura.'_'.$imagem;
	$thumbinfo = get_file_info('./uploads/thumbs/'.$thumb);
	if ($thumbinfo!=FALSE):
		$retorno = base_url('uploads/thumbs/'.$thumb);
	else:
		$CI->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/'.$imagem;
		$config['new_image'] = './uploads/thumbs/'.$thumb;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $largura;
		$config['height'] = $altura;
		$CI->image_lib->initialize($config);
		if($CI->image_lib->resize()):
			$CI->image_lib->clear();
			$retorno = base_url('uploads/thumbs/'.$thumb);
		else:
			$retorno = FALSE;
		endif;
	endif;
		if($geratag && $retorno != FALSE) $retorno = '<img class="'.$class.'" src="'.$retorno.'" alt=""/>';
	return $retorno;
}
