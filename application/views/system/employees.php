<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISDEPE - Funcionários</title>
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
					<th>E-mail</th>
					<th>Data de Inclusão</th>
				</thead>
				<tbody>
					<?php 
					foreach ($users as $user) 
					{
					?>
					<tr>
						<td><?=$user["user_name"] ?></td>
						<td><?=$user["user_email"] ?></td>
						<td><?=$user["user_entry_date"] ?></td>
						<td><a href=""><span class="glyphicon glyphicon-eye-open"></span></a></td>
						<td><a href=""><span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>
					<?php 
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>