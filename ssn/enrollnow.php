<?php
include 'connector.php';
if (!isset($_POST['e-strand'])) {
    header("location:bridge.php?rel=register");   
    return;
}
$elrn = $_POST['e-lrn'];
$edata = urlencode($_POST['e-strand'])."|".urlencode($_POST['e-grade']);
$esem = $data['sem'];
$eay = $data['ay'];
$lsign = $_SESSION['uid'];
$query = "INSERT INTO tblEnrollment (student_lrn,enrollment_data,academic_year,academic_sem,enrollment_date,enrollment_status) VALUES ('$elrn','$edata','$eay','$esem','$datenow','PENDING')";

$uploadDir = str_replace("/ssn","",__DIR__) . "/upl/$elrn$eay$esem/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
if (isset($_FILES['e-file']) && !empty($_FILES['e-file']['name'][0])) {
    $files = $_FILES['e-file'];
    for ($i = 0; $i < count($files['name']); $i++) {
        $fileName = basename($files['name'][$i]);
        $fileTmpPath = $files['tmp_name'][$i];
        $fileError = $files['error'][$i];
        if ($fileError === UPLOAD_ERR_OK) {
            $uniqueName = $i . ".pdf";
            $destination = $uploadDir . $uniqueName;
            if (move_uploaded_file($fileTmpPath, $destination)) {
                echo "✅ Uploaded: " . htmlspecialchars($fileName) . "<br>"; //remove this during live-test
            } else {
                echo "❌ Failed to move file: " . htmlspecialchars($fileName) . "<br>"; //remove this during live-test
            }
        } else {
            echo "⚠️ Error uploading: " . htmlspecialchars($fileName) . "<br>"; //remove this during live-test
        }
    }
} else {
    echo "No files were uploaded."; //remove this during live-test
}
mysqli_query($connect,$query);
savelogs($connect,$lsign,"user enrolled as grade $egrade $estrand",$datenow);
$_SESSION['msg'] = "Successfully sent enrollment request!";
$_SESSION['code'] = "info";
header("location:bridge.php?rel=index");

mysqli_close($connect);
?>