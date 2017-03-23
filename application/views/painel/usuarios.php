<?php
defined('BASEPATH') OR exit('No direct script access allowed');
switch ($tela):
	case 'login':
		echo '<div class="content">';
      	echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">';
        echo form_open('usuarios/login');
        echo '<div class="card card-hidden">';
        echo '<div class="header text-center"><img src="../assets/img/logo_entrar.png" width="50%" heigh="50%" /></div>';
        echo '<div class="content">';
        echo '<div class="form-group">';
        erros_validacao();
        if($msg = get_msg()):
            echo $msg;
        endif;
        echo form_label('Usuario');
        echo form_input(array('name'=>'usuario','placeholder'=>'Usuario', 'class'=>'form-control'));
        echo '</div>';

        echo '<div class="form-group">';
        echo form_label('Senha');
        echo form_password(array('name' => 'senha','placeholder' => 'Senha', 'class' => 'form-control'));
        echo form_hidden('redirect', $this->session->userdata('redir_para'));
        echo '</div>';

        echo '<div class="footer text-center">';
        echo form_submit(array('name' => 'logar', 'class' => 'btn btn-fill btn-primary btn-wd'),'Login');
        echo '</div>';
        echo '</div>';
        echo form_close();
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
		break;

	case 'cadastrar' :

		echo '<div class="content">';
        echo '<div class="container-fluid">';
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<div class="card">';
        echo breadcrumb();
        echo '</div>';
        echo '<div class="card">';
        if($msg = get_msg()):
            echo $msg;
        endif;
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="content">';
        echo '<div class="container-fluid">';
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<div class="card">';

        echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'novoUsuario', 'novalidate' => ''));
        echo '<div class="content">';
        echo '<legend>Cadastrar Novo Usuario</legend>';

        echo '<fieldset>';
        echo '<div class="form-group">';
        echo form_label('Nome Completo','',array('class' => 'col-sm-2 control-label'));
        echo '<div class="col-sm-6">';
        echo form_input(array('name' => 'nome', 'class' => 'form-control', 'required' => 'true'), set_value('nome'), 'autofocus');
        echo '</div>';
        echo '</div>';
        echo '</fieldset>';

        echo '<fieldset>';
        echo '<div class="form-group">';
        echo form_label('Email','',array('class' => 'col-sm-2 control-label'));
        echo '<div class="col-sm-6">';
        echo form_input(array('name' => 'email', 'class' => 'form-control', 'required' => 'true', 'email'=>"true"), set_value('email'));
        echo '</div>';
        echo '</div>';
        echo '</fieldset>';

        echo '<fieldset>';
        echo '<div class="form-group">';
        echo form_label('Login','',array('class' => 'col-sm-2 control-label'));
        echo '<div class="col-sm-6">';
        echo form_input(array('name' => 'login', 'class' => 'form-control', 'required' => 'true'), set_value('login'));
        echo '</div>';
        echo '</div>';
        echo '</fieldset>';

        echo '<fieldset>';
        echo '<div class="form-group">';
        echo form_label('Senha','',array('class' => 'col-sm-2 control-label'));
        echo '<div class="col-sm-6">';
        echo form_password(array('name' => 'senha', 'class' => 'form-control', 'id'=>'senha1', 'required'=> 'true'), set_value('senha'), 'auto-focus');
        echo '</div>';
        echo '</div>';
        echo '</fieldset>';

        echo '<fieldset>';
        echo '<div class="form-group">';
        echo form_label('Repita a senha','',array('class' => 'col-sm-2 control-label'));
        echo '<div class="col-sm-6">';
        echo form_password(array('name' => 'senha2', 'class' => 'form-control', 'id'=>'senha2', 'required'=> 'true', 'equalTo'=>'#senha1'), set_value('senha2'));
        echo '</div>';
        echo '</div>';
        echo '</fieldset>';

        echo '<fieldset>';
        echo '<div class="form-group">';
        echo form_label('Telefone','',array('class' => 'col-sm-2 control-label'));
        echo '<div class="col-sm-6">';
        echo form_input(array('name' => 'telefone', 'class' => 'form-control tamanho-form sp_celphones', 'id' => 'sp_celphones', 'placeholder'=>'(XX) XXXXX-XXXX', 'required' => 'true'), set_value('telefone'));
        echo '</div>';
        echo '</div>';
        echo '</fieldset>';


        echo '<div class="footer text-center">';
        echo anchor('usuarios/gerenciar', 'Cancelar', array('class' => 'btn btn-danger btn-fill'));
        echo '&nbsp';
        echo '&nbsp';
        echo form_submit(array('name' => 'alterarsenha', 'class' => 'btn btn-info btn-fill'), 'Salvar Dados');
            
        echo form_close();
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

		break;

	case 'gerenciar':
		?>
		<script type="text/javascript">
			$(function(){
				$('.deletareg').click(function(){
					if(confirm("Deseja realmente excluir este registro?\nEsta operação não podera ser desfeita!")) return true; else return false;
				});
			});
		</script>

		
			<?php
			 echo '<div class="content">';
	        echo '<div class="container-fluid">';
	        echo '<div class="row">';
	        echo '<div class="col-md-12">';
	        echo '<div class="card">';
	        echo breadcrumb();
	        echo '</div>';
	        echo '<div class="card">';
	        if($msg = get_msg()):
                echo $msg;
            endif;
	        echo '</div>';
	        echo '</div>';
	        echo '</div>';
	        echo '</div>';
			?>
			<div class="content">
            <div class="container-fluid">
            <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
                                <div class="fresh-datatables">
                                    <table id="datatables_usuarios" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
							<th>Nome</th>
							<th>Login</th>
							<th>Email</th>
							<th>Ativo / Adm</th>
							<th class="text-center">Ações</th>
	                            </tr>
	                        </thead>
                        <tbody>
                            <?php
                            
                            $query = $this->usuarios->get_all()->result();
							foreach ($query as $linha):
								echo '<tr>';
								printf('<td>%s</td>', $linha->nome);
								printf('<td>%s</td>', $linha->login);
								printf('<td>%s</td>', $linha->email);
								printf('<td>%s / %s</td>', ($linha->ativo==0) ? 'Não' : 'Sim', ($linha->adm==0) ? 'Não' : 'Sim');
								printf('<td class="text-center">%s%s%s</td>',
							 anchor("usuarios/editar/$linha->id", '<i class="fa fa-pencil espaco"></i>', array('class'=>'table-actions table-edit', 'title'=>'editar')),
							 anchor("usuarios/alterar_senha/$linha->id", '<i class="fa fa-lock espaco"></i>', array('class'=>'table-actions table-pass', 'title'=>'Alterar Senha')),
							 anchor("usuarios/excluir/$linha->id", '<i class="fa fa-trash"></i>', array('class'=>'table-actions table-delete deletareg', 'title'=>'excluir')));
								echo '</tr>';
							endforeach;
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
		<?php
		break;

	case 'alterar_senha':
		$iduser = $this->uri->segment(3);
		if($iduser==NULL):
			set_msg('msgerro', 'escolha um usuario para alterar', 'erro');
			redirect('usuarios/gerenciar');
		endif; ?>
		<?php
		if(cargo()==1 || $iduser == $this->session->userdata('user_id')):
			$query = $this->usuarios->get_byid($iduser)->row();
            echo '<div class="content">';
            echo '<div class="container-fluid">';
            echo '<div class="row">';
            echo '<div class="col-md-12">';
            echo '<div class="card">';
            echo breadcrumb();
            echo '</div>';
            echo '<div class="card">';
            if($msg = get_msg()):
                echo $msg;
            endif;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="content">';
            echo '<div class="container-fluid">';
            echo '<div class="row">';
            echo '<div class="col-md-12">';
            echo '<div class="card">';

            echo form_open(current_url(), array('class' => 'form-horizontal'));
            echo '<div class="content">';
            echo '<legend>Alteração de Senha</legend>';
            erros_validacao();
            get_msg('msgok');

            echo '<fieldset>';
            echo '<div class="form-group">';
            echo form_label('Nome Completo','',array('class' => 'col-sm-2 control-label'));
            echo '<div class="col-sm-6">';
            echo form_input(array('name' => 'nome', 'class' => 'form-control', 'disabled'=>'disabled'), set_value('nome', $query->nome));
            echo '</div>';
            echo '</div>';
            echo '</fieldset>';

            echo '<fieldset>';
            echo '<div class="form-group">';
            echo form_label('Email','',array('class' => 'col-sm-2 control-label'));
            echo '<div class="col-sm-6">';
            echo form_input(array('name' => 'email', 'class' => 'form-control', 'disabled'=>'disabled'), set_value('email', $query->email));
            echo '</div>';
            echo '</div>';
            echo '</fieldset>';

            echo '<fieldset>';
            echo '<div class="form-group">';
            echo form_label('Login','',array('class' => 'col-sm-2 control-label'));
            echo '<div class="col-sm-6">';
            echo form_input(array('name' => 'login', 'class' => 'form-control', 'disabled'=>'disabled'), set_value('login', $query->login));
            echo '</div>';
            echo '</div>';
            echo '</fieldset>';

            echo '<fieldset>';
            echo '<div class="form-group">';
            echo form_label('Nova Senha','',array('class' => 'col-sm-2 control-label'));
            echo '<div class="col-sm-6">';
            echo form_password(array('name' => 'senha', 'class' => 'form-control'), set_value('senha'), 'auto-focus');
            echo '</div>';
            echo '</div>';
            echo '</fieldset>';

            echo '<fieldset>';
            echo '<div class="form-group">';
            echo form_label('Repita a senha','',array('class' => 'col-sm-2 control-label'));
            echo '<div class="col-sm-6">';
            echo form_password(array('name' => 'senha2', 'class' => 'form-control'), set_value('senha2'));
            echo '</div>';
            echo '</div>';
            echo '</fieldset>';

            echo '<div class="footer text-center">';
            echo anchor('usuarios/gerenciar', 'Cancelar', array('class' => 'btn btn-danger btn-fill'));
            echo '&nbsp';
            echo '&nbsp';
            echo form_submit(array('name' => 'alterarsenha', 'class' => 'btn btn-info btn-fill'), 'Salvar Dados');
            echo form_hidden('idusuario', $iduser);
            echo form_close();
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
		else:
			set_msg('msgerro', 'Seu usuário não tem permissão para executar esta operação', 'erro');
			redirect('usuarios/gerenciar');
		endif; ?>
	</div>
	<?php
	break;
	case 'editar':
		$iduser = $this->uri->segment(3);
		if($iduser==NULL):
			set_msg('msgerro', 'Escolha um usuario para alterar', 'erro');
			redirect('usuarios/gerenciar');
		endif;
        ?>
		<?php
		if(cargo()==1 || $iduser == $this->session->userdata('user_id')):
			$query = $this->usuarios->get_byid($iduser)->row();
			echo '<div class="content">';
			echo '<div class="container-fluid">';
			echo '<div class="row">';
			echo '<div class="col-md-12">';
			echo '<div class="card">';
			echo breadcrumb();
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '<div class="content">';
			echo '<div class="container-fluid">';
			echo '<div class="row">';
			echo '<div class="col-md-8">';
			echo '<div class="card">';
			echo form_open_multipart(current_url(), array('class' => 'form-horizontal'));
			echo '<div class="content">';
			echo '<legend>Alteração Usuário</legend>';
			get_msg('msgok');

			echo '<fieldset>';
			echo '<div class="form-group">';
			echo form_label('Nome Completo','',array('class' => 'col-sm-3 control-label'));
			echo '<div class="col-sm-8">';
			echo form_input(array('name' => 'nome', 'class' => 'form-control'), set_value('nome', $query->nome), 'auto-focus');
			echo '</div>';
			echo '</div>';
			echo '</fieldset>';

			echo '<fieldset>';
			echo '<div class="form-group">';
			echo form_label('Email','',array('class' => 'col-sm-3 control-label'));
			echo '<div class="col-sm-8">';
			echo form_input(array('name' => 'email', 'class' => 'form-control', 'disabled'=>'disabled'), set_value('email', $query->email));
			echo '</div>';
			echo '</div>';
			echo '</fieldset>';

            echo '<fieldset>';
            echo '<div class="form-group">';
            echo form_label('Login','',array('class' => 'col-sm-3 control-label'));
            echo '<div class="col-sm-8">';
			echo form_input(array('name' => 'login', 'class' => 'form-control', 'disabled'=>'disabled'), set_value('login', $query->login));
            echo '</div>';
			echo '</div>';
			echo '</fieldset>';

            echo '<fieldset>';
            echo '<div class="form-group">';
            echo form_label('Cargo','',array('class' => 'col-sm-3 control-label'));
            echo '<div class="col-sm-8">';
            echo form_input(array('name' => 'cargo', 'class' => 'form-control', 'disabled'=>'disabled'), set_value('cargo', $query->cargo));
            echo '</div>';
            echo '</div>';
            echo '</fieldset>';


			echo '<fieldset>';
			echo '<div class="form-group">';
			echo form_label('Telefone','',array('class' => 'col-sm-3 control-label'));
			echo '<div class="col-sm-8">';
			echo form_input(array('name' => 'telefone', 'class' => 'form-control sp_celphones'), set_value('telefone', $query->telefone));
            echo '</div>';
            echo '</div>';
            echo '</fieldset>';

            echo '<fieldset>';
            echo '<div class="form-group">';
            echo form_label('Altere sua foto','',array('class' => 'col-sm-3 control-label'));
            echo '<div class="col-sm-7">';
            echo form_upload(array('name' => 'arquivo', 'class' => 'form-control'), set_value('arquivo'));

			echo '<br/>';


			echo form_checkbox(array('name' => 'ativo'), '1', ($query->ativo==1) ? TRUE : FALSE) . ' Permitir o acesso deste usuário ao sistema <br/><br/>';
			echo form_checkbox(array('name' => 'adm'), '1', ($query->adm==1) ? TRUE : FALSE) . ' Dar poderes administrativos a este usuarios <br/><br/>';
				

            echo '</div>';
            echo '</div>';
            echo '</fieldset>';


            echo '<div class="footer text-center">';
            echo anchor('usuarios/gerenciar', 'Cancelar', array('class' => 'btn btn-danger btn-fill'));
            echo '&nbsp';
            echo '&nbsp';
            echo form_submit(array('name' => 'editar', 'class' => 'btn btn-info btn-fill'), 'Salvar Dados');
            echo form_hidden('idusuario', $iduser);
            echo form_close();
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


            echo '<div class="col-md-4">';
            echo '<div class="card card-user">';
            echo '<div class="image">';
            echo '<img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>';
            echo '</div>';
            echo '<div class="content">';
            echo '<div class="author">';
                
            echo thumb($query->arquivo, 300, 180, 'avatar border-gray');
            echo '<h4 class="title">';
            echo $query->nome;
            echo '</h4>';
            echo '</div>';
            echo '<div class="content">';
            echo '<p class="description text-center">';
            echo $query->cargo ;
            echo '<br></p>';
            echo '</div>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

			else:
				set_msg('msgerro', 'Seu usuário não tem permissão para executar esta operação', 'erro');
				redirect('usuarios/gerenciar');
			endif; ?>
		</div>
		<?php
	break;
	default:
		echo '<div class="alert"><p>A tela solicitada não existe</p></div>';
		break;
endswitch;
