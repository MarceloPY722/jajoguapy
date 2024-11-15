<?php include './include/head.php'; ?>
<?php include './include/cnx.php'; ?>
<?php include './include/menu.php'; ?>
 <title>Métodos de Pago</title>
  
<div class="payment-container">
    <img src="/Jajoguapy/assets/pay.png" alt="Métodos de pago">
    <h2>Métodos de Pago Disponibles</h2>
    <p>En nuestra tienda, aceptamos una variedad de métodos de pago para tu comodidad y seguridad. Puedes realizar tus compras con Visa, MasterCard, Discover, y American Express. Todos tus pagos están asegurados y encriptados para proteger tu información.</p>
</div>


<style>
 
 .payment-container {
     display: flex;
     justify-content: center;
     align-items: center;
     min-height: 80vh; 
     flex-direction: column;
     text-align: center;
 }

 .payment-container img {
     max-width: 100%; 
     height: auto;
 }

 .payment-container h2 {
     margin-top: 20px;
     font-size: 24px;
     color: #333;
 }

 .payment-container p {
     max-width: 600px;
     color: #555;
 }
</style>

<?php include './include/footerfinal.php'; ?>