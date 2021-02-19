<?php
include ("database.php");

    $value = $_GET['select1'];
    $value = trim($value);
    $value = htmlspecialchars($value); 
    global $pdo;
    $stm = $pdo -> query("SELECT seanse.start, seanse.stop, seanse.in_trafic, seanse.out_trafic
    FROM seanse INNER JOIN client
    ON client.ID_Client = seanse.FID_Client
    Where client.name = '$value'");
?>
    <table class="city_list">

  <?php foreach($stm as $a): ?>
  <tr>
    <?php foreach($a as $d): ?>
    <td>
        <?php $a=array_chunk($a,6); ?>
        <?php echo $d; ?>
        </td>
        <?php endforeach; ?>
  </tr>
    <?php endforeach; ?>
</table>
 

<style>
.city_list 
{
  width: 25%;
}
.city_list td 
{
  width: 25%;
  border: 1px solid #ddd;
  padding: 7px 10px;
}
