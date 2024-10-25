-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2024 at 06:51 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jajoguapy`
--

-- --------------------------------------------------------

--
-- Table structure for table `abastecimientos`
--

CREATE TABLE `abastecimientos` (
  `id` int NOT NULL,
  `numero` int NOT NULL DEFAULT '0',
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `proveedor_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `abastecimientos_productos`
--

CREATE TABLE `abastecimientos_productos` (
  `id` int NOT NULL,
  `producto_id` int NOT NULL DEFAULT '0',
  `abastecimiento_id` int NOT NULL DEFAULT '0',
  `cantidad` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Celulares'),
(3, 'Media Player'),
(11, 'Smart TV'),
(12, 'Smartwatch'),
(13, 'Notebook');

-- --------------------------------------------------------

--
-- Table structure for table `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ciudades`
--

INSERT INTO `ciudades` (`id`, `nombre`) VALUES
(1, 'Asunción'),
(2, 'Concepción'),
(3, 'San Pedro'),
(4, 'Cordillera'),
(5, 'Guairá'),
(6, 'Caaguazú'),
(7, 'Caazapá'),
(8, 'Itapúa'),
(9, 'Misiones'),
(10, 'Paraguarí'),
(11, 'Alto Paraná'),
(12, 'Central'),
(13, 'Ñeembucú'),
(14, 'Amambay'),
(15, 'Canindeyú'),
(16, 'Presidente Hayes'),
(17, 'Boquerón'),
(18, 'Alto Paraguay');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int NOT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `usuario_id`) VALUES
(46, '2024-10-18', 49);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int NOT NULL,
  `producto_id` int NOT NULL DEFAULT '0',
  `pedido_id` int NOT NULL DEFAULT '0',
  `cantidad` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `precio_compra` float NOT NULL DEFAULT '0',
  `precio_venta` float NOT NULL DEFAULT '0',
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `cantidad_stock` int DEFAULT NULL,
  `detalles` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio_compra`, `precio_venta`, `imagen`, `cantidad_stock`, `detalles`, `categoria_id`) VALUES
(15, 'Xiaomi Mi Tv Stick - Negro', 250000, 325000, 'xiaomi_tv_1_1.jpg', 0, 'Media Player Xiaomi viene con un control remoto activado por voz, perfecto para jugar juegos casuales y encontrar tus programas favoritos. También le permite escuchar la radio, ver una película, reproducir canciones de Google Play música, jugar juegos y acceder a las aplicaciones de su dispositivo Android directamente en su televisor, cuenta con conexiones Wi-fi, HDM, USB y Bluetooth.', 3),
(19, 'Iphone 12 256 GB', 2000000, 2500000, 'phone1.png', 33, 'El iPhone 12 de Apple, lanzado en octubre de 2020, se presenta como una evolución significativa en la gama de smartphones de la compañía, destacando por su renovado diseño y mejoras en varias características. Este modelo, que se espera tenga un amplio mercado potencial, incluye cambios notables en su diseño y una doble cámara que, aunque conservadora, plantea interrogantes sobre su suficiencia frente a modelos anteriores y competidores.\r\n\r\nEl dispositivo cuenta con una pantalla OLED Retina de 6,1 pulgadas, con resolución de 2532 x 1170 píxeles y una densidad de 460 ppi, ofreciendo una experiencia visual de alta calidad. Está impulsado por el procesador Apple A14 Bionic y opera con iOS 14. En términos de almacenamiento, ofrece versiones de 64 GB, 128 GB y 256 GB. La cámara principal de 12MP y la secundaria gran angular de 12MP, junto con capacidades de grabación de video en 4K Dolby Vision, componen un sistema de cámara versátil.\r\n\r\nEl diseño del iPhone 12 retoma los bordes rectos, reminiscentes del iPhone 5, proporcionando una experiencia de uso diferente y un agarre más cómodo. A pesar de la familiaridad de sus bordes curvados en modelos anteriores y en la competencia, el nuevo diseño ha sido bien recibido. La resistencia al agua IP68 y la inclusión de la carga rápida de 18W e inalámbrica MagSafe de 15W son otras características destacadas.\r\n\r\nLa pantalla OLED es una mejora significativa respecto al modelo anterior, con soporte para HDR 10 y una satisfactoria visibilidad tanto en interiores como en exteriores. Sin embargo, la falta de una tasa de refresco superior a 60 Hz es una omisión notable, especialmente en comparación con la competencia. A pesar de ello, el panel está bien calibrado de fábrica, aunque carece de amplias posibilidades de personalización.\r\n\r\nEl rendimiento del iPhone 12 es excepcional, manejando con facilidad tanto las tareas cotidianas como las más exigentes. Su capacidad de procesamiento y la fluidez en el uso diario son puntos fuertes, respaldados por buenos resultados en benchmarks. La llegada del 5G es una adición importante, aunque su utilidad dependerá de la cobertura y el operador.\r\n\r\nEl sistema operativo iOS 14 ofrece estabilidad y algunas novedades como los widgets y una nueva forma de organizar aplicaciones, aunque las posibilidades de personalización siguen siendo limitadas. La autonomía del iPhone 12, aunque suficiente para un día de uso intensivo, no representa un salto significativo respecto a modelos anteriores. La decisión de Apple de no incluir un cargador en la caja ha sido controversial, generando debate sobre el impacto ambiental y la conveniencia para el usuario.', 1),
(20, 'iPhone 15 Pro Max', 9000000, 9990000, 'iphone-15-pro-max-removebg.png', 15, '¡YA DISPONIBLE!\r\n\r\nDiseño ligero y resistente de titanio\r\n\r\nEl iPhone 15 Pro Max es el primer iPhone con diseño de titanio de calidad aeroespacial. De hecho, está fabricado con la misma aleación que se usan las naves espaciales en las misiones a Marte de la NASA. El titanio es de los metales con mejor relación resistencia-peso, lo que convierte al iPhone 15 Pro en el modelo Pro más ligero hasta la fecha.\r\n\r\nDynamic Island\r\n\r\nLa Dynamic Island del iPhone 15 Pro Max te muestra alertas y actividades en tiempo real para que no se te pase nada mientras estás a lo tuyo. Podrás ver por dónde va el taxi que has pedido, echar un ojo al temporizador o ver controlar la música que estás escuchando.\r\n\r\nPantalla siempre activa\r\n\r\nCon la pantalla siempre activa del iPhone 15 Pro Max, tendrás la información más importante visible en todo momento. Una mirada rápida verás la hora, tus Widgets, las notificaciones e incluso tu fondo de pantalla. Gracias a los algoritmos inteligentes, el iPhone detecta si lo tienes en el bolsillo o lo pones boca abajo, y la pantalla se apaga para ahorrar batería.\r\n\r\nBotón Acción\r\n\r\nEl nuevo botón Acción te da acceso directo a la prestación que más utilices. Configúralo a tu gusto y tira de su magia para hacerte la vida más fácil. Abrir la cámara, iniciar la grabación de una nota de voz, o ejecutar tu atajo favorito.\r\n\r\nConexión USB-C\r\n\r\nEl iPhone 15 Pro Max inaugura la era del USB-C en el iPhone. Así podrás cargar tu Mac o iPad con el mismo cable que usas para el iPhone 15 Pro Max. Dile adiós a esas marañas de cables.', 1),
(21, 'Smart QLED Hisense 55U60H 55\"', 4000000, 4800000, 'smartTv.png', 20, ' •Resolución de la pantalla: 4K Ultra HD (3840x2160p)\r\n •Pantalla: QLED de 55\"\r\n •Interfaz: HDMI, USB, RF, LAN (RJ-45), Jack de 3.5mm \r\n •Conectividad: Wifi y Bluetooth ', 11),
(23, 'Fire TV Stick 3ra Generación 4K', 300000, 394000, 'azjO5opBprzVGv6FOqrNK-transformed.png', 34, 'El Media player Amazon Fire TV Stick 3ra Generación 4K volvió más potente que nunca, con acceso a más de 15.000 juegos, aplicaciones, 300.000 películas diferentes, programas de televisión, videos y más utilizando los servicios de transmisión populares ofrecidos por Amazon Video, Netflix, Crackle, Hulu y otros cuenta con un procesador ultrarrápido, disfrutaras de una experiencia de streaming 4K Ultra HD más completa. Encontrar contenido 4K Ultra HD nunca ha sido tan fácil, solo tienes que pulsar y preguntar a Alexa o buscar recomendaciones en la pantalla de inicio. Tiene más almacenamiento para aplicaciones y juegos que cualquier otro dispositivo multimedia en streaming. Además, incluye el mando por voz Alexa para controlar tu TV, barra de sonido y receptor compatibles con los botones específicos para encender el dispositivo, silenciarlo y ajustar el volumen.', 3),
(24, 'Smartwatch Samsung Galaxy Watch7 SM-L300N', 2000000, 2631000, 'reloj_smartwatch_samsung_galaxy_watch7_sm-l300n_40_mm_-_greens_2_1-removebg-preview.png', 30, ' •Potencia para todo el día gracias a su nuevo procesador de 3nm, mayor precisión en tus movimientos con su GPS de doble frecuencia y control total de tu frecuencia cardiaca, entrenamientos y horas de sueño con su avanzado sensor BioActive.\r\n •Además, Galaxy AI te proporcionará información valiosa sobre tu salud a través de Energy Score y Wellness Tips.\r\nDescubre el Galaxy Watch7, ¡tu nuevo compañero de aventuras con inteligencia artificial!', 12),
(25, 'Xiaomi 14 Ultra 5G Dual con Cámara Leica', 9000000, 10000000, '908827_1-removebg-preview.png', 12, 'Sumérgete en una experiencia visual impresionante con el Xiaomi 14 Ultra 5G Dual. Con una pantalla LTPO AMOLED de 6.73\", disfrutarás de colores vibrantes y detalles nítidos en cada imagen y video, con una resolución de 1440 x 3200p.\r\n\r\nCaptura el mundo que te rodea con una claridad excepcional gracias a su avanzado sistema de cámaras. Equipado con una cuádruple cámara principal de 50MP + 50MP + 50MP + 50MP, el Xiaomi 14 Ultra te permite capturar cada momento con una calidad asombrosa y una profundidad de detalle incomparable. Desde paisajes impresionantes hasta primeros planos detallados, cada foto será una obra maestra. Además, con la cámara frontal de 32MP, tus selfies serán siempre nítidos y listos para compartir en tus redes sociales favoritas.\r\n\r\nCon conectividad 5G, estarás listo para disfrutar de descargas ultrarrápidas, streaming sin interrupciones y juegos en línea fluidos. Además, con un diseño elegante y ergonómico, el Xiaomi 14 Ultra se adapta cómodamente a tu mano y complementa tu estilo de vida activo.', 1),
(26, 'Notebook ASUS Laptop X515MA-BR423W 15.6\"', 2000000, 2250000, 'asus_x515ma-br423w_-_1_1_1-removebg-preview.png', 12, ' •Pantalla: LED de 15.6\" Full HD 1920 x 1080p\r\n •Procesador: Intel Celeron N4020 Dual-Core 1.1 - 2.8 GHz\r\n •Memoria RAM: DDR4 de 4 GB\r\n •Memoria de almacenamiento: SSD M.2 NVMe de 128 GB\r\n •Gráficos: Intel UHD 600\r\n •Sistema operativo: Windows 11 Home', 13),
(27, 'Samsung Galaxy Z Flip4', 3000000, 3500000, '6512619_sd-removebg-preview.png', 20, ' • Almacenamiento disponible para el usuario: El almacenamiento de usuario ocupa menos que el espacio total de memoria debido al almacenamiento del sistema operativo y al software utilizado para operar las funciones del dispositivo. El almacenamiento vigente del usuario variará según el operador y puede cambiar tras la actualización del software.\r\n\r\n • Red: Los anchos de banda que admite el dispositivo pueden variar según la región o el proveedor de servicio.\r\n\r\n • Batería: La vida útil de la batería real varía según el entorno de la red, las funciones y las aplicaciones usadas, la frecuencia de llamadas y mensaje, la cantidad de veces cargadas y muchos otros factores.\r\n\r\n • Tamaño de la pantalla: medido en diagonal, el tamaño de la pantalla principal del Galaxy Z Flip4 es de 6,7\" en el rectángulo completo y de 6,6\" teniendo en cuenta las esquinas redondeadas; el área visible real es menor debido a las esquinas redondeadas y al orificio de la cámara. El tamaño de la pantalla de la cubierta del Galaxy Z Flip4 es de 1,9” en el rectángulo completo y de 1,8” teniendo en cuenta las esquinas redondeadas; el área visible real es más pequeña debido a las esquinas redondeadas.\r\n\r\n • Capacidad de la batería (típica): valor típico probado en condiciones de laboratorio de terceros. El valor típico es el valor promedio estimado considerando la desviación en la capacidad de la batería entre las muestras de batería probadas según el estándar IEC 61960. La capacidad nominal es de 3595 mAh. Estimado contra el perfil de uso de un usuario promedio/típico. Evaluado de forma independiente por Strategy Analytics entre 07/07/2022 y 12/07/2022 en EE. UU. con versiones preliminares de SM-F721U con la configuración predeterminada usando redes 5G Sub6 (NO probadas en redes 5G mmWave). La duración real de la batería varía según el entorno de red, las funciones y las aplicaciones utilizadas, la frecuencia de las llamadas y los mensajes, la cantidad de veces que se carga y muchos otros factores. Estimado contra el perfil de uso de un usuario promedio/típico. Evaluado de forma independiente por Strategy Analytics entre 07/07/2022 y 12/07/2022 en EE. UU. con versiones preliminares de SM-F721U con la configuración predeterminada usando redes 5G Sub6 (NO probadas en redes 5G mmWave). La duración real de la batería varía según el entorno de red, las funciones y las aplicaciones utilizadas, la frecuencia de las llamadas y los mensajes, la cantidad de veces que se carga y muchos otros factores.\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `direccion`, `correo`, `telefono`) VALUES
(5, 'Samsung Paraguay', 'Azara c/ Peru', 'sansungpy@gmail.com', '0986554765');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  `imagen` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `correo`, `rol`, `nombre`, `apellido`, `telefono`, `imagen`, `ciudad_id`) VALUES
(40, 'M722', '81dc9bdb52d04dc20036dbd8313ed055', 'marcelo@gmail.com', 'admin', 'BENITEZ RUIZ DIAZ', '', 971355982, 'Screenshot 2024-09-10 084131.png', NULL),
(42, 'M783', '81dc9bdb52d04dc20036dbd8313ed055', 'markbenzar722@gmail.com', 'admin', 'Marcelo', '', 971631956, 'images (2).jpeg', NULL),
(47, 'Jazz', '81dc9bdb52d04dc20036dbd8313ed055', 'jazz@gmail.com', 'cliente', 'jazz', 'jazz', 97533245, '', 1),
(48, 'Diego', '81dc9bdb52d04dc20036dbd8313ed055', 'kifik59112@gosarlar.com', 'cliente', 'diego', '', 988776655, '', 16),
(49, 'Marcelo', '81dc9bdb52d04dc20036dbd8313ed055', 'marceloariel722@gmail.com', 'cliente', 'Marcelo', '', 971631959, 'R.jpeg', 12),
(50, 'M724', NULL, 'marceloariel872@gmail.com', 'admin', 'Mark', 'Benitez', 98666687, '', 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abastecimientos`
--
ALTER TABLE `abastecimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__fournisseurs` (`proveedor_id`);

--
-- Indexes for table `abastecimientos_productos`
--
ALTER TABLE `abastecimientos_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__produits` (`producto_id`),
  ADD KEY `FK__appros` (`abastecimiento_id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK2` (`usuario_id`);

--
-- Indexes for table `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_cmds_prods_produits` (`producto_id`),
  ADD KEY `FK_cmds_prods_commandes` (`pedido_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__categories` (`categoria_id`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_users_ville` (`ciudad_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abastecimientos`
--
ALTER TABLE `abastecimientos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `abastecimientos_productos`
--
ALTER TABLE `abastecimientos_productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abastecimientos`
--
ALTER TABLE `abastecimientos`
  ADD CONSTRAINT `FK__proveedores` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `abastecimientos_productos`
--
ALTER TABLE `abastecimientos_productos`
  ADD CONSTRAINT `FK__abastecimientos` FOREIGN KEY (`abastecimiento_id`) REFERENCES `abastecimientos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK__productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK_pedidos_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD CONSTRAINT `FK_pedidos_productos_pedidos` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pedidos_productos_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK__categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_ciudades` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
