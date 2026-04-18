<?php
include('func.php'); // Ensure session_start() is inside func.php
if(!isset($_SESSION['temp_app'])) { header("Location: admin-panel.php"); exit(); }
$app = $_SESSION['temp_app'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Payment | CarePlus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'IBM Plex Sans', sans-serif; background-color: #f0fdfa; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="max-w-4xl w-full flex flex-col md:flex-row bg-white rounded-3xl shadow-2xl overflow-hidden">
        
        <div class="md:w-1/2 bg-[#00a896] p-10 text-white">
            <h3 class="text-2xl font-bold mb-8">Appointment Summary</h3>
            <div class="space-y-6 opacity-90">
                <div>
                    <p class="text-teal-200 text-xs uppercase tracking-widest font-bold">Patient Name</p>
                    <p class="text-xl font-semibold"><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></p>
                </div>
                <div>
                    <p class="text-teal-200 text-xs uppercase tracking-widest font-bold">Consulting Doctor</p>
                    <p class="text-xl font-semibold">Dr. <?php echo $app['doctor']; ?></p>
                </div>
                <div>
                    <p class="text-teal-200 text-xs uppercase tracking-widest font-bold">Schedule</p>
                    <p class="text-xl font-semibold"><?php echo $app['appdate']; ?> at <?php echo $app['apptime']; ?></p>
                </div>
                <div class="pt-6 border-t border-white/20">
                    <p class="text-teal-200 text-sm">Total Payable Amount</p>
                    <p class="text-4xl font-black italic mt-1">₹<?php echo $app['docFees']; ?></p>
                </div>
            </div>
        </div>

        <div class="md:w-1/2 p-10">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-gray-800">Secure Payment</h3>
                <div class="flex space-x-2 text-2xl text-gray-300">
                    <i class="fa fa-cc-visa"></i>
                    <i class="fa fa-cc-mastercard"></i>
                </div>
            </div>

            <form method="POST" action="payment_process.php" class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase">Card Holder Name</label>
                    <input type="text" placeholder="Full Name on Card" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#02c39a] outline-none" required>
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase">Card Number</label>
                    <input type="text" placeholder="1234 5678 9101 1121" maxlength="16" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#02c39a] outline-none font-mono" required>
                </div>
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="text-xs font-bold text-gray-500 uppercase">Expiry</label>
                        <input type="text" placeholder="MM/YY" maxlength="5" class="w-full p-3 border border-gray-200 rounded-xl outline-none" required>
                    </div>
                    <div class="w-1/2">
                        <label class="text-xs font-bold text-gray-500 uppercase">CVV</label>
                        <input type="password" placeholder="***" maxlength="3" class="w-full p-3 border border-gray-200 rounded-xl outline-none" required>
                    </div>
                </div>
                <button type="submit" name="confirm_payment" class="w-full bg-[#02c39a] text-white py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition duration-300 mt-6">
                    Pay & Confirm Booking
                </button>
            </form>
            <p class="text-center text-[10px] text-gray-400 mt-6 uppercase tracking-widest font-bold"><i class="fa fa-lock"></i> 256-bit SSL Encrypted Payment</p>
        </div>
    </div>
</body>
</html>