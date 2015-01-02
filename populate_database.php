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
		<link href="theme.css" rel="stylesheet">
    </head>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Spell Search</a>
        </div>
		<div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href=".">Home</a></li>
            <li class="active"><a href="populate_database.php">Add</a></li>
            <li><a href="index.php">Library</a></li>
          </ul>
        </div>
	</nav>
    <body role="document">
		<div class="container theme-showcase" role="main">
			<script src="jquery-2.1.3.min.js"></script>
			<script src="bootstrap/dist/js/bootstrap.min.js"></script>
			
			<form action="add_spell.php" method="post" class="form-horizontal">
				
					<?=$edit?>
					<div class="form-group">
					<label for="name">Name: </label> <input class="form-control" type="text" name="name" value="<?=$name?>">
					</div><div class="form-group">
					<label for="level">Spell Level: </label> <input class="form-control" type="number" min="0" max="9" name="level" value="<?=$level?>">
					</div><div class="form-group">
					<label for="school_id">School: </label>
					<select name="school_id" class="form-control">
						<?php
							for($i = 0;$i < count($schools); $i++) {
								echo "<option ".($schools[$i][0] == $school_id ? "selected":"" )." value='" . $schools[$i][0] . "'>" . $schools[$i][1] . "</option>";
							}
						?>
					</select>
					</div>
					<div class="form-group">
						<label for="ritual">Ritual: </label> <input type="checkbox" name="ritual" value="checked" <?=($ritual ? "checked":"")?>>
					</div>
					<div class="form-group">
						<label for="concentration">Concentration: </label> <input type="checkbox" name="concentration" value="checked"<?=($concentration ? "checked":"")?>>
					</div>
					<div class="form-group">
						<label for="casting_time_number">Casting Time Number: </label> <input class="form-control" type="number" min="0" max="100000" name="casting_time_number" value="<?=$casting_time_number?>">
					</div>
					<div class="form-group">
						<label for="casting_time_unit">Casting Time Unit: </label><input class="form-control" type="text" name="casting_time_unit" value="<?=$casting_time_unit?>">
					</div>
					<div class="form-group">
						<label for="range_number">Range Number: </label> <input class="form-control" type="number" min="0" max="100000" name="range_number" value="<?=$range_number?>">
					</div>
					<div class="form-group">
						<label for="range_unit">Range Unit: </label><input class="form-control" type="text" name="range_unit" value="<?=$range_unit?>">
					</div>
					<div class="form-group">
						<label for="duration_number">Duration Number: </label><input class="form-control" type="number" min="0" max="100000" name="duration_number" value="<?=$duration_number?>">
					</div>
					<div class="form-group">
						<label for="duration_unit">Duration Unit: </label><input class="form-control" type="text" name="duration_unit" value="<?=$duration_unit?>">
					</div>
					<div class="form-group">
						<label for="vocal">Vocal: </label> <input type="checkbox" name="vocal" value="checked" <?=($vocal ? "checked":"")?>>
						<label for="somatic">Somatic: </label> <input type="checkbox" name="somatic" value="checked" <?=($somatic ? "checked":"")?>>
					</div>
					<div class="form-group">
						<label for="materials">Materials: (leave blank if none)</label>
						<textarea class="form-control" rows="4" cols="50" name="materials"><?=$materials?></textarea>
					</div>
					<div class="form-group">
						<label for="descriptions">Descriptions</label>
						<textarea class="form-control" rows="4" cols="50" name="descriptions"><?=$description?></textarea>
					</div>
					<div class="btn-group" data-toggle="buttons">
						<?php
						if(isset($class_spells))
						{
							 for($i = 0;$i <count($classes);$i++) {
								 $temp = false;
								 for($j=0;$j <count($class_spells);$j++){ 
									 if($class_spells[$j]['class_id'] == $classes[$i][0])
										 $temp = true; 
								 }
								 echo "<label class=\"btn btn-primary\"><input type=\"checkbox\" ".($temp ? "checked" : "")." >" . $classes[$i][1] . "</label>";
							 }
						 }
						 else
						 {
							for($i = 0;$i <count($classes);$i++)
							echo "<label class=\"btn btn-primary\"><input type=\"checkbox\" >"  . $classes[$i][1] . "</label>";
						 }
						?>
					</div>

					<input type="submit" name="submit" value="Submit">
				</div>		
			</form>
			
		</div>
    </body>
</html>