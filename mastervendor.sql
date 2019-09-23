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

 Date: 23/09/2019 20:06:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mastervendor
-- ----------------------------
DROP TABLE IF EXISTS `mastervendor`;
CREATE TABLE `mastervendor`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodevendor` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `namavendor` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tlp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tglmasuk` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mastervendor
-- ----------------------------
INSERT INTO `mastervendor` VALUES (1, 'VD-001', 'Prasetyo Aji Wibowo', 'Solo 1', '081325058258', '2019-09-23');

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jeniskelamin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `notlp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `divisi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgljoin` date NULL DEFAULT NULL,
  `tglresign` date NULL DEFAULT NULL,
  `createdon` datetime NULL DEFAULT NULL,
  `createdby` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pegawai
-- ----------------------------
INSERT INTO `pegawai` VALUES (1, '123456', 'Prasetyo Aji Wibowo', 'L', 'Solo', '081325058258', 'IT', 'MNG', '2019-09-23', '0000-00-00', '2019-09-23 13:55:07', 37);

SET FOREIGN_KEY_CHECKS = 1;
