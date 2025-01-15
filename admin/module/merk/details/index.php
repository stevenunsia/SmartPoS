<?php 
	$id = $_GET['merk'];
	$hasil = $lihat -> merk_edit($id);
?>
<a href="index.php?page=merk" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
<h4>Details Merk Barang</h4>

<div class="card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<td>Kode Merk</td>
				<td><?php echo $hasil['id_merk'];?></td>
			</tr>
			<tr>
				<td>Nama Merk</td>
				<td><?php echo $hasil['nama_merk'];?></td>
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