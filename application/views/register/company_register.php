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
	<?php $this->load->view("shared/navbar") ?>
	<section class = "container" id="cadastroEmpresa">
		<header class="content">
			<h2 class="heading">
				<span></span>
				Cadastro empresa
			</h2>
		</header>

		<div class="errs">
			<?php 
			if ($this->session->flashdata("err-regist")) 
			{
				echo "<p class='text-danger text-center'> <b>:( Ocorreu um erro ao efetuar Login.</p><p class='text-danger text-center'>Verifique sua conexão e tente novamente.</b></p>";
			} 
			?>
		</div>
		
		<?=form_open("authentication/register_company") ?>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="nome">Nome Fantasia:</label>
					<input type="text" class="form-control" name="nome" placeholder="Entre com o nome da sua empresa" value="<?=set_value('nome') ?>">
					<?=form_error('nome'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" class="form-control" name="email" placeholder="Ex.: meuemail@email.com" value="<?=set_value('email') ?>">
					<?=form_error('email'); ?>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-6">	
				<div class="form-group">
					<label for="telefone">Telefone de Contato:</label>
					<input type="text" class="form-control" name="telefone" maxlength="15" placeholder="entre com seu telefone" value="<?=set_value('telefone') ?>">
					<?=form_error('telefone'); ?>
				</div>
			</div>
			<div class="col-md-6">	
				<div class="form-group">
					<label for="cadastroestadual">CNPJ:</label>
					<input type="text" class="form-control" name="cadastroestadual" maxlength="15" placeholder="entre com o CNPJ da sua empresa" value="<?=set_value('cadastroestadual') ?>">
					<?=form_error('cadastroestadual'); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<label for="cep">CEP:</label>
				<input type="text" class="form-control" id="cep" name="cep" placeholder="Ex: 30305900" value="<?=set_value('cep') ?>">
				<img class="loader" id="loader" src='<?=base_url("images/loader.gif")?>' alt="">
				<?=form_error('cep'); ?>
			</div>
			<div class="col-md-4">
				<label for="bairro">Bairro:</label>
				<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Ex: Laranjeiras" value="<?=set_value('bairro') ?>">
				<?=form_error('bairro'); ?>
			</div>
			<div class="col-md-4">
				<label for="cidade">Cidade:</label>
				<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Ex: Belo Horizonte" value="<?=set_value('cidade') ?>">
				<?=form_error('cidade'); ?>
			</div>
		</div>

		<br>
		<div class="row">
			<div class="col-md-6">
				<label for="uf">Estado:</label>
				<input type="text" class="form-control" id="uf" name="uf" value="MG" disabled value="<?=set_value('uf') ?>">
				<?=form_error('uf'); ?>
			</div>
			<div class="col-md-6">	
				<label for="rua">Rua:</label>
				<input type="text" class="form-control" id="rua" name="rua" placeholder="Ex: Rua Costa da Silva" value="<?=set_value('rua') ?>">
				<?=form_error('rua'); ?>
			</div>
		</div>

		<br>


		<div class="row">
			<div class="col-md-6">
				<label for="numero">Nº:</label>
				<input type="text" class="form-control" maxlength="7" name="numero" placeholder="Ex: 50" value="<?=set_value('numero') ?>">
				<?=form_error('numero'); ?>
			</div>
			<div class="col-md-6">
				<label for="complemento">Complemento:</label>
				<input type="text" class="form-control" name="complemento" placeholder="Ex: bloco c, ap 204" value="<?=set_value('complemento') ?>">
				<?=form_error('complemento'); ?>
			</div>
		</div>

		<br>
		<br>

		<div class="row loginEsenha">
			<div class="col-md-4">
				<div class="form-group">
					<label for="login">Login:</label>
					<input id="login" type="text" data-minlength="5" maxlength="20" class="form-control" name="login" placeholder="entre 5 e 12 caracteres" value="<?=set_value('login') ?>">
					<?=form_error('login'); ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="senha">Senha:</label>
					<input id="senha" type="password" data-minlength="6" maxlength="15" class="form-control" name="senha" placeholder="entre 6 e 12 caracteres">
					<p id="msgErr" class="text-danger kop"><span class="glyphicon glyphicon-exclamation-sign"></span> As senhas não conferem.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class ="form-group">
					<label for="confirmSenha">Confirme a senha:</label>
					<input id="confimacao_senha" name="confirmSenha" type="password" data-minlength="6" maxlength="15" class="form-control" data-match="#senha" data-match-error="Verifique as informações fornecidas" placeholder="Confirme a senha">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<button id="okOk" type="submit" class="btn btn-block btn-primary" disabled="true"> Cadastrar</button>
				<?=form_close() ?>
			</div>
			<div class="col-md-6">
				<?=form_open("authentication/authenticate_user");?>
				<button type="submit" class="btn btn-warning btn-block"> Voltar</button>
				<?=form_close() ?>
			</div>
			
		</div>

		<div class="row" style ="margin-top: 15px; margin-bottom: 15px; padding">
			
		</div>
		

		<script type="text/javascript">
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
	</section>
</body>