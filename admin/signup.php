<?php include 'include/sess.php'; ?>
<?php include 'include/connexion.php' ?>
<?php 
if(isset($_POST['submit'])){
	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$contraseña = md5($_POST['contraseña']);
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$telefono = $_POST['telefono'];
	$imagen = basename($_FILES['imagen']['name']);
  $path = 'img/'.$imagen;
  $file = $_FILES['imagen']['tmp_name'];
  move_uploaded_file($file,$path);
	$ciudad = $_POST['ciudad'];
	$req = $bd->prepare("insert into usuarios(usuario, contraseña, email, rol, nombre, apellido, telefono, imagen, ciudad_id) values(?,?,?,?,?,?,?,?,?)");
	$req->execute([$usuario, $contraseña, $email, "cliente", $nombre, $apellido, $telefono, $imagen, $ciudad]);
	header('location: /Jajoguapyv2/admin/login.php');
}
?>
<?php include 'include/header2.php'; ?>

<style>
	.ic{
		font-size: 2.3em; 
		color:#fff; 
		margin:20px;
		position: absolute;
    top: 0px;
    z-index: 1000;
    right: 0px;
	}
</style>

<script type="text/javascript">
var baseurl = '';

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('form').addEventListener('submit', function(event) {
        var usuario = document.getElementById('usuario').value;
        var email = document.getElementById('email').value;
        var contraseña = document.getElementById('contraseña').value;
        var nombre = document.getElementById('nombre').value;
        var apellido = document.getElementById('apellido').value;
        var telefono = document.getElementById('telefono').value;
        var ciudad = document.getElementById('ciudad').value;
        var imagen = document.getElementById('imagen').value;

        if (usuario.trim() === '' || email.trim() === '' || contraseña.trim() === '' || nombre.trim() === '' || apellido.trim() === '' || telefono.trim() === '' || ciudad.trim() === '' || imagen.trim() === '') {
            event.preventDefault();
            alert('Todos los campos son obligatorios');
        }
    });
});
</script>

<div class="login-container">
<a class="ic" href="/Jajoguapyv2/">
          <i class="entypo-cancel"></i>
         </a>
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="" class="logo">
				<img src="/Jajoguapyv2/assets/logoW.png" width="300" alt="" />
			</a>
		
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<div class="form-login-error">
				<h3>Inicio de Sesion Fallido</h3>
				
			</div>
			
			<form method="post" enctype="multipart/form-data">
				   
			<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						<input required type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" autocomplete="off" />
					</div>
					
				</div>
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apodo" autocomplete="off" />
					</div>
					
				</div>

				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-phone"></i>
						</div>
						
						<input type="number" class="form-control" name="telefono" id="telefono"  placeholder="Numero de Celular" autocomplete="off" />
					</div>
					
				</div>
       
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-list"></i>
						</div>
						<select name="ciudad" id="ciudad" class="form-control" placeholder="Ciudad" aria-describedby="ciudad">
                <?php $qer=$bd->query("select * from ciudades");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id']?>"><?= $dt['nombre']?></option>
                <?php endwhile;?>
              </select>
					</div>
					
				</div>
			<!--  -->
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" autocomplete="off" />
					</div>
					
				</div>

				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-gplus-circled"></i>
						</div>
						
						<input type="email" class="form-control" name="email" id="email" placeholder="Correo" autocomplete="off" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña" autocomplete="off" />
					</div>
				
				</div>
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-picture"></i>
						</div>
						<input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" autocomplete="off" />
					</div>
				
				</div>
				<div  class="form-group">
					<button name="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						 <a  href="login.php">Registrate</a>
					</button>
				</div>
				
				<div class="form-group">
					<a href="login.php">Iniciar Sesion</a>
				</div>
				
			</form>
			
			
			<div class="login-bottom-links">
				<a href="extra-forgot-password.html" class="link">Olvidaste tu constraseña?</a>
				<br />
			</div>
		</div>
	</div>
</div>


<style>
	#ciudad option {
    background-color: black;
    color: white;
}

</style>
<?php include 'include/footer2.php'; ?>