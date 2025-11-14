<?php 
    $ADDRESS = 'localhost';
    $USERNAME = 'root';
    $PASSWORD = '';
    $DATABASE = 'shsems';
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = "uiccapstone";
    date_default_timezone_set('Asia/Manila');
    session_start();
    $connect = mysqli_connect($ADDRESS,$USERNAME,$PASSWORD,$DATABASE);
    $data = array();
    $count = 0;
    $getdata = mysqli_query($connect,"SELECT * FROM tblData");
    while ($dataa = mysqli_fetch_array($getdata)) {
        $data[$dataa['dvalue']] = $dataa['dkey'];
    }
    $datenow = date("Y-m-d H:i");
    $current = "academic_year = '".$data['ay']."' AND academic_sem = '".$data['sem']."'";

    function savelogs($connect,$user,$msg,$date) {
        mysqli_query($connect,"INSERT INTO tblLogs (log_user,log_action,log_date) VALUES ('$user','$msg','$date')");
    }

    function generateRandom() {
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = '0123456789';
        for ($i=0; $i < 8; $i++) { 
            $randomChar .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $randomChar;
    }
?>
