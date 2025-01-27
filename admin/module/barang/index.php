        <h4>Data Barang</h4>
        <br />
        <?php if(isset($_GET['success-stok'])){?>
        <div class="alert alert-success">
            <p>Tambah Stok Berhasil !</p>
        </div>
        <?php }?>
        <?php if(isset($_GET['success'])){?>
        <div class="alert alert-success">
            <p>Tambah Data Berhasil !</p>
        </div>
        <?php }?>
        <?php if(isset($_GET['remove'])){?>
        <div class="alert alert-danger">
            <p>Hapus Data Berhasil !</p>
        </div>
        <?php }?>

        <?php 
			$sql=" select * from barang where stok <= 3";
			$row = $config -> prepare($sql);
			$row -> execute();
			$r = $row -> rowCount();
			if($r > 0){
				echo "
				<div class='alert alert-warning'>
					<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
					<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Cek Barang <i class='fa fa-angle-double-right'></i></a></span>
				</div>
				";	
			}
		?>
        <!-- Trigger the modal with a button -->
        <button id = "btn_insert" type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Insert Data</button>
        <a href="index.php?page=barang&stok=yes" class="btn btn-warning btn-md mr-2">
            <i class="fa fa-list"></i> Sortir Stok Kurang</a>
        <a href="index.php?page=barang" class="btn btn-primary btn-md mr-2">
            <i class="fa fa-refresh"></i> Refresh Data</a>
        <div class="clearfix"></div>
        <br />
        <!-- view barang -->
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="example1">
                    <thead>
                        <tr style="background:#DFF0D8;color:#333;">
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Supplier</th>
                            <th>Merk</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
						$totalBeli = 0;
						$totalJual = 0;
						$totalStok = 0;
						if($_GET['stok'] == 'yes')
						{
							$hasil = $lihat -> barang_stok();

						}else{
							$hasil = $lihat -> barang();
						}
						$no=1;
						foreach($hasil as $isi) {
					?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $isi['kode_barang'];?></td>
                            <td>
                            <?php
                            $upload_gambar = isset($isi['upload_gambar']) ? $isi['upload_gambar'] : '';
                            $linknya = '/assets/img/image_default.png';
                            if($upload_gambar != '') {
                                if(file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/images/'.$isi['upload_gambar']))
                                {
                                    $linknya = '/assets/uploads/images/'.$isi['upload_gambar'];
                                }
                            }
                                ?>
                            <img src="<?php echo $linknya;?>" alt="Thumbnail Preview" style="max-width: 200px; max-height: 200px;" />
                           
                            </td>
                            <td><?php echo $isi['nama_kategori'];?></td>
                            <td><?php echo $isi['nama_barang'];?></td>
                            <td><?php echo $isi['nama_supplier'];?></td>
                            <td><?php echo $isi['nama_merk'];?></td>
                            <td>
                                <?php if($isi['stok'] == '0'){?>
                                <button class="btn btn-danger"> Habis</button>
                                <?php }else{?>
                                <?php echo $isi['stok'];?>
                                <?php }?>
                            </td>
                            <td>Rp.<?php echo number_format($isi['harga_beli']);?>,-</td>
                            <td>Rp.<?php echo number_format($isi['harga_jual']);?>,-</td>
                            <td> <?php echo $isi['nama_satuan'];?></td>
                            <td>
                                <?php if($isi['stok'] <=  '3'){?>
                                <form method="POST" action="fungsi/edit/edit.php?stok=edit">
                                    <input type="text" name="restok" class="form-control">
                                    <input type="hidden" name="id" value="<?php echo $isi['id'];?>"
                                        class="form-control">
                                    <button class="btn btn-primary btn-sm">
                                        Restok
                                    </button>
                                </form>
                                <a href="fungsi/hapus/hapus.php?barang=hapus&id=<?php echo $isi['id'];?>"
                                        onclick="javascript:return confirm('Hapus Data barang ?');">
                                        <button class="btn btn-danger btn-sm">Hapus</button></a>
                                <?php }else{?>
                                <a href="index.php?page=barang/details&barang=<?php echo $isi['id'];?>"><button
                                        class="btn btn-primary btn-xs">View</button></a>

                                <a href="index.php?page=barang/edit&barang=<?php echo $isi['id'];?>"><button
                                        class="btn btn-warning btn-xs">Edit</button></a>
                                <a href="fungsi/hapus/hapus.php?barang=hapus&id=<?php echo $isi['id'];?>"
                                    onclick="javascript:return confirm('Hapus Data barang ?');"><button
                                        class="btn btn-danger btn-xs">Hapus</button></a>
                                <?php }?>
                        </tr>
                        <?php 
							$no++; 
							$totalBeli += $isi['harga_beli'] * $isi['stok']; 
							$totalJual += $isi['harga_jual'] * $isi['stok'];
							$totalStok += $isi['stok'];
						}
					?>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th colspan="6">Total </td>
                            <th><?php echo $totalStok;?></td>
                            <th>Rp.<?php echo number_format($totalBeli);?>,-</td>
                            <th>Rp.<?php echo number_format($totalJual);?>,-</td>
                            <th colspan="2" style="background:#ddd"></th>
                        </tr>
                        
                    </tfoot> -->
                </table>
            </div>
        </div>
        <!-- end view barang -->
        <!-- tambah barang MODALS-->
        <!-- Modal -->

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style=" border-radius:0px;">
                    <div class="modal-header" style="background:#285c64;color:#fff;">
                        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="fungsi/tambah/tambah.php?barang=tambah" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <table class="table table-striped bordered">
                                <?php
									$format = $lihat -> barang_id();
								?>
                                <tr>
                                    <td>ID Barang</td>
                                    <td><input type="text" readonly="readonly" required value="<?php echo $format;?>"
                                            class="form-control" name="kode_barang"></td>
                                </tr>
                                <tr>
                                    <td>Gambar</td>
                                    <td><input type="file" class="form-control" name="upload_gambar" accept="image/*"></td>
                                    <br>
                                    
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>
                                        <select name="id_kategori" class="form-control" required>
                                            <option value="">Pilih Kategori</option>
                                            <?php  $kat = $lihat -> kategori(); foreach($kat as $isi){ 	?>
                                            <option value="<?php echo $isi['id'];?>">
                                                <?php echo $isi['nama_kategori'];?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Barang</td>
                                    <td><input type="text" placeholder="Nama Barang" required class="form-control"
                                            name="nama_barang"></td>
                                </tr>
                                <tr>
                                    <td>Supplier</td>
                                    <td>
                                        <select name="id_supplier" class="form-control" required>
                                            <option value="">Pilih Supplier</option>
                                            <?php  $kat = $lihat -> supplier(); foreach($kat as $isi){ 	?>
                                            <option value="<?php echo $isi['id'];?>">
                                                <?php echo $isi['nama_supplier'];?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Merk Barang</td>
                                    <td>
                                        <select name="id_merk" class="form-control" required>
                                            <option value="">Pilih Merk Barang</option>
                                            <?php  $kat = $lihat -> merk(); foreach($kat as $isi){ 	?>
                                            <option value="<?php echo $isi['id'];?>">
                                                <?php echo $isi['nama_merk'];?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Harga Beli</td>
                                    <td><input type="number" placeholder="Harga beli" required class="form-control"
                                            name="harga_beli"></td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td><input type="number" placeholder="Harga Jual" required class="form-control"
                                            name="harga_jual"></td>
                                </tr>
                                <tr>
                                    <td>Satuan Barang</td>
                                    <td>
                                        <select name="id_satuan" class="form-control" required>
                                            <option value="">Pilih Satuan Barang</option>
                                            <?php  $kat = $lihat -> satuan(); foreach($kat as $isi){ 	?>
                                            <option value="<?php echo $isi['id'];?>">
                                                <?php echo $isi['nama_satuan'];?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td><input type="number" required Placeholder="Stok" class="form-control"
                                            name="stok"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Input</td>
                                    <td><input type="text" required readonly="readonly" class="form-control"
                                            value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                                Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    <script>
    $(document).ready(function(){
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('openModal') === 'true') {
            $('#myModal').modal('show');
        }
    });
    </script>
