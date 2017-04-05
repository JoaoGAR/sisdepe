<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISDEPE - Feed</title>
	<link rel="stylesheet" href="<?=base_url("css/bootstrap.css");?>">
	<link rel="stylesheet" href="<?=base_url("css/main.css");?>">
	<script src="<?=base_url("js/jquery.min.js");?>"></script>
	<script src="<?=base_url("js/bootstrap.min.js");?>"></script>
</head>
<style type="text/css">
body, html {
	height: 100%;
	width: 100%;
}
</style>
<body>
	<?php $this->load->view("shared/navbar") ?>
	<div class="vertical-nav col-sm-2">

		<div class="nav-feed global_feed">
			<a href="../evaluation/view_evaluation"><h1 style="font-size:15px; line-height: 40px; margin:0; margin-top: 40px; margin-left: 15px;padding:0;">Minhas Estatisticas</h1></a>
		</div>

		<div class="nav-feed individual_feed">
			<a href="../user/load_feed"><h1 style="font-size:15px; line-height: 40px; margin:0; margin-left: 15px;">Minhas Tarefas</h1></a>
		</div>

		<div class="nav-feed">
			<div class="group_feed">
				<h1 style="cursor:pointer;font-size:15px; line-height: 40px; margin:0; margin-left: 15px; color:#fff;">Meus Grupos</h1 >
			</div>
			<div class="my_groups" style="display:none">

			</div>
		</div>
	</div>


	<div class="col-sm-9 container feed">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Pesquisar tarefa específica..">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search pesquisar"></span></button>
			</span>
		</div>
		<hr>
		<div id="jobs-container">
			<?php foreach ($jobs as $job) 
			{
				if ($job['job_status'] == 0) {
					$status = '<span class="glyphicon glyphicon-asterisk">';
				} else if($job['job_status'] == 1) {
					$status = '<span class="glyphicon glyphicon-warning-sign">';
				} else {
					$status = '<span class="glyphicon glyphicon-ok">';
				}

				?>
				<div class="job well clearfix" jobId="<?=$job['job_id'] ?>">
					<div class="col-sm-9">
						<h1 id="job_name"><?=$job['job_name']." ".$status ?></h1>
						<label>Tarefa criada em:</label>
						<p id="job_init_date"><?=$job['job_init_date'] ?></p>
						<label>Data Limite para realização da tarefa:</label>
						<p id="job_end_date"><?=$job['job_end_date'] ?></p>
					</div>
					<div class="col-sm-3">
						<span class="glyphicon glyphicon-download-alt"></span>
					</div>
				</div>
				<?php
			} 
			?>
		</div>
		<div class="col-sm-12">
			<div class="col-sm-4">
				<div id="view-job-back" style="display:none">
					<a href="../user/load_feed" type="button" class="btn btn-default btn-block">Voltar</a>
				</div>
			</div>

			<div type="button" class="col-sm-4 col-sm-offset-4" style="display:none">
				<button type="button" id="conclude-job-buttom" class="btn btn-primary btn-block" job-id="0">CONCLUIR TAREFA</button>
			</div>
		</div>
	</div>


	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="job-conclude-modal">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="clearfix modal-body">
					<h4 class="text-center" id="job_title"></h4>
					<hr>
					<div class="col-sm-12">
						<?=form_open("job/conclude_job") ?>
						<input class="form-control" type="file">
						<input name="job_id" id="job-id" style="display:none">
						<hr>
						<button class="btn btn-default btn-block">Concluir</button>
						<?=form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
	$('.group_feed').on('click', function(e){
		$(".my_groups").html('');
		$(".my_groups").toggle();

		$.ajax({
			url: '<?=base_url("index.php/team/load_groups") ?>',
			dataType: "json", 
			success: function(teams)
			{ 
				$.each(teams, function(index, team) {
					var html = '<div class="my_group">';
					html += '<a href="../job/load_group_jobs?team_id='+team.group_id+'"><p>'+team.group_name+'</p></a></div>';


					$(".my_groups").append(html);
				})
			}
		});
	})

	$('.job').on('click', function(e){
		var job_id = $(this).attr('jobId');
		var status;
		$("#jobs-container").html('');
		$.ajax({
			url: '<?=base_url("index.php/job/view_job?job_id='+job_id+'") ?>',
			dataType: "json", 
			success: function(job)
			{ 

				if (job.job_status == 0) {
					status = '<span class="glyphicon glyphicon-asterisk">';
				} else if(job.job_status == 1) {
					status = '<span class="glyphicon glyphicon-warning-sign">';
				} else {
					status = '<span class="glyphicon glyphicon-ok">';
				}

				var html = '<div class="clearfix well">';
				html += '<h3 class="text-center">'+job.job_name+" "+status+'</span></h3>';
				html += '<div class="text-right"><label>Tarefa Disponibilizada por:</label><p>'+job.job_owner.user_name+'</p></div>';
				html += '<div class="text-justify"><label>Descrição da Tarefa:</label><p>'+job.job_description+'</p></div>';
				html += '<div class="col-sm-10 col-sm-offset-1"><div class="col-sm-5"><label>Tarefa Disponibilizada em:</label><p>'+job.job_init_date+'</p></div>';
				html += '<div class="col-sm-5 text-right pull-right"><label>Tarefa Disponível até:</label><p>'+job.job_end_date+'</p></div>'
				html += '</div>';
				html += '</div>';


				$('#job_title').text(job.job_name);
				$('#conclude-job-buttom').attr('job-id', job.job_id);
				$('#job-id').val(job.job_id);
				$("#jobs-container").append(html);

				$('#view-job-back').toggle();
				$('#conclude-job-buttom').parent().toggle();
			}
		});
})

$('#conclude-job-buttom').on('click', function(e){
	$("#job-conclude-modal").modal('show');
	$('#conclude-job-buttom').attr('job-id');
})
</script>
</body>