<?php
require_once(__DIR__. "/connect_database.php");
global $conn;
   $results = $conn->query("SELECT id, name FROM spells order by name");
    $spells = $results->fetch_all(MYSQLI_NUM);
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
            <li class="active"><a href=".">Home</a></li>
            <li><a href="populate_database.php">Add</a></li>
            <li><a href="index.php">Library</a></li>
          </ul>
        </div>
	</nav>
    <body role="document">
		<div class="container theme-showcase" role="main"> 
			<script src="bootstrap/dist/js/bootstrap.min.js"></script>
			
			<h1>The spells</h1>
			<?php
				for($i = 0; $i<count($spells);$i++)
				echo "<a href='populate_database.php?spell_id=".$spells[$i][0]."'>".$spells[$i][1]."</a><br>"
			?>
		</div>
    </body>
</html>