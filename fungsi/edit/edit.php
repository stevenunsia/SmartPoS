<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    if (!empty($_GET['pengaturan'])) {
        $nama= htmlentities($_POST['namatoko']);
        $alamat = htmlentities($_POST['alamat']);
        $kontak = htmlentities($_POST['kontak']);
        $pemilik = htmlentities($_POST['pemilik']);
        $id = '1';

        $data[] = $nama;
        $data[] = $alamat;
        $data[] = $kontak;
        $data[] = $pemilik;
        $data[] = $id;
        $sql = 'UPDATE toko SET nama_toko=?, alamat_toko=?, tlp=?, nama_pemilik=? WHERE id_toko = ?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
    }

    if (!empty($_GET['kategori']) && $_GET['kategori'] == 'edit') {

        $id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
        $nama_kategori = isset($_POST['nama_kategori']) ? htmlentities($_POST['nama_kategori']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$nama_merk, $tgl_update, $id];
        
            // Query untuk INSERT data baru
            $sql = 'UPDATE kategori SET 
                    nama_kategori = :nama_kategori, 
                    tgl_update = :tgl_update 
                    WHERE id = :id';

            $stmt = $config->prepare($sql);
            $stmt->bindParam(':nama_kategori', $nama_kategori, PDO::PARAM_STR);
            $stmt->bindParam(':tgl_update', $tgl_update, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=kategori&uid='.$id.'&success-edit=edit-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (!empty($_GET['supplier']) && $_GET['supplier'] == 'edit' ) {

        $id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
        $kode_supplier = isset($_POST['kode_supplier']) ? htmlentities($_POST['kode_supplier']) : '';
        $nama_supplier = isset($_POST['nama_supplier']) ? htmlentities($_POST['nama_supplier']) : '';
        $alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : '';
        $telepon = isset($_POST['telepon']) ? htmlentities($_POST['telepon']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$kode_supplier, $nama_supplier, $alamat, $telepon, $tgl_update, $id];
        
            // Query untuk INSERT data baru
            $sql = 'UPDATE supplier SET kode_supplier=?, nama_supplier=?, alamat=?, telepon=?, tgl_update=? WHERE id=?';
                    
            $row = $config->prepare($sql);
            $row->execute($data);

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=supplier/edit&supplier='.$id.'&success=edit-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (!empty($_GET['pelanggan']) && $_GET['pelanggan'] == 'edit' ) {

        $id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
        $kode_pelanggan = isset($_POST['kode_pelanggan']) ? htmlentities($_POST['kode_pelanggan']) : '';
        $nama_pelanggan = isset($_POST['nama_pelanggan']) ? htmlentities($_POST['nama_pelanggan']) : '';
        $alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : '';
        $telepon = isset($_POST['telepon']) ? htmlentities($_POST['telepon']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$kode_pelanggan, $nama_pelanggan, $alamat, $telepon, $tgl_update, $id];
        
            // Query untuk INSERT data baru
            $sql = 'UPDATE pelanggan SET kode_pelanggan=?, nama_pelanggan=?, alamat=?, telepon=?, tgl_update=? WHERE id=?';
                    
            $row = $config->prepare($sql);
            $row->execute($data);

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=pelanggan/edit&pelanggan='.$id.'&success=edit-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (!empty($_GET['merk']) && $_GET['merk'] == 'edit') {

        $id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
        $kode_merk = isset($_POST['kode_merk']) ? htmlentities($_POST['kode_merk']) : '';
        $nama_merk = isset($_POST['nama_merk']) ? htmlentities($_POST['nama_merk']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$nama_merk, $tgl_update, $id];
        
            // Query untuk INSERT data baru
            $sql = 'UPDATE merk SET 
                    nama_merk = :nama_merk, 
                    tgl_update = :tgl_update 
                    WHERE id = :id';

            $stmt = $config->prepare($sql);
            $stmt->bindParam(':nama_merk', $nama_merk, PDO::PARAM_STR);
            $stmt->bindParam(':tgl_update', $tgl_update, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=merk/edit&merk='.$id.'&success=edit-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    if (!empty($_GET['stok'])) {
        $restok = htmlentities($_POST['restok']);
        $id = htmlentities($_POST['id']);
        $dataS[] = $id;
        $sqlS = 'select*from barang WHERE id=?';
        $rowS = $config -> prepare($sqlS);
        $rowS -> execute($dataS);
        $hasil = $rowS -> fetch();

        $stok = $restok + $hasil['stok'];

        $data[] = $stok;
        $data[] = $id;
        $sql = 'UPDATE barang SET stok=? WHERE id=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=barang&success-stok=stok-data"</script>';
    }

    if (!empty($_GET['satuan'])) {

        $id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
        $kode_satuan = isset($_POST['kode_satuan']) ? htmlentities($_POST['kode_satuan']) : '';
        $nama_satuan = isset($_POST['nama_satuan']) ? htmlentities($_POST['nama_satuan']) : '';
        $tgl_input = date("Y-m-d H:i:s");
        $tgl_update = date("Y-m-d H:i:s");

        try {
            $data = [$kode_satuan, $nama_satuan, $tgl_update, $id];
        
            // Query untuk INSERT data baru
            $sql = 'UPDATE satuan SET 
                    kode_satuan=?, 
                    nama_satuan=?,
                    tgl_update=?
                    WHERE id=?';
                    
            $row = $config->prepare($sql);
            $row->execute($data);

            // Redirect setelah berhasil insert
            echo '<script>window.location="../../index.php?page=satuan/edit&satuan='.$id.'&success=edit-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    if (!empty($_GET['barang'])) {

        $id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
        $kode_barang = isset($_POST['kode_barang']) ? htmlentities($_POST['kode_barang']) : '';
        $nama_barang = isset($_POST['nama_barang']) ? htmlentities($_POST['nama_barang']) : '';
        $id_kategori = isset($_POST['id_kategori']) ? htmlentities($_POST['id_kategori']) : '';
        $id_supplier = isset($_POST['id_supplier']) ? htmlentities($_POST['id_supplier']) : '';
        $id_merk = isset($_POST['id_merk']) ? htmlentities($_POST['id_merk']) : '';
        $id_satuan = isset($_POST['id_satuan']) ? htmlentities($_POST['id_satuan']) : '';
        $harga_beli = isset($_POST['harga_beli']) ? htmlentities($_POST['harga_beli']) : '';
        $harga_jual = isset($_POST['harga_jual']) ? htmlentities($_POST['harga_jual']) : '';
        $stok = isset($_POST['stok']) ? htmlentities($_POST['stok']) : '';
        $tgl_update = date("Y-m-d H:i:s");
        
        $upload_gambar = '';
        try {
            // echo "masuk mau upload";
            // echo var_export($_FILES);
            if (isset($_FILES['upload_gambar']) && $_FILES['upload_gambar']['error'] == 0) {
                // echo ", masuk upload";
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];  // Allowed image extensions
                $file_name = $_FILES['upload_gambar']['name'];
                $file_tmp = $_FILES['upload_gambar']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                // echo ", ".$file_ext;
                // Check file extension
                if (in_array($file_ext, $allowed_extensions)) {
                    // echo ", allow extension";
                    // Set upload directory and generate unique filename
                    $upload_dir = $_SERVER['DOCUMENT_ROOT'] .'/assets/uploads/images/'; // Set your upload folder path
            
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
                        $upload_gambar = $new_file_name;  // Save the path in the database
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
            else {
                $upload_gambar = isset($_POST['upload_gambar_lama']) ? htmlentities($_POST['upload_gambar_lama']) : '';
            }
            // else{
            //     echo ", tidak ada yang musti di upload fungsi end;"; die();
            // }

            $data = [$kode_barang, $nama_barang, $id_kategori, $id_supplier, $id_merk, $id_satuan, $harga_beli, $harga_jual, $stok, $upload_gambar, $tgl_update, $id];
    
        
            $sql = 'UPDATE barang SET 
                        kode_barang=?, 
                        nama_barang=?, 
                        id_kategori=?, 
                        id_supplier=?, 
                        id_merk=?, 
                        id_satuan=?, 
                        harga_beli=?, 
                        harga_jual=?, 
                        stok=?, 
                        upload_gambar=?,
                        tgl_update=?
                    WHERE id=?';
            $row = $config->prepare($sql);
            $row->execute($data);
            // $row->debugDumpParams();
            // die();
            echo '<script>window.location="../../index.php?page=barang/edit&barang='.$id.'&success=edit-data"</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (!empty($_GET['gambar'])) {
        $id = htmlentities($_POST['id']);
        set_time_limit(0);
        $allowedImageType = array("image/gif", "image/JPG", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", 'image/webp');
        $filepath = $_FILES['foto']['tmp_name'];
        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);
        $allowedTypes = [
            'image/png'   => 'png',
            'image/jpeg'  => 'jpg',
            'image/gif'   => 'gif',
            'image/jpg'   => 'jpeg',
            'image/webp'  => 'webp'
        ];
        if(!in_array($filetype, array_keys($allowedTypes))) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="../../index.php?page=user"</script>';
            exit;
        }else if ($_FILES['foto']["error"] > 0) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="../../index.php?page=user"</script>';
            exit;
        } elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
            // echo "You can only upload JPG, PNG and GIF file";
            // echo "<font face='Verdana' size='2' ><BR><BR><BR>
            // 		<a href='../../index.php?page=user'>Back to upform</a><BR>";
            echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="../../index.php?page=user"</script>';
            exit;
        } elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
            // echo "WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB";
            // echo "<font face='Verdana' size='2' ><BR><BR><BR>
            // 		<a href='../../index.php?page=user'>Back to upform</a><BR>";
            echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB");window.location="../../index.php?page=user"</script>';
            exit;
        } else {
            $dir = '../../assets/img/user/';
            $tmp_name = $_FILES['foto']['tmp_name'];
            $name = time().basename($_FILES['foto']['name']);
            if (move_uploaded_file($tmp_name, $dir.$name)) {
                //post foto lama
                $foto2 = $_POST['foto2'];
                //remove foto di direktori
                unlink('../../assets/img/user/'.$foto2.'');
                //input foto
                $id = $_POST['id'];
                $data[] = $name;
                $data[] = $id;
                $sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
                $row = $config -> prepare($sql);
                $row -> execute($data);
                echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
            } else {
                echo '<script>alert("Masukan Gambar !");window.location="../../index.php?page=user"</script>';
                exit;
            }
        }
    }

    if (!empty($_GET['profil'])) {
        $id = htmlentities($_POST['id']);
        $nama = htmlentities($_POST['nama']);
        $alamat = htmlentities($_POST['alamat']);
        $tlp = htmlentities($_POST['tlp']);
        $email = htmlentities($_POST['email']);
        $nik = htmlentities($_POST['nik']);

        $data[] = $nama;
        $data[] = $alamat;
        $data[] = $tlp;
        $data[] = $email;
        $data[] = $nik;
        $data[] = $id;
        $sql = 'UPDATE member SET nm_member=?,alamat_member=?,telepon=?,email=?,NIK=? WHERE id_member=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
    }
    
    if (!empty($_GET['pass'])) {
        $id = htmlentities($_POST['id']);
        $user = htmlentities($_POST['user']);
        $pass = htmlentities($_POST['pass']);
        $passHash = hash('sha256', $pass);  // Menggunakan SHA-256 untuk hashing password
    
        $data = [$user, $passHash, $id];
        $sql = 'UPDATE login SET user=?, pass=? WHERE id_member=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
    }
    

    if (!empty($_GET['jual'])) {
        $id = htmlentities($_POST['id']);
        $id_barang = htmlentities($_POST['id_barang']);
        $jumlah = htmlentities($_POST['jumlah']);

        $sql_tampil = "select *from barang where barang.kode_barang=?";
        $row_tampil = $config -> prepare($sql_tampil);
        $row_tampil -> execute(array($id_barang));
        $hasil = $row_tampil -> fetch();

        if ($hasil['stok'] > $jumlah) {
            $jual = $hasil['harga_jual'];
            $total = $jual * $jumlah;
            $data1[] = $jumlah;
            $data1[] = $total;
            $data1[] = $id;
            $sql1 = 'UPDATE penjualan SET jumlah=?,total=? WHERE id_penjualan=?';
            $row1 = $config -> prepare($sql1);
            $row1 -> execute($data1);
            echo '<script>window.location="../../index.php?page=jual#keranjang"</script>';
        } else {
            echo '<script>alert("Keranjang Melebihi Stok Barang Anda !");
					window.location="../../index.php?page=jual#keranjang"</script>';
        }
    }

    if (!empty($_GET['cari_barang'])) {
        $cari = trim(strip_tags($_POST['keyword']));
        if ($cari == '') {
        } else {
            $sql = "select barang.*, kategori.nama_kategori, merk.nama_merk, supplier.nama_supplier, satuan.nama_satuan
                    from barang 
                    left join kategori on barang.id_kategori = kategori.id 
                    left join supplier on barang.id_supplier = supplier.id 
                    left join merk on barang.id_merk = merk.id 
                    left join satuan on barang.id_satuan = satuan.id 
					where barang.kode_barang like '%$cari%' or 
                    barang.nama_barang like '%$cari%' or 
                    merk.nama_merk like '%$cari%'";
            $row = $config -> prepare($sql);
            $row -> execute();
            $hasil1= $row -> fetchAll();
            ?>
		<table class="table table-stripped" width="100%" id="example2">
			<tr>
				<th>ID Barang</th>
				<th>Nama Barang</th>
				<th>Merk</th>
                <th>Stok</th>
				<th>Harga Jual</th>
				<th>Aksi</th>
			</tr>
		<?php foreach ($hasil1 as $hasil) {?>
			<tr>
				<td><?php echo $hasil['kode_barang'];?></td>
				<td><?php echo $hasil['nama_barang'];?></td>
				<td><?php echo $hasil['nama_merk'];?></td>
                <td><?php echo $hasil['stok'];?></td>
				<td><?php echo $hasil['harga_jual'];?></td>
				<td>
				<a href="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $hasil['kode_barang'];?>&id_kasir=<?php echo $_SESSION['admin']['id_member'];?>" 
					class="btn btn-success">
					<i class="fa fa-cart-plus"></i></a></td>
			</tr>
		<?php }?>
		</table>
<?php
        }
    }
}
