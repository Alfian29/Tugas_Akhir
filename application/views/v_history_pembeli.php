<div class="container">
<h2 class="display-4 title-page">Riwayat Anda </h2>
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
                    <?php }elseif($isi->status=="Sedang Diantar"){ ?>
                        <a href="<?php echo base_url().'index.php/Shop/status_selesai/'.$isi->id_transaksi?>" class="btn btn-success"><?php echo $isi->status?></a>
                    <?php }elseif($isi->status=="Pesanan Diterima"){ ?>
                        <a href="" class="btn btn-success"><?php echo $isi->status?></a>
                    <?php }?>
                    </td>
					
				</tr>
				

<?php endforeach; ?>
</tbody>
        </table>
 </div>
</div>
