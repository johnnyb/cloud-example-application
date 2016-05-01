<?php
	include("common.php");
	getHeader();
?>
<h2>New Guestbook Entry</h2>
<form enctype="multipart/form-data" action="create.php" method="POST">
	<label>Name</label>
	<input type="text" name="name" />

	<label>Email</label>
	<input type="text" name="email" />

	<label>Message</label>
	<textarea name="message"></textarea>

	<label>Image (JPEG)</label>
	<input type="file" name="imagefile" />

	<input type="submit" />
</form>
<?php
	getFooter();
?>
