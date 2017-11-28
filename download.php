<?php require_once("_head.php"); ?>
		<div>
			<main class="mdl-layout__content" >
				<div class="mdl-grid center-items ">
					<div class="mdl-shadow--2dp mdl-cell " style="width: 100%;">
						<h1 class=" mdl-shadow--2dp " style="text-align: center;width: 100%;margin: 0px; ">
							Download de Arquivos
						</h1>
						<div class="" style="max-height: 600px; overflow: auto;">

							<?php 
								shell_exec("mkdir uploads/");
								$path     = './uploads/';
								$dir      = new RecursiveDirectoryIterator($path);
								$iterator = new RecursiveIteratorIterator($dir);

								$filterIterator = new RegexIterator(
									$iterator,
									'/^.+\.php$/i',
									RecursiveRegexIterator::GET_MATCH
								);
								foreach ($iterator as $item) {
									// Verifica se é um arquivo
										// echo '<script>alert("asdasdasdsd");</script>';
									if ($item->isFile()) {
										// echo "<br/>";
										// echo "<br> err ";
										// $path = explode("/", $item);
										// echo $path[sizeof($path)-1];
										// echo explode("/", $item)[-1];
										// echo "<br>";
										$path = realpath($item);
										// echo $path;
										// break;
										$name = basename($path);


										echo ' 
											<div class="mdl-grid mdl-shadow--2dp" style="margin: 10px;">
												<div class="mdl-cell mdl-cell--1-col-desktop mdl-cell--1-col-phone mdl-cell--1-col-tablet" style="margin-top: 20px;">
													<a href="filedown.php?file='.$path.'"  class="mdl-button mdl-js-button mdl-button--colored mdl-button--fab mdl-button--mini-fab"><i class="material-icons">cloud_download</i></a>
												</div>
												<div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--3-col-phone mdl-cell--5-col-tablet" style="margin-top: 20px;">
												'.$name.'
												</div>
											</div>
										 ';

									}
								}


							 ?>

						</div>
					</div>
			    </div>
				<div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
					<div class="mdl-snackbar__text"></div>
					<button class="mdl-snackbar__action" type="button"></button>
				</div>
				<div id="erroalert" class="mdl-js-snackbar mdl-snackbar">
					<div class="mdl-snackbar__text"></div>
					<button class="mdl-snackbar__action" type="button"></button>
				</div>
			<?php require_once("_footer.php"); ?>
			</main>

		</div>
	</div>




<script>

</script>











<script>



	
/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	// var file = _("file1").files[0];


	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	var numfiles = _("file1").files.length;
	if (numfiles>20){
		alert("É permitido o envio de no maximo 20 Arquivos!");
	}
	else if (numfiles<1) {
		var data = {message: 'Erro Nenhum Arquivo Selecionado!'};
	 	_("demo-toast-example").MaterialSnackbar.showSnackbar(data);
		
	}
	else{

		for (var i = 0; i < numfiles; i++) {
			formdata.append('file1[]', _("file1").files[i]);
		}

		// formdata.append("file1", file);
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		ajax.open("POST", "fileUpload.php");
		_('porcent').style.display = "";
		_('p1').style.display = "";
		// $('p1').data('style', 'display: all;');
		// _("p1").data('class', ' mdl-progress mdl-js-progress');
		ajax.send(formdata);
	}
}
function progressHandler(event){
	// _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("p1").MaterialProgress.setProgress(percent);
	_("porcent").innerHTML = Math.round(percent)+"%";
	// _("progressBar").value = Math.round(percent);
	// _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	var texto = event.target.responseText;
	// alert(texto[0]);
	
	// alert(texto);
	// _("status").innerHTML = data;
	// _("progressBar").value = 0;
	_("p1").MaterialProgress.setProgress(0);
	 if (texto[0] != 'E' && texto != '') {
  		// _("demo-toast-example").MaterialSnackbar.showSnackbar(data);
  		var numfiles = _("file1").files.length;
  		// alert(numfiles);
  		if (numfiles > 1){

		 var dtt =  {message: 'Arquivos Enviados Com Sussesso! '};
  		}
  		else{
		 var dtt =  {message: 'Arquivo Enviado Com Sussesso! '};

  		}
		 _('erroalert').MaterialSnackbar.showSnackbar(dtt);
	 }
	 else{

	 	// alert("asdsd");
	 	var data = {message: 'Erro Nenhum Arquivo Selecionado!'};
	 	_("demo-toast-example").MaterialSnackbar.showSnackbar(data);

	 }
	_("upload_form").reset();
	_("porcent").innerHTML = "";
	_('porcent').style.display = "none";
	_('p1').style.display = "none";


}
function errorHandler(event){
	// _("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}






</script>
</body>
</html>
