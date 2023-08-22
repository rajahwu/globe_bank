<?php

require_once('../../../private/initialize.php');


if (is_post_request()) {
  $page['position'] = $_POST["position"];
  $page['menu_name'] = $_POST["menu_name"];
  $page['visible'] = $_POST["visible"];
  $page['subject_id'] = $_POST["subject_id"];
  $page['content'] = $_POST["content"];

  $result = insert_page($page);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
 
} else {
  $subject_set = find_all_subjects();
  
  $page = [];
  $page['menu_name'] = '';
  $page['visible'] = '';
  $page['subject_id'] = '';
  $page['content'] = '';
  
    $page_set = find_all_pages();
    $pages_count = mysqli_num_rows($page_set) + 1;
    mysqli_free_result($page_set);
    $page['position'] = $pages_count;
}

?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page new">
    <h1>Create Page</h1>

    <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']) ?>" /></dd>
      </dl>
      <dl>
        <dl>
          <dt>Subject</dt>
          <dd>
            <select name="subject_id">
              <?php 
              while($subject = $subjects = mysqli_fetch_assoc($subject_set)) {
                echo "<option value=\"" . h($subject['id']) . "\"";
                if($page["subject_id"] == $subject['id']) {
                  echo " selected";
                }
                echo ">". h($subject['menu_name']) . "</option>";
              }
              ?>
            </select>
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
            <textarea name="content" cols="30" rows="10"</textarea>
          </textarea>
          </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>