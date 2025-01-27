        <h4>Data Satuan</h4>
        <br />

        <?php if(isset($_GET['success'])){?>
        <div class="alert alert-success">
            <p>Tambah Data Berhasil !</p>
        </div>
        <?php }?>
        <?php if(isset($_GET['remove'])){?>
        <div class="alert alert-danger">
            <p>Hapus Data Berhasil !</p>
        </div>
        <?php }?>

        <!-- Trigger the modal with a button -->
        <button id = "btn_insert" type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Insert Data</button>
        <a href="index.php?page=satuan" class="btn btn-primary btn-md mr-2">
            <i class="fa fa-refresh"></i> Refresh Data</a>
        <div class="clearfix"></div>
        <br />
        <!-- view barang -->
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="example1">
                    <thead>
                        <tr style="background:#DFF0D8;color:#333;">
                            <th>No.</th>
                            <th>Kode Satuan</th>
                            <th>Nama Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
						$hasil = $lihat->satuan();
						$no=1;
						foreach($hasil as $isi) {
					?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $isi['kode_satuan'];?></td>
                            <td><?php echo $isi['nama_satuan'];?></td>
                        
                            <td>
                                <a href="index.php?page=satuan/details&satuan=<?php echo $isi['id'];?>">
                                    <button class="btn btn-primary btn-xs">View</button>
                                </a>

                                <a href="index.php?page=satuan/edit&satuan=<?php echo $isi['id'];?>">
                                    <button class="btn btn-warning btn-xs">Edit</button>
                                </a>
                                <a href="fungsi/hapus/hapus.php?satuan=hapus&id=<?php echo $isi['id'];?>"
                                    onclick="javascript:return confirm('Hapus Data Satuan ?');">
                                    <button class="btn btn-danger btn-xs">Hapus</button>
                                </a>
                        
                        </tr>
                        <?php 
							$no++; 
						}
					?>
                    </tbody>
                  
                </table>
            </div>
        </div>
        <!-- end view barang -->
        <!-- tambah barang MODALS-->
        <!-- Modal -->

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style=" border-radius:0px;">
                    <div class="modal-header" style="background:#285c64;color:#fff;">
                        <h5 class="modal-title"><i class="fa fa-plus"></i>Tambah Satuan</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="fungsi/tambah/tambah.php?satuan=tambah" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <table class="table table-striped bordered">
                                <tr>
                                    <td>Kode Satuan</td>
                                    <td><input type="text"  class="form-control" name="kode_satuan" required></td>
                                </tr>
                                <tr>
                                    <td>Nama Satuan</td>
                                    <td><input type="text"  class="form-control" name="nama_satuan" required></td>
                                </tr>
                               
                                <tr>
                                    <td>Tanggal Input</td>
                                    <td><input type="text" required readonly="readonly" class="form-control"
                                            value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
                                </tr>
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

    <script>
    $(document).ready(function(){
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('openModal') === 'true') {
            $('#myModal').modal('show');
        }
    });
    </script>
