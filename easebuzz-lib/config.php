<?php
session_start();
date_default_timezone_set('Asia/Kolkata');

    define('BASE_URL', 'https://maxemocapital.com/maxemolms/');
    define('LOANID_PRE','LF');
    
    define('HOSTNAME', 'localhost');
    define('USERNAME', 'maxe_lms_db');
    define('PASSWORD', 'maxemo@!12345');
    define('DBANAME', 'maxe_lms_db');
    
    // Test
//    define('MERCHANT_KEY', '2PBP7IABZ2');
//    define('SALT', 'DAH88E3UWQ');
//    define('ENV', 'test');
    
    // Live
    define('MERCHANT_KEY', 'VPGJ1ZK4UZ');
    define('SALT', 'BBTX2XUUMH');
    define('ENV', 'test');
$conn=mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DBANAME);
if(!$conn){ echo 'Some error occurred Please ty again.'; exit; }
?>
