--
-- Structura de tabel pentru tabelul `webph_invoice_items`
--

CREATE TABLE `webph_invoice_items` (
  `id` int(11) NOT NULL,
  `i_invoice` int(11) DEFAULT NULL,
  `i_product` int(11) DEFAULT NULL,
  `i_count` varchar(25) DEFAULT NULL,
  `s_pret` varchar(25) NOT NULL,
  `s_pret_old` varchar(20) NOT NULL DEFAULT '0',
  `s_moneda` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for table `webph_invoice_items`
--
ALTER TABLE `webph_invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `webph_invoice_items`
--
ALTER TABLE `webph_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
