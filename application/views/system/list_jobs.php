<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISDEPE - Tarefas</title>
	<link rel="stylesheet" href="<?=base_url("css/bootstrap.css");?>">
	<link rel="stylesheet" href="<?=base_url("css/main.css");?>">
	<script src="<?=base_url("js/jquery.min.js");?>"></script>
	<script src="<?=base_url("js/bootstrap.min.js");?>"></script>
</head>
<body>
	<?php $this->load->view("shared/navbar") ?>
	<span class=""></span>
	<div class="container">
		<div class="jobs-table">
			<table class="table table-hover">
				<thead>
					<th>Nome da Tarefa</th>
					<th class="text-center">Status da tarefa</th>
					<th>Destino da tarefa</th>
					<th>Data de criação</th>
					<th class="text-right">Data de encerramento</th>
				</thead>
				<tbody>
					<?php 
					foreach ($jobs as $job) 
					{
						if ($job['job_status'] == 0) {
							$status = '<span class="glyphicon glyphicon-asterisk"></span>';
						} else if($job['job_status'] == 1) {
							$status = '<span class="glyphicon glyphicon-warning-sign"></span>';
						} else {
							$status = '<span class="glyphicon glyphicon-ok"></span>';
						}

						?>
						<tr>
							<td><?=$job["job_name"] ?></td>
							<td class="text-center"><?=$status ?></td>
							<td title="Aguardando aprovação"><?=$job["job_destiny_id"] ?></td>
							<td><?=$job["job_init_date"] ?></td>
							<td class="text-right"><?=$job["job_end_date"] ?></td>
							<td><a class="btn  btn-default job-info-trigger" job-id="<?=$job["job_id"] ?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>
							<td><a class="btn  btn-default" style="color:red;" href=""><span class="glyphicon glyphicon-trash"></span></a></td>
						</tr>
						<?php 
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" id="job-info-modal">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="text-center" id="job-name"></h4>
				</div>
				<div class="modal-body">
					<div class="clearfix">
						<div class="col-sm-12">
							<label>Tarefa Destinada à:</label>
							<label id="job-user"></label>
						</div>
						<div class="col-sm-8">
							<label>Tarefa concluída em:</label>
							<label id="job-end-date"></label>
						</div>
						<div class="col-sm-4">
							<a href="">Baixar certificado <span class="glyphicon glyphicon-download-alt"></span></a>
						</div>
					</div>
					<h5 class="text-center" id="job-status"></h5>
					<div class="modal-footer">
						<div class="text-center">
							<label>Avalie o desempenho do funcionário:</label>
							<div id="stars-div" style="margin-bottom:10px; display:none;">
								<span id="star1" class="glyphicon glyphicon-star stars" valor="1"></span>
								<span id="star2" class="glyphicon glyphicon-star stars" valor="2"></span>
								<span id="star3" class="glyphicon glyphicon-star stars" valor="3"></span>
								<span id="star4" class="glyphicon glyphicon-star stars" valor="4"></span>
								<span id="star5" class="glyphicon glyphicon-star stars" valor="5"></span>	
							</div>
						</div>
						<button id="conclude-job-button" disabled='disabled' class="btn btn-block btn-default">Confirmar conclusão</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	var employee_rate;
	var job_id;

	$('.job-info-trigger').on('click',function(e){
		$('#conclude-job-button').attr('disabled', true);
		$(".stars").css("color", "grey");
		$('#stars-div').hide();

		job_id = $(this).attr('job-id');
		var job_status;
		$.ajax({
			url: '<?=base_url("index.php/job/view_job?job_id='+job_id+'") ?>',
			dataType: "json", 
			success: function(job)
			{ 
				$('#job-name').text(job.job_name);
				if(job.job_status == 0){
					job_status = "<p class='alert alert-warning'>Tarefa em andamento.</p>";
				}
				else if (job.job_status ==1){
					job_status = "<p class='alert alert-info'>Tarefa Aguardando aprovação.</p>";
					$('#conclude-job-button').attr('disabled', false);
					$('#stars-div').toggle();
				}
				else if (job.job_status== 2){
					job_status = "<p class='alert alert-success'>Tarefa concluída.</p>";
				}

				$('#job-status').html(job_status);
				$('#job-user').text(job.job_user_id.user_name);

				if (job.job_conclude_date != null) 
				{
					$('#job-end-date').text(job.job_conclude_date);
				}
				else
				{
					$('#job-end-date').text("Tarefa ainda não concluída");
				};

				$('#job-info-modal').modal('show');
			}
		});
	})

$(".stars").on('click', function(e){
	if ($(this).css("color") == "rgb(255, 165, 0)") {
		$(this).nextAll().css("color", "grey");
		$(this).css("color", "orange");
		$("#job_importance").val($(this).attr('valor'));
	} 
	else {
		$(this).prevAll().css("color", "orange");
		$(this).css("color", "orange");
		employee_rate = $(this).attr('valor');
	};
})

$('#conclude-job-button').on('click', function(e){
	$.ajax({
		url: '<?=base_url("index.php/job/conclude_job_boss?job_id='+job_id+'&employee_rate='+employee_rate+'") ?>',
		dataType: "json", 
		success: function(job)
		{ 
			location.reload();
		}
	});
})
</script>
</body>