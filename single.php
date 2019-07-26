<?php
	include("common.php");
	$dbh = getReadOnlyConnection();
	$stmt = $dbh->prepare(
		"select * from gb_entries" .
		" where id = :id"
	);
	$stmt->bindValue(
		":id", 
		$_GET["id"], 
		PDO::PARAM_INT
	);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$row = $result[0];
	getHeader();
?>
<p>
	<a href="list.php">Go Back</a>
</p>

<label>Name</label> 
	<?php echo h($row["name"]) ?>
<label>Email</label> 
	<?php echo h($row["email"]) ?>
<label>Message</label> 
	<?php echo h($row["message"]) ?>
<?php
	if($row["has_img"]) {
		$s3_url = "s3://" . getS3BucketName() .
		          "/" . $row["id"] . ".jpg";
		$s3_region = getS3Region();
		$s3_creds = getAWSCredentials();
		$seconds = 300;

		$cmd = "$s3_creds aws s3 presign $s3_url" .
		       " --region $s3_region" .
		       " --expires_in $seconds";
		exec($cmd, $cmd_output);
		$url = $cmd_output[0];
		
?>
		<label>Image</label>
		<img src="<?php echo h($url) ?>" />
<?php
	}

	getFooter();
?>
