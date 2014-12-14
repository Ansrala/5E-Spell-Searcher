<?php
require_once(__DIR__. "/connect_database.php");
global $conn;
   $results = $conn->query("SELECT id, name FROM spells order by name");
    $spells = $results->fetch_all(MYSQLI_NUM);
?><!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <a href="/populate_database.php">Create Spell</a> <br>
    <h1>The spells</h1>
    <?php
        for($i = 0; $i<count($spells);$i++)
        echo "<a href='/populate_database.php?spell_id=".$spells[$i][0]."'>".$spells[$i][1]."</a><br>"
    ?>
    </body>
</html>