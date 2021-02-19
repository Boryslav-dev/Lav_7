<?php
include ("database.php");

    global $pdo;
    $stm = $pdo -> query('SELECT name FROM client WHERE balance < 0');
    $items = $stm->fetchAll(PDO::FETCH_NUM);
    
    header('Content-Type: text/xml');
    header("Cache-Control: no-cache, must-revalidate");
    echo '<?xml version="1.0" encoding="utf8" ?>';
    echo "<root>";
    foreach ($items as $row)
    {
    $Name=$row[0];
    print "<row><Name>$Name</Name></row>";
    }
    echo "</root>";
?>
