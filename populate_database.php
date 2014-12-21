<?php
require_once(__DIR__ . "/connect_database.php");
global $conn;

$schools = $conn->query("SELECT * FROM schools ORDER BY id");
$schools =$schools->fetch_all (MYSQLI_NUM);

$classes = $conn->query("SELECT * FROM classes ORDER BY id");
$classes = $classes->fetch_all(MYSQLI_NUM);

    $name = "spell name";
    $level = 0;
    $school_id = -1;
    $ritual = 0;
    $casting_time_number = 0;
    $casting_time_unit = "units";
    $range_number = 0;
    $range_unit = "units";
    $concentration = 0;
    $duration_number = 0;
    $duration_unit = "units";
    $vocal = 0;
    $somatic = 0;
    $materials = "";
    $description = "";
    $edit = "";

if(isset($_GET["spell_id"])) {
    $spell_id = htmlentities($conn->real_escape_string($_GET["spell_id"]), ENT_QUOTES);
    $results = $conn->query("SELECT * FROM spells WHERE id = $spell_id");
    $spell  = $results->fetch_all(MYSQLI_ASSOC)[0];

    $name = $spell['name'];
    $level = $spell['level'];
    $school_id = $spell['school_id'];
    $ritual = $spell['ritual'];
    $casting_time_number = $spell['casting_time_num'];
    $casting_time_unit = $spell['casting_time_unit'];
    $range_number = $spell['range_num'];
    $range_unit = $spell['range_unit'];
    $concentration = $spell['duration_concentration'];
    $duration_number = $spell['duration_num'];
    $duration_unit = $spell['duration_unit'];
    $vocal = $spell['vocal'];
    $somatic = $spell['somatic'];
    $materials = $spell['materials'];
    $description = $spell['description'];

    $results = $conn->query("SELECT * FROM classes_spells WHERE spell_id = $spell_id ORDER BY id");
    $class_spells = $results->fetch_all(MYSQLI_ASSOC);

    $edit ="<input type='hidden' name='edit' value='$spell_id'>";
}
?><!DOCTYPE html>
<html>
    <head>
		<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
		<script src="bootstrap/dist/js/bootstrap.min.js"></script>

    <form action="add_spell.php" method="post">
        <?=$edit?>
        <label for="name">Name: </label> <input type="text" name="name" value="<?=$name?>"><br>
        <label for="level">Spell Level: </label> <input type="number" min="0" max="9" name="level" value="<?=$level?>"><br>
        <label for="school_id">School: </label><select name="school_id"><?php
        for($i = 0;$i < count($schools); $i++) {

            echo "<option ".($schools[$i][0] == $school_id ? "selected":"" )." value='" . $schools[$i][0] . "'>" . $schools[$i][1] . "</option>";
        }?>
        </select><br>
        <label for="ritual">Ritual: </label> <input type="checkbox" name="ritual" value="checked" <?=($ritual ? "checked":"")?>><br>
        <label for="casting_time_number">Casting Time Number: </label> <input type="number" min="0" max="100000" name="casting_time_number" value="<?=$casting_time_number?>"><br>
        <label for="casting_time_unit">Casting Time Unit: </label><input type="text" name="casting_time_unit" value="<?=$casting_time_unit?>"><br>
        <label for="range_number">Range Number: </label> <input type="number" min="0" max="100000" name="range_number" value="<?=$range_number?>"><br>
        <label for="range_unit">Range Unit: </label><input type="text" name="range_unit" value="<?=$range_unit?>"><br>
        <label for="concentration">Concentration: </label> <input type="checkbox" name="concentration" value="checked"<?=($concentration ? "checked":"")?>><br>
        <label for="duration_number">Duration Number: </label><input type="number" min="0" max="100000" name="duration_number" value="<?=$duration_number?>"><br>
        <label for="duration_unit">Duration Unit: </label><input type="text" name="duration_unit" value="<?=$duration_unit?>"><br>
        <label for="vocal">Vocal: </label> <input type="checkbox" name="vocal" value="checked" <?=($vocal ? "checked":"")?>><br>
        <label for="somatic">Somatic: </label> <input type="checkbox" name="somatic" value="checked" <?=($somatic ? "checked":"")?>><br>
        <label for="materials">Materials: (leave blank if none)</label><textarea rows="4" cols="50" name="materials"><?=$materials?></textarea><br>
        <label for="descriptions">Descriptions</label><textarea rows="4" cols="50" name="descriptions"><?=$description?></textarea><br>

        <?php
		if(isset($class_spells))
		{
			 for($i = 0;$i <count($classes);$i++) {
				 $temp = false;
				 for($j=0;$j <count($class_spells);$j++){ 
					 if($class_spells[$j]['class_id'] == $classes[$i][0])
						 $temp = true; 
				 }
				 echo "<label for='class_" . $classes[$i][1] . "'>" . $classes[$i][1] . "</label><input type='checkbox' ".($temp ? "checked": "nupe")." name='class_" . $classes[$i][1] . "' value='checked'><br>";
			 }
		 }
        ?>

        <input type="submit" name="submit" value="Submit">
    </form>

    </body>
</html>