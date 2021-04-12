<?php
// set title
$this->setVar('headerTitle', $headerTitle);

// extends layout
echo $this->extend('Views\layout');
echo $this->section('content');
?>

<div class="container">
    <h1 class="mt-2"> <?php echo esc($headerTitle); ?></h1>
    <p>
        <?php echo anchor('products/add', 'Tambah Barang', ['class' => 'btn btn-sm btn-success']); ?>
    </p>
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
                                <td style="text-align: center;"><?= $no++ ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td><?= $item['purchase_price'] ?></td>
                                <td><?= $item['selling_price'] ?></td>
                                <td><?= $item['description'] ?></td>
                                <td style="text-align: center;">
                                    <?php echo anchor(sprintf('products/edit/%d', $item['id']), 'Ubah', ['class' => 'btn btn-sm btn-success']); ?>
                                    <?php echo anchor(sprintf('products/delete/%d', $item['id']), 'Hapus', ['onclick' => 'return confirm(\'Apakah yakin ingin menghapus barang?\')', 'class' => 'btn btn-sm btn-danger']); ?>
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
        </div>
    </div>
</div>

<?php
echo $this->endSection();
?>