<?php
include "db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = $1";
    $params = array($email);
    $sent = pg_send_query_params($dbconn, $sql, $params);

    if ($sent) {
        $result = pg_get_result($dbconn);
        
        // 2. Cek apakah user ditemukan
        if (pg_num_rows($result) > 0) {
            $user = pg_fetch_assoc($result);

            // 3. Verifikasi Password
            // Jika saat Register kamu pakai password_hash(), verifikasi pakai password_verify()
            // Jika saat Register kamu simpan teks biasa (tidak disarankan), pakai: if($password == $user['password'])
            if ($password == $user['password']) {
                echo "Login Berhasil! Selamat datang, " . $user['name'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                if($user['role'] == "admin"){
                    header("Location: admin/dashboard.php");
                }else{
                    header("Location: dashboard.php");
                }
                exit();
            } else {
                header("Location: login.php");
            }
        } else {
            echo "Email tidak terdaftar!";
        }
    } else {
        echo "Gagal menjalankan query.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "heading.php"; ?>
<body>
    <div class="login">
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Enter Your Email"> <br>
            <input type="password" name="password" placeholder="Enter Your Password"> <br>
            <button type="submit">sign in</button>
        </form>
    </div>
</body>
</html>