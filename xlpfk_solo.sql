/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL_SRV_DEV
 Source Server Type    : MySQL
 Source Server Version : 50552
 Source Host           : localhost:3306
 Source Schema         : xlpfk_solo

 Target Server Type    : MySQL
 Target Server Version : 50552
 File Encoding         : 65001

 Date: 11/09/2019 23:33:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for masteralat
-- ----------------------------
DROP TABLE IF EXISTS `masteralat`;
CREATE TABLE `masteralat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alat` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_alat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `merk` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `model` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_seri` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_masuk` date NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `BNN` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tglpasif` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of masteralat
-- ----------------------------
INSERT INTO `masteralat` VALUES (1, 'AL001', 'Mesin1', 'Merek1', 'Model1', '1', '2019-08-29', 2, NULL, 'test 2', NULL);
INSERT INTO `masteralat` VALUES (2, 'AL002', 'alat 2', 'aat', 'mdl', '123', '2019-12-31', 4, NULL, 'solo', NULL);
INSERT INTO `masteralat` VALUES (3, 'AL003', 'ALAT 3', 'MEK', 'MOD', '123', '2019-12-31', 5, NULL, 'TEST', NULL);

-- ----------------------------
-- Table structure for masterfasyankes
-- ----------------------------
DROP TABLE IF EXISTS `masterfasyankes`;
CREATE TABLE `masterfasyankes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodefasyankes` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `namafasyankes` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomertlf` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(35) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penanggungjawab` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tglbergabung` date NULL DEFAULT NULL,
  `tglpasif` datetime NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of masterfasyankes
-- ----------------------------
INSERT INTO `masterfasyankes` VALUES (1, 'FY001', 'Hermina', 'solo', '0123', 'prasetyoajiw@gmail.com', 'aji', '2019-12-31', NULL, 'test 2');
INSERT INTO `masterfasyankes` VALUES (2, 'FY02', 'Jebres', 'solo', '081325058258', 'prasetyoajiw@gmail.com', 'paw', '2018-11-30', '2019-08-29 19:21:10', 'asd');

-- ----------------------------
-- Table structure for masterlabolatorium
-- ----------------------------
DROP TABLE IF EXISTS `masterlabolatorium`;
CREATE TABLE `masterlabolatorium`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodelab` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `namalab` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tglmasuk` date NULL DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tglpasif` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of masterlabolatorium
-- ----------------------------
INSERT INTO `masterlabolatorium` VALUES (1, 'LAP01', 'parahita', '2019-11-30', 'Solo', NULL);

-- ----------------------------
-- Table structure for peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notransaksi` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgltransaksi` date NULL DEFAULT NULL,
  `kodefasyankes` int(255) NOT NULL,
  `namapeminjam` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `namapetugas` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tujuanpinjam` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdby` int(255) NULL DEFAULT NULL,
  `createdon` datetime NULL DEFAULT NULL,
  `statustransaksi` int(11) NULL DEFAULT NULL COMMENT '0: open, 1: CLose',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_peminjaman`(`notransaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of peminjaman
-- ----------------------------
INSERT INTO `peminjaman` VALUES (1, '1201980001', '2019-09-11', 1, 'Prasetyo Aji Wibowo', 'ALI', 'Surakarta - Kota', 37, '2019-09-11 18:18:18', 0);
INSERT INTO `peminjaman` VALUES (2, '1201980002', '2019-09-11', 1, 'Prasetyo Aji Wibowo', 'AJJ', 'Surakarta - Kota', 37, '2019-09-11 18:20:19', 0);
INSERT INTO `peminjaman` VALUES (3, '1201980003', '2019-09-11', 1, 'Prasetyo Aji Wibowo', 'aji', 'Surakarta - Kota', 37, '2019-09-11 18:22:06', 0);

-- ----------------------------
-- Table structure for peminjamandetail
-- ----------------------------
DROP TABLE IF EXISTS `peminjamandetail`;
CREATE TABLE `peminjamandetail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headerid` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kodemesin` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `createdby` int(11) NULL DEFAULT NULL,
  `createdon` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `headerid`(`headerid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of peminjamandetail
-- ----------------------------
INSERT INTO `peminjamandetail` VALUES (1, '1201980001', 'AL001', 2, 37, '2019-09-11 18:18:19');
INSERT INTO `peminjamandetail` VALUES (2, '1201980001', 'AL003', 1, 37, '2019-09-11 18:18:19');
INSERT INTO `peminjamandetail` VALUES (3, '1201980002', 'AL003', 1, 37, '2019-09-11 18:20:20');
INSERT INTO `peminjamandetail` VALUES (4, '1201980003', 'AL003', 1, 37, '2019-09-11 18:22:06');
INSERT INTO `peminjamandetail` VALUES (5, '1201980003', 'AL002', 1, 37, '2019-09-11 18:22:06');

-- ----------------------------
-- Table structure for pengembalian
-- ----------------------------
DROP TABLE IF EXISTS `pengembalian`;
CREATE TABLE `pengembalian`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notransaksi` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgltransaksi` date NULL DEFAULT NULL,
  `nopinjam` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penerimabarang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for pengembaliandetail
-- ----------------------------
DROP TABLE IF EXISTS `pengembaliandetail`;
CREATE TABLE `pengembaliandetail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headerid` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kodealat` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlahkembali` int(15) NULL DEFAULT NULL,
  `createdon` datetime NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permissionname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ico` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menusubmenu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `multilevel` bit(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES (1, 'Daftar Mesin', 'home/mesinlist', NULL, '5', b'1');
INSERT INTO `permission` VALUES (2, 'Transaksi', '#', 'icon-bolt', '0', b'1');
INSERT INTO `permission` VALUES (3, 'Peminjaman Alat', 'home/pinjam', NULL, '2', b'1');
INSERT INTO `permission` VALUES (4, 'Pengembalian Alat', 'home/kembali', NULL, '2', b'1');
INSERT INTO `permission` VALUES (5, 'Master', NULL, 'icon-th-list', '0', b'1');
INSERT INTO `permission` VALUES (6, 'Daftar FASYANKES', 'home/fasyankes', NULL, '5', b'1');

-- ----------------------------
-- Table structure for permissionrole
-- ----------------------------
DROP TABLE IF EXISTS `permissionrole`;
CREATE TABLE `permissionrole`  (
  `roleid` int(11) NOT NULL,
  `permissionid` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permissionrole
-- ----------------------------
INSERT INTO `permissionrole` VALUES (1, 1);
INSERT INTO `permissionrole` VALUES (1, 2);
INSERT INTO `permissionrole` VALUES (1, 3);
INSERT INTO `permissionrole` VALUES (1, 4);
INSERT INTO `permissionrole` VALUES (1, 5);
INSERT INTO `permissionrole` VALUES (1, 6);
INSERT INTO `permissionrole` VALUES (1, 7);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Manager');
INSERT INTO `roles` VALUES (2, 'Admin');
INSERT INTO `roles` VALUES (3, 'User');

-- ----------------------------
-- Table structure for userrole
-- ----------------------------
DROP TABLE IF EXISTS `userrole`;
CREATE TABLE `userrole`  (
  `userid` int(11) NOT NULL,
  `roleid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`userid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of userrole
-- ----------------------------
INSERT INTO `userrole` VALUES (14, 1);
INSERT INTO `userrole` VALUES (30, 3);
INSERT INTO `userrole` VALUES (37, 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime NULL DEFAULT NULL,
  `HakAkses` int(255) NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `verified` bit(1) NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `browser` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (14, 'admin', 'admin', 'a9bdd47d7321d4089b3b00561c9c621848bd6f6e2f745a53d54913d613789c23945b66de6ded1eb336a7d526f9349a9d964d6f6c3a40e2ac90b4b16c0121f7895Xg53McbkyQ/NmW60Sf4cu3wJsi/8cyZXxeXV7g6b04=', 'mnl', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (30, 'megalodon', NULL, 'dd42771218e347c25ff78769d7980732fee6e2f20123e7c350464c66c88fc40d387c41c870a5c3d7e3c6b80a47be40be0b661f90862f9e3ffbac08652648f7f5DwU+Oa8TIr/dx0zrpBL9CJG0HhoULbg4PgRmoBZV71Q=', 'system', '2019-06-03 14:43:19', NULL, '9dce6c8a6b82974047fef438e04035f5', b'1', '::1', 'Chrome 74.0.3729.169', 'adjia7x@gmail.com', '81325058258');
INSERT INTO `users` VALUES (37, 'adji142', NULL, 'fb6206fc17efcb92acfacb7c0776724c2fcbc5beeb8a102204d66e34da2493b0590d730b8bf4317b3ad794c1387134f5c92917237657bce6ea0ee3699f2d1dc1r5FAhDCXlNPizLsILnT+4huYlDtxN/UmRNqIrkbLwXc=', 'system', '2019-07-24 18:07:16', NULL, 'b22510fc8e1edd9a4f257d422d35f7a5', b'1', '::1', 'Chrome 75.0.3770.142', 'prasetyoajiw@gmail.com', '81325058258');

SET FOREIGN_KEY_CHECKS = 1;
