<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps_mod extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function GetPeminjamanList()
    {
    	$sql = "
    		SELECT a.id,a.notransaksi,a.tgltransaksi,b.kodefasyankes,b.namafasyankes,a.namapeminjam FROM peminjaman a
			LEFT JOIN masterfasyankes b on a.kodefasyankes = b.id
			WHERE a.statustransaksi = 0
    	";
    	return $this->db->query($sql);
    }
    public function GetPengembalianlist()
    {
        $sql = "
            SELECT 
                a.notransaksi,a.tgltransaksi,a.penerimabarang,
                c.kodefasyankes,c.namafasyankes,b.namapeminjam,b.notransaksi trx
            FROM pengembalian a
            LEFT JOIN peminjaman b on a.nopinjam = b.notransaksi
            LEFT JOIN masterfasyankes c on b.kodefasyankes = c.id
        ";
        return $this->db->query($sql);
    }
    public function GetPengembalianDetail($notransaksi)
    {
        $sql = "";
    }
    public function GetPeminjamanDetailList($headerid)
    {
    	$sql = "
    		SELECT a.*,a.jumlah - COALESCE(c.jumlahkembali,0) jumlah,b.nama_alat,0 jumlahkembali FROM peminjamandetail a
            LEFT JOIN masteralat b on a.kodemesin = b.kode_alat
            LEFT JOIN(
                SELECT a.nopinjam,b.kodealat,SUM(b.jumlahkembali) jumlahkembali FROM pengembalian a
                LEFT JOIN pengembaliandetail b on a.notransaksi = b.headerid
                GROUP BY a.nopinjam,b.kodealat
            )c on a.headerid = c.nopinjam AND a.kodemesin = c.kodealat
			WHERE a.headerid = '$headerid' AND a.jumlah - COALESCE(c.jumlahkembali,0) >0
    	";
    	return $this->db->query($sql);
    }
    public function GetPeminjamanDetailList_forvalidation($headerid)
    {
        $sql = "
            SELECT a.*,a.jumlah - COALESCE(c.jumlahkembali,0) jumlah,b.nama_alat,0 jumlahkembali FROM peminjamandetail a
            LEFT JOIN masteralat b on a.kodemesin = b.kode_alat
            LEFT JOIN(
                SELECT a.nopinjam,b.kodealat,SUM(b.jumlahkembali) jumlahkembali FROM pengembalian a
                LEFT JOIN pengembaliandetail b on a.notransaksi = b.headerid
                GROUP BY a.nopinjam,b.kodealat
            )c on a.headerid = c.nopinjam AND a.kodemesin = c.kodealat
            WHERE a.headerid = '$headerid' ORDER BY a.jumlah - COALESCE(c.jumlahkembali,0)
        ";
        return $this->db->query($sql);
    }
    public function GetPeminjamanDetailList_fordetail($headerid)
    {
        $sql = "
            SELECT a.*,COALESCE(c.jumlahkembali,0) jumlahkembali,b.nama_alat FROM peminjamandetail a
            LEFT JOIN masteralat b on a.kodemesin = b.kode_alat
            LEFT JOIN(
                    SELECT a.nopinjam,b.kodealat,SUM(b.jumlahkembali) jumlahkembali FROM pengembalian a
                    LEFT JOIN pengembaliandetail b on a.notransaksi = b.headerid
                    GROUP BY a.nopinjam,b.kodealat
            )c on a.headerid = c.nopinjam AND a.kodemesin = c.kodealat
            WHERE a.headerid = '$headerid'
        ";
        return $this->db->query($sql);
    }
    public function cekStock($itemcode)
    {
        $sql = "SELECT 
            SUM(COALESCE(a.jumlah,0) - COALESCE(b.jumlah,0) + COALESCE(c.jumlahkembali,0)) Stock
        FROM masteralat a
        LEFT JOIN(
                    SELECT x.kodemesin,SUM(x.jumlah) jumlah FROM peminjamandetail x
                    GROUP BY x.kodemesin
                ) b on a.kode_alat = b.kodemesin
        LEFT JOIN (
                    SELECT x.kodealat,SUM(x.jumlahkembali) jumlahkembali FROM pengembaliandetail x
                    GROUP BY x.kodealat
                ) c on a.kode_alat = c.kodealat
        WHERE a.kode_alat = '$itemcode'";
        return $this->db->query($sql);
    }
}
