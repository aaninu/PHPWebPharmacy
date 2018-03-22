-- ------------------------------------
-- Table structure for `webph_products`
-- ------------------------------------

CREATE TABLE `webph_products` (
  `id` int(11) NOT NULL,
  `i_user` int(11) DEFAULT NULL,
  `s_nume` varchar(100) DEFAULT NULL,
  `s_pret` varchar(25) NOT NULL DEFAULT '0',
  `s_moneda` varchar(25) NOT NULL,
  `s_reducere` varchar(25) NOT NULL DEFAULT '0',
  `i_cantitate` int(11) NOT NULL DEFAULT '1',
  `s_descriere` longtext NOT NULL,
  `s_Tip` longtext NOT NULL,
  `s_Mod` longtext NOT NULL,
  `s_imagine` longtext NOT NULL,
  `d_expirare` varchar(25) NOT NULL,
  `d_public` varchar(25) DEFAULT NULL,
  `d_edit` varchar(25) DEFAULT NULL,
  `i_views` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Indexes for table `webph_products`
ALTER TABLE `webph_products`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for table `webph_products`
ALTER TABLE `webph_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
