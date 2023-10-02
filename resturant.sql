-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2022 at 09:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resturant`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `cash_serial` int(20) NOT NULL,
  `op_code` int(10) NOT NULL,
  `op_tree_code_in` int(10) NOT NULL,
  `op_tree_code_out` int(10) NOT NULL,
  `cash_in` int(10) NOT NULL,
  `cash_out` int(10) NOT NULL,
  `op_total` float NOT NULL,
  `op_added` float NOT NULL,
  `op_discont` float NOT NULL,
  `op_safi` float NOT NULL,
  `pay_select` varchar(10) NOT NULL,
  `op_discont_out` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`cash_serial`, `op_code`, `op_tree_code_in`, `op_tree_code_out`, `cash_in`, `cash_out`, `op_total`, `op_added`, `op_discont`, `op_safi`, `pay_select`, `op_discont_out`) VALUES
(1, 1, 120100001, 310100001, 100000, 0, 100000, 0, 0, 100000, '', 0),
(2, 2, 120300002, 120100001, 0, 14000, 14000, 0, 0, 14000, 'دفع نقداً', 0),
(3, 3, 120100001, 210100001, 20000, 0, 20000, 0, 0, 20000, 'دفع نقداً', 0),
(5, 6, 120100001, 120300005, 50, 0, 50, 0, 0, 50, '', 0),
(6, 7, 120100001, 120300005, 50, 0, 50, 0, 0, 50, '', 0),
(7, 8, 120300005, 120100001, 0, 100, 100, 0, 0, 100, '', 0),
(9, 10, 120100001, 210100001, 100, 0, 100, 0, 0, 100, '', 0),
(10, 11, 120100001, 210100001, 200, 0, 200, 0, 0, 200, 'دفع نقداً', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `it_id` int(50) NOT NULL,
  `it_barcode` varchar(50) NOT NULL,
  `it_name` varchar(255) NOT NULL,
  `it_section` int(100) NOT NULL,
  `it_min_un` int(100) NOT NULL,
  `it_pr_in` float NOT NULL,
  `it_pr_out` float NOT NULL,
  `it_min_qty` int(10) NOT NULL,
  `it_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`it_id`, `it_barcode`, `it_name`, `it_section`, `it_min_un`, `it_pr_in`, `it_pr_out`, `it_min_qty`, `it_img`) VALUES
(1, '124521454214524', 'سندوتش سمك', 6, 4, 300, 500, 100, '060322015610سندوتش سمك.jpg'),
(2, '', 'سندوتش فول', 6, 4, 200, 300, 10, '060322015233سندوتش فول.jpg'),
(3, '', 'طعمية', 6, 4, 140, 200, 15, '060322015014طعمية.jpg'),
(4, '', 'شاورما', 6, 4, 500, 700, 100, '060322110326سندوتش شاورما.jpg'),
(5, '', 'كباب', 6, 4, 400, 600, 100, '070322015941كباب.jpg'),
(6, '', 'شيبس', 6, 4, 300, 400, 50, '070322015829شيبس.jpg'),
(7, '', 'سندويتش كبدة', 6, 4, 650, 850.55, 100, '070322015814كبدة.jpg'),
(8, '', 'بيرغر', 6, 10, 800, 1000, 10, '070322015801سندويتش بيرغر.jpg'),
(9, '', 'هوت دوغ جامبو', 6, 4, 980, 1100, 5, '070322015731هوت دوغ.jpg'),
(10, '', 'آبري', 9, 4, 50, 100, 20, '110322034536عصير لبري.jpg'),
(11, '', 'صندوق شكولاتة', 11, 4, 100, 150, 5, ''),
(12, '', 'بيبسي', 5, 9, 100, 200, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `items_units`
--

CREATE TABLE `items_units` (
  `it_un_id` int(100) NOT NULL,
  `it_id` int(50) NOT NULL,
  `un_id` int(100) NOT NULL,
  `un_pr_in` float NOT NULL,
  `un_pr_out` float NOT NULL,
  `un_eq` float NOT NULL,
  `is_min_un` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items_units`
--

INSERT INTO `items_units` (`it_un_id`, `it_id`, `un_id`, `un_pr_in`, `un_pr_out`, `un_eq`, `is_min_un`) VALUES
(1, 1, 9, 171.5, 280.5, 1, 1),
(2, 2, 4, 200, 300, 1, 1),
(3, 0, 5, 1000, 1500, 3, 0),
(5, 2, 8, 1500, 2200, 30, 0),
(7, 1, 4, 100, 150, 1, 0),
(8, 3, 4, 140, 200, 1, 1),
(9, 4, 4, 500, 700, 1, 1),
(10, 5, 4, 400, 600, 1, 1),
(11, 6, 4, 300, 400, 1, 1),
(12, 7, 4, 650, 850.55, 1, 1),
(13, 8, 10, 800, 1000, 1, 1),
(14, 9, 4, 980, 1250.5, 1, 1),
(17, 8, 11, 900, 1650.5, 2, 0),
(18, 10, 4, 50, 100, 1, 1),
(19, 11, 4, 100, 150, 1, 1),
(20, 11, 8, 1500, 2500, 30, 0),
(21, 12, 9, 100, 200, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `op`
--

CREATE TABLE `op` (
  `op_type` int(2) DEFAULT NULL,
  `op_code` int(20) NOT NULL,
  `op_date` date DEFAULT NULL,
  `op_time` varchar(10) DEFAULT NULL,
  `op_us_code` int(10) DEFAULT NULL,
  `op_code_year` int(10) DEFAULT NULL,
  `op_tree_code` int(10) DEFAULT NULL,
  `op_tree_name` int(20) NOT NULL,
  `op_note` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `op`
--

INSERT INTO `op` (`op_type`, `op_code`, `op_date`, `op_time`, `op_us_code`, `op_code_year`, `op_tree_code`, `op_tree_name`, `op_note`) VALUES
(6, 1, '2022-03-17', '18:36', 1, 1, 210200001, 0, 'رصيد بداية البرنامج'),
(1, 2, '2022-03-17', '18:37', 1, 1, 120300002, 120300002, ''),
(2, 3, '2022-03-17', '18:42', 1, 1, 210100001, 210100001, ''),
(14, 6, '2022-03-17', '18:45', 1, 1, 210200001, 0, ''),
(14, 7, '2022-03-17', '18:46', 1, 2, 210200001, 0, ''),
(7, 8, '2022-03-17', '18:46', 1, 1, 210200001, 0, ''),
(14, 10, '2022-03-17', '19:19', 1, 3, 210200001, 0, ''),
(2, 11, '2022-03-18', '10:32', 10, 1, 210100001, 210100001, ''),
(2, 12, '2022-03-18', '10:32', 10, 2, 210200001, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `op_det`
--

CREATE TABLE `op_det` (
  `op_serial` int(30) NOT NULL,
  `op_code2` int(30) DEFAULT NULL,
  `op_it_code` int(30) DEFAULT NULL,
  `op_it_un_code` int(30) DEFAULT NULL,
  `op_it_un_eq` double DEFAULT NULL,
  `op_it_qty` double DEFAULT NULL,
  `op_it_qty_eq` double DEFAULT NULL,
  `op_it_pr_khasm` float NOT NULL,
  `op_it_price` double DEFAULT NULL,
  `op_it_pr_in` double DEFAULT NULL,
  `op_it_exp` date DEFAULT NULL,
  `op_st_code` int(30) DEFAULT NULL,
  `op_it_note` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `op_det`
--

INSERT INTO `op_det` (`op_serial`, `op_code2`, `op_it_code`, `op_it_un_code`, `op_it_un_eq`, `op_it_qty`, `op_it_qty_eq`, `op_it_pr_khasm`, `op_it_price`, `op_it_pr_in`, `op_it_exp`, `op_st_code`, `op_it_note`) VALUES
(1, 2, 3, 4, 2, 100, 14000, 0, 200, 140, '0000-00-00', 120600001, ''),
(6, 3, 3, 4, 1, 100, 20000, 0, 200, 140, '0000-00-00', 120600001, ''),
(9, 11, 3, 4, 1, 1, 200, 0, 200, 140, '0000-00-00', 120600001, '');

-- --------------------------------------------------------

--
-- Table structure for table `op_type`
--

CREATE TABLE `op_type` (
  `type_code` int(2) NOT NULL,
  `type_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `op_type`
--

INSERT INTO `op_type` (`type_code`, `type_name`) VALUES
(1, 'المشتريات'),
(2, 'المبيعات'),
(3, 'مرتجع مشتريات'),
(4, 'مرتجع مبيعات'),
(5, 'فاتورة مبدئية'),
(6, 'ايرادات'),
(7, 'منصرفات'),
(8, 'قيود يومية'),
(9, 'بضاعة اول المدة'),
(10, 'ترحيلات بين المخازن'),
(11, 'ارصدة افتتاحية'),
(12, 'شيكات'),
(13, ' سداد دين لحساب'),
(14, 'سداد دين من حساب');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sec_id` int(100) NOT NULL,
  `sec_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sec_id`, `sec_name`) VALUES
(3, '1 الاكل البلدي'),
(4, '2 الاكل العربي'),
(5, '8 مشروب غازي'),
(6, '5 السندويتشات'),
(7, '3 المشويات'),
(8, '6 مشروب ساخن'),
(9, '7 عصير طبيعي'),
(10, '4 الـــدجــاج'),
(11, '9 الـتـحـلـيـة');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `set_id` int(1) NOT NULL,
  `set_us_username` varchar(50) NOT NULL,
  `set_currency` varchar(10) NOT NULL DEFAULT 'ج',
  `set_currency_fa` varchar(20) NOT NULL DEFAULT 'fa fa-pound-sign',
  `set_lang` varchar(2) NOT NULL DEFAULT 'ar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`set_id`, `set_us_username`, `set_currency`, `set_currency_fa`, `set_lang`) VALUES
(1, 'admin', 'ج', 'fa fa-pound-sign', 'ar');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `ser_no` int(50) NOT NULL,
  `op_code` int(10) NOT NULL,
  `op_st_code` int(10) NOT NULL,
  `op_type` int(3) NOT NULL,
  `it_code` int(10) NOT NULL,
  `un_code` int(10) NOT NULL,
  `it_qty_in` int(10) NOT NULL,
  `it_qty_out` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`ser_no`, `op_code`, `op_st_code`, `op_type`, `it_code`, `un_code`, `it_qty_in`, `it_qty_out`) VALUES
(1, 2, 120600001, 1, 3, 4, 100, 0),
(2, 3, 120600001, 2, 3, 4, 0, 100),
(5, 11, 120600001, 2, 3, 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tree1`
--

CREATE TABLE `tree1` (
  `tree1_code` int(10) NOT NULL,
  `tree1_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tree1`
--

INSERT INTO `tree1` (`tree1_code`, `tree1_name`) VALUES
(1, 'الأصول'),
(2, 'الخصوم'),
(3, 'حقوق الملكية'),
(4, 'الإيرادات'),
(5, 'المنصرفات');

-- --------------------------------------------------------

--
-- Table structure for table `tree2`
--

CREATE TABLE `tree2` (
  `tree1_code` int(10) DEFAULT NULL,
  `tree2_code` int(10) NOT NULL,
  `tree2_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tree2`
--

INSERT INTO `tree2` (`tree1_code`, `tree2_code`, `tree2_name`) VALUES
(1, 11, 'الأصول الثابتة'),
(1, 12, 'الأصول المتداولة'),
(2, 21, 'الخصوم'),
(3, 31, 'رأس المال'),
(3, 32, 'جاري شريك'),
(3, 33, 'مساهمون'),
(4, 41, 'إيرادات المبيعات'),
(4, 42, 'إيرادات اخرى'),
(5, 51, 'المشتريات'),
(5, 52, 'المنصرفات الأخرى');

-- --------------------------------------------------------

--
-- Table structure for table `tree3`
--

CREATE TABLE `tree3` (
  `tree2_code` int(10) DEFAULT NULL,
  `tree3_code` int(10) NOT NULL,
  `tree3_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tree3`
--

INSERT INTO `tree3` (`tree2_code`, `tree3_code`, `tree3_name`) VALUES
(11, 1101, 'العقارات والاراضي'),
(11, 1102, 'السيارات والاليات'),
(12, 1201, 'نقدية بالخزنة'),
(12, 1202, 'نقدية بالبنك'),
(12, 1203, 'العملاء'),
(12, 1204, 'مرتبات الموظفين'),
(12, 1205, 'سلفيات الموظفين'),
(12, 1206, 'المخزن'),
(21, 2101, 'الموردون'),
(21, 2102, 'المدينون'),
(31, 3101, 'رأس المال'),
(32, 3201, 'جاري شريك'),
(33, 3301, 'مساهمون'),
(41, 4101, 'إيرادات المبيعات'),
(42, 4201, 'إيرادات اخرى'),
(51, 5101, 'المشتريات'),
(52, 5201, 'منصرفات ادارية'),
(52, 5202, 'المنصرفات الاخرى');

-- --------------------------------------------------------

--
-- Table structure for table `tree4`
--

CREATE TABLE `tree4` (
  `tree3_code` int(10) DEFAULT NULL,
  `tree4_code` int(10) NOT NULL,
  `tree4_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tree4`
--

INSERT INTO `tree4` (`tree3_code`, `tree4_code`, `tree4_name`) VALUES
(1201, 120100001, 'الخزنة الرئيسية'),
(1202, 120200001, 'بنك فيصل الاسلامي'),
(1202, 120200002, 'بنك الخرطوم'),
(1202, 120200003, 'بنك ام درمان'),
(1203, 120300001, 'عميل عام'),
(1203, 120300002, 'شركة السهم'),
(1203, 120300003, 'علي سعيد الكعبي'),
(1203, 120300004, 'صدام الطيب'),
(1203, 120300005, 'آمنة الامين'),
(1204, 120400001, 'حسن الجعلي'),
(1206, 120600001, 'المخزن الرئيسي'),
(2101, 210100001, 'محمد الامين'),
(2101, 210100002, 'صنع محلي'),
(3101, 310100001, 'راس المال'),
(5202, 520200001, 'اجار شهري'),
(5202, 520200002, 'الكهرباء والماء');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `un_id` int(50) NOT NULL,
  `un_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`un_id`, `un_name`) VALUES
(2, 'نص طلب'),
(3, 'ربع طلب'),
(4, 'عدد واحد'),
(5, 'عدد ربع دستة'),
(6, 'عدد نص دستة'),
(7, 'عدد دستة'),
(8, 'كرتونة'),
(9, 'بارد موبايل'),
(10, 'عادي'),
(11, 'جامبو');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `us_code` int(15) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `us_pass` varchar(50) DEFAULT NULL,
  `us_name` varchar(100) DEFAULT NULL,
  `us_img` varchar(255) NOT NULL,
  `us_status` int(1) DEFAULT NULL,
  `us_role` varchar(10) DEFAULT NULL,
  `us_lang` varchar(2) DEFAULT NULL,
  `us_theme` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`us_code`, `username`, `us_pass`, `us_name`, `us_img`, `us_status`, `us_role`, `us_lang`, `us_theme`) VALUES
(1, 'admin', 'admin', 'مدير', '070322041826139588725_844604509439669_180495486200801689_n - Copy (2).jpg', 1, 'مــدير', 'ar', 'dark'),
(4, 'ali', '0000', 'علي الضو', '', 0, 'مــستخدم', 'ar', 'light'),
(6, 'saddam2', '0000', 'صدام الطيب', '050322114244139588725_844604509439669_180495486200801689_n - Copy (2).jpg', 1, 'مــدير', 'ar', 'light'),
(8, 'moneeb2', '0000', 'منيب', '040322024258bd4423e5ce76ae8a54d3b4c9057f22d3-full.jpg', 1, 'مــستخدم', 'ar', 'light'),
(10, 'احمد', '0000', 'احمد طبنجة', '', 1, 'مــشرف', 'ar', 'dark');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`cash_serial`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`it_id`);

--
-- Indexes for table `items_units`
--
ALTER TABLE `items_units`
  ADD PRIMARY KEY (`it_un_id`);

--
-- Indexes for table `op`
--
ALTER TABLE `op`
  ADD PRIMARY KEY (`op_code`),
  ADD KEY `op_fk_op_type` (`op_type`),
  ADD KEY `op_fk_users` (`op_us_code`),
  ADD KEY `op_fk_tree4` (`op_tree_code`);

--
-- Indexes for table `op_det`
--
ALTER TABLE `op_det`
  ADD PRIMARY KEY (`op_serial`),
  ADD KEY `op_det_fk_op` (`op_code2`);

--
-- Indexes for table `op_type`
--
ALTER TABLE `op_type`
  ADD PRIMARY KEY (`type_code`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`set_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ser_no`);

--
-- Indexes for table `tree1`
--
ALTER TABLE `tree1`
  ADD PRIMARY KEY (`tree1_code`);

--
-- Indexes for table `tree2`
--
ALTER TABLE `tree2`
  ADD PRIMARY KEY (`tree2_code`),
  ADD KEY `tree2_fk_tree1` (`tree1_code`);

--
-- Indexes for table `tree3`
--
ALTER TABLE `tree3`
  ADD PRIMARY KEY (`tree3_code`),
  ADD KEY `tree3_fk_tree2` (`tree2_code`);

--
-- Indexes for table `tree4`
--
ALTER TABLE `tree4`
  ADD PRIMARY KEY (`tree4_code`),
  ADD KEY `tree4_fk_tree3` (`tree3_code`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`un_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`us_code`),
  ADD UNIQUE KEY `us_id` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `cash_serial` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `it_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `items_units`
--
ALTER TABLE `items_units`
  MODIFY `it_un_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `op_det`
--
ALTER TABLE `op_det`
  MODIFY `op_serial` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sec_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `set_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `ser_no` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `un_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `us_code` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `op_det`
--
ALTER TABLE `op_det`
  ADD CONSTRAINT `op_det_fk_op` FOREIGN KEY (`op_code2`) REFERENCES `op` (`op_code`);

--
-- Constraints for table `tree2`
--
ALTER TABLE `tree2`
  ADD CONSTRAINT `tree2_fk_tree1` FOREIGN KEY (`tree1_code`) REFERENCES `tree1` (`tree1_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
