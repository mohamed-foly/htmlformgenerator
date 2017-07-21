<html> 
<form action="generator.php" method='GET'>
<?php
$host ='127.0.0.1';
$user_name='root';
$password='';
$db_connect=mysqli_connect($host,$user_name,$password);
echo '<select name="dbs" >';
if (isset($_GET['dbs'])){
    echo "<option value=$_GET[dbs]> $_GET[dbs]</option>";
    echo '</select><input type = "submit" value="Get Tables">';
}else{
    $query = "
    SHOW DATABASES";
    if ($result = mysqli_query($db_connect, $query)) {
        while ($row = mysqli_fetch_row($result)) {
        echo "<option value=$row[0]> $row[0]</option>";
    }
    echo '</select><input type = "submit" value="Get Tables"><br>';
    mysqli_free_result($result);
die;
}

}
echo '<select name="tables" >';
$query = "
SHOW TABLES FROM $_GET[dbs]";
if (isset($_GET['tables'])){
    echo "<option value=$_GET[tables]> $_GET[tables]</option>";
    echo "</select>";
    echo '</select><input type = "submit" value="Generate">';

    $query = "
    SHOW COLUMNS FROM $_GET[dbs].$_GET[tables]";
    echo '<br><h1>'.htmlspecialchars('<form action=\'\' method = \'\'>').'<br>';
        
    if ($result = mysqli_query($db_connect, $query)) {
        while ($row = mysqli_fetch_row($result)) {
            echo htmlspecialchars("<input type='text' name = '$row[0]' placeholder ='$row[0]'>").'<br>';
        }
    }
    echo htmlspecialchars('</form>').'</h1><br>';
}else{
if ($result = mysqli_query($db_connect, $query)) {
    while ($row = mysqli_fetch_row($result)) {
        echo "<option value=$row[0]> $row[0]</option>";
    }
    mysqli_free_result($result);
}
}
mysqli_close($db_connect);
?>
</form>
</html>