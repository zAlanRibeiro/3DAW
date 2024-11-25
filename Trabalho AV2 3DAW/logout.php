<?php
session_start();
session_unset();
session_destroy();
header('Location: HomePG1.php');
exit;
?>