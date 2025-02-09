-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 02:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gackey_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `NIP` varchar(7) NOT NULL,
  `name` varchar(255) NOT NULL,
  `initial` varchar(3) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'test.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`NIP`, `name`, `initial`, `password`, `role`, `image`) VALUES
('ahmarfi', 'Ahmad Hendra Marfiadi', 'AHM', 'bcabca123', 'Site Manager', 'test.jpeg'),
('u055274', 'Abraham Nugroho', 'ABR', 'bcabca123', 'Shift Leader', 'test.jpeg'),
('u063632', 'Erwin Muntoro', 'EMO', 'bcabca123', 'Shift Leader', 'test.jpeg'),
('u079964', 'Hafizhan Khair', 'HVZ', 'bcabca123', 'Security Operation Center', 'test.jpeg'),
('u079982', 'Bima Tribuana Putra', 'BTP', 'bcabca123', 'Security Operation Center', 'test.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `ID` varchar(255) NOT NULL,
  `pass_id` varchar(255) NOT NULL,
  `key_RFID` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `borrowTime` varchar(255) NOT NULL,
  `borrowPIC` varchar(255) NOT NULL,
  `borrowSOC` varchar(255) NOT NULL,
  `returnTime` varchar(255) NOT NULL,
  `returnSOC` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keydata`
--

CREATE TABLE `keydata` (
  `IDkey` varchar(255) NOT NULL,
  `NameKey` varchar(255) NOT NULL,
  `TypeKey` varchar(255) NOT NULL,
  `LocationKey` varchar(255) NOT NULL,
  `StatusKey` varchar(255) NOT NULL,
  `Quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keydata`
--

INSERT INTO `keydata` (`IDkey`, `NameKey`, `TypeKey`, `LocationKey`, `StatusKey`, `Quantity`) VALUES
('1', 'UPS 3A01', 'Main', 'Rack Putih 1', 'Available', 1);

-- --------------------------------------------------------

--
-- Table structure for table `key_data`
--

CREATE TABLE `key_data` (
  `RFID` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `quantity` int(5) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `key_data`
--

INSERT INTO `key_data` (`RFID`, `type`, `name`, `room`, `quantity`, `location`, `status`) VALUES
('0', 'Main', '0002753072', '0002753072', 2, '0002753072', ''),
('0002753072', 'Main', 'ASASDAS', 'ASDASD', 2, 'SADASD', 'Borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `log_key`
--

CREATE TABLE `log_key` (
  `pass_id` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `PIC` varchar(255) NOT NULL,
  `key_rfid` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `time_stamp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `id_merchant` varchar(20) NOT NULL,
  `nama_merchant` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`id_merchant`, `nama_merchant`, `alamat`) VALUES
('mcd001', 'MCD DEPOK MARGONDA', 'jln. margonda'),
('mcd002', 'MCD SAWANGAN', 'jln. sawangan'),
('berkah001', 'TOKO BERAS BERKAH DEPOK', 'jln. sawangan');

-- --------------------------------------------------------

--
-- Table structure for table `pic_data`
--

CREATE TABLE `pic_data` (
  `RFID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `initial` varchar(255) NOT NULL,
  `team` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pic_data`
--

INSERT INTO `pic_data` (`RFID`, `name`, `initial`, `team`) VALUES
(2753072, '0002753072', '0002753072', '0002753072');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` bigint(20) NOT NULL,
  `merchant` varchar(255) DEFAULT NULL,
  `ip_edc` varchar(255) DEFAULT NULL,
  `start_of_text` varchar(255) DEFAULT NULL,
  `message_length` varchar(255) DEFAULT NULL,
  `ecr_version` varchar(255) DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `transaction_amount` varchar(255) DEFAULT NULL,
  `other_amount` varchar(255) DEFAULT NULL,
  `pan` varchar(255) DEFAULT NULL,
  `expire_date` varchar(255) DEFAULT NULL,
  `cancel_reason` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `auth_code` varchar(255) DEFAULT NULL,
  `installment_flag` varchar(255) DEFAULT NULL,
  `redeem_flag` varchar(255) DEFAULT NULL,
  `dcc_flag` varchar(255) DEFAULT NULL,
  `installment_plan` varchar(255) DEFAULT NULL,
  `installment_tenor` varchar(255) DEFAULT NULL,
  `generic_data` varchar(255) DEFAULT NULL,
  `reff_number` varchar(255) DEFAULT NULL,
  `merchant_filler` varchar(255) DEFAULT NULL,
  `crc` varchar(255) DEFAULT NULL,
  `end_of_text` varchar(255) DEFAULT NULL,
  `response` varchar(600) NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `merchant`, `ip_edc`, `start_of_text`, `message_length`, `ecr_version`, `transaction_type`, `transaction_amount`, `other_amount`, `pan`, `expire_date`, `cancel_reason`, `invoice_number`, `auth_code`, `installment_flag`, `redeem_flag`, `dcc_flag`, `installment_plan`, `installment_tenor`, `generic_data`, `reff_number`, `merchant_filler`, `crc`, `end_of_text`, `response`, `time`, `date`) VALUES
(38, 'berkah001', '192.168.1.23', '02', '0150', '01', '3031', '2000', '303030303030303030303030', '20202020202020202020202020202020202020', '32343036', '3030', '303030303030', '303030303030', '4E', '4E', '4E', '303030', '3030', '202020202020202020202020', '202020202020202020202020', '202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020', '0E', '03', '0202000130313030303030303230303030303030303030303030303030303138383938302A2A2A2A2A2A333231302020202A2A2A2A30303030323739392020202020205933323334353230323330373234313730343032303030303035313131313131313131434A4F5244414E314E41484D41442046414953414C2F202020202020202020202020202020202020202020202020202020202030303031303930303039393930374E4E4E3030303030303030303030302020202020202020202020204E202020202020202003220000000000', '17:03:47', '24/07/2023'),
(39, 'berkah001', '192.168.1.23', '02', '0150', '01', '3031', '2000', '303030303030303030303030', '20202020202020202020202020202020202020', '32343036', '3030', '303030303030', '303030303030', '4E', '4E', '4E', '303030', '3030', '202020202020202020202020', '202020202020202020202020', '202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020', '0E', '03', '0202000130313030303030303230303030303030303030303030303030303138383938302A2A2A2A2A2A333231302020202A2A2A2A30303030323830302020202020205933323334353230323330373234313731303138303030303035313131313131313131434A4F5244414E314E41484D41442046414953414C2F202020202020202020202020202020202020202020202020202020202030303031313030303039393930374E4E4E3030303030303030303030302020202020202020202020204E2020202020202020032B0000000000', '17:10:07', '24/07/2023'),
(40, 'mcd001', '192.168.1.23', '02', '0150', '01', '3031', '2000', '303030303030303030303030', '20202020202020202020202020202020202020', '32343036', '3030', '303030303030', '303030303030', '4E', '4E', '4E', '303030', '3030', '202020202020202020202020', '202020202020202020202020', '202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020', '0E', '03', '0202000130313030303030303230303030303030303030303030303030303138383938302A2A2A2A2A2A333231302020202A2A2A2A30303030323830312020202020205933323334353230323330373234313731313035303030303035313131313131313131434A4F5244414E314E41484D41442046414953414C2F202020202020202020202020202020202020202020202020202020202030303031313130303039393930374E4E4E3030303030303030303030302020202020202020202020204E202020202020202003260000000000', '17:10:54', '24/07/2023'),
(41, 'mcd001', '192.168.1.23', '02', '0150', '01', '3031', '1000', '303030303030303030303030', '20202020202020202020202020202020202020', '32343036', '3030', '303030303030', '303030303030', '4E', '4E', '4E', '303030', '3030', '202020202020202020202020', '202020202020202020202020', '202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020', '0D', '03', '0202000130313030303030303130303030303030303030303030303030303138383938302A2A2A2A2A2A333231302020202A2A2A2A30303030323830332020202020205933323334353230323330373235303431323339303030303035313131313131313131434A4F5244414E314E41484D41442046414953414C2F202020202020202020202020202020202020202020202020202020202030303031313230303039393930374E4E4E3030303030303030303030302020202020202020202020204E2020202020202020032B0000000000', '04:12:24', '25/07/2023'),
(42, 'mcd001', '192.168.72.155', '02', '0150', '01', '3031', '1000', '303030303030303030303030', '20202020202020202020202020202020202020', '32343036', '3030', '303030303030', '303030303030', '4E', '4E', '4E', '303030', '3030', '202020202020202020202020', '202020202020202020202020', '202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020', '0D', '03', '0202000130313030303030303130303030303030303030303030303030303138383938302A2A2A2A2A2A333231302020202A2A2A2A30303030323830352020202020205933323334353230323330373235303833323231303030303035313131313131313131434A4F5244414E314E41484D41442046414953414C2F202020202020202020202020202020202020202020202020202020202030303031313330303039393930374E4E4E3030303030303030303030302020202020202020202020204E2020202020202020032B0000000000', '08:31:57', '25/07/2023'),
(43, 'mcd001', '192.168.72.155', '02', '0150', '01', '3031', '1000', '303030303030303030303030', '20202020202020202020202020202020202020', '32343036', '3030', '303030303030', '303030303030', '4E', '4E', '4E', '303030', '3030', '202020202020202020202020', '202020202020202020202020', '202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020', '0D', '03', '0202000130313030303030303130303030303030303030303030303030303138383938302A2A2A2A2A2A333231302020202A2A2A2A30303030323830362020202020205933323334353230323330373235303934313037303030303035313131313131313131434A4F5244414E314E41484D41442046414953414C2F202020202020202020202020202020202020202020202020202020202030303031313430303039393930374E4E4E3030303030303030303030302020202020202020202020204E2020202020202020032E0000000000', '09:40:30', '25/07/2023');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `gambar`, `level`) VALUES
('U23001', 'Jaka Tarubb', 'super@gmail.com', 'super', '5847eb8bcef1014c0b5e4851.png', 'Admin'),
('U23002', 'wanwan', 'wanwan@gmail.com', 'wanwan123', 'avatar.png', 'Admin'),
('010', 'super', 'super@gmail.com', 'super', '', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `keydata`
--
ALTER TABLE `keydata`
  ADD PRIMARY KEY (`IDkey`);

--
-- Indexes for table `key_data`
--
ALTER TABLE `key_data`
  ADD PRIMARY KEY (`RFID`);

--
-- Indexes for table `pic_data`
--
ALTER TABLE `pic_data`
  ADD PRIMARY KEY (`RFID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
