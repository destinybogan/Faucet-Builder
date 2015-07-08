<?php

$create_tables = <<<QUERY
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `result` tinyint(1) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_referals`
--

CREATE TABLE IF NOT EXISTS `data_referals` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `referrer` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `result` tinyint(1) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referals`
--

CREATE TABLE IF NOT EXISTS `referals` (
  `username` varchar(50) NOT NULL,
  `reffered_by` text,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(50) NOT NULL UNIQUE KEY,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `ip` text NOT NULL,
  `claimed_at` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
QUERY;


$insert_settings = <<<QUERY
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Dumping data for table `settings`
--

INSERT IGNORE INTO `settings` (`name`, `value`) VALUES
('contact_mail', 'admin@domain.com'),
('background_color', '#EAEAEA'),
('background_image', ' '),
('background_image_selected', 'false'),
('button_type', 'success'),
('main_content', 'Your main content here'),
('referral_percentage', '20'),
('rewards', '10*8, 20*4, 30*2, 40'),
('solvemedia_challenge_key', 'YOUR_SOLVEMEDIA_CHALLENGE_KEY'),
('solvemedia_verification_key', 'YOUR_SOLVEMEDIA_VERIFICATION_KEY'),
('subtitle', 'My new FaucetBuilder faucet :)'),
('subtitle_color', '#6CB04C'),
('timer', '1'),
('title', 'FaucetBuilder faucet'),
('title_color', '#2F9102'),
('xapo_app_id', 'YOUR_APP_ID'),
('xapo_secret_key', 'YOUR_SECRET_KEY'),
('password', 'default'),
('password_set', '0'),
('bottom_horizontal_ad', '<div>bottom horizontal ad</div>'),
('middle_horizontal_ad', '<div>middle horizontal ad</div>'),
('right_vertical_ad', '<div>right vertical ad</div>'),
('top_horizontal_ad', '<div>top horizontal ad</div>'),
('left_vertical_ad', '<div>left vertical ad</div>'),
('submit_button_text','Claim prize!'),
('button_background','success')

QUERY;

$change_password = "UPDATE settings set value=? where name='password';UPDATE settings set value=? where name='password_set';";

?>
