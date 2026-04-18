<?php
include('func.php');
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['confirm_payment'])) {
    $app = $_SESSION['temp_app'];
    $pid = $_SESSION['pid'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $gender = $_SESSION['gender'];
    $email = $_SESSION['email'];
    $contact = $_SESSION['contact'];
    
    $doctor = $app['doctor'];
    $docFees = $app['docFees'];
    $appdate = $app['appdate'];
    $apptime = $app['apptime'];

    // Sahi sequence mein insert query (13 columns)
    $query_text = "INSERT INTO appointmenttb (pid, fname, lname, gender, email, contact, doctor, docFees, appdate, apptime, userStatus, doctorStatus, payment_status) 
                   VALUES ('$pid', '$fname', '$lname', '$gender', '$email', '$contact', '$doctor', '$docFees', '$appdate', '$apptime', '1', '1', 'Paid')";

    $query = mysqli_query($con, $query_text);

    if($query) {
        $last_id = mysqli_insert_id($con);
        unset($_SESSION['temp_app']);
        echo "<script>alert('Payment Successful!'); window.location.href='booking_receipt.php?id=$last_id';</script>";
    } else {
        // Yeh line aapko batayegi ki asli error kya hai
        echo "Database Error: " . mysqli_error($con);
    }
}
?>