<?php
$token = "4f8a2b9d1c7e6f3a5b0d4e8c9f2a1b7d";
if (!isset($_GET['t']) || $_GET['t'] !== $token)
    die("Denied");
phpinfo();
?>