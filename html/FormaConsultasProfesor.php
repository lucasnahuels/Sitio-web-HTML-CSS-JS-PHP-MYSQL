<!DOCTYPE html>
<html> 
<head>
	<title> Consultas de profesor</title>
	<style type="text/css">
		
		body{
			text-align: center;
			background: url('../html/fondogris.jpg');
			background-size: 30%;
		}

		h1{
			color: #D43743;
			font-weight: bold;
			font-size: 40px
		}

		label{
			font-weight: bold ;
		}

		#a{
			background-color: #20B2AA;
			font-weight: bold ;
		}

		.botones{
		font-size:10px;
        font-family:Verdana,Helvetica;
        font-weight:bold;
        color:black;
        background:#efb810;
        border:4px solid black;
        width:250px;
        height:30px;
        display: inline;
        margin-right:35px;
		}

		h4, #noexiste{
			font-weight: bold;
		}

	</style>
</head>

<body>

<a style="position:absolute; top:10px; left:20px ;color:black; font-weight: bold; font-size: 20px; "  href="paginainicio.php"> Volver ←</a>

<a style="position:absolute; top:10px; right:20px ;color:black; font-weight: bold; font-size: 20px; "  href="../Controllers/logoutgym.php"> Cerrar sesión</a>

<h1> ¿Que desea consultar? </h1>

<?php foreach ($this->cuitporusuario as $key => $value) {
	$cuit_preingresado= $value;
} ?>
<form action="" method="post">
	<label for="a">Ingrese su C.U.I.T con el que está inscripto como profesor </label> <input type="text" id="a" name="CuitConsulta" value="<?= $cuit_preingresado ?>" maxlength="20"placeholder="Forma xx-xxxxxxxx-x"><br/><br/><br/>

	<input type="submit" class="botones" name="SubmitActividades" value="Actividades en las que estoy inscripto">
	<input type="submit" class="botones" name="SubmitCronograma" value="Cronograma de clases que dirijo">
	<input type="submit" class="botones" name="SubmitSociosClases" value="Socios inscriptos en las clases que dirijo">
	<input type="submit" class="botones" name="SubmitPlanillaAsistencia" value="Planilla de asistencia a mis clases">

</form>

<br/><br/>
<?php if($this->varSubmitActividades){ ?>
		<h4 style="font-size: 20px;"> Actividades </h4> 
		<?php if(!$this->existeAlgunaActividad) { ?> <p id="noexiste"> No existe ninguna actividad del profesor ingresado</p>
		<?php }
			  if($this->existeAlgunaActividad) { 
					foreach ($this->actividades_inscriptas as $ai) { ?>
						<p> <?= $ai['nombre_actividad'] ?> </p> 
			  <?php }
			  } ?>
<?php } ?>


<?php if($this->varSubmitCronograma){ ?>
		<h4> Cronograma de clases </h4> 

		 <table style="margin-left: auto; margin-right: auto;">
			 	<tr>
			 		<th>Nombre Actividad</th>
			 		<th>Día semana</th>
			 		<th>Fecha</th>
			 		<th>Horario</th>
			 		<th>Nro Sala</th>			 						 		
			 	</tr>
		<?php foreach ($this->ClasesDeProfesor as $cp) { ?>
				 <tr>	
				 	<td><?= $cp['nombre_actividad'] ?></td>
				 	<td><?= $cp['dia_semana'] ?></td>
				 	<td><?= $cp['fecha_clase'] ?></td>
				 	<td><?= $cp['hora'] ?></td>
				 	<td><?= $cp['id_sala'] ?></td>
				</tr>

		<?php } ?>
		</table>

<?php } ?>


<?php if($this->varSubmitSociosClases){ ?>
	<h4> Socios por clase </h4>
		<table style="margin-left: auto; margin-right: auto;">
			 	<tr>
			 		<th>Nombre Actividad</th>
			 		<th>Día semana</th>
			 		<th>Fecha</th>
			 		<th>Horario</th>
			 		<th>Nro Sala</th>
			 		<th>Cantidad de socios inscriptos</th>			 						 					 					 						 		
			 	</tr>
		<?php foreach ($this->SociosClases as $sc) { ?>
				 <tr>	
				 	<td><?= $sc['nombre_actividad'] ?></td>
				 	<td><?= $sc['dia_semana'] ?></td>
				 	<td><?= $sc['fecha_clase'] ?></td>
				 	<td><?= $sc['hora'] ?></td>
				 	<td><?= $sc['id_sala'] ?></td>
				 	<td><?= $sc['cantidad_socios'] ?></td>				 	
				</tr>

		<?php } ?>
		</table>
<?php } ?>


<?php if($this->varSubmitPlanillaAsistencia){ ?>
	<h4> Planilla de asistencia </h4> 
	<table style="margin-left: auto; margin-right: auto;">
			 	<tr>	
			 		<th>Fecha</th>
			 		<th>Horario</th>		 						 					 					 						 		
			 	</tr>
			 	
		<?php foreach ($this->PlanillaAsistencia as $pa) { ?>
				 <tr>	
				 	<td><?= $pa['fecha'] ?></td>
				 	<td><?= $pa['hora'] ?></td>			 	
				</tr>

		<?php } ?>
		</table>
<?php } ?>

</body>

</html>