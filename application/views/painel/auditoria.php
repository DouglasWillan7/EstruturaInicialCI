<?php
defined('BASEPATH') OR exit('No direct script access allowed');
switch ($tela):

	case 'gerenciar':
		?>
		
		
         
       <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">
                                <div class="toolbar">

                                </div>
                                <div class="fresh-datatables">
                                    <table id="datatables_usuarios" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                            <tr>
                                
                                <th>ID</th>
                                <th>Usuário</th>
								<th>Data e hora</th>
								<th>Operação</th>
								<th>Observação</th>	
	                        </thead>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 

 
 

			
		<?php
		break;
	default:
		echo '<div class="alert"><p>A tela solicitada não existe</p></div>';
		break;
endswitch;
