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
	<script src="<?=base_url("js/Chart.min.js");?>"></script>

	<script type="text/javascript">
	var randomnb = function(){ return Math.round(Math.random()*300)};
	</script>  
</head>

<body>
	<?php $this->load->view("shared/navbar") ?>
	<div class="container">
		<table class="table" style="max-height:200px;overflow-y:scroll;">
			<thead>
				<th>Tarefa</th>
				<th>Avaliador</th>
				<th class='text-center'>Avaliada em</th>
				<th class='text-center'>Desempenho</th>
				<th class='text-center'>Importância</th>
			</thead>
			<tbody>
				<?php 
				foreach ($evaluations as $evaluation) 
				{
					?>
					<tr>
						<td><?=$evaluation["job_id"] ?></td>
						<td><?=$evaluation["leader_id"] ?></td>
						<td class='text-center'><?=$evaluation["evaluation_end_date"] ?></td>
						<td class='text-center'>
							<?php  
							for($i = 0; $i < $evaluation["user_rate"]; $i++)
							{
								echo "<span class='glyphicon glyphicon-star stars' style='color:orange;font-size:15px'></span>";
							}
							?>
						</td>
						<td class='text-center'>
							<?php  
							for($i = 0; $i < $evaluation["job_importance"]; $i++)
							{
								echo "<span class='glyphicon glyphicon-star stars' style='color:#34a2fd;font-size:15px'></span>";
							}
							?>
						</td>
					</tr>
					<?php 
				}
				?>
			</tbody>
		</table>

		<div class="my_stats">
			<div class="box">
				<div class="box-chart">
					<canvas id="GraficoDonut" style="width:100%;"></canvas>

					<script type="text/javascript">
					var options = {
						responsive:true                    
					};

					var data = [
					{
						value: 0,
						color:"#F7464A",
						highlight: "#FF5A5E",
						label: "Tarefas Expiradas"
					},
					{
						value: 1,
						color: "#46BFBD",
						highlight: "#5AD3D1",
						label: "Tarefas Concluídas"
					},
					{
						value: 2,
						color: "#FDB45C",
						highlight: "#FFC870",
						label: "Tarefas Disponíveis"
					}
					]

					window.onload = function(){

						var ctx = document.getElementById("GraficoDonut").getContext("2d");
						var PizzaChart = new Chart(ctx).Doughnut(data, options);
					}  
					</script>           
				</div>
			</div>
		</div>

	</div>
</body>
</html>