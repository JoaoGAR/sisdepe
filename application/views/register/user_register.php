<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISDEPE - Cadastro de pessoa Física</title>
	<link rel="stylesheet" href="<?=base_url("css/bootstrap.css");?>">
	<link rel="stylesheet" href="<?=base_url("css/main.css");?>">
	<script src="<?=base_url("js/jquery.min.js");?>"></script>
	<script src="<?=base_url("js/bootstrap.min.js");?>"></script>
</head>
<body>
	<?php $this->load->view("shared/navbar") ?>
	<div class="container">
		<div class="col-md-8 col-md-offset-2 formulario_cadastro">
			
			<div class="col-md-12">
				<div class="col-md-12">
					<!-- PESSOA FÍSICA -->
					<div role="tabpanel" class="tab-pane" id="pessoaFisica">
						<div>
							<?php if ($this->session->flashdata("succee-regist-user")) {?>
							<p class="text-success col-md-offset-2"><span class="glyphicon glyphicon-exclamation-sign"></span> Cadastro efetuado com secesso.</p>
							<?php }
							if ($this->session->flashdata("err-regist-user")) {?>
							<p class="text-danger col-md-offset-2"><span class="glyphicon glyphicon-exclamation-sign"></span> Verifique as informações fornecidas.</p>
							<?php } ?>
						</div>
						<div>
							<?php echo form_open("authentication/register_user");?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="nome">Nome Completo:</label>
										<input id="nome" type="text" class="form-control" name="nome" placeholder="Entre com o seu nome" value="<?=set_value('nome') ?>">
										<?php echo form_error('nome'); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">Email:</label>
										<input id="email" type="text" class="form-control" name="email" placeholder="Ex.: meuemail@email.com" value="<?=set_value('email') ?>">
										<?php echo form_error('email'); ?>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">	
									<div class="form-group">
										<label for="telefone">Telefone de Contato:</label>
										<input id="telefone" type="text" class="form-control" name="telefone" maxlength="15" placeholder="entre com seu telefone" value="<?=set_value('telefone') ?>">
										<?php echo form_error('telefone'); ?>
									</div>
								</div>
								
							</div>

							<div class="row loginEsenha">
								<div class="col-md-4">
									<div class="form-group">
										<label for="login">Login:</label>
										<input id="login" type="text" data-minlength="5" maxlength="12" class="form-control" name="login" placeholder="entre 5 e 12 caracteres" value="<?=set_value('login') ?>">
										<?php echo form_error('login'); ?>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="senha">Senha:</label>
										<input id="senha" type="password" data-minlength="6" maxlength="12" class="form-control" name="senha" placeholder="entre 6 e 12 caracteres">
										<p id="msgErr" class="text-danger kop"><span class="glyphicon glyphicon-exclamation-sign"></span> As senhas não conferem.</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class ="form-group">
										<label for="confirmSenha">Confirme a senha:</label>
										<input id="confimacao_senha" name="confirmSenha" type="password" data-minlength="6" maxlength="12" class="form-control" data-match="#senha" data-match-error="Verifique as informações fornecidas" placeholder="Confirme a senha">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<button id="okOk" type="submit" class="btn btn-block btn-primary" disabled="true"> Cadastrar</button>
								</div>
								<?php echo form_close() ?>
								<div class="col-md-6">
									<?php echo form_open("authentication/load_feed");?>
									<button type="submit" class="btn btn-warning btn-block"> Voltar</button>
									<?php echo form_close() ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
	$("#cep").bind('blur keyup change',function(e){
		$("#loader").show();
		var cep = $('#cep').val().replace('-', '');
		if(cep !== ""){
			var url = 'http://cep.correiocontrol.com.br/'+cep+'.json';
			$.getJSON(url, function(json){
				$("#rua").val(json.logradouro);
				$("#bairro").val(json.bairro);
				$("#cidade").val(json.localidade);
				$("#numero").focus();
				$("#loader").hide();
			}).fail(function(){
				$("#loader").hide();
				$("#rua").val("");
				$("#bairro").val("");
				$("#cidade").val("");
				$(this).focus();
			});
		}
	});

	$("#confimacao_senha").on("change click keyup", function(e){
		var senha = $("#senha").val();
		var confirm = $("#confimacao_senha").val();
		if (senha != confirm) {
			$("#msgErr").show();
		} else {
			$("#msgErr").hide();
			$("#okOk").removeAttr('disabled');
		}
	});

	</script>
</body>
</html>


