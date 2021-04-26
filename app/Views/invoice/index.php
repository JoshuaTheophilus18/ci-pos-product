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
            <h1 class="mt-2"> List Invoice</h1>  
        </div>
        <div class="col-sm-6">
            <p style="float: right; margin-top: 25px"> 
                <?php echo anchor('invoice/add', 'Buat Invoice', ['class' => 'btn btn-sm btn-success']); ?>
            </p>
        </div>
    </div>
    <div class="row">
    
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th>Tanggal</th>
                        <th>Note</th>
                        <th>Grand Total</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($invoice) > 0) {  ?>
                        <?php $no = 1 ?>
                        <?php foreach ($invoice as $item) : ?>
                            <tr>
                                <td style="text-align: center;"><?= $nomor++ ?></td>
                                <td><?= $item->transaction_date ?></td>
                                <td><?= $item->note  ?></td>
                                <td><?= number_to_currency($item->grandtotal, 'IDR'); ?></td>
                                <td style="text-align: center;">
                                    <?php echo anchor(sprintf('invoice/edit/%d', $item->id), 'Ubah', ['class' => 'btn btn-sm btn-success']); ?>
                                    <?php echo anchor(sprintf('invoice/delete/%d', $item->id), 'Hapus', ['onclick' => 'return confirm(\'Apakah yakin ingin menghapus invoice?\')', 'class' => 'btn btn-sm btn-danger']); ?>
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
            <?= $pager->links("invoice", "bootstrap_pagination") ?>
        </div>
    </div>
</div>
<?php
echo $this->endSection();
?>
