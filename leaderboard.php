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
        <h1 class="text-3xl font- text-center mb-6 mt-3 welcome-font">Leaderboard</h1>
    </div>



    <div class="flex justify-center my-6 px-4">
        <div class="flex gap-2 sm:gap-4 flex-wrap justify-center">
            <button class="filter-btn px-3 py-2 text-sm sm:px-4 sm:py-2 bg-blue-100 hover:bg-blue-300 rounded border border-black" data-filter="studytime">Study Time</button>
            <button class="filter-btn px-3 py-2 text-sm sm:px-4 sm:py-2 bg-blue-100 hover:bg-blue-300 rounded border border-black" data-filter="breaktime">Break Time</button>
            <button class="filter-btn px-3 py-2 text-sm sm:px-4 sm:py-2 bg-blue-100 hover:bg-blue-300 rounded border border-black" data-filter="sessions">Sessions</button>
            <button class="filter-btn px-3 py-2 text-sm sm:px-4 sm:py-2 bg-blue-100 hover:bg-blue-300 rounded border border-black" data-filter="streak">Streaks</button>
        </div>
    </div>


    <!-- Podium Section -->
    <div class="flex flex-wrap justify-center gap-4 sm:gap-6 mb-8 sm:mb-10 px-4" id="leaderboard-podium"></div>

    <!-- Leaderboard Cards Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 max-w-7xl mx-auto mt-4 sm:mt-6 px-4 overflow-y-auto max-h-[40vh]" id="leaderboard-cards">
        <!-- Your card content here -->
    </div>

    <br>
    <br>

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
        async function loadLeaderboard(filter = 'studytime') {
            const response = await fetch(`leaderboard_data.php?filter=${filter}`);
            const data = await response.json();

            const podiumContainer = document.getElementById('leaderboard-podium');
            const cardsContainer = document.getElementById('leaderboard-cards');

            podiumContainer.innerHTML = '';
            cardsContainer.innerHTML = '';

            const podiumColors = [
                'bg-yellow-400 text-yellow-900 shadow-yellow-400/50', // Gold
                'bg-gray-300 text-gray-700 shadow-gray-300/50', // Silver
                'bg-amber-700 text-amber-100 shadow-amber-700/50' // Bronze
            ];

            // Filter key mapping
            const filterMap = {
                'studytime': {
                    field: 'studytime',
                    label: 'Study Time',
                    unit: 'min/s'
                },
                'breaktime': {
                    field: 'breaktime',
                    label: 'Break Time',
                    unit: 'min/s'
                },
                'sessions': {
                    field: 'sessions',
                    label: 'Sessions',
                    unit: 'session/s'
                },
                'streak': {
                    field: 'streak',
                    label: 'Streak',
                    unit: 'day/s'
                }
            };

            const currentFilter = filterMap[filter] || filterMap['studytime'];

            // Display Top 3 Podium
            data.slice(0, 3).forEach((player, index) => {
                podiumContainer.innerHTML += `
            <div class="rounded-xl p-4 w-50 text-center shadow-lg hover:scale-[1.02] transition-transform  ${podiumColors[index]}">
                <h2 class="text-2xl font-bold">#${player.rank}</h2>
                <p class="font-semibold text-lg">${player.username}</p>
                <p class="text-sm">${player[currentFilter.field]} ${currentFilter.unit}</p>
            </div>
        `;
            });

            // Display the rest of the leaderboard cards
            data.slice(3).forEach(player => {
                cardsContainer.innerHTML += `
            <div class="bg-white border shadow rounded-lg p-6 hover:scale-[1.02] transition-transform border-black">
                <div class="text-xl font-semibold mb-2">#${player.rank} — ${player.username}</div>
                <div class="text-sm text-gray-600 space-y-1">
                    <p><strong>${currentFilter.label}:</strong> ${player[currentFilter.field]} ${currentFilter.unit}</p>
                </div>
            </div>
        `;
            });
        }

        // Filter button click handler
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter');
                loadLeaderboard(filter);
            });
        });

        // Initial load
        loadLeaderboard();
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

</body>

</html>