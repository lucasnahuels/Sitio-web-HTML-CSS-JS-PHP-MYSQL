<!DOCTYPE html>
<html>
<head>
	<title>Lista baja prof</title>
	<style type="text/css">
		body{
			background: url('../html/Crossfit-Wallpaper.jpg');
			text-align: center;
		}
		h3{
			background: black;
			color: white;
			font-size: 22px;
		}

		table{
			margin-left: auto;
			margin-right:auto;
		}
		td{
			background: white;
			color: black;
			font-weight: bold;
			font-size: 18px;
		}
		th{
			background: black;
			color: white;
			font-weight: bold;
			font-size: 18px;
		}

		a{

		}
	</style>
</head>

<body>
<h3>Seleccione su C.U.I.T.</h3>

	<table>
		<tr><th> Nombre </th> <th> Apellido </th> <th> Cuit </th><th>  </th> </tr>
		<?php foreach($this->profesores as $p){ ?>
				<tr>
				 	
					<td><?= $p['nombre'] ?></td>
					<td><?= $p['apellido'] ?></td>
					<td><?= $p['cuit_profesor'] ?></td>
					<td><a href="bajarprofesor2.php?cuit=<?= $p['cuit_profesor'] ?>">Eliminar</a></td> <?php//No es necesario encerrar esta variable entre porque esto no es una consulta ?>
			   	 
				</tr>
		<?php } ?>
	</table>


</body>
</html>