<?php 
	$id = $_GET['kategori'];
	$hasil = $lihat -> kategori_edit($id);
?>
<a href="index.php?page=kategori" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
<h4>Details Merk Barang</h4>

<div class="card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<td>Nama Kategori</td>
				<td><?php echo $hasil['nama_kategori'];?></td>
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