<?php include("session_check.php"); 
$user =  $_COOKIE['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Burning Eyebrow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: radial-gradient(circle, rgba(0, 0, 0, 0.8) 1px, rgba(0, 0, 0, 0) 1px),
                radial-gradient(circle at center, rgba(255, 246, 229, 0.6) 0%, rgba(255, 246, 229, 0) 60%);
            background-size: 40px 40px, cover;
        }

        .welcome-font {
            font-family: 'Kalnia', serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings: 'wdth' 100;
        }
    </style>
</head>

<body class="bg-[#FDFAF6]">
    <!-- Navbar -->
    <nav class="bg-[#FAF1E6] shadow-md px-6 py-4 sticky top-0 z-50">
        <div class="flex items-center justify-between w-full">
            <!-- Left section: Logo + Nav Links -->
            <div class="flex items-center gap-7">
                <!-- Logo -->
                <div class="text-2xl  text-black-600 hover:scale-105 transition-transform cursor-pointer welcome-font ">
                    Burning Eyebrow
                </div>

                <!-- Desktop Nav Links -->
                <ul class="hidden md:flex gap-6 text-gray-700 text-sm tracking-wide">
                    <li>
                        <a href="index.php" class="hover:text-blue-600 transition-colors cursor-pointer">Home</a>
                    </li>
                    <li>
                        <a href="progress.php"
                            class="hover:text-blue-600 transition-colors cursor-pointer">Progress</a>
                    </li>
                    <a href="leaderboard.php"
                        class="hover:text-blue-600 transition-colors cursor-pointer">Leaderboard</a>
                    </li>
                    <a href="achievements.php"
                        class="hover:text-blue-600 transition-colors cursor-pointer">My Achievements</a>
                    </li>
                    <li>
                        <a href="https://open.spotify.com/playlist/0oPyDVNdgcPFAWmOYSK7O1?si=4b09f30e11f640fe" target="_blank"
                            rel="noopener noreferrer" class="hover:text-blue-600 transition-colors cursor-pointer">
                            Music
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Right section: Login Dropdown + Mobile Menu Toggle -->
            <div class="flex items-center gap-4">
                <!-- Login Dropdown -->
                <div class="hidden md:block relative group" id="login-wrapper">
                    <button
                        class="flex items-center gap-1 font-medium text-gray-700 hover:text-blue-600 transition-all">
                        <?php echo htmlspecialchars($user)?>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow-lg opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transform transition duration-200 origin-top-right pointer-events-none group-hover:pointer-events-auto z-50"
                        id="login-dropdown">
                        <!-- Content filled by JavaScript -->
                    </div>
                </div>



                <!-- Hamburger Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden mt-4 hidden flex-col space-y-2 text-gray-700 text-sm px-1">
            <a href="index.php" class="block hover:text-blue-600">Home</a>
            <a href="progress.php" class="block hover:text-blue-600">Progress</a>
            <a href="leaderboard.php" class="block hover:text-blue-600">Leaderboard</a>
            <a href="achievements.php" class="block hover:text-blue-600">My Achievements</a>
            <a href="https://open.spotify.com/playlist/0oPyDVNdgcPFAWmOYSK7O1?si=4b09f30e11f640fe" target="_blank" rel="noopener noreferrer"
                class="block hover:text-blue-600">
                Music
            </a>
            <div class="border-t pt-2" id="mobile-auth">
                <!-- Will be filled dynamically -->
            </div>

        </div>
    </nav>



    <div id="greeting" class="text-center mt-12 px-4 sm:px-6 lg:px-8">
        <p id="today" class="text-md text-gray-500"></p>
        <h1 class="text-3xl font- text-center mb-6 mt-3 welcome-font">My Achievements</h1>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div id="achievements-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 overflow-y-auto max-h-[60vh]">
            <!-- Achievements will be populated here dynamically -->
        </div>
    </div>


    <script>
        function getUsername() {
            const rawName = getCookie("username") || "User";
            return rawName
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
                .join(' ');
        }
        // -------- Cookie & Login Dropdown -------- //

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        document.addEventListener("DOMContentLoaded", () => {
            const dropdown = document.getElementById("login-dropdown");
            const container = document.getElementById("login-container");
            const username = getCookie("username");

            dropdown.innerHTML = username ? `
        <div class="px-4 py-2 text-sm text-gray-600">Welcome, ${username}</div>
        <a href="logout.php" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100 hover:text-red-700">Logout</a>` :
                `<a href="login.html" class="block px-4 py-2 text-sm hover:bg-gray-100">Sign In</a>
        <a href="register.html" class="block px-4 py-2 text-sm hover:bg-gray-100">Sign Up</a>`;

            if (container) {
                container.addEventListener("mouseenter", () => {
                    dropdown.classList.remove("opacity-0", "scale-95", "pointer-events-none");
                    dropdown.classList.add("opacity-100", "scale-100", "pointer-events-auto");
                });
                container.addEventListener("mouseleave", () => {
                    dropdown.classList.remove("opacity-100", "scale-100", "pointer-events-auto");
                    dropdown.classList.add("opacity-0", "scale-95", "pointer-events-none");
                });
            }

            const mobileAuth = document.getElementById("mobile-auth");
            if (mobileAuth) {
                mobileAuth.innerHTML = username ? `
            <div class="px-4 py-2 text-sm text-gray-600">Welcome, ${username}</div>
            <a href="logout.php" class="block px-4 py-2 text-sm text-red-500 hover:text-red-700">Logout</a>` :
                    `<a href="login.html" class="block hover:text-blue-600">Sign In</a>
            <a href="register.html" class="block hover:text-blue-600">Sign Up</a>`;
            }

            timeLeft = studyDuration;
            updateTimerDisplay();
            updateBurnMeter();
            pauseTimerBtn.classList.add('hidden');
            resetTimerBtn.classList.add('hidden');
            startSessionBtnBottom.classList.remove('hidden');
            viewProgressBtn.classList.remove('hidden');
            startSessionBtnBottom.textContent = "Start";
        });
        // -------------------- Update Login UI -------------------- //
        function updateAuthMenus() {
            const username = getCookie("username");

            const dropdown = document.getElementById("login-dropdown");
            if (dropdown) {
                dropdown.innerHTML = username ?
                    `<div class="px-4 py-2 text-sm text-gray-600">Welcome, ${username}</div>
               <a href="logout.php" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100 hover:text-red-700">Logout</a>` :
                    `<a href="login.html" class="block px-4 py-2 text-sm hover:bg-gray-100">Sign In</a>
               <a href="register.html" class="block px-4 py-2 text-sm hover:bg-gray-100">Sign Up</a>`;
            }

            const mobileAuth = document.getElementById("mobile-auth");
            if (mobileAuth) {
                mobileAuth.innerHTML = username ?
                    `<div class="px-4 py-2 text-sm text-gray-600">Welcome, ${username}</div>
               <a href="logout.php" class="block px-4 py-2 text-sm text-red-500 hover:text-red-700">Logout</a>` :
                    `<a href="login.html" class="block hover:text-blue-600">Sign In</a>
               <a href="register.html" class="block hover:text-blue-600">Sign Up</a>`;
            }
        }

        // -------------------- When Page Loads -------------------- //
        document.addEventListener("DOMContentLoaded", () => {
            updateAuthMenus();
        });
    </script>
    <script>
        // ------------------------------------ Mobile Menu Toggle ------------------------------------ //
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>

    <script>
        fetch('get_user_achievements.php')
            .then(response => response.json())
            .then(data => {
                const grid = document.getElementById('achievements-grid');

                if (data.achievements.length === 0) {
                    grid.innerHTML = `<p class="text-gray-500 col-span-full">No achievements available.</p>`;
                    return;
                }

                data.achievements.forEach(ach => {
                    const card = document.createElement('div');
                    card.className = `bg-white border border-black rounded-2xl p-4 shadow transition relative overflow-hidden
                              ${ach.unlocked ? 'opacity-100' : 'opacity-50 grayscale'}`;

                    card.innerHTML = `
                <div class="text-4xl mb-2">${ach.icon || '🏆'}</div>
                <h3 class="font-semibold text-lg">${ach.name}</h3>
                <p class="text-sm text-gray-500 mb-2">${ach.description}</p>
                ${ach.unlocked 
                    ? `<p class="text-xs text-green-500">Unlocked on ${new Date(ach.unlocked_at).toLocaleDateString()}</p>` 
                    : `<div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                           <div class="bg-blue-500 h-2 rounded-full" style="width: ${ach.progress}%;"></div>
                       </div>
                       <p class="text-xs text-gray-400 mt-1">${ach.current_value}/${ach.condition_value}</p>`}
            `;

                    grid.appendChild(card);
                });
            })
            .catch(error => console.error('Error loading achievements:', error));
    </script>

</body>

</html>