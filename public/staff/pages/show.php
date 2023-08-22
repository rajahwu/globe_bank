<?php include_once('../../../private/initialize.php') ?>


<?php
if(!$GET['id']) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'] ?? 1;

$page = find_page_by_id($id);

if(!$page) {
    echo "no page";
}


?>


<?php
$page_title = "Show Page";
?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="page show">

        <h1>Subject:
            <?php echo h($page['menu_name']); ?>
        </h1>

        <div class="attributes">
            <dl>
                <dt>Menu Name</dt>
                <dd>
                    <?php echo h($page['menu_name']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <?php echo h($page['position']); ?>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <?php echo h($page['visible']); ?>
                </dd>
            </dl>
        </div>
    </div>
</div>


<?php include(SHARED_PATH . "/staff_footer.php"); ?>