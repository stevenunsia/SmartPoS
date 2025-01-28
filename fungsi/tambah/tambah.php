<?php

session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';

    if (!empty($_GET['supplier'])) {

        $kode_supplier = isset($_POST['kode_supplier']) ? htmlentities($_POST['kode_supplier']) : '';
        $nama_supplier = isset($_POST['nama_supplier']) ? htmlentities($_POST['nama_supplier']) : '';
        $alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : '';
        $telepon = isset($_POST['telepon']) ? htmlentities($_POST['telepon']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$kode_supplier, $nama_supplier, $alamat, $telepon, $tgl_input, $tgl_update];
        
            // Query untuk INSERT data baru
            $sql = 'INSERT INTO supplier (
                kode_supplier, 
                nama_supplier,
                alamat,
                telepon,
                tgl_input,
                tgl_update
            ) VALUES (?, ?, ?, ?, ?, ?)';
                    
            $row = $config->prepare($sql);
            $row->execute($data);

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=supplier&success=tambah-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (!empty($_GET['pelanggan'])) {

        $kode_pelanggan = isset($_POST['kode_pelanggan']) ? htmlentities($_POST['kode_pelanggan']) : '';
        $nama_pelanggan = isset($_POST['nama_pelanggan']) ? htmlentities($_POST['nama_pelanggan']) : '';
        $alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : '';
        $telepon = isset($_POST['telepon']) ? htmlentities($_POST['telepon']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$kode_pelanggan, $nama_pelanggan, $alamat, $telepon, $tgl_input, $tgl_update];
        
            // Query untuk INSERT data baru
            $sql = 'INSERT INTO pelanggan (
                kode_pelanggan, 
                nama_pelanggan,
                alamat,
                telepon,
                tgl_input,
                tgl_update
            ) VALUES (?, ?, ?, ?, ?, ?)';
                    
            $row = $config->prepare($sql);
            $row->execute($data);

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=pelanggan&success=tambah-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (!empty($_GET['merk'])) {

        $kode_merk = isset($_POST['kode_merk']) ? htmlentities($_POST['kode_merk']) : '';
        $nama_merk = isset($_POST['nama_merk']) ? htmlentities($_POST['nama_merk']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$kode_merk, $nama_merk, $tgl_input, $tgl_update];
        
            // Query untuk INSERT data baru
            $sql = 'INSERT INTO merk (
                kode_merk, 
                nama_merk,
                tgl_input,
                tgl_update
            ) VALUES (?, ?, ?, ?)';
                    
            $row = $config->prepare($sql);
            $row->execute($data);

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=merk&&success=tambah-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (!empty($_GET['kategori'])) {

        $nama_kategori = isset($_POST['nama_kategori']) ? htmlentities($_POST['nama_kategori']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$nama_kategori, $tgl_input, $tgl_update];
        
            // Query untuk INSERT data baru
            $sql = 'INSERT INTO kategori (
                nama_kategori, 
                tgl_input,
                tgl_update
            ) VALUES (?, ?, ?)';
                    
            $row = $config->prepare($sql);
            $row->execute($data);

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    if (!empty($_GET['barang'])) {

        $kode_barang = isset($_POST['kode_barang']) ? htmlentities($_POST['kode_barang']) : '';
        $nama_barang = isset($_POST['nama_barang']) ? htmlentities($_POST['nama_barang']) : '';
        $id_kategori = isset($_POST['id_kategori']) ? htmlentities($_POST['id_kategori']) : '';
        $id_supplier = isset($_POST['id_supplier']) ? htmlentities($_POST['id_supplier']) : '';
        $id_merk = isset($_POST['id_merk']) ? htmlentities($_POST['id_merk']) : '';
        $id_satuan = isset($_POST['id_satuan']) ? htmlentities($_POST['id_satuan']) : '';
        $harga_beli = isset($_POST['harga_beli']) ? htmlentities($_POST['harga_beli']) : '';
        $harga_jual = isset($_POST['harga_jual']) ? htmlentities($_POST['harga_jual']) : '';
        $stok = isset($_POST['stok']) ? htmlentities($_POST['stok']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        $upload_gambar = '';

        try {
            // echo "masuk mau upload";
            // echo var_export($_FILES);
            if (isset($_FILES['upload_gambar']) && $_FILES['upload_gambar']['error'] == 0) {
                echo ", masuk upload";
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];  // Allowed image extensions
                $file_name = $_FILES['upload_gambar']['name'];
                $file_tmp = $_FILES['upload_gambar']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                // echo ", ".$file_ext;
                // Check file extension
                if (in_array($file_ext, $allowed_extensions)) {
                    // echo ", allow extension";
                    // Set upload directory and generate unique filename
                    $upload_dir = '/assets/uploads/images/'; // Set your upload folder path
            
                    // Check if directory exists, if not create it
                    if (!is_dir($upload_dir)) {
                        // Attempt to create the directory with proper permissions
                        mkdir($upload_dir, 0755, true);
                    }
                    
                    $new_file_name = uniqid() . '.' . $file_ext;

                    // Move the uploaded file to the desired folder
                    echo ", mau move upload";
                    if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                        // echo ", move upload sukses";
                        $upload_gambar = $upload_dir . $new_file_name;  // Save the path in the database
                    } else {
                        echo "Error: File upload failed.";
                        exit;
                    }
                } else {
                    echo "Error: Invalid file extension.";
                    exit;
                }
                // echo ", upload fungsi end;"; die();
            }
            // else{
            //     echo ", tidak ada yang musti di upload fungsi end;"; die();
            // }

            $data = [$kode_barang, $nama_barang, $id_kategori, $id_supplier, $id_merk, $id_satuan, $harga_beli, $harga_jual, $stok, $upload_gambar, $tgl_input, $tgl_update];
        
        
            // Query untuk INSERT data baru
            $sql = 'INSERT INTO barang (
                kode_barang, 
                nama_barang, 
                id_kategori, 
                id_supplier, 
                id_merk, 
                id_satuan, 
                harga_beli, 
                harga_jual, 
                stok, 
                upload_gambar,
                tgl_input, 
                tgl_update
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                    
            $row = $config->prepare($sql);
            $row->execute($data);

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (!empty($_GET['satuan'])) {

        $kode_satuan = isset($_POST['kode_satuan']) ? htmlentities($_POST['kode_satuan']) : '';
        $nama_satuan = isset($_POST['nama_satuan']) ? htmlentities($_POST['nama_satuan']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$kode_satuan, $nama_satuan, $tgl_input, $tgl_update];
        
            // Query untuk INSERT data baru
            $sql = 'INSERT INTO satuan (
                kode_satuan, 
                nama_satuan,
                tgl_input,
                tgl_update
            ) VALUES (?, ?, ?, ?)';
                    
            $row = $config->prepare($sql);
            $row->execute($data);

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=satuan&success=tambah-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    if (!empty($_GET['jual'])) {
        $id = $_GET['id'];

        // get tabel barang id_barang
        $sql = 'SELECT * FROM barang WHERE kode_barang = ?';
        $row = $config->prepare($sql);
        $row->execute(array($id));
        $hsl = $row->fetch();

        if ($hsl['stok'] > 0) {
            $kasir =  $_GET['id_kasir'];
            $jumlah = 1;
            $total = $hsl['harga_jual'];
            $tgl = date('Y-m-d H:i:s'); // Format datetime (YYYY-MM-DD HH:mm:ss)

            $data1[] = $id;
            $data1[] = $kasir;
            $data1[] = $jumlah;
            $data1[] = $total;
            $data1[] = $tgl;

            $sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
            $row1 = $config -> prepare($sql1);
            $row1 -> execute($data1);

            echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
        } else {
            echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
        }
    }
}
