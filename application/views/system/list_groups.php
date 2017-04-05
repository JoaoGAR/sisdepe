<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISDEPE - Times</title>
	<link rel="stylesheet" href="<?=base_url("css/bootstrap.css");?>">
	<link rel="stylesheet" href="<?=base_url("css/main.css");?>">
	<script src="<?=base_url("js/jquery.min.js");?>"></script>
	<script src="<?=base_url("js/bootstrap.min.js");?>"></script>
</head>
<body>
	<?php $this->load->view("shared/navbar") ?>
	<div class="container">
		<div class="employess-table">
			<table class="table table-hover">
				<thead>
					<th>Nome</th>
					<th>Líder</th>
					<th>Data de criação</th>
				</thead>
				<tbody>
					<?php 
					foreach ($groups as $group) 
					{
						?>
						<tr>
							<td><?=$group["group_name"] ?></td>
							<td><?=$group["group_leader"] ?></td>
							<td><?=$group["group_creation_date"] ?></td>
							<td><button team-id="<?=$group['group_id'] ?>" type="button" class="btn btn-default view-team-info"><span class="glyphicon glyphicon-eye-open"></span></button></td>
							<td><button class="btn btn-default"><span class="glyphicon glyphicon-trash" style="color: red;"></span></button></td>
						</tr>
						<?php 
					}
					?>
				</tbody>
			</table>
		</div>
	</div>


	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="team-info-modal">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="clearfix modal-body">
					<table class="table">
						<tbody id="team-members">
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button id="add-group-member" type="button" class="btn btn-xs btn default"><span class="glyphicon glyphicon-plus"></span></button>
					
					<div class="text-justify well select-members" style="display:none">
					
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	var team_id;
	$('.view-team-info').on('click', function(e){
		$('#team-info-modal').modal('show');
		$("#team-members").html('');
		team_id = $(this).attr('team-id');

		$.ajax({
			url: '<?=base_url("index.php/team/load_team_members?team_id='+team_id+'") ?>',
			dataType: "json", 
			success: function(team_members)
			{ 
				$.each(team_members, function(index, team_member) {
					var html = '<tr><td>'+team_member.user_id+'</td></tr>';

					$("#team-members").append(html);
				})
			}
		});
	})

	$('#add-group-member').on('click', function(e){
		$('.select-members').html('');
		$('.select-members').toggle();

		$.ajax({
			url: '<?=base_url("index.php/user/list_employees_json") ?>',
			dataType: "json", 
			success: function(employess)
			{ 
				$.each(employess, function(index, employe) {

					var html = '<div class="checkbox"><input class="input_chkbox" name="group_members[]" type="checkbox" value="'+employe.user_id+'">'+employe.user_name+'</div>';
					$(".select-members").append(html);
				})
			}
		});
	})
	</script>
</body>