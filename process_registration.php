<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    if (!empty($name) && !empty($email) && !empty($password) && $password === $confirm_password) {

        echo "Thank you for registering, $name!";
    } else {
        echo "Please fill in all fields and ensure passwords match.";
    }
} else {
    header("Location: register.php");
    exit();
}
?>
