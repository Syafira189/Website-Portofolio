<?php
$host     = "localhost";
$username = "root";
$password = "";
$dbname   = "fira_db";

$connection = mysql_connect($host, $username, $password, $dbname);

if (!$connection) {
    die("Koneksi gagal: " . mysqli_connect_error());
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $instagram = $_POST['instagram'];
    $message = $_POST['message'];
    if (!empty($name) && !empty($email) && !empty($phone) && !empty($instagram) && !empty($message)) {
        $sql = "INSERT INTO tb_fira (name, email, phone, instagram, message, created_at) VALUES (?, ?, ?, NOW())";
        
        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $phone, $instagram, $message);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "oke makasih yaa";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error dalam menyiapkan query.";
        }
    } else {
        echo "Wajib di isi semua kolom.";
    }
}

mysqli_close($connection);
?>


