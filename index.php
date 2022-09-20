<?php 
function pasteToClipboard($x) {
	echo '<script type="text/javascript">' .
			'navigator.clipboard.writeText("' .
			$x .
		 '");</script>';
}

if (isset($_POST['tagToTitle'])) {
	$newTitle = trim($_POST['tags']);
	$newTitle = str_replace("#", "", $newTitle);
	$newTitle = explode(' ', $newTitle);
	usort($newTitle, 'strnatcasecmp');
	$newTitle = implode(', ', $newTitle);
	pasteToClipboard($newTitle);
}

if (isset($_POST['hideLink'])) {
	$newLink = $_POST['textLink'];
	$newLink = str_replace(["*", "#"], "", $newLink);
	$newLink = explode(':', $newLink, 2);
	$newLink = "[" . trim($newLink[0]) . "](" . trim($newLink[1]) . ")";
	pasteToClipboard($newLink);
}
?>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- responsive web disign -->
	<link rel="shortcut icon" href="#"> <!-- firefox get favicon.ico error -->
	<link rel="stylesheet" type="text/css">
	<title>Obsidian utilities</title>
</head>

<body>

<h1>Obsidian utilities</h1><br>
<div>
	<form action="index.php" method="POST">
		<label><strong>Transform tags to title</strong> 
			<br><em>(expects this notation: #tag1 #tag2)</em>
			<br><em>(automatically pastes to clipboard)</em>
		</label>
		<br/><br/>
		<textarea name="tags" rows="6" cols="100" maxlength="500" required><?php if (isset($newTitle)) { echo $newTitle; } ?></textarea>
		<br><br>
		<button type="submit" name="tagToTitle">Submit</button>
	</form>
</div>
<br>
<div>
	<form action="index.php" method="POST">
		<label><strong>Hide link within text</strong> 
			<br><em>(expects this notation: title: link)</em>
			<br><em>(automatically pastes to clipboard)</em>
		</label>
		<br/><br/>
		<textarea name="textLink" rows="6" cols="100" maxlength="500" required><?php if (isset($newLink)) { echo $newLink; } ?></textarea>
		<br><br>
		<button type="submit" name="hideLink">Submit</button>
	</form>
</div>

<body>
