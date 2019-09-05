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
    		SELECT a.id,a.notransaksi,a.tgltransaksi,b.namafasyankes,a.namapeminjam FROM peminjaman a
			LEFT JOIN masterfasyankes b on a.kodefasyankes = b.id
			WHERE a.statustransaksi = 0
    	";
    	return $this->db->query($sql);
    }

    public function GetPeminjamanDetailList($headerid)
    {
    	$sql = "
    		SELECT a.*, b.nama_alat,COALESCE(c.jumlahkembali,0) jumlahkembali FROM peminjamandetail a
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
}
