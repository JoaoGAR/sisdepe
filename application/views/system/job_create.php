<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISDEPE - Criar Tarefa</title>
	<link rel="stylesheet" href="<?=base_url("css/bootstrap.css");?>">
	<link rel="stylesheet" href="<?=base_url("css/main.css");?>">
	<script src="<?=base_url("js/jquery.min.js");?>"></script>
	<script src="<?=base_url("js/bootstrap.min.js");?>"></script>
</head>
<body>
	<?php $this->load->view("shared/navbar") ?>
	<div class="container">
		<div>
			<?php 
			if ($this->session->flashdata("job-creation-error"))
			{
				?>
				<p class="text-danger col-md-offset-2"><span class="glyphicon glyphicon-exclamation-sign"></span> Ocorreu um erro ao criar tarefa, tente novamente.</p>
				<?php 
			}
			if ($this->session->flashdata("job-created"))
			{
				?>
				<p class="text-success col-md-offset-2"><span class="glyphicon glyphicon-exclamation-sign"></span> Tarefa cadastrada com sucesso.</p>
				<?php 
			}
			?>
		</div>

		<?=form_open("job/create_job") ?>
		<div class="col-sm-6 col-sm-offset-3" id="first-step">
			<div class="form-group">
				<label for="job_name">Nome da Tarefa:</label>
				<input type="text" class="form-control" name="job_name" placeholder="Entre com o nome da tarefa" value="<?=set_value('job_name') ?>">
				<?=form_error('job_name'); ?>
			</div>

			<div class="text-center" style="margin-top:10px">
				<label>Essa tarefa será destinada à:</label>
			</div>
			<div class="form-group">
				<label>Grupos</label>
				<button type="button" class="btn btn-default btn-xs" id="show-groups">esconder</button>
				<div class="well" id="div-groups">
					<?php 
					foreach ($groups as $group) 
					{
						?>
						<div class="checkbox">
							<label><input class="input_chkbox" name="jop_destiny_id" type="radio" value="<?=$group['group_id']?>,job_group_id"><?=$group['group_name'] ?></label>
						</div>
						<?php 
					}
					?>
				</div>
			</div>
			
			<div class="form-group">
				<label>Funcionários</label>
				<button type="button" class="btn btn-default btn-xs" id="show-users">mostrar</button>
				<div class="well" style="display:none" id="div-users">
					<?php 
					foreach ($users as $user) 
					{
						?>
						<div class="checkbox">
							<label><input class="input_chkbox" name="jop_destiny_id" type="radio" value="<?=$user['user_id']?>,job_user_id"><?=$user['user_name'] ?></label>
						</div>
						<?php 
					}
					?>
				</div>
			</div>
			<label>Informe a importância da tarefa:</label>
			<input id="job_importance" name="job_importance" type="hidden">
			<div style="margin-bottom:10px;">
				<span id="star1" class="glyphicon glyphicon-star stars" valor="1"></span>
				<span id="star2" class="glyphicon glyphicon-star stars" valor="2"></span>
				<span id="star3" class="glyphicon glyphicon-star stars" valor="3"></span>
				<span id="star4" class="glyphicon glyphicon-star stars" valor="4"></span>
				<span id="star5" class="glyphicon glyphicon-star stars" valor="5"></span>	
			</div>

			<div>
				<button type="button" id="next-step" class="btn btn-block btn-primary">PRÓXIMO PASSO</button>
			</div>
		</div>

		<div class="col-sm-6 col-sm-offset-3" id="second-step">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="job_description">Descrição da Tarefa:</label>
					</div>
					<div class="col-sm-6">
						<button style ="margin-bottom: 10%;"type="button" id="rollBack-step" class="btn btn-block btn-primary pull-right">VOLTAR</button>
					</div>
				</div>
				<textarea id="job_textarea" rows="10" type="text" class="form-control" name="job_description" placeholder="Entre com a descricao da tarefa" value="<?=set_value('job_description') ?>"></textarea>
				<?=form_error('job_description'); ?>
			</div>

			<div class="form-group">
				<label for="job_end_date">Data limite da Tarefa:</label>
				<input type="date" class="form-control" name="job_end_date" placeholder="Entre com a data limite da tarefa" value="<?=set_value('job_end_date') ?>">
				<?=form_error('job_end_date'); ?>
			</div>

			<div class="form-group">
				<label for="job_file">Selecione arquivos para upload (se necessário):</label>
				<input type="file" accept=".xlsx,.xls,.doc,.docx.,.ppt,.pptx,.txt,.pdf" class="form-control" name="job_file" placeholder="Entre com a data limite da tarefa" value="<?=set_value('job_file') ?>">
				<?=form_error('job_file'); ?>
			</div>

			<div>
				<button type="submit" class="btn btn-block btn-primary">CRIAR TAREFA</button>
			</div>
		</div>
		<?=form_close() ?>

	</div>
	<script type="text/javascript">
	$('#show-groups').on('click' ,function(e){
		$('#div-groups').slideToggle();
		if($(this).text() == 'mostrar'){
			$(this).text('esconder');
		}
		else {
			$(this).text('mostrar');
		}
	})

	$('#show-users').on('click' ,function(e){
		$('#div-users').slideToggle();
		if($(this).text() == 'mostrar'){
			$(this).text('esconder');
		}
		else {
			$(this).text('mostrar');
		}
	})

	$('#next-step').on('click', function(e){
		$('#first-step').slideToggle();
		$('#second-step').slideToggle();
	})

	$('#rollBack-step').on('click', function(e){
		$('#first-step').slideToggle();
		$('#second-step').slideToggle();
	})

	$(".stars").on('click', function(e){
		if ($(this).css("color") == "rgb(255, 165, 0)") {
			$(this).nextAll().css("color", "grey");
			$(this).css("color", "orange");
			$("#job_importance").val($(this).attr('valor'));
			//rgb(128,128,128);
		} 
		else {
			$(this).prevAll().css("color", "orange");
			$(this).css("color", "orange");
			$("#job_importance").val($(this).attr('valor'));
		};
	})
	</script>
</body>