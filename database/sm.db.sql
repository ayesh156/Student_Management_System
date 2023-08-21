-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.29 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for student_ms_db
CREATE DATABASE IF NOT EXISTS `student_ms_db` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `student_ms_db`;

-- Dumping structure for table student_ms_db.academic_officer
CREATE TABLE IF NOT EXISTS `academic_officer` (
  `email` varchar(100) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `joined_date` date DEFAULT NULL,
  `gender_id` int NOT NULL,
  `status_id` int NOT NULL,
  `option_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_academic_officer_gender1_idx` (`gender_id`),
  KEY `fk_academic_officer_status1_idx` (`status_id`),
  KEY `fk_academic_officer_option1_idx` (`option_id`),
  CONSTRAINT `fk_academic_officer_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_academic_officer_option1` FOREIGN KEY (`option_id`) REFERENCES `option` (`id`),
  CONSTRAINT `fk_academic_officer_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.academic_officer: ~2 rows (approximately)
INSERT INTO `academic_officer` (`email`, `user_name`, `password`, `verification_code`, `joined_date`, `gender_id`, `status_id`, `option_id`) VALUES
	('sdachathuranga@gmail.com', 'Ayesh156', 'ayesh155', '645640434b9a2', '2023-01-04', 1, 1, 2),
	('shewanchathura008@gmail.com', 'shewan007', 'shewan008', '63b5b0434b9a2', '2023-01-04', 1, 1, 2);

-- Dumping structure for table student_ms_db.academic_officer_details
CREATE TABLE IF NOT EXISTS `academic_officer_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `address` text,
  `postal_code` varchar(45) DEFAULT NULL,
  `academic_officer_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_academic_officer_details_academic_officer1_idx` (`academic_officer_email`),
  KEY `fk_academic_officer_details_city1_idx` (`city_id`),
  CONSTRAINT `fk_academic_officer_details_academic_officer1` FOREIGN KEY (`academic_officer_email`) REFERENCES `academic_officer` (`email`),
  CONSTRAINT `fk_academic_officer_details_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.academic_officer_details: ~2 rows (approximately)
INSERT INTO `academic_officer_details` (`id`, `first_name`, `last_name`, `birthday`, `mobile`, `address`, `postal_code`, `academic_officer_email`, `city_id`) VALUES
	(1, 'Ayesh', 'Chathuranga', '2001-02-28', '0768453123', 'Rukmalgahahena, Diddenipotha', '3456', 'sdachathuranga@gmail.com', 5),
	(2, 'Shewan', 'Chathura', '2001-02-07', '0783214568', 'Kosgahadola, Mulatiyana', '321456', 'shewanchathura008@gmail.com', 4);

-- Dumping structure for table student_ms_db.academic_officer_image
CREATE TABLE IF NOT EXISTS `academic_officer_image` (
  `path` varchar(100) DEFAULT NULL,
  `academic_officer_email` varchar(100) NOT NULL,
  KEY `fk_academic_officer_image_academic_officer1_idx` (`academic_officer_email`),
  CONSTRAINT `fk_academic_officer_image_academic_officer1` FOREIGN KEY (`academic_officer_email`) REFERENCES `academic_officer` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.academic_officer_image: ~2 rows (approximately)
INSERT INTO `academic_officer_image` (`path`, `academic_officer_email`) VALUES
	('../images/academic_officer_img/Shewan_63b663ec579d3.jpg', 'shewanchathura008@gmail.com'),
	('../images/academic_officer_img/Ayesh_63b6c426b07b0.jpg', 'sdachathuranga@gmail.com');

-- Dumping structure for table student_ms_db.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `gender_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_admin_gender1_idx` (`gender_id`),
  CONSTRAINT `fk_admin_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.admin: ~2 rows (approximately)
INSERT INTO `admin` (`email`, `user_name`, `verification_code`, `gender_id`) VALUES
	('sdachathuranga@gmail.com', 'Ayesh156', '6418a6f0a8354', 1),
	('shashika@gmail.com', 'Shashika11', 'fdaetwerhfdg4', 1);

-- Dumping structure for table student_ms_db.admin_details
CREATE TABLE IF NOT EXISTS `admin_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `address` text,
  `postal_code` varchar(10) DEFAULT NULL,
  `admin_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_admin_details_admin1_idx` (`admin_email`),
  KEY `fk_admin_details_city1_idx` (`city_id`),
  CONSTRAINT `fk_admin_details_admin1` FOREIGN KEY (`admin_email`) REFERENCES `admin` (`email`),
  CONSTRAINT `fk_admin_details_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.admin_details: ~2 rows (approximately)
INSERT INTO `admin_details` (`id`, `first_name`, `last_name`, `birthday`, `mobile`, `address`, `postal_code`, `admin_email`, `city_id`) VALUES
	(1, 'Ayesh', 'Chathuranga', '2001-02-28', '0761234567', 'Diddenipotha,Makandura', '1234', 'sdachathuranga@gmail.com', 4),
	(2, 'Shashika', 'Madushanka', '2001-05-09', '071235486', 'Masmulla, Ullala', '96745', 'shashika@gmail.com', 2);

-- Dumping structure for table student_ms_db.admin_image
CREATE TABLE IF NOT EXISTS `admin_image` (
  `path` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_admin_image_admin1_idx` (`admin_email`),
  CONSTRAINT `fk_admin_image_admin1` FOREIGN KEY (`admin_email`) REFERENCES `admin` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.admin_image: ~2 rows (approximately)
INSERT INTO `admin_image` (`path`, `admin_email`) VALUES
	('../images/admin_img/Ayesh_63b52ee0c62ad.jpg', 'sdachathuranga@gmail.com'),
	('../images/admin_img/Shashik1_63b55ff176d42.jpg', 'shashika@gmail.com');

-- Dumping structure for table student_ms_db.assignment
CREATE TABLE IF NOT EXISTS `assignment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `assignment_path` varchar(100) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `grade_has_subject_id` int NOT NULL,
  `teacher_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assignment_grade_has_subject1_idx` (`grade_has_subject_id`),
  KEY `fk_assignment_teacher1_idx` (`teacher_email`),
  CONSTRAINT `fk_assignment_grade_has_subject1` FOREIGN KEY (`grade_has_subject_id`) REFERENCES `grade_has_subject` (`id`),
  CONSTRAINT `fk_assignment_teacher1` FOREIGN KEY (`teacher_email`) REFERENCES `teacher` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.assignment: ~3 rows (approximately)
INSERT INTO `assignment` (`id`, `name`, `description`, `assignment_path`, `date_added`, `grade_has_subject_id`, `teacher_email`) VALUES
	(1, 'DBMS 1', 'DBMS 1', '../images/assignment/DBMS_1.pdf', '2023-01-05', 9, 'samali@gmail.com'),
	(2, 'Web Programming 1', 'Web Programming 1', '../images/assignment/WebProgramming_1.pdf', '2023-01-05', 9, 'sanka@gmail.com'),
	(3, 'Web Programming', 'Web Programming 2', '../images/assignment/Web Programming_63b7d0d707084.pdf', '2023-01-06', 12, 'samali@gmail.com'),
	(4, 'Hi', 'trytry', '../images/assignment/Hi_64e2ed08bfb1d.docx', '2023-08-21', 12, 'samali@gmail.com'),
	(5, 'Hi', 'trytry', '../images/assignment/Hi_64e2ed1a90ba6.docx', '2023-08-21', 16, 'samali@gmail.com'),
	(6, 'fdsf', 'sdf', '../images/assignment/fdsf_64e2edded7cf0.docx', '2023-08-21', 16, 'samali@gmail.com');

-- Dumping structure for table student_ms_db.as_display_status
CREATE TABLE IF NOT EXISTS `as_display_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.as_display_status: ~2 rows (approximately)
INSERT INTO `as_display_status` (`id`, `ad_status`) VALUES
	(1, 'Release'),
	(2, 'Not Release');

-- Dumping structure for table student_ms_db.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city` varchar(50) DEFAULT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_district1_idx` (`district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.city: ~5 rows (approximately)
INSERT INTO `city` (`id`, `city`, `district_id`) VALUES
	(1, 'Colombo', 1),
	(2, 'Kamburupitiya', 4),
	(3, 'Galle', 5),
	(4, 'Makandura', 4),
	(5, 'Deniyaya', 4);

-- Dumping structure for table student_ms_db.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district` varchar(50) DEFAULT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province_idx` (`province_id`),
  CONSTRAINT `fk_district_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.district: ~5 rows (approximately)
INSERT INTO `district` (`id`, `district`, `province_id`) VALUES
	(1, 'Colombo', 2),
	(2, 'Gampaha', 2),
	(3, 'Kalutara', 2),
	(4, 'Matara', 1),
	(5, 'Galle', 1);

-- Dumping structure for table student_ms_db.enrollment_payment
CREATE TABLE IF NOT EXISTS `enrollment_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `student_email` varchar(100) NOT NULL,
  `payment_status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enrollment_payment_student1_idx` (`student_email`),
  KEY `fk_enrollment_payment_payment_status1_idx` (`payment_status_id`),
  CONSTRAINT `fk_enrollment_payment_payment_status1` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_status` (`id`),
  CONSTRAINT `fk_enrollment_payment_student1` FOREIGN KEY (`student_email`) REFERENCES `student` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.enrollment_payment: ~0 rows (approximately)
INSERT INTO `enrollment_payment` (`id`, `amount`, `date_paid`, `student_email`, `payment_status_id`) VALUES
	(1, 1000, '2023-01-07', 'sdachathuranga@gmail.com', 1),
	(2, 1000, '2023-08-21', 'sandeepa@gmail.com', 1);

-- Dumping structure for table student_ms_db.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table student_ms_db.grade
CREATE TABLE IF NOT EXISTS `grade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grade` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.grade: ~13 rows (approximately)
INSERT INTO `grade` (`id`, `grade`) VALUES
	(1, 'Grade 1'),
	(2, 'Grade 2'),
	(3, 'Grade 3'),
	(4, 'Grade 4'),
	(5, 'Grade 5'),
	(6, 'Grade 6'),
	(7, 'Grade 7'),
	(8, 'Grade 8'),
	(9, 'Grade 9'),
	(10, 'Grade 10'),
	(11, 'Grade 11'),
	(12, 'Grade 12'),
	(13, 'Grade 13');

-- Dumping structure for table student_ms_db.grade_has_subject
CREATE TABLE IF NOT EXISTS `grade_has_subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grade_id` int NOT NULL,
  `subject_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grade_has_subject_subject1_idx` (`subject_id`),
  KEY `fk_grade_has_subject_grade1_idx` (`grade_id`),
  CONSTRAINT `fk_grade_has_subject_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_grade_has_subject_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.grade_has_subject: ~42 rows (approximately)
INSERT INTO `grade_has_subject` (`id`, `grade_id`, `subject_id`) VALUES
	(1, 1, 1),
	(2, 1, 4),
	(3, 2, 1),
	(4, 2, 4),
	(5, 3, 1),
	(6, 3, 4),
	(7, 4, 1),
	(8, 4, 4),
	(9, 5, 1),
	(10, 5, 4),
	(11, 6, 1),
	(12, 6, 2),
	(13, 6, 3),
	(14, 6, 4),
	(15, 7, 1),
	(16, 7, 2),
	(17, 7, 3),
	(18, 7, 4),
	(19, 8, 1),
	(20, 8, 2),
	(21, 8, 3),
	(22, 8, 4),
	(23, 9, 1),
	(24, 9, 2),
	(25, 9, 3),
	(26, 9, 4),
	(27, 10, 1),
	(28, 10, 2),
	(29, 10, 3),
	(30, 10, 4),
	(31, 10, 5),
	(32, 11, 1),
	(33, 11, 2),
	(34, 11, 3),
	(35, 11, 4),
	(36, 11, 5),
	(37, 12, 5),
	(38, 12, 6),
	(39, 12, 7),
	(40, 13, 5),
	(41, 13, 6),
	(42, 13, 7);

-- Dumping structure for table student_ms_db.lesson_note
CREATE TABLE IF NOT EXISTS `lesson_note` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `path` varchar(100) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `grade_has_subject_id` int NOT NULL,
  `teacher_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lesson_note_grade_has_subject1_idx` (`grade_has_subject_id`),
  KEY `fk_lesson_note_teacher1_idx` (`teacher_email`),
  CONSTRAINT `fk_lesson_note_grade_has_subject1` FOREIGN KEY (`grade_has_subject_id`) REFERENCES `grade_has_subject` (`id`),
  CONSTRAINT `fk_lesson_note_teacher1` FOREIGN KEY (`teacher_email`) REFERENCES `teacher` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.lesson_note: ~3 rows (approximately)
INSERT INTO `lesson_note` (`id`, `name`, `description`, `path`, `date_added`, `grade_has_subject_id`, `teacher_email`) VALUES
	(1, 'DBMS', 'DBMS', '../images/lesson_note/44444_63b7c67f9e0e9.pptx', '2023-01-06', 9, 'samali@gmail.com'),
	(2, 'Web Programming', 'Web Programming 1', '../images/lesson_note/Web Programming_63b7ca3881243.pdf', '2023-01-06', 9, 'samali@gmail.com'),
	(3, 'Web Programming', 'Web Programming 2', '../images/lesson_note/Web Programming_63b7ca6cd14b9.docx', '2023-01-06', 18, 'samali@gmail.com');

-- Dumping structure for table student_ms_db.option
CREATE TABLE IF NOT EXISTS `option` (
  `id` int NOT NULL AUTO_INCREMENT,
  `option` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.option: ~2 rows (approximately)
INSERT INTO `option` (`id`, `option`) VALUES
	(1, 'Block'),
	(2, 'Unblock');

-- Dumping structure for table student_ms_db.payment_status
CREATE TABLE IF NOT EXISTS `payment_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `p_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.payment_status: ~2 rows (approximately)
INSERT INTO `payment_status` (`id`, `p_status`) VALUES
	(1, 'Paid'),
	(2, 'Not Paid');

-- Dumping structure for table student_ms_db.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.province: ~9 rows (approximately)
INSERT INTO `province` (`id`, `province`) VALUES
	(1, 'Southern'),
	(2, 'Western'),
	(3, 'Central'),
	(4, 'Eastern'),
	(5, 'North Central'),
	(6, 'Uva'),
	(7, 'Northern'),
	(8, 'North Western'),
	(9, 'Sabaragamuwa');

-- Dumping structure for table student_ms_db.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.status: ~2 rows (approximately)
INSERT INTO `status` (`id`, `status`) VALUES
	(1, 'Verified'),
	(2, 'Not Verified');

-- Dumping structure for table student_ms_db.student
CREATE TABLE IF NOT EXISTS `student` (
  `email` varchar(100) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `joined_date` date DEFAULT NULL,
  `gender_id` int NOT NULL,
  `status_id` int NOT NULL,
  `grade_id` int NOT NULL,
  `option_id` int NOT NULL,
  `payment_status_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_student_gender1_idx` (`gender_id`),
  KEY `fk_student_status1_idx` (`status_id`),
  KEY `fk_student_grade1_idx` (`grade_id`),
  KEY `fk_student_option1_idx` (`option_id`),
  KEY `fk_student_payment_status1_idx` (`payment_status_id`),
  CONSTRAINT `fk_student_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_student_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_student_option1` FOREIGN KEY (`option_id`) REFERENCES `option` (`id`),
  CONSTRAINT `fk_student_payment_status1` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_status` (`id`),
  CONSTRAINT `fk_student_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.student: ~5 rows (approximately)
INSERT INTO `student` (`email`, `user_name`, `password`, `verification_code`, `joined_date`, `gender_id`, `status_id`, `grade_id`, `option_id`, `payment_status_id`) VALUES
	('eshan@gmail.com', 'kumara123', 'eshan123', '63b697ae96469', '2023-01-05', 1, 2, 2, 2, 2),
	('eshara@gmail.com', 'Eshara157', 'eshara157', 'dfsdfhgase', '2023-08-20', 1, 1, 2, 2, 2),
	('sandeepa@gmail.com', 'sandeepa123', 'sandeepa123', 'fshgjhdffa', '2023-01-04', 1, 2, 3, 2, 1),
	('sdachathuranga@gmail.com', 'Ayesh156', 'ayesh156', 'dfadfsdfsdfd', '2022-08-20', 1, 1, 7, 2, 1),
	('thisara@gmail.com', 'thisara142', 'thisara123', 'sdfsdg34534', '2023-01-03', 1, 2, 3, 2, 2);

-- Dumping structure for table student_ms_db.student_details
CREATE TABLE IF NOT EXISTS `student_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `address` text,
  `postal_code` varchar(10) DEFAULT NULL,
  `student_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_details_student1_idx` (`student_email`),
  KEY `fk_student_details_city1_idx` (`city_id`),
  CONSTRAINT `fk_student_details_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_student_details_student1` FOREIGN KEY (`student_email`) REFERENCES `student` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.student_details: ~5 rows (approximately)
INSERT INTO `student_details` (`id`, `first_name`, `last_name`, `birthday`, `mobile`, `address`, `postal_code`, `student_email`, `city_id`) VALUES
	(1, 'Ayesh', 'Chathuranga', '2001-02-28', '0712345676', 'Rukmalgahahena, Diddenipotha', '1234', 'sdachathuranga@gmail.com', 1),
	(2, 'Eshara', 'Ranaveera', '2001-03-03', '0763214567', 'Ellawela, Horapawita', '3245', 'eshara@gmail.com', 2),
	(3, 'Thisara', 'Lakshan', '2001-03-13', '0723146896', 'fasfhfghgsdfg', '12345', 'thisara@gmail.com', 2),
	(4, 'Sandeepa', 'Deshan', '2001-02-03', '0781245637', 'Gammeddagedara, Diddenipotha', '3214', 'sandeepa@gmail.com', 5),
	(5, 'Eshan', 'Kumara', '2001-02-22', '0781234592', 'Gammedda, walagawaththa.', '32141', 'eshan@gmail.com', 2);

-- Dumping structure for table student_ms_db.student_grade_payment
CREATE TABLE IF NOT EXISTS `student_grade_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `grade_id` int NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `payment_status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_grade_payment_grade1_idx` (`grade_id`),
  KEY `fk_student_grade_payment_student1_idx` (`student_email`),
  KEY `fk_student_grade_payment_payment_status1_idx` (`payment_status_id`),
  CONSTRAINT `fk_student_grade_payment_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_student_grade_payment_payment_status1` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_status` (`id`),
  CONSTRAINT `fk_student_grade_payment_student1` FOREIGN KEY (`student_email`) REFERENCES `student` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.student_grade_payment: ~4 rows (approximately)
INSERT INTO `student_grade_payment` (`id`, `amount`, `date_paid`, `grade_id`, `student_email`, `payment_status_id`) VALUES
	(1, 2000, '2023-01-07', 2, 'sdachathuranga@gmail.com', 1),
	(2, 2000, '2023-01-07', 3, 'sdachathuranga@gmail.com', 1),
	(3, 2000, '2023-01-07', 5, 'sdachathuranga@gmail.com', 1),
	(4, 2000, '2023-01-07', 7, 'sdachathuranga@gmail.com', 1);

-- Dumping structure for table student_ms_db.student_image
CREATE TABLE IF NOT EXISTS `student_image` (
  `path` varchar(100) DEFAULT NULL,
  `student_email` varchar(100) NOT NULL,
  KEY `fk_student_image_student1_idx` (`student_email`),
  CONSTRAINT `fk_student_image_student1` FOREIGN KEY (`student_email`) REFERENCES `student` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.student_image: ~4 rows (approximately)
INSERT INTO `student_image` (`path`, `student_email`) VALUES
	('../images/student_img/Ayesh1_63b82f87989d4.jpeg', 'sdachathuranga@gmail.com'),
	('../images/student_img/Ayesh_63b4297213772.jpg', 'eshara@gmail.com'),
	('../images/student_img/Thisara_63b453e8d0e58.jpg', 'thisara@gmail.com'),
	('../images/student_img/Eshan_63b697ae9ab13.jpg', 'eshan@gmail.com');

-- Dumping structure for table student_ms_db.subject
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.subject: ~7 rows (approximately)
INSERT INTO `subject` (`id`, `sub_name`) VALUES
	(1, 'Mathematics'),
	(2, 'Science'),
	(3, 'History'),
	(4, 'English'),
	(5, 'ICT'),
	(6, 'Combined Maths'),
	(7, 'Physics');

-- Dumping structure for table student_ms_db.submitted_assignment
CREATE TABLE IF NOT EXISTS `submitted_assignment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `answer_path` varchar(100) DEFAULT NULL,
  `date_submitted` date DEFAULT NULL,
  `marks` double DEFAULT NULL,
  `assignment_id` int NOT NULL,
  `as_display_status_id` int NOT NULL,
  `student_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_submitted_assignment_assignment1_idx` (`assignment_id`),
  KEY `fk_submitted_assignment_as_display_status1_idx` (`as_display_status_id`),
  KEY `fk_submitted_assignment_student1_idx` (`student_email`),
  CONSTRAINT `fk_submitted_assignment_as_display_status1` FOREIGN KEY (`as_display_status_id`) REFERENCES `as_display_status` (`id`),
  CONSTRAINT `fk_submitted_assignment_assignment1` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`),
  CONSTRAINT `fk_submitted_assignment_student1` FOREIGN KEY (`student_email`) REFERENCES `student` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.submitted_assignment: ~2 rows (approximately)
INSERT INTO `submitted_assignment` (`id`, `answer_path`, `date_submitted`, `marks`, `assignment_id`, `as_display_status_id`, `student_email`) VALUES
	(1, '../images/answer/DBMS_1.pdf', '2023-01-05', 20, 3, 1, 'sdachathuranga@gmail.com'),
	(2, '../images/answer/Web Programming 1_63b91eb0b5732.pdf', '2023-01-06', 30, 2, 2, 'sdachathuranga@gmail.com'),
	(3, '../images/answer/Hi_64e2ed5f8bbbb.docx', '2023-08-21', 20, 5, 2, 'sdachathuranga@gmail.com'),
	(4, '../images/answer/fdsf_64e2eded55158.docx', '2023-08-21', -1, 6, 2, 'sdachathuranga@gmail.com');

-- Dumping structure for table student_ms_db.teacher
CREATE TABLE IF NOT EXISTS `teacher` (
  `email` varchar(100) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `joined_date` date DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `gender_id` int NOT NULL,
  `status_id` int NOT NULL,
  `option_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_teacher_gender1_idx` (`gender_id`),
  KEY `fk_teacher_status1_idx` (`status_id`),
  KEY `fk_teacher_option1_idx` (`option_id`),
  CONSTRAINT `fk_teacher_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_teacher_option1` FOREIGN KEY (`option_id`) REFERENCES `option` (`id`),
  CONSTRAINT `fk_teacher_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.teacher: ~2 rows (approximately)
INSERT INTO `teacher` (`email`, `user_name`, `password`, `joined_date`, `verification_code`, `gender_id`, `status_id`, `option_id`) VALUES
	('samali@gmail.com', 'samali32', 'samali321', '2023-01-04', 'fsgdghdsfgds', 1, 1, 2),
	('sanka@gmail.com', 'sanka531', 'sanka531', '2023-01-04', 'dfsdfhgfh435d', 1, 1, 2);

-- Dumping structure for table student_ms_db.teacher_details
CREATE TABLE IF NOT EXISTS `teacher_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `address` text,
  `postal_code` varchar(10) DEFAULT NULL,
  `teacher_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teacher_details_teacher1_idx` (`teacher_email`),
  KEY `fk_teacher_details_city1_idx` (`city_id`),
  CONSTRAINT `fk_teacher_details_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_teacher_details_teacher1` FOREIGN KEY (`teacher_email`) REFERENCES `teacher` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.teacher_details: ~2 rows (approximately)
INSERT INTO `teacher_details` (`id`, `first_name`, `last_name`, `birthday`, `mobile`, `address`, `postal_code`, `teacher_email`, `city_id`) VALUES
	(1, ' Samali', 'Silva', '1995-01-04', '0783254566', 'Smanmal, Koraburuwana', '3541', 'samali@gmail.com', 2),
	(2, 'Sanka', 'Siribaddana', '1990-02-05', '0765461234', 'Sankaniwasa, Horapawita', '357', 'sanka@gmail.com', 2);

-- Dumping structure for table student_ms_db.teacher_has_subject
CREATE TABLE IF NOT EXISTS `teacher_has_subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `teacher_email` varchar(100) NOT NULL,
  `subject_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teacher_has_subject_teacher1_idx` (`teacher_email`),
  KEY `fk_teacher_has_subject_subject1_idx` (`subject_id`),
  CONSTRAINT `fk_teacher_has_subject_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `fk_teacher_has_subject_teacher1` FOREIGN KEY (`teacher_email`) REFERENCES `teacher` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.teacher_has_subject: ~2 rows (approximately)
INSERT INTO `teacher_has_subject` (`id`, `teacher_email`, `subject_id`) VALUES
	(1, 'samali@gmail.com', 2),
	(2, 'sanka@gmail.com', 5);

-- Dumping structure for table student_ms_db.teacher_image
CREATE TABLE IF NOT EXISTS `teacher_image` (
  `path` varchar(100) DEFAULT NULL,
  `teacher_email` varchar(100) NOT NULL,
  KEY `fk_teacher_image_teacher1_idx` (`teacher_email`),
  CONSTRAINT `fk_teacher_image_teacher1` FOREIGN KEY (`teacher_email`) REFERENCES `teacher` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table student_ms_db.teacher_image: ~0 rows (approximately)
INSERT INTO `teacher_image` (`path`, `teacher_email`) VALUES
	('../images/teacher_img/Samali1_63b830bf0b6a2.png', 'samali@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
