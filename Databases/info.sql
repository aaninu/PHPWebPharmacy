--
-- Structura de tabel pentru tabelul `webph_info`
--

CREATE TABLE `webph_info` (
  `tag` varchar(50) CHARACTER SET utf8 NOT NULL,
  `info` longtext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `webph_info`
--
ALTER TABLE `webph_info`
  ADD PRIMARY KEY (`tag`);
