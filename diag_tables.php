<?php
// diag_tables.php
$token = "4f8a2b9d1c7e6f3a5b0d4e8c9f2a1b7d";
if ($_GET['t'] !== $token)
    exit("Forbidden");

include "index.php"; // Load CI
$CI =& get_instance();
$CI->load->database();

$tables = $CI->db->list_tables();
echo "<h3>Database Tables</h3><pre>";
foreach ($tables as $table) {
    if (strpos($table, 'mst_farm') !== false || strpos($table, 'mst_item') !== false || strpos($table, 'mst_group') !== false) {
        echo $table . "\n";
        $fields = $CI->db->list_fields($table);
        foreach ($fields as $field) {
            echo "  - " . $field . "\n";
        }
    }
}
echo "</pre>";
