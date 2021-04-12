<form  action="<?php echo base_url('/products')?>" action="GET">
    <div class="mb-3">
    <label for="search">Cari Barang : </label>
    <input type="text" class="form-control" name="search" aria-describedby="search">
    </div>
    <button type="submit" class="btn btn-primary" value="Cari">Search</button>
    <a href="<?= base_url("/products") ?>" class="btn btn-danger">Cancel</a>
</form>