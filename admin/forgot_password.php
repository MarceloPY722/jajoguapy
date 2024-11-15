<?php include 'include/sess.php'; ?>
<?php include 'include/connexion.php'; ?>
<?php
$message = '';
$email = '';
$show_mascota_form = false;

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $req = $bd->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $req->execute([$email]);
    $user = $req->fetch();

    if ($user) {
        $message = '<span style="color: green;">Correo encontrado</span>';
        $show_mascota_form = true;
    } else {
        $message = '<span style="color: red;">No se encontró ninguna cuenta asociada a este correo electrónico.</span>';
    }
}

if (isset($_POST['submit_mascota'])) {
    $email = $_POST['email'];
    $nombre_mascota = $_POST['nombre_mascota'];
    $req = $bd->prepare("SELECT * FROM usuarios WHERE correo = ? AND nombre_mascota = ?");
    $req->execute([$email, $nombre_mascota]);
    $user = $req->fetch();

    if ($user) {
        header('Location: cambiar_contraseña.php?email=' . urlencode($email));
    } else {
        $message = '<span style="color: red;">Nombre de mascota incorrecto.</span>';
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
                <h3>Recuperación de Contraseña</h3>
                <p>Ingresa tu correo electrónico para restablecer tu contraseña.</p>
                <?php if (!empty($message)): ?>
                    <div class="message"><?php echo $message; ?></div>
                <?php endif; ?>
            </div>
            <form method="post" role="form">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-mail"></i>
                        </div>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Correo Electrónico" autocomplete="off" value="<?php echo htmlspecialchars($email); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <button name="submit" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-key"></i>
                        Verificar Correo
                    </button>
                </div>
            </form>
            <?php if ($show_mascota_form): ?>
            <div id="nombre_mascota_section">
                <form method="post" role="form">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-paw"></i>
                            </div>
                            <input type="text" class="form-control" name="nombre_mascota" id="nombre_mascota" placeholder="Nombre de su primera mascota" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <button name="submit_mascota" class="btn btn-primary btn-block btn-login">
                            <i class="entypo-key"></i>
                            Verificar Nombre de Mascota
                        </button>
                    </div>
                </form>
            </div>
            <?php endif; ?>
            <div class="login-bottom-links">
                <a href="login.php" class="link">Volver al Inicio de Sesión</a>
                <br />
            </div>
        </div>
    </div>
</div>

<?php include 'include/footer2.php'; ?>