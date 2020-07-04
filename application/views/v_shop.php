<div class="container">
<div class="row find-product">

<div class="col-xl-7">
<form action="<?php echo base_url() ?>index.php/Shop/search_product" method="POST">
<input type="text" class="form-control" placeholder="Cari" name="search">
</div>
<div class="col-xl-2">
<input type="text" class="form-control" name="hmin" id="" placeholder="Harga Minimum">
</div>
<div class="col-xl-2">
<input type="text" class="form-control" name="hmax" id="" placeholder="Harga Maksimum">
</div>
<div class="col-xl-1">
<input type="submit" name="simpan" value="Cari"class="btn btn-success">
</div>
</form>
</div>


<div class="row" style="margin-bottom:20px">
<?php foreach($produk as $isi):?>

        <div class="col-xl-4">
            <div class="card">
            <img src="<?php echo base_url('assets/images/products-img/'.$isi->gambar_produk);?>" alt="..." class="card-img-top">
                <div class="card-body">
                    <h1 class="card-title"><?php echo $isi->nama_produk ?></h1>
                    <h3 class="card-subtitle mb-2 text-muted"><?php echo $isi->nama_user?></h3>
                    <p class="card-text">
                        Harga : <?php echo $isi->harga?> <br>
                        Stok  : <?php echo $isi->stok?>
                    </p>
                </div>
                <div class="text-center btn-action">
                <a href="#modalbeli" onclick="tm_detail('<?php echo ($isi->id_produk)?>')" data-toggle="modal" class="btn btn-beli">Add To Cart</a>    
                </div>       
            </div>
        </div>

<?php endforeach; ?>
</div>

<div id="modalbeli" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add To Cart</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="perhitungan">
            <form action="<?php echo base_url('index.php/Shop/add_to_cart')?>" method="post">

            <input type="hidden" id="id_produk" name="id_produk"> 

            <input type="hidden" id="id_penjual" name="id_penjual">
            <p>
            <input type="hidden" name="harga" id="harga">
            </p>

            <p>
            Jumlah <br>
            <input type="number" name="jumlah" id="jumlah" value="1" min="1" autofocus class="form-control">
            </p>

            <p>
            Total <br>
            <input type="text" name="total" id="total" class="form-control">
            </p>

        </div>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type ="text/javascript">
            $(".perhitungan").keyup(function(){
                var harga = parseInt($("#harga").val())
                var jumlah = parseInt($("#jumlah").val())
                
                var total = harga * jumlah;
                $("#total").attr("value",total)
                
                });
        </script>
        
      </div>
      <div class="modal-footer">
      <input type="submit" class="btn btn-primary" value="Tambahkan">
      </div>
      </form>
    </div>

  </div>
</div>
</div>
<script>
            function tm_detail(id_produk) {
                $.getJSON("<?=base_url()?>index.php/Produk/get_detail_produk/"+id_produk,function(data){
                console.log(data);
                $("#id_penjual").val(data['id_penjual']);
                $("#id_produk").val(data['id_produk']);
                $("#harga").val(data['harga']);
                $("#stok").val(data['stok']);
                });
            }
            </script>