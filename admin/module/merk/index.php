<h4>Data Merk Barang</h4>
        <br />
        <?php if(isset($_GET['success'])){?>
        <div class="alert alert-success">
            <p>Data Merk Berhasil Ditambahkan !</p>
        </div>
        <?php }?>
        <?php if(isset($_GET['remove'])){?>
        <div class="alert alert-danger">
            <p>Data Berhasil Dihapus !</p>
        </div>
        <?php }?>

		<!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Insert Data</button>
        <a href="index.php?page=merk" class="btn btn-primary btn-md mr-2">
            <i class="fa fa-refresh"></i> Refresh Data</a>
        <div class="clearfix"></div>
        <br />
        <!-- view merk -->
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="example1">
                    <thead>
                        <tr style="background:#DFF0D8;color:#333;">
                            <th>No.</th>
                            <th>Kode Merk</th>
                            <th>Nama Merk</th>
							<th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php 
							$data_merk = $lihat->merk(); 
							$no = 1;
								foreach ($data_merk as $isi) {
						?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $isi['kode_merk']; ?></td>
									<td><?php echo $isi['nama_merk']; ?></td>
									<td>																	
										<a href="index.php?page=merk/details&merk=<?php echo $isi['id'];?>"><button
												class="btn btn-primary btn-xs">View</button></a>
										<a href="index.php?page=merk/edit&merk=<?php echo $isi['id'];?>"><button
												class="btn btn-warning btn-xs">Edit</button></a>
										<a href="fungsi/hapus/hapus.php?merk=hapus&id=<?php echo $isi['id'];?>"
											onclick="javascript:return confirm('Hapus Data Merk ?');"><button
												class="btn btn-danger btn-xs">Hapus</button></a>
									</td>
								</tr>
							<?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end view merk -->


		
        <!-- tambah merk MODALS-->
        <!-- Modal -->

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style=" border-radius:0px;">
                    <div class="modal-header" style="background:#285c64;color:#fff;">
                        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Merk</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="fungsi/tambah/tambah.php?merk=tambah" method="POST">
                        <div class="modal-body">
                           
                            <table class="table table-striped bordered">
                                <?php
									$format = $lihat -> merk_id();
								?>
                                <tr>
                                    <td>ID Barang</td>
                                    <td><input type="text" readonly="readonly" required value="<?php echo $format;?>"
                                            class="form-control" name="kode_merk"></td>
                                </tr>
                                <tr>
                                    <td>Nama Merk</td>
                                    <td><input type="text" placeholder="Nama Merk" class="form-control" name="nama_merk" required></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Input</td>
                                    <td><input type="text" readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl" required></td>
                                </tr>
                                <br>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                                Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>