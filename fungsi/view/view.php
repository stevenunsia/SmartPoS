<?php
/*
* PROSES TAMPIL
*/
class view
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function member()
    {
        $sql = "select member.*, login.*
                from member inner join login on member.id_member = login.id_member";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function member_edit($id)
    {
        $sql = "select member.*, login.*
                from member inner join login on member.id_member = login.id_member
                where member.id_member= ?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function toko()
    {
        $sql = "select*from toko where id_toko='1'";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function kategori()
    {
        $sql = "select*from kategori";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function supplier() {
        $sql = "SELECT * FROM supplier";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }
    
    public function supplier_cari($cari)
    {
        $sql = "select*from supplier
                where id_supplier like '%$cari%' or nama_supplier like '%$cari%' 
                or alamat like '%$cari%' or telepon like '%$cari%'";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function supplier_id()
    {
        $sql = 'SELECT * FROM supplier ORDER BY id DESC';
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();

        $urut = substr($hasil['kode_supplier'], 2, 3);
        $tambah = (int) $urut + 1;
        if (strlen($tambah) == 1) {
            $format = 'SP00'.$tambah.'';
        } elseif (strlen($tambah) == 2) {
            $format = 'SP0'.$tambah.'';
        } else {
            $ex = explode('BR', $hasil['kode_supplier']);
            $no = (int) $ex[1] + 1;
            $format = 'SP'.$no.'';
        }
        return $format;
    }

    public function supplier_edit($id) {
        $sql = "SELECT * FROM supplier WHERE id = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        return $hasil;
    }

    public function supplier_row()
    {
        $sql = "SELECT * FROM supplier";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> rowCount();
        return $hasil;
    }

    public function merk() {
        $sql = "SELECT * FROM merk";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function satuan() {
        $sql = "SELECT * FROM satuan";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function merk_cari($cari)
    {
        $sql = "select*from merk
                where id_merk like '%$cari%' or nama_merk like '%$cari%'";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function merk_id()
    {
        $sql = 'SELECT * FROM merk ORDER BY id DESC';
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();

        $urut = substr($hasil['kode_merk'], 2, 3);
        $tambah = (int) $urut + 1;
        if (strlen($tambah) == 1) {
            $format = 'MR00'.$tambah.'';
        } elseif (strlen($tambah) == 2) {
            $format = 'MR0'.$tambah.'';
        } else {
            $ex = explode('MR', $hasil['kode_merk']);
            $no = (int) $ex[1] + 1;
            $format = 'MR'.$no.'';
        }
        return $format;
    }

    public function merk_edit($id) {
        $sql = "SELECT * FROM merk WHERE id = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        return $hasil;
    }

    public function merk_row()
    {
        $sql = "SELECT * FROM merk";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> rowCount();
        return $hasil;
    }





















    public function barang()
    {
        $sql = "select barang.*, kategori.nama_kategori, merk.nama_merk, supplier.nama_supplier, satuan.nama_satuan
                from barang 
                left join kategori on barang.id_kategori = kategori.id 
                left join supplier on barang.id_supplier = supplier.id 
                left join merk on barang.id_merk = merk.id 
                left join satuan on barang.id_satuan = satuan.id 
                ORDER BY id DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function barang_stok()
    {
        $sql = "select barang.*, kategori.nama_kategori
                from barang 
                left join kategori on barang.id_kategori = kategori.id
                where stok <= 3 
                ORDER BY id DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    
    public function barang_edit($id)
    {
        $sql = "select barang.*, kategori.nama_kategori, merk.nama_merk, supplier.nama_supplier, satuan.nama_satuan
                from barang 
                left join kategori on barang.id_kategori = kategori.id 
                left join supplier on barang.id_supplier = supplier.id 
                left join merk on barang.id_merk = merk.id 
                left join satuan on barang.id_satuan = satuan.id 
                where barang.id=?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    

    public function barang_cari($cari)
    {
        $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
                from barang
                left join kategori on barang.id_kategori = kategori.id 
                left join supplier on barang.id_supplier = supplier.id 
                left join merk on barang.id_merk = merk.id 
                left join satuan on barang.id_satuan = satuan.id 
                where barang.kode_barang like '%$cari%' or 
                barang.nama_barang like '%$cari%' or 
                merk.nama_merk like '%$cari%'";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function barang_id()
    {
        $sql = 'SELECT * FROM barang ORDER BY id DESC';
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();

        $urut = substr($hasil['kode_barang'], 2, 3);
        $tambah = (int) $urut + 1;
        if (strlen($tambah) == 1) {
            $format = 'BR00'.$tambah.'';
        } elseif (strlen($tambah) == 2) {
            $format = 'BR0'.$tambah.'';
        } else {
            $ex = explode('BR', $hasil['kode_barang']);
            $no = (int) $ex[1] + 1;
            $format = 'BR'.$no.'';
        }
        return $format;
    }

    public function satuan_edit($id)
    {
        $sql = "select * from satuan
                where id=?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function kategori_edit($id)
    {
        $sql = "select * from kategori where id=?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function kategori_row()
    {
        $sql = "select*from kategori";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> rowCount();
        return $hasil;
    }

    public function barang_row()
    {
        $sql = "select*from barang";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> rowCount();
        return $hasil;
    }

    public function barang_stok_row()
    {
        $sql ="SELECT SUM(stok) as jml FROM barang";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function barang_beli_row()
    {
        $sql ="SELECT SUM(harga_beli) as beli FROM barang";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jual_row()
    {
        $sql ="SELECT SUM(jumlah) as stok FROM nota";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jual()
    {
        $sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,
                member.nm_member from nota 
                left join barang on barang.id_barang=nota.id_barang 
                left join member on member.id_member=nota.id_member 
                where nota.periode = ?
                ORDER BY id_nota DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array(date('m-Y')));
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function periode_jual($periode)
    {
        $sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,
                member.nm_member from nota 
                left join barang on barang.id_barang=nota.id_barang 
                left join member on member.id_member=nota.id_member WHERE nota.periode = ? 
                ORDER BY id_nota ASC";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($periode));
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function hari_jual($hari)
    {
        $ex = explode('-', $hari);
        $monthNum  = $ex[1];
        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
        if ($ex[2] > 9) {
            $tgl = $ex[2];
        } else {
            $tgl1 = explode('0', $ex[2]);
            $tgl = $tgl1[1];
        }
        $cek = $tgl.' '.$monthName.' '.$ex[0];
        $param = "%{$cek}%";
        $sql ="SELECT nota.* , barang.id_barang, barang.nama_barang,  barang.harga_beli, member.id_member,
                member.nm_member from nota 
                left join barang on barang.id_barang=nota.id_barang 
                left join member on member.id_member=nota.id_member WHERE nota.tanggal_input LIKE ? 
                ORDER BY id_nota ASC";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($param));
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function penjualan()
    {
        $sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, member.id_member,
                member.nm_member from penjualan 
                left join barang on barang.id_barang=penjualan.id_barang 
                left join member on member.id_member=penjualan.id_member
                ORDER BY id_penjualan";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function jumlah()
    {
        $sql ="SELECT SUM(total) as bayar FROM penjualan";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jumlah_nota()
    {
        $sql ="SELECT SUM(total) as bayar FROM nota";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jml()
    {
        $sql ="SELECT SUM(harga_beli*stok) as byr FROM barang";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function getSalesData() 
    {
        $sql = "SELECT DATE(tanggal_input) as tanggal, SUM(jumlah) as total_jumlah, SUM(total) as total_penjualan 
                FROM nota 
                GROUP BY DATE(tanggal_input) 
                ORDER BY DATE(tanggal_input) ASC";
        
        $stmt = $this-> db ->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
