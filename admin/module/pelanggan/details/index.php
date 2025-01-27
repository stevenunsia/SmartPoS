<?php 
	$id = $_GET['pelanggan'];
	$hasil = $lihat -> pelanggan_edit($id);
?>
<a href="index.php?page=pelanggan" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
<h4>Details Pelanggan</h4>

<div class="card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<td>Kode Pelanggan</td>
				<td><?php echo $hasil['kode_pelanggan'];?></td>
			</tr>
			<tr>
				<td>Nama pelanggan</td>
				<td><?php echo $hasil['nama_pelanggan'];?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><?php echo $hasil['alamat'];?></td>
			</tr>
			<tr>
				<td>Telepon</td>
				<td><?php echo $hasil['telepon'];?></td>
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