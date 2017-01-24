

<?php
	require_once "dependencies/PHPExcel.php";
	require_once "database.php";
	$target_dir = "uploads/";
	$target_file = $target_dir.basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if($fileType != "xlsx") {
    	echo "Sorry only excel files allowed";
    	$uploadOk = 0;
	}
	if ($uploadOk == 0) {
    	echo "Sorry, your file was not uploaded.";
	} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
	$path = $target_file;
	$reader = PHPExcel_IOFactory::createReaderForFile($path);
	$file = $reader->load($path);
	$worksheet = $file->getActiveSheet();
	$lastRow = $worksheet->getHighestRow();

	$array = $worksheet->toArray("", true, false, true);
	$increment = 1;
	if($_POST["overwrite"] == true)
	{
		DB::query("TRUNCATE names");
	}
	foreach($array as $row)
	{	
		if($increment > 1)
		{
			DB::insert("names", array("Firstname" => $row["A"], "Surname" => $row["B"], "Nickname" => $row["C"], "Yeargroup" => $row["D"], "Location" => "In House"));
		}
		
		$increment++;
	}
	unlink($path);
	header("location:../mainpage.php");


?>