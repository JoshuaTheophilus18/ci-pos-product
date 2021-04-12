<?php
// set title
$this->setVar('headerTitle', $headerTitle);

// extends layout
echo $this->extend('Views\layout');
echo $this->section('content');
?>

<div class="container">
    <h1 class="mt-2"> <?php echo esc($headerTitle); ?></h1>
</div>

<?php
echo $this->endSection();
?>