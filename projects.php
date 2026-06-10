<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Samuel Švach - Projects</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Sans:wght@300;400;500;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <script>
        (function () {
            const saved = localStorage.getItem('theme');
            const system = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
            const theme = saved || system;
            if (theme === 'light') {
                document.documentElement.dataset.theme = 'light';
            } else {
                document.documentElement.removeAttribute('data-theme');
            }
        })();
    </script>
    <style>
        :root {
            --font-display: "Playfair Display", serif;
            --font-serif:   "Cormorant Garamond", serif;
            --font-sans:    "DM Sans", system-ui, sans-serif;
            --on-img:       #ffffff;
            --on-img-muted: rgba(255,255,255,.65);

            /* Dark Theme */
            --bg:            #0a0a0a;
            --surface:       #131313;
            --surface-2:     #1c1c1c;
            --text:          #e8e8e8;
            --text-sub:      #cecece;
            --text-muted:    #8a8a8a;
            --text-faint:    #5a5a5a;
            --accent:        #c9a96e;
            --accent-strong: #e2c98a;
            --border:        rgba(255,255,255,.10);
            --logo-1:        #b0b0b0;
            --logo-2:        #5a5a5a;
        }

        /* Light Theme */
        :root[data-theme="light"] {
            --bg:            #f7f6f3;
            --surface:       #ffffff;
            --surface-2:     #eeebe6;
            --text:          #1a1a1a;
            --text-sub:      #2e2e2e;
            --text-muted:    #6b6b6b;
            --text-faint:    #9a9a9a;
            --accent:        #a8863f;
            --accent-strong: #c9a96e;
            --border:        #ddd9d0;
            --logo-1:        #909090;
            --logo-2:        #2e2e2e;
        }

        #icon-sun  { display: none; }
        #icon-moon { display: block; }
        :root[data-theme="light"] #icon-sun  { display: block; }
        :root[data-theme="light"] #icon-moon { display: none; }

        :root[data-theme="light"] nav {
            background: rgba(247,246,243,.88);
            border-bottom-color: rgba(0,0,0,.08);
        }
        :root[data-theme="light"] #mobileMenu {
            background-color: var(--bg);
        }
    </style>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
</head>
<body class="bg-[var(--bg)]">

<nav class="fixed top-0 w-full z-40 bg-zinc-950/80 backdrop-blur-md border-b border-white/5 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <!-- Logo + Text -->
        <a href="index.php" class="flex items-center gap-2 group">
            <div class="w-10 h-10 md:w-12 md:h-12">
                <svg viewBox="0 0 294.93 260.03" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="h-full w-full">
                    <defs>
                        <linearGradient id="planetGrad1" x1="51.3" y1="44.48" x2="243.15" y2="215.95" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="var(--logo-1)"/>
                            <stop offset="1" stop-color="var(--logo-2)"/>
                        </linearGradient>
                        <linearGradient id="planetGrad2" x1="23.24" y1="29.76" x2="258.31" y2="239.87" gradientUnits="userSpaceOnUse">
                            <stop offset=".06" stop-color="var(--logo-1)"/>
                            <stop offset="1" stop-color="var(--logo-2)"/>
                        </linearGradient>
                    </defs>
                    <path fill="url(#planetGrad1)" d="M274.86,114.87c.22,1.85.39,3.7.52,5.57,7.05-6.9,12.36-13.54,15.66-19.7-5.18,4.75-10.58,9.47-16.18,14.13ZM277.42,71.52c.2.16.38.33.56.5l.07-.4c-.21-.04-.42-.07-.63-.1ZM271.92,142.81c-42.03,32.14-86.02,53.03-122.29,60.41-12.42,2.53-23.94,3.47-34.17,2.73-2.27-.17-4.49-.41-6.64-.76h0s-.03-.01-.04-.01c.68-.25,1.36-.51,2.05-.78h.01c14.06-5.46,28.69-11.81,43.58-19,32.03-10.73,69.16-30.81,105.4-58.52,5.16-3.95,10.18-7.96,15.05-12.01-.51-4.42-1.26-8.79-2.22-13.09-.13-.63-.28-1.26-.44-1.88-.04-.01-.09-.01-.13-.01-49.03-3.1-80.23,11.53-93.71,19.83.63,1.97.65,4.16-.07,6.27-1.79,5.22-7.47,8.01-12.7,6.22-5.22-1.79-8.01-7.47-6.22-12.7,1.79-5.22,7.47-8.01,12.7-6.22,1.75.6,3.22,1.63,4.34,2.94,13.86-8.51,45.48-23.26,94.76-20.39-2.09-7.68-4.88-15.1-8.3-22.19-.86-.08-1.71-.16-2.57-.23-37.65-3.11-64.22,5.69-78.73,12.65.64,2.12.58,4.47-.32,6.68-2.1,5.11-7.94,7.55-13.05,5.45-5.1-2.09-7.55-7.93-5.45-13.04,2.1-5.11,7.94-7.55,13.04-5.45,1.56.64,2.87,1.63,3.88,2.84,14.93-7.18,42.3-16.32,80.96-13.12.04,0,.08.01.12.01C241.98,33.86,207.01,7.47,164.14,1.33c-49.41-7.08-96.3,14.62-123.7,52.38,15.59-9.19,35.56-17.04,58.42-17.13.21-.81.53-1.6.96-2.36,2.73-4.8,8.83-6.49,13.63-3.76,4.81,2.73,6.49,8.83,3.76,13.63-2.72,4.8-8.83,6.49-13.63,3.76-2.79-1.59-4.53-4.33-4.96-7.28-25.11.17-46.92,10.07-63.79,21.54-6.54,10.65-11.6,22.38-14.88,34.94,10.59-10.5,28.46-24.13,51.47-26.46.09-.51.22-1.02.39-1.53,1.79-5.23,7.48-8.01,12.7-6.23,5.22,1.79,8.01,7.48,6.22,12.7-1.79,5.22-7.47,8.01-12.69,6.22-3.38-1.15-5.73-3.93-6.5-7.16-25.47,2.7-44.37,20.03-53.32,30.07-.46,2.29-.86,4.6-1.19,6.93-1.31,9.13-1.63,18.17-1.05,27.02,7.64-8.74,22.14-22.23,41.3-25.78.07-.71.23-1.42.47-2.13,1.79-5.22,7.47-8.01,12.7-6.22,5.22,1.79,8.01,7.47,6.22,12.7-1.79,5.22-7.47,8.01-12.69,6.22-3.16-1.08-5.43-3.59-6.33-6.55-20.01,3.95-34.95,19.79-41.17,27.46,1.51,13.85,5.25,27.15,10.87,39.5,9.14-12.5,28.77-33.47,60.2-38.5.04-.83.19-1.66.45-2.48,1.68-5.18,7.3-7.84,12.56-5.93,5.26,1.91,8.17,7.65,6.5,12.84-1.68,5.18-7.3,7.83-12.56,5.93-3.07-1.11-5.35-3.54-6.36-6.41-31.65,5.08-50.76,27.05-58.83,38.64,2,4.02,4.21,7.94,6.62,11.72,3.5,5.54,7.43,10.8,11.73,15.74,19.76,22.73,47.48,38.74,79.63,43.34,71.08,10.18,136.94-39.19,147.11-110.26.4-2.76.7-5.51.92-8.25-1.13.87-2.26,1.75-3.4,2.62Z"/>
                    <path fill="url(#planetGrad2)" d="M291.05,100.72h-.01v.02c-3.3,6.16-8.61,12.8-15.66,19.7-22.32,21.84-62,46.21-109.89,65.64-19.59,7.95-38.74,14.34-56.67,19.11h0c-22.96,6.1-43.9,9.54-61.15,10.17-24.88.92-42.08-4-46.54-15.19-3.57-8.98,1.54-20.77,13.29-33.71-5.7,8-7.79,15.16-5.52,20.88,2.91,7.32,12.59,11.34,27.04,12.28,28.32,1.86,74.97-8.12,124.79-28.34,52.03-21.11,93.9-47.85,111.92-69.5,8.05-9.66,11.35-18.3,8.69-24.98-.71-1.79-1.84-3.39-3.35-4.78-.18-.17-.36-.34-.56-.5h-.01c-2.01-1.73-4.63-3.13-7.79-4.23,12.68,2.04,21.23,6.7,24.19,14.12,2.19,5.51,1.12,12.07-2.76,19.31Z"/>
                </svg>
            </div>
            <span class="text-lg text-[var(--text)] md:text-xl font-medium tracking-widest serif">Samuel Švach</span>
        </a>

        <!-- Links -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium tracking-wide absolute left-1/2 -translate-x-1/2">
            <a href="index.php" class="text-[var(--text)] hover:text-[var(--text-muted)] transition-colors duration-500">Back to Portfolio</a>
        </div>

        <!-- Get in Touch Button + Burger menu -->
        <div class="flex items-center gap-4">
            <button id="theme-toggle"
                    class="w-9 h-9 flex items-center justify-center rounded-full text-[var(--text)] hover:text-[var(--accent)] transition-colors duration-500">
                <svg id="icon-moon" class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9z"/>
                </svg>
                <svg id="icon-sun" class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4"/>
                    <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>
                </svg>
            </button>
            <a href="index.php#Contact" class="hidden md:inline-flex items-center justify-center px-6 py-2 bg-[var(--text)] text-[var(--bg)] rounded-full text-sm font-medium hover:bg-[var(--text-muted)] transition-colors duration-500">Get in Touch</a>
            <button id="burger" class="md:hidden flex flex-col gap-1.5 p-2">
                <span class="w-6 h-0.5 bg-[var(--text)] transition-all duration-500"></span>
                <span class="w-6 h-0.5 bg-[var(--text)] transition-all duration-500"></span>
                <span class="w-6 h-0.5 bg-[var(--text)] transition-all duration-500"></span>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile nav -->
<div id="mobileMenu" class="fixed inset-0 z-50 bg-[var(--bg)] flex flex-col items-center justify-center gap-10 translate-x-full transition-transform duration-500">
    <button id="closeMenu" class="absolute top-6 right-6 text-[var(--text)] text-2xl">✕</button>
    <a href="index.php" class="text-4xl font-['Playfair_Display'] text-[var(--text)] hover:text-[var(--text-muted)] transition-colors">Back to Portfolio</a>
    <a href="index.php#Contact" class="mt-4 px-8 py-3 bg-[var(--text)] text-[var(--bg)] hover:bg-[var(--text-muted)] rounded-full font-medium">Get in Touch</a>
</div>

<script>
    document.getElementById('burger').addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.remove('translate-x-full');
    });
    document.getElementById('closeMenu').addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.add('translate-x-full');
    });

    const root = document.documentElement;

    /* theme toggler */
    document.getElementById('theme-toggle').addEventListener('click', () => {
        const isLight = root.dataset.theme === 'light';
        if (isLight) {
            root.removeAttribute('data-theme');
            localStorage.setItem('theme', 'dark');
        } else {
            root.dataset.theme = 'light';
            localStorage.setItem('theme', 'light');
        }
    });

    /* javascript that close mobile menu after you click a link */
    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobileMenu').classList.add('translate-x-full');
        });
    });
</script>

<section id="Projects" class="section-bg pt-32 pb-16 px-8 bg-[var(--bg)]">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-center text-5xl text-[var(--text)] font-['Playfair_Display'] mb-10">Select a Project</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <!-- 1ST PROJECT -->
            <div data-project="python-storage" class="group relative overflow-hidden cursor-pointer h-80 fade-up delay-1">
                <img src="img/project1.png" alt="Python Storage" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent duration-300 group-hover:opacity-90"></div>
                <div class="absolute bottom-0 p-6">
                    <h3 class="text-white text-2xl font-['Cormorant_Garamond'] italic mb-1">Python Storage</h3>
                    <p class="text-white/60 text-xs mb-2">Easy storage written in Python containing all essential functions.</p>
                    <span class="text-white text-xs uppercase border-b border-white/40 pb-0.5 group-hover:border-white transition-colors duration-500">VIEW PROJECT</span>
                </div>
            </div>

            <!-- 2ND PROJECT -->
            <div data-project="home-server" class="group relative overflow-hidden cursor-pointer h-80 fade-up delay-1">
                <img src="img/project2.jpg" alt="Home Server" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent duration-300 group-hover:opacity-90"></div>
                <div class="absolute bottom-0 p-6">
                    <h3 class="text-white text-2xl font-['Cormorant_Garamond'] italic mb-1">Home Server</h3>
                    <p class="text-white/60 text-xs mb-2">Home Server made for running things locally.</p>
                    <span class="text-white text-xs uppercase border-b border-white/40 pb-0.5 group-hover:border-white transition-colors duration-500">VIEW PROJECT</span>
                </div>
            </div>

            <!-- 3RD PROJECT -->
            <div data-project="c-storage" class="group relative overflow-hidden cursor-pointer h-80 fade-up delay-1">
                <img src="img/project3.png" alt="C Storage" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent duration-300 group-hover:opacity-90"></div>
                <div class="absolute bottom-0 p-6">
                    <h3 class="text-white text-2xl font-['Cormorant_Garamond'] italic mb-1">C Storage</h3>
                    <p class="text-white/60 text-xs mb-2">Easy storage written in C containing all essential functions.</p>
                    <span class="text-white text-xs uppercase border-b border-white/40 pb-0.5 group-hover:border-white transition-colors duration-500">VIEW PROJECT</span>
                </div>
            </div>

            <!-- 4TH PROJECT -->
            <div data-project="platform-game" class="group relative overflow-hidden cursor-pointer h-80 fade-up delay-1">
                <img src="img/project4.png" alt="Platform Game"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent duration-300 group-hover:opacity-90"></div>
                <div class="absolute bottom-0 p-6">
                    <h3 class="text-white text-2xl font-['Cormorant_Garamond'] italic mb-1">Platform Game</h3>
                    <p class="text-white/60 text-xs mb-2">Platform catcher game written in HTML, CSS and JS.</p>
                    <span class="text-white text-xs uppercase border-b border-white/40 pb-0.5 group-hover:border-white transition-colors duration-500">VIEW PROJECT</span>
                </div>
            </div>

            <!-- 5TH PROJECT -->
            <div data-project="php-forum" class="group relative overflow-hidden cursor-pointer h-80 fade-up delay-1">
                <img src="img/project5.png" alt="PHP Forum"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent duration-300 group-hover:opacity-90"></div>
                <div class="absolute bottom-0 p-6">
                    <h3 class="text-white text-2xl font-['Cormorant_Garamond'] italic mb-1">PHP Forum</h3>
                    <p class="text-white/60 text-xs mb-2">PHP Forum featuring all essential functions.</p>
                    <span class="text-white text-xs uppercase border-b border-white/40 pb-0.5 group-hover:border-white transition-colors duration-500">VIEW PROJECT</span>
                </div>
            </div>

            <!-- 6TH PROJECT -->
            <div data-project="openastrotracker" class="group relative overflow-hidden cursor-pointer h-80">
                <img src="img/project6.png" alt="OpenAstroTracker"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent duration-300 group-hover:opacity-90"></div>
                <div class="absolute bottom-0 p-6">
                    <h3 class="text-white text-2xl font-['Cormorant_Garamond'] italic mb-1">OpenAstroTracker</h3>
                    <p class="text-white/60 text-xs mb-2">Self-built open-source DIY equatorial mount for astrophotography.</p>
                    <span class="text-white text-xs uppercase border-b border-white/40 pb-0.5 group-hover:border-white transition-colors duration-500">VIEW PROJECT</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<div id="project-modal" aria-hidden="true"
     class="group fixed inset-0 z-[1000] flex items-center justify-center p-6 bg-black/60 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-500 [&.open]:opacity-100 [&.open]:pointer-events-auto">
    <div role="dialog" aria-modal="true" aria-labelledby="m-title"
         class="relative w-full max-w-3xl max-h-[88vh] overflow-y-auto rounded-md bg-[var(--surface)] border border-[var(--border)] translate-y-6 scale-[.985] opacity-0 transition-all duration-500 group-[.open]:translate-y-0 group-[.open]:scale-100 group-[.open]:opacity-100">
        <button id="m-close" aria-label="Close" class="absolute top-4 right-4 z-10 w-9 h-9 flex items-center justify-center rounded-full bg-[var(--bg)] text-[var(--text)] border border-white/20 hover:bg-black/70 transition-all duration-300">&#10005;</button>
        <div class="relative h-44 sm:h-56 overflow-hidden rounded-t-md bg-[var(--surface-2)] after:content-[''] after:absolute after:inset-0 after:bg-gradient-to-t after:from-black/50 after:to-transparent">
            <img id="m-image" src="" alt="" class="w-full h-full object-cover">
        </div>
        <div class="p-6 sm:p-9">
            <h2 id="m-title" class="font-['Playfair_Display'] font-semibold text-2xl sm:text-3xl leading-tight text-[var(--text)] mb-1"></h2>
            <p id="m-tagline" class="font-['Cormorant_Garamond'] italic text-xl text-[var(--text-sub)] mb-6"></p>
            <p id="m-overview" class="text-sm leading-relaxed text-[var(--text-muted)]"></p>
            <h4 class="font-['Playfair_Display'] text-base text-[var(--text)] mt-7 mb-3">Key Features</h4>
            <ul id="m-features" class="grid gap-2"></ul>
            <h4 class="font-['Playfair_Display'] text-base text-[var(--text)] mt-7 mb-3">Built With</h4>
            <div id="m-tech" class="flex flex-wrap gap-2"></div>
            <div id="m-links" class="flex flex-wrap gap-3 mt-8"></div>
        </div>
    </div>
</div>

<script>
    (function () {

        /* project data */
        const projects = {
            'python-storage': {
                title: 'Python Storage',
                tagline: 'A clean easy python storage.',
                image: 'img/project1.png',
                overview: 'A lightweight storage utility in Python that wraps the essential read/write operations behind a simple API.',
                features: ['Simple API for storing and retrieving data', 'Covers the essential CRUD operations', 'Reusable across projects with zero setup'],
                tech: ['Python'], links: { code: 'https://github.com/Soromanko/Storage' },
            },
            'home-server': {
                title: 'Home Server',
                tagline: 'My own home server running 24/7.',
                image: 'img/project2.jpg',
                overview: 'A self-hosted home server running a Docker stack — Home Assistant, Pi-hole and more — where I learn infrastructure by running it.',
                features: ['Dockerized service stack', 'Runs 24/7 with low power draw', 'Remote access via Cloudflare Tunnel'],
                tech: ['Docker', 'Linux', 'Home Assistant'], links: {},
            },
            'c-storage': {
                title: 'C Storage',
                tagline: 'Storage with dynamic memory management.',
                image: 'img/project3.png',
                overview: 'A storage / inventory system in C with dynamic memory management and EAN validation.',
                features: ['Dynamic memory management', 'EAN code validation', 'Add, search and remove records'],
                tech: ['C'], links: {code: 'https://github.com/Soromanko/skladovehospodarstvi' },
            },
            'platform-game': {
                title: 'Platform Game',
                tagline: 'Catch the gold, dodge the bombs.',
                image: 'img/project4.png',
                overview: 'A browser-based catcher game built from scratch in vanilla JavaScript. Move the platform to collect falling golden balls for points — but watch out for bombs, each one costs you a life.',
                features: [
                    'Custom collision detection written from scratch',
                    'Score tracking with personal best',
                    'Lives system with 3 hearts',
                    'Increasing difficulty over time',
                ],
                tech: ['HTML', 'CSS', 'JavaScript'],
                links: { code: 'https://github.com/Soromanko/platform_game', demo: 'https://soromanko.github.io/platform_game/' },
            },
            'php-forum': {
                title: 'PHP Forum',
                tagline: 'A full user forum — no database required.',
                image: 'img/project5.png',
                overview: 'A fully functional forum built in PHP with a flat-file backend — all posts and users are stored in plain text files, no database needed. Supports user registration, login, post creation and admin controls.',
                features: [
                    'User registration and login with hashed passwords',
                    'Post feed with author name, avatar and publish date',
                    'Profile pages with changeable profile pictures',
                    'Admin role with post deletion rights',
                    'Flat-file storage — no database required',
                ],
                tech: ['PHP', 'HTML', 'CSS'],
                links: { code: 'https://github.com/Soromanko/zaverecnaPrace' },
            },
            'openastrotracker': {
                title: 'OpenAstroTracker',
                tagline: 'Self-built equatorial mount for astrophotography.',
                image: 'img/project6.png',
                overview: 'A fully self-assembled equatorial tracking mount based on the open-source OpenAstroTracker project. Built from 3D printed parts, stepper motors and an Arduino — it compensates for Earth\'s rotation to allow long-exposure astrophotography without star trails.',
                features: [
                    '3D printed structure printed on a Bambu Lab P2S',
                    'Arduino-controlled stepper motors for precise RA tracking',
                    'Polar alignment assistance built into the firmware',
                    'Control via LCD keypad, USB and WiFi',
                    'Used with Nikon D3100',
                ],
                tech: ['3D Printing', 'IOT', 'Electronics', 'Astrophotography'],
                links: { code: 'https://wiki.openastrotech.com/en/OpenAstroTracker' },
            },
        };

        const modal = document.getElementById('project-modal');
        const $ = id => document.getElementById(id);
        let lastFocused = null;

        function open(id) {
            const p = projects[id]; if (!p) return;
            $('m-image').src = p.image; $('m-image').alt = p.title;
            $('m-title').textContent = p.title;
            $('m-tagline').textContent = p.tagline || '';
            $('m-overview').textContent = p.overview;
            $('m-features').innerHTML = (p.features || []).map(f => `<li class="relative pl-5 text-sm leading-relaxed text-[var(--text-muted)] before:content-[''] before:absolute before:left-0 before:top-[0.55em] before:w-1.5 before:h-1.5 before:rounded-full before:bg-[var(--accent)]">${f}</li>`).join('');
            $('m-tech').innerHTML = (p.tech || []).map(t => `<span class="text-xs tracking-wide px-3 py-1 rounded-full border border-[var(--border)] text-[var(--text-muted)]">${t}</span>`).join('');
            $('m-links').innerHTML = Object.entries(p.links || {}).map(([k, url]) => `<a href="${url}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full border border-[var(--text)] text-[var(--text)] px-5 py-2.5 text-sm hover:bg-[var(--text)] hover:text-[var(--bg)] transition-colors duration-300">${k === 'demo' ? 'Live Demo' : 'View Code'}</a>`).join('');
            modal.querySelector('[role=dialog]').scrollTop = 0;
            modal.classList.add('open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');
            lastFocused = document.activeElement; $('m-close').focus();
        }
        function close() {
            modal.classList.remove('open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('overflow-hidden');
            if (lastFocused) lastFocused.focus();
        }

        $('m-close').addEventListener('click', close);
        modal.addEventListener('click', e => { if (e.target === modal) close(); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
        document.querySelectorAll('[data-project]').forEach(card => {
            card.tabIndex = 0;
            card.addEventListener('click', () => open(card.dataset.project));
            card.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(card.dataset.project); } });
        });
    })();
</script>
</body>
</html>