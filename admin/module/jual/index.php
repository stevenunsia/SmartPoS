
<?php 
	$id = $_SESSION['admin']['id_member'];
	$hasil = $lihat->member_edit($id);
	// error_reporting(E_ALL);  // Aktifkan semua jenis error
// ini_set('display_errors', 1);  // Tampilkan error di browser
?>

<style>
.blink {
    animation: blink-animation 0.5s steps(2, start) infinite;
    border: 2px solid red; /* Tambahkan efek visual */
}

@keyframes blink-animation {
    to {
        visibility: hidden;
    }
}
</style>

	<h4>Keranjang Penjualan</h4>
	<br>
	<?php if(isset($_GET['success'])){?>
	<div class="alert alert-success">
		<p>Edit Data Berhasil !</p>
	</div>
	<?php }?>
	<?php if(isset($_GET['remove'])){?>
	<div class="alert alert-danger">
		<p>Hapus Data Berhasil !</p>
	</div>
	<?php }?>
	<div class="row">
		<div class="col-sm-4">
			<div class="card card-primary mb-3">
				<div class="card-header bg-primary text-white">
					<h5><i class="fa fa-search"></i> Cari Barang</h5>
				</div>
				<div class="card-body">
				<input type="text" id="cari" class="form-control" name="cari" placeholder="Masukan : Kode / Nama Barang [ENTER]">
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="card card-primary mb-3">
				<div class="card-header bg-primary text-white">
					<h5><i class="fa fa-list"></i> Hasil Pencarian</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<div id="hasil_cari"></div>
						<div id="tunggu"></div>
					</div>
				</div>
			</div>
		</div>
		

		<div class="col-sm-12">
			<div class="card card-primary">
				<div class="card-header bg-primary text-white">
					<h5><i class="fa fa-shopping-cart"></i> KASIR
					<!-- <a class="btn btn-danger float-right" 
						onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="fungsi/hapus/hapus.php?penjualan=jual">
						<b>RESET KERANJANG</b></a>
					</h5> -->
				</div>
				<div class="card-body">
					<div id="keranjang" class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td><b>Tanggal</b></td>
								<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
							</tr>
							<tr>
								<td><b>Pelanggan</b></td>
								<td>
									<select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
										<option value="">Pilih Pelanggan</option>
										<?php  $kat = $lihat -> pelanggan(); foreach($kat as $isi){ 	?>
										<option value="<?php echo $isi['id'];?>">
											<?php echo $isi['nama_pelanggan'];?></option>
										<?php }?>
									</select>
								</td>
							</tr>
						</table>
						<table class="table table-bordered w-100" id="example1">
							<thead>
								<tr>
									<td> No</td>
									<td> Nama Barang</td>
									<td style="width:10%;"> Jumlah</td>
									<td style="width:20%;"> Total</td>
									<td> Kasir</td>
									<td> Aksi</td>
								</tr>
							</thead>
							<tbody>
								<?php $total_bayar = 0; $no = 1; $hasil_penjualan = $lihat->penjualan(); ?>
								<?php foreach ($hasil_penjualan as $isi) { ?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $isi['nama_barang']; ?></td>
										<td>
											<!-- Aksi ke table penjualan -->
											<form method="POST" action="fungsi/edit/edit.php?jual=jual" id="form-<?php echo $isi['id_penjualan']; ?>">
												<input 
													type="number" 
													name="jumlah" 
													value="<?php echo $isi['jumlah']; ?>" 
													class="form-control jumlah-input" 
													data-id="<?php echo $isi['id_penjualan']; ?>" 
													onchange="autoSubmit('<?php echo $isi['id_penjualan']; ?>')"
												>
												<input type="hidden" name="id" value="<?php echo $isi['id_penjualan']; ?>" class="form-control">
												<input type="hidden" name="id_barang" value="<?php echo $isi['kode_barang']; ?>" class="form-control">
											</form>
										</td>
										<td>Rp.<?php echo number_format($isi['total']); ?>,-</td>
										<td><?php echo $isi['nm_member']; ?></td>
										<td>
											<!-- <button type="submit" class="btn btn-warning" form="form-<?php echo $isi['id_penjualan']; ?>">Update</button> -->
											<a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_penjualan']; ?>&brg=<?php echo $isi['kode_barang']; ?>&jml=<?php echo $isi['jumlah']; ?>" class="btn btn-danger">
												<i class="fa fa-times"></i>
											</a>
										</td>
									</tr>
									<?php $no++; $total_bayar += $isi['total']; ?>
								<?php } ?>
							</tbody>

					</table>
					<br/>
					<?php $hasil = $lihat -> jumlah(); ?>
					<div id="kasirnya">
						<table class="table table-stripped">
							<?php

								
								function getTransaksiKode($n=10) {
									$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$randomString = '';

									for ($i = 0; $i < $n; $i++) {
										$index = random_int(0, strlen($characters) - 1);
										$randomString .= $characters[$index];
									}

									return $randomString;
								}

								
							// proses bayar dan ke nota
							$nota = isset($_GET['nota']) ? $_GET['nota'] : '';
							$bayar = isset($_POST['bayar']) ? $_POST['bayar'] : '';
							$total = isset($_POST['total']) ? $_POST['total'] : '';
							$hitung = 0;

							if(!empty($nota == 'yes')) {
								$id_pelanggan = $_POST['id_pelanggan'];
								// echo "id_pelanggan = ".$id_pelanggan;
								$lanjut = false;
								if($id_pelanggan == "")
								{
									echo "<script>
										alert('ID Pelanggan Kosong, Silahkan Pilih terlebih dahulu');
										var element = document.getElementById('id_pelanggan');
										element.focus();
										element.classList.add('blink'); // Tambahkan kelas 'blink'
										
										// Hapus kelas 'blink' setelah 2 detik
										setTimeout(function() {
											element.classList.remove('blink');
										}, 2000);
										</script>
										";
								} 
								else {
									$lanjut = true;
								}

								if(!empty($bayar) and $lanjut == true)
								{
									$hitung = $bayar - $total;
									if($bayar >= $total)
									{
										$id_barang = $_POST['id_barang'];
										$id_member = $_POST['id_member'];
										$jumlah = $_POST['jumlah'];
										$total = $_POST['total1'];
										$tgl_input = $_POST['tgl_input'];
										$periode = $_POST['periode'];
										$jumlah_dipilih = count($id_barang);
										
										$total_transaksi = 0;
										for($x=0;$x<$jumlah_dipilih;$x++){
											$total_transaksi += $total[$x];
										}

										$tanggal_input_transaksi = date('Y-m-d H:i:s');
										
										$kode_transaksi = getTransaksiKode();
										$d = array($id_pelanggan, $total_transaksi, $kode_transaksi, $tanggal_input_transaksi);
										$sql = "INSERT INTO transaksi (id_pelanggan, total_transaksi, kode_transaksi, tanggal_input) VALUES(?,?,?,?)";
										$row = $config->prepare($sql);
										$row->execute($d);
										// Ambil ID dari hasil insert
										$id_transaksi = $config->lastInsertId();
										
										for($x=0;$x<$jumlah_dipilih;$x++){

											$d = array($id_barang[$x], $id_transaksi, $id_member[$x], $jumlah[$x], $total[$x], $tgl_input[$x], $periode[$x]);
											$sql = "INSERT INTO nota (id_barang, id_transaksi, id_member, jumlah, total, tanggal_input, periode) VALUES(?,?,?,?,?,?,?)";
											$row = $config->prepare($sql);
											$row->execute($d);

											// ubah stok barang
											$sql_barang = "SELECT * FROM barang WHERE kode_barang = ?";
											$row_barang = $config->prepare($sql_barang);
											$row_barang->execute(array($id_barang[$x]));
											$hsl = $row_barang->fetch();
											
											$stok = $hsl['stok'];
											$idb  = $hsl['kode_barang'];

											$total_stok = $stok - $jumlah[$x];
											// echo $total_stok;
											$sql_stok = "UPDATE barang SET stok = ? WHERE kode_barang = ?";
											$row_stok = $config->prepare($sql_stok);
											$row_stok->execute(array($total_stok, $idb));
										}

										$sql = 'DELETE FROM penjualan';
										$row = $config -> prepare($sql);
										$row -> execute();

										echo '<script>
											alert("Belanjaan Berhasil Di Bayar !");
										</script>';

									}else{
										echo '<script>alert("Uang Kurang ! Rp.'.$hitung.'");</script>';
									}
								}
							}
							?>
							<!-- aksi ke table nota -->
							<form method="POST" id="formTransaksi" action="index.php?page=jual&nota=yes#kasirnya">
								<?php foreach($hasil_penjualan as $isi){;?>
									<input type="hidden" name="id_pelanggan" id="hidden_id_pelanggan" value="<?php echo $id_pelanggan;?>">
									<input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang'];?>">
									<input type="hidden" name="id_member[]" value="<?php echo $isi['id_member'];?>">
									<input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah'];?>">
									<input type="hidden" name="total1[]" value="<?php echo $isi['total'];?>">
									<input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input'];?>">
									<input type="hidden" name="periode[]" value="<?php echo date('m-Y');?>">
								<?php $no++; }?>
								<tr>
									<td>Total Semua  </td>
									<td><input type="text" class="form-control" name="total" value="<?php echo $total_bayar;?>"></td>
								
									<td>Bayar  </td>
									<td><input type="text" class="form-control" name="bayar" value="<?php echo $bayar;?>"></td>
									<td><button class="btn btn-success"><i class="fa fa-shopping-cart"></i> Bayar</button>
									<?php  if(!empty($nota == 'yes')) {?>
										<a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual">
										<b>RESET</b></a></td><?php }?></td>
								</tr>
							</form>
							<!-- aksi ke table nota -->
							<tr>
								<td>Kembali</td>
								<td><input type="text" class="form-control" value="<?php echo $hitung;?>"></td>
								
								<td>
									<a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member'];?>
									&bayar=<?php echo $bayar;?>&kembali=<?php echo $hitung;?>" target="_blank">
									<button class="btn btn-secondary">
										<i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
									</button></a>
								</td>
							</tr>
						</table>
						<br/>
						<br/>
					</div>
				</div>
			</div>
		</div>
	</div>
	

<script>
    // Set event listener pada input text
    document.getElementById('id_pelanggan').addEventListener('input', function () {
        // Ambil nilai dari input text
        var idPelanggan = this.value;

        // Masukkan nilai ke input hidden di dalam form
        document.getElementById('hidden_id_pelanggan').value = idPelanggan;
    });
</script>

<script>
    // Fungsi untuk submit form secara otomatis
    function autoSubmit(id) {
        const form = document.getElementById(`form-${id}`);
        if (form) {
            form.submit(); // Submit form
        }
    }
</script>
<script>
$(document).ready(function(){
    console.log("Document ready...");

    $("#cari").keypress(function(event){
        console.log("Key pressed: " + event.which);
        if(event.which == 13) { // Jika tombol ENTER ditekan
            console.log("Enter key detected.");
            event.preventDefault();
            let keyword = $(this).val().trim();

            if(keyword !== "") {
                console.log("Input value: " + keyword);

                $.ajax({
                    type: "POST",
                    url: "fungsi/edit/edit.php?cari_barang=yes",
                    data: { keyword: keyword },
                    beforeSend: function(){
                        console.log("AJAX request sent.");
                        $("#hasil_cari").hide();
                        $("#tunggu").html('<p style="color:green"><blink>tunggu sebentar...</blink></p>');
                    },
                    success: function(response){
                        console.log("AJAX response received.");
                        $("#tunggu").html('');
                        $("#hasil_cari").show().html(response);
                    },
                    error: function(xhr, status, error){
                        console.error("AJAX Error: " + status + " - " + error);
                    }
                });
            } else {
                console.log("Input kosong.");
                alert("Silakan masukkan kode atau nama barang!");
            }
        }
    });
});

</script>