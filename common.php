<?php

	function getCache() {
		$conn = new Memcached();
		$conn->addServer("localhost", 11211);
		return $conn;
	}

	function getS3BucketName() {
		return "BUCKET";
	}

	function getS3Region() {
		return "ca-central-1";
	}

	function getAWSCredentials() {
		$s3ak = "MYACCESSKEY";
		$s3sk = "MYSECRETKEY";
		$s3ak_env = "AWS_ACCESS_KEY_ID=$s3ak";
		$s3sk_env = "AWS_SECRET_ACCESS_KEY=$s3sk";
		$creds = "$s3ak_env $s3sk_env";
		return $creds;
	}


	function getReadOnlyConnection() {
		$serverlist = array(
			"DB.SLAVE.PRIVATE.IP",
			"DB.SLAVE2.PRIVATE.IP",
			"DB.SLAVE3.PRIVATE.IP"
		);
		$idx = array_rand($serverlist);

		$host = $serverlist[$idx];

		return new PDO("pgsql:host=" . $host . ";" .
			"port=5432;dbname=guestbookapp;" .
			"user=gbuser;password=mypassword"
		);
	}
	function getReadWriteConnection() {
		return new PDO("pgsql:host=DB.MASTER.PRIVATE.IP;" .
			"port=5432;dbname=guestbookapp;" .
			"user=gbuser;password=mypassword"
		);
	}
	function getHeader() {
?>
<html>
	<head>
		<title>Guestbook App</title>
		<link rel="stylesheet" 
			href="http://xyzabc.cloudfront.net/guestbook.css" />
	</head>
	<body>
		<h1>Guestbook App</h1>
		<div id="main">
<?php
	}
	function getFooter() {
?>
		</div>
	</body>
</html>
<?php
	}
	function h($str) {
		return htmlspecialchars($str);
	}
?>
