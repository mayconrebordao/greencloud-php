<?php
shell_exec('mkdir uploads/');
shell_exec('chmod 777 uploads/');




function dirSize($directory) {
    $size = 0;
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
        $size+=$file->getSize();
    }
    return $size;
} 



function showMessage($data){
	echo '
		<div id="message" class="mdl-js-snackbar mdl-snackbar">
		  <div class="mdl-snackbar__text"></div>
		  <button class="mdl-snackbar__action" type="button"></button>
		</div>


	<script >
		 var data =  {message: \'$data\'	};
	  	_("message").MaterialSnackbar.showSnackbar(data);
	    </script>';
}

$size = dirSize("uploads/");

if ($size < 1900000000){


	for ($i=0, $n = count($_FILES['file1']); $i < $n ; $i++) { 
		# code...
		$fileName = date ("Y-m-d_h:m")."_".$_FILES["file1"]["name"][$i]; // The file name
		$fileTmpLoc = $_FILES["file1"]["tmp_name"][$i]; // File in the PHP tmp folder
		$fileType = $_FILES["file1"]["type"][$i]; // The type of file it is
		$fileSize = $_FILES["file1"]["size"][$i]; // File size in bytes
		$fileErrorMsg = $_FILES["file1"]["error"][$i]; // 0 for false... and 1 for true
		if (!$fileTmpLoc) { // if file not chosen
		    echo "ERROR: Please browse for a file before clicking the upload button.";
		    exit();
		}


		if(is_file($_FILES['file1']['tmp_name'][$i])){
			if(move_uploaded_file($fileTmpLoc, "uploads/$fileName")){
			    showMessage("$fileName upload is complete");
			} else {
			    echo "move_uploaded_file function failed";
			    showMessage("Erro no Upload do Arquivo!!");
			}
		} 
		
	}
	shell_exec('chmod 777 -R uploads/*');
}


?>
