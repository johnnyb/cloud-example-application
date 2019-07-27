<?php
	function getReadOnlyConnection() {
		return new PDO(
			"pgsql:host=" .  getenv("RDS_HOSTNAME") . 
			";port=" . getenv("RDS_PORT") .
			";dbname=" . getenv("RDS_DB_NAME") .
			";user=" . getenv("RDS_USERNAME") .
			";password=" . getenv("RDS_PASSWORD")
		);
	}
	function getReadWriteConnection() {
		return new PDO(
			"pgsql:host=" .  getenv("RDS_HOSTNAME") . 
			";port=" . getenv("RDS_PORT") .
			";dbname=" . getenv("RDS_DB_NAME") .
			";user=" . getenv("RDS_USERNAME") .
			";password=" . getenv("RDS_PASSWORD")
		);
	}
	function getHeader() {
?>
<html>
	<head>
		<title>Guestbook App</title>
		<link rel="stylesheet" 
			href="guestbook.css" />
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
