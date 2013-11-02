--
-- Definition of table `sessions`
--

CREATE TABLE  `sessions` (
  `session_id` varchar(32) NOT NULL,
  `modified` int(11) NOT NULL,
  `lifetime` int(11) NOT NULL,
  `data` mediumtext,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Db table to hold user session data';

--
-- Definition of table `users`
--

CREATE TABLE  `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_logon_at` datetime DEFAULT NULL,
  `user_detail_id` int(11) UNSIGNED NOT NULL,
  `password_reset_hash` varchar(32) DEFAULT NULL,
  `status` enum('ENABLE', 'DISABLE') NOT NULL DEFAULT 'DISABLE',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC),
  INDEX `status` (`status` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `users_details`
--

CREATE TABLE  `users_details` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image_id` int(9) UNSIGNED NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `birthday` DATE DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `gender` enum('MALE', 'FEMALE') NOT NULL DEFAULT 'MALE',
  `about` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `roles`
--

CREATE TABLE  `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `emails`
--

CREATE  TABLE `emails` (
  `email_template_id` TINYINT NOT NULL ,
  `to_email` VARCHAR(255) NOT NULL ,
  `status` ENUM('NEW','SENT') NULL DEFAULT 'NEW' ,
  INDEX `template` (`email_template_id` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `emails_template`
--

CREATE  TABLE `emails_template` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `template` TINYTEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `name` (`name` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `images`
--

CREATE  TABLE `images` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `path` VARCHAR(255) NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `creator_id` INT UNSIGNED NOT NULL ,
  `size_width` INT UNSIGNED NOT NULL ,
  `size_height` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `size` (`size_width` ASC, `size_height` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
