<?php
	include("common.php");

	$tmpname = $_FILES["imagefile"]["tmp_name"];
	if($tmpname) {
		$has_img = true;
	} else {
		$has_img = false;
	}

	$dbh = getReadWriteConnection();
	$stmt = $dbh->prepare(
		"insert into gb_entries" .
		"(name, email, message, has_img)" .
		"values " .
		"(:name, :email, :message, :has_img)"
	);
	$stmt->bindValue(
		":name", 
		$_POST["name"]
	);
	$stmt->bindValue(
		":email", 
		$_POST["email"]
	);
	$stmt->bindValue(
		":message", 
		$_POST["message"]
	);
	$stmt->bindValue(
		":has_img",
		$has_img,
		PDO::PARAM_BOOL
	);
	$stmt->execute();

	if($has_img) {
		$last_id = $dbh->lastInsertId(
			"gb_entries_id_seq"
		);
		$s3_creds = getAWSCredentials();
		$s3_base = "s3://" . getS3BucketName() . "/";
		$s3_file = $s3_base . $last_id . ".jpg";
		$s3_creds = getAWSCredentials();
		$cmd = "$s3_creds aws s3 cp $tmpname $s3_file";
		exec($cmd);
	}
	
	header("Location: list.php");
?>
