-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2018 at 05:17 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `list_all`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_admin`
--

CREATE TABLE `list_admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `fname` varchar(500) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_admin`
--

INSERT INTO `list_admin` (`admin_id`, `email`, `fname`, `lname`, `password`, `status`) VALUES
(1, 'admin@gmail.com', 'Nazish', 'Fraz', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_category`
--

CREATE TABLE `list_category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `category_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_category`
--

INSERT INTO `list_category` (`category_id`, `parent_id`, `category_name`) VALUES
(1, 2, 'Shopping'),
(2, 0, 'Online'),
(3, 2, 'Tutorial'),
(4, 2, 'Food'),
(5, 4, 'Pizza'),
(6, 2, 'Recharge'),
(7, 2, 'Wallet'),
(8, 2, 'News'),
(9, 2, 'Movie'),
(10, 0, 'Download'),
(11, 10, 'Media'),
(13, 10, 'Movie'),
(16, 10, 'Apps/Games'),
(17, 2, 'Converter'),
(18, 2, 'Train'),
(19, 2, 'Game'),
(23, 17, 'Audio'),
(22, 17, 'Video'),
(27, 45, 'Internship'),
(28, 45, 'Freelance'),
(30, 10, 'Pdf'),
(32, 16, 'Pc'),
(33, 16, 'ios'),
(34, 16, 'Android'),
(35, 16, 'Java'),
(36, 16, 'Symbian'),
(45, 0, 'Jobs'),
(46, 45, 'Jobs');

-- --------------------------------------------------------

--
-- Table structure for table `list_website`
--

CREATE TABLE `list_website` (
  `website_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `website_name` varchar(100) NOT NULL,
  `url` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_website`
--

INSERT INTO `list_website` (`website_id`, `category_id`, `website_name`, `url`) VALUES
(1, 1, 'Snapdeal', 'https://snapdeal.com'),
(2, 1, 'Amazon', 'https://amazon.in'),
(3, 1, 'Flipcart', 'https://flipcart.com'),
(4, 1, 'Voonik', 'https://voonik.com'),
(5, 1, 'Shopclues', 'http://www.shopclues.com'),
(6, 5, 'Dominos', 'http://www.dominos.co.in/'),
(7, 4, 'Foodpanda', 'https://www.foodpanda.in'),
(8, 4, 'Zomato', 'https://www.zomato.com'),
(9, 4, 'Swiggy', 'https://www.swiggy.com'),
(10, 5, 'Pizzahut', 'https://online.pizzahut.co.in'),
(11, 6, 'Mobikwik', 'https://www.mobikwik.com/'),
(12, 6, 'Paytm', 'https://paytm.com/'),
(13, 1, 'Paytm', 'https://paytm.com/'),
(14, 7, 'Paytm', 'https://paytm.com'),
(15, 7, 'Mobikwik', 'https://www.mobikwik.com/'),
(55, 19, 'Miniclip', 'https://www.miniclip.com/games/en/'),
(54, 19, 'Pogo', 'http://www.pogo.com'),
(19, 27, 'LetsIntern', 'http://www.letsintern.com'),
(20, 27, 'EduInfo', 'http://eduinfo.asia'),
(21, 27, 'HelloIntern', 'https://www.hellointern.com'),
(22, 27, '10Internship', 'https://10internship.in'),
(23, 27, 'LookSharp', 'https://www.looksharp.com/internships'),
(24, 28, 'Freelancer', 'http://www.freelancer.com'),
(25, 46, 'Freshersworld', 'https://www.freshersworld.com'),
(26, 27, 'Twenty19', 'http://www.twenty19.com'),
(27, 46, 'HeadHonchos', 'www.headhonchos.com'),
(28, 46, 'Shine', 'https://www.shine.com'),
(29, 46, 'Job Steet', 'https://www.jobstreet.com.sg'),
(30, 46, 'Naukri', 'https://www.naukri.com'),
(31, 46, 'LookSharp', 'https://www.looksharp.com'),
(32, 46, 'Angellist', 'https://angel.co/jobs'),
(33, 46, 'Hired', 'https://hired.com'),
(34, 46, 'JobOutLook', 'http://www.joboutlook.in/index.php'),
(35, 46, 'Indeed', 'http://www.indeed.co.in'),
(36, 46, 'GetAJob', 'http://www.mtvindia.com/getajob/'),
(37, 46, 'PrivateJobHub', 'http://www.privatejobhub.in'),
(38, 46, 'FineJobz', 'http://finejobz.com'),
(39, 27, 'Internshala', 'http://internshala.com'),
(41, 34, 'Hiapphere', 'http://m.hiapphere.com'),
(42, 34, '9Apps', 'https://www.9apps.com'),
(43, 34, 'Apk4fun', 'https://www.apk4fun.com'),
(44, 34, 'ApkMirror', 'http://www.apkmirror.com'),
(45, 34, 'Revdl', 'http://www.revdl.com'),
(46, 34, 'PlayMob', 'http://play.mob.org'),
(47, 34, 'AndroidApk', 'http://www.androidapksfree.com'),
(48, 34, 'OceanOfApk', 'https://oceanofapk.com'),
(49, 34, 'Apk4Market', 'https://www.apk4market.com'),
(50, 34, 'AndroidApkFree', 'http://www.androidapksfree.com'),
(51, 13, 'MyDTube', 'http://www.mydownloadtube.com'),
(52, 13, 'FreeMovie', 'http://freemoviedownloads6.com'),
(53, 13, 'HDMovie', 'http://hdmoviesmp4.org'),
(56, 19, 'Addicting', 'http://www.addictinggames.com'),
(57, 19, 'Kongregate', 'http://www.kongregate.com/games'),
(58, 19, 'ArmorGames', 'http://armorgames.com'),
(59, 19, 'Pch', 'http://www.pch.com/games'),
(60, 19, 'FreeOnline', 'http://www.freeonlinegames.com'),
(61, 19, 'Shockwave', 'http://www.shockwave.com/home.jsp'),
(62, 8, 'Indiatimes', 'http://www.indiatimes.com'),
(63, 8, 'NDTV', 'http://www.ndtv.com'),
(64, 8, 'Bhaskar', 'http://www.bhaskar.com'),
(65, 8, 'MoneyControl', 'http://www.moneycontrol.com'),
(66, 8, 'IndiaGroup', 'http://www.indiatodaygroup.com'),
(67, 8, 'India', 'http://www.india.com'),
(68, 8, 'TheHindu', 'http://www.thehindu.com'),
(69, 8, 'Jagran', 'http://www.jagran.com'),
(70, 8, 'OneIndia', 'http://www.oneindia.com'),
(71, 18, 'IndianRail', 'http://enquiry.indianrail.gov.in/ntes/'),
(72, 18, 'IRCTC', 'https://www.irctc.co.in/eticketing/loginHome.jsf'),
(73, 9, 'MyTube', 'https://www.mydownloadtube.com'),
(74, 9, 'MovieWatcher', 'http://moviewatcher.io'),
(75, 9, 'WatchMovie', 'https://watchmoviesfree.tv'),
(76, 9, 'OnlineMovie', 'https://onlinemoviewatchs.li');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_admin`
--
ALTER TABLE `list_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `list_category`
--
ALTER TABLE `list_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `list_website`
--
ALTER TABLE `list_website`
  ADD PRIMARY KEY (`website_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_admin`
--
ALTER TABLE `list_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `list_category`
--
ALTER TABLE `list_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `list_website`
--
ALTER TABLE `list_website`
  MODIFY `website_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;