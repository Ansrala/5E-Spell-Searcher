<?php
require_once( __DIR__ . "/connect_database.php");
global $conn;
global $database_name;
//$conn->query("DROP DATABASE $database_name");
//$conn->query("CREATE DATABASE IF NOT EXISTS $database_name");
//$conn->select_db($database_name);
$conn->query("CREATE TABLE spells(
id int(11) NULL AUTO_INCREMENT,
name varchar(50),
level int(1),
school_id int(2),
ritual int(1),
casting_time_num int(11),
casting_time_unit varchar(20),
range_num int(11),
range_unit varchar(20),
duration_concentration int(1),
duration_num int(11),
duration_unit varchar(20),
vocal int(1),
somatic int(1),
materials text,
description text,
PRIMARY KEY (id)
)ENGINE=InnoDB");

$conn->query("CREATE TABLE classes(
id int(11) NULL AUTO_INCREMENT,
name varchar(20),
PRIMARY KEY (id)
)ENGINE=InnoDB");

$conn->query("CREATE TABLE classes_spells(
id int(11) NULL AUTO_INCREMENT,
class_id int(11),
spell_id int(11),
PRIMARY KEY (id)
)ENGINE=InnoDB");
$conn->query("CREATE TABLE schools(
id int(11) NULL AUTO_INCREMENT,
name varchar(20),
PRIMARY KEY (id)
)ENGINE=InnoDB");


$conn->query("INSERT INTO classes (name) VALUES('Bard')");
$conn->query("INSERT INTO classes (name) VALUES('Cleric')");
$conn->query("INSERT INTO classes (name) VALUES('Druid')");
$conn->query("INSERT INTO classes (name) VALUES('Paladin')");
$conn->query("INSERT INTO classes (name) VALUES('Ranger')");
$conn->query("INSERT INTO classes (name) VALUES('Sorcerer')");
$conn->query("INSERT INTO classes (name) VALUES('Warlock')");
$conn->query("INSERT INTO classes (name) VALUES('Wizard')");

$conn->query("INSERT INTO schools (name) VALUES('Abjuration')");
$conn->query("INSERT INTO schools (name) VALUES('Conjuration')");
$conn->query("INSERT INTO schools (name) VALUES('Divination')");
$conn->query("INSERT INTO schools (name) VALUES('Enchantment')");
$conn->query("INSERT INTO schools (name) VALUES('Evocation')");
$conn->query("INSERT INTO schools (name) VALUES('Illusion')");
$conn->query("INSERT INTO schools (name) VALUES('Necromancy')");
$conn->query("INSERT INTO schools (name) VALUES('Transmutation')");

echo "DONE";