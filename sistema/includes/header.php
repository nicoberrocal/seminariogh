<?php 
	
	if(empty($_SESSION['active']))
	{
		header('location: ../');
	}
 ?>
	<header>
		<div class="header">
			<ul>
				<li><a href="index.php" style="color:white"><i class="fas fa-home"></i> Inicio</a></li>
			</ul>
			<div class="optionsBar">
				<p>Argentina, <?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['user'].' -'.$_SESSION['rol']; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
	<?php include "nav.php"; ?>
	</header>
	<div class="modal">
		<div class="bodyModal">
		</div>

	</div>

	