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
  `updated_at` timestamp NULL DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- ---------------ALTER "user_area_visibility" on 06-06-2018---------------------- 
ALTER TABLE `user_area_visibility` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

-- ---------------ALTER "user_area_visibility" on 13-06-2018----------------------
ALTER TABLE `user_area_visibility` ADD `keyword_id` INT NOT NULL AFTER `user_id`, ADD `keyword_identity` INT NOT NULL AFTER `keyword_id`;

-- ---------------CREATE "keyword_city_client_visibility" on 15-06-2018----------------------
CREATE TABLE `keyword_city_client_visibility` (
  `id` int(11) NOT NULL,
  `keyword` int(11) NOT NULL,
  `keyword_identity` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `keyword_city_client_visibility`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `keyword_city_client_visibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------CREATE "super_categories" on 05-07-2018----------------------
CREATE TABLE `super_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `super_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `super_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------ALTER "super_categories" on 05-07-2018----------------------
ALTER TABLE `super_categories` ADD `image` VARCHAR(191) NOT NULL AFTER `name`;

-- ---------------ALTER "super_categories" on 09-07-2018----------------------
ALTER TABLE `category` ADD `super_category` INT NOT NULL AFTER `id`;

-- ---------------ALTER "category" on 09-07-2018----------------------
ALTER TABLE `category` ADD `image` VARCHAR(191) NULL AFTER `description`;

-- ---------------ALTER "websites_page_head_titles" on 27-07-2018----------------------
ALTER TABLE `websites_page_head_titles` ADD `encoded_params` VARCHAR(191) NULL COMMENT 'encoded parameters with category, subcategory, city and area id' AFTER `page_url`;

-- ---------------ALTER "user_details" on 13-08-2018----------------------
ALTER TABLE `user_details` CHANGE `about_company` `about_company` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

-- ---------------CREATE TABLE `client_enquiries` on 16-08-2018----------------------
CREATE TABLE `client_enquiries` (
  `id` int(11) NOT NULL,
  `client_uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `enquiry` text,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `client_enquiries`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `client_enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `client_enquiries` CHANGE `phone` `phone` VARCHAR(10) NOT NULL;

-- ---------------CREATE TABLE `client_reviews` on 20-08-2018----------------------
CREATE TABLE `client_reviews` (
  `id` int(11) NOT NULL,
  `client_uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `review` text,
  `rating` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `client_reviews`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `client_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------CREATE TABLE `category_enquiries` on 20-08-2018----------------------
CREATE TABLE `category_enquiries` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `enquiry` text,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `category_enquiries`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `category_enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------ALTER TABLE `category_enquiries` on 30-08-2018----------------------
ALTER TABLE `category_enquiries` ADD `identity` INT NOT NULL COMMENT 'If identity is 1 then keyword is category and identity is 2 then keyword is subcategory' AFTER `category_id`;

-- ---------------CREATE TABLE `employees` on 26-10-2018----------------------
CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------CREATE TABLE `client_meetings` on 30-10-2018----------------------
CREATE TABLE `client_meetings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'sales person user is',
  `contact_person` varchar(191) DEFAULT NULL,
  `company` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  `category` varchar(191) DEFAULT NULL COMMENT 'business category',
  `custom_category` varchar(191) DEFAULT NULL,
  `user_location` text COMMENT 'user location from where user submit entry',
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `client_meetings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `client_meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------ALTER TABLE `user_details` on 12-11-2018----------------------
ALTER TABLE `user_details` ADD `created_by` INT NOT NULL COMMENT 'user id who create this user' AFTER `about_company`;
ALTER TABLE `user_details` CHANGE `created_by` `created_by` TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'user id who create this user';

-- ---------------CREATE TABLE `created_by_user_location` on 13-11-2018----------------------
CREATE TABLE `created_by_user_location` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by_user` int(11) NOT NULL,
  `location` text,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `created_by_user_location`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `created_by_user_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------CREATE TABLE `client_assigned_to_sales` on 20-11-2018----------------------
CREATE TABLE `client_assigned_to_sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user_id is client uid',
  `assigned_by` int(11) DEFAULT NULL COMMENT 'support person uid',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'sales person uid',
  `assign_date_time` datetime DEFAULT NULL COMMENT 'meeting date and time',
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `upfated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `client_assigned_to_sales`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `client_assigned_to_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `client_assigned_to_sales` CHANGE `upfated_at` `updated_at` DATETIME NOT NULL;

-- ---------------CREATE TABLE `client_meeting_response` on 27-11-2018----------------------
CREATE TABLE `client_meeting_response` (
  `id` int(11) NOT NULL,
  `cats_id` int(11) NOT NULL COMMENT 'client assign to sales  table row id',
  `possibility` int(11) NOT NULL,
  `follow_up_date` datetime DEFAULT NULL,
  `remark` longtext,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `client_meeting_response`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `client_meeting_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------ALTER TABLE `client_meeting_response` on 28-11-2018----------------------
ALTER TABLE `client_meeting_response` ADD `sales_uid` INT NOT NULL COMMENT 'sales_uid stans for who submitted this response for this meeting' AFTER `id`;

ALTER TABLE `client_meeting_response` ADD `notification_status` BOOLEAN NOT NULL DEFAULT TRUE COMMENT '1 for unseen notification and 0 for seen notification' AFTER `remark`;

-- ---------------ALTER TABLE `client_assigned_to_sales` on 28-11-2018----------------------
ALTER TABLE `client_assigned_to_sales` ADD `notification_status` BOOLEAN NOT NULL DEFAULT TRUE COMMENT '1 for unseen notification and 0 for seen notification' AFTER `assign_date_time`;

-- ---------------ALTER TABLE `users` on 04-12-2018----------------------
ALTER TABLE `users` CHANGE `status` `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 for un-approve user and 1 for active user and 2 for inactive user';

-- ---------------ALTER TABLE `user_details` on 04-12-2018----------------------
ALTER TABLE `user_details` CHANGE `status` `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 for un-approve user and 1 for active user and 2 for inactive user';

-- ---------------ALTER TABLE `user_details` on 04-12-2018----------------------
ALTER TABLE `user_details` CHANGE `created_by` `created_by` TINYINT(1) NULL DEFAULT NULL COMMENT 'user id who create this user / if null then register user himself and if 1 then created by admin else created by others';

-- ---------------ALTER TABLE `user_location` on 04-12-2018----------------------
ALTER TABLE `user_location` CHANGE `status` `status` TINYINT(1) NOT NULL DEFAULT '2' COMMENT '2 for un-approve user and 1 for approve user';

-- ---------------CREATE TABLE `category_suggestions` on 05-12-2018----------------------
CREATE TABLE `category_suggestions` (
  `id` int(11) NOT NULL,
  `category` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 for new category and 0 for seen category',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `category_suggestions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `category_suggestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `category_suggestions` ADD `user_id` INT NOT NULL COMMENT 'suggested user id' AFTER `id`;

-- ---------------ALTER TABLE `client_meeting_response` on 08-12-2018----------------------
ALTER TABLE `client_meeting_response` CHANGE `possibility` `possibility` INT(11) NOT NULL COMMENT '1 for not available and 2 for not visited and 3 for follow up and 4 for deal closed';

-- ---------------CREATE TABLE `blogs` on 10-12-2018----------------------
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` text,
  `content` longtext,
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------ALTER TABLE `user_details` on 22-12-2018----------------------
ALTER TABLE `user_details` ADD `mobile` VARCHAR(15) NULL AFTER `phone`, ADD `whatsapp` VARCHAR(15) NULL AFTER `mobile`;

-- ---------------CREATE TABLE `admin_approvals_for_updates` on 24-12-2018----------------------
CREATE TABLE `admin_approvals_for_updates` (
  `id` int(11) NOT NULL,
  `update_by` int(11) NOT NULL COMMENT 'user id who update informations',
  `fields` text COMMENT 'fields to be update',
  `notification_status` tinyint(1) NOT NULL COMMENT '1 for not approved and 0 for approved by admin',
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `admin_approvals_for_updates`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin_approvals_for_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ---------------ALTER TABLE `admin_approvals_for_updates` on 26-12-2018----------------------
ALTER TABLE `admin_approvals_for_updates` ADD `client_uid` INT NULL COMMENT 'client / user uid who is updated' AFTER `update_by`;

-- ---------------ALTER TABLE `category_suggestions` on 04-01-2019----------------------
ALTER TABLE `category_suggestions` CHANGE `user_id` `user_id` INT(11) NOT NULL COMMENT 'suggested by user id';
ALTER TABLE `category_suggestions` ADD `client_uid` INT NOT NULL COMMENT 'suggested for user id' AFTER `user_id`;

-- ---------------ALTER TABLE `admin_approvals_for_updates` on 09-01-2019----------------------
ALTER TABLE `admin_approvals_for_updates` CHANGE `status` `status` TINYINT(1) NOT NULL COMMENT '1 for update basic information and 2 for update payment modes and 3 for update business timing and 4 for update image information';

-- ---------------ALTER TABLE `client_reviews` on 20-02-2019----------------------
ALTER TABLE `client_reviews` CHANGE `phone` `phone` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `client_reviews` CHANGE `rating` `rating` FLOAT NULL DEFAULT NULL;