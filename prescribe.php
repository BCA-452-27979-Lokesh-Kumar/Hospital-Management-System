<!DOCTYPE html>
<?php 
include('func1.php');
$pid=''; $ID=''; $appdate=''; $apptime=''; $fname = ''; $lname= '';
$doctor = $_SESSION['dname'];

if(isset($_GET['pid']) && isset($_GET['ID']) && isset($_GET['appdate']) && isset($_GET['apptime']) && isset($_GET['fname']) && isset($_GET['lname'])) {
  $pid = $_GET['pid'];
  $ID = $_GET['ID'];
  $fname = $_GET['fname'];
  $lname = $_GET['lname'];
  $appdate = $_GET['appdate'];
  $apptime = $_GET['apptime'];
}

if(isset($_POST['prescribe'])){
  $disease = $_POST['disease'];
  $allergy = $_POST['allergy'];
  $prescription = $_POST['prescription'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $pid = $_POST['pid'];
  $ID = $_POST['ID'];
  $appdate = $_POST['appdate'];
  $apptime = $_POST['apptime'];
  
  $query=mysqli_query($con,"insert into prestb(doctor,pid,ID,fname,lname,appdate,apptime,disease,allergy,prescription) values ('$doctor','$pid','$ID','$fname','$lname','$appdate','$apptime','$disease','$allergy','$prescription')");
  if($query) {
    echo "<script>alert('Prescribed successfully!'); window.location.href='doctor-panel.php';</script>";
  }
  else {
    echo "<script>alert('Unable to process your request. Try again!');</script>";
  }
}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Prescribe Patient | CarePlus</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body { font-family: 'IBM Plex Sans', sans-serif; background-color: #f8fafc; }
        .bg-gradient-custom { background: linear-gradient(to right, #00a896, #02c39a); }
        .text-custom { color: #00a896; }
        .form-control:focus { border-color: #02c39a; box-shadow: 0 0 0 0.2rem rgba(2, 195, 154, 0.25); }
    </style>
</head>

<body class="pt-24">

    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-custom fixed-top shadow-lg">
        <div class="container">
            <a class="navbar-brand font-bold" href="doctor-panel.php"><i class="fa fa-user-md mr-2"></i> CarePlus Hospitals</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link font-semibold text-white" href="doctor-panel.php"><i class="fa fa-arrow-left mr-1"></i> Back to Panel</a>
                    </li>
                    <li class="nav-item ml-4">
                        <a class="nav-link font-semibold text-white" href="logout1.php"><i class="fa fa-sign-out mr-1"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-teal-50">
            
            <div class="bg-teal-50 p-6 border-b border-teal-100 flex flex-wrap justify-between items-center">
                <div>
                    <h5 class="text-sm font-bold text-teal-600 uppercase tracking-widest">Prescribing Patient</h5>
                    <h2 class="text-2xl font-bold text-gray-800"><?php echo $fname . " " . $lname; ?></h2>
                </div>
                <div class="text-right text-sm text-gray-500">
                    <p><strong>Appt ID:</strong> #<?php echo $ID; ?></p>
                    <p><strong>Date:</strong> <?php echo $appdate; ?></p>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <form method="post" action="prescribe.php" class="space-y-8">
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-start">
                        <label class="font-bold text-gray-700 pt-2">Disease / Diagnosis:</label>
                        <div class="md:col-span-3">
                            <textarea name="disease" rows="3" class="form-control rounded-xl p-4 bg-gray-50 border-gray-200" placeholder="Enter patient symptoms or diagnosed disease..." required></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-start">
                        <label class="font-bold text-gray-700 pt-2">Known Allergies:</label>
                        <div class="md:col-span-3">
                            <textarea name="allergy" rows="3" class="form-control rounded-xl p-4 bg-gray-50 border-gray-200" placeholder="Enter any drug or food allergies (write 'None' if none)..." required></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-start">
                        <label class="font-bold text-gray-700 pt-2">Prescription / Medication:</label>
                        <div class="md:col-span-3">
                            <textarea name="prescription" rows="6" class="form-control rounded-xl p-4 bg-gray-50 border-gray-200 font-mono text-sm" placeholder="Rx: &#10;1. Medicine Name - Dosage - Timing" required></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="fname" value="<?php echo $fname ?>" />
                    <input type="hidden" name="lname" value="<?php echo $lname ?>" />
                    <input type="hidden" name="appdate" value="<?php echo $appdate ?>" />
                    <input type="hidden" name="apptime" value="<?php echo $apptime ?>" />
                    <input type="hidden" name="pid" value="<?php echo $pid ?>" />
                    <input type="hidden" name="ID" value="<?php echo $ID ?>" />

                    <div class="flex justify-center pt-6">
                        <button type="submit" name="prescribe" class="bg-gradient-custom text-white font-bold py-4 px-16 rounded-full shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition duration-300 flex items-center">
                            Finish & Save Prescription <i class="fa fa-check-circle ml-3"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
        
        <p class="text-center text-gray-400 text-xs mt-8 italic">
            <i class="fa fa-lock mr-1"></i> This information is securely stored in the patient's medical history.
        </p>
    </div>

</body>
</html>