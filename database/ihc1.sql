-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Jan-2016 às 01:55
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ihc1`
--
CREATE DATABASE IF NOT EXISTS `ihc1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ihc1`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `sigla` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `departamento`
--

INSERT INTO `departamento` (`id`, `nome`, `sigla`) VALUES
(1, 'Departamento de Ciencia da Computacao', 'DCC'),
(2, 'Fisica', 'FIS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento_polo`
--

CREATE TABLE `departamento_polo` (
  `id_polo` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `departamento_polo`
--

INSERT INTO `departamento_polo` (`id_polo`, `id_departamento`, `id`) VALUES
(1, 1, 4),
(1, 2, 6),
(2, 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dia_semana`
--

CREATE TABLE `dia_semana` (
  `id` int(11) NOT NULL,
  `dia` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dia_semana`
--

INSERT INTO `dia_semana` (`id`, `dia`) VALUES
(1, 'Domingo'),
(2, 'Segunda'),
(3, 'Terca'),
(4, 'Quarta'),
(5, 'Quinta'),
(6, 'Sexta'),
(7, 'Sabado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `id_departamento_polo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id`, `codigo`, `nome`, `id_departamento_polo`) VALUES
(1, 'DCC016', 'Sistemas Operacionais', 4),
(2, 'FIS075', 'Fisica III', 6),
(3, 'DCC013', 'Banco de Dados', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

CREATE TABLE `horario` (
  `id_dia` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `inicio` int(11) NOT NULL,
  `fim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `horario`
--

INSERT INTO `horario` (`id_dia`, `id_turma`, `inicio`, `fim`) VALUES
(2, 2, 8, 10),
(4, 2, 8, 10),
(2, 3, 14, 18),
(5, 4, 8, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `polo`
--

CREATE TABLE `polo` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `polo`
--

INSERT INTO `polo` (`id`, `nome`, `cidade`, `uf`) VALUES
(1, 'Juiz de Fora', 'Juiz de Fora', 'MG'),
(2, 'Governador Valadares', 'Governador Valadares', 'MG');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id`, `nome`, `endereco`, `bairro`, `cidade`, `uf`, `cep`, `email`, `departamento`) VALUES
(1, 'Marcelo Moreno', 'Rua A', 'Bairro a', 'Juiz de Fora', 'MG', '36154356', 'moreno@ice.ufjf.br', 4),
(2, 'Luiz Henrique', 'Rua B', 'Bairro B', 'Governador Valadares', 'MG', '36457895', 'luiz@ice.ufjf.br', 5),
(3, 'Laura Lima', 'Rua C', 'Bairro C', 'Juiz de Fora', 'MG', '34544874', 'laura@ice.ufjf.br', 4),
(4, 'Bernard', 'a', 'a', 'Juiz de Fora', 'MG', '35414148', 'bernard@hotmail.com', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `id_polo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id`, `codigo`, `id_polo`) VALUES
(1, 'S201', 1),
(2, '2135', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `turma` varchar(2) NOT NULL,
  `id_professor` int(11) DEFAULT NULL,
  `id_sala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id`, `id_disciplina`, `turma`, `id_professor`, `id_sala`) VALUES
(2, 1, 'A', 1, 1),
(3, 2, 'A', 4, 1),
(4, 3, 'B', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departamento_polo`
--
ALTER TABLE `departamento_polo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_polo` (`id_polo`,`id_departamento`),
  ADD KEY `fk2` (`id_departamento`);

--
-- Indexes for table `dia_semana`
--
ALTER TABLE `dia_semana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkdp` (`id_departamento_polo`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD KEY `fk_th` (`id_turma`),
  ADD KEY `fk_hd` (`id_dia`);

--
-- Indexes for table `polo`
--
ALTER TABLE `polo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fkprofessor` (`departamento`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fksp` (`id_polo`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fktp` (`id_professor`),
  ADD KEY `fktd` (`id_disciplina`),
  ADD KEY `fkts` (`id_sala`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `departamento_polo`
--
ALTER TABLE `departamento_polo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `dia_semana`
--
ALTER TABLE `dia_semana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `polo`
--
ALTER TABLE `polo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `departamento_polo`
--
ALTER TABLE `departamento_polo`
  ADD CONSTRAINT `fk` FOREIGN KEY (`id_polo`) REFERENCES `polo` (`id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`);

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fkdp` FOREIGN KEY (`id_departamento_polo`) REFERENCES `departamento_polo` (`id`);

--
-- Limitadores para a tabela `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_hd` FOREIGN KEY (`id_dia`) REFERENCES `dia_semana` (`id`),
  ADD CONSTRAINT `fk_th` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`);

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `fkprofessor` FOREIGN KEY (`departamento`) REFERENCES `departamento_polo` (`id`);

--
-- Limitadores para a tabela `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `fksp` FOREIGN KEY (`id_polo`) REFERENCES `polo` (`id`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fktd` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id`),
  ADD CONSTRAINT `fktp` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id`),
  ADD CONSTRAINT `fkts` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
