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

  -- ---------------------------DB Start on 31-03-2018--------------------------
  ALTER TABLE `areas` ADD `pincode` INT(6) NOT NULL AFTER `area`;

  -- ---------------------------DB Start on 02-08-2018--------------------------
  ALTER TABLE `user_details` ADD `about_company` TEXT NOT NULL AFTER `logo`;

  -- ---------------------------ALTER TABLE `user_details` CHANGE on 22-01-2019--------------------------
  ALTER TABLE `user_details` CHANGE `created_by` `created_by` INT(1) NULL DEFAULT NULL COMMENT 'user id who create this user / if null then register user himself and if 1 then created by admin else created by others';