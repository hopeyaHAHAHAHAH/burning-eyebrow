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
        <h1 class="text-3xl font- text-center mb-6 mt-3 welcome-font">Your Daily Progress</h1>
    </div>



    <div class="max-w-6xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md border border-black overflow-x-auto mt-10  px-4 sm:px-6">
        <div class="min-w-[600px] sm:min-w-0">
            <table class="w-full table-auto text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left text-xs sm:text-sm">
                        <th class="px-2 sm:px-4 py-2 border whitespace-nowrap">📅 Date</th>
                        <th class="px-2 sm:px-4 py-2 border whitespace-nowrap">⏱️ Study Time</th>
                        <th class="px-2 sm:px-4 py-2 border whitespace-nowrap">☕ Break Time</th>
                        <th class="px-2 sm:px-4 py-2 border whitespace-nowrap">🔁 Sessions</th>
                        <th class="px-2 sm:px-4 py-2 border whitespace-nowrap">🔥 Streak</th>
                        <th class="px-2 sm:px-4 py-2 border whitespace-nowrap">📊 Ratio</th>
                        <th class="px-2 sm:px-4 py-2 border whitespace-nowrap">🕐 Avg/Session</th>
                    </tr>
                </thead>
                <tbody id="progress-body" class="text-gray-700">
                    <!-- Filled dynamically -->
                </tbody>
            </table>
        </div>
    </div>




    <script>
        // -------------------- Date and Time -------------------- //
        function updateDateTime() {
            const now = new Date();

            const today = now.toLocaleDateString('en-US', {
                weekday: 'long',
                day: 'numeric',
                month: 'long'
            });

            const currentTime = now.toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });

            const dateTimeElement = document.getElementById('today');
            if (dateTimeElement) {
                dateTimeElement.textContent = `${today}, ${currentTime}`;
            }
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // -------------------- Mobile Menu Toggle -------------------- //
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // -------------------- Cookie Helper -------------------- //
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(";").shift();
        }

        // -------------------- Load Logs -------------------- //
        function loadLogs() {
            const username = getCookie("username");

            fetch("fetch_logs.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        username
                    })
                })
                .then(res => res.json())
                .then(data => {
                    const tbody = document.getElementById("progress-body");
                    tbody.innerHTML = "";

                    if (data.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="7" class="px-4 py-4 text-center text-gray-500">No progress data yet.</td></tr>`;
                        return;
                    }

                    data.forEach(log => {
                        const ratio = log.breakTime > 0 ? (log.studyTime / log.breakTime).toFixed(2) : '∞';
                        const avgPerSession = log.sessions > 0 ?
                            Math.round(log.studyTime / log.sessions) + " mins" :
                            '0 mins';

                        tbody.innerHTML += `
                <tr>
                    <td class="px-4 py-2 border">${log.date}</td>
                    <td class="px-4 py-2 border">${log.studyTime} mins</td>
                    <td class="px-4 py-2 border">${log.breakTime} mins</td>
                    <td class="px-4 py-2 border">${log.sessions}</td>
                    <td class="px-4 py-2 border">${log.streak}</td>
                    <td class="px-4 py-2 border">${ratio}</td>
                    <td class="px-4 py-2 border">${avgPerSession}</td>
                </tr>`;
                    });
                });
        }

        // -------------------- Save Session Log -------------------- //
        function saveSessionLog(studyTime, breakTime, sessions, streak) {
            const username = getCookie("username");
            const today = new Date().toLocaleDateString('en-CA'); // YYYY-MM-DD

            fetch("fetch_logs.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        username,
                        date: today,
                        studyTime,
                        breakTime,
                        sessions,
                        streak
                    })
                })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        loadLogs(); // Refresh progress table
                    } else {
                        console.error("Failed to save session log:", response.message);
                    }
                });
        }

        // Example usage (replace with your actual end-of-session logic)
        // saveSessionLog(25, 5, 1, 3);

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
            loadLogs();
            updateAuthMenus();
        });
    </script>
</body>