<?php include_once('../../../private/initialize.php') ?>


<?php
$id = $_GET['id'] ?? 1;
$page_title = "Page" . " " . h($id);

?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<?php
echo h($id);
?>

<?php include(SHARED_PATH . "/staff_footer.php"); ?>