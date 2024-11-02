

--
-- Base de datos: `blog`
CREATE DATABASE blog;
USE blog;
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`%` PROCEDURE `create_report` (IN `p_id_post` BIGINT UNSIGNED, IN `p_id_user` BIGINT UNSIGNED, IN `p_cause` TEXT)   BEGIN
    DECLARE report_id BIGINT UNSIGNED;
    DECLARE report_count INT;

    -- Verificar si ya existe el reporte
    SELECT id INTO report_id
    FROM report_post
    WHERE id_post = p_id_post AND state_report = 'PENDING';

    IF report_id IS NULL THEN
        -- Crear un nuevo reporte
        INSERT INTO report_post (id_post, state_report, created_at, updated_at, no_report)
        VALUES (p_id_post, 'PENDING', NOW(), NOW(), 1);
        SET report_id = LAST_INSERT_ID();
        
        -- Insertar en user_report_post
        INSERT INTO user_report_post (id_report, id_user, cause)
        VALUES (report_id, p_id_user, p_cause);
    ELSE
        -- Contar reportes existentes para este post
        SELECT no_report INTO report_count
        FROM report_post
        WHERE id = report_id;

        -- Si el conteo es menor a 3, insertar en user_report_post
        IF report_count < 3 THEN
            INSERT INTO user_report_post (id_report, id_user, cause)
            VALUES (report_id, p_id_user, p_cause);

            -- Incrementar el no_report en report_post
            UPDATE report_post
            SET no_report = no_report + 1
            WHERE id = report_id;
        END IF;
    END IF;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(2, 'Conferencia', '2024-10-22 07:51:32', '2024-11-02 05:26:01'),
(3, 'Seminarios', '2024-10-22 07:52:03', '2024-11-01 16:47:00'),
(5, 'Talleres', '2024-10-22 07:52:46', '2024-11-01 16:47:11'),
(7, 'Networking', '2024-10-22 07:52:55', '2024-11-01 16:47:24'),
(8, 'Ferias y Exposiciones', '2024-10-22 07:53:00', '2024-11-01 16:47:41'),
(13, 'Lanzamientos de Productos', '2024-10-22 08:23:58', '2024-11-01 16:47:53'),
(14, 'Capacitación y Formación', '2024-10-22 08:26:10', '2024-11-01 16:48:07'),
(15, 'Bodas', '2024-10-22 08:26:21', '2024-11-01 16:48:20'),
(16, 'Reuniones Familiares', '2024-10-22 08:26:26', '2024-11-01 16:48:38'),
(17, 'Baby Showers', '2024-10-22 08:29:14', '2024-11-01 16:48:50'),
(18, 'Festivales', '2024-10-22 17:01:46', '2024-11-01 16:49:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `id_post` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `status` enum('UPCOMING','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UPCOMING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `events`
--


--
-- Disparadores `events`
--
DELIMITER $$
CREATE TRIGGER `after_event_list` AFTER INSERT ON `events` FOR EACH ROW BEGIN
    UPDATE posts
    SET confirmed = confirmed + 1
    WHERE id = NEW.id_post;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `events_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `events_view` (
`address` varchar(255)
,`capacity` int
,`category` varchar(255)
,`confirmed` int
,`created_at` timestamp
,`date_event` date
,`description` longtext
,`id` bigint unsigned
,`id_category` bigint unsigned
,`id_user` bigint unsigned
,`state_publication` enum('ACTIVATED','REFUSED','PENDING','BAN')
,`time_event` time
,`title` varchar(255)
,`updated_at` timestamp
,`user` bigint unsigned
);

-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_event` date NOT NULL,
  `time_event` time NOT NULL,
  `capacity` int NOT NULL,
  `confirmed` int NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` bigint UNSIGNED NOT NULL,
  `state_publication` enum('ACTIVATED','REFUSED','PENDING','BAN') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

--
-- Disparadores `posts`
--
DELIMITER $$
CREATE TRIGGER `after_post_update` AFTER UPDATE ON `posts` FOR EACH ROW BEGIN
    -- Verifica si el estado ha cambiado a 'accept'
    IF NEW.state_publication = 'ACTIVATED' THEN
        -- Suma uno al contador de accepted_posts_count en la tabla users
        UPDATE users
        SET no_post = no_post + 1
        WHERE id = NEW.id_user; -- Asumiendo que el post tiene un user_id asociado
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `post_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `post_view` (
`address` varchar(255)
,`capacity` int
,`category` varchar(255)
,`confirmed` int
,`created_at` timestamp
,`date_event` date
,`description` longtext
,`id` bigint unsigned
,`id_category` bigint unsigned
,`id_user` bigint unsigned
,`name` varchar(255)
,`state_publication` enum('ACTIVATED','REFUSED','PENDING','BAN')
,`time_event` time
,`title` varchar(255)
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report_post`
--

CREATE TABLE `report_post` (
  `id` bigint UNSIGNED NOT NULL,
  `id_post` bigint UNSIGNED NOT NULL,
  `id_admin` bigint UNSIGNED DEFAULT NULL,
  `state_report` enum('APPROVED','REFUSED','PENDING') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `no_report` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `report_post`
--

--
-- Disparadores `report_post`
--
DELIMITER $$
CREATE TRIGGER `after_update_report_post` AFTER UPDATE ON `report_post` FOR EACH ROW BEGIN
    DECLARE max_reports INT DEFAULT 3; -- Cambia este valor según tus necesidades

    IF NEW.no_report >= max_reports THEN
        -- Actualizar el estado de la publicación a 'BANNED'
        UPDATE posts 
        SET state_publication = 'REFUSED' 
        WHERE id = NEW.id_post; 
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_user_role` AFTER UPDATE ON `report_post` FOR EACH ROW BEGIN
    DECLARE user_id INT;
    DECLARE user_role INT;

    -- Comprobar el estado del reporte
    IF NEW.state_report = 'APPROVED' THEN
        
        -- Obtener el id del usuario del post
        SELECT u.id INTO user_id
        FROM users u
        JOIN posts p ON u.id = p.id_user
        WHERE p.id = NEW.id_post;

        -- Verificar el rol del usuario en modes_has_roles
        SELECT role_id INTO user_role
        FROM model_has_roles
        WHERE model_id = user_id;

        -- Cambiar el rol si es necesario
        IF user_role = 3 THEN
            UPDATE model_has_roles
            SET role_id = 2
            WHERE model_id = user_id;
            
        ELSEIF user_role = 2 THEN
            UPDATE users
            SET banned = true
            WHERE id = user_id;
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `report_post_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `report_post_view` (
`address` varchar(255)
,`capacity` int
,`category` varchar(255)
,`confirmed` int
,`created post` timestamp
,`created_at` timestamp
,`date_event` date
,`description` longtext
,`id` bigint unsigned
,`id_admin` bigint unsigned
,`id_post` bigint unsigned
,`id_user` bigint unsigned
,`name` varchar(255)
,`no_report` int
,`state_publication` enum('ACTIVATED','REFUSED','PENDING','BAN')
,`state_report` enum('APPROVED','REFUSED','PENDING')
,`time_event` time
,`title` varchar(255)
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2024-10-22 06:23:19', '2024-10-22 06:23:19'),
(2, 'user', 'web', '2024-10-22 06:23:19', '2024-10-22 06:23:19'),
(3, 'Publicador', 'web', '2024-10-22 06:23:19', '2024-10-22 06:23:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `no_post` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `banned`, `no_post`) VALUES
(10, 'admin', 'admin@gmail.com', NULL, '$2y$12$aiKARfYoNiuaftNW/yF3MeQWidnQNPa.tbEJShR.roUUvbNM6kFd.', NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-01 23:17:59', '2024-11-01 23:17:59', 0, 0),

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `update_role_on_no_post` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
    -- Verificar si el nuevo valor de `no_report` es 2 y el valor anterior era diferente
    IF NEW.no_post = 2 AND OLD.no_post <> 2 THEN
        -- Actualizar el rol directamente en `model_has_role`
        UPDATE model_has_roles
        SET role_id = 3  -- Cambia `2` por el ID del rol deseado
        WHERE model_id = NEW.id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_report_post`
--

CREATE TABLE `user_report_post` (
  `id` bigint NOT NULL,
  `id_report` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `cause` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `user_report_post`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `user_report_post_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `user_report_post_view` (
`cause` text
,`id` bigint
,`id_report` bigint unsigned
,`id_user` bigint unsigned
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `events_view`
--
DROP TABLE IF EXISTS `events_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `events_view`  AS SELECT `e`.`id_user` AS `user`, `p`.`id` AS `id`, `p`.`id_user` AS `id_user`, `p`.`title` AS `title`, `p`.`date_event` AS `date_event`, `p`.`time_event` AS `time_event`, `p`.`capacity` AS `capacity`, `p`.`confirmed` AS `confirmed`, `p`.`address` AS `address`, `p`.`description` AS `description`, `p`.`id_category` AS `id_category`, `p`.`state_publication` AS `state_publication`, `e`.`created_at` AS `created_at`, `e`.`updated_at` AS `updated_at`, `c`.`category` AS `category` FROM ((`events` `e` join `posts` `p` on((`p`.`id` = `e`.`id_post`))) join `categories` `c` on((`c`.`id` = `p`.`id_category`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `post_view`
--
DROP TABLE IF EXISTS `post_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `post_view`  AS SELECT `p`.`id` AS `id`, `p`.`id_user` AS `id_user`, `p`.`title` AS `title`, `p`.`date_event` AS `date_event`, `p`.`time_event` AS `time_event`, `p`.`capacity` AS `capacity`, `p`.`confirmed` AS `confirmed`, `p`.`address` AS `address`, `p`.`description` AS `description`, `p`.`id_category` AS `id_category`, `p`.`state_publication` AS `state_publication`, `p`.`created_at` AS `created_at`, `p`.`updated_at` AS `updated_at`, `u`.`name` AS `name`, `c`.`category` AS `category` FROM ((`posts` `p` join `users` `u` on((`u`.`id` = `p`.`id_user`))) join `categories` `c` on((`c`.`id` = `p`.`id_category`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `report_post_view`
--
DROP TABLE IF EXISTS `report_post_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `report_post_view`  AS SELECT `r`.`id` AS `id`, `r`.`id_post` AS `id_post`, `r`.`id_admin` AS `id_admin`, `r`.`state_report` AS `state_report`, `r`.`created_at` AS `created_at`, `r`.`no_report` AS `no_report`, `r`.`updated_at` AS `updated_at`, `p`.`id_user` AS `id_user`, `u`.`name` AS `name`, `p`.`title` AS `title`, `p`.`date_event` AS `date_event`, `p`.`time_event` AS `time_event`, `p`.`capacity` AS `capacity`, `p`.`confirmed` AS `confirmed`, `p`.`address` AS `address`, `p`.`description` AS `description`, `p`.`state_publication` AS `state_publication`, `p`.`created_at` AS `created post`, `c`.`category` AS `category` FROM (((`report_post` `r` join `posts` `p` on((`p`.`id` = `r`.`id_post`))) join `users` `u` on((`u`.`id` = `p`.`id_user`))) join `categories` `c` on((`c`.`id` = `p`.`id_category`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `user_report_post_view`
--
DROP TABLE IF EXISTS `user_report_post_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `user_report_post_view`  AS SELECT `ur`.`id` AS `id`, `ur`.`id_report` AS `id_report`, `ur`.`id_user` AS `id_user`, `ur`.`cause` AS `cause`, `u`.`name` AS `name` FROM (`user_report_post` `ur` join `users` `u` on((`u`.`id` = `ur`.`id_user`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_post` (`id_post`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `failed_jobs`
--

--
-- Indices de la tabla `jobs`
--

--
-- Indices de la tabla `job_batches`
--

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id_user_foreign` (`id_user`),
  ADD KEY `posts_id_category_foreign` (`id_category`);

--
-- Indices de la tabla `report_post`
--
ALTER TABLE `report_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_post_id_post_foreign` (`id_post`),
  ADD KEY `report_post_id_admin_foreign` (`id_admin`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_report_post`
--
ALTER TABLE `user_report_post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_report_user` (`id_report`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `report_post`
--
ALTER TABLE `report_post`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `user_report_post`
--
ALTER TABLE `user_report_post`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `report_post`
--
ALTER TABLE `report_post`
  ADD CONSTRAINT `report_post_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_post_id_post_foreign` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_report_post`
--
ALTER TABLE `user_report_post`
  ADD CONSTRAINT `user_report_post_ibfk_1` FOREIGN KEY (`id_report`) REFERENCES `report_post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_report_post_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`%` EVENT `update_status_event` ON SCHEDULE EVERY 1 MINUTE STARTS '2024-10-27 22:27:42' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE events e
    INNER JOIN post p ON p.id = e.id_post
    SET e.status = 'COMPLETED'
    WHERE p.data_event <= NOW() AND e.status = 'UPCOMING';
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
