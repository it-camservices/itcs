-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2013 at 03:52 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `itcam_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter_ips`
--

CREATE TABLE IF NOT EXISTS `counter_ips` (
  `ip` varchar(15) NOT NULL,
  `visit` datetime NOT NULL,
  UNIQUE KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counter_ips`
--

INSERT INTO `counter_ips` (`ip`, `visit`) VALUES
('::1', '2013-11-01 20:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `counter_values`
--

CREATE TABLE IF NOT EXISTS `counter_values` (
  `id` bigint(11) NOT NULL,
  `day_id` bigint(11) NOT NULL,
  `day_value` bigint(11) NOT NULL,
  `yesterday_id` bigint(11) NOT NULL,
  `yesterday_value` bigint(11) NOT NULL,
  `week_id` bigint(11) NOT NULL,
  `week_value` bigint(11) NOT NULL,
  `month_id` bigint(11) NOT NULL,
  `month_value` bigint(11) NOT NULL,
  `year_id` bigint(11) NOT NULL,
  `year_value` bigint(11) NOT NULL,
  `all_value` bigint(11) NOT NULL,
  `record_date` datetime NOT NULL,
  `record_value` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counter_values`
--

INSERT INTO `counter_values` (`id`, `day_id`, `day_value`, `yesterday_id`, `yesterday_value`, `week_id`, `week_value`, `month_id`, `month_value`, `year_id`, `year_value`, `all_value`, `record_date`, `record_value`) VALUES
(1, 305, 9, 304, 0, 44, 9, 11, 9, 2013, 76, 76, '2013-10-10 14:39:56', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '110731aaea2930299a0617955c404888');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE IF NOT EXISTS `tbl_client` (
  `client_id` int(10) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `order_by` int(10) NOT NULL,
  `cate_id` int(10) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`client_id`, `client_name`, `photo`, `link`, `order_by`, `cate_id`) VALUES
(1, 'Explore Vanishing Culture', 'immalis-hotel.jpeg', '#', 1, 1),
(2, 'Explore Vanishing Culture', 'khmer-kitchen.jpeg', '#', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_category`
--

CREATE TABLE IF NOT EXISTS `tbl_client_category` (
  `cate_id` int(10) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `character` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_client_category`
--

INSERT INTO `tbl_client_category` (`cate_id`, `cate_name`, `character`) VALUES
(1, 'Hotel Web Solution', '-'),
(2, 'Business Web Solution', '-'),
(3, 'Travel Web Solution', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_experiences`
--

CREATE TABLE IF NOT EXISTS `tbl_experiences` (
  `exper_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `positions` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `photos` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `sort_text` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `full_text` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`exper_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_experiences`
--

INSERT INTO `tbl_experiences` (`exper_id`, `name`, `positions`, `photos`, `sort_text`, `full_text`) VALUES
(1, 'Kheng Borin', 'Web Developer', 'borins.jpg', '<p>&nbsp;Kheng Borin</p>', '<p>&nbsp;klasjdk</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE IF NOT EXISTS `tbl_service` (
  `service_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `order_by` int(11) NOT NULL,
  `character` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`service_id`, `name`, `description`, `order_by`, `character`) VALUES
(1, 'Web Solution', '<p>&nbsp;This Page is Building</p>', 1, '-'),
(2, 'Network Project', '<p>&nbsp;This page is Building</p>', 2, '-'),
(3, 'System Development', '<p>&nbsp;This page is Building</p>', 3, '-'),
(4, 'Mantainance', '<p>&nbsp;This page is Building</p>', 4, '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slide`
--

CREATE TABLE IF NOT EXISTS `tbl_slide` (
  `banner_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order_by` int(10) NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_slide`
--

INSERT INTO `tbl_slide` (`banner_id`, `title`, `images`, `order_by`, `description`) VALUES
(1, 'IT-Camservice Slide 1', 'slider3.jpg', 1, '<p>&nbsp;IT-Camservice Slide 1</p>'),
(2, 'IT-Camservice Slide 1', 'slider2.jpg', 1, '<p>&nbsp;IT-Camservice Slide 1</p>'),
(3, 'IT-Camservice Slide 1', 'slider1.jpg', 1, '<p>&nbsp;IT-Camservice Slide 1</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_webpage`
--

CREATE TABLE IF NOT EXISTS `tbl_webpage` (
  `web_id` int(10) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `site_keyword` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `site_description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `page_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `page_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descriptions` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`web_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_webpage`
--

INSERT INTO `tbl_webpage` (`web_id`, `site_title`, `site_keyword`, `site_description`, `page_name`, `page_title`, `descriptions`) VALUES
(1, 'IT-CAMBODIA || Siem Reap Angnkor Cambodia', 'it-camservice,it-cam,siem reap design,angkor design,cambodia design,design siem reap,design angkor,cambodia services.', 'I am a Web Solutions Consultant. I offer professional website design, web application development and graphic design services. Having many years’ experience, I know that a high-quality, eye-catching website helps to increase sales and improve custome', 'Home', 'WELCOME TO IT-CAMBODIA SERVICES', '<h3 style="margin: 0px 10px; padding: 0px; color: rgb(255, 51, 0); font-family: Arial, Helvetica, sans-serif;">PROFESSIONAL WEB DESIGN &amp; DEVELOPMENT</h3>\r\n<p align="justify" style="margin: 10px; padding: 0px; line-height: 30px; font-size: 15px; font-family: arial, tahoma, sans-serif;">I am a Web Solutions Consultant. I offer professional website design, web application development and graphic design services. Having many years&rsquo; experience, I know that a high-quality, eye-catching website helps to increase sales and improve customer relationships, thereby increasing your business&rsquo;s bottom line. I have the professional expertise and knowledge to help you get the online results you want. If you are looking to create a beautiful, customer-friendly, professional website then you have come to the right place. Whether your business is large or small, I can create a web solution that gives a professional online presence without breaking your budget.</p>\r\n<h3 style="margin: 0px 10px; padding: 0px; color: rgb(255, 51, 0); font-family: Arial, Helvetica, sans-serif;">WEB DESIGN</h3>\r\n<p align="justify" style="margin: 10px; padding: 0px; line-height: 30px; font-size: 15px; font-family: arial, tahoma, sans-serif;">If you are looking for an eye-catching, modern and professional website to promote your business and connect with customers, I can assist. With my wealth of web solutions experience and knowledge, I can assess your online requirements to create a striking and user-friendly website to suit your needs. Choose from one of my web design packages or let me custom-build one to suit your budget. Your professional website will be easy to use, attractive to look at and developed to maximise search engine hits, making it the perfect tool to build sales opportunities and gain customer confidence.</p>\r\n<h3 style="margin: 0px 10px; padding: 0px; color: rgb(255, 51, 0); font-family: Arial, Helvetica, sans-serif;">WEB DEVELOPMENT</h3>\r\n<p align="justify" style="margin: 10px; padding: 0px; line-height: 30px; font-size: 15px; font-family: arial, tahoma, sans-serif;">I am highly experienced in the design and development of web applications such as e-commerce, CMS (content management systems), payment systems or custom database projects for integration with your website. Tell me your web application needs and I will work with you to develop an appropriate solution. My experience with open source technology will help to make your business more successful.</p>\r\n<h3 style="margin: 0px 10px; padding: 0px; color: rgb(255, 51, 0); font-family: Arial, Helvetica, sans-serif;">GRAPHIC DESIGN</h3>\r\n<p align="justify" style="margin: 10px; padding: 0px; line-height: 30px; font-size: 15px; font-family: arial, tahoma, sans-serif;">Are you searching for the right look for your business? Do you have a design concept that you need developed? My professional graphic design services can assist to develop creative logos, business cards, brochures, or an entire graphic design program of marketing and communications pieces to suit your business needs.</p>\r\n<h3 style="margin: 0px 10px; padding: 0px; color: rgb(255, 51, 0); font-family: Arial, Helvetica, sans-serif;">WEB HOSTING</h3>\r\n<p align="justify" style="margin: 10px; padding: 0px; line-height: 30px; font-size: 15px; font-family: arial, tahoma, sans-serif;">I offer affordable website hosting with associated high-quality services. With professional care 24 hours a day, you can be sure that business on your Website will go smoothly..</p>'),
(2, 'Our Services - IT-CAMBODIA SERVICES', 'it-camservice,it-cam,siem reap design,angkor design,cambodia design,design siem reap,design angkor,cambodia services.', 'I am a Web Solutions Consultant. I offer professional website design, web application development and graphic design services. Having many years’ experience, I know that a high-quality, eye-catching website helps to increase sales and improve custome', 'Service', 'Our Services', '<p>Under Construction</p>'),
(3, 'Domain Name - IT-CAMBODIA SERVICES', 'it-camservice,it-cam,siem reap design,angkor design,cambodia design,design siem reap,design angkor,cambodia services.', 'I am a Web Solutions Consultant. I offer professional website design, web application development and graphic design services. Having many years’ experience, I know that a high-quality, eye-catching website helps to increase sales and improve custome', 'Domain Name', 'Domain Name', '<p>Under Construction</p>'),
(4, 'Hosting - IT-CAMBODIA SERVICES', 'it-camservice,it-cam,siem reap design,angkor design,cambodia design,design siem reap,design angkor,cambodia services.', 'I am a Web Solutions Consultant. I offer professional website design, web application development and graphic design services. Having many years’ experience, I know that a high-quality, eye-catching website helps to increase sales and improve custome', 'Hosting', 'About Hosting', '<p>Under Construction</p>'),
(5, 'About Us - IT-CAMBODIA SERVICES', 'it-camservice,it-cam,siem reap design,angkor design,cambodia design,design siem reap,design angkor,cambodia services.', 'I am a Web Solutions Consultant. I offer professional website design, web application development and graphic design services. Having many years’ experience, I know that a high-quality, eye-catching website helps to increase sales and improve custome', 'About Us', 'About Us', '<p>Under Construction</p>'),
(6, 'Our Client - IT-CAMBODIA SERVICES', 'it-camservice,it-cam,siem reap design,angkor design,cambodia design,design siem reap,design angkor,cambodia services.', 'I am a Web Solutions Consultant. I offer professional website design, web application development and graphic design services. Having many years’ experience, I know that a high-quality, eye-catching website helps to increase sales and improve custome', 'Our Client', 'Our Client', '<p>Under Construction</p>'),
(7, 'Our Experiences - IT-CAMBODIA SERVICES', 'it-camservice,it-cam,siem reap design,angkor design,cambodia design,design siem reap,design angkor,cambodia services.', 'I am a Web Solutions Consultant. I offer professional website design, web application development and graphic design services. Having many years’ experience, I know that a high-quality, eye-catching website helps to increase sales and improve custome', 'Our Experiences', 'Our Experiences', '<p>Under Construction</p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
