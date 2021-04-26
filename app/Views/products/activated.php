<?php
// set title
$this->setVar('headerTitle', $headerTitle);

// extends layout
echo $this->extend('Views\layout');
echo $this->section('content');
?>

<div class="container">
    <h1 class="mt-2"> <?php echo esc($headerTitle); ?></h1>
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
                                    <?php echo anchor(sprintf('products/activate/%d', $item->id), 'Aktifkan', ['onclick' => 'return confirm(\'Apakah yakin ingin mengaktifkan barang?\')', 'class' => 'btn btn-sm btn-success']); ?>
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
            <?= $pager->links("activate", "bootstrap_pagination") ?>
        </div>
    </div>
</div>

<?php
echo $this->endSection();
?>