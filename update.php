<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $merkhp = isset($_POST['merkhp']) ? $_POST['merkhp'] : '';
        $tipehp = isset($_POST['tipehp']) ? $_POST['tipehp'] : '';
        $thnproduksi = isset($_POST['thnproduksi']) ? $_POST['thnproduksi'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE hp SET id = ?, merkhp = ?, tipehp = ?, thnproduksi = ? WHERE id = ?');
        $stmt->execute([$id, $merkhp, $tipehp, $thnproduksi, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM hp WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="merkhp">Merk Hp</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="merkhp" value="<?=$contact['merkhp']?>" id="merkhp">
        <label for="tipehp">Tipe Hp</label>
        <label for="thnproduksi">Tahun Produksi</label>
        <input type="text" name="tipehp" value="<?=$contact['tipehp']?>" id="tipehp">
        <input type="text" name="thnproduksi" value="<?=$contact['thnproduksi']?>" id="thnproduksi">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>