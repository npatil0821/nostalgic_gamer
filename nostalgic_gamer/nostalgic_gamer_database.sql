-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2020 at 12:38 AM
-- Server version: 5.7.32
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patiln1_nostalgic_gamer`
--

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMERS`
--

CREATE TABLE `CUSTOMERS` (
  `customerid` char(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CUSTOMERS`
--

INSERT INTO `CUSTOMERS` (`customerid`, `username`, `password`, `email`, `firstname`, `lastname`, `address`) VALUES
('839006', 'jsmith1', '$2y$10$UNSWeqlEUOqwqyme.8Sh5.l2E4I1U.1s5jYYMNNj1OIsX.rm4n462', 'jsmith1@email.com', 'John', 'Smith', '1 Normal Ave Montclair, NJ 07043'),
('791144', 'jdoe1', '$2y$10$MHcowktjYd68ILtP8o8T3ePoxM4ec1EiBH2Tmib1sy2idMKe/SPwa', 'jdoe1@email.com', 'Jane', 'Doe', '1 Normal Ave Montclair, NJ 07043');

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEES`
--

CREATE TABLE `EMPLOYEES` (
  `employeeid` char(5) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `cellphone` char(10) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EMPLOYEES`
--

INSERT INTO `EMPLOYEES` (`employeeid`, `firstname`, `lastname`, `email`, `address`, `cellphone`, `position`) VALUES
('69124', 'Jane', 'Doe', 'jdoe1@email.com', '1 Normal Ave, Montclair, NJ 07043', '1234567890', 'employee'),
('00001', 'Nachi', 'Patil', 'npatil1@email.com', '2 Normal Ave, Montclair, NJ 07043', '1112223333', 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `ORDERS`
--

CREATE TABLE `ORDERS` (
  `orderid` char(7) NOT NULL,
  `customerid` char(6) NOT NULL,
  `cost` float NOT NULL,
  `address` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `authempid` char(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORDERS`
--

INSERT INTO `ORDERS` (`orderid`, `customerid`, `cost`, `address`, `date`, `time`, `authempid`) VALUES
('8401854', '839006', 50, '1 Normal Ave Montclair, NJ 07043', '2020-12-03', '13:24:57', 'NULL'),
('2887120', '839006', 120, '1 Normal Ave Montclair, NJ 07043', '2020-11-30', '00:10:47', 'NULL'),
('1797723', '839006', 200, '1 Normal Ave Montclair, NJ 07043', '2020-11-30', '00:10:35', 'NULL'),
('6018497', '839006', 240, '1 Normal Ave Montclair, NJ 07043', '2020-11-30', '20:15:03', '00001'),
('5699788', '791144', 570, '1 Normal Ave Montclair, NJ 07043', '2020-11-30', '20:12:12', '00001'),
('4395788', '759441', 340, '1 Normal Ave Montclair, NJ 07043', '2020-11-29', '01:25:56', '00001');

-- --------------------------------------------------------

--
-- Table structure for table `ORDER_CONTAINS`
--

CREATE TABLE `ORDER_CONTAINS` (
  `orderid` char(7) NOT NULL,
  `productid` char(4) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORDER_CONTAINS`
--

INSERT INTO `ORDER_CONTAINS` (`orderid`, `productid`, `productname`, `price`, `quantity`) VALUES
('4395788', '5014', 'The Legend of Zelda: Twilight Princess', 90, 1),
('4395788', '1001', 'PlayStation 2', 250, 1),
('5699788', '1001', 'PlayStation 2', 250, 1),
('5699788', '1002', 'GameCube', 200, 1),
('5699788', '1003', 'GameBoy Advance', 120, 1),
('6018497', '5017', 'Paper Mario: The Thousand-Year Door', 70, 1),
('6018497', '5015', 'Sonic Adventure DX: Director\'s Cut', 170, 1),
('1797723', '1002', 'GameCube', 200, 1),
('2887120', '1003', 'GameBoy Advance', 120, 1),
('8401854', '2001', 'PlayStation 2 Controller', 10, 1),
('8401854', '2002', 'GameCube Controller', 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `other_logins`
--

CREATE TABLE `other_logins` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_logins`
--

INSERT INTO `other_logins` (`username`, `password`) VALUES
('db_semester_project', '$2y$10$bpncVHoF1JBI56Owm7yisehQ77ieWGv088awbSFFau7lqRsE5/6sO'),
('ng_admin', '$2y$10$tZ2rgvN8v.0xjVZ35TYZsuL.N2Aqt14HVh50o.PJNld2WJFHmLK5S');

-- --------------------------------------------------------

--
-- Stand-in structure for view `OUT_OF_STOCK`
-- (See below for the actual view)
--
CREATE TABLE `OUT_OF_STOCK` (
`productid` char(4)
,`name` varchar(50)
,`description` varchar(100)
,`image` varchar(50)
,`type` varchar(50)
,`stock` int(2)
,`price` float
);

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS`
--

CREATE TABLE `PRODUCTS` (
  `productid` char(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `stock` int(2) NOT NULL,
  `price` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PRODUCTS`
--

INSERT INTO `PRODUCTS` (`productid`, `name`, `description`, `image`, `type`, `stock`, `price`) VALUES
('1002', 'GameCube', 'Nintendo home video game console. Released in 2001 and discontinued in 2007.', 'images/gc.jpg', 'Console', 6, 200),
('5007', 'Final Fantasy XII', 'Eighth best selling game for the Playstaion 2. Rated T for teen.', 'images/ffxii.jpg', 'Game', 7, 15),
('1003', 'GameBoy Advance', 'Nintendo handheld game console. Released in 2001 and discontinued in 2010.', 'images/gba.jpg', 'Console', 3, 120),
('1004', 'GameBoy Advance SP', 'Nintendo handheld game console. Released in 2003 and discontinued in 2010.', 'images/gba_sp.jpg', 'Console', 6, 220),
('5017', 'Sonic Adventure DX: Director\'s Cut', 'Game for the GameCube. Rated E for everyone.', 'images/sonic_adventure.jpg', 'Game', 3, 70),
('5015', 'Paper Mario: The Thousand-Year Door', 'Tenth best selling game for the GameCube. Rated E for everyone.', 'images/paper_mario.jpg', 'Game', 3, 170),
('5014', 'The Legend of Zelda: Twilight Princess', 'Ninth best selling game for the GameCube. Rated T for teen.', 'images/loz_tp.jpg', 'Game', 3, 90),
('5013', 'Sonic Adventure 2 Battle', 'Eighth best selling game for the GameCube. Rated E for everyone.', 'images/sonic_adventure2.jpg', 'Game', 4, 85),
('2001', 'PlayStation 2 Controller', 'Standard controller for the PlayStation 2.', 'images/ps2_controller.jpg', 'Controller/Link', 0, 10),
('2002', 'GameCube Controller', 'Standard controller for the GameCube.', 'images/gc_controller.jpg', 'Controller/Link', 4, 10),
('5006', 'Kingdom Hearts II', 'Tenth best selling game for the Playstaion 2. Rated E10+ for everyone age 10+.', 'images/kh2.jpg', 'Game', 4, 20),
('2003', 'GameBoy Advance Link Cable', 'Cable for connecting 2 GameBoys. Works for Advance or Advance SP.', '/images/gba_link.jpg', 'Controller/Link', 3, 6),
('2004', 'GameCube - GBA Link Cable', 'Cable for connecting a GameBoy Advance or GameBoy Advance SP to a GameCube.', 'images/gc_gba_link.jpg', 'Controller/Link', 5, 10),
('5012', 'Luigi\'s Mansion', 'Fifth best selling game for the GameCube. Rated E for everyone.', 'images/luigis_mansion.jpg', 'Game', 2, 75),
('3001', 'PlayStation 2 Memory Card', 'Standard memory card for PlayStation 2 with 128 MB capacity', 'images/ps2_mem_card.jpg', 'Memory Storage', 0, 10),
('3002', 'GameCube Memory Card', 'Standard memory card for the GameCube with 128 MB capacity.', 'images/gc_mem_card.jpg', 'Memory Storage', 3, 10),
('5011', 'The Legend of Zelda: The Wind Waker', 'Fourth best selling game for the GameCube. Rated E for everyone.', 'images/loz_ww.jpg', 'Game', 3, 110),
('4001', 'GameBoy Advance SP Charger', 'Standard charger for the GameBoy Advance SP.', 'images/gba_sp_charger.jpg', 'Charger/Battery', 5, 10),
('5010', 'Mario Kart: Double Dash', 'Second best selling game for the GameCube. Rated E for everyone.', 'images/mario_kart.jpg', 'Game', 2, 120),
('5009', 'Super Smash Bros. Melee', 'Best selling game for the GameCube. Rated E for everyone.', 'images/ssb_melee.jpg', 'Game', 1, 120),
('4002', 'AA Batteries', 'Batteries to power the GameBoy Advance. Comes in packs 0f 8.', 'images/aa_batteries.jpg', 'Charger/Battery', 25, 10),
('4003', 'GameBoy Advance SP Battery', 'Rechargeable battery for the GameBoy Advance SP.', 'images/gba_sp_battery.jpg', 'Charger/Battery', 4, 10),
('5008', 'Final Fantasy X', 'Fifth best selling game for the Playstaion 2. Rated T for teen.', 'images/ffx.jpg', 'Game', 3, 15),
('5001', 'Pokemon Ruby Version', 'Top selling game for the GameBoy Advance along with Pokemon Sapphire. Rated E (everyone).', 'images/pokemon_ruby.jpg', 'Game', 6, 85),
('5002', 'Pokemon Sapphire', 'Top selling game for the GameBoy Advance along with Pokemon Sapphire. Rated E (everyone).', 'images/pokemon_sapphire.jpg', 'Game', 3, 80),
('5003', 'Pokemon FireRed', 'Second best selling game for the GameBoy Advance along with Pokemon LeafGreen. Rated E (everyone).', 'images/pokemon_fr.jpg', 'Game', 5, 100),
('5004', 'Pokemon LeafGreen', 'Second best selling game for the GameBoy Advance along with Pokemon FireRed. Rated E (everyone).', 'images/pokemon_lg.jpg', 'Game', 2, 85),
('5005', 'Pokemon Emerald', 'Third best selling game for the GameBoy Advance. Rated E (everyone).', 'images/pokemon_emerald.jpg', 'Game', 3, 150),
('5016', 'Kingdom Hearts', 'Game for PlayStation 2. Rated E for everyone.', 'images/kh.jpg', 'Game', 1, 15),
('1001', 'PlayStation 2', 'Sony home video game console. Released in 2000 and discontinued in 2013.', 'images/ps2.jpg', 'Console', 0, 250);

-- --------------------------------------------------------

--
-- Stand-in structure for view `UNAUTH_ORDERS`
-- (See below for the actual view)
--
CREATE TABLE `UNAUTH_ORDERS` (
`orderid` char(7)
,`customerid` char(6)
,`cost` float
,`address` varchar(100)
,`date` date
,`time` time
,`authempid` char(5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `YOUR_INFO`
-- (See below for the actual view)
--
CREATE TABLE `YOUR_INFO` (
`username` varchar(50)
,`email` varchar(50)
,`firstname` varchar(50)
,`lastname` varchar(50)
,`address` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `OUT_OF_STOCK`
--
DROP TABLE IF EXISTS `OUT_OF_STOCK`;

CREATE ALGORITHM=UNDEFINED DEFINER=`patiln1`@`localhost` SQL SECURITY DEFINER VIEW `OUT_OF_STOCK`  AS  select `PRODUCTS`.`productid` AS `productid`,`PRODUCTS`.`name` AS `name`,`PRODUCTS`.`description` AS `description`,`PRODUCTS`.`image` AS `image`,`PRODUCTS`.`type` AS `type`,`PRODUCTS`.`stock` AS `stock`,`PRODUCTS`.`price` AS `price` from `PRODUCTS` where (`PRODUCTS`.`stock` = 0) ;

-- --------------------------------------------------------

--
-- Structure for view `UNAUTH_ORDERS`
--
DROP TABLE IF EXISTS `UNAUTH_ORDERS`;

CREATE ALGORITHM=UNDEFINED DEFINER=`patiln1`@`localhost` SQL SECURITY DEFINER VIEW `UNAUTH_ORDERS`  AS  select `ORDERS`.`orderid` AS `orderid`,`ORDERS`.`customerid` AS `customerid`,`ORDERS`.`cost` AS `cost`,`ORDERS`.`address` AS `address`,`ORDERS`.`date` AS `date`,`ORDERS`.`time` AS `time`,`ORDERS`.`authempid` AS `authempid` from `ORDERS` where (`ORDERS`.`authempid` = 'NULL') ;

-- --------------------------------------------------------

--
-- Structure for view `YOUR_INFO`
--
DROP TABLE IF EXISTS `YOUR_INFO`;

CREATE ALGORITHM=UNDEFINED DEFINER=`patiln1`@`localhost` SQL SECURITY DEFINER VIEW `YOUR_INFO`  AS  select `CUSTOMERS`.`username` AS `username`,`CUSTOMERS`.`email` AS `email`,`CUSTOMERS`.`firstname` AS `firstname`,`CUSTOMERS`.`lastname` AS `lastname`,`CUSTOMERS`.`address` AS `address` from `CUSTOMERS` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CUSTOMERS`
--
ALTER TABLE `CUSTOMERS`
  ADD PRIMARY KEY (`customerid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `EMPLOYEES`
--
ALTER TABLE `EMPLOYEES`
  ADD PRIMARY KEY (`employeeid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `authempid` (`authempid`);

--
-- Indexes for table `ORDER_CONTAINS`
--
ALTER TABLE `ORDER_CONTAINS`
  ADD PRIMARY KEY (`orderid`,`productid`);

--
-- Indexes for table `other_logins`
--
ALTER TABLE `other_logins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  ADD PRIMARY KEY (`productid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

GRANT SELECT, INSERT, DELETE, UPDATE
ON patiln1_nostalgic_gamer.*
TO patiln1_ng_admin@localhost
IDENTIFIED BY 'fall2020s2';