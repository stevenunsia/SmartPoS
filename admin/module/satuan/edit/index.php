 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php 
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
	$id = $_GET['satuan'];
	$hasil = $lihat -> satuan_edit($id);
?>
 <a href="index.php?page=satuan" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
 <h4>Edit Satuan</h4>
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
			<form action="fungsi/edit/edit.php?satuan=edit" method="POST" enctype="multipart/form-data">
				<input type="hidden"  class="form-control" name="id"  value="<?php echo $hasil['id'];?>">
				<tr>
					<td>Kode Satuan</td>
					<td><input type="text"  class="form-control" name="kode_satuan"  value="<?php echo $hasil['kode_satuan'];?>" required></td>
				</tr>
				<tr>
					<td>Nama Satuan</td>
					<td><input type="text"  class="form-control" name="nama_satuan"  value="<?php echo $hasil['nama_satuan'];?>" required></td>
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