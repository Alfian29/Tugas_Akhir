<div class="container find-product">
<div class="row">
    <?php foreach($products as $isi):?>
        
        <div class="col-xl-4">
            <div class="card">
            <img src="<?= base_url('assets/images/products-img/'.$isi->gambar_produk);?>" alt="..." class="card-img-top">
                <div class="card-body">
                    <h1 class="card-title"><?php echo $isi->nama_produk ?></h1>
                    <h3 class="card-subtitle mb-2 text-muted"><?php echo $isi->nama_user?></h3>
                    <p class="card-text">
                        Harga : <?php echo $isi->harga?> <br>
                        Stok  : <?php echo $isi->stok?>
                    </p>
                </div>
                <div class="text-center btn-action">
                <a href="" class="btn btn-beli">Beli</a>    
                </div>       
            </div>
        </div>
    <?php endforeach; ?>

    
    </div> 
</div>