<?php
  include "header.php";

  if ($_SESSION["logged_in"]) {
  } else {
    header ("Location: login.php");
  }

  //För att posta inlägg
  if( isset($_POST['submitpost']) || isset ($_POST['draft']) ) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categ = $_POST['category'];
    $date = date('j F Y, g:i a');
    $author = $_SESSION["id"];
    $targetFolder = "uploads/";
    

    if (isset($_POST['submitpost'])) {
      $query = "INSERT INTO posts VALUES ('', '$author', '$title', '$content', '', '$date', TRUE, '','$categ')";
    } else  {
      $query = "INSERT INTO posts VALUES ('', '$author', '$title', '$content', '', '$date', FALSE, '','$categ')";
    }
    
    if($_FILES["uploadImg"]["size"] > 10000000) {
      echo "Filen är för stor.";
      exit;
    }
    
      $result = getDbConnection($query);
      $last_id = mysqli_insert_id ($conn);

      $target_name = $targetFolder . basename($last_id . ".jpg");
      $type = pathinfo($target_name, PATHINFO_EXTENSION);
      if($type != "jpg") {
        echo "Endast JPG-filer är tillåtna.";
        exit;
    } if(move_uploaded_file($_FILES["uploadImg"]["tmp_name"], $target_name)) {
        // Filuppladdningen OK!
    } 
    $query = "UPDATE posts SET post_img = '{$target_name}' WHERE id = {$last_id}";
    $result = getDbConnection($query);
 }
    
?>
<section class="comment-container">

  <form method="post" class="postform" enctype="multipart/form-data">
  <!-- <label for="rubrik">Rubrik</label> -->
    <label for="title">Rubrik:</label>
    <input type="text" class="input" name="title" required>
    <label for="category">Kategorier:</label>
    <select name="category" class="input" required>
      <option value="6">Rock/Indie rock</option>
      <option value="2">Hårdrock/metal</option>
      <option value="4">Pop</option>
      <option value="5">Rnb/hip hop</option>
      <option value="1">Country</option>
      <option value="3">Klassisk</option>
      <option value="7">Techno</option>
    </select><br>
    <textarea name="content" required>  <?php
      if(isset($_GET["edit"]) && $_GET["edit"] == true) { echo $id; } ?>
    </textarea><br>
    <input type="file" name="uploadImg" id="uploadImg">
    <input type="submit" name="submitpost" class="post-button" id="submitpost" value="Posta inlägg">
    <input type="submit" name="draft" class="post-button" value="Spara utkast">
  </form>
</section>

<?php
  include "footer.php";
?>
