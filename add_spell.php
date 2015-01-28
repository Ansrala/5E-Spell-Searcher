<?php
require_once(__DIR__ . "/connect_database.php");
global $conn;
$name = htmlentities($conn->real_escape_string($_POST["name"]),ENT_QUOTES);
$level = htmlentities($conn->real_escape_string($_POST["level"]),ENT_QUOTES);
$school_id = htmlentities($conn->real_escape_string($_POST["school_id"]),ENT_QUOTES);
$ritual = htmlentities($conn->real_escape_string($_POST["ritual"]),ENT_QUOTES);
$ritual = ($ritual == 'checked' ? 1 : 0);
$casting_time_num = htmlentities($conn->real_escape_string($_POST["casting_time_number"]),ENT_QUOTES);
$casting_time_unit = htmlentities($conn->real_escape_string($_POST["casting_time_unit"]),ENT_QUOTES);
$range_num = htmlentities($conn->real_escape_string($_POST["range_number"]),ENT_QUOTES);
$range_unit = htmlentities($conn->real_escape_string($_POST["range_unit"]),ENT_QUOTES);
$duration_concentration = htmlentities($conn->real_escape_string($_POST["concentration"]),ENT_QUOTES);
$duration_concentration = ($duration_concentration == 'checked' ? 1 : 0);
$duration_num = htmlentities($conn->real_escape_string($_POST["duration_number"]),ENT_QUOTES);
$duration_unit = htmlentities($conn->real_escape_string($_POST["duration_unit"]),ENT_QUOTES);
$vocal = htmlentities($conn->real_escape_string($_POST["vocal"]),ENT_QUOTES);
$vocal = ($vocal == 'checked' ? 1 : 0);
$somatic = htmlentities($conn->real_escape_string($_POST["somatic"]),ENT_QUOTES);
$somatic = ($somatic == 'checked' ? 1 : 0);
$materials = htmlentities($conn->real_escape_string($_POST["materials"]),ENT_QUOTES);
$description = htmlentities($conn->real_escape_string($_POST["descriptions"]),ENT_QUOTES);

if(isset($_POST['edit'])){
	$edit =  htmlentities($conn->real_escape_string($_POST['edit']),ENT_QUOTES);
	$conn->query("DELETE FROM spells WHERE id = $edit");
	$conn->query("DELETE FROM classes_spells WHERE spell_id = $edit");
}

$conn->query("INSERT INTO spells (name,level,school_id,ritual,casting_time_num,casting_time_unit,range_num,range_unit,duration_concentration,duration_num,duration_unit,vocal,somatic,materials,description)
VALUES('$name',$level,$school_id,$ritual,$casting_time_num,'$casting_time_unit',$range_num,'$range_unit',$duration_concentration,$duration_num,'$duration_unit',$vocal,$somatic,'$materials','$description')");
    echo $conn->error;
$spell_id = $conn->insert_id;
$classes = $conn->query("SELECT * FROM classes ORDER BY id");
$classes = $classes->fetch_all(MYSQLI_NUM); 
for($i = 0;$i<count($classes);$i++){ 
    $class = htmlentities($conn->real_escape_string($_POST["class_".$classes[$i][1]]),ENT_QUOTES);
    if($class =="checked"){
       $conn->query("INSERT INTO classes_spells (class_id,spell_id)VALUES(".$classes[$i][0].",$spell_id)");
    }
}
header('Location: index.php');