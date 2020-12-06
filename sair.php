<?php 
session_start();
$_SESSION['session'] = false;
session_destroy();
echo "Sessão: " . $_SESSION['session'];
header('Location: /login.php');