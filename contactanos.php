<?php include './include/head.php' ?>
<?php include './include/cnx.php' ?>
<?php include './include/menu.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .contact-container {
            text-align: center;
            padding: 50px;
            background-color: #ffffff;
            max-width: 800px;
            margin: 50px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        .contact-container h1 {
            font-size: 2.5rem;
            color: #333333;
        }
        .contact-container p {
            font-size: 1.2rem;
            color: #666666;
        }
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .social-icons a {
            text-decoration: none;
            color: #ffffff;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .social-icons a.whatsapp { background-color: #25D366; }
        .social-icons a.facebook { background-color: #1877F2; }
        .social-icons a.instagram { background-color: #C13584; }
        .social-icons a.pinterest { background-color: #E60023; }
        .social-icons a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="contact-container">
    <h1>Contáctanos</h1>
    <p>¡Nos encantaría saber de ti! Encuéntranos en nuestras redes sociales.</p>
    <div class="social-icons">
        <a href="https://api.whatsapp.com/send/?phone=595994275953&text&type=phone_number&app_absent=0" target="_blank" class="whatsapp" title="WhatsApp">
            <i class="fa fa-whatsapp"></i>
        </a>
        <a href="https://facebook.com/tu_pagina" target="_blank" class="facebook" title="Facebook">
            <i class="fa fa-facebook"></i>
        </a>
        <a href="https://instagram.com/" target="_blank" class="instagram" title="Instagram">
            <i class="fa fa-instagram"></i>
        </a>
        <a href="https://pinterest.com/" target="_blank" class="pinterest" title="Pinterest">
            <i class="fa fa-pinterest"></i>
        </a>
    </div>
</div>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>

<?php include './include/footerfinal.php'; ?>