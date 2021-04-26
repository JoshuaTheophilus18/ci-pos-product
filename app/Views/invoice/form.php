<?php
// set title
$this->setVar('headerTitle', $headerTitle);

echo $this->extend('Views\layout');
echo $this->section('content');

?>

<div class="row">
    <div class="col">
        <h1 class="mt-2"><?php echo esc($headerTitle) ?></h1>
        <?php 
            echo form_open('invoice/add')
        ?>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="date">Tanggal Transaksi (<span class="text-danger">*</span>)</label>
                    <input type="date" name="transaction_date" id="transaction_date" class="form-control" required>
                    <small class="form-text text-danger"> <?= $validation->getError('transaction_date'); ?></small>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="date">Catatan</label>
                    <textarea name="note" id="note" cols="5" rows="5" class="form-control"></textarea>
                    <small class="form-text text-danger"> <?= $validation->getError('note'); ?></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col"><h3>Detail Barang</h3></div>
                        <div class="col">
                            <button type="button" name="add_data" id="add_data" class="btn btn-sm btn-primary" style="float: right;">Tambah Barang</button>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <table class="table table-hover tabel-striped table-bordered" id="data_table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= form_submit('Save', 'Save', ['class' => 'btn btn-md btn-info']); ?>
            <?= anchor('invoice', 'Back', ['class' => 'btn btn-md btn-danger']); ?>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<?php
echo $this->endSection();
?>

<?= $this->section('js'); ?>
<script type="text/javascript">
$(function() {

    $(document).on('click', '.remove-item', function () {
        var thisObject = $(this);
        if (thisObject.closest('tbody').find('.remove-item').length > 0){            
            thisObject.closest('tr').remove(); 
        }
    });

    $('#add_data').click(function() {
        //Append data table
        $('#data_table tbody:last-child').append(
            '<tr>'+
                '<td><input type="text" class="form-control input-sm" name="item[product_name][]" required></td>'+
                '<td><input type="number" class="form-control input-sm" name="item[qty][]" min="0" value="0" required></td>'+
                '<td><input type="number" class="form-control input-sm" name="item[price][]" min="0" value="0" required></td>'+
                '<td><input type="number" class="form-control input-sm" name="item[discount][]" min="0" value="0"></td>'+
                '<td><button type="button" class="btn btn-danger remove-item">Hapus Barang</button></td>'+
            '</tr>'
        );
    });
    
});
</script>
<?= $this->endSection(); ?>