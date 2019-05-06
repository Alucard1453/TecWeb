-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2019 a las 19:01:37
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectotecweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idUsuario` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `idTema` int(11) NOT NULL,
  `nArticulo` varchar(256) COLLATE latin1_spanish_ci NOT NULL,
  `imagen` varchar(256) COLLATE latin1_spanish_ci DEFAULT NULL,
  `contenido` varchar(4096) COLLATE latin1_spanish_ci NOT NULL,
  `nlike` int(11) NOT NULL DEFAULT '0',
  `dislike` int(11) NOT NULL DEFAULT '0',
  `interested` int(11) NOT NULL DEFAULT '0',
  `calificacion` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idUsuario`, `idArticulo`, `idTema`, `nArticulo`, `imagen`, `contenido`, `nlike`, `dislike`, `interested`, `calificacion`) VALUES
(7, 2, 9, 'Avengers Endgame Rompe Taquilla', 'https://cdn2.cnet.com/img/VcjARNnYtd1qwbOCueNf3bnOlhc=/1092x0/2019/03/14/70b49c1d-0d3b-4b75-9225-b898b83cdc9a/avengers-endgame-poster-og-social-crop.jpg', 'Apenas un semana despues de su estreno, Avengers: Endgame - 95% se prepara para pasar la marca de los US$ 2 mil millones de dolares en su taquilla global. No hay explicaciones para el evento cinematografico que paso a convertirse en fenomeno cultural, reconocido por las masas que continuan viendo la pelicula como si se tratara de una competencia.', 3, 0, 1, 5),
(7, 4, 1, 'Corea del Norte lanza varios misiles de corto alcance, su segunda prueba con armas tÃ¡cticas en menos de un mes', 'https://ichef.bbci.co.uk/news/660/cpsprodpb/DA33/production/_106495855_053464185-1.jpg', 'Corea del Norte lanzo varios misiles de \"corto alcance\" en la manana de este sabado (hora local), segun reportes militares de Corea del Sur.  Los proyectiles volaron entre 70 y 200km en direccion este hacia el Mar de Japon y fueron disparados entre las 09:06 y las 09:27 hora local (00:06 y 00:27 GMT), informo la Jefatura del Estado Mayor Conjunto surcoreana.  Fueron lanzados desde los alrededores de la ciudad de Wosan, en la peninsula norcoreana de Hodo, la misma region desde donde fueron lanzados misiles de largo alcance en el pasado.', 7, 1, 2, 6),
(1, 5, 9, 'Â¡Preparate porque \"Shazam!\" tendra secuela!', 'https://www.elsoldemexico.com.mx/cultura/cine/5qg1rx-shazam.jpg/alternates/LANDSCAPE_768/shazam.jpg', 'Apenas cuatro dias despues del estreno en todo el mundo de la pelicula \"Shazam!\", el medio especializado The Wrap informo este lunes que Warner Bros. y DC Comics preparan Â¡una secuela para esta cinta de superheroes!  Henry Gayden, guionista de la primera pelicula, regresara para escribir su continuacion.', 2, 0, 1, 3),
(1, 7, 1, '6 de mayo. Dia Internacional Sin Dietas, Â¿que vas a comer hoy?', 'https://img.europapress.es/fotoweb/fotonoticia_20190506012933_640.jpg', 'Los principales objetivos de este Dia Internacional Sin Dietas son algunos como: poner en duda la idea de una forma corporal correcta, crear conciencia de la discriminacion por razones de peso, la necesidad de alimentarse de forma equilibrada sin obsesionarse con estandares ideales, declarar un dia sin dietas y obsesiones con el cuerpo y recordar a las victimas de los desordenes alimenticios y enfermedades mentales.', 1, 1, 1, -1),
(1, 8, 10, 'Videojuegos por internet, mas alla de un negocio, son una nueva red social', 'https://imagenes.milenio.com/JLReP4SfqvrWYaIMpkek2wB2zR4=/958x596/https://www.milenio.com/uploads/media/2019/05/05/adiccion-videojuegos-causar-ansiedad-depresion_0_48_800_498.jpg', 'Cuando se habla de un gamer, la imagen de hace 10 anos dista mucho de la de ahora. Antes se podria imaginar a una persona aislada en su consolaâ€¦ En la actualidad, la palabra remite a una persona que utiliza los videojuegos no solo con fines de entretenimiento, sino hasta sociales. Segun informacion de la consultora The Competitive Intelligence Unit (The CIU), dos de cada tres personas usan internet en los videojuegos, esto con el fin de interactuar con otras personas de manera remota.', 1, 0, 0, 2),
(5, 9, 4, 'PRISMA EMPRESARIAL: Preocupante rumbo de la economia', 'https://almomento.mx/wp-content/uploads/2019/02/Banxico-1-696x392.jpeg', 'EL RUMBO de la economia empieza a ser preocupante, porque comenzaron a cristalizar los pronosticos negativos que han sustentado, desde hace 6 meses, los expertos, los inversionistas y organismos financieros internacionales.  De ese modo, en el periodo enero-marzo de 2019 hemos visto caidas en la produccion y venta de automoviles nuevos para consumo nacional, en las cifras de empleo,  en la produccion industrial, en el PIB turistico, y ahora quedo confirmada la desaceleracion en el crecimiento del PIB nacional, el cual fue negativo en -0.2% en el primer trimestre de este ano, respecto al periodo previo (octubre-diciembre de 2018).', 0, 0, 1, -1),
(5, 10, 10, 'Mortal Kombat 11: Como encontrar los tres amuletos del Dios Mayor', 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/styles/main_element/public/media/image/2019/03/MK11_Cage_Baraka_3.6.19.jpg', 'Lo primero que tendremos que hacer sera abrir la puerta que esta entre el Santuario Naamkaran y la Forja usando el amuleto del Dragon. Una vez abierta encontraremos un rompecabezas con tres ranuras. Tendremos que usar las palancas para mover los circulos y que las ranuras de los amuletos esten disponibles. En estas ranuras, tendremos que introducir los tres amuletos del Dios Mayor que son: el amuleto de Kronika, el de Shinnok y el de Cetrion.', 0, 0, 0, 0),
(7, 11, 4, 'Y de pronto... la economia global luce mas fuerte', 'https://cdn-3.expansion.mx/dims4/default/949b80b/2147483647/strip/true/crop/1415x741+0+0/resize/800x419!/quality/90/?url=https%3A%2F%2Fcdn-3.expansion.mx%2F84%2Fdf%2F49306bb142c1aea33f0da32d5d03%2Feconomiaglobal-crece-istock.jpg', 'Las economias en el corazon de Europa estan creciendo mas rapido de lo esperado, lo que aumenta las esperanzas de que se haya evitado un desplome global.  El crecimiento de los 19 paises que utilizan el euro en el primer trimestre fue de 0.4% en comparacion con los tres meses anteriores, segun datos preliminares publicados el martes. Eso es el doble de la tasa reportada en el ultimo trimestre de 2018.  La fortaleza del desempeno sorprendio a los economistas, quienes dijeron que fue impulsado por un menor desempleo, el aumento de los salarios y una mayor demanda de los consumidores.', 0, 0, 0, 0),
(8, 12, 8, 'Kyuhyun termina su servicio militar', 'https://6.viki.io/image/afb53e4dffe64603a6fbe9a6aa8254c0.jpeg?s=900x600&e=t', 'Kyuhyun enlisted in May 2017, and he will be discharged from military service on May 7. He is currently in talks to return to the world of variety shows after his discharge through shows including â€œRadio Star,â€ â€œNew Journey to the West,â€ and â€œSalty Tour.â€', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificado`
--

CREATE TABLE `calificado` (
  `idUsuario` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `reaccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `idTema` int(11) NOT NULL,
  `nTema` varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  `fotoTema` varchar(512) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`idTema`, `nTema`, `fotoTema`) VALUES
(1, 'Internacional', 'Resources/themes/international.jpg'),
(2, 'Ciencia', 'Resources/themes/ciencia.jpg'),
(3, 'Sociedad', 'Resources/themes/sociedad.jpg'),
(4, 'Economia', 'Resources/themes/economia.jpg'),
(5, 'Tecnologia', 'Resources/themes/tecnologia.jpg'),
(6, 'Cultura', 'Resources/themes/cultura.jpg'),
(7, 'Deportes', 'Resources/themes/deportes.jpg'),
(8, 'Espectaculos', 'Resources/themes/espectaculos.jpg'),
(9, 'Cine', 'Resources/themes/cine.jpg'),
(10, 'Videojuegos', 'Resources/themes/videojuegos.jpg'),
(11, 'Chismes', 'Resources/themes/chismes.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temainteres`
--

CREATE TABLE `temainteres` (
  `idUsuario` int(11) NOT NULL,
  `idTema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `temainteres`
--

INSERT INTO `temainteres` (`idUsuario`, `idTema`) VALUES
(7, 1),
(7, 4),
(7, 6),
(7, 7),
(8, 1),
(8, 2),
(8, 5),
(8, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nUsuario` varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `genero` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `eCivil` varchar(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nUsuario`, `password`, `edad`, `genero`, `eCivil`) VALUES
(1, 'Alucard', '1453', 27, 'Masculino', 'Soltero'),
(3, 'Aldo', '1234', 18, 'Masculino', 'Soltero'),
(5, 'Susana', '1234', 27, 'Femenino', 'Soltero'),
(7, 'Juan', '1234', 23, 'Masculino', 'Casado'),
(8, 'Laura', '1234', 21, 'Femenino', 'Soltero'),
(9, 'Josue', '1234', 30, 'Masculino', 'Casado'),
(10, 'Mario', '1234', 15, 'Masculino', 'Soltero');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idArticulo`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTema` (`idTema`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`idTema`);

--
-- Indices de la tabla `temainteres`
--
ALTER TABLE `temainteres`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTema` (`idTema`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `idTema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`idTema`) REFERENCES `tema` (`idTema`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `temainteres`
--
ALTER TABLE `temainteres`
  ADD CONSTRAINT `temainteres_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `temainteres_ibfk_2` FOREIGN KEY (`idTema`) REFERENCES `tema` (`idTema`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
