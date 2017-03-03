<?php
include "header.php";
$id = $_GET['id'];


if(isset($_POST["submitpost"])) {
$title = $_POST['title'];
$content = $_POST['content'];
$query = "UPDATE posts SET post_title = '{$title}', post_text = '{$content}'  WHERE id = '{$id}'";
$result = getDbConnection($query);
}
$query = "SELECT * FROM posts WHERE id = '{$id}'";
$result = getDbConnection($query);
$row = mysqli_fetch_assoc($result);


?>


<section class="container">
  <form method="post" class="postform" enctype="multipart/form-data">
  <!-- <label for="rubrik">Rubrik</label> -->
    <label for="title">Rubrik:</label>
    <input type="text" class="input" name="title" value="<?php echo $row['post_title'];?>" required>
    <label for="category">Kategorier:</label>
    <!--<select name="category" class="input" required>
      <option value="6">Rock/Indie rock</option>
      <option value="2">Hårdrock/metal</option>
      <option value="4">Pop</option>
      <option value="5">Rnb/hip hop</option>
      <option value="1">Country</option>
      <option value="3">Klassisk</option>
      <option value="7">Techno</option>
    </select><br>-->
    <textarea name="content" required><?php echo $row['post_text'];?> </textarea><br> <!--fungerar ej!!!-->
    <!--<input type="file" name="uploadImg" id="uploadImg">-->
    <input type="submit" name="submitpost" class="post-button" id="submitpost" value="Posta inlägg">
    <input type="submit" name="draft" class="post-button" value="Spara utkast">
  </form>
</section>

<?php include "footer.php";
?>
