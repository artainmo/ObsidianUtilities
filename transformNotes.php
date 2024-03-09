<?php
function pasteToClipboard($x) {
	echo '<script type="text/javascript">' .
			'navigator.clipboard.writeText(`' .
			$x .
		 '`);</script>';
}

if (isset($_POST['tagToTitle'])) {
	$newTitle = trim($_POST['tags']);
	$newTitle = str_replace("#", "", $newTitle);
	$newTitle = explode(' ', $newTitle);
	usort($newTitle, 'strnatcasecmp');
	$newTitle = implode(', ', $newTitle);
	pasteToClipboard($newTitle);
}

if (isset($_POST['processBlock'])) {
	$final = "";
	$_POST['block'] = preg_split("/(\n\n){1,}|(\r\n\r\n){1,}/", trim($_POST['block']));
	for($i=0; $i<count($_POST['block']); $i++) {
		$newBlock = $_POST['block'][$i];
		//$newBlock = str_replace(["*", "#", '_'], "", $newBlock);
		$newBlock = explode(PHP_EOL, $newBlock, 2);
		$titleLink = explode(':', $newBlock[0], 2);
		$titleLink = "[" . trim($titleLink[0]) . "](" . trim($titleLink[1]) . ")";
		$newBlock = $titleLink . "\n" . $newBlock[1];
		$final = $final . $newBlock . "\n\n";
	}
	pasteToClipboard($final);
}

if (isset($_POST['hideLink'])) {
	$newLink = $_POST['textLink'];
	//$newLink = str_replace(["*", "#"], "", $newLink);
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
		<textarea id="tagToTitle" name="tags" rows="6" cols="100" maxlength="500" required><?php if (isset($newTitle)) { echo $newTitle; } ?></textarea>
		<br><br>
		<button type="submit" name="tagToTitle">Submit</button>
		<input type="button" onclick="document.getElementById('tagToTitle').value = '';" value="Clear">
	</form>
</div>
<br>
<div>
	<form action="index.php" method="POST">
		<label><strong>Process blocks</strong>
			<br><em>(expects this notation: title: link\ntext)</em>
			<br><em>(will hide link in title and resolve double new line problem)</em>
			<br><em>(is able to handle multiple blocks and expects \n\n between them)</em>
			<br><em>(automatically pastes to clipboard)</em>
		</label>
		<br/><br/>
		<textarea id="processBlock" name="block" rows="18" cols="100" required><?php if (isset($final)) { echo $final; } ?></textarea>
		<br><br>
		<button type="submit" name="processBlock">Submit</button>
		<input type="button" onclick="document.getElementById('processBlock').value = '';" value="Clear">
	</form>
</div>
<br>
<div>
	<form action="index.php" method="POST">
		<label><strong>Hide link within title</strong>
			<br><em>(expects this notation: title: link)</em>
			<br><em>(transforms to this: [title](link)</em>
			<br><em>(automatically pastes to clipboard)</em>
		</label>
		<br/><br/>
		<textarea id="hideLink" name="textLink" rows="6" cols="100" maxlength="500" required><?php if (isset($newLink)) { echo $newLink; } ?></textarea>
		<br><br>
		<button type="submit" name="hideLink">Submit</button>
		<input type="button" onclick="document.getElementById('hideLink').value = '';" value="Clear">
	</form>
</div>

<body>
