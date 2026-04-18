<?php
include('func.php');
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
$id = $_GET['id'];
$res = mysqli_query($con, "select * from appointmenttb where ID='$id'");
$data = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Receipt | CarePlus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div id="receipt" class="max-w-md mx-auto bg-white p-10 rounded-2xl shadow-2xl border-dashed border-2 border-gray-300">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-[#00a896]">CarePlus Hospitals</h2>
            <p class="text-gray-500">Payment Receipt</p>
        </div>
        <div class="space-y-4 border-t pt-6">
            <p><strong>Appointment ID:</strong> #<?php echo $id; ?></p>
            <p><strong>Patient:</strong> <?php echo $data['fname']." ".$data['lname']; ?></p>
            <p><strong>Doctor:</strong> <?php echo $data['doctor']; ?></p>
            <p><strong>Schedule:</strong> <?php echo $data['appdate']." | ".$data['apptime']; ?></p>
            <p class="text-xl font-bold mt-4">Status: <span class="text-green-600">PAID</span></p>
        </div>
        <button onclick="window.print()" class="w-full mt-10 bg-gray-800 text-white py-3 rounded-xl no-print">
            Print Receipt
        </button>
        <a href="admin-panel.php" class="block text-center mt-4 text-[#00a896] no-print">Back to Dashboard</a>
    </div>

    <style>
        @media print { .no-print { display: none; } }
    </style>
</body>
</html>