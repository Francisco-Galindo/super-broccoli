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
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`num_cuenta_rfc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'12345'),(2,'rfc del jaas');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autor` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) DEFAULT NULL,
  `primer_apellido` varchar(32) DEFAULT NULL,
  `segundo_apellido` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bibliotecario`
--

DROP TABLE IF EXISTS `bibliotecario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bibliotecario` (
  `id_bibliotecario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_bibliotecario`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `bibliotecario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`num_cuenta_rfc`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bibliotecario`
--

LOCK TABLES `bibliotecario` WRITE;
/*!40000 ALTER TABLE `bibliotecario` DISABLE KEYS */;
INSERT INTO `bibliotecario` VALUES (1,'rfc2 de jaas');
/*!40000 ALTER TABLE `bibliotecario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editorial`
--

DROP TABLE IF EXISTS `editorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editorial` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `editorial` varchar(48) DEFAULT NULL,
  PRIMARY KEY (`id_editorial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editorial`
--

LOCK TABLES `editorial` WRITE;
/*!40000 ALTER TABLE `editorial` DISABLE KEYS */;
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
  CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorito`
--

LOCK TABLES `favorito` WRITE;
/*!40000 ALTER TABLE `favorito` DISABLE KEYS */;
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
  `id_lector` int(11) DEFAULT NULL,
  `obra` varchar(64) DEFAULT NULL,
  `autor` varchar(64) DEFAULT NULL,
  `publicacion` year(4) DEFAULT NULL,
  `editorial` varchar(32) DEFAULT NULL,
  `edicion` varchar(32) DEFAULT NULL,
  `razon` text DEFAULT NULL,
  PRIMARY KEY (`id_formulario`),
  KEY `id_lector` (`id_lector`),
  CONSTRAINT `formulario_ibfk_1` FOREIGN KEY (`id_lector`) REFERENCES `lector` (`id_lector`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
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
  CONSTRAINT `historial_descargas_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_descargas`
--

LOCK TABLES `historial_descargas` WRITE;
/*!40000 ALTER TABLE `historial_descargas` DISABLE KEYS */;
INSERT INTO `historial_descargas` VALUES (1,'12345',1,'2021-05-09 02:26:23'),(2,'12345',2,'2021-05-09 02:40:14'),(3,'333',1,'2021-05-09 02:40:31');
/*!40000 ALTER TABLE `historial_descargas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lector`
--

DROP TABLE IF EXISTS `lector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lector` (
  `id_lector` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_lector`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `lector_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`num_cuenta_rfc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lector`
--

LOCK TABLES `lector` WRITE;
/*!40000 ALTER TABLE `lector` DISABLE KEYS */;
/*!40000 ALTER TABLE `lector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro_has_autor`
--

DROP TABLE IF EXISTS `libro_has_autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro_has_autor` (
  `id_libro_has_autor` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_libro_has_autor`),
  KEY `id_libro` (`id_libro`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `libro_has_autor_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  CONSTRAINT `libro_has_autor_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro_has_autor`
--

LOCK TABLES `libro_has_autor` WRITE;
/*!40000 ALTER TABLE `libro_has_autor` DISABLE KEYS */;
/*!40000 ALTER TABLE `libro_has_autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro_has_editorial`
--

DROP TABLE IF EXISTS `libro_has_editorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro_has_editorial` (
  `id_libro_has_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) DEFAULT NULL,
  `id_editorial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_libro_has_editorial`),
  KEY `id_libro` (`id_libro`),
  KEY `id_editorial` (`id_editorial`),
  CONSTRAINT `libro_has_editorial_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  CONSTRAINT `libro_has_editorial_ibfk_2` FOREIGN KEY (`id_editorial`) REFERENCES `editorial` (`id_editorial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro_has_editorial`
--

LOCK TABLES `libro_has_editorial` WRITE;
/*!40000 ALTER TABLE `libro_has_editorial` DISABLE KEYS */;
/*!40000 ALTER TABLE `libro_has_editorial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libros`
--

DROP TABLE IF EXISTS `libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_referencia` varchar(128) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `editorial` varchar(64) DEFAULT NULL,
  `autor` varchar(64) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `titulo` varchar(128) DEFAULT 'Sin título',
  `libro` varchar(128) NOT NULL,
  PRIMARY KEY (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libros`
--

LOCK TABLES `libros` WRITE;
/*!40000 ALTER TABLE `libros` DISABLE KEYS */;
INSERT INTO `libros` VALUES (1,NULL,NULL,NULL,NULL,NULL,'Libro bonito',''),(2,NULL,NULL,NULL,NULL,NULL,'Libro feo','');
/*!40000 ALTER TABLE `libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libros_genero`
--

DROP TABLE IF EXISTS `libros_genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libros_genero` (
  `id_lg` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) DEFAULT NULL,
  `id_genero` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lg`),
  KEY `id_libro` (`id_libro`),
  KEY `id_genero` (`id_genero`),
  CONSTRAINT `libros_genero_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  CONSTRAINT `libros_genero_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libros_genero`
--

LOCK TABLES `libros_genero` WRITE;
/*!40000 ALTER TABLE `libros_genero` DISABLE KEYS */;
/*!40000 ALTER TABLE `libros_genero` ENABLE KEYS */;
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
  CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte`
--

LOCK TABLES `reporte` WRITE;
/*!40000 ALTER TABLE `reporte` DISABLE KEYS */;
/*!40000 ALTER TABLE `reporte` ENABLE KEYS */;
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
  `contraseña` varchar(40) DEFAULT NULL,
  `metodo` enum('texto','sha1','md5') DEFAULT NULL,
  `correo` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`num_cuenta_rfc`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('12345','Carlitos Alf','Campos','de la Garza','hola',NULL,'carlitos@alf.com'),('333','Juanito','Palo','Juárez','qwerty',NULL,'foo2@example.com'),('4321','gg','aa','dd','asdf',NULL,'foo@example.com'),('44444','Pedro','Pedro','Juan','asdf',NULL,'asas@asd.com'),('rfc del jaas','Jaasiel','Apellido xd','Apellido 3','jaasielcontra',NULL,'jaasiel@gmail.com'),('rfc2 de jaas','Jaasiel2','Apellido xd','Apellido 3','hola',NULL,'jaasiel2@gmail.com');
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

-- Dump completed on 2021-05-08 22:26:20
