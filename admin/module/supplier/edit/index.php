 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php 
	$id = $_GET['supplier'];
	$hasil = $lihat -> supplier_edit($id);
?>
 <a href="index.php?page=supplier" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
 <h4>Edit Data Supplier</h4>
 <?php if(isset($_GET['success'])){?>
 <div class="alert alert-success">
     <p>Data Supplier di Update !</p>
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
			<form action="fungsi/edit/edit.php?supplier=edit" method="POST">
				<tr>
					<td>Kode Supplier</td>
					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['id_supplier'];?>"
							name="id"></td>
				</tr>
				<tr>
					<td>Nama Supplier</td>
					<td><input type="text" class="form-control" value="<?php echo $hasil['nama_supplier'];?>" name="nama"></td>
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