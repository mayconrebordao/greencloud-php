<?php 
$path = $_GET['file'];
// $path = "wampserver3.1.0_x64.exe";
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($path).'"');
header('Expires: 0');
header('Cache-Control: public');
header('Pragma: public');
header('Content-Length: ' . filesize($path));


$fp = fopen($path, "r");
fpassthru($fp);
fclose($fp);
// unlink($path);
// header("Location: download.php?listar_arquivos=true");
exit;


// header('Content-Description: File Transfer');
// header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename="'.basename($path).'"');
// header('Expires: 0');
// header('Cache-Control: must-revalidate');
// header('Pragma: public');
// header('Content-Length: ' . filesize($path));
// readfile($path);
// exit;
 ?>

