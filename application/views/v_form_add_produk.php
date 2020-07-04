<div class="container">
    <br>
    <h1>Tambahkan Produk Jualan Anda</h1>
    <form action="<?php echo base_url()?>index.php/Produk/add_produk" method="post" enctype="multipart/form-data">
        <p>
        <label for="">Nama Produk</label>
        <input type="text" placeholder="Nama Produk" class="form-control" name="nama_produk">
        </p>

        <p>
        <label for="">Gambar Produk</label>
        <input type="file" name="gambar" class="form-control" required>
        </p>

        <p>
        <label for="">Harga</label>
        <input type="number" name="harga" class="form-control" required>
        </p>

        <p>
        <label for="">Stok</label>
        <input type="number" name="stok" class="form-control" required>
        </p>
        <br>
        <input type="submit" class="btn btn-block btn-primary" value="Tambahkan">

    </form>
</div>