<div class="container">
    <br>
    <h1>Masukkan Detail Transaksi</h1>
    <form action="<?php echo base_url()?>index.php/Shop/checkout" method="post">
        
        <p>
        <label for="">Pilih Bank</label>
        <select class="form-control" name="id_bank" style="width:100%;" required>
                        <option value="" disabled selected>-- Pilih Bank --</option>
                        <?php                                
                            foreach ($dropdown_bank as $row) {  
		                    echo "<option value='".$row->id_bank."'>".$row->nama_bank." - ".$row->no_rekening."</option>";
		                }
                    echo"</select>"?>
        </p>

        <p>
        Alamat Pengiriman
        <input type="text"class="form-control" placeholder="ex: Jl. Danau Yamur Kav 22" name="alamat" required>
        </p>

        <br>
        <input type="submit" class="btn btn-block btn-success" value="Checkout">
                
    </form>
    <br>
</div>