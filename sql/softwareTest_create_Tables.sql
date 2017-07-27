-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Jul 2015 um 23:13
-- Server-Version: 5.6.24
-- PHP-Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `itv_v02`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hardware`
--

CREATE TABLE IF NOT EXISTS `hardware` (
  `h_id` int(11) NOT NULL,
  `raeume_r_id` int(11) NOT NULL,
  `lieferant_l_id` int(11) NOT NULL,
  `h_name` VARCHAR(45) NOT NULL,
  `h_bez` VARCHAR(45) NOT NULL,
  `h_einkaufsdatum` date DEFAULT NULL,
  `h_gewaehrleistungsdauer` int(11) DEFAULT NULL,
  `h_notiz` varchar(1024) DEFAULT NULL,
  `h_hersteller` varchar(45) DEFAULT NULL,
  `hardwarearten_ha_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hardwarearten`
--

CREATE TABLE IF NOT EXISTS `hardwarearten` (
  `ha_id` int(11) NOT NULL,
  `ha_hardwareart` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hardwareattribute`
--

CREATE TABLE IF NOT EXISTS `hardwareattribute` (
  `hat_id` int(11) NOT NULL,
  `hat_bezeichnung` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hardware_hat_attribute`
--

CREATE TABLE IF NOT EXISTS `hardware_hat_attribute` (
  `hardware_h_id` int(11) NOT NULL,
  `hardwareattribute_hat_id` int(11) NOT NULL,
  `hhhat_wert` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferant`
--

CREATE TABLE IF NOT EXISTS `lieferant` (
  `l_id` int(11) NOT NULL,
  `l_firmenname` varchar(45) DEFAULT NULL,
  `l_strasse` varchar(45) DEFAULT NULL,
  `l_plz` varchar(5) DEFAULT NULL,
  `l_ort` varchar(45) DEFAULT NULL,
  `l_tel` varchar(20) DEFAULT NULL,
  `l_mobil` varchar(20) DEFAULT NULL,
  `l_fax` varchar(20) DEFAULT NULL,
  `l_email` varchar(45) DEFAULT NULL,
  `l_ausgemustert` BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `raeume`
--

CREATE TABLE IF NOT EXISTS `raeume` (
  `r_id` int(11) NOT NULL,
  `r_nr` varchar(20) DEFAULT NULL COMMENT 'z.B. r014, W304, etc.',
  `r_bezeichnung` varchar(45) DEFAULT NULL COMMENT 'z.B. Werkstatt, Lager,...',
  `r_notiz` varchar(1024) DEFAULT NULL,
  `r_ausgemustert` BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `software_in_raum`
--

CREATE TABLE IF NOT EXISTS `software_in_raum` (
  `sir_h_id` int(11) NOT NULL,
  `sir_r_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wird_beschrieben_durch`
--

CREATE TABLE IF NOT EXISTS `wird_beschrieben_durch` (
  `hardwarearten_ha_id` int(11) NOT NULL,
  `hardwareattribute_hat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `software`
--

CREATE TABLE IF NOT EXISTS `software` (
  `s_id` int(11) NOT NULL,
  `s_name` VARCHAR(45) NOT NULL,
  `s_bez` VARCHAR(45) NOT NULL,
  `s_einkaufsdatum` date DEFAULT NULL,
  `s_lizenzlaufzeit` int(11) DEFAULT NULL,
  `s_notiz` varchar(1024) DEFAULT NULL,
  `s_hersteller` varchar(45) DEFAULT NULL,
  `s_vnr` VARCHAR(45) DEFAULT NULL,
  `s_lizenztyp` INT(4) DEFAULT 0,
  `s_anzahl` INT(8) DEFAULT 0,
  `s_lizenzinformation` VARCHAR(1024) DEFAULT NULL,
  `s_installhinweis` VARCHAR(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`h_id`);

ALTER TABLE `hardware` ADD KEY `fk_haendler` (`lieferant_l_id`), ADD KEY `fk_hardware_raeume1` (`raeume_r_id`), ADD KEY `fk_hardware_hardwarearten1` (`hardwarearten_ha_id`);

--
-- Indizes für die Tabelle `hardwarearten`
--
ALTER TABLE `hardwarearten`
  ADD PRIMARY KEY (`ha_id`);

--
-- Indizes für die Tabelle `hardwareattribute`
--
ALTER TABLE `hardwareattribute`
  ADD PRIMARY KEY (`hat_id`);

--
-- Indizes für die Tabelle `hardware_hat_attribute`
--
ALTER TABLE `hardware_hat_attribute`
  ADD PRIMARY KEY (`hardware_h_id`,`hardwareattribute_hat_id`);

ALTER TABLE `hardware_hat_attribute`
  ADD KEY `fk_hardware_has_hardwareattribute_hardwareattribute1` (`hardwareattribute_hat_id`), ADD KEY `fk_hardware_has_hardwareattribute_hardware1` (`hardware_h_id`);

--
-- Indizes für die Tabelle `lieferant`
--
ALTER TABLE `lieferant`
  ADD PRIMARY KEY (`l_id`);

--
-- Indizes für die Tabelle `raeume`
--
ALTER TABLE `raeume`
  ADD PRIMARY KEY (`r_id`);

--
-- Indizes für die Tabelle `software_in_raum`
--
ALTER TABLE `software_in_raum`
  ADD PRIMARY KEY (`sir_h_id`,`sir_r_id`);
ALTER TABLE `software_in_raum`
  ADD KEY `sir_r_id` (`sir_r_id`);
  
--
-- Indizes für die Tabelle `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`s_id`);

--
-- Indizes für die Tabelle `wird_beschrieben_durch`
--
ALTER TABLE `wird_beschrieben_durch`
  ADD PRIMARY KEY (`hardwarearten_ha_id`,`hardwareattribute_hat_id`);
ALTER TABLE `wird_beschrieben_durch`
  ADD KEY `fk_hardwarearten_has_hardwareattribute_hardwareattri1` (`hardwareattribute_hat_id`), ADD KEY `fk_hardwarearten_has_hardwareattribute_hardwarearten1` (`hardwarearten_ha_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `lieferant`
--
ALTER TABLE `lieferant`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `raeume`
--
ALTER TABLE `raeume`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `hardware`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `software`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT; 

ALTER TABLE `hardwareattribute`
  MODIFY `hat_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `hardwarearten`
  MODIFY `ha_id` int(11) NOT NULL AUTO_INCREMENT;  
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `Hardware`
--
ALTER TABLE `hardware`
ADD CONSTRAINT `fk_hardware_haendler` FOREIGN KEY (`lieferant_l_id`) REFERENCES `lieferant` (`l_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_hardware_hardwarearten1` FOREIGN KEY (`hardwarearten_ha_id`) REFERENCES `hardwarearten` (`ha_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `hardware_ibfk_1` FOREIGN KEY (`raeume_r_id`) REFERENCES `raeume` (`r_id`);

--
-- Constraints der Tabelle `hardware_hat_attribute`
--
ALTER TABLE `hardware_hat_attribute`
ADD CONSTRAINT `fk_hardware_has_hardwareattribute_hardware1` FOREIGN KEY (`hardware_h_id`) REFERENCES `hardware` (`h_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_hardware_has_hardwareattribute_hardwareattribute1` FOREIGN KEY (`hardwareattribute_hat_id`) REFERENCES `hardwareattribute` (`hat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `software_in_raum`
--
ALTER TABLE `software_in_raum`
ADD CONSTRAINT `software_in_raum_ibfk_1` FOREIGN KEY (`sir_r_id`) REFERENCES `raeume` (`r_id`),
ADD CONSTRAINT `software_in_raum_ibfk_2` FOREIGN KEY (`sir_h_id`) REFERENCES `software` (`s_id`);

--
-- Constraints der Tabelle `wird_beschrieben_durch`
--
ALTER TABLE `wird_beschrieben_durch`
ADD CONSTRAINT `fk_hardwarearten_has_hardwareattribute_hardwarearten1` FOREIGN KEY (`hardwarearten_ha_id`) REFERENCES `hardwarearten` (`ha_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_hardwarearten_has_hardwareattribute_hardwareattri1` FOREIGN KEY (`hardwareattribute_hat_id`) REFERENCES `hardwareattribute` (`hat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
