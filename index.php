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

        .typing::after {
            content: '|';
            animation: blink 1s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        #burnProgress::after {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.4) 50%,
                    rgba(255, 255, 255, 0) 100%);
            transform: skewX(-20deg);
            animation: shimmer 1.5s infinite linear;

        }


        @keyframes shimmer {
            0% {
                left: -150%;
            }

            100% {
                left: 100%;
            }
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
                <div class="text-2xl  text-black-600 hover:scale-105 transition-transform cursor-pointer welcome-font">
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
                <!-- Login Dropdown (Improved Hover Handling) -->
                <div class="hidden md:block relative" id="login-container">
                    <button id="login-toggle"
                        class="flex items-center gap-1 font-medium text-gray-700 hover:text-blue-600 transition-all">
                        <?php echo htmlspecialchars($user) ?>
                        <svg class="w-4 h-4 transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="login-dropdown"
                        class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow-lg opacity-0 scale-95 transform transition duration-200 origin-top-right pointer-events-none z-50">
                        <!-- Will be filled dynamically -->
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
            <a href="https://open.spotify.com/playlist/0oPyDVNdgcPFAWmOYSK7O1?si=ed75af46075d44a2" target="_blank" rel="noopener noreferrer"
                class="block hover:text-blue-600">
                Music
            </a>
            <div class="border-t pt-2" id="mobile-auth">
                <!-- Will be filled dynamically -->
            </div>

        </div>
    </nav>




    <!-- Greeting Section -->
    <div id="greeting" class="text-center mt-12 px-4 sm:px-6 lg:px-8">
        <p id="today" class="text-md text-gray-500"></p>
        <h1 id="welcome"
            class="text-[32px] sm:text-[40px] md:text-[56px] lg:text-[60px] xl:text-[70px] mt-2 welcome-font">
        </h1>
    </div>

    <div class="w-full max-w-6xl mx-auto flex flex-col items-center justify-center space-y-10 px-4">
        <div class="w-full max-w-xl text-center">
            <div class="w-full bg-gray-200 h-5 rounded-full overflow-hidden mb-2 shadow-inner border border-black">
                <div id="burnProgress" class="h-full w-0 transition-all duration-300"
                    style="background: linear-gradient(to right, #34D399, #FBBF24, #EF4444); position: relative; overflow: hidden;">
                </div>
            </div>
            <p id="burnStatus" class="text-sm font-medium text-gray-700">your burn meter:</p>
        </div>

        <div class="w-full overflow-x-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
                <!-- TODAY STATS CARD -->
                <div class="p-6 sm:p-8 bg-white border rounded-2xl shadow-lg w-full border-black">
                    <h2 class="font-bold text-lg mb-6 text-gray-800">YOUR STATS:</h2>
                    <div class="space-y-4">
                        <div class="bg-gray-100 p-3 rounded-xl flex justify-between items-center">
                            <span>Total Study Time:</span>
                            <span id="totalTime" class="font-semibold">0 mins</span>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-xl flex justify-between items-center">
                            <span>Sessions Completed:</span>
                            <span id="sessions" class="font-semibold">0</span>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-xl flex justify-between items-center">
                            <span>Streak:</span>
                            <span id="streak" class="font-semibold">0</span>
                        </div>
                    </div>
                </div>

                <!-- STUDY TIMER CARD -->
                <div class="p-6 sm:p-8 bg-white border rounded-2xl shadow-lg w-full border-black">
                    <!-- Modal Overlay -->
                    <div id="modal-overlay"
                        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
                        <div id="modal"
                            class="bg-white p-6 sm:p-8 rounded-lg shadow-lg transform scale-0 transition-all duration-300 ease-out">
                            <p id="modal-message" class="text-xl font-semibold text-gray-800 mb-4"></p>
                            <div class="flex justify-end">
                                <button id="modal-close-btn"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">OK</button>
                            </div>
                        </div>
                    </div>

                    <!-- Countdown Overlay -->
                    <div id="countdown-overlay"
                        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
                        <div id="countdown-modal"
                            class="bg-white p-6 sm:p-8 rounded-lg shadow-lg transform scale-0 transition-all duration-300 ease-out">
                            <p class="text-xl font-semibold text-gray-800 mb-4">Starting in...</p>
                            <div id="modal-countdown"
                                class="text-5xl font-bold text-blue-600 flex justify-center items-center">3</div>
                        </div>
                    </div>

                    <h2 class="font-bold text-lg mb-4 text-gray-800">STUDY TIMER:</h2>
                    <div class="text-4xl font-semibold text-gray-900 mb-4" id="timer">25:00</div>
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="study-duration" class="block text-sm font-medium text-gray-700">Study Duration
                                (minutes):</label>
                            <input type="number" id="study-duration"
                                class="mt-1 p-2 border rounded-md w-full text-center  disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed" value="25" min="1">
                        </div>
                        <div>
                            <label for="break-duration" class="block text-sm font-medium text-gray-700">Break Duration
                                (minutes):</label>
                            <input type="number" id="break-duration"
                                class="mt-1 p-2 border rounded-md w-full text-center  disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed" value="5" min="1">
                        </div>
                    </div>
                    <div class="mt-6 flex flex-col sm:flex-row gap-2">
                        <button id="start-session-btn-bottom" onclick="prepareStartSession()"
                            class="bg-black text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-700 transition w-full sm:w-1/2 border-black">
                            Start
                        </button>
                        <button id="view-progress-btn"
                            class="bg-white border px-4 py-2 rounded-full shadow hover:bg-gray-100 transition w-full sm:w-1/2 border-black"
                            onclick="location.href='progress.php'">
                            View Progress
                        </button>
                        <button id="pause-timer-btn" onclick="pauseTimer()"
                            class="bg-yellow-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-yellow-700 transition w-full sm:w-1/2 hidden">Pause</button>
                        <button id="reset-timer-btn" onclick="resetTimer()"
                            class="bg-red-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-red-700 transition w-full sm:w-1/2 hidden">Reset</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <br>
    <br>


    <script>
        // ------------------------------------ Date & Time ------------------------------------ //
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

        // ------------------------------------ Mobile Menu Toggle ------------------------------------ //
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // ------------------------------------ Welcome Card Typing ------------------------------------ //
        const typingSpeed = 100;
        const delayBetweenLoops = 10000;
        const welcomeEl = document.getElementById("welcome");

        function getUsername() {
            const rawName = getCookie("username") || "User";
            return rawName
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
                .join(' ');
        }

        function updateUsername(newUsername) {
            localStorage.setItem("username", newUsername);
            welcomeEl.textContent = '';
            startTypingLoop();
        }

        function getGreetingText() {
            const name = getUsername();
            const hour = new Date().getHours();
            let greeting = "Hello";
            if (hour >= 5 && hour < 12) greeting = "Good Morning";
            else if (hour >= 12 && hour < 18) greeting = "Good Afternoon";
            else greeting = "Good Evening";
            return `${greeting}, ${name}!`;
        }

        function typeText(text, callback) {
            let i = 0;
            welcomeEl.classList.add("typing");
            const typingInterval = setInterval(() => {
                welcomeEl.textContent = text.slice(0, i + 1);
                i++;
                if (i === text.length) {
                    clearInterval(typingInterval);
                    welcomeEl.classList.remove("typing");
                    if (callback) callback();
                }
            }, typingSpeed);
        }

        function startTypingLoop() {
            const message = getGreetingText();
            typeText(message, () => {
                setTimeout(() => {
                    welcomeEl.textContent = '';
                    startTypingLoop();
                }, delayBetweenLoops);
            });
        }
        startTypingLoop();

        function handleLogin(loggedInUsername) {
            document.cookie = `username=${loggedInUsername}; path=/;`;
            welcomeEl.textContent = '';
            startTypingLoop();
            console.log(`Username updated to: ${loggedInUsername}`);
        }

        // ------------------------------------ Pomodoro Timer ------------------------------------ //

        let timerInterval;
        let timeLeft;
        let studyDuration = 25 * 60;
        let breakDuration = 5 * 60;
        let isStudy = true;
        let isTimerRunning = false;
        let resumeFromPause = false;

        // DOM Elements
        const timerDisplay = document.getElementById('timer');
        const studyDurationInput = document.getElementById('study-duration');
        const breakDurationInput = document.getElementById('break-duration');
        const startSessionBtnBottom = document.getElementById('start-session-btn-bottom');
        const viewProgressBtn = document.getElementById('view-progress-btn');
        const pauseTimerBtn = document.getElementById('pause-timer-btn');
        const resetTimerBtn = document.getElementById('reset-timer-btn');
        const countdownOverlay = document.getElementById('countdown-overlay');
        const countdownModal = document.getElementById('countdown-modal');
        const modalCountdown = document.getElementById('modal-countdown');
        const alertOverlay = document.getElementById('modal-overlay');
        const alertModal = document.getElementById('modal');
        const alertMessage = document.getElementById('modal-message');
        const alertCloseButton = document.getElementById('modal-close-btn');
        const burnProgress = document.getElementById('burnProgress');

        // -------- Timer Functions -------- //

        function showAlert(message) {
            alertMessage.textContent = message;
            alertOverlay.classList.remove('hidden');
            alertModal.classList.remove('scale-0');
        }

        alertCloseButton.addEventListener('click', () => {
            alertOverlay.classList.add('hidden');
            alertModal.classList.add('scale-0');
        });

        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60).toString().padStart(2, '0');
            const seconds = (timeLeft % 60).toString().padStart(2, '0');
            timerDisplay.textContent = `${minutes}:${seconds}`;
        }

        function updateBurnMeter() {
            const total = isStudy ? studyDuration : breakDuration;
            const elapsed = total - timeLeft;
            const percentage = (elapsed / total) * 100;
            burnProgress.style.width = `${Math.max(0, Math.min(100, percentage))}%`;
        }

        function lockDurationInputs() {
            studyDurationInput.disabled = true;
            breakDurationInput.disabled = true;
        }

        function unlockDurationInputs() {
            studyDurationInput.disabled = false;
            breakDurationInput.disabled = false;
        }


        function startSession() {
            console.trace('startSession() called');
            lockDurationInputs();
            studyDuration = parseInt(studyDurationInput.value) * 60;
            breakDuration = parseInt(breakDurationInput.value) * 60;
            const username = getCookie('username');
            const today = new Date().toISOString().split('T')[0]; // yyyy-mm-dd

            // Save to logs table (INSERT or UPDATE)
            if (username) {
                fetch('save_log.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            username: username,
                            date: today,
                            studytime: parseInt(studyDurationInput.value),
                            breaktime: parseInt(breakDurationInput.value)
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Log saved/updated successfully');
                        } else {
                            console.error('Failed to save log:', data.error);
                        }
                    })
                    .catch(error => console.error('Error saving log:', error));
            }

            // Timer setup
            if (!resumeFromPause) timeLeft = isStudy ? studyDuration : breakDuration;

            updateTimerDisplay();
            updateBurnMeter();
            isTimerRunning = true;
            resumeFromPause = false;

            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                if (isTimerRunning) {
                    timeLeft--;
                    updateTimerDisplay();
                    updateBurnMeter();
                    if (timeLeft <= 0) handleSessionEnd();
                }
            }, 1000);

            startSessionBtnBottom.classList.add('hidden');
            viewProgressBtn.classList.add('hidden');
            pauseTimerBtn.classList.remove('hidden');
            resetTimerBtn.classList.remove('hidden');
            pauseTimerBtn.disabled = false;
            resetTimerBtn.textContent = "Reset";
            resetTimerBtn.onclick = resetTimer;
        }


        function handleSessionEnd() {
            clearInterval(timerInterval);
            isTimerRunning = false;
            pauseTimerBtn.classList.add('hidden');
            resetTimerBtn.classList.add('hidden');

            if (isStudy) {
                showAlert("Study session over! Time for a break.");
                isStudy = false;
                timeLeft = breakDuration;
                startSessionBtnBottom.textContent = "Start Break";
            } else {
                showAlert("Break over! Back to studying.");
                isStudy = true;
                timeLeft = studyDuration;
                startSessionBtnBottom.textContent = "Start Study Session";
                unlockDurationInputs();
            }

            updateTimerDisplay();
            updateBurnMeter();

            startSessionBtnBottom.classList.remove('hidden');
            viewProgressBtn.classList.remove('hidden');
        }


        let countdownRunning = false;

        function prepareStartSession() {
            if (countdownRunning) return; // ignore if countdown already running

            countdownRunning = true;
            countdownOverlay.classList.remove('hidden');
            countdownModal.classList.remove('scale-0');
            let countdown = 3;
            modalCountdown.textContent = countdown;

            const countdownInterval = setInterval(() => {
                countdown--;
                modalCountdown.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    countdownOverlay.classList.add('hidden');
                    countdownModal.classList.add('scale-0');
                    countdownRunning = false;

                    // ✅ Only call startSession if NOT Start Break
                    if (startSessionBtnBottom.textContent === "Start Break") {
                        console.log("Start Break clicked — starting break timer only");
                        startTimerOnly();
                    } else {
                        startSession(); // Normal session start (with logging)
                    }
                }
            }, 1000);
        }


        function startTimerOnly() {
            lockDurationInputs();
            if (!resumeFromPause) timeLeft = breakDuration;

            updateTimerDisplay();
            updateBurnMeter();
            isTimerRunning = true;
            resumeFromPause = false;

            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                if (isTimerRunning) {
                    timeLeft--;
                    updateTimerDisplay();
                    updateBurnMeter();
                    if (timeLeft <= 0) handleSessionEnd();
                }
            }, 1000);

            startSessionBtnBottom.classList.add('hidden');
            viewProgressBtn.classList.add('hidden');
            pauseTimerBtn.classList.remove('hidden');
            resetTimerBtn.classList.remove('hidden');
            pauseTimerBtn.disabled = false;
            resetTimerBtn.textContent = "Reset";
            resetTimerBtn.onclick = resetTimer;
        }



        function pauseTimer() {
            clearInterval(timerInterval);
            isTimerRunning = false;
            resumeFromPause = true;

            pauseTimerBtn.classList.add('hidden');
            resetTimerBtn.textContent = "Resume";
            resetTimerBtn.onclick = prepareStartSession;
            startSessionBtnBottom.classList.add('hidden');
            viewProgressBtn.classList.add('hidden');
        }

        function resetTimer() {
            if (!confirm("Are you sure you want to reset the session?")) return;
            clearInterval(timerInterval);
            isTimerRunning = false;
            isStudy = true;
            timeLeft = studyDuration;
            updateTimerDisplay();
            updateBurnMeter();

            unlockDurationInputs();

            startSessionBtnBottom.textContent = "Start";
            startSessionBtnBottom.onclick = prepareStartSession;
            pauseTimerBtn.classList.add('hidden');
            resetTimerBtn.classList.add('hidden');
            startSessionBtnBottom.classList.remove('hidden');
            viewProgressBtn.classList.remove('hidden');
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

        // -------- Page Navigation Prevention -------- //

        document.querySelectorAll('a[href]').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = link.getAttribute('href');
                const isInternalLink = href.startsWith('#') || href === 'javascript:void(0)';
                const isLogout = href.includes('logout.php');

                if (isTimerRunning && !isInternalLink && !isLogout) {
                    e.preventDefault();
                    showAlert('You cannot switch pages while the timer is running.');
                }
            });
        });

        window.addEventListener('beforeunload', (e) => {
            if (isTimerRunning) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        // -------- Event Listeners -------- //

        startSessionBtnBottom.addEventListener('click', prepareStartSession);
        pauseTimerBtn.addEventListener('click', pauseTimer);
        resetTimerBtn.addEventListener('click', resetTimer);
        viewProgressBtn.addEventListener('click', () => showAlert('Progress tracking is disabled in this version.'));

        studyDurationInput.addEventListener('change', () => {
            if (!isTimerRunning) {
                studyDuration = parseInt(studyDurationInput.value) * 60;
                if (isStudy) {
                    timeLeft = studyDuration;
                    updateTimerDisplay();
                    updateBurnMeter();
                }
            }
        });

        breakDurationInput.addEventListener('change', () => {
            if (!isTimerRunning) {
                breakDuration = parseInt(breakDurationInput.value) * 60;
                if (!isStudy) {
                    timeLeft = breakDuration;
                    updateTimerDisplay();
                    updateBurnMeter();
                }
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            fetch('get-stats.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalTime').textContent = `${data.totalTime} mins`;
                    document.getElementById('sessions').textContent = data.sessions;
                    document.getElementById('streak').textContent = data.streak;

                    if (data.newlyUnlocked.length > 0) {
                        data.newlyUnlocked.forEach(ach => {
                            showAlert(`🎉 Achievement Unlocked: ${ach.name} - ${ach.description}`);
                        });
                    }
                })
                .catch(error => console.error('Error fetching stats:', error));

        });
    </script>
</body>

</html>