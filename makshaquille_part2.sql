-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2025 at 03:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makshaquille_part2`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `JobReferenceNumber` varchar(20) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `StreetAddress` varchar(100) NOT NULL,
  `SuburbTown` varchar(50) NOT NULL,
  `State` varchar(3) NOT NULL,
  `Postcode` varchar(4) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `HTML` varchar(50) DEFAULT NULL,
  `CSS` varchar(50) DEFAULT NULL,
  `JavaScript` varchar(50) DEFAULT NULL,
  `Python` varchar(50) DEFAULT NULL,
  `OtherSkills` text DEFAULT NULL,
  `Status` enum('New','Current','Final') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `JobReferenceNumber`, `FirstName`, `LastName`, `StreetAddress`, `SuburbTown`, `State`, `Postcode`, `EmailAddress`, `PhoneNumber`, `HTML`, `CSS`, `JavaScript`, `Python`, `OtherSkills`, `Status`) VALUES
(4, 'G04C1', 'Nadimul', 'Haque', 'Uttar Chayabithi', 'Joydebpur', 'GAZ', '1700', 'nadim.hq321@gmail.com', '01827090222', 'Yes', 'Yes', 'Yes', 'No', 'Spring Boot', 'Final'),
(5, 'G04X7', 'Test', 'User', 'Uttar Chayabithi', 'Joydebpur', 'GAZ', '1700', 'nadim.hq321@gmail.com', '01827090222', 'Yes', 'Yes', 'Yes', 'No', 'Spring Boot', 'Current');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `JobID` int(11) NOT NULL,
  `JobRef` varchar(10) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`JobID`, `JobRef`, `Title`, `Description`) VALUES
(3, 'G04C1', 'Cloud Engineer', 'The Cloud Engineer will be responsible for designing, implementing, and maintaining cloud-based infrastructure and services. The role includes collaborating with cross-functional teams to understand infrastructure needs, automating deployments, and ensuring security, scalability, and performance of cloud environments. This position requires strong problem-solving skills and the ability to work in a dynamic team environment.'),
(4, 'G04X7', 'Cybersecurity Specialist', 'The Cybersecurity Specialist will be responsible for protecting the organization\'s networks, systems, and data from security breaches, cyber attacks, and other threats. This role requires identifying vulnerabilities, implementing security measures, and monitoring network traffic to prevent unauthorized access. The specialist will also work to ensure compliance with security standards and best practices while collaborating with IT teams to improve the organization\'s overall cybersecurity.');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `ManagerID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`ManagerID`, `Username`, `PasswordHash`) VALUES
(1, 'admin', '$2y$10$ZFdI6fVi2lAuQM8UPcCx6uLl2baiELS22.e3fCh7oB3.GiATqnZ/e'),
(3, 'testadmin', '$2y$10$GBqU.IxswAxFsFGYFfqgRu051KFQTVyN1y/mjlJIVl4tWto5Gx2Q.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`JobID`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`ManagerID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `JobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `ManagerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_database`
--

CREATE TABLE `jobs_database` (
  `job_ref` varchar(10) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `salary_range` varchar(50) DEFAULT NULL,
  `reports_to` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `key_responsibilities` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `experience` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs_database`
--

INSERT INTO `jobs_database` (`job_ref`, `title`, `salary_range`, `reports_to`, `description`, `key_responsibilities`, `education`, `experience`) VALUES
('G04C1', 'Cloud Engineer', '$105,000 - $120,000', 'Lead Cloud Infrastructure Engineer', 'The Cloud Engineer will be responsible for designing, implementing, and maintaining cloud-based infrastructure and services.\r\nThe role includes collaborating with cross-functional teams to understand infrastructure needs, automating deployments, and ensuring security, scalability, and performance of cloud environments. This position requires strong problem-solving skills and the ability to work in a dynamic team environment.\r\n', 'Design, implement, and manage cloud infrastructure and services. Collaborate with cross-functional teams to gather and analyze infrastructure requirements. Develop and maintain Infrastructure as Code (IaC) using tools such as Terraform or CloudFormation. Monitor and optimize cloud resources for performance and cost- efficiency. Troubleshoot and resolve cloud-related issues, ensuring high availability and reliability. Stay up to date with new cloud technologies and industry best practices to improve infrastructure management.', 'Bachelor\'s degree in Computer Science, Information Technology, or related field|Relevant certifications in cloud technologies (e.g., AWS Certified Solutions Architect, Microsoft Azure Administrator, Google Cloud Professional) are a plus|Master’s degree in Cloud Computing, Computer Science, or a related field (preferred but not required)\r\n', 'Minimum of 3 years of experience in cloud engineering or infrastructure management| Experience with cloud platforms (e.g., AWS, Azure, Google Cloud). Experience with Infrastructure as Code (e.g., Terraform, CloudFormation)|Knowledge of networking, security, and cloud monitoring tools|Proven track record of deploying, monitoring, and optimizing cloud infrastructure'),
('G04X7', 'Cyber Security Specialist', '$90,000 - $120,000', 'Chief Information Security Officer (CISO)', 'The Cybersecurity Specialist will be responsible for protecting the organization\'s networks, systems, and data from security breaches, cyber-attacks, and other threats. This role requires identifying vulnerabilities, implementing security measures, and monitoring network traffic to prevent unauthorized access. The specialist will also work to ensure compliance with security standards and best practices while collaborating with IT teams to improve the organization\'s overall cybersecurity.', 'Develop and implement security measures to protect the organization\'s IT infrastructure. Conduct regular security assessments and vulnerability testing on networks, applications, and systems. Monitor security systems and network traffic to identify potential threats or breaches. Stay current with the latest security trends, vulnerabilities, and emerging technologies to protect systems from new threats. Conduct employee training on cybersecurity awareness and safe practices. Collaborate with internal teams to ensure adherence to cybersecurity policies and best practices.', 'Bachelor’s degree in Cybersecurity, Information Technology, or a related field|Professional certifications in cybersecurity (e.g., CISSP, CISM, CompTIA Security+) are preferred|Master’s degree in a relevant field or specialized certifications (e.g., Certified Ethical Hacker (CEH), Certified Information Security Manager (CISM)) is a plus\r\n', 'Minimum of 3 years of professional experience in cybersecurity or information security|Proven experience in implementing and managing security tools, such as firewalls, antivirus software, and intrusion detection systems (IDS)| Experience with compliance frameworks such as ISO 27001, NIST, GDPR, or HIPAA is highly desirable|Familiarity with network protocols, encryption techniques, and security policies|Experience in analyzing security risks and incidents, and developing strategies to mitigate them\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs_database`
--
ALTER TABLE `jobs_database`
  ADD PRIMARY KEY (`job_ref`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
