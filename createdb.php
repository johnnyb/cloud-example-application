<?php
	include("common.php");
	$dbh = getReadWriteConnection();
	$stmt = $dbh->prepare("create table gb_entries(id serial primary key, name text, email text, message text, created_at timestamp, has_img bool default false)");
	$stmt->execute();
?>
