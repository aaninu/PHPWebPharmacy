--
-- Structura de tabel pentru tabelul `webph_users`
--

CREATE TABLE `webph_users` (
  `id` int(11) NOT NULL,
  `s_email` varchar(100) DEFAULT NULL,
  `s_nume` varchar(100) DEFAULT NULL,
  `s_prenume` varchar(100) DEFAULT NULL,
  `sPW_Code` varchar(250) NOT NULL,
  `sPW_Free` blob NOT NULL,
  `s_telefon` varchar(25) DEFAULT NULL,
  `s_addresa` varchar(25) DEFAULT NULL,
  `d_start` varchar(25) DEFAULT NULL,
  `d_login` varchar(25) DEFAULT NULL,
  `eType` enum('ADMIN','MEMBRU','PHARMACY','') NOT NULL DEFAULT 'MEMBRU',
  `s_avatar` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Indexes for table `webph_users`
--
ALTER TABLE `webph_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `webph_users`
--
ALTER TABLE `webph_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
