-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2019 at 08:24 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graduation`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`ID`, `Name`) VALUES
(1, 'الفرقه الاولى'),
(2, 'الفرقه الثانيه'),
(3, 'الفرقه الثالثه'),
(4, 'الفرقه الرابعه');

-- --------------------------------------------------------

--
-- Table structure for table `academic_year_department`
--

CREATE TABLE `academic_year_department` (
  `ID` int(11) NOT NULL,
  `Academic_Year_ID` int(11) DEFAULT NULL,
  `Department_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academic_year_department`
--

INSERT INTO `academic_year_department` (`ID`, `Academic_Year_ID`, `Department_ID`) VALUES
(4, 4, 8),
(5, 4, 7),
(6, 1, 10),
(7, 3, 10),
(8, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `Course_ID` int(11) NOT NULL,
  `Course_Code` int(11) NOT NULL,
  `Course_Name` varchar(50) NOT NULL,
  `Year_Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`Course_ID`, `Course_Code`, `Course_Name`, `Year_Number`) VALUES
(1, 1457, 'تجاره الكترونيه', 4),
(2, 5478, 'التنقيب عن البيانات', 4),
(3, 789, 'مقدمه حاسبات', 1),
(5, 152, 'الرسم بالحاسب ', 3),
(6, 61, 'اساليب امان الحاسىب', 4),
(7, 159, 'انسانيات', 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_department`
--

CREATE TABLE `course_department` (
  `Course_ID` int(11) NOT NULL,
  `Department_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_department`
--

INSERT INTO `course_department` (`Course_ID`, `Department_ID`) VALUES
(6, 7),
(6, 8),
(2, 7),
(1, 7),
(5, 10),
(3, 10),
(7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `Day_ID` int(11) NOT NULL,
  `Day_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`Day_ID`, `Day_Name`) VALUES
(1, 'الاحد'),
(2, 'الاثنين'),
(3, 'الثلاثاء'),
(4, 'الاربعاء'),
(5, 'الخميس'),
(6, 'الجمعه'),
(7, 'السبت');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Department_ID` int(11) NOT NULL,
  `Department_Name` varchar(50) NOT NULL,
  `Description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Department_ID`, `Department_Name`, `Description`) VALUES
(7, 'نظم المعلومات', 'يهتم القسم كثيرا بقواعد البيانات\r\n'),
(8, 'علوم الحاسب', 'يهتم القسم بالجرافيك \r\n'),
(9, 'شبكات', 'يهتم القسم بانواع الشبكات وكيفيه التحكم ف الشبكه وتعريف الاجهزه'),
(10, 'عام', 'هذا القسم ينتمى اليه طلاب الفرقه الاولى والثانيه والثالثه'),
(15, 'معلوماتيه طبيه', 'لسه فاتح جديد بمصروفات');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_information`
--

CREATE TABLE `faculty_information` (
  `faculty_ID` int(11) NOT NULL,
  `Faculty_Name` varchar(50) NOT NULL,
  `Faculty_History` varchar(200) NOT NULL,
  `Faculty_Location` varchar(300) NOT NULL,
  `Year_Numbers` varchar(80) NOT NULL,
  `Enrollment_Rules` varchar(2000) NOT NULL,
  `Future_Career` varchar(2000) NOT NULL,
  `Summer_Tranning` varchar(2000) NOT NULL,
  `departmentConditions` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Adminstrition` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty_information`
--

INSERT INTO `faculty_information` (`faculty_ID`, `Faculty_Name`, `Faculty_History`, `Faculty_Location`, `Year_Numbers`, `Enrollment_Rules`, `Future_Career`, `Summer_Tranning`, `departmentConditions`, `Adminstrition`) VALUES
(1, ' كلية الحاسبات والمعلومات جامعة بنها', '    وافق المجلس الأعلى للجامعات على إنشاء كلية الحاسبات و المعلومات بجامعة بنها عام 2006', 'طريق بنها المنصورة الزراعى بجوتر الشركة القابضة لمياة الشرب والصرف الصحى ', 'مدة الدراسة فى الكلية اربع سنوات', 'يجب ان يكون الطالب يكون حاصل على الشهاده الثاونويه العامه ومجموعه مطابق للحد الادنى للاتحاق بالكليه', 'معظم الشركات الخاصة والحكومية تطلب تخصصات الحاسبات والمعلومات', 'تُتيح الكلية لطلابها التدريب الصيفي بداخل الكلية في الفرقة الأولى والثانية. أما في الفرقة الثالثة فتتيح التدريب لدى شركات الكمبيوتر (الحاسوب) في مصر', 'أن يكون الطالب ناجحاً بالفرقتين الأولى والثانية والثالثة', '    أ.د/ هالة حلمى محمد زايد عميد الكلية\r\n    أ.د/ طارق أحمد الششتاوى وكيل الكلية لشئون الدراسات العليا والبحوث\r\n    أ.م/ مازن سليم وكيل الكلية لشئون التعليم والطلاب');

-- --------------------------------------------------------

--
-- Table structure for table `Notification_Triger`
--

CREATE TABLE `Notification_Triger` (
  `id` int(11) NOT NULL,
  `notificatin_id` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `cdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifiction`
--

CREATE TABLE `notifiction` (
  `Notification_ID` int(11) NOT NULL,
  `Notification_Contents` varchar(2000) DEFAULT NULL,
  `URL` varchar(1000) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `File` varchar(255) DEFAULT NULL,
  `Student_Affairs_ID` int(11) DEFAULT NULL,
  `Teaching_staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifiction`
--

INSERT INTO `notifiction` (`Notification_ID`, `Notification_Contents`, `URL`, `Image`, `File`, `Student_Affairs_ID`, `Teaching_staff_id`) VALUES
(46, 'The lecture for  hsas been Postpone', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/45485432_index.jpeg', '', NULL, 14),
(47, 'The lecture for  hsas been Postpone', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/55466759_index.jpeg', '', NULL, 14),
(48, 'hi hebo', 'https://www.google.com/', '', '', 5, NULL),
(49, 'hi hebo', 'https://www.facebook.com/', 'http://127.0.1.1/AndroidUpload/uploadsimg/50817955_????,?????,???? ????? (9).jpg', '', NULL, 14),
(50, 'تم الغاء محاضرة اليوم ', 'https://www.facebook.com/', '', '', NULL, 13),
(51, '', 'https://www.facebook.com/', 'http://127.0.1.1/AndroidUpload/uploadsimg/63837924_شروق,الشمس,منظر طبيعى (9).jpg', '', NULL, 13),
(52, 'اعلان لطلاب الفرقة اﻻولى ', 'https://www.facebook.com/', '', '', 5, NULL),
(53, 'اعلان لطلاب الفرقة اﻻولى ', 'https://www.facebook.com/', '', '', 5, NULL),
(54, 'اعلان لطلاب الفرقةالتالته', 'https://www.facebook.com/', '', '', 5, NULL),
(55, 'اعلان لطلاب الفرقةالرابعه', 'https://www.facebook.com/', '', '', 5, NULL),
(56, 'اعلان لطلاب الفرقةالرابعه', 'https://www.facebook.com/', '', '', 5, NULL),
(57, '', '', '', '', 5, NULL),
(58, '', '', '', '', 5, NULL),
(59, '', '', '', '', 5, NULL),
(60, '', '', '', '', 5, NULL),
(61, 'hxbbsb', '', '', '', 5, NULL),
(62, 'from mobile', '', '', '', 5, NULL),
(63, 'from mobile', '', '', '', 5, NULL),
(64, 'from mobile', '', '', '', 5, NULL),
(65, 'from mobile', '', '', '', 5, NULL),
(66, '', '', '', '', 5, NULL),
(67, '', '', '', '', 5, NULL),
(68, 'hi', '', '', '', 5, NULL),
(69, 'hi from mobile', '', '', 'http://127.0.1.1/AndroidUpload/uploadspdf/document.pdf', 5, NULL),
(70, 'hi', '', '', 'document.pdf', 5, NULL),
(71, 'hi', '', '', '????? ???? 2018-11-14 11.35.29', 5, NULL),
(72, 'hi', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/6794583_??? ?????? ?? ???? ?????? ???????.png', 'http://127.0.1.1/AndroidUpload/uploadspdf/??? ?????? ?? ???? ?????? ???????.png', 5, NULL),
(73, 'hi', '', '', 'ERD.pdf', 5, NULL),
(74, 'hi', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/79433649_bgVk_NT9_400x400.jpg', 'http://127.0.1.1/AndroidUpload/uploadspdf/bgVk_NT9_400x400.jpg', 5, NULL),
(75, '', '', '', '1-sztuk-Big-Fajne-mier-Czaszki-Tatua-e-Dla-M-czyzn-pi-kne-Rami-Powr-t.jpg_640x640.jpg', 5, NULL),
(76, '', '', '', 'document.pdf', 5, NULL),
(77, 'gghhhhh', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/88021561_izQ6TVD4_400x400.jpg', 'http://127.0.1.1/AndroidUpload/uploadspdf/izQ6TVD4_400x400.jpg', 5, NULL),
(78, '', '', '', '', 5, NULL),
(79, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/42095225_images (7).jpeg', '', 5, NULL),
(80, 'photo', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/38997107_??? ?????? ?? ???? ?????? ???????.png', '', 5, NULL),
(81, 'pdf', '', '', '', 5, NULL),
(82, 'pdf', '', '', '', 5, NULL),
(83, '', '', '', 'http://127.0.1.1/AndroidUpload/uploadspdf/document.pdf', 5, NULL),
(85, 'is Teaching staff', 'https://www.facebook.com/', '', '', NULL, 14),
(86, 'all Teaching staff', 'https://www.facebook.com/', '', '', NULL, 12),
(87, 'all Teaching staff', 'https://www.facebook.com/', '', '', NULL, 12),
(88, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/9314794_bgVk_NT9_400x400.jpg', '', NULL, 12),
(89, 'is', '', '', 'http://127.0.1.1/AndroidUpload/uploadspdf/document.pdf', NULL, 12),
(90, 'cs', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/73837596_download.jpeg', '', NULL, 12),
(91, 'general', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/72745644_download.jpeg', '', NULL, 12),
(92, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/95187979_download.jpeg', '', NULL, 12),
(93, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/82502210_download.jpeg', '', NULL, 12),
(94, '', '', '', 'http://127.0.1.1/AndroidUpload/uploadspdf/document.pdf', NULL, 12),
(95, '', '', '', 'http://127.0.1.1/AndroidUpload/uploadspdf/document.pdf', NULL, 12),
(96, '', '', '', '', NULL, 12),
(97, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/91281158_download.jpeg', '', NULL, 12),
(98, 'all', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/45172741_images (1).jpeg', '', NULL, 12),
(99, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/95612439_??? ?????? ?? ???? ?????? ???????.png', '', NULL, 12),
(100, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/50739133_??? ?????? ?? ???? ?????? ???????.png', '', NULL, 12),
(101, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/76050282_??? ?????? ?? ???? ?????? ???????.png', '', NULL, 12),
(102, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/886448_??? ?????? ?? ???? ?????? ???????.png', '', NULL, 12),
(103, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/28550368_??? ?????? ?? ???? ?????? ???????.png', '', NULL, 12),
(104, '', '', 'http://127.0.1.1/AndroidUpload/uploadsimg/3052045_??? ?????? ?? ???? ?????? ???????.png', '', NULL, 12),
(105, '', '', '', '', NULL, 12),
(106, '', '', '', '', NULL, 12),
(107, 'pdf', '', '', 'http://127.0.1.1/AndroidUpload/uploadspdf/document.pdf', NULL, 12),
(108, 'all Teaching staff', 'https://www.facebook.com/', '', 'http://127.0.1.1/AndroidUpload/uploadspdf/46142193_CV.pdf', NULL, 12),
(109, 'all Teaching staff', 'https://www.facebook.com/', 'http://127.0.1.1/AndroidUpload/uploadsimg/99881308_index.jpeg', '', NULL, 12),
(110, 'hii', '', '', '', NULL, 12),
(111, 'hhh', '', '', '', NULL, 12),
(112, 'hhh', '', '', '', NULL, 12),
(113, 'hhh', '', '', '', NULL, 12),
(115, 'ffr', '', '', '', NULL, 12),
(116, '', '', '', '', NULL, 12);

--
-- Triggers `notifiction`
--
DELIMITER $$
CREATE TRIGGER `Notification_triger``` AFTER INSERT ON `notifiction` FOR EACH ROW INSERT into Notification_Triger VALUES (null,New.Notification_ID,'Inserted',NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `office_boy`
--

CREATE TABLE `office_boy` (
  `Office_Boy_ID` int(11) NOT NULL,
  `Office_Boy_Name` varchar(50) NOT NULL,
  `Servic_name` varchar(50) NOT NULL,
  `Phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office_boy`
--

INSERT INTO `office_boy` (`Office_Boy_ID`, `Office_Boy_Name`, `Servic_name`, `Phone`) VALUES
(2, 'احمد محمد', 'بوفيه', 1057891642),
(4, 'على خالد', 'نظافه', 1259764315),
(10, 'كمال عبدالله', 'بوفيه', 2147483647),
(11, 'محمود سعد', 'بوفيه', 10848984),
(12, 'باسل مختار', 'نظافه', 1254765436);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `ID` int(11) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`ID`, `Name`, `Description`) VALUES
(1, 'رئيس شؤن الطلاب', 'مسؤل عن كل ما يخص الطلاب وامتحاناتهم'),
(3, 'رئيس قسم علوم الحاسب', 'يهتم بكل ما يخص القسم'),
(4, 'رئيس قسم نظم المعلومات', 'يهتم بكل مايخص القسم');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_ID` int(11) NOT NULL,
  `Code` int(11) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_ID`, `Code`, `Description`, `Name`) VALUES
(40, 40, 'الدور الثانى \r\nناحيه المكتبه', 'قاعه7'),
(77, 77, 'فى الدور الارضى بجانب السلم', 'مدرج 1'),
(100, 100, 'الدور الثالث الطرقه يمين السلم                    ', 'معمل11'),
(145, 145, '   الدور الثانى الطرقه شمال السلم', 'مكتب م/خالد'),
(180, 180, 'الدور الثالث  \r\nالطرقه ناحيه اليمين', 'معمل شبكات'),
(181, 33, 'الدور الثانى طرقه المعيدين على اليمين             ', 'مدرج3');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `Schedule_ID` int(11) NOT NULL,
  `Course_ID` int(11) DEFAULT NULL,
  `Room_ID` int(11) DEFAULT NULL,
  `Teaching_Staff_ID` int(11) DEFAULT NULL,
  `Day_ID` int(11) DEFAULT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`Schedule_ID`, `Course_ID`, `Room_ID`, `Teaching_Staff_ID`, `Day_ID`, `Start_Time`, `End_Time`, `Type`) VALUES
(24, 3, 40, 13, 1, '01:15:00', '02:00:00', 'محاضره'),
(25, 3, 100, 13, 2, '01:00:00', '02:30:00', 'سكشن'),
(42, 5, 40, 14, 4, '02:00:00', '03:30:00', 'محاضره'),
(43, 2, 77, 13, 5, '09:00:00', '11:00:00', 'محاضره'),
(58, 1, 77, 13, 7, '11:15:00', '12:30:00', 'محاضره'),
(60, 7, 181, 12, 2, '10:45:00', '12:45:00', 'محاضره');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_section`
--

CREATE TABLE `schedule_section` (
  `ID` int(11) NOT NULL,
  `Schedule_ID` int(11) DEFAULT NULL,
  `Section_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule_section`
--

INSERT INTO `schedule_section` (`ID`, `Schedule_ID`, `Section_ID`) VALUES
(5, 24, 2),
(6, 24, 1),
(7, 25, 3),
(8, 43, 7),
(9, 43, 8),
(10, 58, 9),
(12, 58, 10),
(13, 58, 9),
(15, 60, 5),
(16, 25, 6),
(17, 24, 6),
(18, 42, 6),
(19, 43, 6),
(20, 58, 6),
(21, 60, 6);

-- --------------------------------------------------------

--
-- Table structure for table `scientific_degree`
--

CREATE TABLE `scientific_degree` (
  `Scientific_Degree_ID` int(11) NOT NULL,
  `Degree` varchar(50) NOT NULL,
  `Description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scientific_degree`
--

INSERT INTO `scientific_degree` (`Scientific_Degree_ID`, `Degree`, `Description`) VALUES
(1, 'مدرس مساعد', 'لم يحصل المعيد على هذه الدرجه الا اذا تم تحضيره للماجيستير'),
(2, 'استاذ مساعد', 'يحصل عليها المدرس المساعد اذا حضر الدكتوراه');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `Section_ID` int(11) NOT NULL,
  `Section_Number` int(11) NOT NULL,
  `Academic_Year_Depatment_ID` int(11) DEFAULT NULL,
  `Group_number` int(11) NOT NULL,
  `Academic_Year_Date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`Section_ID`, `Section_Number`, `Academic_Year_Depatment_ID`, `Group_number`, `Academic_Year_Date`) VALUES
(1, 1, 6, 1, '2018/2019'),
(2, 2, 6, 1, '2018/2019'),
(3, 3, 6, 2, '2018/2019'),
(4, 2, 8, 2, '2018/2019'),
(5, 1, 8, 1, '2018/2019'),
(6, 1, 7, 1, '2018/2019'),
(7, 1, 4, 1, '2018/2019'),
(8, 2, 4, 1, '2018/2019'),
(9, 1, 5, 1, '2018/2019'),
(10, 2, 5, 1, '2018/2019'),
(16, 4, 5, 2, '2017/2018'),
(17, 0, NULL, 0, '20'),
(18, 1, 8, 1, '2019/2020'),
(19, 2, 8, 1, '2019/2020'),
(21, 3, 5, 2, '2018/2019'),
(22, 4, 5, 2, '2018/2019');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_ID` int(11) NOT NULL,
  `SSN` bigint(14) NOT NULL,
  `Student_Name` varchar(100) NOT NULL,
  `Student_Email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Student_Password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Section_ID` int(11) DEFAULT NULL,
  `Student_Status` varchar(20) NOT NULL,
  `Graduation_Year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_ID`, `SSN`, `Student_Name`, `Student_Email`, `Student_Password`, `Section_ID`, `Student_Status`, `Graduation_Year`) VALUES
(2, 14785236987452, 'ايمان ممدوح ', 'em@em.com', '8aefb06c426e07a0a671a1e2488b4858d694a730', 8, '', ''),
(3, 12547896451237, 'سالى عمر عبدالله', 'saly@saly.com', '9adcb29710e807607b683f62e555c22dc5659713', 3, '', ''),
(4, 1698741256321, 'سمر سامى', 'samer@samer.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 18, '', ''),
(5, 98745632587412, 'رانيا الهامى صبحى', 'rani@rani.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 7, '', ''),
(6, 12345678974125, 'ايهاب امام', 'hebo@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 6, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_affairs`
--

CREATE TABLE `student_affairs` (
  `UserID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) CHARACTER SET latin1 NOT NULL,
  `userPassword` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Student_Affairs_Manger_ID` int(11) DEFAULT NULL,
  `GroupID` int(11) NOT NULL,
  `RegStatus` int(11) NOT NULL,
  `Date` date NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_affairs`
--

INSERT INTO `student_affairs` (`UserID`, `userName`, `userEmail`, `userPassword`, `Student_Affairs_Manger_ID`, `GroupID`, `RegStatus`, `Date`, `avatar`, `type`) VALUES
(1, 'ساره سمير', 'saraemam140@yahoo.com', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', NULL, 0, 1, '2019-02-01', '94635010_Toqa Eisa 20151223_234455.jpg', 'student_affairs'),
(5, 'ايهاب سمير', 'ehab@ehab.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', NULL, 0, 1, '2019-02-04', '73159790_19731904_1936141186622851_5268529685477771847_n.jpg', 'youth_care'),
(6, 'احمد سمير', 'ahmed@ahmed.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 0, 1, '2019-02-04', '94625855_hj_n.jpg', 'staff_affairs'),
(7, 'امال فتحى', 'amal@amal.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 1, 1, '2019-06-20', '84798944_1.jpg', ' '),
(8, 'mohamed abdo', 'mo@mo.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 0, 1, '2019-06-26', '19433093_10897873_789094854507052_4114921788179197105_n.jpg', 'student_affairs');

-- --------------------------------------------------------

--
-- Table structure for table `student_notification`
--

CREATE TABLE `student_notification` (
  `Student_ID` int(11) DEFAULT NULL,
  `Notification_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_notification`
--

INSERT INTO `student_notification` (`Student_ID`, `Notification_ID`) VALUES
(2, 47),
(6, 48),
(6, 49),
(6, 50),
(3, 52),
(4, 53),
(6, 54),
(2, 55),
(5, 55),
(2, 56),
(3, 57),
(3, 58),
(3, 59),
(3, 60),
(3, 61),
(3, 62),
(3, 63),
(3, 64),
(3, 65),
(3, 66),
(3, 67),
(3, 68);

-- --------------------------------------------------------

--
-- Table structure for table `teaching_staff`
--

CREATE TABLE `teaching_staff` (
  `Teaching_Staff_ID` int(11) NOT NULL,
  `Teaching_Staff_Ssn` bigint(14) NOT NULL,
  `Teaching_Staff_Name` varchar(50) NOT NULL,
  `Teaching_Staff_Email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Teaching_Staff_Password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Office_houres` varchar(1000) NOT NULL,
  `Department_id` int(11) DEFAULT NULL,
  `Teaching_Staff_Manegre_ID` int(11) DEFAULT NULL,
  `Scientific_Degree_ID` int(11) DEFAULT NULL,
  `Room_ID` int(11) DEFAULT NULL,
  `Position_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teaching_staff`
--

INSERT INTO `teaching_staff` (`Teaching_Staff_ID`, `Teaching_Staff_Ssn`, `Teaching_Staff_Name`, `Teaching_Staff_Email`, `Teaching_Staff_Password`, `Office_houres`, `Department_id`, `Teaching_Staff_Manegre_ID`, `Scientific_Degree_ID`, `Room_ID`, `Position_ID`) VALUES
(12, 14785236974125, 'السيد مصطفى السيد', 's@s.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'يوم الاربع من 10pm:12pm', 7, NULL, 1, 100, 4),
(13, 14785236921457, 'محمود محمد على', 'ma@ma.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'يوم الخميس2pm:5pm', 8, NULL, 2, 100, 3),
(14, 12698703654789, 'خالد محمد احمد', 'kh@kh.com', '123', 'الحد 10 الى 12', 8, NULL, 1, 145, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ts_notification`
--

CREATE TABLE `ts_notification` (
  `Notification_ID` int(11) DEFAULT NULL,
  `Teaching_Staff_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ts_notification`
--

INSERT INTO `ts_notification` (`Notification_ID`, `Teaching_Staff_ID`) VALUES
(51, 12),
(79, 12),
(83, 12),
(85, 12),
(87, 12),
(87, 13),
(87, 14),
(95, 12),
(95, 13),
(95, 14),
(96, 12),
(96, 13),
(96, 14),
(97, 12),
(97, 13),
(97, 14),
(98, 12),
(98, 13),
(98, 14),
(99, 12),
(99, 13),
(99, 14),
(100, 12),
(100, 13),
(100, 14),
(101, 13),
(101, 14),
(105, 12),
(105, 13),
(105, 14),
(108, 12),
(108, 13),
(108, 14),
(109, 12),
(109, 13),
(109, 14),
(110, 12),
(110, 13),
(110, 14),
(111, 12),
(111, 13),
(111, 14),
(112, 12),
(112, 13),
(112, 14),
(113, 12),
(113, 13),
(113, 14),
(116, 12),
(116, 13),
(116, 14);

-- --------------------------------------------------------

--
-- Table structure for table `ts_office_boy`
--

CREATE TABLE `ts_office_boy` (
  `Office_Boy_ID` int(11) DEFAULT NULL,
  `TS_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `academic_year_department`
--
ALTER TABLE `academic_year_department`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Department_ID` (`Department_ID`),
  ADD KEY `Year_ID` (`Academic_Year_ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`Course_ID`),
  ADD KEY `Year_Number` (`Year_Number`);

--
-- Indexes for table `course_department`
--
ALTER TABLE `course_department`
  ADD KEY `Course_CDept` (`Course_ID`),
  ADD KEY `Department_CDept` (`Department_ID`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`Day_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Department_ID`);

--
-- Indexes for table `faculty_information`
--
ALTER TABLE `faculty_information`
  ADD PRIMARY KEY (`faculty_ID`);

--
-- Indexes for table `notifiction`
--
ALTER TABLE `notifiction`
  ADD PRIMARY KEY (`Notification_ID`),
  ADD KEY `FK_Notifiction_Student_Affairs` (`Student_Affairs_ID`),
  ADD KEY `Teaching_staff_id` (`Teaching_staff_id`);

--
-- Indexes for table `office_boy`
--
ALTER TABLE `office_boy`
  ADD PRIMARY KEY (`Office_Boy_ID`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_ID`),
  ADD UNIQUE KEY `Code` (`Code`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`Schedule_ID`),
  ADD KEY `FK_Schedule_Courses` (`Course_ID`),
  ADD KEY `FK_Schedule_Day` (`Day_ID`),
  ADD KEY `FK_Schedule_Section_Room` (`Room_ID`),
  ADD KEY `FK_Schedule_Teaching_Staff` (`Teaching_Staff_ID`);

--
-- Indexes for table `schedule_section`
--
ALTER TABLE `schedule_section`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Schedule_Section_Schedule` (`Section_ID`),
  ADD KEY `Schedule_ID` (`Schedule_ID`);

--
-- Indexes for table `scientific_degree`
--
ALTER TABLE `scientific_degree`
  ADD PRIMARY KEY (`Scientific_Degree_ID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`Section_ID`),
  ADD KEY `Academic_Year_Depatment_ID` (`Academic_Year_Depatment_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`),
  ADD KEY `Section_ID` (`Section_ID`);

--
-- Indexes for table `student_affairs`
--
ALTER TABLE `student_affairs`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `student_notification`
--
ALTER TABLE `student_notification`
  ADD KEY `FK_Section_notification` (`Student_ID`),
  ADD KEY `FK_Section_notification-section` (`Notification_ID`);

--
-- Indexes for table `teaching_staff`
--
ALTER TABLE `teaching_staff`
  ADD PRIMARY KEY (`Teaching_Staff_ID`),
  ADD KEY `FK_Teaching_Staff_Department` (`Department_id`),
  ADD KEY `FK_Teaching_Staff_Room` (`Room_ID`),
  ADD KEY `FK_Teaching_Staff_Scientific_Degree` (`Scientific_Degree_ID`),
  ADD KEY `Position_ID` (`Position_ID`);

--
-- Indexes for table `ts_notification`
--
ALTER TABLE `ts_notification`
  ADD KEY `FK_TS_Notification_Teaching_Staff` (`Teaching_Staff_ID`),
  ADD KEY `FK1_TS_Notification_Teaching_Staff` (`Notification_ID`);

--
-- Indexes for table `ts_office_boy`
--
ALTER TABLE `ts_office_boy`
  ADD KEY `FK_TS_Office_Boy_Office_Boy` (`Office_Boy_ID`),
  ADD KEY `FK_TS_Office_Boy_Teaching` (`TS_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `academic_year_department`
--
ALTER TABLE `academic_year_department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `Course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `Day_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `Department_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faculty_information`
--
ALTER TABLE `faculty_information`
  MODIFY `faculty_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifiction`
--
ALTER TABLE `notifiction`
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `office_boy`
--
ALTER TABLE `office_boy`
  MODIFY `Office_Boy_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `Room_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `Schedule_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `schedule_section`
--
ALTER TABLE `schedule_section`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `scientific_degree`
--
ALTER TABLE `scientific_degree`
  MODIFY `Scientific_Degree_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `Section_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_affairs`
--
ALTER TABLE `student_affairs`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teaching_staff`
--
ALTER TABLE `teaching_staff`
  MODIFY `Teaching_Staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_year_department`
--
ALTER TABLE `academic_year_department`
  ADD CONSTRAINT `academic_year_department_ibfk_1` FOREIGN KEY (`Department_ID`) REFERENCES `department` (`Department_ID`),
  ADD CONSTRAINT `academic_year_department_ibfk_2` FOREIGN KEY (`Academic_Year_ID`) REFERENCES `academic_year` (`ID`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`Year_Number`) REFERENCES `academic_year` (`ID`);

--
-- Constraints for table `course_department`
--
ALTER TABLE `course_department`
  ADD CONSTRAINT `Course_CDept` FOREIGN KEY (`Course_ID`) REFERENCES `courses` (`Course_ID`),
  ADD CONSTRAINT `Department_CDept` FOREIGN KEY (`Department_ID`) REFERENCES `department` (`Department_ID`);

--
-- Constraints for table `notifiction`
--
ALTER TABLE `notifiction`
  ADD CONSTRAINT `fk_StudentAffairs` FOREIGN KEY (`Student_Affairs_ID`) REFERENCES `student_affairs` (`UserID`),
  ADD CONSTRAINT `fk_ts_id` FOREIGN KEY (`Teaching_staff_id`) REFERENCES `teaching_staff` (`Teaching_Staff_ID`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `FK_day_id` FOREIGN KEY (`Day_ID`) REFERENCES `day` (`Day_ID`),
  ADD CONSTRAINT `FK_room_id` FOREIGN KEY (`Room_ID`) REFERENCES `room` (`Room_ID`),
  ADD CONSTRAINT `fk_courseID` FOREIGN KEY (`Course_ID`) REFERENCES `courses` (`Course_ID`),
  ADD CONSTRAINT `fk_staff_id` FOREIGN KEY (`Teaching_Staff_ID`) REFERENCES `teaching_staff` (`Teaching_Staff_ID`);

--
-- Constraints for table `schedule_section`
--
ALTER TABLE `schedule_section`
  ADD CONSTRAINT `fk_schadula_id` FOREIGN KEY (`Schedule_ID`) REFERENCES `schedule` (`Schedule_ID`),
  ADD CONSTRAINT `schedule_section_ibfk_2` FOREIGN KEY (`Section_ID`) REFERENCES `section` (`Section_ID`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`Academic_Year_Depatment_ID`) REFERENCES `academic_year_department` (`ID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`Section_ID`) REFERENCES `section` (`Section_ID`);

--
-- Constraints for table `student_notification`
--
ALTER TABLE `student_notification`
  ADD CONSTRAINT `FK_Section_notification-section` FOREIGN KEY (`Notification_ID`) REFERENCES `notifiction` (`Notification_ID`),
  ADD CONSTRAINT `FK_Student_notification` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`);

--
-- Constraints for table `teaching_staff`
--
ALTER TABLE `teaching_staff`
  ADD CONSTRAINT `FK_Teaching_Staff_Department` FOREIGN KEY (`Department_id`) REFERENCES `department` (`Department_ID`),
  ADD CONSTRAINT `FK_Teaching_Staff_Scientific_Degree` FOREIGN KEY (`Scientific_Degree_ID`) REFERENCES `scientific_degree` (`Scientific_Degree_ID`),
  ADD CONSTRAINT `teaching_staff_ibfk_1` FOREIGN KEY (`Room_ID`) REFERENCES `room` (`Room_ID`),
  ADD CONSTRAINT `teaching_staff_ibfk_2` FOREIGN KEY (`Position_ID`) REFERENCES `position` (`ID`);

--
-- Constraints for table `ts_notification`
--
ALTER TABLE `ts_notification`
  ADD CONSTRAINT `FK1_TS_Notification_Teaching_Staff` FOREIGN KEY (`Notification_ID`) REFERENCES `notifiction` (`Notification_ID`),
  ADD CONSTRAINT `FK_TS_Notification_Teaching_Staff` FOREIGN KEY (`Teaching_Staff_ID`) REFERENCES `teaching_staff` (`Teaching_Staff_ID`);

--
-- Constraints for table `ts_office_boy`
--
ALTER TABLE `ts_office_boy`
  ADD CONSTRAINT `FK_TS_Office_Boy_Office_Boy` FOREIGN KEY (`Office_Boy_ID`) REFERENCES `office_boy` (`Office_Boy_ID`),
  ADD CONSTRAINT `FK_TS_Office_Boy_Teaching` FOREIGN KEY (`TS_ID`) REFERENCES `teaching_staff` (`Teaching_Staff_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
