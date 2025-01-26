 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php 
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
			<form action="fungsi/edit/edit.php?barang=edit" method="POST">
				<tr>
					<td>ID Barang</td>
					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['id_barang'];?>"
							name="id"></td>
				</tr>
				<tr>
					<td>Kategori</td>
					<td>
						<select name="id_kategori" class="form-control">
							<option value="">Pilih Kategori</option>
							<?php  
							$kat = $lihat->kategori(); 
							$selectedKategori = $hasil['id_kategori']; // Ambil kategori yang terpilih dari hasil query

							foreach($kat as $isi) {  
								// Cek apakah kategori saat ini adalah yang terpilih
								$selected = ($isi['id_kategori'] == $selectedKategori) ? 'selected' : ''; 
							?>
								<option value="<?php echo $isi['id_kategori']; ?>" <?php echo $selected; ?>>
									<?php echo $isi['nama_kategori']; ?>
								</option>
							<?php } ?>
						</select>
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
								$selected = ($isi['id_supplier'] == $selectedSupplier) ? 'selected' : ''; 
							?>
								<option value="<?php echo $isi['id_supplier']; ?>" <?php echo $selected; ?>>
									<?php echo $isi['nama_supplier']; ?>
								</option>
							<?php } ?>
						</select>
					</td>
				</tr>


				
				<tr>
					<td>Merk</td>
					<td>
						<select name="merk" class="form-control" required>
							<option value="">Pilih Merk</option>
							<?php  
							$merkList = $lihat->merk(); 
							$selectedMerk = isset($hasil['id_merk']) ? $hasil['id_merk'] : ''; // Ambil ID merk yang terpilih sebelumnya

							foreach ($merkList as $isi) {  
								// Cek apakah merk saat ini adalah yang terpilih
								$selected = ($isi['merk'] == $selectedMerk) ? 'selected' : ''; 
							?>
								<option value="<?php echo $isi['id_merk']; ?>" <?php echo $selected; ?>>
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
					<td>Satuan Barang</td>
					<td>
						<?php $selected = ($hasil['satuan_barang'] == 'PCS') ? 'selected' : '';  ?>
						<select name="satuan_barang" class="form-control">
							<option value="<?php echo $hasil['satuan_barang'];?>"><?php echo $hasil['satuan_barang'];?>
							</option>
							<option value="#">Pilih Satuan</option>
							<option value="PCS" <?php echo $selected;?> >PCS</option>
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