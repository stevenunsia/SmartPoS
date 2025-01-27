<?php 
	$id = $_GET['satuan'];
	$hasil = $lihat->satuan_edit($id);
?>
<a href="index.php?page=satuan" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
<h4>Details Satuan</h4>
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
				<td>Kode Satuan</td>
				<td><?php echo $hasil['kode_satuan'];?></td>
			</tr>
			<tr>
				<td>Nama Satuan</td>
				<td><?php echo $hasil['nama_satuan'];?></td>
			</tr>
			
			<tr>
				<td>Tanggal Update</td>
				<td><?php echo  date("j F Y, G:i");?></td>
			</tr>
		</table>
	</div>
</div>