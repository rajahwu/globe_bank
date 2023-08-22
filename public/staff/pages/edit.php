<?php

require_once('../../../private/initialize.php');


if (!isset($_GET['id'])) {
  redirect_to('/staff/pages/index.php');
}
$id = $_GET['id'];

$page = find_page_by_id($id);
$subject_set = find_all_subjects();
$page_set = find_all_pages();
$pages_count = mysqli_num_rows($page_set) + 1;



if (is_post_request()) {
  $page['menu_name'] = $_POST["menu_name"];
  $page['position'] = $_POST["position"];
  $page['visible'] = $_POST["visible"];
  $page['subject_id'] = $_POST["subject_id"];
  $page['content'] = $_POST["content"] ?? $page['content'];

  $results = update_page($page);
  redirect_to(url_for("/staff/pages/show.php?id=" . $id));
}

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page new">
    <h1>Edit Page</h1>

    <form action="<?php echo url_for('/staff/pages/edit.php?id=') . h(u($id)); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']) ?>" /></dd>
      </dl>
      <dl>
          <dt>Subject</dt>
          <dd>
            <select name="subject_id">
              <?php 
              while($subject = $subjects = mysqli_fetch_assoc($subject_set)) {
                echo "<option value=" . $subject['id']; 

                if($subject['id'] == $page['subject_id']) {
                  echo " selected";
                }
                echo ">". $subject['menu_name'] ."</option>";
              }
              ?>
            </select>
            <?php mysqli_free_result($subject_set) ?>
          </dd>
        </dl>
        <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
          <?php
            for ($i = 1; $i <= $pages_count; $i++) {
              echo "<option value=\"{$i}\"";
              if ($page["position"] == $i) {
                echo " selected";
              }
              echo ">{$i}</option>";
            }
            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if ($page['visible'] == "1") {
            echo " checked";
          } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
          <dd>
            <textarea name="content" cols="30" rows="10"><?php echo $page['content'] ?></textarea>
          </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>