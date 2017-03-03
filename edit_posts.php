<?php
include "header.php";

if( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
} else {
    header ("Location: login.php");
} 

//Radera inlägg 
if(isset($_GET["delete"])) {
    $deletePost = $_GET["delete"];
    $query = "DELETE FROM posts WHERE id = '{$deletePost}'";
    if(getDbConnection($query) == FALSE ) {
        echo "<p class='messages'>Inlägget har raderats.</p>";
    }
}
?>
<section class="sort-posts">
<table>
    <tr>
        <th>Mina inlägg</th>
        <th>Datum</th>
        <th>Ändra</th>
        <th>Radera</th>
    </tr> <!-- Loopar ut alla inlägg från användaren -->
    <?php $posts = fetchUserBlogPosts(); foreach($posts as $post) : ?> 
    <tr>
        <td><a href="blog_post.php?id=<?php echo $post['id'];?>"><?php echo $post['post_title']; ?></a></td>
        <td><?php echo $post['publish_date'] ?></td>
        <td><a href="update_post.php?id=<?php echo $post['id']; ?>"><i class="fa fa-wrench"></i></a></td> 
        <td><a href="edit_posts.php?delete=<?php echo $post['id']; ?>"><i class="fa fa-trash"></i></a></td>
        <!-- $post['id'] -->
        <?php endforeach; ?>
    </tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr>
        <th>Mina utkast</th>
        <th>Datum</th>
        <th>Ändra</th>
        <th>Radera</th>
    </tr> <!-- Loopar ut alla inlägg från användaren -->
    <?php $posts = fetchUserUnpubPosts(); foreach($posts as $post) : ?> 
    <tr>
        <td><a href="blog_post.php?id=<?php echo $post['id'];?>"><?php echo $post['post_title']; ?></a></td>
        <td><?php echo $post['publish_date'] ?></td>
        <td><a href="update_post.php?id=<?php echo $post['id']; ?>"><i class="fa fa-wrench"></i></a></td> 
        <td><a href="edit_posts.php?delete=<?php echo $post['id']; ?>"><i class="fa fa-trash"></i></a></td>
        <!-- $post['id'] -->
        <?php endforeach; ?>
    </tr>
     <tr><td></td></tr>
     <tr><td></td></tr>
    <?php 
    if($_SESSION['admin'] == 1 && $_SESSION['logged_in'] == true) { ?>
    <tr>
        <th>Alla inlägg</th>
        <th>Datum</th>
        <th>Ändra</th>
        <th>Radera</th>
    </tr> <!-- Loopar ut alla inlägg från användaren -->
    <?php $posts = fetchAllBlogPosts(); foreach($posts as $post) : ?> 
    <tr>
        <td><a href="blog_post.php?id=<?php echo $post['id'];?>"><?php echo $post['post_title']; ?></a></td>
        <td><?php echo $post['publish_date'] ?></td>
        <td><a href="update_post.php?id=<?php echo $post['id']; ?>"><i class="fa fa-wrench"></i></a></td> 
        <td><a href="edit_posts.php?delete=<?php echo $post['id']; ?>"><i class="fa fa-trash"></i></a></td>
        <!-- $post['id'] -->
        <?php endforeach; ?>
    </tr>
    <?php } ?>

</table>
</section>
<?php
    include "footer.php";
?>
