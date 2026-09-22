-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Ago-2020 às 12:04
-- Versão do servidor: 10.1.31-MariaDB
-- versão do PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `saog`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastrados`
--

CREATE TABLE `cadastrados` (
  `id_cadastrado` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `id_plantao` int(11) NOT NULL,
  `motorista` tinyint(1) NOT NULL DEFAULT '1',
  `presenca` tinyint(1) DEFAULT NULL,
  `confirmar_inscricao` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `matricula` int(8) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `se` varchar(10) NOT NULL,
  `lotacao` varchar(100) NOT NULL,
  `sigla_lotacao` varchar(100) DEFAULT NULL,
  `mcu` varchar(15) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `especialidade` varchar(100) DEFAULT NULL,
  `funcao` varchar(100) DEFAULT NULL,
  `localizacao` varchar(100) DEFAULT NULL,
  `situacao` varchar(255) DEFAULT 'ATIVO',
  `uf` char(2) DEFAULT NULL,  
  `telefone` varchar(9) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao_cancelada`
--

CREATE TABLE `inscricao_cancelada` (
  `id_inscricao_cancelada` int(11) NOT NULL,
  `id_cadastrado` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `id_plantao` int(11) NOT NULL,
  `motorista` tinyint(1) NOT NULL DEFAULT '1',
  `presenca` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `data_cad` datetime NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- Estrutura da tabela `loginAdm`
--

CREATE TABLE `loginadm` (
  `id_loginadm` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------




--
-- Estrutura da tabela `plantao`
--

CREATE TABLE `plantao` (
  `id_plantao` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `turno_inicio` datetime NOT NULL,
  `turno_final` datetime NOT NULL,
  `vagas` int(4) NOT NULL,
  `motorista` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `presenca`
--

CREATE TABLE `presenca` (
  `id_presenca` int(11) NOT NULL,
  `id_cadastrado` int(11) NOT NULL,
  `entrada1` timestamp NULL DEFAULT NULL,
  `saida1` timestamp NULL DEFAULT NULL,
  `entrada2` timestamp NULL DEFAULT NULL,
  `saida2` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades`
--

CREATE TABLE `unidades` (
  `id_unidade` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `se` varchar(10) NOT NULL,
  `trabalho` varchar(50) NOT NULL DEFAULT 'Distribuicao',
  `endereco` varchar(100) NOT NULL,
  `gerente` varchar(150) NOT NULL,
  `url` varchar(300) DEFAULT NULL,
  `matricula` varchar(8) NOT NULL,
  `tel_gerente` varchar(11) NOT NULL,
  `tel_centro1` varchar(11) DEFAULT NULL,
  `tel_centro2` varchar(11) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL, 
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`),
  ADD KEY `fk_matricula_adm` (`matricula`);

--
-- Índices para tabela `cadastrados`
--
ALTER TABLE `cadastrados`
  ADD PRIMARY KEY (`id_cadastrado`),
  ADD KEY `fk_matricula` (`matricula`),
  ADD KEY `fk_id_plantao` (`id_plantao`);

--
-- Índices para tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`matricula`);

--
-- Índices para tabela `inscricao_cancelada`
--
ALTER TABLE `inscricao_cancelada`
  ADD PRIMARY KEY (`id_inscricao_cancelada`),
  ADD KEY `fk_cancelada_matricula` (`matricula`),
  ADD KEY `fk_cancelada_id_plantao` (`id_plantao`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `fk_matricula_login` (`matricula`);

--
-- Índices para tabela `loginAdm`
--
ALTER TABLE `loginadm`
  ADD PRIMARY KEY (`id_loginadm`),
  ADD KEY `fk_matricula_loginadm` (`matricula`);


--
-- Índices para tabela `plantao`
--
ALTER TABLE `plantao`
  ADD PRIMARY KEY (`id_plantao`),
  ADD KEY `fk_id_unidade` (`id_unidade`);

--
-- Índices para tabela `presenca`
--
ALTER TABLE `presenca`
  ADD PRIMARY KEY (`id_presenca`),
  ADD KEY `fk_id_cadastrado` (`id_cadastrado`);

--
-- Índices para tabela `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id_unidade`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cadastrados`
--
ALTER TABLE `cadastrados`
  MODIFY `id_cadastrado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `matricula` int(11) NOT NULL;

--
-- AUTO_INCREMENT de tabela `inscricao_cancelada`
--
ALTER TABLE `inscricao_cancelada`
  MODIFY `id_inscricao_cancelada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `loginadm`
  MODIFY `id_loginadm` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT de tabela `inscricao_cancelada`
--
ALTER TABLE `inscricao_cancelada`
  MODIFY `id_inscricao_cancelada` int(11) NOT NULL AUTO_INCREMENT;



--
-- AUTO_INCREMENT de tabela `plantao`
--
ALTER TABLE `plantao`
  MODIFY `id_plantao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `presenca`
--
ALTER TABLE `presenca`
  MODIFY `id_presenca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id_unidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_matricula_adm` FOREIGN KEY (`matricula`) REFERENCES `colaboradores` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cadastrados`
--
ALTER TABLE `cadastrados`
  ADD CONSTRAINT `fk_matricula` FOREIGN KEY (`matricula`) REFERENCES `colaboradores` (`matricula`),
  ADD CONSTRAINT `fk_id_plantao` FOREIGN KEY (`id_plantao`) REFERENCES `plantao` (`id_plantao`);

--
-- Limitadores para a tabela `inscricao_cancelada`
--
ALTER TABLE `inscricao_cancelada`
  ADD CONSTRAINT `fk_cancelada_matricula` FOREIGN KEY (`matricula`) REFERENCES `colaboradores` (`matricula`),
  ADD CONSTRAINT `fk_cancelada_id_plantao` FOREIGN KEY (`id_plantao`) REFERENCES `plantao` (`id_plantao`);

--
-- Limitadores para a tabela `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_matricula_login` FOREIGN KEY (`matricula`) REFERENCES `colaboradores` (`matricula`);



--
-- Limitadores para a tabela `loginAdm`
--
ALTER TABLE `loginadm`
  ADD CONSTRAINT `fk_matricula_loginadm` FOREIGN KEY (`matricula`) REFERENCES `colaboradores` (`matricula`);



--
-- Limitadores para a tabela `plantao`
--
ALTER TABLE `plantao`
  ADD CONSTRAINT `fk_id_unidade` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`id_unidade`);

--
-- Limitadores para a tabela `presenca`
--
ALTER TABLE `presenca`
  ADD CONSTRAINT `fk_id_cadastrado` FOREIGN KEY (`id_cadastrado`) REFERENCES `cadastrados` (`id_cadastrado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
