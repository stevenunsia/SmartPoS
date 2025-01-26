<?php 
	$id = $_GET['supplier'];
	$hasil = $lihat -> supplier_edit($id);
?>
<a href="index.php?page=supplier" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
<h4>Details Supplier</h4>

<div class="card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<td>Kode Supplier</td>
				<td><?php echo $hasil['kode_supplier'];?></td>
			</tr>
			<tr>
				<td>Nama Supplier</td>
				<td><?php echo $hasil['nama_supplier'];?></td>
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