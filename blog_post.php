<?php
   // date_default_timezone_set('Europe/Stockholm'); 
  include "header.php";
 
  
  $id = $_GET["id"];
  
  if (!isset($_GET["comment"])) {
    $_GET["comment"] = '';

  if (!isset($_SESSION["logged_in"])) {
    $_SESSION["admin"] = '';
    $_SESSION["logged_in"] = false;
  }   


  if (!isset($_GET["delete"])) {
    $_GET["delete"] = false;
    } else {
    	$deleteComment = $_GET["cid"];
    	$query = "DELETE FROM comments WHERE id = '{$deleteComment}'";
    	if(getDbConnection($query) == FALSE ) {
        echo "<p class='messages'>Kommentaren har raderats.</p>";
    }  
   }
  }

  //Query som hämtar "rätt inlägg"
  //$query = "SELECT * FROM posts WHERE id = {$id}";
    $query = "SELECT * FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.cat_id = categories.id WHERE posts.id = {$id}";

  $result = getDbConnection($query); foreach($result as $post): ?>
  <section class="sort-posts">
    <h2><?php echo $post['post_title']; ?></h2>
    <p>Skriven av: <?php echo $post['username']; ?></p> <!--måste göra en left join för att få fram namnet-->
    <p><?php echo $post['publish_date']; ?></p> <!--skall upp på samma rad som skriven av-->
    <p><?php echo $post['cat_name']; ?></p> <!--måste göra en left join för att få fram kategorin-->
    <img src="<?php echo $post['post_img']; ?>" class="big-image">
    <p class="text"><?php echo nl2br($post['post_text']); ?></p><br>
  
  <?php endforeach; 
  
  $query = "SELECT comments.id FROM comments LEFT JOIN posts ON posts.id = comments.post_id WHERE posts.id = {$id}";
  $comments = getDbConnection($query);
  $rowcount = mysqli_num_rows($comments);
  ?>

  <a href="blog_post.php?comments=true&id=<?php echo $id; ?>#comments">Kommentarer ( <?php echo $comments->num_rows;?> ) </a>
  </section>
  <?php
  if (isset($_GET['comments'])) { ?>
      
    <section class="comment-container">
    <a name="comments"></a>
    <?php
    // Query som väljer rätt kommentarer utifrån ID
      $query = "SELECT * FROM comments WHERE post_id = '{$id}'";
      $result = getDbConnection($query); foreach($result as $comment): ?>
      <div class='comment-box'>
        <h4><?php echo $comment['comment_title']; ?></h4>
        <p>Skriven av: <?php echo $comment['guest_name']; ?></p>
        <p><?php echo $comment['date']; ?></p>
        <p><?php echo nl2br($comment['blog_comment']); ?></p><br>
        
     <?php //Om Superadmin är inloggad kan kommentar tas bort samt om man själv är författare till inlägget
            if ($_SESSION["admin"] == 1 || 
                $_SESSION["logged_in"] == true && 
                $_SESSION["id"] == $post["user_id"]) { 
                echo "<span class='link-styling'><a href='blog_post.php?delete=true&cid=".$comment['id']."&id=".$id."'>Ta bort kommentar</a></span>";
            } ?>
      </div>
      <?php endforeach; ?>
  <!-- Form för att skriva en kommentar skickas till comments.php -->
    
    <?php //Om inloggad behöver inte användaren fylla i kommentarsformen
    if ((isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true)) { ?>
      <form action="<?php setComments($conn); ?>" method="post">
        <input type="hidden" name="post_id" value="<?php echo $id; ?>">
        <input type="hidden" class="comment-input" name="guest_name" value="<?php echo $_SESSION['username']; ?>"><br>
        <input type="hidden" class="comment-input" name="guest_email" value="<?php echo $_SESSION['e-mail']; ?>"><br>
        <input type="text" class="comment-input" name="comment_title" placeholder="Titel">
        <textarea name="blog_comment" class="comment-input" value="Kommentar"></textarea>
        <input type="hidden" name="date" value="<?php $date; ?>"><br>
        <input type="submit" class="post-button" name="post_comment" value="Skicka kommentar"></input>
      </form>

    <?php // Ej inloggad kommentar
    } if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) { ?>
      <form action="<?php setComments($conn); ?>" method="post">
        <input type="hidden" name="post_id" value="<?php echo $id; ?>">
        <input type="text" class="comment-input" name="guest_name" placeholder="Namn"><br>
        <input type="text" class="comment-input" name="guest_email" placeholder="Email"><br>
        <input type="text" class="comment-input" name="comment_title" placeholder="Titel">
        <textarea name="blog_comment" class="comment-input" value="Kommentar"></textarea>
        <input type="hidden" name="date" value="<?php $date; ?>"><br>
        <input type="submit" class="post-button" name="post_comment" value="Skicka kommentar"></input>
      </form>
    <?php }
    }


  // Hämtar GET-variablen som skickas tillbaka från comments.php 
  if(isset($_GET["id"]) && ($_GET["comment"] == "true" )) {
    echo "<p class='messages'>Kommentar postad</p>";
  } else if (isset($_GET["id"]) && ($_GET["comment"] == "false")) {
    echo "Någonting gick fel, försök igen";
  }
?>
</section>

<?php
 include "footer.php";
?>
