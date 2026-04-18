<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarePlus Hospitals - HMS</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">

    <style>
        body { font-family: 'IBM Plex Sans', sans-serif; }
        .bg-primary-custom { background-color: #00a896; }
        .bg-secondary-custom { background-color: #02c39a; }
        .text-primary-custom { color: #00a896; }
        
        /* Smooth Tab Transition */
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        
        .nav-tab.active {
            border-bottom: 3px solid #00a896;
            color: #00a896;
            font-weight: bold;
        }
    </style>

    <script>
        var check = function() {
            if (document.getElementById('password').value == document.getElementById('cpassword').value) {
                document.getElementById('message').style.color = '#5dd05d';
                document.getElementById('message').innerHTML = ' <i class="fa fa-check"></i> Matched';
            } else {
                document.getElementById('message').style.color = '#f55252';
                document.getElementById('message').innerHTML = ' <i class="fa fa-times"></i> Not Matching';
            }
        }

        function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8 || key == 32);
        };

        function checklen() {
            var pass1 = document.getElementById("password");  
            if(pass1.value.length < 6){  
                alert("Password must be at least 6 characters long. Try again!");  
                return false;  
            }  
        }

        // Tab Switching Logic
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("nav-tab");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>
</head>

<body class="bg-gray-50">

    <nav class="bg-primary-custom p-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a class="text-white text-2xl font-bold flex items-center" href="#">
                <i class="fa fa-user-plus mr-2"></i> CarePlus Hospitals
            </a>
            <div class="space-x-8 hidden md:flex">
                <a href="index.php" class="text-white hover:text-gray-200 transition">HOME</a>
                <a href="services.html" class="text-white hover:text-gray-200 transition">ABOUT US</a>
                <a href="contact.html" class="text-white hover:text-gray-200 transition">CONTACT</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-12 px-4 pb-12">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">
            
            <div class="md:w-1/3 bg-secondary-custom p-10 flex flex-col justify-center items-center text-white">
                <img src="https://png.pngtree.com/png-clipart/20250519/original/pngtree-cartoon-rocket-ship-taking-off-against-a-transparent-background-ready-for-png-image_21030409.png" class="w-48 mb-6 animate-bounce" alt="Welcome"/>
                <h3 class="text-3xl font-bold mb-2">Welcome</h3>
                <p class="text-center opacity-90">Manage your health journey with CarePlus Hospital's most advanced HMS portal.</p>
            </div>

            <div class="md:w-2/3 p-8 md:p-12">
                <div class="flex border-b mb-8 space-x-4">
                    <button class="nav-tab active py-2 px-4 transition" onclick="openTab(event, 'home')">Patient</button>
                    <button class="nav-tab py-2 px-4 transition" onclick="openTab(event, 'profile')">Doctor</button>
                    <button class="nav-tab py-2 px-4 transition" onclick="openTab(event, 'admin')">Receptionist</button>
                </div>

                <div id="home" class="tab-content active">
                    <h3 class="text-2xl font-bold text-gray-700 mb-6">Register as Patient</h3>
                    <form method="post" action="func2.php">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="text" name="fname" placeholder="First Name *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary-custom" onkeydown="return alphaOnly(event);" required />
                            <input type="text" name="lname" placeholder="Last Name *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary-custom" onkeydown="return alphaOnly(event);" required />
                            <input type="email" name="email" placeholder="Email ID *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary-custom" required />
                            <input type="tel" name="contact" minlength="10" maxlength="10" placeholder="Phone Number *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary-custom" required />
                            <input type="password" id="password" name="password" placeholder="Password *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary-custom" onkeyup='check();' required />
                            <div>
                                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary-custom" onkeyup='check();' required />
                                <span id='message' class="text-sm mt-1 block"></span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="Male" checked class="text-primary-custom focus:ring-primary-custom">
                                <span class="ml-2">Male</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="Female" class="text-primary-custom focus:ring-primary-custom">
                                <span class="ml-2">Female</span>
                            </label>
                        </div>
                        <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                            <a href="index1.php" class="text-primary-custom hover:underline">Already have an account?</a>
                            <input type="submit" name="patsub1" value="Register" onclick="return checklen();" class="bg-primary-custom text-white px-8 py-3 rounded-full font-bold hover:bg-opacity-90 transition cursor-pointer w-full md:w-auto shadow-lg" />
                        </div>
                    </form>
                </div>

                <div id="profile" class="tab-content">
                    <h3 class="text-2xl font-bold text-gray-700 mb-6">Doctor Login</h3>
                    <form method="post" action="func1.php" class="space-y-4">
                        <input type="text" name="username3" placeholder="Username *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-custom" required />
                        <input type="password" name="password3" placeholder="Password *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-custom" required />
                        <input type="submit" name="docsub1" value="Login" class="bg-primary-custom text-white px-8 py-3 rounded-full font-bold hover:bg-opacity-90 transition cursor-pointer w-full shadow-lg" />
                    </form>
                </div>

                <div id="admin" class="tab-content">
                    <h3 class="text-2xl font-bold text-gray-700 mb-6">Receptionist Login</h3>
                    <form method="post" action="func3.php" class="space-y-4">
                        <input type="text" name="username1" placeholder="Admin Username *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-custom" required />
                        <input type="password" name="password2" placeholder="Password *" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-custom" required />
                        <input type="submit" name="adsub" value="Login" class="bg-primary-custom text-white px-8 py-3 rounded-full font-bold hover:bg-opacity-90 transition cursor-pointer w-full shadow-lg" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>