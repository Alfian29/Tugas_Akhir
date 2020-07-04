<div class="container">
<?php if($this->session->flashdata('pesan')!=null): ?>
                    <div class= "alert alert-success alert-dismissible fade show" role="alert"><?= $this->session->flashdata('pesan');?> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>
                <?php endif?>
                <?php if($this->session->flashdata('gagal')!=null): ?>
                    <div class= "alert alert-danger alert-dismissible fade show" role="alert"><?= $this->session->flashdata('gagal');?> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>
                <?php endif?>
<h2 class="display-4 title-page">Produk Anda </h2>
<hr class="style1">
<a href="<?php echo base_url()?>index.php/Produk/form_add_produk" class="btn btn-dark">Tambah</a>
    <div class="row" style="margin-top:20px;">
        <?php foreach($list as $isi):?>
        <div class="col-xl-4">
            <div class="card">
            <img src="<?php echo base_url('assets/images/products-img/'.$isi->gambar_produk);?>" alt="..." class="card-img-top">
                <div class="card-body">
                    <h1 class="card-title"><?php echo $isi->nama_produk ?></h1>
                    <p class="card-text">
                        Harga : <?php echo $isi->harga?> <br>
                        Stok  : <?php echo $isi->stok?>
                    </p>
                </div>
                <div class="card-footer">
                <div class="btn-prod">
                        <a href="#edit" onclick="tm_detail('<?php echo ($isi->id_produk)?>')"  data-toggle="modal"> <i class="fas fa-edit"></i></a> 
                        <a href="<?php echo base_url().'index.php/Produk/hapus_produk/'.$isi->id_produk?>" onclick="return confirm('Anda yakin akan menghapus acara ini?');"> <i class="fas fa-trash-alt"></i> </a>
                </div>
                </div>
            </div>
        </div>
            <?php endforeach; ?>
    </div>
</div>
<div class="modal fade" id="edit" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Produk</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('index.php/Produk/update_produk')?>" method="post">
                                <input type="hidden" id="id_produk" name="id_produk"> 
                                
                                Nama Produk
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk">
                                
                                Gambar Produk
                                <input type="file" class="form-control" name="gambar_produk" id="gambar_produk">
                                
                                Harga
                                <input type="number" class="form-control" name="harga" id="harga">

                                Stok
                                <input type="number" class="form-control" name="stok" id="stok" min="0">

                                <div class="modal-footer">
                                    <a href=""><input type="submit" name="simpan" value="Simpan" class="btn btn-primary"></a>
                                </div>
                            </form>
                            <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>

            <script>
            function tm_detail(id_produk) {
                $.getJSON("<?=base_url()?>index.php/Produk/get_detail_produk/"+id_produk,function(data){
                console.log(data);
                $("#id_produk").val(data['id_produk']);
                $("#nama_produk").val(data['nama_produk']);
                $("#gambar").val(data['gambar']);
                $("#harga").val(data['harga']);
                $("#stok").val(data['stok']);
                });
            }
            </script>