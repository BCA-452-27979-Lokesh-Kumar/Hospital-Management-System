<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Patient Login | CarePlus</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">

    <style>
        body { 
            font-family: 'IBM Plex Sans', sans-serif; 
            background: linear-gradient(135deg, #00a896 0%, #02c39a 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 2rem;
        }
        .custom-input:focus {
            border-color: #00a896;
            ring-color: #00a896;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 168, 150, 0.2);
        }
        @keyframes mover {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }
        .ambulance-anim {
            animation: mover 1.5s infinite alternate;
        }
    </style>
</head>

<body class="flex flex-col">

    <nav class="p-4 w-full z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a class="text-white text-2xl font-bold flex items-center" href="index.php">
                <i class="fa fa-user-plus mr-2"></i> CarePlus Hospitals
            </a>
            <div class="space-x-8 hidden md:flex font-semibold text-white">
                <a href="index.php" class="hover:text-teal-100 transition border-b-2 border-transparent hover:border-white pb-1">HOME</a>
                <a href="services.html" class="hover:text-teal-100 transition border-b-2 border-transparent hover:border-white pb-1">ABOUT US</a>
                <a href="contact.html" class="hover:text-teal-100 transition border-b-2 border-transparent hover:border-white pb-1">CONTACT</a>
            </div>
        </div>
    </nav>

    <div class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-around gap-12">
            
            <div class="text-center md:text-left text-white md:w-1/2">
                <div class="ambulance-anim inline-block mb-6">
                    <img src="images/ambulance1.png" alt="Ambulance" class="w-32 md:w-48 drop-shadow-2xl">
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-4">We are here <br>for you!</h1>
                <p class="text-teal-50 text-lg opacity-90 max-w-md">Access your health records, book appointments, and connect with specialists instantly.</p>
            </div>

            <div class="w-full max-w-md md:w-1/3">
                <div class="glass-card shadow-2xl p-8 md:p-12 relative overflow-hidden">
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-teal-100 rounded-full opacity-50"></div>
                    
                    <div class="text-center mb-8 relative z-10">
                        <div class="bg-teal-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fa fa-hospital-o text-4xl text-[#00a896]"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800">Patient Login</h3>
                        <p class="text-gray-500 text-sm mt-2">Please enter your credentials</p>
                    </div>

                    <form method="POST" action="func.php" class="space-y-6 relative z-10">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="text" name="email" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl custom-input transition" placeholder="example@mail.com" required/>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="password2" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl custom-input transition" placeholder="••••••••" required/>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" name="patsub" id="inputbtn" class="w-full bg-gradient-to-r from-[#00a896] to-[#02c39a] text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                                Login to Account
                            </button>
                        </div>
                        
                        <div class="text-center mt-6">
                            <p class="text-gray-500 text-sm">Don't have an account? 
                                <a href="index.php" class="text-[#00a896] font-bold hover:underline">Register here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <footer class="py-6 text-center text-white text-sm opacity-75">
        &copy; 2026 CarePlus Hospitals. Your health, our priority.
    </footer>

</body>
</html>