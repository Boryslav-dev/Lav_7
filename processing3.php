<?php
include ("database.php");

    $fdata = $_GET['fdata'];
    $sdata = $_GET['sdata'];
    $fdata = trim($fdata);
    $fdata = htmlspecialchars($fdata); 
    $sdata = trim($sdata);
    $sdata = htmlspecialchars($sdata); 

    header('Content-Type: application/json');
    header("Cache-Control: no-cache, must-revalidate");
    $sql = "SELECT Id_SEANSE, in_trafic, out_trafic, start, stop
    FROM seanse
    WHERE start > '$fdata' AND stop < '$sdata' ";
    $sth = $pdo -> query($sql);
    $timetable = $sth->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($timetable);

?>
