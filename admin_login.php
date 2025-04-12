<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["username"];
    $password = $_POST["password"];

    if (empty($name) || empty($password)) {
        echo "<script>alert('Please fill in all fields.'); window.location.href='admin_login.html';</script>";
        exit();
    }

    $stmt = $conn->prepare('SELECT * FROM admin WHERE username = ?');
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $row["username"];
            header("Location: admin_dashboard.html");
            exit();
        } else {
            echo "<script>alert('Invalid password'); window.location.href='admin_login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid user'); window.location.href='admin_login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>