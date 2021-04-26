<?php
// set title
$this->setVar('headerTitle', $headerTitle);

// extends layout
echo $this->extend('Views\layout');
echo $this->section('content');
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mt-2"> <?php echo esc($headerTitle); ?></h1>  
        </div>
        <div class="col-sm-6">
            <p style="float: right; margin-top: 25px"> 
                <?php echo anchor('products/add', 'Tambah Barang', ['class' => 'btn btn-sm btn-success']); ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><?= $this->include('Views\search_bar'); ?></p>
        </div>
        <div class="col-sm-6"></div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Deskripsi Barang</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($product) > 0) {  ?>
                        <?php $no = 1 ?>
                        <?php foreach ($product as $item) : ?>
                            <tr>
                                <td style="text-align: center;"><?= $nomor++ ?></td>
                                <td><?= $item->name ?></td>
                                <td><?= $item->qty ?></td>
                                <td><?= number_to_currency($item->purchase_price, 'IDR'); ?></td>
                                <td><?= number_to_currency($item->selling_price, 'IDR'); ?></td>
                                <td><?= $item->description ?></td>
                                <td style="text-align: center;">
                                    <?php echo anchor(sprintf('products/edit/%d', $item->id), 'Ubah', ['class' => 'btn btn-sm btn-success']); ?>
                                    <?php echo anchor(sprintf('products/delete/%d', $item->id), 'Hapus', ['onclick' => 'return confirm(\'Apakah yakin ingin menghapus barang?\')', 'class' => 'btn btn-sm btn-danger']); ?>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" style="text-align: center;"> Tidak ada data</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= $pager->links("product", "bootstrap_pagination") ?>
        </div>
    </div>
</div>

<?php
echo $this->endSection();

echo $this->section('js');
?>
<script type="text/javascript">
    function formatPrice(number) {
        return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
<?php
echo $this->endSection();
?>