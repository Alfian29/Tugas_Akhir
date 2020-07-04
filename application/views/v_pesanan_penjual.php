<div class="container">
<h2 class="display-4 title-page">Pesanan Untuk Anda </h2>
<hr class="style1">
<div style="overflow-x:auto">
<table class="table table-hover" id="LaporanTabel" style="width:100%;">
			    <thead>
					<tr> 
                        <th>No</th>
						<th>ID Transaksi</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>No. Resi</th>
                        <th>Status</th>
					</tr>
				</thead>
				<tbody>
        <?php $no=1; ?>
				<?php 
                foreach ($pesanan as $isi) : ?>
				<tr>
					<td>
						<?= $no++ ?>
					</td>
					<td>
						<?php echo $isi->id_transaksi ?>
					</td>
                    <td>
                        <?php echo $isi->nama_user?>                    
                    </td>
                    <td>
						<?php echo $isi->tgl_transaksi ?>
					</td>
                    <td>
						<?php echo $isi->total_harga ?>
					</td>
                    <td>
                        <?php echo $isi->no_resi?>                    
                    </td>
                    <td>
                    <?php if($isi->status=="Sedang Dikemas"){?>
                        <a href="#modal_resi" onclick="tm_detail('<?php echo ($isi->id_transaksi)?>')" data-toggle="modal" class="btn btn-warning"><?php echo $isi->status?></a>
                    <?php } elseif($isi->status="Sedang Diantar"){?>
                        <a href="" onclick="" class="btn btn-success"><?php echo $isi->status?></a>
                    <?php }?>
					</td>
					
				</tr>
				<?php endforeach; ?>
			</tbody>
        </table>
</div>
</div>
<div id="modal_resi" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Masukkan no. resi</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('index.php/Shop/status_diantar')?>" method="post">
        
        <input type="hidden" id="id_transaksi" name="id_transaksi"> <br>
        
        <input type="number" name="no_resi" class="form-control" placeholder="No. Resi"> 

      </div>
      <div class="modal-footer">
        <input type="submit" value="Submit" class="btn btn-success">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

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