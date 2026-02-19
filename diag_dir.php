<?php
$token = "4f8a2b9d1c7e6f3a5b0d4e8c9f2a1b7d";
if (!isset($_GET['t']) || $_GET['t'] !== $token)
    die("Denied");

function list_dir($path)
{
    if (!is_dir($path))
        return "Not a directory: $path";
    $files = scandir($path);
    return implode("\n", $files);
}

echo "<h3>Listing modules:</h3>";
echo "<pre>" . list_dir("application/modules") . "</pre>";

echo "<h3>Current Path:</h3>";
echo getcwd();
?>