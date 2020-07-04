<div class="container">
<h2 class="display-4 title-page">Aktivitas Anda </h2>
<hr class="style1">
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
<div style="overflow-x:auto">
<table class="table table-hover" id="LaporanTabel" style="width:100%;">
			    <thead>
					<tr> 
                        <th>No</th>
						<th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>No. Resi</th>
                        <th>Status</th>
					</tr>
				</thead>
				<tbody>
        <?php $no=1; ?>
				<?php 
                foreach ($activities as $isi) : ?>
				<tr>
					<td>
						<?= $no++ ?>
					</td>
					<td>
                        <?php echo $isi->id_transaksi?>
                    </td>
                    <td>
                        <?php echo $isi->tgl_transaksi?>
                    </td>
                    <td>
                        Rp. <?php echo $isi->total_harga?>
                    </td>
                    <td>
                        <?php echo $isi->no_resi?>
                    </td>
                    <td>
                    <?php if($isi->status=="Menunggu Pembayaran"){?>
                        <a href="#modal_bukti<?php echo $isi->id_transaksi?>" onclick="tm_detail('<?php echo ($isi->id_transaksi)?>')" data-toggle="modal" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Upload bukti pembayaran disini"><?php echo $isi->status?></a>
                    <?php }elseif($isi->status=="Sedang Dikemas"){ ?>
                        <a href="" class="btn btn-warning"><?php echo $isi->status?></a>
                    <?php }elseif($isi->status=="Sedang Diantar"){ ?>
                        <a href="<?php echo base_url().'index.php/Shop/status_selesai/'.$isi->id_transaksi?>" class="btn btn-success" onclick="return confirm('Pastikan barang diterima dengan baik');"><?php echo $isi->status?></a>
                    <?php }elseif($isi->status=="Pesanan Diterima"){ ?>
                        <a href="" class="btn btn-success"><?php echo $isi->status?></a>
                    <?php }?>
                    </td>
					
				</tr>
				
		

<div id="modal_bukti<?php echo $isi->id_transaksi?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Bukti Pembayaran</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Mohon transfer ke <?php echo $isi->nama_bank?> no rekening <?php echo $isi->no_rekening?>
        <form action="<?php echo base_url('index.php/Shop/upload_bukti')?>" method="post" enctype="multipart/form-data">
        <input type="hidden" id="id_transaksi" name="id_transaksi" value="<?php echo $isi->id_transaksi?>">
        <input type="file" name="foto_bukti" class="form-control" required>
      </div>
      <div class="modal-footer">
        <input type="submit" value="Upload" class="btn btn-success">
        </form>
      </div>
    </div>

  </div>
</div>
<?php endforeach; ?>
</tbody>
        </table>
        </div>
</div>
<script>
function tm_detail(id_transaksi) {
$.getJSON("<?=base_url()?>index.php/Shop/get_detail_transaksi/"+id_transaksi,function(data){
console.log(data);
$("#id_transaksi").val(data['id_transaksi']);
$("#total_harga").val(data['total_harga']);
$("#nama_bank").val(data['nama_bank']);
$("#no_rekening").val(data['no_rekening']);
});
}
</script>
