 <?php
/* date_default_timezone_set('Europe/Stockholm');

 $conn = new mysqli("localhost", "root", "", "blog");
 mysqli_set_charset($conn, "utf8");
 setlocale(LC_ALL, 'sv_SE');
 $stmt = $conn->stmt_init();

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
} */
?>

