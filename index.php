<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style type="text/css">
table.center {
	width: 900px;
	margin-left: auto;
	margin-right: auto;
}

td.basecell {
	width: 450px;
}

div.tile {
	padding-top: 20px;
	padding-bottom: 40px;
	text-align: center;
}

a.bye {
    font-size: 44px;
}

div.filename {
   font-size: 11px;
   color: #cccccc;
}

div.description {
   font-size: 16px;
}

video {
max-height: 400px;
}

a {
	color: #cccccc;
}

body {
font-family: Tahoma, Geneva, sans-serif;
}
</style>

</head>
<body>
	<div style="text-align: center;">
		<h1 id="top"><?php
use Classes\DescriptionService;

echo $_SERVER['REQUEST_URI'];
?></h1>
		<a href="../">Mehr Fotos ansehen</a><br /> <br />
		<table class="center">
<?php

include 'Classes/DescriptionService.php';
include 'Classes/FileFilter.php';

$descService = new DescriptionService(getcwd());
$descriptions = $descService->loadDescription();

$filter = new FileFilter();

// Dateien bestimmen
list ($all_files, $types) = $filter->getFilteredFileListofDirectory(getcwd());
// aktuellen Ordner auslesen

foreach ($all_files as $index => $datei) { // Ausgabeschleife
    $description = '';
    if (ISSET($descriptions[$datei])) {
        $description = $descriptions[$datei]['desc'];
    }

    if ($index % 2 == 0)
        echo '<tr>'; // Zeilenanfang schreiben

    if (strcasecmp($types[$datei], 'pic') == 0) {
        echo '<td class="basecell"><div class="tile"><a href="' . $datei . '" ><img src="thumbnails/' . $datei . '"></a><br />';
        echo '<div class="filename">' . $datei . '</div><div class="description">' . $description . "</div></div></td>"; // Ausgabe Einzeldatei
    } else {
        echo '<td class="basecell"><div class="tile"><video src="' . $_SERVER['REQUEST_URI'] . '/' . $datei . '" width="400" poster="thumbnails/' . $datei . '.jpg" controls></video><br />';
        echo '<div class="filename">' . $datei . '</div><div class="description">' . $description . "</div></div></td>"; // Ausgabe Einzeldatei
    }

    if ($index + 1 == count($all_files)) {
        echo '<td><br /></td></tr>'; // Zeilenende bei einer ungerade Zahl von Dateien
    } elseif ($index % 2 == 1)
        echo '</tr>'; // normales Zeilenende schreiben
}

?>

</table>
<a class="bye" href="../">Mehr Fotos ansehen</a>
<br/>
<br/>
<a href="#top">nach oben</a>
	</div>
</body>
