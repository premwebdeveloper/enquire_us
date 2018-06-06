-- ---------------------------DB Start on 18-01-2018--------------------------

-- ---------------------------Create Table 'password_resets' on 18-01-2018--------------------------
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------Create Table 'user_roles' on 18-01-2018--------------------------
CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ---------------------------Update Table 'user_details' on 30-01-2018--------------------------
ALTER TABLE `user_details` ADD `designation` VARCHAR(255) NULL AFTER `name`;

ALTER TABLE `user_details` ADD `landline` VARCHAR(15) NULL AFTER `email`, ADD `fax1` VARCHAR(15) NULL AFTER `landline`, ADD `fax2` VARCHAR(15) NULL AFTER `fax1`, ADD `toll_free1` VARCHAR(15) NULL AFTER `fax2`, ADD `toll_free2` VARCHAR(15) NULL AFTER `toll_free1`, ADD `website` VARCHAR(255) NULL AFTER `toll_free2`;

-- ---------------------------CREATE Table 'user_location' on 30-01-2018--------------------------
CREATE TABLE `user_location` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_name` varchar(1000) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user_location`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------------------CREATE Table 'user_other_information' on 30-01-2018--------------------------
CREATE TABLE `user_other_information` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `operation_timing` int(11) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `working_status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user_other_information`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_other_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------------------CREATE Table 'user_company_information' on 30-01-2018--------------------------
CREATE TABLE `user_company_information` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `year_establishment` varchar(255) DEFAULT NULL,
  `annual_turnover` varchar(255) DEFAULT NULL,
  `no_of_emps` varchar(255) DEFAULT NULL,
  `professional_associations` varchar(255) DEFAULT NULL,
  `certifications` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user_company_information`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_company_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------------------ALTER Table 'user_location' on 31-01-2018--------------------------
ALTER TABLE `user_location` CHANGE `status` `status` TINYINT(1) NOT NULL DEFAULT '2';

-- ---------------------------ALTER Table 'user_details' on 01-02-2018--------------------------
ALTER TABLE `user_details` ADD `logo` VARCHAR(255) NULL AFTER `phone`;

-- ---------------------------CREATE Table 'user_images' on 01-02-2018--------------------------
CREATE TABLE `user_images` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_images` CHANGE `image` `image` VARCHAR(255) NULL DEFAULT NULL;

-- ---------------------------CREATE Table 'user_keywords' on 14-02-2018--------------------------
CREATE TABLE `user_keywords` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user_keywords`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------------------CREATE Table 'areas' on 14-02-2018--------------------------
CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `area` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------------------ALTER Table 'user_keywords' on 20-02-2018--------------------------
ALTER TABLE `user_keywords` DROP `subcat_id`;
ALTER TABLE `user_keywords` CHANGE `cat_id` `keyword_id` INT(11) NOT NULL;
ALTER TABLE `user_keywords` ADD `keyword_identity` INT NOT NULL AFTER `keyword_id`;

-- ---------------------------CREATE Table 'websites_page_head_titles' on 19-03-2018--------------------------
CREATE TABLE `websites_page_head_titles` (
  `id` int(11) NOT NULL,
  `page` varchar(1255) NOT NULL,
  `title` text,
  `keyword` text,
  `description` text,
  `canonical` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `websites_page_head_titles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `websites_page_head_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------------------ALTER Table 'websites_page_head_titles' on 19-03-2018--------------------------
ALTER TABLE `websites_page_head_titles` ADD `business_page` VARCHAR(255) NULL AFTER `page`;
ALTER TABLE `websites_page_head_titles` CHANGE `page` `page` VARCHAR(1255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

-- ---------------------------ALTER Table 'websites_page_head_titles' on 31-03-2018--------------------------
ALTER TABLE `websites_page_head_titles` ADD `page_url` VARCHAR(1055) NULL AFTER `business_page`;

-- ---------------------------ALTER Table 'website_pages' on 12-04-2018--------------------------
ALTER TABLE `website_pages` CHANGE `page_description` `page_description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

-- ---------------------------CREATE TABLE `subscribers` on 12-04-2018--------------------------
CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

-- ---------------------------CREATE TABLE `roles` on 19-04-2018--------------------------
CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2018-04-18 18:30:00', '2018-04-18 18:30:00'),
(2, 'user', '2018-04-18 18:30:00', '2018-04-18 18:30:00'),
(3, 'support', '2018-04-19 13:30:00', '2018-04-19 13:30:00'),
(4, 'listing', '2018-04-19 13:30:00', '2018-04-19 13:30:00'),
(5, 'seo', '2018-04-19 12:30:00', '2018-04-19 12:30:00'),
(6, 'role6', '2018-04-19 11:30:00', '2018-04-19 10:30:00'),
(7, 'role7', '2018-04-19 13:30:00', '2018-04-19 13:30:00'),
(8, 'role8', '2018-04-19 13:30:00', '2018-04-19 13:30:00'),
(9, 'role9', '2018-04-19 13:30:00', '2018-04-19 13:30:00'),
(10, 'role10', '2018-04-19 13:30:00', '2018-04-19 13:30:00');

ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

-- ---------------------------ALTER TABLE `category` on 24-04-2018--------------------------
ALTER TABLE `category` ADD `description` LONGTEXT NULL AFTER `category`;

-- ---------------------------ALTER TABLE `subcategory` on 24-04-2018--------------------------
ALTER TABLE `subcategory` ADD `description` LONGTEXT NULL AFTER `subcategory`;


-- ---------------------------ALTER multiple TABLES with "update_status" on 04-05-2018--------------------------
ALTER TABLE `user_company_information` ADD `update_status` TINYINT(1) NOT NULL DEFAULT '1' AFTER `updated_at`;
ALTER TABLE `user_details` ADD `update_status` TINYINT(1) NOT NULL DEFAULT '1' AFTER `updated_at`;
ALTER TABLE `user_images` ADD `update_status` TINYINT(1) NOT NULL DEFAULT '1' AFTER `image`;
ALTER TABLE `user_keywords` ADD `update_status` TINYINT(1) NOT NULL DEFAULT '1' AFTER `updated_at`;
ALTER TABLE `user_location` ADD `update_status` TINYINT(1) NOT NULL DEFAULT '1' AFTER `updated_at`;
ALTER TABLE `user_other_information` ADD `update_status` TINYINT(1) NOT NULL DEFAULT '1' AFTER `updated_at`;
ALTER TABLE `websites_page_head_titles` ADD `update_status` TINYINT(1) NOT NULL DEFAULT '1' AFTER `updated_at`;

-- ---------------------------ALTER "websites_page_head_titles" on 08-05-2018----------------------
ALTER TABLE `websites_page_head_titles` ADD `category` INT NOT NULL AFTER `page`, ADD `subcategory` INT NULL AFTER `category`, ADD `city` INT NOT NULL AFTER `subcategory`, ADD `area` INT NULL AFTER `city`;
ALTER TABLE `websites_page_head_titles` DROP `page`;
ALTER TABLE `websites_page_head_titles` CHANGE `category` `category` INT(11) NULL, CHANGE `city` `city` INT(11) NULL;

-- ---------------------------ALTER "user_location" on 15-05-2018----------------------
ALTER TABLE `user_location` CHANGE `area` `area` INT NULL DEFAULT NULL, CHANGE `city` `city` INT NULL DEFAULT NULL;

-- ---------------CREATE "user_area_visibility" on 04-06-2018----------------------
CREATE TABLE `user_area_visibility` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) DEFAULT NULL,
  `city` int(11) NOT NULL,
  `area` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user_area_visibility`
  ADD PRIMARY KEY (`id`);

-- ---------------ALTER "user_area_visibility" on 05-06-2018----------------------  
ALTER TABLE `user_area_visibility` DROP `category`, DROP `subcategory`, DROP `city`;