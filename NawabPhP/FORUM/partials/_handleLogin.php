<?php
session_start();
include "_dbconnect.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = :email");
    $stmt->bindParam(':email', $loginEmail);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($loginPassword, $user["user_password"])){
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['loggedIn'] = true;
        $_SESSION['login'] = true;
        $_SESSION['user'] = $user['user_name'];
        header("location: /NawabPhP/FORUM/");
        exit;
    }else{
        $_SESSION['invalidLogin'] = true;
        header("location: /NawabPhP/FORUM/");
        exit;
    }
}

?>