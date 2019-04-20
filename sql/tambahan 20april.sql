-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table apporder.detail_transaksi
DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE IF NOT EXISTS `detail_transaksi` (
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

-- Data exporting was unselected.
-- Dumping structure for table apporder.h_transaksi
DROP TABLE IF EXISTS `h_transaksi`;
CREATE TABLE IF NOT EXISTS `h_transaksi` (
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

-- Data exporting was unselected.
-- Dumping structure for view apporder.laporan_dapur
DROP VIEW IF EXISTS `laporan_dapur`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `laporan_dapur` (
	`id_bill` VARCHAR(17) NULL COLLATE 'latin1_swedish_ci',
	`tanggal` VARCHAR(8) NULL COLLATE 'utf8mb4_general_ci',
	`waktu` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`waktu_order` TIMESTAMP NOT NULL,
	`eod` DATE NOT NULL,
	`uniqid` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_meja` VARCHAR(7) NULL COLLATE 'latin1_swedish_ci',
	`id_product` VARCHAR(15) NULL COLLATE 'latin1_swedish_ci',
	`nama_product` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`quantity` SMALLINT(3) NOT NULL,
	`nama_waiters` VARCHAR(250) NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_jenis` VARCHAR(17) NULL COLLATE 'latin1_swedish_ci',
	`status_dapur` TINYINT(1) NULL,
	`keterangan_pesanan` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view apporder.laporan_penjualan
DROP VIEW IF EXISTS `laporan_penjualan`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `laporan_penjualan` (
	`id_bill` VARCHAR(17) NULL COLLATE 'latin1_swedish_ci',
	`uniqid_transaksi` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`status_print` TINYINT(4) NULL,
	`id_meja` VARCHAR(10) NULL COLLATE 'latin1_swedish_ci',
	`nama_meja` VARCHAR(7) NULL COLLATE 'latin1_swedish_ci',
	`waktu_order` TIMESTAMP NOT NULL,
	`hari` VARCHAR(32) NULL COLLATE 'utf8mb4_general_ci',
	`tanggal` VARCHAR(8) NULL COLLATE 'utf8mb4_general_ci',
	`waktu` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`eod` DATE NOT NULL,
	`uniqid` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_transaksi` INT(15) NOT NULL,
	`harga_jual` DECIMAL(10,0) NOT NULL,
	`quantity` SMALLINT(3) NOT NULL,
	`diskon_persen` DECIMAL(2,0) NOT NULL,
	`pajak_persen` DECIMAL(2,0) NOT NULL,
	`total_kotor` DECIMAL(15,0) NOT NULL,
	`nilai_pajak` DECIMAL(21,4) NULL,
	`nilai_potongan` DECIMAL(21,4) NULL,
	`total_bersih` DECIMAL(23,4) NULL,
	`void` TINYINT(1) NULL,
	`keterangan_pesanan` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_customer` VARCHAR(250) NULL COLLATE 'utf8mb4_unicode_ci',
	`id_jenis` VARCHAR(7) NULL COLLATE 'latin1_swedish_ci',
	`nama_jenis` VARCHAR(17) NULL COLLATE 'latin1_swedish_ci',
	`id_product` VARCHAR(15) NULL COLLATE 'latin1_swedish_ci',
	`nama_product` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nama_kasir` VARCHAR(250) NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_waiters` VARCHAR(250) NULL COLLATE 'utf8mb4_unicode_ci',
	`id_metode` TINYINT(1) NULL,
	`nama_metode` VARCHAR(12) NULL COLLATE 'latin1_swedish_ci',
	`id_tipe` TINYINT(1) NULL,
	`nama_tipe` VARCHAR(12) NULL COLLATE 'latin1_swedish_ci',
	`status` TINYINT(1) NOT NULL,
	`status_dapur` TINYINT(1) NULL
) ENGINE=MyISAM;

-- Dumping structure for view apporder.laporan_dapur
DROP VIEW IF EXISTS `laporan_dapur`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `laporan_dapur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `laporan_dapur` AS SELECT 
			
			id_bill,
			`tanggal`,
			`waktu`,
			waktu_order,
			`eod`,
			`uniqid`,
			nama_meja,
			id_product,
			nama_product,
			quantity,
			nama_waiters,
			nama_jenis,
			status_dapur,
			keterangan_pesanan
			
from laporan_penjualan

where eod=0 and void<>1 ;

-- Dumping structure for view apporder.laporan_penjualan
DROP VIEW IF EXISTS `laporan_penjualan`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `laporan_penjualan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_penjualan` AS select 
			concat(	`b`.`prefix_bill`,
						convert(date_format(`b`.`waktu_order`,'%y%m') using latin1),
						`b`.`id_metode`,
						convert(right(concat(`b`.`prefix_number`,`b`.`id_transaksi`),4) using latin1)) 
			AS `id_bill`,
			`d`.`uniqid_transaksi` AS `uniqid_transaksi`,
			`b`.`status_print` AS `status_print`,
			a.id_meja,
			`a`.`nama_meja` AS `nama_meja`,
			`b`.`waktu_order` AS `waktu_order`,
			date_format(`b`.`eod`,'%a') AS `hari`,
			date_format(`b`.`eod`,'%d-%m-%y') AS `tanggal`,
			date_format(`b`.`waktu_order`,'%H:%i') AS `waktu`,
			`b`.`eod` AS `eod`,
			`d`.`uniqid` AS `uniqid`,
			b.id_transaksi,
			`d`.`harga_jual` AS `harga_jual`,
			`d`.`quantity` AS `quantity`,
			`d`.`diskon_persen` AS `diskon_persen`,
			`d`.`pajak` AS `pajak_persen`,
			(`d`.`harga_jual` * `d`.`quantity`) AS `total_kotor`,
			(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100) AS `nilai_pajak`,
			(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100) AS `nilai_potongan`,
			(((`d`.`harga_jual` * `d`.`quantity`) + (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100)) - (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100)) AS `total_bersih`,
			`d`.`void` AS `void`,
			d.keterangan_pesanan,
			`c`.`display_name` AS `nama_customer`,
			`f`.`id_jenis` AS `id_jenis`,
			`f`.`nama_jenis` AS `nama_jenis`,
			`e`.`id_product` AS `id_product`,
			`e`.`nama_product` AS `nama_product`,
			`g`.`display_name` AS `nama_kasir`,`h`.`display_name` AS `nama_waiters`,
			`i`.id_metode,
			`i`.`nama_metode` AS `nama_metode`,
			`j`.`id_tipe` AS `id_tipe`,
			`j`.`nama_tipe` AS `nama_tipe`,
			b.`status`,
			d.status_dapur

 from (((((((((`h_transaksi` `b` left join `m_meja` `a` on((`a`.`id_meja` = `b`.`id_meja`))) left join `wp_apporder_users` `c` on((`c`.`ID` = `b`.`id_customer`))) join `detail_transaksi` `d` on((`d`.`uniqid_transaksi` = `b`.`uniqid`))) left join `m_product` `e` on((`d`.`id_product` = `e`.`id_product`))) left join `m_jenis` `f` on((`e`.`id_jenis` = `f`.`id_jenis`))) left join `wp_apporder_users` `g` on((`g`.`ID` = `b`.`id_kasir`))) left join `wp_apporder_users` `h` on((`h`.`ID` = `b`.`id_waiters`))) left join `m_metode_pembayaran` `i` on((`i`.`id_metode` = `b`.`id_metode`))) left join `m_tipe_pembayaran` `j` on((`j`.`id_tipe` = `b`.`id_tipe`))) ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
