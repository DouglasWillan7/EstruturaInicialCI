-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Mar-2017 às 14:23
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `operacao` varchar(45) NOT NULL,
  `query` text NOT NULL,
  `observacao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `data_hora`, `operacao`, `query`, `observacao`) VALUES
(154, 'master', '2017-03-23 12:41:17', 'Login no Sistema', 'SELECT *\nFROM `usuarios`\nWHERE `login` = ''master''\n LIMIT 1', 'Login efetuado com sucesso'),
(155, 'master', '2017-03-23 12:42:18', 'Login no Sistema', 'SELECT *\nFROM `usuarios`\nWHERE `login` = ''master''\n LIMIT 1', 'Login efetuado com sucesso'),
(156, 'master', '2017-03-23 12:45:34', 'Logoff no Sistema', '0', 'Logoff efetuado com sucesso'),
(157, 'master', '2017-03-23 12:45:54', 'Login no Sistema', 'SELECT *\nFROM `usuarios`\nWHERE `login` = ''master''\n LIMIT 1', 'Login efetuado com sucesso'),
(158, 'master', '2017-03-23 12:46:13', 'Logoff no Sistema', '0', 'Logoff efetuado com sucesso'),
(159, 'master', '2017-03-23 12:46:21', 'Login no Sistema', 'SELECT *\nFROM `usuarios`\nWHERE `login` = ''master''\n LIMIT 1', 'Login efetuado com sucesso'),
(160, 'master', '2017-03-23 12:47:29', 'Exlusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` = ''4''', 'Um foi excluido no sistema'),
(161, 'master', '2017-03-23 12:47:37', 'Exlusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` = ''14''', 'Um foi excluido no sistema'),
(162, 'master', '2017-03-23 12:49:44', 'Exlusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` = ''13''', 'Um foi excluido no sistema'),
(163, 'master', '2017-03-23 12:51:32', 'Exlusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` = ''8''', 'Um foi excluido no sistema'),
(164, 'master', '2017-03-23 12:51:39', 'Exlusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` = ''6''', 'Um foi excluido no sistema'),
(165, 'master', '2017-03-23 12:51:43', 'Exlusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` = ''7''', 'Um foi excluido no sistema'),
(166, 'master', '2017-03-23 12:51:47', 'Exlusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` = ''5''', 'Um foi excluido no sistema'),
(167, 'master', '2017-03-23 12:51:51', 'Exlusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` = ''2''', 'Um foi excluido no sistema'),
(168, 'master', '2017-03-23 12:52:21', 'Alteração de usuários', 'UPDATE `usuarios` SET `senha` = ''81dc9bdb52d04dc20036dbd8313ed055''\nWHERE `id` = ''1''', 'Um foi usuario alterado no sistema'),
(169, 'master', '2017-03-23 12:53:57', 'Logoff no Sistema', '0', 'Logoff efetuado com sucesso'),
(170, 'master', '2017-03-23 12:55:30', 'Login no Sistema', 'SELECT *\nFROM `usuarios`\nWHERE `login` = ''master''\n LIMIT 1', 'Login efetuado com sucesso'),
(171, 'master', '2017-03-23 13:04:03', 'Logoff no Sistema', '0', 'Logoff efetuado com sucesso'),
(172, 'master', '2017-03-23 13:05:25', 'Login no Sistema', 'SELECT *\nFROM `usuarios`\nWHERE `login` = ''master''\n LIMIT 1', 'Login efetuado com sucesso'),
(173, 'master', '2017-03-23 13:06:01', 'Logoff no Sistema', '0', 'Logoff efetuado com sucesso'),
(174, 'master', '2017-03-23 13:06:14', 'Login no Sistema', 'SELECT *\nFROM `usuarios`\nWHERE `login` = ''master''\n LIMIT 1', 'Login efetuado com sucesso'),
(175, 'master', '2017-03-23 13:07:06', 'Inclusão de usuários', 'INSERT INTO `usuarios` (`nome`, `email`, `login`, `telefone`, `senha`, `adm`) VALUES (''Douglas'', ''douglaswillan7@gmail.com'', ''douglas'', ''31997414102'', ''81dc9bdb52d04dc20036dbd8313ed055'', 0)', 'Um novo usuario foi incluso no sistema'),
(176, 'master', '2017-03-23 13:07:27', 'Exlusão de usuários', 'DELETE FROM `usuarios`\nWHERE `id` = ''21''', 'Um foi excluido no sistema'),
(177, 'master', '2017-03-23 13:15:58', 'Logoff no Sistema', '0', 'Logoff efetuado com sucesso');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(42) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `adm` tinyint(1) NOT NULL DEFAULT '0',
  `cargo` varchar(25) DEFAULT NULL,
  `unidade_de_atendimento` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `arquivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `login`, `senha`, `ativo`, `adm`, `cargo`, `unidade_de_atendimento`, `telefone`, `arquivo`) VALUES
(1, 'Admin Master', 'adminmaster@gmail.com', 'master', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, '1', NULL, '(31) 3712-1964', 'new_logo2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
