-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 28, 2024 at 06:47 PM
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
(13, 'Notebook'),
(14, 'Consolas y Accesorios'),
(15, 'Juegos'),
(16, 'Black Friday');

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
(15, 'Media Player Xiaomi Mi Tv Stick', 250000, 325000, 'xiaomi_tv_1_1.jpg', 0, 'Media Player Xiaomi viene con un control remoto activado por voz, perfecto para jugar juegos casuales y encontrar tus programas favoritos. También le permite escuchar la radio, ver una película, reproducir canciones de Google Play música, jugar juegos y acceder a las aplicaciones de su dispositivo Android directamente en su televisor, cuenta con conexiones Wi-fi, HDM, USB y Bluetooth.', 3),
(19, 'Apple iPhone 12 A2403 LZ/A Rojo', 2000000, 2500000, 'phone1.png', 33, 'El iPhone 12 de Apple, lanzado en octubre de 2020, se presenta como una evolución significativa en la gama de smartphones de la compañía, destacando por su renovado diseño y mejoras en varias características. Este modelo, que se espera tenga un amplio mercado potencial, incluye cambios notables en su diseño y una doble cámara que, aunque conservadora, plantea interrogantes sobre su suficiencia frente a modelos anteriores y competidores.\r\n\r\nEl dispositivo cuenta con una pantalla OLED Retina de 6,1 pulgadas, con resolución de 2532 x 1170 píxeles y una densidad de 460 ppi, ofreciendo una experiencia visual de alta calidad. Está impulsado por el procesador Apple A14 Bionic y opera con iOS 14. En términos de almacenamiento, ofrece versiones de 64 GB, 128 GB y 256 GB. La cámara principal de 12MP y la secundaria gran angular de 12MP, junto con capacidades de grabación de video en 4K Dolby Vision, componen un sistema de cámara versátil.\r\n\r\nEl diseño del iPhone 12 retoma los bordes rectos, reminiscentes del iPhone 5, proporcionando una experiencia de uso diferente y un agarre más cómodo. A pesar de la familiaridad de sus bordes curvados en modelos anteriores y en la competencia, el nuevo diseño ha sido bien recibido. La resistencia al agua IP68 y la inclusión de la carga rápida de 18W e inalámbrica MagSafe de 15W son otras características destacadas.\r\n\r\nLa pantalla OLED es una mejora significativa respecto al modelo anterior, con soporte para HDR 10 y una satisfactoria visibilidad tanto en interiores como en exteriores. Sin embargo, la falta de una tasa de refresco superior a 60 Hz es una omisión notable, especialmente en comparación con la competencia. A pesar de ello, el panel está bien calibrado de fábrica, aunque carece de amplias posibilidades de personalización.\r\n\r\nEl rendimiento del iPhone 12 es excepcional, manejando con facilidad tanto las tareas cotidianas como las más exigentes. Su capacidad de procesamiento y la fluidez en el uso diario son puntos fuertes, respaldados por buenos resultados en benchmarks. La llegada del 5G es una adición importante, aunque su utilidad dependerá de la cobertura y el operador.\r\n\r\nEl sistema operativo iOS 14 ofrece estabilidad y algunas novedades como los widgets y una nueva forma de organizar aplicaciones, aunque las posibilidades de personalización siguen siendo limitadas. La autonomía del iPhone 12, aunque suficiente para un día de uso intensivo, no representa un salto significativo respecto a modelos anteriores. La decisión de Apple de no incluir un cargador en la caja ha sido controversial, generando debate sobre el impacto ambiental y la conveniencia para el usuario.', 1),
(20, 'Apple iPhone 15 Pro Max A2849', 9000000, 9990000, 'iphone-15-pro-max-removebg.png', 15, '¡YA DISPONIBLE!\r\n\r\nDiseño ligero y resistente de titanio\r\n\r\nEl iPhone 15 Pro Max es el primer iPhone con diseño de titanio de calidad aeroespacial. De hecho, está fabricado con la misma aleación que se usan las naves espaciales en las misiones a Marte de la NASA. El titanio es de los metales con mejor relación resistencia-peso, lo que convierte al iPhone 15 Pro en el modelo Pro más ligero hasta la fecha.\r\n\r\nDynamic Island\r\n\r\nLa Dynamic Island del iPhone 15 Pro Max te muestra alertas y actividades en tiempo real para que no se te pase nada mientras estás a lo tuyo. Podrás ver por dónde va el taxi que has pedido, echar un ojo al temporizador o ver controlar la música que estás escuchando.\r\n\r\nPantalla siempre activa\r\n\r\nCon la pantalla siempre activa del iPhone 15 Pro Max, tendrás la información más importante visible en todo momento. Una mirada rápida verás la hora, tus Widgets, las notificaciones e incluso tu fondo de pantalla. Gracias a los algoritmos inteligentes, el iPhone detecta si lo tienes en el bolsillo o lo pones boca abajo, y la pantalla se apaga para ahorrar batería.\r\n\r\nBotón Acción\r\n\r\nEl nuevo botón Acción te da acceso directo a la prestación que más utilices. Configúralo a tu gusto y tira de su magia para hacerte la vida más fácil. Abrir la cámara, iniciar la grabación de una nota de voz, o ejecutar tu atajo favorito.\r\n\r\nConexión USB-C\r\n\r\nEl iPhone 15 Pro Max inaugura la era del USB-C en el iPhone. Así podrás cargar tu Mac o iPad con el mismo cable que usas para el iPhone 15 Pro Max. Dile adiós a esas marañas de cables.', 1),
(21, 'Smart QLED Hisense 55U60H 55\"', 4000000, 4800000, 'smartTv.png', 20, ' •Resolución de la pantalla: 4K Ultra HD (3840x2160p)\r\n •Pantalla: QLED de 55\"\r\n •Interfaz: HDMI, USB, RF, LAN (RJ-45), Jack de 3.5mm \r\n •Conectividad: Wifi y Bluetooth ', 11),
(23, 'Fire TV Stick 3ra Generación 4K', 300000, 394000, 'azjO5opBprzVGv6FOqrNK-transformed.png', 34, 'El Media player Amazon Fire TV Stick 3ra Generación 4K volvió más potente que nunca, con acceso a más de 15.000 juegos, aplicaciones, 300.000 películas diferentes, programas de televisión, videos y más utilizando los servicios de transmisión populares ofrecidos por Amazon Video, Netflix, Crackle, Hulu y otros cuenta con un procesador ultrarrápido, disfrutaras de una experiencia de streaming 4K Ultra HD más completa. Encontrar contenido 4K Ultra HD nunca ha sido tan fácil, solo tienes que pulsar y preguntar a Alexa o buscar recomendaciones en la pantalla de inicio. Tiene más almacenamiento para aplicaciones y juegos que cualquier otro dispositivo multimedia en streaming. Además, incluye el mando por voz Alexa para controlar tu TV, barra de sonido y receptor compatibles con los botones específicos para encender el dispositivo, silenciarlo y ajustar el volumen.', 3),
(24, 'Smartwatch Samsung Galaxy Watch7', 2000000, 2631000, 'reloj_smartwatch_samsung_galaxy_watch7_sm-l300n_40_mm_-_greens_2_1-removebg-preview.png', 30, ' •Potencia para todo el día gracias a su nuevo procesador de 3nm, mayor precisión en tus movimientos con su GPS de doble frecuencia y control total de tu frecuencia cardiaca, entrenamientos y horas de sueño con su avanzado sensor BioActive.\r\n •Además, Galaxy AI te proporcionará información valiosa sobre tu salud a través de Energy Score y Wellness Tips.\r\nDescubre el Galaxy Watch7, ¡tu nuevo compañero de aventuras con inteligencia artificial!', 12),
(25, 'Xiaomi 14 Ultra 5G Dual con Cámara Leica', 9000000, 10000000, '908827_1-removebg-preview.png', 12, 'Sumérgete en una experiencia visual impresionante con el Xiaomi 14 Ultra 5G Dual. Con una pantalla LTPO AMOLED de 6.73\", disfrutarás de colores vibrantes y detalles nítidos en cada imagen y video, con una resolución de 1440 x 3200p.\r\n\r\nCaptura el mundo que te rodea con una claridad excepcional gracias a su avanzado sistema de cámaras. Equipado con una cuádruple cámara principal de 50MP + 50MP + 50MP + 50MP, el Xiaomi 14 Ultra te permite capturar cada momento con una calidad asombrosa y una profundidad de detalle incomparable. Desde paisajes impresionantes hasta primeros planos detallados, cada foto será una obra maestra. Además, con la cámara frontal de 32MP, tus selfies serán siempre nítidos y listos para compartir en tus redes sociales favoritas.\r\n\r\nCon conectividad 5G, estarás listo para disfrutar de descargas ultrarrápidas, streaming sin interrupciones y juegos en línea fluidos. Además, con un diseño elegante y ergonómico, el Xiaomi 14 Ultra se adapta cómodamente a tu mano y complementa tu estilo de vida activo.', 1),
(26, 'Notebook ASUS Laptop X515MA-BR423W 15.6\"', 2000000, 2250000, 'asus_x515ma-br423w_-_1_1_1-removebg-preview.png', 12, ' •Pantalla: LED de 15.6\" Full HD 1920 x 1080p\r\n •Procesador: Intel Celeron N4020 Dual-Core 1.1 - 2.8 GHz\r\n •Memoria RAM: DDR4 de 4 GB\r\n •Memoria de almacenamiento: SSD M.2 NVMe de 128 GB\r\n •Gráficos: Intel UHD 600\r\n •Sistema operativo: Windows 11 Home', 13),
(28, 'Google Pixel 9 Pro 5G Dual 128 GB', 9000000, 9783000, 'pixel.png', 15, ' •Tamaño de pantalla: OLED de 6.8\"\r\n •Resolución: 1344 x 2992p\r\n •Cámara principal: Triple 50MP + 48MP + 48MP\r\n •Cámara frontal: 42MP\r\n\r\nDiseño\r\nUn diseño cuidado.\r\nPixel 9 Pro, con su diseño nuevo y mejorado, cuenta con un suave panel trasero de vidrio mate, un elegante visor de la cámara con doble acabado y un marco metálico con acabado pulido que tiene un tacto tan agradable como su aspecto.\r\nUna cámara galardonada. Fotos de nivel Pro.\r\nEl sistema de cámara trasera triple de Pixel 9 Pro te permite conseguir primerísimos planos, selfies nítidos y colores intensos, incluso con poca luz.\r\n', 1),
(29, 'Consola Microsoft Xbox Series X 1 TB', 5000000, 5400000, 'Xbox.png', 10, ' •Resolución: 4k (UHD)\r\n •Fotogramas por segundo: Hasta 120 \r\n •Memoria RAM: 16 GB GDDR6\r\n •Memoria de Almacenamiento: SSD NVME de 1 TB\r\n •Interfaz: USB y HDMI \r\n •Conectividad: Bluetooth\r\n\r\nXbox Series X, la consola más rápida y poderosa de Xbox hasta la fecha. Con 12 teraflops de potencia de procesamiento gráfico, trazado de rayos DirectX y un SSD personalizado, disfruta de juegos en 4K, tiempos de carga ultrarrápidos y hasta 120 FPS. Incluye 24 meses de Xbox Game Pass Ultimate con acceso a más de 100 juegos, incluyendo lanzamientos nuevos como Halo Infinite y Forza Horizon 5. Completo con controlador, cables y tecnología avanzada de Xbox Velocity Architecture.', 14),
(30, 'Sony Playstation 5 825 GB Fifa 2023', 5000000, 5900000, 'play.png', 10, 'El paquete PlayStation 5 + EA SPORTS FIFA 23 trae las Copas Mundiales de la FIFA masculina y femenina a la cancha con tecnología HyperMotion2, agrega equipos de clubes femeninos y ofrece soporte exclusivo para funciones exclusivas de PS5 que incluyen retroalimentación háptica, disparadores adaptables y audio 3D.\r\n\r\nEl paquete PlayStation 5 + EA SPORTS FIFA 23 incluye:\r\n\r\nConsola PlayStation 5 Standard\r\nControl Inalámbrico DualSense\r\nBase\r\nCable HDMI\r\nCable AC\r\nCable USB\r\nManuales\r\nASTRO’s PLAYROOM (Juego pre-instalado. La consola puede necesitar actualizarse a la última versión de software disponible. Se requiere una conexión a Internet.)\r\nCódigo canjeable para descargar el juego completo EA SPORTS FIFA 23\r\nCódigo canjeable de EA SPORTS FIFA 23 Ultimate Team\r\n(Código de descarga compatible para residentes de Argentina, Bolivia, Colombia, Chile, Costa Rica, República Dominicana, Ecuador, El Salvador, Guatemala, Honduras, Nicaragua, Panamá, Paraguay, Perú y Uruguay).', 14),
(32, 'Apple Macbook Air (2024) 15.3\"', 12000000, 13000000, 'mac.png', 5, ' •Pantalla: Liquid Retina IPS 15.3\" 2880 x 1864\r\n •Procesador: M3 8-Core\r\n •Sensor: Touch ID\r\n\r\nSuperligera. Superchip M3.\r\n\r\nLa MacBook Air está hecha para que trabajes y te diviertas al máximo. Con la\r\nllegada del chip M3, esta laptop superportátil es capaz de hacer cosas aún\r\nmás increíbles. Y como tiene hasta 18 horas de batería, está lista para arrasar\r\ncon cualquier tarea en cualquier lugar.\r\n', 13),
(33, 'Oppo Reno12 CPH2625 5G Dual 512 GB ', 4000000, 4500000, 'oppo.png', 5, ' •Tamaño de pantalla: 6.7\" AMOLED \r\n •Resolución: 1080 x 2412p\r\n •Cámara principal: Triple 50Mp + 8Mp + 2Mp\r\n •Cámara frontal: 32Mp\r\n\r\nEl Oppo Reno12 CPH2625 5G Dual ofrece una experiencia visual y fotográfica de alta calidad, con su impresionante pantalla AMOLED de 6.7 pulgadas y resolución Full HD+ de 1080 x 2412 píxeles, que garantiza colores vibrantes y detalles nítidos. Equipado con una cámara principal triple de 50 MP + 8 MP + 2 MP, permite capturar imágenes de gran calidad y versatilidad, mientras que su cámara frontal de 32 MP es ideal para selfies nítidas y videollamadas claras. Además, cuenta con conectividad 5G, asegurando una navegación rápida y fluida en redes de alta velocidad.\r\n ', 1),
(34, 'Resident Evil 4 Remake (2023)', 500000, 650000, '109232_-_1-removebg-preview.png', 30, '¿Qué es Resident Evil 4?\r\nUna emocionante reinterpretación del revolucionario clásico de terror y acción de Capcom.\r\nResident Evil 4, el legendario survival horror de 2005, se renueva completamente en este remake.\r\n\r\nSeis años después de los eventos de Resident Evil 2, el sobreviviente de Raccoon City, Leon Kennedy, se encuentra apostado en un recóndito pueblo de Europa para investigar la desaparición de la hija del presidente de los Estados Unidos. Lo que descubre allí no se parece a nada que haya enfrentado antes.\r\n\r\nTodos los aspectos del juego clásico se han actualizado para la generación actual, desde gráficos y controles modernizados, hasta una historia reinventada que puede sorprender incluso a los fanáticos del juego original.', 15),
(36, 'EA Sport FC 2025 PS5  (2024)', 600000, 700000, 'vj_j_ps5_ea_sport_fc_25_s-removebg-preview.png', 5, '¿Qué es EA SPORTS FC 25?\r\n\r\nConsigue más formas de ganar con tu club. Juega en equipo con amigos en tus modos favoritos y administra tu club hasta obtener la victoria con un control táctico sin igual.\r\n\r\n\r\nLleva a tu equipo al nivel de los mejores del mundo con la inteligencia futbolística de FC. Con una renovación de las bases tácticas del juego, obtendrás un control estratégico excepcional y movimientos de equipo aún más realistas. Un nuevo modelo de IA, basado en datos del mundo real, influye en las tácticas de los jugadores e introduce nuevos roles.\r\n\r\nLas nuevas características en las Carreras de jugador y de DT te permitirán experimentar las historias más destacadas del mundo real con los Live Start Points. Reescribe la historia de los íconos del pasado con los equipos actuales en la Carrera de jugador y, por primera vez, disfruta de una experiencia auténtica en la Carrera femenina, donde podrás controlar un club o a una jugadora de las cinco mejores ligas de fútbol femenino.', 15),
(38, 'Televisor Smart QLED Samsung 85\"', 45000000, 51148000, 'YdwiHVZmcH5lRCnwSR9inpwWb2vxbIxLWPB_1-removebg-preview.png', 5, 'Más Wow que nunca, Neo QLED 8K\r\nExperimente el pináculo de la calidad de imagen de Samsung, con Quantum Matrix Technology Pro con tecnología Quantum Mini LED, excelente mejora de 8K y una hermosa pantalla Infinity en el televisor QN900C Neo QLED.\r\nTecnología de matriz cuántica profesional\r\nUn mundo completamente nuevo de detalles \r\nQuantum Matrix Technology Pro representa un salto gigante en la tecnología de visualización de TV. Utilizando una tecnología de retroiluminación superior, Samsung ha establecido el estándar en calidad de imagen, ofreciendo negros increíblemente profundos, detalles de nivel superior y un contraste brillante.\r\nNeo Quantum HDR 8K Pro\r\nDetalle excepcional revelado\r\nDisfrute de sus películas y programas favoritos con colores, contrastes y detalles extraordinarios. Neo Quantum HDR 8K Pro da vida a lo que quizás te hayas perdido en escenas particularmente oscuras o claras, haciéndolas resaltar con una claridad espectacular. (sólo 75\"/85\").', 11),
(39, 'Playstation 4 Slim 1 TB + God of War', 2500000, 3000000, 'br-105609-5_1-removebg-preview.png', 20, 'La consola Sony Playstation 4 Slim 2215B de 1 TB es una de las opciones más populares para los gamers que buscan una experiencia de juego de alta calidad. Esta consola es más delgada y ligera que su predecesora, pero cuenta con el mismo potente procesador y la misma capacidad de almacenamiento. Con una amplia selección de juegos disponibles, tendrás acceso a una variedad de títulos emocionantes y exclusivos de Playstation.\r\n\r\nUno de los juegos más emocionantes que puedes disfrutar en esta consola es God of War Ragnarök. Este juego de acción y aventura sigue las aventuras del legendario guerrero Kratos y su hijo Atreus mientras luchan contra dioses y monstruos en una búsqueda para salvar al mundo de la destrucción total. Con impresionantes gráficos, una historia emocionante y una jugabilidad increible, God of War Ragnarök es una adición a cualquier colección de juegos.\r\n\r\nJuntos, la consola Sony Playstation 4 Slim 2215B de 1 TB y el juego God of War Ragnarök hacen una combinación perfecta para los gamers que buscan una experiencia de juego emocionante y de alta calidad. Con la consola Playstation 4 Slim, tendrás acceso a una amplia selección de juegos emocionantes y la capacidad de almacenamiento para descargar y jugar tus títulos favoritos. Y con God of War Ragnarök, tendrás horas de diversión y emocionantes aventuras por delante. ¡Una excelente opción para cualquier gamer!', 14),
(41, 'Apple TV (2022) 4K LZ/A 128 GB', 1500000, 2000000, '1666199154_1731226_1_2-removebg-preview.png', 10, 'Dale a tu televisor acceso al amplio ecosistema de entretenimiento de Apple, además de tus aplicaciones de transmisión favoritas, con Apple TV 4K . Esta edición 2022 de tercera generación del Apple TV 4K ofrece acceso Wi-Fi a una amplia variedad de contenido. Transmita programas y películas de Apple Originals a través de Apple TV+, así como contenido de Disney+, Netflix y más. Incluso puede ver televisión en vivo de una gran cantidad de emisoras populares.\r\nFuera de la televisión y las películas, Apple TV 4K te permite ponerte en forma con Apple Fitness+, jugar con Apple Arcade y rockear con Apple Music. Gracias al rápido chip A15 Bionic, el Apple TV 4K 2022 puede transmitir hasta 4K con soporte para alto rango dinámico usando Dolby Vision o HDR10+. Apple TV 4K se maneja fácilmente a través del control remoto incluido, o puede presionar el botón Siri para buscar y controlar la reproducción con su voz.', 3),
(42, 'Control Inalámbrico Playstation PS5', 500000, 645000, '57934_1-removebg-preview.png', 20, 'El control inalámbrico DualSense para PS5 ofrece respuesta háptica inmersiva, gatillos adaptativos dinámicos y un micrófono integrado, todo en un diseño icónico.\r\n\r\nRespuesta háptica:\r\nSiente la respuesta física a tus acciones en el juego con los accionadores dobles que reemplazan a los tradicionales motores de vibración. En tus manos, estas vibraciones dinámicas pueden simular la sensación de todo, desde los entornos hasta el retroceso de diferentes armas.\r\nGatillos adaptativos: \r\nExperimenta la tensión y la fuerza variadas cuando interactúes con los entornos y los equipos del juego. Desde tensar la cuerda de un arco cada vez más hasta pisar los frenos de un automóvil a gran velocidad, siéntete físicamente conectado a tus acciones en la pantalla.', 14),
(45, 'Smart QLED Mtek 65\" 4K Ultra HD', 4000000, 4600000, 'VKsyqHSDzuaOkE3hCCJ3xAhet1obEUqRDCa-removebg-preview.png', 12, 'Descubre una experiencia audiovisual sin igual con el televisor Smart QLED Mtek MKQ65FSGU de 65 pulgadas en 4K Ultra HD. Con un diseño elegante en color negro, este televisor se convierte en el centro de entretenimiento perfecto para cualquier espacio. La tecnología QLED ofrece una calidad de imagen superior con colores vibrantes y negros profundos, mientras que su resolución de 3840 x 2160 píxeles garantiza imágenes nítidas y detalladas. Diseñado con una pantalla plana de 16:9, el televisor proporciona una visión envolvente perfecta para películas, juegos y eventos deportivos. Equipado con conectividad Wi-Fi 5 y Bluetooth 5.0, el Mtek MKQ65FSGU te permite disfrutar de una navegación rápida y sin interrupciones. Su interfaz completa incluye puertos HDMI, USB y Jack de 3.5 mm, asegurando compatibilidad con múltiples dispositivos. Con 16 GB de memoria interna y 2 GB de RAM, este Smart TV ofrece un rendimiento fluido y una experiencia de usuario optimizada. Sus parlantes duales de 10 W entregan un sonido claro y potente, complementado por una frecuencia de refresco de 60 Hz que garantiza escenas suaves y sin retrasos. Vive una inmersión completa en tu entretenimiento diario con el televisor Mtek MKQ65FSGU.', 11),
(46, 'Xiaomi Redmi 13C Dual Des. 40%', 400000, 540000, '1016673.distancia-actualizada-removebg-preview.png', 30, 'Precio Base: 900.000\r\n\r\nDescubre el increíble Xiaomi Redmi 13C Duak 128 GB, la combinación perfecta de potencia y estilo. Equipado con un procesador de 8 núcleos, ofrece un rendimiento impecable para todas sus tareas y una pantalla AMOLED de 90 Hz que brinda una visualización vibrante y fluida. Capture momentos memorables con la cámara principal de 50 MP, garantizando fotografías y vídeos de alta calidad. Además, cuenta con un amplio almacenamiento, para velocidad en aplicaciones y funciones.', 16);

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
(48, 'Diego', NULL, 'diego@gmail.com', 'cliente', 'diego', 'arguello', 988776655, '', 16),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `abastecimientos_productos`
--
ALTER TABLE `abastecimientos_productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
