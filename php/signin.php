<?php
session_start();
require_once('../admin/connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $adminpassword = "admin1234";
    $adminemail = "admin@gmail.com";
    if ($password == $adminpassword) {
        if ($email  == $adminemail) {
            header('Location: ../admin/pages/user-information.php');
            exit();
        }
    }
    $sql = "SELECT * FROM registration WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['fullName'] = $row['fullName'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['imageData'] = $row['imageData'];
            $_SESSION['accountDisabilityType'] = $row['disability'];
            header('Location: ../pages/Home.php');
            exit();
        } else {
            $_SESSION['emailError'] = true;
            header('Location: ../pages/Signin.php');
            exit();
        }
    } else {
        $_SESSION['emailError'] = true;
        header('Location: ../pages/Signin.php');
        exit();
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
if (!isset($_SESSION['id'])) {
    header('Location: ../pages/Signin.php');
    exit();
}
mysqli_close($conn);
