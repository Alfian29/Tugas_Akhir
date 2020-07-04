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
<h2 class="display-4 title-page">Isi Keranjang Anda </h2>
<hr class="style1">

<table class="table table-hover" id="LaporanTabel" style="width:100%;">
			    <thead>
					<tr> 
                        <th>No</th>
						            <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th></th>
					</tr>
				</thead>
				<tbody>
        <?php $no=1; ?>
				<?php 
                foreach ($isi_keranjang as $isi) : ?>
				<tr>
					<td>
						<?= $no++ ?>
					</td>
					<td>
                        <img src="<?php echo base_url('assets/images/products-img/'.$isi->gambar_produk);?>" style="width:100px; height:100px" alt="">
                        <?php echo $isi->nama_produk?>
                    </td>
                    <td>
                        <?php echo $isi->qty?>
                    </td>
                    <td>
                        Rp. <?php echo $isi->total_harga?>
                    </td>
					<td>
                    <div class="btn-group">
                    <a href="#edit_cart" data-toggle="modal" onclick="tm_detail('<?php echo ($isi->id_cart)?>')" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <a id="" href="<?php echo base_url().'index.php/Shop/hapus_isi_cart/'.$isi->id_cart ?>" onclick="return confirm('Anda yakin akan menghapus <?php echo $isi->nama_produk?> dari keranjangmu ?');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    </td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
        Total: Rp. <?php echo $sumharga?> <br>
        <a href="<?php echo base_url('index.php/Shop/form_checkout')?>" class="btn btn-primary btn-block" style="margin-bottom:20px;">Checkout</a>
</div>

<div id="edit_cart" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit isi cart</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <div class="perhitungan">
        <form action="<?php echo base_url('index.php/Shop/edit_cart')?>" method="post">
            <input type="hidden" id="id_produk" name="id_produk"> 
            
            <input type="hidden" id="id_cart" name="id_cart">

            <input type="hidden" id="id_penjual" name="id_penjual">
            <p>
            <input type="hidden" name="harga" id="harga">
            </p>

            <p>
            Jumlah <br>
            <input type="number" name="jumlah" id="jumlah" min="1" autofocus class="form-control">
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
        <input type="submit" class="btn btn-success">
      </div>
      </form>
    </div>

  </div>
</div>

<script>
function tm_detail(id_cart) {
$.getJSON("<?=base_url()?>index.php/Shop/get_detail_cart/"+id_cart,function(data){
console.log(data);
$("#id_cart").val(data['id_cart']);
$("#harga").val(data['harga']);
$("#jumlah").val(data['qty']);
// $("#total").val(data['total_harga']);
});
}
</script>
