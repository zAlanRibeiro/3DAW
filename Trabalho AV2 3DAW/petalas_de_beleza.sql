-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2024 às 04:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `petalas_de_beleza`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `profissional` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `email`, `telefone`, `servico`, `profissional`, `data`, `hora`) VALUES
(18, 'teste123@gmail.com', '21970246516', 'manicure', 'Leila', '2025-03-19', '19:00:00'),
(25, 'rodrigo123@gmail.com', '21970246516', 'Hidratação Facial', 'Rick Samuel', '2025-02-19', '19:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissionais`
--

CREATE TABLE `profissionais` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `especialidade` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `profissionais`
--

INSERT INTO `profissionais` (`id`, `nome`, `cargo`, `especialidade`, `imagem`) VALUES
(9, 'Leila', 'Funcionária', 'Especializada em todas as áreas', 'uploads/trabalhadora1.png'),
(10, 'Rick Samuel', 'Funcionário', 'Beauty', 'uploads/trabalhador2.png'),
(11, 'Carol', 'Funcionária', 'Especializada em Cabelo', 'uploads/trabalhadora3.png'),
(12, 'Amanda', 'Funcionária', 'Especializada em Unhas', 'uploads/trabalhadora4.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `nome`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Corte de Cabelo', 'Transforme seu visual com um corte de cabelo moderno e adequado ao seu estilo. Agende já seu horário com nossos profissionais qualificados.', 80.00, 'uploads/descontoCorte.jpg'),
(2, 'Manicure', 'Deixe suas mãos impecáveis com nossas manicure feitas por profissionais altamente qualificados, usando os melhores produtos e técnicas.', 50.00, 'uploads/manicure.jpg'),
(3, 'Pedicure', 'Cuidamos dos seus pés com o maior carinho, proporcionando um atendimento completo, desde o corte até o tratamento e esmaltação.', 50.00, 'uploads/pedicure.jpg'),
(4, 'Depilação', 'Oferecemos depilação com as melhores técnicas e produtos para garantir o máximo conforto e resultados duradouros.', 100.00, 'uploads/depilacao.jpg'),
(6, 'Hidratação Facial', 'Cuide da saúde da sua pele com nossa hidratação facial profunda, proporcionando mais frescor e vitalidade ao seu rosto.', 50.00, 'uploads/hidratacao.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ADM` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `ADM`) VALUES
(1, 'Alan', 'teste123@gmail.com', '$2y$10$awn8k4.Pj/OQqWVVUZ828eVJC54fiyWaEjWzqHwAbN.OdbPDh53Oa', NULL),
(2, 'Larissa', 'teste1234@gmail.com', '$2y$10$zPfThw3ytZmGJCIgluPDLu2IajUOGi68UGNEWVtI7H0QLWA4UwTHS', NULL),
(3, 'Flavio', 'flavio123@gmail.com', '$2y$10$RhZbOGlloY9qXz0ZhLLL3eCmnw02OuixPyN0v8j62Vai0PFwroio6', NULL),
(6, 'Pablo', 'pablin123@gmail.com', '$2y$10$3kxr3fWq.8ZPbKiUCVkSJujuYljP7EcgjePY5y3.o9NKaZJTBxNHG', NULL),
(7, 'Lucas', 'lucas123@gmail.com', '$2y$10$Q/WT2hipO5e6ofFpON7OA.zdu0wmsqDMHCXG3z2DBOREa4ZUF4RNu', NULL),
(8, 'ADM', 'adm123@gmail.com', '$2y$10$.oeu1cF8sPf2PVEbmnYrkuce7m3Y6ZuBB.McpIf3pFN.Gyi5q4XaK', 1),
(9, 'Rodrigo', 'rodrigo123@gmail.com', '$2y$10$4vyOMFAxUUgSLd4Hegkihe1OMrZ2EWznU0cHICQBZOPaLR93RdN7G', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `profissionais`
--
ALTER TABLE `profissionais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `profissionais`
--
ALTER TABLE `profissionais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
