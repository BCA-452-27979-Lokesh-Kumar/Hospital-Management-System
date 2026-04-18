<!DOCTYPE html>
<?php
include('func.php');
include('newfunc.php');
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

// Session Check (Safety ke liye)
if (!isset($_SESSION['pid'])) {
    header("Location:index.php");
}

$pid = $_SESSION['pid'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$fname = $_SESSION['fname'];
$gender = $_SESSION['gender'];
$lname = $_SESSION['lname'];
$contact = $_SESSION['contact'];

// Replace the old if(isset($_POST['app-submit'])) block with this:
if (isset($_POST['pay_now'])) {
    // Basic validation to ensure fields aren't empty before redirecting
    if (!empty($_POST['doctor']) && !empty($_POST['appdate']) && !empty($_POST['apptime'])) {

        // Store form data in session to use on payment.php
        $_SESSION['temp_app'] = [
            'doctor'  => $_POST['doctor'],
            'docFees' => $_POST['docFees'],
            'appdate' => $_POST['appdate'],
            'apptime' => $_POST['apptime']
        ];

        // Redirect to the payment page
        header("Location: payment.php");
        exit(); // Always use exit after header redirect
    } else {
        echo "<script>alert('Please fill all the details before proceeding to payment.');</script>";
    }
}








// Appointment Booking Logic
// if (isset($_POST['app-submit'])) {
//   $doctor = $_POST['doctor'];
//   $docFees = $_POST['docFees'];
//   $appdate = $_POST['appdate'];
//   $apptime = $_POST['apptime'];
//   $cur_date = date("Y-m-d");
//   date_default_timezone_set('Asia/Kolkata');
//   $cur_time = date("H:i:s");
//   $apptime1 = strtotime($apptime);
//   $appdate1 = strtotime($appdate);

//   if (date("Y-m-d", $appdate1) >= $cur_date) {
//     if ((date("Y-m-d", $appdate1) == $cur_date and date("H:i:s", $apptime1) > $cur_time) or date("Y-m-d", $appdate1) > $cur_date) {
//       $check_query = mysqli_query($con, "select apptime from appointmenttb where doctor='$doctor' and appdate='$appdate' and apptime='$apptime'");

//       if (mysqli_num_rows($check_query) == 0) {
//         $query = mysqli_query($con, "insert into appointmenttb(pid,fname,lname,gender,email,contact,doctor,docFees,appdate,apptime,userStatus,doctorStatus) values('$pid','$fname','$lname','$gender','$email','$contact','$doctor','$docFees','$appdate','$apptime','1','1')");

//         if ($query) {
//           echo "<script>alert('Your appointment successfully booked');</script>";
//         } else {
//           echo "<script>alert('Unable to process your request. Please try again!');</script>";
//         }
//       } else {
//         echo "<script>alert('We are sorry to inform that the doctor is not available in this time or date.');</script>";
//       }
//     } else {
//       echo "<script>alert('Select a time or date in the future!');</script>";
//     }
//   } else {
//     echo "<script>alert('Select a time or date in the future!');</script>";
//   }
// }

if (isset($_GET['cancel'])) {
    $query = mysqli_query($con, "update appointmenttb set userStatus='0' where ID = '" . $_GET['ID'] . "'");
    if ($query) {
        echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
}

// Bill generation function code yahan rahega...
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Patient Dashboard | CarePlus</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'IBM Plex Sans', sans-serif;
            background-color: #f0fdfa;
        }

        .bg-gradient-custom {
            background: linear-gradient(to right, #00a896, #02c39a);
        }

        .text-custom {
            color: #00a896;
        }

        .btn-custom {
            background-color: #00a896;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #02c39a;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 168, 150, 0.3);
        }

        .list-group-item.active {
            background-color: #00a896 !important;
            border-color: #00a896 !important;
        }

        .dash-card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }
    </style>
</head>

<body class="pt-20">

    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-custom fixed-top shadow-lg">
        <div class="container">
            <a class="navbar-brand font-bold text-xl" href="#"><i class="fa fa-user-plus mr-2"></i> CarePlus Hospitals</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto flex items-center">
                    <li class="nav-item">
                        <a class="nav-link font-semibold text-white px-4 py-2 rounded-lg hover:bg-white/10 transition flex items-center" href="logout.php">
                            <i class="fa fa-sign-out mr-2 text-lg"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-10 px-6">
        <div class="flex flex-col md:flex-row gap-8">

            <div class="md:w-1/4">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-teal-100">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-3 text-custom text-3xl">
                            <i class="fa fa-user"></i>
                        </div>
                        <h5 class="font-bold text-gray-800 uppercase tracking-wide">Welcome</h5>
                        <p class="text-custom font-bold"><?php echo $username ?></p>
                    </div>

                    <div class="list-group shadow-none" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active border-0 rounded-lg mb-2 py-3 font-medium transition" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab"><i class="fa fa-th-large mr-3"></i> Dashboard</a>
                        <a class="list-group-item list-group-item-action border-0 rounded-lg mb-2 py-3 font-medium transition" id="list-home-list" data-toggle="list" href="#list-home" role="tab"><i class="fa fa-calendar-plus-o mr-3"></i> Book Appointment</a>
                        <a class="list-group-item list-group-item-action border-0 rounded-lg mb-2 py-3 font-medium transition" id="list-pat-list" data-toggle="list" href="#app-hist" role="tab"><i class="fa fa-history mr-3"></i> Appointment History</a>
                        <a class="list-group-item list-group-item-action border-0 rounded-lg mb-2 py-3 font-medium transition" id="list-pres-list" data-toggle="list" href="#list-pres" role="tab"><i class="fa fa-file-text-o mr-3"></i> Prescriptions</a>
                        <a class="list-group-item list-group-item-action border-0 rounded-lg py-3 font-bold text-red-500 hover:bg-red-50 mt-4 transition" href="logout.php">
                            <i class="fa fa-power-off mr-3"></i> Log Out
                        </a>
                    </div>
                </div>
            </div>

            <div class="md:w-3/4">
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="list-dash" role="tabpanel">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="dash-card bg-white p-8 rounded-3xl shadow-sm border-b-4 border-[#00a896] text-center cursor-pointer" onclick="document.querySelector('#list-home-list').click()">
                                <i class="fa fa-calendar-check-o fa-3x text-custom mb-4"></i>
                                <h5 class="font-bold text-gray-700">Book Appointment</h5>
                            </div>
                            <div class="dash-card bg-white p-8 rounded-3xl shadow-sm border-b-4 border-[#00a896] text-center cursor-pointer" onclick="document.querySelector('#list-pat-list').click()">
                                <i class="fa fa-history fa-3x text-custom mb-4"></i>
                                <h5 class="font-bold text-gray-700">My Appointments</h5>
                            </div>
                            <div class="dash-card bg-white p-8 rounded-3xl shadow-sm border-b-4 border-[#00a896] text-center cursor-pointer" onclick="document.querySelector('#list-pres-list').click()">
                                <i class="fa fa-medkit fa-3x text-custom mb-4"></i>
                                <h5 class="font-bold text-gray-700">Prescriptions</h5>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-home" role="tabpanel">
                        <div class="bg-white rounded-3xl shadow-xl p-8 max-w-2xl mx-auto">
                            <h4 class="text-center font-bold text-gray-800 mb-8 underline decoration-[#02c39a]">Create New Appointment</h4>
                            <form class="space-y-6" method="post" action="">
                                <div class="grid grid-cols-1 md:grid-cols-3 items-center">
                                    <label class="font-semibold text-gray-600">Specialization</label>
                                    <div class="md:col-span-2">
                                        <select name="spec" class="form-control rounded-xl border-teal-100" id="spec" required>
                                            <option value="" disabled selected>Select Specialization</option>
                                            <?php display_specs(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 items-center">
                                    <label class="font-semibold text-gray-600">Doctor</label>
                                    <div class="md:col-span-2">
                                        <select name="doctor" class="form-control rounded-xl" id="doctor" required>
                                            <option value="" disabled selected>Select Doctor</option>
                                            <?php display_docs(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 items-center">
                                    <label class="font-semibold text-gray-600">Fees (₹)</label>
                                    <div class="md:col-span-2">
                                        <input class="form-control rounded-xl bg-gray-50 font-bold text-custom" type="text" name="docFees" id="docFees" readonly />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 items-center">
                                    <label class="font-semibold text-gray-600">Date</label>
                                    <div class="md:col-span-2">
                                        <input type="date" class="form-control rounded-xl" name="appdate" required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 items-center">
                                    <label class="font-semibold text-gray-600">Time Slot</label>
                                    <div class="md:col-span-2">
                                        <select name="apptime" class="form-control rounded-xl" required>
                                            <option value="" disabled selected>Select Time</option>
                                            <option value="08:00:00">08:00 AM</option>
                                            <option value="10:00:00">10:00 AM</option>
                                            <option value="12:00:00">12:00 PM</option>
                                            <option value="14:00:00">02:00 PM</option>
                                            <option value="16:00:00">04:00 PM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-center pt-4">
                                    <button type="submit" name="pay_now" class="btn-custom px-12 py-3 font-bold shadow-lg w-full md:w-auto">
                                        Pay & Confirm Booking <i class="fa fa-credit-card ml-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="app-hist" role="tabpanel">
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-teal-50">
                            <table class="table table-hover mb-0">
                                <thead class="bg-gradient-custom text-white">
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Fees</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                                    $query = "select * from appointmenttb where fname ='$fname' and lname='$lname';";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['doctor']; ?></td>
                                            <td class="font-bold text-teal-600">₹<?php echo $row['docFees']; ?></td>
                                            <td><?php echo $row['appdate']; ?></td>
                                            <td><?php echo $row['apptime']; ?></td>
                                            <td>
                                                <?php
                                                if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) echo "<span class='badge badge-success'>Active</span>";
                                                else if (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) echo "<span class='badge badge-warning'>Cancelled by You</span>";
                                                else echo "<span class='badge badge-danger'>Cancelled by Doctor</span>";
                                                ?>
                                            </td>
                                            <td>
                                                <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>
                                                    <a href="admin-panel.php?ID=<?php echo $row['ID'] ?>&cancel=update" onClick="return confirm('Cancel appointment?')" class="btn btn-sm btn-outline-danger">Cancel</a>
                                                <?php } else {
                                                    echo "<span class='text-muted'>N/A</span>";
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['payment_status'] == 'Paid') {
                                                    echo "<span class='badge badge-success'>Paid & Active</span>";
                                                } else {
                                                    echo "<span class='badge badge-warning'>Pending</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
                        <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-teal-50">
                            <div class="p-4 bg-gray-50 border-b border-teal-100 flex justify-between items-center">
                                <h5 class="font-bold text-gray-700 mb-0"><i class="fa fa-file-text-o mr-2 text-custom"></i> Your Medical Prescriptions</h5>
                                <span class="text-xs bg-teal-100 text-teal-700 px-3 py-1 rounded-full font-semibold">Total Records:
                                    <?php
                                    $count_res = mysqli_query($con, "SELECT count(*) as total FROM prestb WHERE pid='$pid'");
                                    $count_data = mysqli_fetch_assoc($count_res);
                                    echo $count_data['total'];
                                    ?>
                                </span>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-gradient-custom text-white">
                                        <tr>
                                            <th class="py-4 border-0">Doctor Name</th>
                                            <th class="py-4 border-0">Appt. ID</th>
                                            <th class="py-4 border-0">Date & Time</th>
                                            <th class="py-4 border-0">Disease</th>
                                            <th class="py-4 border-0">Allergy</th>
                                            <th class="py-4 border-0">Prescription</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        <?php
                                        $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                                        // Query for prescriptions based on Patient ID
                                        $query = "SELECT doctor, ID, appdate, apptime, disease, allergy, prescription FROM prestb WHERE pid='$pid'";
                                        $result = mysqli_query($con, $query);


                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                                <tr class="hover:bg-teal-50/30 transition">
                                                    <td class="font-semibold text-gray-800">Dr. <?php echo $row['doctor']; ?></td>
                                                    <td class="text-gray-500">#<?php echo $row['ID']; ?></td>
                                                    <td>
                                                        <span class="block font-medium"><?php echo $row['appdate']; ?></span>
                                                        <span class="text-xs text-gray-400"><?php echo $row['apptime']; ?></span>
                                                    </td>
                                                    <td><span class="px-2 py-1 bg-red-50 text-red-600 rounded text-xs font-medium"><?php echo $row['disease']; ?></span></td>
                                                    <td class="text-gray-600"><?php echo $row['allergy']; ?></td>
                                                    <td class="max-w-xs truncate text-gray-600" title="<?php echo $row['prescription']; ?>">
                                                        <?php echo $row['prescription']; ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="7" class="text-center py-10 text-gray-400">No prescriptions found in your records.</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-4 italic"><i class="fa fa-info-circle mr-1"></i> Prescription details are uploaded by doctors after the consultation.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // JS Logic for dynamic doctor filtering and fees
        document.getElementById('spec').onchange = function() {
            let spec = this.value;
            let docs = [...document.getElementById('doctor').options];
            docs.forEach((el, ind, arr) => {
                arr[ind].setAttribute("style", "");
                if (el.getAttribute("data-spec") != spec) {
                    arr[ind].setAttribute("style", "display: none");
                }
            });
        };

        document.getElementById('doctor').onchange = function() {
            var selection = document.querySelector(`[value='${this.value}']`).getAttribute('data-value');
            document.getElementById('docFees').value = selection;
        };
    </script>
</body>

</html>