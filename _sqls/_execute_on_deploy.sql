CREATE TABLE `vms_user_has_data` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `vms_user_has_data`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `vms_user_has_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `vms_user_has_connected` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `friend` int(11) NOT NULL,
  `lastDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `vms_user_has_connected`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `vms_user_has_connected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
