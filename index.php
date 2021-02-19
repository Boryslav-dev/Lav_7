<?php
include ("database.php");

    global $pdo;
    $stm = $pdo -> query('SELECT name FROM client')->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Lab First</title>
  <script>

  var ajax = new XMLHttpRequest()

  function get1(){
        if (!ajax) {
            alert("Ajax не инициализирован"); return;
            }
            var s1val = document.getElementById("select1").value;
            ajax.onreadystatechange = UpdateSelect1;
            var params = 'select1=' + encodeURIComponent(s1val);
            ajax.open("GET", "processing2.php?"+params, true);
            ajax.send(null); 
        }
    function UpdateSelect1() {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                // если ошибок нет
                var select = document.getElementById('getselect1');
                select.innerHTML = ajax.responseText;
            }
            else alert(ajax.status + " - " + ajax.statusText);
            ajax.abort();
        }
    } 

    function get2(){
        if (!ajax) {
            alert("Ajax не инициализирован"); return;
            }
            ajax.onreadystatechange = UpdateSelect2;
            ajax.open("GET", "processing.php?", true);
            ajax.send(null); 
        }

    function UpdateSelect2() {
        if(ajax.readyState == 4) {
            if(ajax.status == 200) {
                var res = document.getElementById("getselect2");
                var result = "";
                var rows = ajax.responseXML.firstChild.children;
                for (var i = 0; i < rows.length; i++) {
                    result += rows[i].children[0].textContent+"<br>";
                }
            res.innerHTML = result;
            }
        }
    }

    function get3(){
        if (!ajax) {
            alert("Ajax не инициализирован"); return;
            }
            var s1val = document.getElementById("fdata").value;
            var s2val = document.getElementById("sdata").value;
            ajax.onreadystatechange = UpdateSelect3;
            var params1 = 'fdata=' + encodeURIComponent(s1val);
            var params2 = 'sdata=' + encodeURIComponent(s2val);
            ajax.open("GET", "processing3.php?"+params1+"&"+params2, true);
            ajax.send(null);
    }

    function UpdateSelect3(){
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                alert(ajax.responseText);
                var rows = JSON.parse(ajax.responseText);
                var result = "";
                var res = document.getElementById("getselect3");
                //document.getElementById("quantity").innerHTML=res.quantity; 
                for (var i = 0; i < rows.length; i++) {
                    result += "<tr>";
                    result += "<td>" + rows[i].Id_SEANSE + "</td>";
                    result += "<td>" + rows[i].in_trafic + "</td>";
                    result += "<td>" + rows[i].out_trafic + "</td>";
                    result += "<td>" + rows[i].start + "</td>";
                    result += "<td>" + rows[i].stop + "</td>";
                    result += "</tr>";
                }
                res.innerHTML = result;
                }
            else { alert(ajax.status + " - " + ajax.statusText);
            ajax.abort(); }
        }
    }
  </script>  
 </head>
 <body>
 
 <form name ="form1" method="get">
   <p><select id="select1" name="category_id">
   <option value="">Выбирите имя клиента:</option>
    <?php         
    foreach($stm as $category => $value) 
    {
       $category = htmlspecialchars($category); 
       echo '<option value="'. $value .'">'. $value .'</option>';
    }
    ?>
  </select>
   <p><input name="submit" type="button" value="Получить информацию" onclick="get1();"></p>
  </form>

  <div id="getselect1"></div>

 <form action="processing3.php" method="post">
  <p>Введите диапазон времени:</p>
  <label for="fdata">Первая дата:</label><br>
  <input id="fdata" type="time" name="fdata" ><br>
  <label for="sdata">Вторая дата:</label><br>
  <input id="sdata" type="time" name="sdata">
  <p><input type="button" value="Получить информацию" onclick="get3();"></p>
</form>

<table id="getselect3"></table>

<div id="getselect4"></div>

 <form  name="form3" method ="get">
  <input type="radio" id="balance" name="balance" value="balance">
  <label for="balance">Получить информацию об отрицательном счёте?</label><br>
  <p><input name = "submit" type="button" value="Получить информацию" onclick="get2();"/></p>
</form>

<div id="getselect2"></div>

</body>
</html>
