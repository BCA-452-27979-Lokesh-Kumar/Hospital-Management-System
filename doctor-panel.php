<!DOCTYPE html>
<?php 
include('func1.php');
$con=mysqli_connect("localhost","root","","myhmsdb");
$doctor = $_SESSION['dname'];

if(isset($_GET['cancel'])) {
    $query=mysqli_query($con,"update appointmenttb set doctorStatus='0' where ID = '".$_GET['ID']."'");
    if($query) {
      echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Doctor Panel | CarePlus</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body { font-family: 'IBM Plex Sans', sans-serif; background-color: #f8fafc; }
        .bg-gradient-custom { background: linear-gradient(to right, #00a896, #02c39a); }
        .text-custom { color: #00a896; }
        .border-custom { border-color: #02c39a; }
        
        .list-group-item.active {
            background-color: #00a896 !important;
            border-color: #00a896 !important;
            font-weight: 600;
        }
        
        .nav-link:hover { opacity: 0.8; }
        
        /* Table Styling */
        .table thead th {
            background-color: #f1f5f9;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #64748b;
            border: none;
        }
        
        .card-custom {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
    </style>
</head>

<body class="pt-20">

    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-custom fixed-top shadow-lg">
        <div class="container">
            <a class="navbar-brand font-bold text-xl" href="#">
                <i class="fa fa-user-md mr-2"></i> CarePlus <span class="font-light">Doctors</span>
            </a>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link font-semibold text-white" href="logout1.php">
                            <i class="fa fa-sign-out mr-1"></i> Logout
                        </a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
                    <input class="form-control mr-sm-2 rounded-pill border-0 px-4" type="text" placeholder="Search Patient Contact" name="contact">
                    <button type="submit" name="search_submit" class="bg-white text-teal-600 font-bold px-4 py-2 rounded-pill hover:bg-teal-50 transition">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid mx-auto px-6 mt-10">
        <div class="flex flex-col md:flex-row gap-8">
            
            <div class="md:w-1/5">
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fa fa-user-md text-3xl text-custom"></i>
                        </div>
                        <h4 class="font-bold text-gray-800">Welcome</h4>
                        <p class="text-custom font-semibold">Dr. <?php echo $doctor ?></p>
                    </div>

                    <div class="list-group list-group-flush border-0" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active rounded-lg mb-2" href="#list-dash" data-toggle="list" role="tab">
                            <i class="fa fa-th-large mr-3"></i> Dashboard
                        </a>
                        <a class="list-group-item list-group-item-action rounded-lg mb-2" href="#list-app" id="list-app-list" data-toggle="list" role="tab">
                            <i class="fa fa-calendar-check-o mr-3"></i> Appointments
                        </a>
                        <a class="list-group-item list-group-item-action rounded-lg mb-2" href="#list-pres" id="list-pres-list" data-toggle="list" role="tab">
                            <i class="fa fa-file-text-o mr-3"></i> Prescriptions
                        </a>
                        <a class="list-group-item list-group-item-action border-0 rounded-lg py-3 font-bold text-red-500 hover:bg-red-50 mt-6 transition" href="logout.php">
                          <i class="fa fa-power-off mr-3"></i> Logout
                      </a>
                    </div>
                </div>
            </div>

            <div class="md:w-4/5">
                <div class="tab-content" id="nav-tabContent">
                    
                    <div class="tab-pane fade show active" id="list-dash" role="tabpanel">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="card-custom p-8 text-center cursor-pointer hover:bg-teal-50 transition border-b-4 border-custom" onclick="document.querySelector('#list-app-list').click()">
                                <i class="fa fa-list-alt text-4xl text-custom mb-4"></i>
                                <h4 class="text-xl font-bold text-gray-700">View Appointments</h4>
                                <p class="text-gray-400 text-sm mt-2">Manage your scheduled patient visits</p>
                            </div>
                            <div class="card-custom p-8 text-center cursor-pointer hover:bg-teal-50 transition border-b-4 border-custom" onclick="document.querySelector('#list-pres-list').click()">
                                <i class="fa fa-pencil-square-o text-4xl text-custom mb-4"></i>
                                <h4 class="text-xl font-bold text-gray-700">Prescription Records</h4>
                                <p class="text-gray-400 text-sm mt-2">View history of prescribed medicines</p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-app" role="tabpanel">
                        <div class="card-custom overflow-hidden">
                            <div class="p-4 bg-gray-50 border-b flex justify-between items-center">
                                <h5 class="font-bold text-gray-700 m-0">Patient Appointment List</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Patient ID</th>
                                            <th>Appt. ID</th>
                                            <th>Patient Name</th>
                                            <th>Gender</th>
                                            <th>Contact</th>
                                            <th>Date & Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        <?php 
                                            $result = mysqli_query($con, "select pid,ID,fname,lname,gender,email,contact,appdate,apptime,userStatus,doctorStatus from appointmenttb where doctor='$doctor';");
                                            while ($row = mysqli_fetch_array($result)){
                                        ?>
                                        <tr>
                                            <td class="font-medium text-gray-500">#<?php echo $row['pid'];?></td>
                                            <td class="font-medium text-gray-500"><?php echo $row['ID'];?></td>
                                            <td class="font-bold text-gray-800"><?php echo $row['fname']." ".$row['lname'];?></td>
                                            <td><?php echo $row['gender'];?></td>
                                            <td><?php echo $row['contact'];?></td>
                                            <td><?php echo $row['appdate']." | ".$row['apptime'];?></td>
                                            <td>
                                                <?php 
                                                    if(($row['userStatus']==1) && ($row['doctorStatus']==1)) echo "<span class='text-green-500 font-bold'>Active</span>";
                                                    else if(($row['userStatus']==0) && ($row['doctorStatus']==1)) echo "<span class='text-orange-500 font-bold'>Cancelled by Patient</span>";
                                                    else echo "<span class='text-red-500 font-bold'>Cancelled by You</span>";
                                                ?>
                                            </td>
                                            <td class="flex gap-2">
                                                <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { ?>
                                                    <a href="doctor-panel.php?ID=<?php echo $row['ID']?>&cancel=update" onClick="return confirm('Cancel this appointment?')" class="bg-red-50 text-red-600 px-3 py-1 rounded-lg text-xs font-bold hover:bg-red-600 hover:text-white transition">Cancel</a>
                                                    <a href="prescribe.php?pid=<?php echo $row['pid']?>&ID=<?php echo $row['ID']?>&fname=<?php echo $row['fname']?>&lname=<?php echo $row['lname']?>&appdate=<?php echo $row['appdate']?>&apptime=<?php echo $row['apptime']?>" class="bg-teal-50 text-teal-600 px-3 py-1 rounded-lg text-xs font-bold hover:bg-[#00a896] hover:text-white transition">Prescribe</a>
                                                <?php } else { echo "<span class='text-gray-400'>Closed</span>"; } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-pres" role="tabpanel">
                        <div class="card-custom overflow-hidden">
                            <div class="p-4 bg-gray-50 border-b">
                                <h5 class="font-bold text-gray-700 m-0">Prescription History</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Patient ID</th>
                                            <th>Patient Name</th>
                                            <th>Appt. ID</th>
                                            <th>Date</th>
                                            <th>Disease</th>
                                            <th>Allergy</th>
                                            <th>Prescription</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        <?php 
                                            $result = mysqli_query($con, "select pid,fname,lname,ID,appdate,apptime,disease,allergy,prescription from prestb where doctor='$doctor';");
                                            while ($row = mysqli_fetch_array($result)){
                                        ?>
                                        <tr>
                                            <td>#<?php echo $row['pid'];?></td>
                                            <td class="font-bold text-gray-800"><?php echo $row['fname']." ".$row['lname'];?></td>
                                            <td><?php echo $row['ID'];?></td>
                                            <td><?php echo $row['appdate'];?></td>
                                            <td><span class="bg-red-50 text-red-600 px-2 py-1 rounded text-xs font-bold"><?php echo $row['disease'];?></span></td>
                                            <td><?php echo $row['allergy'];?></td>
                                            <td class="max-w-xs truncate" title="<?php echo $row['prescription'];?>"><?php echo $row['prescription'];?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>
</html>