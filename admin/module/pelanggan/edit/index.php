 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php 
	$id = $_GET['pelanggan'];
	$hasil = $lihat -> pelanggan_edit($id);
?>
 <a href="index.php?page=pelanggan" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
 <h4>Edit Data Pelanggan</h4>
 <?php if(isset($_GET['success'])){?>
 <div class="alert alert-success">
     <p>Data Pelanggan di Update !</p>
 </div>
 <?php }?>
 <?php if(isset($_GET['remove'])){?>
 <div class="alert alert-danger">
     <p>Data Berhasil Dihapus !</p>
 </div>
 <?php }?>
<div class="card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<form action="fungsi/edit/edit.php?pelanggan=edit" method="POST">
				<input type="hidden" name="id" value="<?php echo $hasil['id'];?>">
				<tr>
					<td>Kode Pelanggan</td>
					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['kode_pelanggan'];?>"
							name="kode_pelanggan"></td>
				</tr>
				<tr>
					<td>Nama Pelanggan</td>
					<td><input type="text" class="form-control" value="<?php echo $hasil['nama_pelanggan'];?>" name="nama_pelanggan"></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><input type="text" class="form-control" value="<?php echo $hasil['alamat'];?>" name="alamat"></td>
				</tr>
				<tr>
					<td>Telepon</td>
					<td><input type="text" class="form-control" value="<?php echo $hasil['telepon'];?>" name="telepon"></td>
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