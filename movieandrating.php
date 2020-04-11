<?php

if(!isset($index))
header('redirect: /');

$sql = "select id, name from movies;";
$res = $conn->query($sql);
$movie = null;

function show_movie() {
global $conn;
$ret = null;
$sql = "select * from movies where id=" . $_POST['movie'];
$m_res = $conn->query($sql);
while($row = $m_res->fetch_assoc()) {
$ret = $row;
}
return $ret;
}

function rate_movie() {
global $conn;
$sql = "update movies set avg_rate = (avg_rate + " . $_POST['rate'] . ") / (no_rate + 1), no_rate = no_rate + 1 where id = ". $_POST['movie'];
if(!$conn->query($sql)) {
die("Error updating movies ". $conn->error);
}
}

if(isset($_POST['movie_rate'])) {
rate_movie();
$movie = show_movie();
}

if(isset($_POST['movie_select'])) {
$movie = show_movie();
}
?>