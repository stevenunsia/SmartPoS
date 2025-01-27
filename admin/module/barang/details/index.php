<?php 
	$id = $_GET['barang'];
	$hasil = $lihat -> barang_edit($id);
?>
<a href="index.php?page=barang" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
<h4>Details Barang</h4>
<?php if(isset($_GET['success-stok'])){?>
<div class="alert alert-success">
	<p>Stock Berhasil di Tambahkan !</p>
</div>
<?php }?>
<?php if(isset($_GET['success'])){?>
<div class="alert alert-success">
	<p>Data Berhasil di Tambahkan !</p>
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
			<tr>
				<td>Kode Barang</td>
				<td><?php echo $hasil['kode_barang'];?></td>
			</tr>
			<tr>
				<td>Kategori</td>
				<td><?php echo $hasil['nama_kategori'];?></td>
			</tr>
			<tr>
				<td>Gambar</td>
				<td>
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
				<td><?php echo $hasil['nama_barang'];?></td>
			</tr>
			<tr>
				<td>Nama Barang</td>
				<td><?php echo $hasil['nama_supplier'];?></td>
			</tr>
			<tr>
				<td>Merk Barang</td>
				<td><?php echo $hasil['nama_merk'];?></td>
			</tr>
			<tr>
				<td>Harga Beli</td>
				<td><?php echo $hasil['harga_beli'];?></td>
			</tr>
			<tr>
				<td>Harga Jual</td>
				<td><?php echo $hasil['harga_jual'];?></td>
			</tr>
			<tr>
				<td>Satuan Barang</td>
				<td><?php echo $hasil['nama_satuan'];?></td>
			</tr>
			<tr>
				<td>Stok</td>
				<td><?php echo $hasil['stok'];?></td>
			</tr>
			<tr>
				<td>Tanggal Input</td>
				<td><?php echo $hasil['tgl_input'];?></td>
			</tr>
			<tr>
				<td>Tanggal Update</td>
				<td><?php echo $hasil['tgl_update'];?></td>
			</tr>
		</table>
	</div>
</div>