 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php 
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
	$id = $_GET['barang'];
	$hasil = $lihat -> barang_edit($id);
?>
 <a href="index.php?page=barang" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
 <h4>Edit Barang</h4>
 <?php if(isset($_GET['success'])){?>
 <div class="alert alert-success">
     <p>Data Stock di Update !</p>
 </div>
 <?php }?>
 <?php if(isset($_GET['remove'])){?>
 <div class="alert alert-danger">
     <p>Data Berhasil di Hapus !</p>
 </div>
 <?php }?>
<div class="card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<form action="fungsi/edit/edit.php?barang=edit" method="POST" enctype="multipart/form-data">
				<tr>
					<td>Kode Barang</td>
					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['kode_barang'];?>"
							name="kode_barang"></td>
							<input type="hidden" name="id" value="<?php echo $hasil['id'];?>">
				</tr>
				<tr>
					<td>Kategori</td>
					<td>
						<select name="id_kategori" class="form-control" required>
							<option value="">Pilih Kategori</option>
							<?php  
							$kat = $lihat->kategori(); 
							$selectedKategori = $hasil['id_kategori']; // Ambil kategori yang terpilih dari hasil query

							foreach($kat as $isi) {  
								// Cek apakah kategori saat ini adalah yang terpilih
								$selected = ($isi['id'] == $selectedKategori) ? 'selected' : ''; 
							?>
								<option value="<?php echo $isi['id']; ?>" <?php echo $selected; ?>>
									<?php echo $isi['nama_kategori']; ?>
								</option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr>
					<td>Gambar ..</td>
					<td>
						<input type="file" name="upload_gambar" class="form-control">
						<input type="hidden" name="upload_gambar_lama" value="<?php echo $hasil['upload_gambar']; ?>">

						<!-- Tempat untuk menampilkan thumbnail gambar -->
						<?php
							$upload_gambar = isset($hasil['upload_gambar']) ? $hasil['upload_gambar'] : '';
                            $linknya = '/assets/img/image_default.png';
                            if($upload_gambar != '') {
                                if(file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/images/'.$hasil['upload_gambar']))
                                {
                                    $linknya = '/assets/uploads/images/'.$hasil['upload_gambar'];
                                }
                            }
                        ?>
                            <img src="<?php echo $linknya;?>" alt="Thumbnail Preview" style="max-width: 200px; max-height: 200px;" />
                           
						
						
					</td>
				</tr>

				<tr>
					<td>Nama Barang</td>
					<td><input type="text" class="form-control" value="<?php echo $hasil['nama_barang'];?>" name="nama_barang"></td>
				</tr>
				<tr>
					<td>Supplier</td>
					<td>
						<select name="id_supplier" class="form-control" required>
							<option value="">Pilih Supplier</option>
							<?php  
							$kat = $lihat->supplier(); 
							$selectedSupplier = isset($hasil['id_supplier']) ? $hasil['id_supplier'] : ''; // Ambil ID supplier yang terpilih sebelumnya

							foreach ($kat as $isi) {  
								// Cek apakah supplier saat ini adalah yang terpilih
								$selected = ($isi['id'] == $selectedSupplier) ? 'selected' : ''; 
							?>
								<option value="<?php echo $isi['id']; ?>" <?php echo $selected; ?>>
									<?php echo $isi['nama_supplier']; ?>
								</option>
							<?php } ?>
						</select>
					</td>
				</tr>


				
				<tr>
					<td>Merk</td>
					<td>
						<select name="id_merk" class="form-control" required>
							<option value="">Pilih Merk</option>
							<?php  
							$merkList = $lihat->merk(); 
							$selectedMerk = isset($hasil['id_merk']) ? $hasil['id_merk'] : ''; // Ambil ID merk yang terpilih sebelumnya

							foreach ($merkList as $isi) {  
								// Cek apakah merk saat ini adalah yang terpilih
								$selected = ($isi['id'] == $selectedMerk) ? 'selected' : ''; 
							?>
								<option value="<?php echo $isi['id']; ?>" <?php echo $selected; ?>>
									<?php echo $isi['nama_merk']; ?>
								</option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr>
					<td>Harga Beli</td>
					<td><input type="number" class="form-control" value="<?php echo $hasil['harga_beli'];?>" name="harga_beli"></td>
				</tr>
				<tr>
					<td>Harga Jual</td>
					<td><input type="number" class="form-control" value="<?php echo $hasil['harga_jual'];?>" name="harga_jual"></td>
				</tr>

				<tr>
					<td>Satuan</td>
					<td>
						<select name="id_satuan" class="form-control" required>
							<option value="">Pilih Satuan</option>
							<?php  
							$satuanList = $lihat->satuan(); 
							$selectedSatuan = isset($hasil['id_satuan']) ? $hasil['id_satuan'] : ''; // Ambil ID merk yang terpilih sebelumnya

							foreach ($satuanList as $isi) {  
								// Cek apakah merk saat ini adalah yang terpilih
								$selected = ($isi['id'] == $selectedSatuan) ? 'selected' : ''; 
							?>
								<option value="<?php echo $isi['id']; ?>" <?php echo $selected; ?>>
									<?php echo $isi['nama_satuan']; ?>
								</option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr>
					<td>Stok</td>
					<td><input type="number" class="form-control" value="<?php echo $hasil['stok'];?>" name="stok"></td>
				</tr>
				<tr>
					<td>Tanggal Update</td>
					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>"
							name="tgl"></td>
				</tr>
				<tr>
					<td></td>
					<td><button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button></td>
				</tr>
			</form>
		</table>
	</div>
</div>