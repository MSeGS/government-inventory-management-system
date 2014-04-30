INSERT INTO `stores` (`id`, `department_id`, `store_code`, `created_at`, `updated_at`)
VALUES
	(1, 1, 'ATI', '2014-04-30 13:50:02', '2014-04-30 13:50:02');

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `store_id`, `email_id`, `phone_no`, `address`, `department_id`, `designation`, `created_at`, `updated_at`)
VALUES
	(2, 'ATI Admin', 'ati_admin', '$2y$10$LnyQlxVpA1SKrNgnOTKO3uBePWLsQOLuIsJPP2keB75euh.tFUwPy', '{\"home.index\":1,\"category.create\":1,\"category.index\":1,\"category.edit\":1,\"category.store\":1,\"category.update\":1,\"category.destroy\":1,\"damage.manage\":1,\"damage.approve\":1,\"damage.decline\":1,\"login\":1,\"login.submit\":1,\"logout\":1,\"message.index\":1,\"message.outbox\":1,\"message.read\":1,\"message.show\":1,\"message.store\":1,\"product.index\":1,\"product.edit\":1,\"product.update\":1,\"product.destroy\":1,\"product.store\":1,\"setting.index\":1,\"setting.edit\":1,\"setting.update\":1,\"setting.destroy\":1,\"setting.store\":1,\"user.index\":1,\"user.edit\":1,\"user.update\":1,\"user.destroy\":1,\"user.profile\":1,\"user.profileUpdate\":1,\"user.store\":1,\"stock.create\":1,\"stock.index\":1,\"stock.store\":1,\"stock.edit\":1,\"stock.update\":1,\"stock.destroy\":1}', 1, NULL, NULL, '2014-04-30 13:27:13', '$2y$10$SCZ89Pp5BEV4SHNstLHaLuegLoVamYw9Hwj/Iy8dA2OwpunZkBvPG', NULL, 1, 'ati_admin@mail.com', '123', '#add', 1, 'desg', '2014-04-30 12:16:29', '2014-04-30 13:27:13'),
	(3, 'ATI Indentor', 'ati_indentor', '$2y$10$5MZdDN9qrvK7Tbp1JOLYoOFIQUSnO2o0zgUCzGNxyB07uR1r7M2v.', '{\"home.index\":1,\"login\":1,\"login.submit\":1,\"logout\":1,\"help\":1,\"help.index\":1,\"indent.create\":1,\"indent.mine\":1,\"indent.store\":1,\"reset-password\":1,\"retrieve-username\":1}', 1, NULL, NULL, '2014-04-30 13:28:27', '$2y$10$jrsWO4HdXcJkknIvxBOv2OxbPw6IqUtCmk2w1XtFrfxyE0YiVuuDu', NULL, 1, 'email@mail.com', '123', '#add', 1, 'desg', '2014-04-30 13:27:54', '2014-04-30 13:28:27'),
	(4, 'ATI Store Keeper', 'ati_store', '$2y$10$WEMSlQcd3nl5eicpE9a6PeYiJywqzRieqN2r5Ah.qhwQgZHdYjFSm', '{\"home.index\":1,\"login\":1,\"login.submit\":1,\"logout\":1,\"help\":1,\"help.index\":1,\"reset-password\":1,\"retrieve-username\":1,\"damage.index\":1,\"damage.create\":1,\"damage.trash\":1,\"damage.delete\":1,\"damage.update\":1,\"damage.restore\":1,\"damage.store\":1,\"damage.destroy\":1}', 1, NULL, NULL, '2014-04-30 13:34:52', '$2y$10$XKVxB447s/SJBxHV01VvL.QiB0cloUZH.O2scUKxZyaVChuMTFzei', NULL, 1, 'email@mail.com', '123', '#add', 1, 'desg', '2014-04-30 13:28:18', '2014-04-30 13:34:52');

INSERT INTO `users_groups` (`user_id`, `group_id`)
VALUES
	(2, 1),
	(2, 3),
	(3, 1),
	(3, 4),
	(4, 1),
	(4, 5);
	
-- Create syntax for TABLE 'store1_categories'
CREATE TABLE `store1_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Create syntax for TABLE 'store1_damages'
CREATE TABLE `store1_damages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('approved','pending','declined') COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `reported_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Create syntax for TABLE 'store1_indent_requirements'
CREATE TABLE `store1_indent_requirements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `indent_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `status` enum('procured','pending','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Create syntax for TABLE 'store1_indents'
CREATE TABLE `store1_indents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `indentor_id` int(11) NOT NULL,
  `indent_date` datetime NOT NULL,
  `status` enum('pending_approval','approved','partial_dispatched','dispatched','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending_approval',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Create syntax for TABLE 'store1_indents_items'
CREATE TABLE `store1_indents_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `indent_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplied` int(11) NOT NULL DEFAULT '0',
  `status` enum('approved','rejected') COLLATE utf8_unicode_ci NOT NULL,
  `indent_reason` text COLLATE utf8_unicode_ci,
  `reject_reason` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Create syntax for TABLE 'store1_notifications'
CREATE TABLE `store1_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `read_at` datetime NOT NULL,
  `status` enum('unread','read') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Create syntax for TABLE 'store1_options'
CREATE TABLE `store1_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_key` text COLLATE utf8_unicode_ci NOT NULL,
  `option_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Create syntax for TABLE 'store1_products'
CREATE TABLE `store1_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `reserved_amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Create syntax for TABLE 'store1_stocks'
CREATE TABLE `store1_stocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `store1_categories` (`id`, `category_name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1, 'Uncategorized', '2014-04-30 13:50:03', '2014-04-30 13:50:03', NULL),
	(2, 'Stationery', '2014-04-16 04:34:13', '2014-04-16 04:34:13', NULL),
	(3, 'Furniture', '2014-04-16 06:00:58', '2014-04-16 06:00:58', NULL),
	(4, 'Electrical Goods', '2014-04-16 06:15:01', '2014-04-16 06:15:01', NULL);

INSERT INTO `store1_products` (`id`, `category_id`, `name`, `description`, `reserved_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Attendance Register', '', 2, '2014-04-16 04:59:36', '2014-04-16 04:59:36', NULL),
(2, 2, 'Ballpen', '', 2, '2014-04-16 04:59:36', '2014-04-16 04:59:36', NULL),
(3, 2, 'Ballpen Refill', '', 2, '2014-04-16 04:59:36', '2014-04-16 04:59:36', NULL),
(4, 2, 'Clipboard', '', 2, '2014-04-16 04:59:36', '2014-04-16 04:59:36', NULL),
(5, 2, 'Candlestick', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(6, 2, 'Calling Bell', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(7, 2, 'Counting sponge', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(8, 2, 'Confidential Cover', 'Laminate', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(9, 2, 'Envelope', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(10, 2, 'Pencil', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(11, 2, 'Eraz-ex', 'Correcting Fluid', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(12, 2, 'Eraser/Rubber', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(13, 2, 'File tag', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(14, 2, 'Looking Glass/Mirror', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(15, 2, 'Knife', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(16, 2, 'Cellotape', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(17, 2, 'Blacktape', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(18, 2, 'Stickpad/pagemaker', '', 2, '2014-04-16 05:10:17', '2014-04-16 05:10:17', NULL),
(19, 2, 'Napkin', '', 2, '2014-04-16 05:11:38', '2014-04-16 05:11:38', NULL),
(20, 2, 'Markin Cloth', '', 2, '2014-04-16 05:11:38', '2014-04-16 05:11:38', NULL),
(21, 2, 'File Cover', '', 2, '2014-04-16 05:11:38', '2014-04-16 05:11:38', NULL),
(22, 2, 'File Board', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(23, 2, 'Cover File', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(24, 2, 'Cup & Saucer', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(25, 2, 'Tea cup', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(26, 2, 'Tea Tray', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(27, 2, 'Flask', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(28, 2, 'Tea Coaster', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(29, 2, 'File Tray', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(30, 2, 'Borosil Jug', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(31, 2, 'Borosil Glass', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(32, 2, 'Plastic Jug', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(33, 2, 'Glass Tumbler', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(34, 2, 'Bucket', 'Big', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(35, 2, 'Bucket', 'Medium', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(36, 2, 'Mug', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(37, 2, 'Broom', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(38, 2, 'Dustpan', '', 2, '2014-04-16 05:17:02', '2014-04-16 05:17:02', NULL),
(39, 2, 'Waste Paper Basket', '', 2, '2014-04-16 05:25:20', '2014-04-16 05:25:20', NULL),
(40, 2, 'Carpet brush', '', 2, '2014-04-16 05:25:20', '2014-04-16 05:25:20', NULL),
(41, 2, 'Plastic Folder', '', 2, '2014-04-16 05:25:20', '2014-04-16 05:25:20', NULL),
(42, 2, 'Peon Book', '', 2, '2014-04-16 05:25:20', '2014-04-16 05:25:20', NULL),
(43, 2, 'Pin Box/Pin Cushion', '', 2, '2014-04-16 05:25:20', '2014-04-16 05:25:20', NULL),
(44, 2, 'Poker', '', 2, '2014-04-16 05:25:20', '2014-04-16 05:25:20', NULL),
(45, 2, 'Penstand', '', 2, '2014-04-16 05:25:20', '2014-04-16 05:25:20', NULL),
(46, 2, 'Paper-weight', '', 2, '2014-04-16 05:29:31', '2014-04-16 05:29:31', NULL),
(47, 2, 'Pencil Battery', '', 2, '2014-04-16 05:29:31', '2014-04-16 05:29:31', NULL),
(48, 2, 'Scissors', '', 2, '2014-04-16 05:29:31', '2014-04-16 05:29:31', NULL),
(49, 2, 'Sealing Wax', '', 2, '2014-04-16 05:29:31', '2014-04-16 05:29:31', NULL),
(50, 2, 'Scale/Ruler', '', 2, '2014-04-16 05:29:31', '2014-04-16 05:29:31', NULL),
(51, 2, 'Staple Machine', 'Big', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(52, 2, 'Staple Machine', 'Small', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(53, 2, 'Staple Pin', 'Big', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(54, 2, 'Staple Pin', 'Small', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(55, 2, 'Short Hand Note Book', '', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(56, 2, 'Stampad', '', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(57, 2, 'Stampad Ink', '', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(58, 2, 'Signature Pad', '', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(59, 2, 'Dak Pad', '', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(60, 2, 'marker', '', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(61, 2, 'Gluestick', '', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(62, 2, 'Flag Rope', '', 2, '2014-04-16 05:32:39', '2014-04-16 05:32:39', NULL),
(63, 2, 'Bound Register No.30', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(64, 2, 'Bound Register No.20', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(65, 2, 'Bound Register No.10', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(66, 2, 'Bound Register No.6', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(67, 2, 'Calculator', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(68, 2, 'Guard File', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(69, 2, 'Ring File', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(70, 2, 'Paper Pin', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(71, 2, 'Paper Clip', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(72, 2, 'Gum/Paste', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(73, 2, 'Gel/Cello Pen', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(74, 2, 'Gel/Cello Refill', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(75, 2, 'Xerox Paper A3', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(76, 2, 'Xerox Paper A4', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(77, 2, 'Xerox Paper F.S', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(78, 2, 'DFC', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(79, 2, 'Notesheet(Printed)', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(80, 2, 'Notesheet(Blank)', '', 2, '2014-04-16 05:43:51', '2014-04-16 05:43:51', NULL),
(81, 2, 'Towel', 'Big', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(82, 2, 'Towel', 'Small', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(83, 2, 'Top Glass', 'Big', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(84, 2, 'Top Glass', 'Small', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(85, 2, 'Wall Clock', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(86, 2, 'Highliter', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(87, 2, 'Fevicol Tube', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(88, 2, 'Peon Bag', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(89, 2, 'Doormat', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(90, 2, 'Water Filter', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(91, 2, 'Filter Candle', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(92, 2, 'Harpic', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(93, 2, 'Odonil', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(94, 2, 'Wheel/Vim', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(95, 2, 'Soap', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(96, 2, 'Toilet Soap', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(97, 2, 'Clean Angel/Phenyle/Digicline', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(98, 2, 'Nawhfe', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(99, 2, 'Umbrella', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(100, 2, 'Lock & Key', '', 2, '2014-04-16 05:49:47', '2014-04-16 05:49:47', NULL),
(101, 3, 'Almirah(B)', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(102, 3, 'Almirah(S)', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(103, 3, 'Table T-8', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(104, 3, 'Table T-9', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(105, 3, 'Table T-104', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(106, 3, 'Staff Chair', 'CH 7B', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(107, 3, 'Revolving Chair', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(108, 3, 'Centre Table', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(109, 3, 'Side Table', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(110, 3, 'Computer Table', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(111, 3, 'Computer Chair', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(112, 3, 'Steel Book Case', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(113, 3, 'Table Top', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(114, 3, 'Sofa Set', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(115, 3, 'Sofa Cover', '', 1, '2014-04-16 06:10:51', '2014-04-16 06:10:51', NULL),
(116, 3, 'Partition Wall Frame', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(117, 3, 'File Rack', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(118, 3, 'Stool', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(119, 3, 'Footrest', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(120, 3, 'Coat Hunger', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(121, 3, 'Plastic Chair', 'Arm', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(122, 3, 'Plastic Chair', 'Armless', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(123, 3, 'Ornate Chair', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(124, 3, 'Woolen Carpet', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(125, 3, 'Linoleum Carpet', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(126, 3, 'Cushion', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(127, 3, 'Cushion Cover', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(128, 3, 'Curtain', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(129, 3, 'Curtain Rod', '', 1, '2014-04-16 06:14:47', '2014-04-16 06:14:47', NULL),
(130, 4, 'E. Bell', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(131, 4, 'Bell Push', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(132, 4, 'Bell Box', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(133, 4, 'PVC Wire', '1.5', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(134, 4, 'PVC Wire', '2.5', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(135, 4, 'Flexible Wire', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(136, 4, 'Cut Out', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(137, 4, 'Electronic Choke', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(138, 4, 'E. Tube', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(139, 4, 'Tube Frame', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(140, 4, 'Plug', 'SSC', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(141, 4, 'E. Bulb', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(142, 4, 'Holder', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(143, 4, 'E. Switch', '', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(144, 4, 'Multi-plug', '16 amp', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(145, 4, 'Multi-plug', '6 amp', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(146, 4, 'Switchboard', '6x4', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(147, 4, 'Switchboard', '7x6', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(148, 4, 'Switchboard', '6x8', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(149, 4, 'Plug', '5 amp', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(150, 4, 'Plug Pin', '5 amp', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(151, 4, 'Plug', '3 Pin Top', 1, '2014-04-16 06:22:59', '2014-04-16 06:22:59', NULL),
(152, 4, 'Three Pin', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(153, 4, 'Two Pin', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(154, 4, 'PLL Tube', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(155, 4, 'Cassing & Capping', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(156, 4, 'Fan Regulator', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(157, 4, 'Ceiling Fan', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(158, 4, 'Wall Fan', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(159, 4, 'Floor Fan', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(160, 4, 'Table Fan', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(161, 4, 'MCB', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL),
(162, 4, 'Remote Bell', '', 1, '2014-04-16 06:25:10', '2014-04-16 06:25:10', NULL);
