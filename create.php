<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != '' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $merkhp = isset($_POST['merkhp']) ? $_POST['merkhp'] : '';
    $tipehp = isset($_POST['tipehp']) ? $_POST['tipehp'] : '';
    $thnproduksi = isset($_POST['thnproduksi']) ? $_POST['thnproduksi'] : '';
    

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO hp VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $merkhp, $tipehp, $thnproduksi]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Data</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="merkhp">Merk Hp</label>
        <input type="text" name="id" value="" id="id">
        <input type="text" name="merkhp" id="merkhp">
        <label for="tipehp">Tipe Hp</label>
        <label for="thnproduksi">Tahun Produksi</label>
        <input type="text" name="tipehp" id="tipehp">
        <input type="text" name="thnproduksi" id="thnproduksi">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>