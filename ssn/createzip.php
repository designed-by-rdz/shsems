<?php
include 'connector.php';
if (!isset($_GET['rel'])) {
    header("location:bridge.php?rel=evaluation");   
    return;
}
$filename = $_GET['rel'];
$dir = str_replace("/ssn","",__DIR__) . "/upl/$filename";
$zipFile = "$filename.zip";
$zip = new ZipArchive();
if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    $rootPath = realpath($dir);
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );
    foreach ($files as $name => $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }
    $zip->close();
}
if (ob_get_length()) ob_end_clean();
header('Content-Description: File Transfer');
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="documents-'.$filename.'.zip"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($zipFile));
flush();
$fp = fopen($zipFile, 'rb');
while (!feof($fp)) {
    echo fread($fp, 8192);
    flush();
}
fclose($fp);
unlink($zipFile);
$lsign = $_SESSION['uid'];
savelogs($connect,$lsign,"user downloaded $filename.zip",$datenow);
exit;
?>
