<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISDEPE - Início</title>
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

	<div class="container">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="errs">
				<?php 
				if ($this->session->flashdata("err-login")) 
				{
					echo "<p class='text-danger text-center'> <b>:( Ocorreu um erro ao efetuar Login.</p><p class='text-danger text-center'>Verifique sua conexão e tente novamente.</b></p>";
				} 
				if ($this->session->flashdata("empty-data-login-senha")) 
				{
					echo "<p class='text-warning text-center'> <b>!O campo Login ou Senha está vazio!</p><p class='text-warning text-center'>!Verifique e tente novamente!</b></p>";
				} 
				?>
			</div>
		</div>

<section class="container" id="blog" style="margin-top: -10%;">
	<header class="content">
		<h2 class="heading">
			<span></span>
			BLOG
		</h2>
	</header>
	<div class="content">
		<div id="posts">
			<div class="posts__item clearfix">
				<img src="<?=base_url('images/bg-post.png') ?>" class="img-responsive" alt="Título da Postagem" title="Título da Postagem">
				<h2>Título da Postagem</h2>
				<p>
					Santos e Palmeiras vão decidir em casa seus duelos nas semifinais da Copa do Brasil. A CBF sorteou na tarde desta segunda-feira, em sua sede no Rio de Janeiro, os mandos de campo para as semifinais da competição. O São Paulo abre em casa o duelo com o Santos, e o Fluminense recebe o Palmeiras no Maracanã. Os dois jogos de ida estão marcados para o dia 21 de outubro, às 22h. As partidas de volta serão no dia 28, no mesmo horário, com mandos de Santos e Palmeiras.
				</p>
			</div>
		</div>
	</div>	
</section>


		<div class="row" style ="margin-bottom: 30px;">
			<div class="col-sm-5">
				<?=form_open("authentication/register_company") ?>
				<button class="btn btn-block btn-primary cadastrar" id="register-btn">CADASTRAR MINHA EMPRESA</button>
				<?=form_close() ?>
			</div>
			<!--
			<?=form_open("authentication/register_user") ?>
			<div class="col-sm-5 col-sm-offset-2">
				<button class="btn btn-block btn-default" id="login-modal-btn">NÃO SOU CADASTRADO</button>
			</div>
			<?=form_close() ?>
		-->
		</div>
		
	</div>
</body>
</html>


