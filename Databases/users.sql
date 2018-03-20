-- ------------------------------------
-- Table structure for `webph_users`
-- ------------------------------------

CREATE TABLE `webph_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `s_nume` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `s_prenume` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `s_telefon` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `s_addresa` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `d_start` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `d_login` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
