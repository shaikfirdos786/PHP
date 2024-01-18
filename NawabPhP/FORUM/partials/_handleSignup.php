<?php
session_start();
include "_dbconnect.php";
$showError = false;
$showAlert = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["signupPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = :email");
    $stmt->bindParam(':email', $userEmail);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_exists'] = true;
        header("location: /NawabPhP/FORUM/");
    } else {
        if ($confirmPassword == $userPassword) {
            $hashpassword = password_hash($userPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES(:name, :email, :hashpassword)");
            $stmt->bindParam(':name', $userName);
            $stmt->bindParam(':email', $userEmail);
            $stmt->bindParam(':hashpassword', $hashpassword);
            if ($stmt->execute()) {
                $_SESSION['signed_up'] = true;
                header("location: /NawabPhP/FORUM/");
            }else{
                $_SESSION['signupError'] = true;
                header("location: /NawabPhP/FORUM/");
            }
        } else {
            $_SESSION['mis_match'] = true;
            header("location: /NawabPhP/FORUM/");
        }
    }




}