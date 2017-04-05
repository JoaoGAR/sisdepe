<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISDEPE - Cadastro de Empresa</title>
	<link rel="stylesheet" href="<?=base_url("css/bootstrap.css");?>">
	<link rel="stylesheet" href="<?=base_url("css/main.css");?>">
	<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?=base_url("css/vendors/plugins.css");?>">
	<link rel="stylesheet" href="<?=base_url("path/to/font-awesome/css/font-awesome.min.css");?>">
	<link rel="stylesheet" href="<?=base_url("css/style.css");?>">
	<link rel="stylesheet" href="<?=base_url("css/responsive.css");?>">
	<script src="<?=base_url("js/jquery.min.js");?>"></script>
	<script src="<?=base_url("js/bootstrap.min.js");?>"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<?php if ($this->session->userdata("user_logged_in")) {?>

				<ul class="nav navbar-nav">
					<li><a href="../user/load_feed"><span class="glyphicon glyphicon-home"></span></a></li>
				</ul>


				<?php if ($this->session->userdata("user_logged_in")["user_type"] == 0 || $this->session->userdata("user_logged_in")["user_type"] == 2) { ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Grupos <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../team/list_groups">Listar Grupos</a></li>
						<li><a href="../team/create_group">Criar Grupos</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tarefas <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../job/list_jobs">Listar Tarefas</a></li>
						<li><a href="../job/create_job">Criar Tarefas</a></li>
					</ul>
				</li>

				<?php } if ($this->session->userdata("user_logged_in")["user_type"] == 0) { ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Funcionários <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="../user/list_employees">Listar Funcionários</a></li>
						<li><a href="../authentication/register_user">Cadastrar Funcionário</a></li>
					</ul>
				</li>
				<?php } ?>
				<li>
					<li><a href="../authentication/log_out"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
				</li>
				<?php  
			} else { ?>
			<li>
				<li id="login-modal-btn"><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logar</a></li>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>
</nav>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="login-small-model" id="login-modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?=form_open("authentication/authenticate_user") ?>
			<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="exampleModalLabel">Contato</h4>
	      	</div>
				<div class="modal-body">
					<div style="margin-left: calc(50% - 131px);">
						<div class="">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Login</span>
								<?=form_input(array('name'=>'login','id'=>'login','type'=>'text','class'=>'form-control','aria-describedby'=>'basic-addon1')) ?>
							</div>
						</div>
						<div class="text-center" style="padding-top:3px;">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Senha</span>
								<?=form_input(array('name'=>'password','id'=>'password','type'=>'password','class'=>'form-control','aria-describedby'=>'basic-addon1')) ?>
							</div>
						</div>
						<div class="modal-footer">
					        <button type="submit" class="btn btn-default" data-dismiss="modal">Fechar</button>
					        <input type="submit" value="Logar" id="login-btn" class="btn btn-primary">
				      	</div>
					</div>
				</div>
			<?=form_close() ?>
		</div>
	</div>
</div>

<script type="text/javascript">
$("#login-modal-btn").on('click', function(e){
	$("#login-modal").modal('show');
})

$("#login, #password").on('keyup change', function(e){
	if($("#login").val().length != 0 && $("#password").val().length != 0){
		$("#login-btn").removeClass("disabled");
	}
	else {
		$("#login-btn").addClass("disabled");
	}
})
</script>
</body>