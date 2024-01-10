<?php
$username = $_POST["username"];
$password = $_POST["password"];

$con = new mysqli("localhost", "root", "", "si_one");

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $stmt = $con->prepare("select * from login where username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data['password'] === $password) {
            echo '<h2>Login sucess</h2>';
        } else {
            echo '<h2>Invalid username of password</h2>';
        }
    } else {
        echo "<h2>Invalid username of password</h2>";
    }
}
?>
