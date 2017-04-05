<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISDEPE - Criar Grupo</title>
	<link rel="stylesheet" href="<?=base_url("css/bootstrap.css");?>">
	<link rel="stylesheet" href="<?=base_url("css/main.css");?>">
	<script src="<?=base_url("js/jquery.min.js");?>"></script>
	<script src="<?=base_url("js/bootstrap.min.js");?>"></script>
</head>
<body>
	<?php $this->load->view("shared/navbar") ?>
	<div class="container">

		<div class="msgs">
		</div>
		
		<?=form_open("team/create_group");?>
		<div class="col-sm-6 col-sm-offset-3">
			<div class="form-group">
				<label for="group_name">Nome da Equipe:</label>
				<input type="text" class="form-control" name="group_name" placeholder="Digite o nome da Equipe" value="<?=set_value('group_name') ?>">
				<?=form_error('group_name'); ?>
			</div>

			<div class="form-group">
				<label for="group_leader">Selecione o líder da Equipe:</label>
				<select class="form-control" name="group_leader" id="group_leader" placeholder="Selecione um líder para a equipe...">
					<option value="" disabled selected hidden>Selecione um líder para a equipe...</option>
					<?php 
					foreach ($users as $employee) {
						?>
						<option value="<?=$employee['user_id']?>"><?=$employee['user_name'] ?></option>
						<?php 
					}
					?>
				</select>
				<?=form_error('group_name'); ?>
			</div>

			<div class="form-group">
				<label for="group_name">Selecione os funcionários pertencentes à Equipe:</label>

				<?php 
				foreach ($users as $employee) 
				{
					?>
					<div class="checkbox">
						<label><input class="input_chkbox" name="group_members[]" type="checkbox" value="<?=$employee['user_id']?>"><?=$employee['user_name'] ?></label>
					</div>
					<?php 
				}
				?>
			</div>
			<button class="btn btn-block btn-primary">CRIAR</button>
		</div>
		<?=form_close() ?>
	</div>
	<script type="text/javascript">
	$('#group_leader').on('change', function(e){
		var valorSelect = $('#group_leader option:selected').val();
		var valorChbox;
		$('.input_chkbox').removeAttr('disabled');

		for(var i = 0; i < $('.input_chkbox').length; i++){
			valorChbox = $('.input_chkbox')[i];
			if(valorSelect == valorChbox.value){
				$(valorChbox).attr('disabled','disabled');
				$(valorChbox).attr('checked', false);
			}
		}
	})

	</script>
</body>