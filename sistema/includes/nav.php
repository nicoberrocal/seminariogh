		<nav>
			<ul>
			<?php 
				if($_SESSION['rol'] == 1){
			 ?>
				<li class="principal">

					<a href="#"><i class="fas fa-users"></i> Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php"><i class="fas fa-user-plus"></i> Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php"><i class="fas fa-users"></i> Lista de Usuarios</a></li>
					</ul>
				</li>
			<?php } ?>
				<li class="principal">
					<a href="#"><i class="fas fa-user"></i> Clientes</a>
					<ul>
						<li><a href="registro_cliente.php"><i class="fas fa-user-plus"></i> Nuevo Cliente</a></li>
						<li><a href="lista_clientes.php"><i class="fas fa-user"></i> Lista de Clientes</a></li>
					</ul>
				</li>
				<?php 
				if($_SESSION['rol'] == 1){
			 ?>
				<li class="principal">
					<a href="#"><i class="fas fa-address-card"></i> Proveedores</a>
					<ul>
						<li><a href="registro_proveedor.php"><i class="fas fa-address-book"></i> Nuevo Proveedor</a></li>
						<li><a href="lista_proveedores.php"><i class="fas fa-address-card"></i> Lista de Proveedores</a></li>
					</ul>
				</li>
				<?php } ?>
				<li class="principal">
					<a href="#"><i class="fab fa-product-hunt"></i> Productos</a>
					<ul>
						<?php 
							if($_SESSION['rol'] == 1){
						?>
						<li><a href="registro_producto.php"><i class="fas fa-plus"></i> Nuevo Producto</a></li>
						<?php } ?>
						<li><a href="lista_productos.php"><i class="fas fa-list"></i> Lista de Productos</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#"><i class="fab fa-adn"></i> Articulos</a>
					<ul>
						<li><a href="registro_articulo.php"><i class="far fa-plus-square"></i> Nuevo Articulo</a></li>
						<li><a href="lista_articulos.php"><i class="fas fa-clipboard-list"></i> Lista de Articulos</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#"><i class="fas fa-money-check"></i> Ventas</a>
					<ul>
						<li><a href="nueva_venta.php"><i class="fas fa-cash-register"></i> Nueva Venta</a></li>
						<li><a href="ventas.php"><i class="fas fa-money-check"></i> Ventas</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#"><i class="fas fa-shopping-bag"></i> Compras</a>
					<ul>
						<li><a href="nueva_compra.php"><i class="fas fa-shopping-cart"></i> Nueva Compra</a></li>
						<li><a href="compras.php"><i class="fas fa-shopping-bag"></i> Compras</a></li>
					</ul>
				</li>
			</ul>
		</nav>