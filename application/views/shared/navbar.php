<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">

				<li>
					<div class="logo-container__logo">
						<img src="<?=base_url('images/logo.png') ?>" class="img-responsive" alt="" style="width: 35%; margin-bottom: 1%; margin-top: 1%; margin-left: 3%;">
					</div>
				</li>
				
				<?php if ($this->session->userdata("user_logged_in")) {?>

					<ul class="nav navbar-nav">
						<li><a href="../user/load_feed"><span class="glyphicon glyphicon-home home" style ="margin-top:15px;"></span></a></li>
					</ul>


					<?php if ($this->session->userdata("user_logged_in")["user_type"] == 0 || $this->session->userdata("user_logged_in")["user_type"] == 2) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #337ab7; margin-top:13px;">Grupos <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="../team/list_groups" style="color: #337ab7;">Listar Grupos</a></li>
							<li><a href="../team/create_group" style="color: #337ab7;">Criar Grupos</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #337ab7; margin-top:13px;">Tarefas <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="../job/list_jobs" style="color: #337ab7;">Listar Tarefas</a></li>
							<li><a href="../job/create_job" style="color: #337ab7;">Criar Tarefas</a></li>
						</ul>
					</li>

					<?php } if ($this->session->userdata("user_logged_in")["user_type"] == 0) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #337ab7; margin-top:13px;" >Funcionários <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="../user/list_employees" style="color: #337ab7;">Listar Funcionários</a></li>
							<li><a href="../authentication/register_user" style="color: #337ab7;">Cadastrar Funcionário</a></li>
						</ul>
					</li>
					<?php } ?>
					<li>
						<li><a href="../authentication/log_out"><span class="glyphicon glyphicon-log-out sair" style="margin-top:15px;"></span></a></li>
					</li>
					<?php  
				} else { ?>
				<li>
					<li style="margin-left: 0%; padding-top: 3%;" id="login-modal-btn" ><a href="#"><span class="glyphicon glyphicon-log-in teste"></span></a></li>
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
			<div class="modal-header" style ="background-color: #337ab7;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"id="exampleModalLabel">Contato</h4>
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