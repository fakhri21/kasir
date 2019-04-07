-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: apporder
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary view structure for view `laporan_keuangan`
--

DROP TABLE IF EXISTS `laporan_keuangan`;
/*!50001 DROP VIEW IF EXISTS `laporan_keuangan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `laporan_keuangan` AS SELECT 
 1 AS `id_coa`,
 1 AS `debit`,
 1 AS `kredit`,
 1 AS `nilai_voucher`,
 1 AS `eod`,
 1 AS `eom`,
 1 AS `eoy`,
 1 AS `nama_coa`,
 1 AS `saldo_normal_special`,
 1 AS `nama_kelompok_coa`,
 1 AS `id_kategori`,
 1 AS `nama_kategori`,
 1 AS `pos`,
 1 AS `saldo_normal`,
 1 AS `saldo_awal`,
 1 AS `status`,
 1 AS `id_nama_coa`,
 1 AS `id_nama_kelompok_coa`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `laporan_keuangan`
--

/*!50001 DROP VIEW IF EXISTS `laporan_keuangan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `laporan_keuangan` AS select `x`.`id_coa` AS `id_coa`,ifnull(`a`.`debit`,0) AS `debit`,ifnull(`a`.`kredit`,0) AS `kredit`,`a`.`nilai_voucher` AS `nilai_voucher`,`a`.`eod` AS `eod`,`a`.`eom` AS `eom`,`a`.`eoy` AS `eoy`,`x`.`nama_coa` AS `nama_coa`,`x`.`saldo_normal_special` AS `saldo_normal_special`,`b`.`nama_kelompok_coa` AS `nama_kelompok_coa`,`c`.`id_kategori` AS `id_kategori`,`c`.`nama_kategori` AS `nama_kategori`,`c`.`pos` AS `pos`,`c`.`saldo_normal` AS `saldo_normal`,`x`.`saldo_awal` AS `saldo_awal`,`a`.`status` AS `status`,concat(`x`.`id_coa`,' ',`x`.`nama_coa`) AS `id_nama_coa`,concat(`b`.`id_kelompok_coa`,' ',`b`.`nama_kelompok_coa`) AS `id_nama_kelompok_coa` from (((`m_coa` `x` left join `buku_besar` `a` on((`x`.`id_coa` = `a`.`id_coa`))) left join `m_kelompok_coa` `b` on((`x`.`id_kelompok_coa` = `b`.`uniqid`))) left join `m_akuntansi_kategori` `c` on((`b`.`id_kategori` = `c`.`uniqid`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-07 21:22:48
