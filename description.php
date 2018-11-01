<?php
use Classes\DescriptionService;

include $classdir . 'Classes/FileFilter.php';
include $classdir . 'Classes/FileService.php';
include $classdir . 'Classes/DescriptionService.php';

if (isset($_POST["directory"])) {
    $dir = $_POST['directory'];
    $mode = 'alt';
} else {
    $dir = "/share/exchange/";
    $mode = 'neu';
}

$ext_dir = (new FileService())->translateToExternalURL($dir);

$descService = new DescriptionService($dir);
$descriptions = $descService->loadDescription();
?>
<!DOCTYPE html>
<html>
<body>
	<div style='align-content: center; text-align: center;'>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<input name="directory" size="50" type="text" value="<?=$dir?>" /> <input
				type="submit" value="Bearbeiten" />
		</form>

		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">

<?php
if ($mode == "alt") {
    if (file_exists($dir)) { // files auslesen

        echo 'Description of ' . $dir . ' and ' . $ext_dir;
        $filter = new FileFilter();
        list ($all_files, $types) = $filter->getFilteredFileListofDirectory($dir);
        foreach ($all_files as $single_file) { // Ausgabeschleife
            $single_file_postformat = str_replace(".", "_", $single_file);
            if (isset($_POST["saveact"])) {
                if (empty($_POST[$single_file_postformat])) {
                    unset($descriptions[$single_file]);
                } else {
                    $descriptions[$single_file]['desc'] = $_POST[$single_file_postformat];
                }
            }

            if ($types[$single_file] == 'pic') {
                echo "<a href='http://" . $ext_dir . $single_file . "'><br />";
                echo "<img src='http://" . $ext_dir . "/thumbnails/" . $single_file . "'/></a><br />";
            } else {
                echo "<video src='" . $vid_def_short . $ext_dir . $single_file . "' width='400' poster='http://" . $ext_dir . "/thumbnails/" . $single_file . ".jpg' controls></video><br />";
            }
            echo $single_file . "<br />";
            $currentdescription = '';
            if (isset($descriptions[$single_file])) {
                $currentdescription = $descriptions[$single_file]['desc'];
            }
            echo "<input name='" . $single_file_postformat . "' size='50' type='text' value='" . $currentdescription . "' /><br /><br />";
        }
        if (isset($_POST["saveact"])) {
            print_r($descriptions);
            $descService->saveDescription($descriptions);
        }
    } else {
        echo $dir . "not found";
    }
}
?>
<input type="hidden" name="saveact" value="true">
<input type="hidden" name="directory" value="<?=$_POST['directory']?>">
<input type="submit" value="Speichern" />

	</div>
	</form>
</body>
</html>

