SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `crud`;
CREATE DATABASE IF NOT EXISTS `crud` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `crud`;

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(155) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id`, `nome`, `email`, `telefone`) VALUES
(1, 'Joaquim Renato Pires', 'joaquimrenatopires@novotempo.com', '75998549120'),
(2, 'Natália Eduarda Jesus', 'nataliaeduardajesus@granadaimoveis.com.br', ''),
(3, 'Mirella Aline Rosângela da Paz', 'mirella-dapaz93@sodexo.com', '86998866821'),
(4, 'Benício Heitor Farias', 'benicioheitorfarias@eternalam.com.br', '41985011733'),
(5, 'Arthur Eduardo', 'arthureduardomonteiro@raffinimobiliario.com.br', '6828955839'),
(6, 'Manoel Luís Souza', 'manoel-souza95@apso.org.br', '61993636759'),
(7, 'Carlos', 'carlosrafaellopes@polifiltro.com.br', ''),
(8, 'Bruno Calebe da Rosa', 'bruno.calebe.darosa@ime.unicamp.br', '5127790458'),
(9, 'André Santos', 'andre_diego_dossantos@raioazul.com.br', '6129179640'),
(10, 'Mary Tyree', 'maryrtyree@armyspy.com', '3037807991');


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;
