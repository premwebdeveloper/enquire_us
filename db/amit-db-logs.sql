-- ---------------------------DB Start on 19-01-2018--------------------------

CREATE TABLE `user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


  ALTER TABLE `users` ADD `phone` VARCHAR(10) NOT NULL AFTER `email`;
  ALTER TABLE `users` ADD `verify_token` VARCHAR(40) NULL AFTER `remember_token`;
  ALTER TABLE `users` ADD `status` TINYINT(1) NOT NULL DEFAULT '0' AFTER `updated_at`;

  -- ---------------------------DB Start on 20-01-2018--------------------------