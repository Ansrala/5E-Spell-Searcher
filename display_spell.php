<?php
require_once(__DIR__ . "/connect_database.php");
global $conn;

if(!isset($_REQUEST['spell_id']))
	die();
$id = $_REQUEST['spell_id'];

if(!is_numeric($id))
	die();
	
$spell = $conn->query("SELECT * FROM spells WHERE id = $id");
if(!$spell)
	die(); 
$spell = $spell->fetch_array(MYSQLI_ASSOC); 
$school = $conn->query("SELECT name FROM schools WHERE id=" . $spell['school_id']);
$school = $school->fetch_array(MYSQLI_ASSOC);
$classes = $conn->query("SELECT classes.name FROM classes,classes_spells WHERE spell_id=".$spell['id']." AND class_id=classes.id");
$classes = $classes->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
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
			
			<h1><?=$spell['name']?></h1><br>
			<table border='1'>
				<tr>
					<td>
						<?=$spell['level']?> level <?=$school['name']?>  <?=$spell['ritual']?"(ritual)":""?>
					</td>
				</tr>
				<tr>
					<td>
						casting time:
					</td>
					<td>
						<?=$spell['casting_time_num']?> <?=$spell['casting_time_unit']?>
					</td>
				</tr>
				<tr>
					<td>
						range:
					</td>
					<td>
						<?=$spell['range_num']?> <?=$spell['range_unit']?>
					</td>
				</tr>
				<tr>
					<td>
						Duration:
					</td>
					<td>
						<?=$spell['duration_num']?> <?=$spell['duration_unit']?> <?=$spell['duration_concentration']?"(concentration)":""?>
					</td>
				</tr>
				<tr>
					<td>
						Components:
					</td>
					<td>
						<?=$spell['vocal']? " V":""?> 
						<?=$spell['somatic']? " S":""?> 
						<?=$spell['materials']? " M (".$spell['materials'].")":""?>
					</td>
				</tr>
				<tr style="vertical-align:top">
					<td> 
						Description:
					</td>
					<td>
						<?=$spell['description']?>
					</td>
				</tr>
				<tr style="vertical-align:top">
					<td> 
						Classes:
					</td>
					<td>
						<?php 
							foreach($classes as $class)
								echo $class['name'] . " ";
						?>
					</td>
				</tr>
			</table>
		</div>
    </body>
</html>