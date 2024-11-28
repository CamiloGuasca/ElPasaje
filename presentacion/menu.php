
<nav class="navbar navbar-expand-lg bg-body-tertiary">
	<div class="container">
		<a class="navbar-brand" href="#"><img src="img/logo2.png" width="50" /></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
			data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false">Marca</a>
					<ul class="dropdown-menu">
                            <?php
                            ?>
						</ul></li>
			</ul>
			<ul class="navbar-nav me-auto">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false">Categoria</a>
					<ul class="dropdown-menu">
                            <?php
                            ?>
						</ul></li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item"><a href="?pid=<?php echo base64_encode("presentacion/iniciarSesion.php") ?>" class="nav-link"
					aria-disabled="true">Iniciar Sesion</a></li>
			</ul>
		</div>
	</div>
</nav>
