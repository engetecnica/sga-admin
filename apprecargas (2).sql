-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Dez-2022 às 17:13
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `apprecargas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anexos`
--

CREATE TABLE `anexos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_anexo` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `tipo` text DEFAULT NULL,
  `arquivo` text DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_empresa` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `data_de_nascimento` date DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `status` enum('Ativo','Inativo') NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `id_empresa`, `nome`, `data_de_nascimento`, `cep`, `endereco`, `estado`, `cidade`, `celular`, `email`, `cpf`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'DARLAN R NUNES', '1987-02-20', '82884-000', 'RUA BLINDAGEM SECA', 'ES', 'FOZ DO IGUACU', '+55 (41) 99803-6863', 'darlan@nunessa.com.br', '065.451.789-44', 'Ativo', NULL, '2022-12-17 17:17:43', '2022-12-17 17:17:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `ti_responsavel_nome` varchar(255) DEFAULT NULL,
  `ti_responsavel_telefone` varchar(255) DEFAULT NULL,
  `ti_responsavel_email` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `integrador` enum('Cielo','Rede','Stone Pagamentos','Mercado Pago') NOT NULL DEFAULT 'Mercado Pago',
  `keys` text NOT NULL,
  `pix_tipo` enum('Celular','CPF','CNPJ','E-mail','Chave Aleatória') NOT NULL DEFAULT 'Celular',
  `pix_nome` varchar(255) DEFAULT NULL,
  `pix_chave` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `data_de_nascimento` date DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('Ativo','Inativo') NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id`, `nome`, `data_de_nascimento`, `cep`, `endereco`, `cidade`, `estado`, `celular`, `cpf`, `email`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ANDRE BAILL 06545178946', '1987-02-20', '85884-000', 'RUA BLINDAGEM SECA', 'CURITIBA', 'PR', '+55 (41) 99803-6863', '065.451.789-46', 'srandrebaill@gmail.com', 'Ativo', NULL, '2022-12-17 16:33:45', '2022-12-17 16:33:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_05_134424_create_modulos_table', 1),
(6, '2022_08_05_174852_create_usuarios_niveis_table', 1),
(7, '2022_08_06_143742_add_field_users_table', 1),
(8, '2022_08_09_151046_add_field_modulos_table', 1),
(9, '2022_08_11_195359_add_field_usuario_tipo', 1),
(10, '2022_08_18_162512_create_configuracoes_table', 1),
(11, '2022_08_18_183550_add_field_configuracoes_table', 1),
(12, '2022_08_20_213018_create_empresas_table', 1),
(13, '2022_08_20_223031_add_field_empresas_table', 1),
(14, '2022_08_20_224707_add_field_cpf_empresas_table', 1),
(15, '2022_08_21_142933_create_produtos_table', 1),
(16, '2022_08_21_145000_create_produtos_configuracoes_table', 1),
(17, '2022_08_21_150006_create_produtos_estoque_table', 1),
(18, '2022_08_23_155807_create_anexos_table', 1),
(19, '2022_12_17_134619_create_cliente_table', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE `modulos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_modulo` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `posicao` int(11) NOT NULL DEFAULT 0,
  `url_amigavel` varchar(255) DEFAULT NULL,
  `icone` varchar(255) DEFAULT NULL,
  `tipo_de_acao` set('view','add','edit','delete','other') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id`, `id_modulo`, `titulo`, `posicao`, `url_amigavel`, `icone`, `tipo_de_acao`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Configurações', 1, 'configuracao', NULL, 'view,add,edit,delete,other', NULL, '2022-12-17 19:01:19', NULL),
(2, 1, 'Tipos de Usuário', 1, 'configuracao/usuario_tipo', '', 'view,add,edit,delete,other', NULL, NULL, NULL),
(3, 1, 'Usuários', 2, 'configuracao/usuario', 'mdi menu-arrow', 'view,add,edit,delete,other', NULL, '2022-12-17 18:59:31', NULL),
(4, 1, 'SGRC Configurações', 3, 'configuracao/sistema', '', 'view,add,edit,delete,other', NULL, NULL, NULL),
(5, 0, 'Cadastros', 3, 'cadastro', '#', 'view,add,edit,delete,other', '2022-12-17 16:19:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 5, 'Empresas', 1, 'cadastro/empresa', '#', 'view,add,edit,delete,other', '2022-12-17 16:21:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 5, 'Clientes', 2, 'cadastro/cliente', '#', 'view,add,edit,delete,other', '2022-12-17 16:21:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 5, 'Produtos', 3, 'cadastro/produto', '#', 'view,add,edit,delete,other', '2022-12-17 16:21:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 5, 'Produtos Associar', 4, 'cadastro/produto/associar/adicionar', '#', 'view,add,edit,delete,other', '2022-12-17 16:21:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 'Módulos', 4, 'configuracao/modulo', NULL, 'view,add,edit,delete,other', '2022-12-17 18:42:52', '2022-12-17 18:42:52', NULL),
(11, 0, 'Estoque', 4, 'estoque', NULL, 'view,add,edit,delete,other', '2022-12-17 18:43:40', '2022-12-17 18:43:40', NULL),
(12, 11, 'Gerenciar', 1, 'estoque/gerenciar', NULL, 'view,add,edit,delete,other', '2022-12-17 18:44:42', '2022-12-17 18:45:00', NULL),
(13, 0, 'Vendas', 5, 'venda', NULL, 'view,add,edit,delete,other', '2022-12-17 18:46:35', '2022-12-17 18:46:35', NULL),
(14, 13, 'Ponto de Venda', 2, 'venda/pdv', NULL, 'view,add,edit,delete,other', '2022-12-17 18:47:12', '2022-12-17 18:47:12', NULL),
(15, 0, 'Relatório', 7, 'relatorio', NULL, 'view,add,edit,delete,other', '2022-12-17 18:47:55', '2022-12-17 18:47:55', NULL),
(16, 15, 'Logs de Acesso', 1, 'relatorio/tipo/log', NULL, 'view,add,edit,delete,other', '2022-12-17 18:48:34', '2022-12-17 18:48:34', NULL),
(17, 15, 'Empresas', 2, 'relatorio/tipo/empresa', NULL, 'view,add,edit,delete,other', '2022-12-17 18:48:59', '2022-12-17 18:48:59', NULL),
(18, 15, 'Produtos', 3, 'relatorio/tipo/produto', NULL, 'view,add,edit,delete,other', '2022-12-17 18:49:35', '2022-12-17 18:49:35', NULL),
(19, 15, 'Clientes', 4, 'relatorio/cliente', NULL, 'view,add,edit,delete,other', '2022-12-17 18:51:17', '2022-12-17 18:51:17', NULL),
(20, 15, 'Estoque', 5, 'relatorio/tipo/estoque', NULL, 'view,add,edit,delete,other', '2022-12-17 18:51:54', '2022-12-17 18:51:54', NULL),
(21, 15, 'Vendas', 7, 'relatorio/tipo/venda', NULL, 'view,add,edit,delete,other', '2022-12-17 18:52:37', '2022-12-17 18:52:37', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `status` enum('Ativo','Inativo') NOT NULL DEFAULT 'Ativo',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `titulo`, `descricao`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'BLUE TV 30 DIAS', NULL, 'Ativo', NULL, '2022-12-17 17:30:08', '2022-12-17 17:30:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_configuracoes`
--

CREATE TABLE `produtos_configuracoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_empresa` bigint(20) UNSIGNED NOT NULL,
  `id_produto` bigint(20) UNSIGNED NOT NULL,
  `tipo` enum('Mensal','Bimestral','Trimestral','Semestral','Anual','Diferenciado') NOT NULL DEFAULT 'Mensal',
  `quantidade_minina` int(11) NOT NULL DEFAULT 1,
  `valor_compra` double(8,2) NOT NULL DEFAULT 0.00,
  `valor_venda` double(8,2) NOT NULL DEFAULT 0.00,
  `valor_lucro` double(8,2) NOT NULL DEFAULT 0.00,
  `imagem` varchar(255) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `status` enum('Ativo','Inativo') NOT NULL DEFAULT 'Ativo',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produtos_configuracoes`
--

INSERT INTO `produtos_configuracoes` (`id`, `id_empresa`, `id_produto`, `tipo`, `quantidade_minina`, `valor_compra`, `valor_venda`, `valor_lucro`, `imagem`, `observacoes`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Mensal', 1, 12.00, 24.00, 12.00, NULL, NULL, 'Ativo', NULL, '2022-12-17 17:31:13', '2022-12-17 17:31:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_estoque`
--

CREATE TABLE `produtos_estoque` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produto` bigint(20) UNSIGNED NOT NULL,
  `id_produto_configuracao` bigint(20) UNSIGNED NOT NULL,
  `data_venda` datetime DEFAULT NULL,
  `status` enum('Liberado','Vendido','Outro') NOT NULL DEFAULT 'Liberado',
  `codigo` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_level` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_level`, `created_at`, `updated_at`) VALUES
(1, 'André Baill', 'suporte@hdtv.blue', '2022-12-17 15:24:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 1, '2022-12-17 15:25:35', NULL),
(2, 'Master Label', 'master@hdtv.blue', NULL, '$2y$10$FpndFPpemCoGrMCuUIKlbeNwA7nAokP50uJf3l79yA57rZU7Z9n2O', NULL, 1, '2022-12-17 16:05:09', '2022-12-17 16:05:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_niveis`
--

CREATE TABLE `usuarios_niveis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `permissoes` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios_niveis`
--

INSERT INTO `usuarios_niveis` (`id`, `titulo`, `permissoes`, `created_at`, `updated_at`) VALUES
(1, 'Master', '{\"view\":{\"2\":\"on\",\"3\":\"on\",\"4\":\"on\",\"6\":\"on\",\"7\":\"on\",\"8\":\"on\",\"9\":\"on\"},\"add\":{\"2\":\"on\",\"3\":\"on\",\"4\":\"on\",\"6\":\"on\",\"7\":\"on\",\"8\":\"on\",\"9\":\"on\"},\"edit\":{\"2\":\"on\",\"3\":\"on\",\"4\":\"on\",\"6\":\"on\",\"7\":\"on\",\"8\":\"on\",\"9\":\"on\"},\"delete\":{\"2\":\"on\",\"3\":\"on\",\"4\":\"on\",\"6\":\"on\",\"7\":\"on\",\"8\":\"on\",\"9\":\"on\"},\"other\":{\"2\":\"on\",\"3\":\"on\",\"4\":\"on\",\"6\":\"on\",\"7\":\"on\",\"8\":\"on\",\"9\":\"on\"}}', NULL, '2022-12-17 16:53:59'),
(2, 'Administrador', '{}', NULL, NULL),
(3, 'Revendedor', '{}', NULL, NULL),
(4, 'Cliente', '{}', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id_empresa_foreign` (`id_empresa`);

--
-- Índices para tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos_configuracoes`
--
ALTER TABLE `produtos_configuracoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_configuracoes_id_empresa_foreign` (`id_empresa`),
  ADD KEY `produtos_configuracoes_id_produto_foreign` (`id_produto`);

--
-- Índices para tabela `produtos_estoque`
--
ALTER TABLE `produtos_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_estoque_id_produto_foreign` (`id_produto`),
  ADD KEY `produtos_estoque_id_produto_configuracao_foreign` (`id_produto_configuracao`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices para tabela `usuarios_niveis`
--
ALTER TABLE `usuarios_niveis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_niveis_titulo_unique` (`titulo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos_configuracoes`
--
ALTER TABLE `produtos_configuracoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos_estoque`
--
ALTER TABLE `produtos_estoque`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios_niveis`
--
ALTER TABLE `usuarios_niveis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `cliente_id_empresa_foreign` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`);

--
-- Limitadores para a tabela `produtos_configuracoes`
--
ALTER TABLE `produtos_configuracoes`
  ADD CONSTRAINT `produtos_configuracoes_id_empresa_foreign` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `produtos_configuracoes_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `produtos_estoque`
--
ALTER TABLE `produtos_estoque`
  ADD CONSTRAINT `produtos_estoque_id_produto_configuracao_foreign` FOREIGN KEY (`id_produto_configuracao`) REFERENCES `produtos_configuracoes` (`id`),
  ADD CONSTRAINT `produtos_estoque_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
