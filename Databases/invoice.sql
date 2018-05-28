--
-- Structura de tabel pentru tabelul `webph_invoice`
--

CREATE TABLE `webph_invoice` (
  `id` int(11) NOT NULL,
  `i_user` int(11) DEFAULT NULL,
  `d_comanda` varchar(25) DEFAULT NULL,
  `s_status` enum('PAID','UNPAID','CANCELED','') NOT NULL DEFAULT 'UNPAID',
  `s_comanda` enum('OK','WAIT') NOT NULL DEFAULT 'WAIT',
  `s_comm` longtext NOT NULL,
  `s_payment` varchar(200) DEFAULT '',
  `s_payTXN` varchar(200) NOT NULL DEFAULT '',
  `s_d_pay` varchar(20) NOT NULL DEFAULT '',
  `s_d_order` varchar(20) NOT NULL DEFAULT '',
  `s_n_pharmacy` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for table `webph_invoice`
--
ALTER TABLE `webph_invoice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `webph_invoice`
--
ALTER TABLE `webph_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
 