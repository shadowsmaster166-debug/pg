<?php
include "db.php";
use Pdo\Pgsql;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role)values($1, $2, $3, $4)";

    $params = array($name, $email, $password, $role);
    
    $sent = pg_send_query_params($dbconn, $sql, $params);
    
    if ($sent) {
        // Ambil hasil akhir dari pengiriman query
        $result = pg_get_result($dbconn);
        $status = pg_result_status($result);

        // PGSQL_COMMAND_OK artinya data berhasil masuk
        if ($status === PGSQL_COMMAND_OK) {
            echo "You Have registered!";
        } else {
            echo "Error Detail: " . pg_result_error($result);
        }
    } else {
        echo "Gagal mengirim data ke database.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include "heading.php"; ?>
<body>
    <div class="register">
        <form action="register.php" method="post">
            <input type="text" name="name" placeholder="Enter Your Name"> <br>
            <input type="email" name="email" placeholder="Enter Your Email"> <br>
            <input type="password" name="password" placeholder="Enter Your Pass"> <br>
            <input type="text" name="role" value="user" hidden> <br>
            <button type="submit">sign up</button>
        </form>
    </div>
</body>
</html>