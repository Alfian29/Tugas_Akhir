<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sl-1.3.1/datatables.min.css"/>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sl-1.3.1/datatables.min.js"></script>
    
<div class="container">
<h2 class="display-4 title-page">Data Transaksi </h2>
<hr class="style1">
<div style="overflow-x:auto">
<table class="table table-hover" id="transaksi_admin" style="width:100%;">
			    <thead>
					<tr> 
                        <th>No</th>
						<th>ID Transaksi</th>
                        <th>Bukti Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>Status</th>
					</tr>
				</thead>
				<tbody>
        <?php $no=1; ?>
				<?php 
                foreach ($all_transaksi as $isi) : ?>
				<tr>
					<td>
						<?= $no++ ?>
					</td>
					<td>
						<?php echo $isi->id_transaksi ?>
					</td>
                    <td>
                    <a href="<?php echo base_url('assets/images/upload_bukti/'.$isi->foto_bukti);?>">
                    <img src="<?php echo base_url('assets/images/upload_bukti/'.$isi->foto_bukti);?>" style="width:100px; height:100px" alt="">
                    </a>
					</td>
                    <td>
						<?php echo $isi->tgl_transaksi ?>
					</td>
                    <td>
						<?php echo $isi->total_harga ?>
					</td>
                    <td>
                    <?php if($isi->status=="Menunggu Pembayaran"){?>
                        <a href="<?php echo base_url().'index.php/Shop/status_dikemas/'.$isi->id_transaksi?>" class="btn btn-warning"><?php echo $isi->status?></a>
                    <?php }else{?>
                        <a href="<?php echo base_url().'index.php/Shop/status_dikemas/'.$isi->id_transaksi?>" class="btn btn-success"><?php echo $isi->status?></a>
                    <?php } ?>
					</td>
					
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
</div>
</div>
<script>
$(document).ready(function() {
    $('#transaksi_admin').DataTable();
} );
</script>