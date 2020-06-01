<?php

function RemoveInstallationFiles(){

	//Remove containing files
	$filepaths = glob('../install/*' );
	foreach($filepaths as $file) {
		unlink($file);
	}

	//Remove folder
	rmdir("../install");
}

?>
