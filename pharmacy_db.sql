-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2020 at 12:51 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `id` int(3) NOT NULL,
  `serve` varchar(1600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `product_id` int(10) NOT NULL,
  `batch_no` varchar(20) NOT NULL,
  `expirydate` date NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `date`, `product_id`, `batch_no`, `expirydate`, `quantity`) VALUES
(1, '0000-00-00', 1, 'entry batch', '2019-10-19', 300),
(2, '0000-00-00', 2, 'entry batch', '2019-10-19', 300),
(3, '0000-00-00', 3, 'entry batch', '2019-10-19', 100),
(4, '0000-00-00', 4, 'entry batch', '2019-10-19', 700),
(5, '0000-00-00', 5, 'entry batch', '2019-10-19', 100),
(6, '0000-00-00', 6, 'entry batch', '2020-04-27', 50),
(7, '0000-00-00', 7, 'entry batch', '2020-04-27', 4);

-- --------------------------------------------------------

--
-- Table structure for table `bincard`
--

CREATE TABLE `bincard` (
  `transaction_id` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `product_code` varchar(150) NOT NULL,
  `gen_name` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `batch` varchar(20) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `cashier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `transaction_id` int(11) NOT NULL,
  `date2` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `amount2` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `balance` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `confirm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`transaction_id`, `date2`, `name`, `invoice`, `amount2`, `remarks`, `balance`, `type`, `confirm`) VALUES
(1, '2020-06-09', 'test customer', '', '5000', '', 0, 'cash', 'cash'),
(2, '2020-06-09', 'test customer', '', '5000', '', 0, 'Mpesa', 'OA56477');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `membership_number` varchar(100) NOT NULL,
  `prod_name` varchar(550) NOT NULL,
  `expected_date` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `address`, `contact`, `membership_number`, `prod_name`, `expected_date`, `note`) VALUES
(1, 'test customer', 'kisumu', '2343', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `deviation`
--

CREATE TABLE `deviation` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `product_id` int(10) NOT NULL,
  `batch_no` varchar(20) NOT NULL,
  `orqty` varchar(10) NOT NULL,
  `deviation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deviation`
--

INSERT INTO `deviation` (`id`, `date`, `product_id`, `batch_no`, `orqty`, `deviation`) VALUES
(1, '2019-07-16', 3, 'entry batch', '100', '300');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `idno` varchar(12) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `amount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenselist`
--

CREATE TABLE `expenselist` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `addedby` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenselist`
--

INSERT INTO `expenselist` (`id`, `name`, `date`, `addedby`) VALUES
(1, 'Transport', '2019-07-30', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `recorded` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `name`, `amount`, `recorded`) VALUES
(1, '2019-07-30', 'Transport', 500, 'admin'),
(2, '2020-06-14', 'Transport', 200, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `expiries`
--

CREATE TABLE `expiries` (
  `transaction_id` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `batch` varchar(30) NOT NULL,
  `expdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expiriestt`
--

CREATE TABLE `expiriestt` (
  `transaction_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loginusers`
--

CREATE TABLE `loginusers` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `groupid` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentid` int(10) NOT NULL,
  `date2` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `amount2` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `confirm` varchar(50) NOT NULL,
  `entered_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentid`, `date2`, `name`, `amount2`, `type`, `confirm`, `entered_by`) VALUES
(1, '2020-01-11 06:00:00', 'Eastleigh Pharmaceuticlas', '5000', 'Mpesa', 'OA56477', 'admin'),
(2, '2020-01-11 16:56:22', 'Eastleigh Pharmaceuticlas', '5000', 'Mpesa', 'OA56477', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `transaction_id` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cashier` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `batch` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending`
--

INSERT INTO `pending` (`transaction_id`, `invoice`, `product`, `qty`, `amount`, `profit`, `price`, `discount`, `date`, `cashier`, `type`, `batch`) VALUES
(2, '303332', '3', '300', '3000', '', '10', '', '2020-07-28 21:00:00', '', '', ''),
(3, '3', '3', '300', '300', '', '1', '', '2020-07-28 21:00:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `gen_name` varchar(255) DEFAULT NULL,
  `o_price` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `wholesaleprice` int(10) NOT NULL,
  `profit` int(11) DEFAULT NULL,
  `supplier` varchar(30) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `instock` int(10) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `markup` varchar(50) DEFAULT NULL,
  `product_code` varchar(500) NOT NULL,
  `maxdiscre` varchar(10) NOT NULL,
  `maxdiscpr` varchar(10) NOT NULL,
  `maxdiscws` varchar(10) NOT NULL,
  `maxdiscwsp` varchar(10) NOT NULL,
  `datep` varchar(15) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `promotionqty` int(10) NOT NULL DEFAULT '0',
  `promotion_number` int(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `gen_name`, `o_price`, `price`, `wholesaleprice`, `profit`, `supplier`, `qty`, `instock`, `product_name`, `level`, `markup`, `product_code`, `maxdiscre`, `maxdiscpr`, `maxdiscws`, `maxdiscwsp`, `datep`, `active`, `promotionqty`, `promotion_number`) VALUES
(3, 'amoxicillin 125mg/ml', '9.4515443973009', '100', 90, 30, NULL, 1025, 400, NULL, '100', NULL, 'amoxil 100ml', '', '10', '', '', '19/10/2018', 1, 100, 5),
(4, 'amoxil 60ml', '36.195189588381', '60', 55, 20, NULL, 903, 1, NULL, '100', NULL, 'amoxil 60ml', '', '10', '', '', '19/10/2018', 1, 0, 0),
(5, 'metronidazole 100ml', '40', '70', 60, 30, NULL, 61, 200, NULL, '50', NULL, 'flagyl susp', '', '10', '', '', '19/10/2018', 1, 0, 0),
(6, 'Levofloxacin 500mg', '100', '400', 350, 300, NULL, 40, 78, NULL, '20', NULL, 'Levomax', '', '10', '', '', '28/04/2019', 1, 0, 0),
(7, 'Calpol', '389.47115384615', '230', 200, 60, NULL, 52, 25, NULL, '1', NULL, 'Pcm', '', '10', '', '', '28/04/2019', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project2_audit`
--

CREATE TABLE `project2_audit` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` varchar(40) NOT NULL,
  `user` varchar(300) DEFAULT NULL,
  `table` varchar(300) DEFAULT NULL,
  `action` varchar(250) NOT NULL,
  `description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `reason` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `product_id`, `reason`) VALUES
(4, 2, 'test'),
(5, 3, 'Short Expiry');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `transaction_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `suplier` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchases2`
--

CREATE TABLE `purchases2` (
  `transaction_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `invoicesupp` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases2`
--

INSERT INTO `purchases2` (`transaction_id`, `invoice_number`, `cashier`, `date`, `type`, `amount`, `name`, `invoicesupp`) VALUES
(1, 'INV-334333', 'admin', '02/12/2019', 'Cash', '500', 'Eastleigh Pharmaceuticlas', '123456'),
(2, '3423033', 'admin', '08/06/2020', 'Cash', '1000', 'Eastleigh Pharmaceuticlas', '5566'),
(3, '2202520', 'admin', '08/06/2020', 'Cash', '3000', 'Eastleigh Pharmaceuticlas', '556'),
(4, '23232083', 'admin', '14/06/2020', 'Credit', '23000', 'Eastleigh Pharmaceuticlas', '7865r'),
(5, '33200222', 'admin', '28/07/2020', 'Cash', '2000', 'Eastleigh Pharmaceuticlas', 'iu009'),
(6, '232405', 'admin', '28/07/2020', 'Credit', '4000', 'Eastleigh Pharmaceuticlas', 'iiu'),
(7, '3', 'admin', '29/07/2020', 'Cash', '300', 'Eastleigh Pharmaceuticlas', 'uyi');

-- --------------------------------------------------------

--
-- Table structure for table `purchases_item`
--

CREATE TABLE `purchases_item` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `transaction_id` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `cashier` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `batch` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(11) NOT NULL,
  `employee` varchar(60) NOT NULL,
  `date` varchar(11) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `paidby` varchar(30) NOT NULL,
  `rmks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `transaction_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `cashtendered` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `paid` varchar(3) NOT NULL,
  `customer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`transaction_id`, `invoice_number`, `cashier`, `date`, `type`, `amount`, `profit`, `cashtendered`, `name`, `balance`, `paid`, `customer`) VALUES
(1, 'INV-220230', 'admin', '0000-00-00 00:00:00', 'cash', 2000, '100', '0', 'test customer', '', '0', ''),
(2, 'INV-220230', 'admin', '0000-00-00 00:00:00', 'cash', 2000, '<br />\r\n<b>Notice</b>:  Undefined index: totalprof in <b>C:\\xampp\\htdocs\\syria\\wholesale\\makepay.php', '300', 'test customer', '', '1', ''),
(3, 'INV-3223020', 'admin', '0000-00-00 00:00:00', 'cash', 4500, '320', '0', 'test customer', '', '0', ''),
(4, 'INV-3223020', 'admin', '0000-00-00 00:00:00', 'cash', 4500, '<br />\r\n<b>Notice</b>:  Undefined index: totalprof in <b>C:\\xampp\\htdocs\\syria\\wholesale\\makepay.php', '5000', 'test customer', '', '1', ''),
(5, 'INV-226333', 'admin', '0000-00-00 00:00:00', 'cash', 8550, '950', '0', 'test customer', '', '0', ''),
(6, 'INV-226333', 'admin', '0000-00-00 00:00:00', 'cash', 8550, '<br />\r\n<b>Notice</b>:  Undefined index: totalprof in <b>C:\\xampp\\htdocs\\syria\\wholesale\\makepay.php', '9000', 'test customer', '', '1', ''),
(7, 'INV-0337802', 'admin', '0000-00-00 00:00:00', 'cash', 4500, '320', '0', 'test customer', '', '0', ''),
(8, 'INV-0337802', 'admin', '0000-00-00 00:00:00', 'cash', 4500, '<br />\r\n<b>Notice</b>:  Undefined index: totalprof in <b>C:\\xampp\\htdocs\\syria\\wholesale\\makepay.php', '5000', 'test customer', '', '1', ''),
(9, 'INV-23233267', 'pharmacist', '2018-12-10 06:00:00', 'cash', 350, '150', '', '', '', '1', ''),
(10, 'INV-23032643', 'pharmacist', '2018-12-11 06:00:00', 'cash', 140, '60', '120', '', '', '1', ''),
(11, 'INV-46266472', 'pharmacist', '2018-12-15 06:00:00', 'cash', 225, '55', '1000', '', '', '1', ''),
(12, 'INV-26020', 'admin', '2019-03-05 06:00:00', 'cash', 60, '20', '', '', '', '1', ''),
(13, 'INV-93220', 'pharmacist', '2019-04-27 05:00:00', 'cash', 100, '40', '500', '', '', '1', ''),
(14, 'INV-3333832', 'admin', '2019-04-27 05:00:00', 'cash', 200, '60', '', '', '', '1', ''),
(15, 'INV-432202', 'admin', '2019-04-28 05:00:00', 'cash', 85, '35', '100', '', '', '1', ''),
(16, 'INV-3233332', 'admin', '2019-04-28 05:00:00', 'cash', 30, '10', '', '', '', '1', ''),
(17, 'INV-23633922', 'admin', '2019-04-28 05:00:00', 'cash', 300, '90', '300', '', '', '1', ''),
(18, 'INV-2223820', 'admin', '2019-04-29 05:00:00', 'cash', 4070, '3030', '', '', '', '1', ''),
(19, 'INV-3293235', 'admin', '2019-05-06 05:00:00', 'cash', 100, '30', '100', '', '', '1', ''),
(20, 'INV-22092220', 'admin', '2019-07-30 05:00:00', 'cash', 500, '150', '500', '', '', '1', ''),
(21, 'INV-3007333', 'admin', '2020-01-11 06:00:00', 'cash', 4545, '4411.3034463', '5000', '', '', '1', ''),
(22, 'INV-33323202', 'admin', '2020-01-11 06:00:00', 'cash', 13500, '13188.9103389', '13500', '', '', '1', ''),
(23, 'INV-3932028', 'admin', '2020-01-11 10:59:47', 'cash', 4500, '4396.3034463', '4500', '', '', '1', ''),
(24, '202303', 'admin', '2020-02-02 15:46:43', 'cash', 1050, '645.8286917383', '2000', '', '', '1', ''),
(25, '239826', 'admin', '2020-06-08 12:14:37', 'cash', 700, '300', '1000', '', '', '1', ''),
(26, '730438', 'admin', '2020-06-09 15:15:06', 'cash', 600, '206.198347108', '1000', '', '', '1', ''),
(27, '730438', 'admin', '2020-06-09 15:17:27', 'cash', 1000, '-265.2173913043', '1000', '', '', '1', ''),
(28, '323373', 'admin', '2020-06-14 19:58:09', 'cash', 267, '101.3698347108', '500', '', '', '1', ''),
(29, '330322', 'admin', '2020-07-28 10:30:49', 'cash', 1000, '-265.2173913043', '1000', '', '', '1', ''),
(30, '660', 'admin', '2020-07-29 10:57:04', 'cash', 700, '300', '700', '', '', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `transaction_id` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `batch` varchar(20) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `st` varchar(10) NOT NULL,
  `rest` int(1) NOT NULL,
  `has_bonus` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`transaction_id`, `invoice`, `product`, `quantity`, `amount`, `profit`, `price`, `discount`, `date`, `batch`, `balance`, `st`, `rest`, `has_bonus`) VALUES
(1, '0333372', '3', '1', '100', '82.888344560115', 100, '0', '2020-07-29 11:00:58', '', '425', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales_returns`
--

CREATE TABLE `sales_returns` (
  `transaction_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `cashtendered` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `paid` varchar(3) NOT NULL,
  `customer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `slogan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `address`, `phone`, `slogan`) VALUES
(1, 'test pharmacy', 'kisumu', ' 254739289235', '        we wish you a quick recovery');

-- --------------------------------------------------------

--
-- Table structure for table `stock_take`
--

CREATE TABLE `stock_take` (
  `id` int(10) NOT NULL,
  `drug_id` int(10) NOT NULL,
  `initial_qty` varchar(10) NOT NULL,
  `final_qty` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_take`
--

INSERT INTO `stock_take` (`id`, `drug_id`, `initial_qty`, `final_qty`, `date`) VALUES
(1, 3, '400', '400', '2020-08-01 16:58:04'),
(2, 4, '1', '1', '2020-08-01 16:58:04'),
(3, 5, '200', '200', '2020-08-01 16:58:04'),
(4, 6, '78', '78', '2020-08-01 16:58:04'),
(5, 7, '25', '25', '2020-08-01 16:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `supliers`
--

CREATE TABLE `supliers` (
  `suplier_id` int(11) NOT NULL,
  `suplier_name` varchar(100) NOT NULL,
  `suplier_address` varchar(100) NOT NULL,
  `suplier_contact` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supliers`
--

INSERT INTO `supliers` (`suplier_id`, `suplier_name`, `suplier_address`, `suplier_contact`, `contact_person`, `note`) VALUES
(1, 'Eastleigh Pharmaceuticlas', 'P.O Box ..... Eldoret.', 'Ruth', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `idno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `contact`, `name`, `position`, `idno`) VALUES
(28, 'admin', 'ec6a6536ca304edf844d1d248a4f08dc', '', 'admin', 'admin', ''),
(29, 'pharmacist', 'ec6a6536ca304edf844d1d248a4f08dc', '', 'pharmacist', 'pharmacist', ''),
(30, 'cashier', 'ec6a6536ca304edf844d1d248a4f08dc', '', 'cashier', 'cashier', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bincard`
--
ALTER TABLE `bincard`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `deviation`
--
ALTER TABLE `deviation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenselist`
--
ALTER TABLE `expenselist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expiries`
--
ALTER TABLE `expiries`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `expiriestt`
--
ALTER TABLE `expiriestt`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `loginusers`
--
ALTER TABLE `loginusers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `project2_audit`
--
ALTER TABLE `project2_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `purchases2`
--
ALTER TABLE `purchases2`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `purchases_item`
--
ALTER TABLE `purchases_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `sales_returns`
--
ALTER TABLE `sales_returns`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_take`
--
ALTER TABLE `stock_take`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supliers`
--
ALTER TABLE `supliers`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bincard`
--
ALTER TABLE `bincard`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deviation`
--
ALTER TABLE `deviation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenselist`
--
ALTER TABLE `expenselist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expiries`
--
ALTER TABLE `expiries`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expiriestt`
--
ALTER TABLE `expiriestt`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loginusers`
--
ALTER TABLE `loginusers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project2_audit`
--
ALTER TABLE `project2_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases2`
--
ALTER TABLE `purchases2`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchases_item`
--
ALTER TABLE `purchases_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_returns`
--
ALTER TABLE `sales_returns`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_take`
--
ALTER TABLE `stock_take`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supliers`
--
ALTER TABLE `supliers`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
