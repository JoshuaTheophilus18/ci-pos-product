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
             
        if (isset($product)) {
            echo form_open(sprintf('products/edit/%d', $product['id']));
            echo form_hidden('id', set_value('id', $product['id']));
        } else {
            echo form_open('products/add');
        }
        
        ?>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <?= form_label('Nama Barang', 'name') ?> (<span class="text-danger">*</span>)
                    <?= form_input('name', set_value('name', isset($product) ? $product['name'] : ""), ['class' => 'form-control']); ?>
                    <small class="form-text text-danger"> <?= $errors['name'] ?? ''; ?></small>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <?= form_label('Jumlah Barang', 'qty') ?> (<span class="text-danger">*</span>)
                    <?= form_input('qty', set_value('qty', isset($product) ? $product['qty'] : ""), ['class' => 'form-control'], 'number'); ?>
                    <small class="form-text text-danger"> <?= $errors['qty'] ?? ''; ?></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <?= form_label('Harga Beli', 'purchase_price') ?> (<span class="text-danger">*</span>)
                    <?= form_input('purchase_price', set_value('purchase_price', isset($product) ? $product['purchase_price'] : ""), ['class' => 'form-control'], 'number'); ?>
                    <small class="form-text text-danger"> <?= $errors['purchase_price'] ?? ''; ?></small>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <?= form_label('Harga Jual', 'selling_price') ?> (<span class="text-danger">*</span>)
                    <?= form_input('selling_price', set_value('selling_price', isset($product) ? $product['selling_price'] : ""), ['class' => 'form-control'], 'number'); ?>
                    <small class="form-text text-danger"> <?= $errors['selling_price'] ?? ''; ?></small>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= form_label('Deskripsi Barang', 'description'); ?>
            <?= form_textarea('description', set_value('description', isset($product) ? $product['description'] : ""), ['class' => 'form-control']); ?>
            <small class="form-text text-danger"> <?= $errors['description'] ?? ''; ?></small>
        </div>
        <div class="form-group">
            <?= form_submit('Save', 'Save', ['class' => 'btn btn-sm btn-info']); ?>
            <?= anchor('products', 'Back', ['class' => 'btn btn-sm btn-danger']); ?>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<?php
// end section content
echo $this->endSection();
?>