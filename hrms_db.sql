-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 03:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `salt` varchar(128) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `expiration_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`id`, `username`, `password`, `email_address`, `salt`, `account_type_id`, `status_id`, `date_created`, `date_updated`, `expiration_date`) VALUES
(1, 'admin', '2d0051e963c3eff354044f0dea033fd50d064b71', '', '1610877379', 1, 1, '2021-01-17 18:02:47', '2021-01-17 18:02:47', NULL),
(53, 'josec', 'd58641b2809ac64505c534a80552fd8904135688', '', '1659857942', 3, 1, '2022-08-07 07:39:02', '2022-08-07 07:39:02', '2022-11-07 07:39:02'),
(72, 'patient', 'ed9da1d891b641266bc49a0a75ae54f4feaf102a', NULL, '1610877379', 4, 1, '2023-09-29 23:29:31', '2023-09-29 23:29:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_type`
--

CREATE TABLE `tbl_account_type` (
  `id` int(11) NOT NULL,
  `type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_account_type`
--

INSERT INTO `tbl_account_type` (`id`, `type`) VALUES
(1, 'super admin'),
(2, 'admin'),
(3, 'doctor'),
(4, 'patient'),
(5, 'secretary');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `description` text DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_birth_history`
--

CREATE TABLE `tbl_birth_history` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `blood_type` int(2) DEFAULT NULL,
  `term` int(1) DEFAULT NULL,
  `type_of_delivery` int(1) DEFAULT NULL,
  `birth_weight` float DEFAULT NULL,
  `birth_length` float DEFAULT NULL,
  `birth_head_circumference` float DEFAULT NULL,
  `birth_chest_circumference` float DEFAULT NULL,
  `birth_abdominal_circumference` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clinic`
--

CREATE TABLE `tbl_clinic` (
  `id` int(11) NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_clinic`
--

INSERT INTO `tbl_clinic` (`id`, `clinic`, `address`, `contact_number`, `status_id`) VALUES
(1, 'Angeles University Foundation Medical Center', 'Angeles City', '09171234567', 1),
(2, 'Green City Medical Center', 'City of San Fernando, Pampanga', '09088765432', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clinic_assignment`
--

CREATE TABLE `tbl_clinic_assignment` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_clinic_assignment`
--

INSERT INTO `tbl_clinic_assignment` (`id`, `account_id`, `clinic_id`, `status_id`) VALUES
(1, 53, 1, 1),
(2, 53, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultation_record`
--

CREATE TABLE `tbl_consultation_record` (
  `id` int(11) NOT NULL,
  `patient_account_id` int(11) NOT NULL,
  `doctor_account_id` int(11) NOT NULL,
  `subjective` text DEFAULT NULL,
  `objective` text DEFAULT NULL,
  `assessment` text DEFAULT NULL,
  `plan` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_of_consultation` date NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_consultation_record`
--

INSERT INTO `tbl_consultation_record` (`id`, `patient_account_id`, `doctor_account_id`, `subjective`, `objective`, `assessment`, `plan`, `notes`, `date_of_consultation`, `status_id`) VALUES
(1, 72, 53, 'Patient reports that she is feeling \'tired\' and that she \'can\'t seem to get out of bed in the morning.\' Patient is \'struggling to get to work\' and says that she \'constantly finds her mind wandering to negative thoughts.\' Patient stated that her sleep had been broken and she does not wake feeling rested. Patient reports that she does not feel as though the medication is making any difference and thinks she is getting worse.', 'Patient was unable to come into the practice and so has been seen at home. Patient\'s personal hygiene does not appear to be intact; she was unshaven and dressed in track pants and a hooded jumper which is unusual as she typically takes excellent care of her appearance. Patient appears to be tired; she is pale in complexion and has large circles under her eyes.\r\nPatient\'s compliance with her new medication is good, and she appears to have retained her food intake. Weight is stable and unchanged.', 'Patient presented this morning with low mood and affect. Patient exhibited speech that was slowed in rate, reduced in volume. Her articulation was coherent, and her language skills were intact. Her body posture and effect conveyed a depressed mood. Patient\'s facial expression and demeanor were of someone who is experiencing major depression. Affect is appropriate and congruent with mood. There are no visible signs of delusions, bizarre behaviors, hallucinations, or any other symptoms of psychotic process. Associations are intact, thinking is logical, and thought content appears to be congruent. Suicidal ideation is denied. Short and long-term memory is intact, as is the ability to abstract and do arithmetic calculations. Insight and judgment are good. No sign of substance use was present.', 'Diagnoses: The diagnoses are based on available information and may change as additional information becomes available.\r\nMajor depressive disorder, recurrent, severe F33.1 (ICD-10) Active\r\nLink to treatment Plan Problem: Depressed Mood\r\nProblem: Depressed Mood\r\nPatient\'s depressed mood has been identified as an active problem requiring ongoing treatment. It is primarily evident through a diagnosis of Major Depressive Disorder.\r\nLong-term goal:\r\nPatient will develop the ability to recognize and manage his depression.\r\nShort-term goals and interventions:\r\n-   Continue to attend weekly sessions with myself\r\n-   Continue to titrate up SSRI, fluoxetine\r\n-   To walk once a day\r\n-   To use a safety plan if required', NULL, '2023-09-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor_sched`
--

CREATE TABLE `tbl_doctor_sched` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `working_days` varchar(50) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status_id` int(11) NOT NULL,
  `clinic_assignment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_immunization`
--

CREATE TABLE `tbl_immunization` (
  `id` int(11) NOT NULL,
  `immunization` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_immunization`
--

INSERT INTO `tbl_immunization` (`id`, `immunization`, `description`, `status_id`) VALUES
(1, 'Bacille Calmette-Guérin (BCG)', 'Vaccine for Tuberculosis (given at birth)', 1),
(2, 'HEPATITIS B', 'Vaccine for Hepatitis B (given at birth)', 1),
(3, 'Pentavalent Vaccine (DPT-HepB-HiB)', 'Vaccine for five potential killers – Diptheria, Tetanus, Pertusis, Hib, and Hepatitis B', 1),
(4, 'Oral Polio Vaccine (OPV)', 'Vaccine for Polio', 1),
(5, 'Inactivated Polio Vaccine (IPV)', 'Vaccine for Polio', 1),
(6, 'Pneumococcal Conjugate Vaccine (PCV)', 'Vaccine for Pneumonia and Meningitis', 1),
(7, 'Measles Mumps Rubella (MMR)', 'Vaccine for four diseases: measles, mumps, rubella, and varicella (chickenpox)', 1),
(8, 'Flu Vaccine', 'Vaccine for Flu', 1),
(9, 'Covid-19 Vaccine', 'Vaccine for Covid-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_immunization_record`
--

CREATE TABLE `tbl_immunization_record` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `immunization_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_immunization_record`
--

INSERT INTO `tbl_immunization_record` (`id`, `account_id`, `immunization_id`, `date`, `remarks`, `status_id`) VALUES
(1, 72, 9, '2021-06-06', '1st Dose of Covid-19 Vaccine (Pfizer)', 1),
(2, 72, 9, '2021-12-06', '2nd Dose of Covid-19 Vaccine (AstraZeneca)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescription`
--

CREATE TABLE `tbl_prescription` (
  `id` int(11) NOT NULL,
  `patient_account_id` int(11) NOT NULL,
  `doctor_account_id` int(11) NOT NULL,
  `consultation_id` int(11) NOT NULL,
  `prescription` text NOT NULL,
  `date_of_prescription` date NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_prescription`
--

INSERT INTO `tbl_prescription` (`id`, `patient_account_id`, `doctor_account_id`, `consultation_id`, `prescription`, `date_of_prescription`, `status_id`) VALUES
(1, 72, 53, 1, 'Paracetamol (Biogesic) 500mg as needed\r\nSig: 3x a day every 4 hours.', '2023-09-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_secretary`
--

CREATE TABLE `tbl_secretary` (
  `id` int(11) NOT NULL,
  `secretary_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `status`) VALUES
(1, 'active'),
(2, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `middlename` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) NOT NULL,
  `qualifier` varchar(128) DEFAULT NULL,
  `dob` date NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `ptr_number` varchar(128) DEFAULT NULL,
  `license_number` varchar(128) DEFAULT NULL,
  `license_expiration` date DEFAULT NULL,
  `s2_number` varchar(128) DEFAULT NULL,
  `s2_expiration` date DEFAULT NULL,
  `maxicare_number` varchar(128) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `name_of_father` varchar(128) DEFAULT NULL,
  `father_dob` date DEFAULT NULL,
  `name_of_mother` varchar(128) DEFAULT NULL,
  `mother_dob` date DEFAULT NULL,
  `school` varchar(128) DEFAULT NULL,
  `gender` int(1) NOT NULL,
  `mother_contact_number` varchar(11) DEFAULT NULL,
  `father_contact_number` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `account_id`, `firstname`, `middlename`, `lastname`, `qualifier`, `dob`, `specialization`, `ptr_number`, `license_number`, `license_expiration`, `s2_number`, `s2_expiration`, `maxicare_number`, `address`, `name_of_father`, `father_dob`, `name_of_mother`, `mother_dob`, `school`, `gender`, `mother_contact_number`, `father_contact_number`) VALUES
(1, 1, 'Adriane Brent', 'Sicat', 'Castro', NULL, '1990-07-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(22, 53, 'Jose Nathaniel', 'Cuyugan', 'Castro', '', '1960-10-22', 'Family Medicine / General Medicine', '15734181', '0062407', '2022-12-31', '', NULL, '', 'Rodriguez, Rizal City, Philippines', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(36, 72, 'Belinda', 'Mercado', 'Cabrera', NULL, '1968-09-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'City of San Fernando, Pampanga', 'Gabriel P. Mercado II', '1943-06-12', 'Omeng Mercado', '1944-12-12', 'University of Santo Tomas', 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_type_to_account_account_type_id_idx` (`account_type_id`),
  ADD KEY `FK_status_to_account_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_account_type`
--
ALTER TABLE `tbl_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_status` (`status_id`),
  ADD KEY `doctorId` (`doctor_id`),
  ADD KEY `patientId` (`patient_id`),
  ADD KEY `fk_clinic` (`clinic_id`);

--
-- Indexes for table `tbl_birth_history`
--
ALTER TABLE `tbl_birth_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_birth_history_account_id_idx` (`account_id`);

--
-- Indexes for table `tbl_clinic`
--
ALTER TABLE `tbl_clinic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_status_to_clinic_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_clinic_assignment`
--
ALTER TABLE `tbl_clinic_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_clinic_assignment_account_id_idx` (`account_id`),
  ADD KEY `FK_clinic_to_clinic_assignment_clinic_id_idx` (`clinic_id`),
  ADD KEY `FK_status_to_clinic_assignment_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_consultation_record`
--
ALTER TABLE `tbl_consultation_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_consultation_record_patient_id_idx` (`patient_account_id`),
  ADD KEY `FK_account_to_consultation_record_doctor_account_id_idx` (`doctor_account_id`),
  ADD KEY `FK_status_to_consultation_record_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_doctor_sched`
--
ALTER TABLE `tbl_doctor_sched`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `fk_clinic_assignment` (`clinic_assignment`);

--
-- Indexes for table `tbl_immunization`
--
ALTER TABLE `tbl_immunization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_status_to_immunization_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_immunization_record`
--
ALTER TABLE `tbl_immunization_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_immunization_record_account_id_idx` (`account_id`),
  ADD KEY `FK_immunization_to_immunization_record_immunization_id_idx` (`immunization_id`),
  ADD KEY `FK_status_to_immunization_record_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_prescription_patient_id_idx` (`patient_account_id`),
  ADD KEY `FK_account_to_prescription_doctor_account_id_idx` (`doctor_account_id`),
  ADD KEY `FK_status_to_prescription_status_id_idx` (`status_id`),
  ADD KEY `FK_consultation_to_prescription_consultation_id_idx` (`consultation_id`);

--
-- Indexes for table `tbl_secretary`
--
ALTER TABLE `tbl_secretary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `secretary_id` (`secretary_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `fk_status_secretary` (`status_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_user_account_id_idx` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tbl_account_type`
--
ALTER TABLE `tbl_account_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_birth_history`
--
ALTER TABLE `tbl_birth_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_clinic`
--
ALTER TABLE `tbl_clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_clinic_assignment`
--
ALTER TABLE `tbl_clinic_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_consultation_record`
--
ALTER TABLE `tbl_consultation_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_doctor_sched`
--
ALTER TABLE `tbl_doctor_sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_immunization`
--
ALTER TABLE `tbl_immunization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_immunization_record`
--
ALTER TABLE `tbl_immunization_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_secretary`
--
ALTER TABLE `tbl_secretary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD CONSTRAINT `FK_account_type_to_account_account_type_id` FOREIGN KEY (`account_type_id`) REFERENCES `tbl_account_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_account_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_birth_history`
--
ALTER TABLE `tbl_birth_history`
  ADD CONSTRAINT `FK_account_to_birth_history_account_id` FOREIGN KEY (`account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_clinic`
--
ALTER TABLE `tbl_clinic`
  ADD CONSTRAINT `FK_status_to_clinic_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_clinic_assignment`
--
ALTER TABLE `tbl_clinic_assignment`
  ADD CONSTRAINT `FK_account_to_clinic_assignment_account_id` FOREIGN KEY (`account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_clinic_to_clinic_assignment_clinic_id` FOREIGN KEY (`clinic_id`) REFERENCES `tbl_clinic` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_clinic_assignment_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_consultation_record`
--
ALTER TABLE `tbl_consultation_record`
  ADD CONSTRAINT `FK_account_to_consultation_record_doctor_account_id` FOREIGN KEY (`doctor_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_account_to_consultation_record_patient_account_id` FOREIGN KEY (`patient_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_consultation_record_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_immunization`
--
ALTER TABLE `tbl_immunization`
  ADD CONSTRAINT `FK_status_to_immunization_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_immunization_record`
--
ALTER TABLE `tbl_immunization_record`
  ADD CONSTRAINT `FK_account_to_immunization_record_account_id` FOREIGN KEY (`account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_immunization_to_immunization_record_immunization_id` FOREIGN KEY (`immunization_id`) REFERENCES `tbl_immunization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_immunization_record_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  ADD CONSTRAINT `FK_account_to_prescription_doctor_account_id` FOREIGN KEY (`doctor_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_account_to_prescription_patient_account_id` FOREIGN KEY (`patient_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_consultation_to_prescription_consultation_id` FOREIGN KEY (`consultation_id`) REFERENCES `tbl_consultation_record` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_prescription_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `FK_account_to_user_account_id` FOREIGN KEY (`account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
