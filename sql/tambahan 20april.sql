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
-- Table structure for table `detail_transaksi`
--

DROP TABLE IF EXISTS `detail_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_transaksi` (
  `uniqid` varchar(25) NOT NULL,
  `id_detail_transaksi` bigint(35) NOT NULL AUTO_INCREMENT,
  `uniqid_transaksi` varchar(25) NOT NULL,
  `id_product` varchar(15) NOT NULL,
  `id_waiters` varchar(15) NOT NULL,
  `waktu_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `harga_jual` decimal(10,0) NOT NULL,
  `quantity` smallint(3) NOT NULL,
  `diskon_persen` decimal(2,0) NOT NULL,
  `pajak` decimal(2,0) NOT NULL,
  `keterangan_pesanan` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `void` tinyint(1) DEFAULT '0',
  `id_tipe` tinyint(1) DEFAULT '1',
  `status_dapur` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uniqid`),
  KEY `waiters` (`id_waiters`),
  KEY `uniqid_transaksi` (`uniqid_transaksi`),
  KEY `id_detail_transaksi` (`uniqid_transaksi`) USING BTREE,
  KEY `id_detail_transaksi_2` (`id_detail_transaksi`) USING BTREE,
  KEY `id_detail_transaksi_3` (`id_detail_transaksi`) USING BTREE,
  KEY `product` (`id_product`),
  CONSTRAINT `transaksi` FOREIGN KEY (`uniqid_transaksi`) REFERENCES `h_transaksi` (`uniqid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_transaksi`
--

LOCK TABLES `detail_transaksi` WRITE;
/*!40000 ALTER TABLE `detail_transaksi` DISABLE KEYS */;
INSERT INTO `detail_transaksi` VALUES ('98156116155826183',140,'5cb88b7c76a839.88884638','200040','','2019-04-18 14:36:44',25000,1,0,0,'kj',0,0,1,1),('98156116155826184',141,'5cb88b7c76a839.88884638','200068','','2019-04-18 14:36:44',3000,1,0,0,'',0,0,1,1),('98156116155826185',142,'5cb88bf7a7fc28.62454399','200068','','2019-04-18 14:38:47',3000,1,0,0,'',0,0,1,1),('98156116155826186',143,'5cb88bf7a7fc28.62454399','200039','','2019-04-18 14:38:48',30000,1,0,0,'hghg',0,0,1,1),('98156116155826187',144,'5cb88bf7a7fc28.62454399','100013','','2019-04-18 14:38:48',15000,1,0,0,'pedas',0,0,1,1),('98156116155826188',145,'5cb88c5d55aa06.86672518','200040','','2019-04-18 14:40:29',25000,3,0,0,'kj',0,0,1,1),('98156116155826189',146,'5cb88d45261eb5.92408519','100013','','2019-04-18 14:44:21',15000,1,0,0,'manis',0,0,1,1),('98158812036333568',147,'5cbaec4c786013.33688069','200068','','2019-04-20 09:54:20',3000,1,0,0,'dingin',0,0,1,0),('98158812036333569',148,'5cbaecdddaefb7.81436676','200039','','2019-04-20 09:56:45',30000,1,0,0,'',0,0,1,0);
/*!40000 ALTER TABLE `detail_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `h_transaksi`
--

DROP TABLE IF EXISTS `h_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_transaksi` (
  `uniqid` varchar(25) NOT NULL,
  `id_transaksi` int(15) NOT NULL AUTO_INCREMENT,
  `id_metode` tinyint(1) NOT NULL DEFAULT '1',
  `prefix_bill` char(5) NOT NULL DEFAULT 'PC-',
  `prefix_number` smallint(6) NOT NULL DEFAULT '10000',
  `id_customer` varchar(17) NOT NULL,
  `id_meja` varchar(3) NOT NULL,
  `id_waiters` varchar(17) NOT NULL,
  `id_kasir` varchar(25) NOT NULL,
  `waktu_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `status_print` tinyint(4) DEFAULT '0',
  `eod` date NOT NULL,
  `eom` date NOT NULL,
  `eoy` year(4) NOT NULL DEFAULT '2000',
  `id_tipe` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`uniqid`),
  UNIQUE KEY `id_transaksi` (`id_transaksi`),
  KEY `meja` (`id_meja`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1 COMMENT='Table untuk menyimpan header transaksi order pelanggan shop';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_transaksi`
--

LOCK TABLES `h_transaksi` WRITE;
/*!40000 ALTER TABLE `h_transaksi` DISABLE KEYS */;
INSERT INTO `h_transaksi` VALUES ('5cb88b7c76a839.88884638',120,1,'PC-',10000,'0','009','0','0','2019-04-18 14:36:44',0,0,'2019-04-19','0000-00-00',2000,1),('5cb88bf7a7fc28.62454399',121,1,'PC-',10000,'0','013','0','0','2019-04-18 14:38:47',0,0,'2019-03-10','0000-00-00',2000,1),('5cb88c5d55aa06.86672518',122,1,'PC-',10000,'0','007','0','0','2019-04-18 14:40:29',0,0,'2019-03-11','0000-00-00',2000,1),('5cb88d45261eb5.92408519',123,1,'PC-',10000,'0','008','0','0','2019-04-18 14:44:21',0,0,'2019-02-10','0000-00-00',2000,1),('5cbaec4c786013.33688069',124,1,'PC-',10000,'0','012','0','0','2019-04-20 09:54:20',0,0,'0000-00-00','0000-00-00',2000,1),('5cbaecdddaefb7.81436676',125,1,'PC-',10000,'0','001','0','0','2019-04-20 09:56:45',0,0,'0000-00-00','0000-00-00',2000,1);
/*!40000 ALTER TABLE `h_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `laporan_dapur`
--

DROP TABLE IF EXISTS `laporan_dapur`;
/*!50001 DROP VIEW IF EXISTS `laporan_dapur`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `laporan_dapur` AS SELECT 
 1 AS `id_bill`,
 1 AS `tanggal`,
 1 AS `waktu`,
 1 AS `waktu_order`,
 1 AS `eod`,
 1 AS `uniqid`,
 1 AS `nama_meja`,
 1 AS `id_product`,
 1 AS `nama_product`,
 1 AS `quantity`,
 1 AS `nama_waiters`,
 1 AS `nama_jenis`,
 1 AS `status_dapur`,
 1 AS `keterangan_pesanan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `laporan_penjualan`
--

DROP TABLE IF EXISTS `laporan_penjualan`;
/*!50001 DROP VIEW IF EXISTS `laporan_penjualan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `laporan_penjualan` AS SELECT 
 1 AS `id_bill`,
 1 AS `uniqid_transaksi`,
 1 AS `status_print`,
 1 AS `id_meja`,
 1 AS `nama_meja`,
 1 AS `waktu_order`,
 1 AS `hari`,
 1 AS `tanggal`,
 1 AS `waktu`,
 1 AS `eod`,
 1 AS `uniqid`,
 1 AS `id_transaksi`,
 1 AS `harga_jual`,
 1 AS `quantity`,
 1 AS `diskon_persen`,
 1 AS `pajak_persen`,
 1 AS `total_kotor`,
 1 AS `nilai_pajak`,
 1 AS `nilai_potongan`,
 1 AS `total_bersih`,
 1 AS `void`,
 1 AS `keterangan_pesanan`,
 1 AS `nama_customer`,
 1 AS `id_jenis`,
 1 AS `nama_jenis`,
 1 AS `id_product`,
 1 AS `nama_product`,
 1 AS `nama_kasir`,
 1 AS `nama_waiters`,
 1 AS `id_metode`,
 1 AS `nama_metode`,
 1 AS `id_tipe`,
 1 AS `nama_tipe`,
 1 AS `status`,
 1 AS `status_dapur`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `laporan_dapur`
--

/*!50001 DROP VIEW IF EXISTS `laporan_dapur`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY INVOKER */
/*!50001 VIEW `laporan_dapur` AS select `laporan_penjualan`.`id_bill` AS `id_bill`,`laporan_penjualan`.`tanggal` AS `tanggal`,`laporan_penjualan`.`waktu` AS `waktu`,`laporan_penjualan`.`waktu_order` AS `waktu_order`,`laporan_penjualan`.`eod` AS `eod`,`laporan_penjualan`.`uniqid` AS `uniqid`,`laporan_penjualan`.`nama_meja` AS `nama_meja`,`laporan_penjualan`.`id_product` AS `id_product`,`laporan_penjualan`.`nama_product` AS `nama_product`,`laporan_penjualan`.`quantity` AS `quantity`,`laporan_penjualan`.`nama_waiters` AS `nama_waiters`,`laporan_penjualan`.`nama_jenis` AS `nama_jenis`,`laporan_penjualan`.`status_dapur` AS `status_dapur`,`laporan_penjualan`.`keterangan_pesanan` AS `keterangan_pesanan` from `laporan_penjualan` where ((`laporan_penjualan`.`eod` = 0) and (`laporan_penjualan`.`void` <> 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `laporan_penjualan`
--

/*!50001 DROP VIEW IF EXISTS `laporan_penjualan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `laporan_penjualan` AS select concat(`b`.`prefix_bill`,convert(date_format(`b`.`waktu_order`,'%y%m') using latin1),`b`.`id_metode`,convert(right(concat(`b`.`prefix_number`,`b`.`id_transaksi`),4) using latin1)) AS `id_bill`,`d`.`uniqid_transaksi` AS `uniqid_transaksi`,`b`.`status_print` AS `status_print`,`a`.`id_meja` AS `id_meja`,`a`.`nama_meja` AS `nama_meja`,`b`.`waktu_order` AS `waktu_order`,date_format(`b`.`eod`,'%a') AS `hari`,date_format(`b`.`eod`,'%d-%m-%y') AS `tanggal`,date_format(`b`.`waktu_order`,'%H:%i') AS `waktu`,`b`.`eod` AS `eod`,`d`.`uniqid` AS `uniqid`,`b`.`id_transaksi` AS `id_transaksi`,`d`.`harga_jual` AS `harga_jual`,`d`.`quantity` AS `quantity`,`d`.`diskon_persen` AS `diskon_persen`,`d`.`pajak` AS `pajak_persen`,(`d`.`harga_jual` * `d`.`quantity`) AS `total_kotor`,(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100) AS `nilai_pajak`,(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100) AS `nilai_potongan`,(((`d`.`harga_jual` * `d`.`quantity`) + (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100)) - (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100)) AS `total_bersih`,`d`.`void` AS `void`,`d`.`keterangan_pesanan` AS `keterangan_pesanan`,`c`.`display_name` AS `nama_customer`,`f`.`id_jenis` AS `id_jenis`,`f`.`nama_jenis` AS `nama_jenis`,`e`.`id_product` AS `id_product`,`e`.`nama_product` AS `nama_product`,`g`.`display_name` AS `nama_kasir`,`h`.`display_name` AS `nama_waiters`,`i`.`id_metode` AS `id_metode`,`i`.`nama_metode` AS `nama_metode`,`j`.`id_tipe` AS `id_tipe`,`j`.`nama_tipe` AS `nama_tipe`,`b`.`status` AS `status`,`d`.`status_dapur` AS `status_dapur` from (((((((((`h_transaksi` `b` left join `m_meja` `a` on((`a`.`id_meja` = `b`.`id_meja`))) left join `wp_apporder_users` `c` on((`c`.`ID` = `b`.`id_customer`))) join `detail_transaksi` `d` on((`d`.`uniqid_transaksi` = `b`.`uniqid`))) left join `m_product` `e` on((`d`.`id_product` = `e`.`id_product`))) left join `m_jenis` `f` on((`e`.`id_jenis` = `f`.`id_jenis`))) left join `wp_apporder_users` `g` on((`g`.`ID` = `b`.`id_kasir`))) left join `wp_apporder_users` `h` on((`h`.`ID` = `b`.`id_waiters`))) left join `m_metode_pembayaran` `i` on((`i`.`id_metode` = `b`.`id_metode`))) left join `m_tipe_pembayaran` `j` on((`j`.`id_tipe` = `b`.`id_tipe`))) */;
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

-- Dump completed on 2019-04-20 17:40:39
