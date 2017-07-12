<?php

use yii\db\Migration;

class m170711_144752_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->execute("
   CREATE TABLE IF NOT EXISTS `admin` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`customer_name`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`))
  ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;
  INSERT INTO `admin` (`id`, `customer_name`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'a_Pg80ZYazUim__JJQLzfAXZAQaLVulH', '$2y$13\$P9B8tv.ZBsBiU/Jk5HTD5e0P3Kid4.VWfnEsdT1mv8.uujJ.8YVvG', NULL, 'a@a.com', 1, 1494515023, 1494515023);

CREATE TABLE IF NOT EXISTS `counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `finish_value` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8 COMMENT='количество счетчиков с их стартовыми значениями';

INSERT INTO `counter` (`id`, `house_id`, `created_at`, `value`, `finish_value`, `garden_id`) VALUES
	(175, 196, 'Sun Jun 11 2017 18:25:34 GMT+0300 (EEST)', 111, 0, 1),
	(176, 197, 'Sun Jun 11 2017 18:26:32 GMT+0300 (EEST)', 222, 0, 2),
	(177, 196, 'Sun Jun 11 2017 18:28:02 GMT+0300 (EEST)', 1, 0, 1),
	(178, 197, 'Sun Jun 11 2017 18:28:15 GMT+0300 (EEST)', 2, 0, 2),
	(179, 198, 'Mon Jun 12 2017 17:42:54 GMT+0300 (EEST)', 2, 0, 2),
	(180, 199, 'Mon Jun 12 2017 17:43:13 GMT+0300 (EEST)', 22, 0, 2),
	(181, 200, 'Mon Jun 12 2017 17:43:37 GMT+0300 (EEST)', 222, 0, 2),
	(182, 201, 'Mon Jun 12 2017 17:44:09 GMT+0300 (EEST)', 11, 0, 1),
	(183, 202, 'Mon Jun 12 2017 17:44:25 GMT+0300 (EEST)', 111, 0, 1),
	(184, 196, 'Mon Jun 12 2017 17:46:09 GMT+0300 (EEST)', 1, 0, 1),
	(185, 203, 'Mon Jun 12 2017 17:47:18 GMT+0300 (EEST)', 1, 0, 1),
	(186, 204, 'Mon Jun 12 2017 17:59:59 GMT+0300 (EEST)', 3, 0, 3);

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`customer_name`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `customer` (`id`, `customer_name`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `garden_id`) VALUES
	(1, 'Endry', 'VvDjgIimgfsvQP4nHrwcsJey_-vmkIgb', '$2y$13\$KdNSYOuclaq91UxEAjNp1unpXgX3al/k3fcmVdRSAVCczLnDvwySm', NULL, 'a@a.com', 1, 1494515023, 1494943861, 2),
	(2, 'Anton', 'eFwuich314yKRT_wNZAmXVmnwRVyW7ko', '$2y$13$1YJeY88kE3bSyALUsjAgWOh6eYBynxOIbFkQTtEWjLTwyGfcI1Baq', NULL, 'a1@a.com', 1, 1494604123, 1499694717, 2),
	(4, '12123', 'MZozQA0PLgZCiLMNG4dAle48w0TxdbTS', '$2y$13\$l/Yw8co8LC55QgyW5Po/WOWYFBvV5QbNtQi/WRheRy2qfF47ibwj6', NULL, 'a121@1234.com', 1, 1494946216, 1495636999, 3),
	(8, '12121', 'C7VqwnhHnoX8uZYnI8jvzHyd642CbjfU', '$2y$13$2f9pxqr8FaMPilITsTGWPeVF51u9R.jG0wvxD2ZZwyp.e3TRY9O4q', NULL, 'a12111@1234.com', 1, 1495636877, 1498236569, 8),
	(9, '121113', 'XAA2dF6JDshT0rEZkc4n9YRTI0wDuVJE', '$2y$13\$ZajAN1RWuaZqVQ//Q8sqhu36Gw2s4FFkYv5T1x5iAVmoDQG0idSZm', NULL, 'a1@123423244.com', 1, 1495637019, 1498236639, 6),
	(10, '1142414162', 'OjbOdfhQK__a4GvdlpIcBzzEqmKIsLWh', '$2y$13\$jT6E9sILmS3CXNqFiZQrluXUAaP0oF5Hj1pqZNdwX4t6OL1giU4ei', NULL, 'a1211@12534.com', 1, 1495638305, 1498474043, 6),
	(11, '123', '-dPS7E7rbsyVS6-LkXGFg1dOLkOHFBOx', '$2y$13\$jILPwYWeJltvrCuw81oI2.LItmf5Bqn4hX2oImY/mTEs5FWUqicF2', NULL, 'a1@aaa.com', 1, 1496309851, 1496309851, 6),
	(14, 'asasDa', 'PEUz4_qebX7YIq7uFZZ4xWu-kdDdzLPk', '$2y$13$2E6gyeGXoYcVecV/KP5TZui/OtE8QlhvOjVH8l9ln9K4PX4rTEXr2', NULL, 'a1434@aaa.com', 1, 1497531379, 1497531379, 2),
	(17, '2222222', 'U4EAA0ucfbdeqy6rNjHuruO2KdkJM-MP', '$2y$13\$g8uf6Ytz5Yv8jKZb4MfIFeTceS1tTimBbIxumEfYhdvML0.JQ2u0e', NULL, '222@1234.com', 1, 1498053025, 1498124311, 8),
	(18, 'saDSAD', 'a_Pg80ZYazUim__JJQLzfAXZAQaLVulH', '$2y$13\$P9B8tv.ZBsBiU/Jk5HTD5e0P3Kid4.VWfnEsdT1mv8.uujJ.8YVvG', NULL, 'DSADW@DSADS.COM', 0, 1499343295, 1499343295, 10),
	(19, '1223', 'rWnmOW5FtYSOQfeRPUPPF0gUafDbx8I0', '$2y$13\$jxqfXyC8wlikISSCnJqat.DZQkk5BB7oLK6b2iWUxxhCFOuRXCiou', NULL, '12@sadsa.com', 1, 1499772665, 1499772665, 35);

CREATE TABLE IF NOT EXISTS `customer_ammount_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  `operation` tinyint(1) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `operation_money` float NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

INSERT INTO `customer_ammount_history` (`id`, `customer_id`, `garden_id`, `operation`, `admin`, `operation_money`, `created_at`) VALUES
	(1, 1, 1, 1, 'aa', 12, 1213421432),
	(5, 10, 3, 1, 'Admin', 24.13, 1497436931),
	(6, 10, 6, 1, 'Admin', 1, 1497436980),
	(7, 8, 1, 1, 'Admin', 1.23, 1497437093),
	(8, 10, 3, 1, 'Admin', 1, 1497438987),
	(11, 2, 6, 0, 'Robot', 9, 1497885909),
	(22, 10, 1, 0, 'Robot', 0, 1497886951),
	(23, 17, 3, 1, 'Admin', 1.1, 1498141083),
	(24, 17, 6, 1, 'Admin', 1.1, 1498141179),
	(25, 17, 1, 1, 'Admin', 0.1, 1498143236),
	(26, 10, 3, 0, 'Admin', -1, 1498143560),
	(27, 10, 6, 1, 'Admin', 2, 1498145281),
	(28, 10, 6, 0, 'Admin', -2, 1498145397),
	(29, 10, 6, 1, 'Admin', 1, 1498213984),
	(30, 0, 1, 0, 'Robot', 6, 1499167520),
	(31, 10, 6, 1, 'Admin', 1, 1499169732),
	(32, 10, 6, 1, 'Admin', 1, 1499173599),
	(33, 9, 6, 0, 'Admin', -5, 1499173704),
	(34, 0, 2, 0, 'Robot', 9, 1499173895),
	(35, 2, 2, 1, 'Admin', 20, 1499175815),
	(36, 2, 2, 1, 'Admin', 20, 1499175860),
	(37, 10, 6, 1, 'Admin', 1, 1499182859),
	(38, 0, 1, 0, 'Robot', 9, 1499773133),
	(39, 0, 1, 0, 'Robot', 9, 1499773171);

CREATE TABLE IF NOT EXISTS `garden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garden_name` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `money` float NOT NULL DEFAULT '0',
  `till_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Name` (`garden_name`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

INSERT INTO `garden` (`id`, `garden_name`, `status`, `created_at`, `updated_at`, `money`, `till_date`) VALUES
	(1, 'АКБА', 1, 1496070234, 1499773171, -8, '2017-08-01 21:00:00'),
	(2, 'Лесное', 1, 1496070234, 1499175860, -1, '2017-08-03 06:00:00'),
	(3, 'Попасное', 1, 1496070234, 1499097320, 0.9, '2017-08-03 03:00:00'),
	(6, 'Кукушкино', 1, 1496070234, 1499182859, 17, '2017-08-03 03:00:00'),
	(8, 'Ляля', 1, 1496070234, 1499097321, 1, '2017-08-03 03:00:00'),
	(10, '1', 1, 1496070234, 1499097321, 1, '2017-08-03 03:00:00'),
	(23, '2', 1, 1498734607, 1499097321, 0, '2017-08-03 03:00:00'),
	(24, '3', 1, 1498734616, 1499097321, 0, '2017-08-03 03:00:00'),
	(25, '4', 1, 1498734627, 1499097321, 0, '2017-08-03 03:00:00'),
	(26, '5', 1, 1498734637, 1499097321, 0, '2017-08-03 03:00:00'),
	(27, '6', 1, 1498734647, 1499097321, 0, '2017-08-03 20:15:30'),
	(28, '7', 1, 1498734658, 1499097321, 0, '2017-08-03 03:00:00'),
	(29, '8', 1, 1498734668, 1499097321, 0, '2017-08-03 03:00:00'),
	(30, '9', 1, 1498734676, 1499097321, 0, '2017-08-03 03:00:00'),
	(31, '10', 1, 1498734687, 1499097321, 0, '2017-08-03 03:00:00'),
	(32, '11', 1, 1498734698, 1499097321, 0, '2017-08-03 03:00:00'),
	(33, '12', 1, 1498734709, 1499097321, 0, '2017-08-03 03:00:00'),
	(34, '13', 1, 1498734722, 1499097321, 0, '2017-08-03 03:00:00'),
	(35, '14', 1, 1498734731, 1499097321, 0, '2017-08-03 03:00:00'),
	(36, '15', 1, 1498734742, 1499097321, 0, '2017-08-03 03:00:00'),
	(37, '16', 1, 1498734753, 1499097321, 0, '2017-08-03 03:00:00');

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `spent` int(11) NOT NULL,
  `last_indication` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

INSERT INTO `group` (`id`, `title`, `spent`, `last_indication`, `garden_id`) VALUES
	(51, '2x', 0, 0, 2),
	(50, '1x', 20, 120, 1),
	(52, '2y', 0, 0, 2),
	(53, '2z', 0, 0, 2),
	(54, '1y', 0, 0, 1),
	(55, '1z', 0, 0, 1),
	(56, '3w', 0, 0, 3),
	(57, '3q', 0, 0, 3);

CREATE TABLE IF NOT EXISTS `group_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='счетчики на группу с их стартовыми значениями';

INSERT INTO `group_counter` (`id`, `group_id`, `created_at`, `value`, `garden_id`) VALUES
	(53, 50, 'Mon Jun 12 2017 17:53:23 GMT+0300 (EEST)', 100, 1);

CREATE TABLE IF NOT EXISTS `group_testimony` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_counter_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 COMMENT='показания счетчика на группу';

INSERT INTO `group_testimony` (`id`, `group_counter_id`, `created_at`, `value`, `garden_id`) VALUES
	(146, 53, 'Mon Jun 12 2017 17:53:23 GMT+0300 (EEST)', 100, 1),
	(147, 53, 'Mon Jun 12 2017 17:53:28 GMT+0300 (EEST)', 120, 1);

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `pay` int(11) NOT NULL,
  `testimony` int(11) NOT NULL,
  `tariff` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `start_indication` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

INSERT INTO `history` (`id`, `house_id`, `date`, `pay`, `testimony`, `tariff`, `money`, `start_indication`, `garden_id`) VALUES
	(86, 196, 'Sun Jun 11 2017 18:27:02 GMT+0300 (EEST)', 0, 211, 1, -100, 111, 1),
	(87, 197, 'Sun Jun 11 2017 18:27:27 GMT+0300 (EEST)', 0, 322, 2, -200, 222, 2),
	(88, 196, 'Sun Jun 11 2017 18:27:50 GMT+0300 (EEST)', 100, 0, 1, 0, 111, 1),
	(89, 197, 'Sun Jun 11 2017 18:28:20 GMT+0300 (EEST)', 200, 0, 2, 0, 2, 2),
	(90, 197, 'Sun Jun 11 2017 18:28:28 GMT+0300 (EEST)', 0, 200, 2, -396, 2, 2),
	(91, 196, 'Sun Jun 11 2017 18:28:44 GMT+0300 (EEST)', 0, 200, 1, -199, 1, 1),
	(92, 196, 'Sun Jun 11 2017 18:28:52 GMT+0300 (EEST)', 200, 0, 1, 1, 1, 1),
	(93, 197, 'Sun Jun 11 2017 18:29:39 GMT+0300 (EEST)', 400, 0, 2, 4, 2, 2),
	(94, 203, 'Mon Jun 12 2017 17:48:07 GMT+0300 (EEST)', 0, 300, 1, -299, 1, 1),
	(95, 201, 'Thu Jul 06 2017 18:30:52 GMT+0300', 0, 100, 1, -89, 11, 1),
	(96, 201, 'Thu Jul 06 2017 18:31:00 GMT+0300', 100, 0, 1, 11, 11, 1);

CREATE TABLE IF NOT EXISTS `house` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `money` float NOT NULL,
  `testimony` int(11) NOT NULL,
  `start_value` int(11) NOT NULL,
  `last_indication` int(11) NOT NULL,
  `spent` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=utf8;

INSERT INTO `house` (`id`, `street_id`, `group_id`, `title`, `fio`, `phone`, `money`, `testimony`, `start_value`, `last_indication`, `spent`, `garden_id`) VALUES
	(204, 108, 56, '3', 'ddvf', '3333', 0, 0, 0, 3, 0, 3),
	(203, 101, 50, '1', 'ddc', '333', -299, -299, 1, 300, 299, 1),
	(199, 104, 51, '22', 'dvdvd', '4443', 0, 0, 0, 22, 0, 2),
	(200, 105, 51, '222', 'dfdf', '3', 0, 0, 0, 222, 0, 2),
	(201, 101, 50, '11', 'cdc123', '333', 11, 11, 1, 100, 89, 1),
	(202, 106, 50, '111', 'cdcd', '3333', 0, 0, 0, 111, 0, 1);

CREATE TABLE IF NOT EXISTS `houseprice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` float NOT NULL DEFAULT '0',
  `garden_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `houseprice` (`id`, `price`, `garden_id`, `created_at`) VALUES
	(1, 1.12, 8, 1494943861),
	(2, 1.24, 6, 1497014923),
	(6, 1.56, 3, 1497020526),
	(7, 0.1, 3, 1497020537),
	(8, 2, 2, 1497363192),
	(9, 1.32, 1, 1497365822),
	(10, 1.2, 1, 1497527015),
	(11, 1, 6, 1497527903),
	(12, 3, 1, 1497877776),
	(13, 3, 2, 1497527903),
	(14, 3, 2, 1497884535);

CREATE TABLE IF NOT EXISTS `indication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `counter_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=492 DEFAULT CHARSET=utf8;

INSERT INTO `indication` (`id`, `counter_id`, `created_at`, `value`, `garden_id`) VALUES
	(486, 175, 'Sun Jun 11 2017 18:27:02 GMT+0300 (EEST)', 211, 1),
	(487, 176, 'Sun Jun 11 2017 18:27:27 GMT+0300 (EEST)', 322, 2),
	(488, 178, 'Sun Jun 11 2017 18:28:28 GMT+0300 (EEST)', 200, 2),
	(489, 177, 'Sun Jun 11 2017 18:28:44 GMT+0300 (EEST)', 200, 1),
	(490, 185, 'Mon Jun 12 2017 17:48:07 GMT+0300 (EEST)', 300, 1),
	(491, 182, 'Thu Jul 06 2017 18:30:52 GMT+0300', 100, 1);

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1494510040),
           ");

        $this->execute("
CREATE TABLE IF NOT EXISTS `pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `price_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=236 DEFAULT CHARSET=utf8 COMMENT='house_money';

INSERT INTO `pay` (`id`, `house_id`, `created_at`, `price_id`, `amount`, `garden_id`) VALUES
	(231, 196, 'Sun Jun 11 2017 18:27:50 GMT+0300 (EEST)', 1, 100, 1),
	(232, 197, 'Sun Jun 11 2017 18:28:20 GMT+0300 (EEST)', 2, 200, 2),
	(233, 196, 'Sun Jun 11 2017 18:28:52 GMT+0300 (EEST)', 1, 200, 1),
	(234, 197, 'Sun Jun 11 2017 18:29:39 GMT+0300 (EEST)', 2, 400, 2),
	(235, 201, 'Thu Jul 06 2017 18:31:00 GMT+0300', 75, 100, 1);

CREATE TABLE IF NOT EXISTS `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` text NOT NULL,
  `value` float NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
INSERT INTO `price` (`id`, `created_at`, `value`, `garden_id`) VALUES
	(75, 'Sun Jun 11 2017 18:24:48 GMT+0300 (EEST)', 1, 1),
	(76, 'Sun Jun 11 2017 18:26:07 GMT+0300 (EEST)', 2, 2),
	(77, 'Mon Jun 12 2017 17:42:10 GMT+0300 (EEST)', 3, 2),
	(78, 'Mon Jun 12 2017 17:42:15 GMT+0300 (EEST)', 2, 2),
	(79, 'Thu Jul 06 2017 18:31:21 GMT+0300', 2, 1),
	(80, 'Thu Jul 06 2017 18:41:04 GMT+0300 (Финляндия (лето))', 1, 1);

CREATE TABLE IF NOT EXISTS `streets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `garden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

INSERT INTO `streets` (`id`, `title`, `garden_id`) VALUES
	(102, '2f', 2),
	(101, '1a', 1),
	(104, '2b', 2),
	(105, '2c', 2),
	(106, '1b', 1),
	(107, '1c', 1),
	(108, '3a', 3),
	(109, '3b', 3),
	(110, '4a', 6),
	(111, '5a', 8),
	(112, '5d', 8),
	(113, '1j', 1),
	(114, '1k', 1);
           ") ;
    }

    public function down()
    {
        $this->dropTable('{{%admin}}');
        $this->dropTable('{{%counter}}');
        $this->dropTable('{{%customer}}');
        $this->dropTable('{{%customer_ammount_history}}');
        $this->dropTable('{{%garden}}');
        $this->dropTable('{{%group}}');
        $this->dropTable('{{%group_counter}}');
        $this->dropTable('{{%group_testimony}}');
        $this->dropTable('{{%history}}');
        $this->dropTable('{{%house}}');
        $this->dropTable('{{%houseprice}}');
        $this->dropTable('{{%indication}}');
        $this->dropTable('{{%pay}}');
        $this->dropTable('{{%price}}');
        $this->dropTable('{{%streets}}');
    }
}
