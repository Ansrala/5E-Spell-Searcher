<?php
require_once(__DIR__. "/connect_database.php");
global $conn;

  // $results = $conn->query("SELECT id, name FROM spells order by name");
  //  $spells = $results->fetch_all(MYSQLI_NUM);
    $results = $conn->query("SELECT id, name FROM classes order by name");
    $classes = $results->fetch_all(MYSQLI_NUM);
    $index = 0;
    $spells = array();

    foreach($classes as $class){
        $results2 = $conn->query("SELECT spells.id,spells.name,spells.level,spells.ritual FROM spells,classes_spells WHERE spell_id = spells.id and class_id =$class[0] ORDER BY level,spells.name");
        $spells[$index] = $results2->fetch_all(MYSQLI_NUM);

        $index++;
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
            <li class="active"><a href=".">Home</a></li>
            <li><a href="populate_database.php">Add</a></li>
            <li><a href="index.php">Library</a></li>
          </ul>
        </div>
	</nav>
    <body role="document">
		<div class="container theme-showcase" role="main">
			<script src="jquery-2.1.3.min"></script>
			<script src="bootstrap/dist/js/bootstrap.min.js"></script>
			
			<h1>The spells</h1>
			<?php
				for($i = 0; $i<count($spells);$i++){
                    //echo "<li><a href='populate_database.php?spell_id=".$spells[$i][0]."'>".$spells[$i][1]."</a></li>";
                    echo"<h2>".$classes[$i][1]."</h2><br>";
                    $level = -1;
                    for($j=0;$j<count($spells[$i]);$j++){
                        if($level != $spells[$i][$j][2]){
                            $level = $spells[$i][$j][2];
                            echo "<br><p style='font-weight: bold'>Spell Level $level</p>";
                        }
                        echo "<li><a href='display_spell.php?spell_id=".$spells[$i][$j][0]."'>".$spells[$i][$j][1]."</a>".($spells[$i][$j][3] == 1? " <span style='font-weight:bold;'>(ritual)</span>": "" )." <a href='populate_database.php?spell_id=".$spells[$i][$j][0]."'>(Edit)</a></li>";

                    }
                }
			?>
		</div>
    </body>
</html>