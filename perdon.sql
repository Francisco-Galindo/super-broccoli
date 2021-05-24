-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: biblioteca
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autor` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
INSERT INTO `autor` VALUES (4,'Pérez, Juan'),(5,'Torvald, Tux'),(6,'de Cervantes, Miguel'),(7,'De Unamuno, Miguel'),(8,'Hitler, Adolf'),(9,'de Cervantes Saavedra, Miguel '),(10,'Conan Doyle, Sir Arthur'),(11,'Tolkien, John Ronlad'),(12,'Hesse, Herman'),(13,'Lovecraft, H.P.'),(14,'Verne, Julio'),(15,'Austen, Jane'),(16,'Dúmas, Alexander'),(17,'Wilde, Oscar');
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(32) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Libro'),(2,'Revista'),(3,'Libro de texto'),(4,'Examen'),(5,'Enciclopedia'),(6,'Diccionario');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editorial`
--

DROP TABLE IF EXISTS `editorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editorial` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `editorial` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editorial`
--

LOCK TABLES `editorial` WRITE;
/*!40000 ALTER TABLE `editorial` DISABLE KEYS */;
INSERT INTO `editorial` VALUES (12,'Nubecita'),(13,'GNU'),(14,'No sé xd'),(15,'Elejandria'),(16,'Alfaguara'),(17,'Lectulandia'),(18,'Super Brocolí');
/*!40000 ALTER TABLE `editorial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorito`
--

DROP TABLE IF EXISTS `favorito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorito` (
  `id_favorito` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(12) DEFAULT NULL,
  `id_libro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_favorito`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`num_cuenta_rfc`),
  CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorito`
--

LOCK TABLES `favorito` WRITE;
/*!40000 ALTER TABLE `favorito` DISABLE KEYS */;
INSERT INTO `favorito` VALUES (10,'123',10),(11,'123',11),(12,'123',17),(13,'123',20);
/*!40000 ALTER TABLE `favorito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formulario`
--

DROP TABLE IF EXISTS `formulario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formulario` (
  `id_formulario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(12) DEFAULT NULL,
  `obra` varchar(64) DEFAULT NULL,
  `autor` varchar(64) DEFAULT NULL,
  `publicacion` year(4) DEFAULT NULL,
  `editorial` varchar(32) DEFAULT NULL,
  `edicion` varchar(32) DEFAULT NULL,
  `razon` text DEFAULT NULL,
  PRIMARY KEY (`id_formulario`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `formulario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`num_cuenta_rfc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formulario`
--

LOCK TABLES `formulario` WRITE;
/*!40000 ALTER TABLE `formulario` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(32) NOT NULL,
  PRIMARY KEY (`id_genero`),
  UNIQUE KEY `genero` (`genero`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Acción y Aventura'),(2,'Ciencia Ficción'),(3,'Cuento'),(4,'Fantasía'),(5,'Ficción Clásica'),(6,'Ficción Contemporánea'),(7,'Ficción Erótica'),(8,'Ficción Histórica'),(9,'Ficción Religiosa'),(10,'Literatura de viaje'),(11,'Terror');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_descargas`
--

DROP TABLE IF EXISTS `historial_descargas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_descargas` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(12) DEFAULT NULL,
  `id_libro` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_historial`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `historial_descargas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`num_cuenta_rfc`),
  CONSTRAINT `historial_descargas_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_descargas`
--

LOCK TABLES `historial_descargas` WRITE;
/*!40000 ALTER TABLE `historial_descargas` DISABLE KEYS */;
INSERT INTO `historial_descargas` VALUES (8,'1',16,'2021-05-12 20:03:18'),(9,'123',11,'2021-05-12 20:05:06'),(10,'123',11,'2021-05-14 01:19:08'),(11,'123',16,'2021-05-14 01:19:57'),(12,'123',20,'2021-05-14 01:26:56');
/*!40000 ALTER TABLE `historial_descargas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_referencia` varchar(128) DEFAULT '../statics/img_referencia/imagen_default.png',
  `year` year(4) DEFAULT NULL,
  `editorial` int(11) DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `titulo` varchar(128) DEFAULT 'Sin título',
  `libro` varchar(128) NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_libro`),
  KEY `editorial` (`editorial`),
  KEY `autor` (`autor`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`editorial`) REFERENCES `editorial` (`id_editorial`),
  CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`autor`) REFERENCES `autor` (`id_autor`),
  CONSTRAINT `libro_ibfk_3` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (10,'../statics/img_referencia/Tux_5.jpg',2020,12,5,'TUX','Tux','../statics/libros/Tux_5.pdf',1),(11,'../statics/img_referencia/imagen_default.png',0000,14,6,'Pues todo el mundo lo conoce xd','Don Quijote de la Mancha','../statics/libros/Don Quijote de la Mancha_6.pdf',NULL),(12,'../statics/img_referencia/Tuxito_5.jpg',2010,13,5,'EL TUX VIENE POR TU ALMA','Tuxito','../statics/libros/Tuxito_5.pdf',NULL),(13,'../statics/img_referencia/Papu_4.png',2015,13,4,'Que es esto','Papu','../statics/libros/Papu_4.pdf',NULL),(14,'../statics/img_referencia/Papu_4.png',2015,13,4,'Que es esto','Papu','../statics/libros/Papu_4.pdf',NULL),(15,'../statics/img_referencia/Papu_4.png',2015,13,4,'Que es esto','Papu','../statics/libros/Papu_4.pdf',2),(16,'../statics/img_referencia/imagen_default.png',2000,13,5,'Esto es una prueba','Hola','../statics/libros/Hola_5.pdf',1),(17,'../statics/img_referencia/Adentro_7.png',0000,15,7,'En esta obra Miguel de Unamuno habla de todo lo que debemos de dar para ser quien queramos ser, lograrnos como personas dar sin recibir ni esperar nada a cambio solo nuestra propia satisfacción como ser humano. Dar todo y hasta uno mismo como dice en la lectura dar y dar hasta todo tu universo, buscándolo todo adentro de ti.','Adentro','../statics/libros/Adentro_7.pdf',1),(18,'../statics/img_referencia/Mi Lucha_8.png',1925,15,8,'Es el primer libro escrito por Adolf Hitler, combinando elementos autobiográficos con una exposición de sus ideas propias y un manifiesto de la ideología política del nacionalsocialismo. El trabajo describe el proceso por el cual Hitler se volvió antisemita y describe sus planes futuros para Alemania','Mi Lucha','../statics/libros/Mi Lucha_8.pdf',1),(19,'../statics/img_referencia/imagen_default.png',0000,16,9,'Don Quijote de la Mancha es una novela escrita por el español Miguel de Cervantes Saavedra. Publicada su primera parte con el título de El ingenioso hidalgo don Quijote de la Mancha a comienzos de 1605, es la obra más destacada de la literatura española y una de las principales de la literatura universal, además de ser la más leída después de la Biblia','El ingenioso caballero Don Quijote de la Mancha','../statics/libros/El ingenioso caballero Don Quijote de la Mancha_9.pdf',1),(20,'../statics/img_referencia/El sabueso de los baskerville_10.png',1902,15,10,'es la tercera novela de Arthur Conan Doyle que tiene como protagonista principal a Sherlock Holmes. Fue publicada por entregas en el The Strand Magazine entre 1901 y 1902. La novela está principalmente ambientada en Dartmoor, en Devon, un condado del oeste de Inglaterra.\r\nLa historia transcurre en 1889 cuando Sir Charles Baskerville es encontrado muerto en un sendero en el páramo de Devonshire, el doctor Mortimer acude a Londres para buscar la ayuda de Sherlock Holmes: lee a Holmes el manuscrito acerca de la maldición de los Baskerville, supuestamente iniciada con Hugo de Baskerville, matado por un sabueso infernal como castigo por su maldad. ','El sabueso de los baskerville','../statics/libros/El sabueso de los baskerville_10.pdf',1),(21,'../statics/img_referencia/El señor de los anillos: La comunidad del anillos_11.png',1954,17,11,'La Comunidad del Anillo (título original en inglés: The Fellowship of the Ring) es el primero de los tres volúmenes que forman la novela El Señor de los Anillos, secuela de El hobbit, del escritor británico J. R. R. Tolkien. La obra fue escrita para ser publicada en un solo tomo, pero debido a su longitud y coste, la editorial Allen & Unwin decidió dividirla.4​ Fue publicada el 29 de julio de 1954','El señor de los anillos: La comunidad del anillos','../statics/libros/El señor de los anillos: La comunidad del anillos_11.pdf',1),(22,'../statics/img_referencia/El señor de los anillos: El retorno del rey_11.png',1954,17,11,'Las dos torres (titulado originalmente en inglés: The Two Towers) es el segundo volumen de la novela de fantasía heroica El Señor de los Anillos, del escritor británico J. R. R. Tolkien. La Comunidad del Anillo precede a este volumen, y a su vez continúa en El retorno del Rey.\r\nLa historia transcurre dentro del universo ficticio de la Tierra Media, y en ella se continúa la narración de las aventuras de los protagonistas de La Comunidad del Anillo: la muerte de Boromir, el secuestro de Merry y Pippin por los orcos de Saruman y su posterior huida, las batallas de Aragorn, Legolas y Gimli en el Oeste en contra de los ejércitos del señor oscuro y el viaje de Frodo y Sam hacia el Este, cruzando las tierras controladas por el enemigo para llegar al Monte del Destino y destruir el Anillo Único.','El señor de los anillos: El retorno del rey','../statics/libros/El señor de los anillos: El retorno del rey_11.pdf',1),(23,'../statics/img_referencia/El señor de los anillos: El retorno del rey_11.png',1955,17,11,'El retorno del Rey (titulado originalmente en inglés: The Return of the King) es el tercer volumen de la novela de fantasía heroica El Señor de los Anillos, del escritor británico J. R. R. Tolkien. Las dos torres es el volumen inmediatamente anterior a este volumen, y el primero de la serie es La Comunidad del Anillo. La versión original en inglés fue publicada en 1955','El señor de los anillos: El retorno del rey','../statics/libros/El señor de los anillos: El retorno del rey_11.pdf',1),(24,'../statics/img_referencia/imagen_default.png',1927,15,12,'El libro se desarrolla a través de unos manuscritos creados por el propio protagonista, Harry Haller, los cuales son presentados al lector por un conocido de Harry en la introducción de la obra. Dentro de los manuscritos se narran los problemas, la vida del protagonista y su difícil relación con el mundo y consigo mismo.','El lobo estepareo','../statics/libros/El lobo estepareo_12.pdf',1),(25,'../statics/img_referencia/Demian_12.png',1919,15,12,'En Demian resuenan, aunque quizás para muchos lectores no sean perceptibles, ecos vibrantes de las reflexiones del autor sobre la propia adolescencia atormentada; de ese tiempo de búsquedas, dolores y sufrimientos, declaró Hesse haber tomado conciencia con la escritura de esta novela, recién unos veinte años después de publicada.','Demian','../statics/libros/Demian_12.pdf',1),(26,'../statics/img_referencia/imagen_default.png',1963,15,13,'Se trata de una autobiografía escrita por H.P. Lovecraft','Algunas notas sobre algo que no existe','../statics/libros/Algunas notas sobre algo que no existe_13.pdf',1),(27,'../statics/img_referencia/Aventuras de tres rusos y tres ingleses en el áfrica austral_14.png',0000,15,14,'Una expedición conjunta entre Inglaterra y Rusia lleva a seis expertos al África para medir el arco meridiano del desierto de Kalahari. El objetivo que tiene medir el meridiano es definir internacionalmente el patrón del metro como unidad de medida.','Aventuras de tres rusos y tres ingleses en el áfrica austral','../statics/libros/Aventuras de tres rusos y tres ingleses en el áfrica austral_14.pdf',1),(28,'../statics/img_referencia/imagen_default.png',1902,15,14,'Dos hermanos logran escapar de la cárcel acusados de un delito que no cometieron, y buscan pruebas para probar su inocencia.\r\n\r\nEs una de las novelas más desconocidas del autor, publicada en su etapa más sombría','Los hermanos Kip','../statics/libros/Los hermanos Kip_14.pdf',1),(29,'../statics/img_referencia/imagen_default.png',0000,18,15,'En el centro de esta sociedad se encuentra la familia Bennet, con sus cinco hijas casaderas, de entre quince y veintitrés años (de mayor a menor: Jane, Elizabeth, Mary, Catherine y Lydia). La señora Bennet ve el matrimonio como la única esperanza para sus hijas, pues tras la muerte del señor Bennet las jóvenes quedarán abandonadas a su suerte cuando William Collins, primo de las muchachas, herede todo debido a que la propiedad forma parte de un mayorazgo del que es beneficiario.','Orgullo y Prejuicio','../statics/libros/Orgullo y Prejuicio_15.pdf',1),(30,'../statics/img_referencia/imagen_default.png',0000,18,16,'La historia tiene lugar en Francia, Italia y varias islas del Mediterráneo durante los hechos históricos de 1814-1838 (los Cien Días del gobierno de Napoleón I, el reinado de Luis XVIII de Francia, de Carlos X de Francia y el reinado de Luis Felipe I de Francia). Trata sobre todo temas asociados a la justicia, la venganza, la piedad y el perdón y está contada en el estilo de una historia de aventuras.','El conde de montecristo','../statics/libros/El conde de montecristo_16.pdf',1);
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro_has_genero`
--

DROP TABLE IF EXISTS `libro_has_genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro_has_genero` (
  `id_lg` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) DEFAULT NULL,
  `id_genero` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lg`),
  KEY `id_libro` (`id_libro`),
  KEY `id_genero` (`id_genero`),
  CONSTRAINT `libro_has_genero_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `libro_has_genero_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro_has_genero`
--

LOCK TABLES `libro_has_genero` WRITE;
/*!40000 ALTER TABLE `libro_has_genero` DISABLE KEYS */;
INSERT INTO `libro_has_genero` VALUES (5,10,1),(6,11,5),(7,12,3),(8,13,11),(9,14,11),(10,15,11),(11,16,1),(12,17,2),(13,18,7),(14,19,5),(15,20,5),(16,21,4),(17,22,4),(18,23,4),(19,24,5),(20,25,5),(21,27,2),(22,28,2),(23,29,5),(24,30,5);
/*!40000 ALTER TABLE `libro_has_genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporte`
--

DROP TABLE IF EXISTS `reporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reporte` (
  `id_reporte` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) DEFAULT NULL,
  `razon` enum('Contiene material para personas mayores de edad','Contiene discurso de odio','Difunde desinformación','Incita acciones que atentan contra la integridad') DEFAULT NULL,
  PRIMARY KEY (`id_reporte`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte`
--

LOCK TABLES `reporte` WRITE;
/*!40000 ALTER TABLE `reporte` DISABLE KEYS */;
INSERT INTO `reporte` VALUES (1,10,'Incita acciones que atentan contra la integridad'),(2,11,'Contiene material para personas mayores de edad');
/*!40000 ALTER TABLE `reporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Lector'),(2,'Bibliotecario'),(3,'Administrador');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `num_cuenta_rfc` varchar(12) NOT NULL,
  `nombre` varchar(48) NOT NULL,
  `primer_apellido` varchar(48) NOT NULL,
  `segundo_apellido` varchar(48) NOT NULL,
  `contraseña` varchar(64) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  PRIMARY KEY (`num_cuenta_rfc`),
  UNIQUE KEY `correo` (`correo`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('1','LECTOR','JUáREZ','PéREZ','hola','lector@comunidad.unam.mx',1,'2021-05-12'),('123','CARLITOS ALF','CAMPOS','DE LA GARZA','hola','carlosalf@comunidad.unam.mx',3,'2021-05-12'),('192374934','MAURICIO','MORALES','LOPEZ','contraseñasegura2','Mauricio@comunidad.unam.mx',1,'2003-07-25'),('319215555','ARTURO','ALFARO ','DOMíNGUEZ','contraseñasegura','arturoad2203@comunidad.unam.mx',1,'2001-03-15'),('92371923101','HELI','AGUILAR','MENA','seguracontraseña','Heli@comunidad.unam.mx',1,'2003-10-30'),('92371923102','FRANCISCO','GALINDO','MENA','contraseñabuena','Francisco@comunidad.unam.mx',1,'2021-05-13');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-24 14:43:02
