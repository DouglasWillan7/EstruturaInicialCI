<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
        <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.ico'); ?>">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script>
    	<link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css'); ?>" rel="stylesheet" />
        
        


		<title><?php if(isset($titulo)):  ?>{titulo} | <?php endif; ?>{titulo_padrao}</title>
		{headerinc}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Bootstrap -->

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<link rel="shortcut icon" href="<?php echo base_url('dist/img/favicon.ico'); ?>">
		<![endif]-->


	</head>
	<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?php echo base_url('dist/img/background.jpg'); ?>"</div>

        <div class="logo">
            <a href="<?php echo base_url(); ?>" class="logo-text">
                Titulo
            </a>
        </div>
		<div class="logo logo-mini">
			<a href="<?php echo base_url(); ?>" class="logo-text">
				titulo
			</a>
		</div>

    	<div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">

                    <?php 
                    $iduser = $this->session->userdata('user_id');
                    $query = $this->usuarios->get_byid($iduser)->row();
                    echo thumb($query->arquivo, 300, 180); ?>
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                        <?php echo $this -> session -> userdata('user_nome'); ?>
                        <b class="caret"></b>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li><a href="<?php echo base_url('usuarios/editar') . '/' . $this -> session -> userdata('user_id'); ?>">Editar Perfil</a></li>
                            <li><a href="<?php echo base_url('usuarios/alterar_senha') . '/' . $this -> session -> userdata('user_id'); ?>">Alterar Senha</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <ul class="nav">
                
                

                
                </li>
                 
            

            <?php 

                if(cargo()==1):
                    echo '
                            <li>
                                <a data-toggle="collapse" href="#usuarios">
                                    <i class="pe-7s-users"></i>
                                    <p>Usuarios
                                       <b class="caret"></b>
                                    </p>
                                </a>
                                <div class="collapse" id="usuarios">
                                    <ul class="nav">
                                        <li><a href="';
                                        ?>

                                        <?php echo base_url('usuarios/cadastrar')?>
                                        
                                        <?php
                                        echo '
                                        " accesskey="u">Cadastrar</a></li>
                                    <li><a href="';
                                        ?>

                                        <?php echo base_url('usuarios/gerenciar')?>
                                        
                                        <?php
                                        echo '
                                        " accesskey="g">Gerenciar</a></li>
                                        
                                    </ul>
                                </div>
                            </li>
                        ';
                else:
                    echo '';
                endif;

                ?>

            <?php 

                if(cargo()==1):
                    echo '
                            <li>
                                <a data-toggle="collapse" href="#admin">
                                    <i class="pe-7s-id"></i>
                                    <p>Administração
                                       <b class="caret"></b>
                                    </p>
                                </a>
                                <div class="collapse" id="admin">
                                    <ul class="nav">
                                        <li><a href="';
                                        ?>

                                        <?php echo base_url('auditoria')?>
                                        
                                        <?php
                                        echo '
                                        " accesskey="l">Log</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>';
                else:
                    echo '';
                endif;

                ?>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
			<div class="container-fluid">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('/assets/img/logo.png'); ?>"></a>

				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>
                            <a href="<?php echo base_url('usuarios/logoff'); ?>">Logoff &nbsp<i class="fa fa-sign-out"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

        {conteudo}



            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright text-center">
                    &copy; 2017 <strong>DWX Soluções</strong>, Eficiência e Qualidade
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

{footerinc}
    
    
    
    
    



</html>
