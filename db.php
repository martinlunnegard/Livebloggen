<?php
//funktion som skapar en uppkoppling mot databasen
$conn = new mysqli("localhost", "root", "", "blog");
function getDbConnection($query) {
   global $conn;
    mysqli_set_charset($conn, "utf8");
    setlocale(LC_ALL, 'sv_SE');

    if ($conn->connect_errno) {
        throw Exception('Connection error: db.php');
    } else {
        $stmt = $conn->stmt_init();
        if ($stmt->prepare($query)) {
            $stmt->execute();
            return $stmt->get_result();
        } else {
            echo mysqli_error($conn);
        }
    }
}
?>