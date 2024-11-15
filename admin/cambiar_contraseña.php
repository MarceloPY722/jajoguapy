<?php include 'include/sess.php'; ?>
<?php include 'include/connexion.php'; ?>
<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
    } else {
        $req = $bd->prepare("UPDATE usuarios SET contrasena = ? WHERE correo = ?");
        $req->execute([$password, $email]);
        echo "<script>alert('Tu contraseña ha sido restablecida con éxito. Por favor, inicia sesión.');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    }
}
?>
<?php include 'include/header2.php'; ?>

<style>
    .ic {
        font-size: 2.3em; 
        color: #fff; 
        margin: 20px;
        position: absolute;
        top: 0px;
        z-index: 1000;
        right: 0px;
    }
</style>

<div class="login-container">
    <a class="ic" href="/Jajoguapy/">
        <i class="entypo-cancel"></i>
    </a>
    <div class="login-header login-caret">
        <div class="login-content">
            <a href="" class="logo">
                <img src="/jajoguapy/assets/logoW2.png" />
            </a>
        </div>
    </div>
    <div class="login-progressbar">
        <div></div>
    </div>
    <div class="login-form">
        <div class="login-content">
            <div class="form-login-error">
                <h3>Restablecer Contraseña</h3>
                <p>Ingresa tu nueva contraseña.</p>
            </div>
            <form method="post" role="form">
                <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Nueva Contraseña" autocomplete="off" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirmar Contraseña" autocomplete="off" />
                    </div>
                </div>
                <div class="form-group">
                    <button name="submit" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-key"></i>
                        Restablecer Contraseña
                    </button>
                </div>
            </form>
            <div class="login-bottom-links">
                <a href="login.php" class="link">Volver al Inicio de Sesión</a>
                <br />
            </div>
        </div>
    </div>
</div>

<?php include 'include/footer2.php'; ?>