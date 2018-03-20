-- ------------------------------------
-- Table structure for `webph_products`
-- ------------------------------------

CREATE TABLE `webph_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `i_user` int(11) NULL,
  `s_nume` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `d_public` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `d_edit` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
