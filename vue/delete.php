<?php
include('../autoload.php');
session_start();
$userManager = new userManager();
$user = $userManager->findByEmail($_SESSION['email']);
$deleteUser = $userManager->delete($user);
unset($_SESSION);
header('location:home.php');
?>

