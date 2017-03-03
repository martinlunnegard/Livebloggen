<?php
//function message() {
    /*if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset ($_SESSION['msg']);
    }
}
?>*/

//funktion för queryn

function fetchAllBlogPosts() {
    $query="SELECT * FROM posts WHERE is_published = 1";
    $result = fetchItems($query);

    return $result;
}


function fetchUserBlogPosts() {
    $user_id = $_SESSION['id'];
    //$query="SELECT * FROM posts LEFT JOIN users ON posts.user_id = users.id WHERE users.id = {$user_id}";
    $query="SELECT * FROM posts WHERE user_id = {$user_id} AND is_published = 1";
    $result = fetchItems($query);

    return $result;
}

function fetchUserUnpubPosts() {
    $user_id = $_SESSION['id'];
    $query="SELECT * FROM posts WHERE user_id = {$user_id} AND is_published = 0";
    $result = fetchItems($query);

    return $result;
}

//funktion för att hämta resultatet av queryn från databasen. Returnerar resultatet till funktion
function fetchItems($query) {
    $result = getDbConnection($query);
    $posts = array();
    while ( $post = $result->fetch_assoc() ) {
        $posts[] = $post;
    }

    return $posts;
}

function setComments($conn) {
if (isset($_POST["post_comment"])) {
	if( !empty($_POST["guest_name"])
	&&  !empty($_POST["guest_email"])
	&&  !empty($_POST["comment_title"])
	&&  !empty($_POST["blog_comment"]) ) {

		
		$pi = strip_tags($_POST["post_id"]);
		$gn = strip_tags($_POST["guest_name"]);
		$ge = strip_tags($_POST["guest_email"]);
		$ct = strip_tags($_POST["comment_title"]);
		$bc = strip_tags($_POST["blog_comment"]);
		$dt = date('Y-m-d H:i:s');

    $query = "INSERT INTO comments VALUES ('', '$pi', '$gn', '$ge', '$ct', '$bc', '$dt')";

    mysqli_query($conn, $query);
    header("Location: blog_post.php?id=$pi&comment=true");

  } else {
	  header("Location: blog_post.php?id=$pi&comment=false");
  }
	}
}

function deleteComments() {
	if(isset($_GET["delete"])) {
    	$deleteComment = $_GET["delete"];
    	$query = "DELETE FROM comments WHERE id = '{$deleteComment}'";
    	if(getDbConnection($query) == FALSE ) {
        echo "<p class='messages'>Inlägget har raderats.</p>";
    }
  }
}
?>

