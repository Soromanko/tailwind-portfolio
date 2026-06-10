<?php
define('TURNSTILE_SECRET', getenv('TURNSTILE_SECRET'));
define('RESEND_KEY',       getenv('RESEND_KEY'));
define('MY_EMAIL',         'svach.samuel@email.cz');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars(trim($_POST['name']    ?? ''));
    $email   = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject'] ?? 'No subject'));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $token   = $_POST['cf-turnstile-response'] ?? '';

    $check = file_get_contents('https://challenges.cloudflare.com/turnstile/v0/siteverify', false,
            stream_context_create(['http' => [
                    'method'  => 'POST',
                    'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                    'content' => http_build_query(['secret' => TURNSTILE_SECRET, 'response' => $token]),
            ]])
    );
    $ok = json_decode($check, true)['success'] ?? false;

    if (!$ok)                               { $formError = 'Captcha failed — try again.'; }
    elseif (!$email || !$name || !$message) { $formError = 'Please fill in all required fields.'; }
    else {
        $payload = json_encode([
                'from'    => 'portfolio@samuelsvach.eu',
                'to'      => ['svach.samuel@email.cz'],
                'reply_to' => [$email],
                'subject' => "Portfolio contact: $subject",
                'text'    => "From: $name <$email>\n\n$message",
        ]);
        file_get_contents('https://api.resend.com/emails', false,
                stream_context_create(['http' => [
                        'method'  => 'POST',
                        'header'  => "Authorization: Bearer " . RESEND_KEY . "\r\nContent-Type: application/json\r\n",
                        'content' => $payload,
                ]])
        );
        header('Location: index.php?sent=1#Contact');
        exit;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Samuel Švach - Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Sans:wght@300;400;500;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <script>
        (function () {
            const saved = localStorage.getItem('theme'); //ověření zda už si uživatel nastavoval režim předtím
            const system = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark'; //výchozí režim v zařízení uživatele
            const theme = saved || system; //local storage > systémové nastavení
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
            --on-img:       #e8e8e8;
            --on-img-sub: #cecece;
            --on-img-muted: #8a8a8a;

            /* Dark Theme */
            --bg:            #0a0a0a;
            --surface:       #111111;
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
            --surface:       #eeebe6;
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
        :root[data-theme="light"] {
            background-color: var(--bg);
        }

        .hero-overlay {
            background: linear-gradient(to top, var(--bg), transparent);
        }
        :root[data-theme="light"] .hero-overlay {
            background: radial-gradient(ellipse 95% 75% at 50% 42%, rgba(0,0,0,.45), rgba(0,0,0,.15) 55%, transparent 80%);
        }

        .hero-title-1,
        .hero-title-2 { text-shadow: 0 2px 22px rgba(0,0,0,.45), 0 1px 4px rgba(0,0,0,.40); }
        .hero-desc    { text-shadow: 0 1px 12px rgba(0,0,0,.50); }

        html {
            scroll-behavior: smooth;
        }

        section[id] {
            scroll-margin-top: 80px;
        }
    </style>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
</head>
<body class="antialiased bg-[var(--bg)]">

<!-- NAV -->
<?php include 'nav.php'; ?>

<section id="Home" class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[var(--surface)]">
    <div class="absolute inset-0 z-0">
        <img src="img/hero_img.avif" alt="heroBackground" class="w-full h-full object-cover blur-sm"/>
    </div>

    <div class="hero-overlay absolute inset-0 z-10"></div>

    <!-- HERO CONTENT -->
    <div class="relative z-20 text-center max-w-3xl mx-auto px-8">
        <h1 class="font-['Playfair_Display']">
            <span class="hero-title-1 block text-4xl sm:text-5xl md:text-7xl font-semibold leading-tight text-[var(--on-img)]">Always</span>
            <span class="hero-title-2 block text-4xl sm:text-5xl md:text-7xl font-['Cormorant_Garamond'] italic font-normal leading-tight text-[var(--on-img-sub)]">Building Something</span>
        </h1>

        <p class="hero-desc mt-6 text-sm font-semibold leading-relaxed text-[var(--on-img-sub)] max-w-md mx-auto">
            Web development, embedded electronics, and DIY hardware.<br>
            I build things that work — on screen and in the real world.
        </p>

        <div class="hero-btn mt-10 flex items-center justify-center gap-4">
            <a href="#Projects" class="rounded-full border border-[var(--on-img)] text-[var(--on-img)] px-6 py-3 hover:border-[var(--on-img-muted)] hover:text-[var(--on-img-muted)] transition duration-500">View Projects</a>
        </div>
    </div>
</section>

<section id="Projects" class="section-bg py-16 px-8 bg-[var(--bg)]">
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
        <div class="text-center mt-14">
            <a href="projects.php" class="text-md text-[var(--text)] hover:text-[var(--text-muted)] transition-colors duration-500">View All Projects</a>
        </div>
    </div>
</section>

<div class="h-px bg-[var(--border)]"></div>

<section id="About" class="py-16 px-8 bg-[var(--surface)]">
    <div>
        <!--<div class="md:w-30 md:h-30 w-40 h-40 rounded-full overflow-hidden mx-auto mb-8 ring-1 ring-current ring-opacity-20">
                <img src="#" alt="avatar" class="w-full h-full object-cover"/>
            </div> -->
        <h2 class="text-center text-5xl text-[var(--text)] font-['Playfair_Display'] mb-4">About Me</h2>

        <p class="text-base text-[var(--text)] mb-10 max-w-2xl mx-auto leading-relaxed">I'm Samuel Švach, a secondary school IT student based in Zlín, Czech Republic. My work spans web development, embedded electronics, and DIY hardware — I enjoy building things that are both technically interesting and actually useful.</p>

        <p class="text-base text-[var(--text)] mb-10 max-w-2xl mx-auto leading-relaxed">When I'm not studying or coding, I'm doing astrophotography under dark Czech skies, running 3D prints, or tinkering with my smart home setup. I also maintain a self-hosted home server, because I believe the best way to understand technology is to take it apart and build it yourself.</p>
    </div>
</section>

<!-- CONTACT -->
<section id="Contact" class="py-16 px-6 sm:px-8 bg-[var(--surface)]">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 md:gap-20 items-start">

        <div>
            <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl text-[var(--text)] leading-tight">Let's build something
                <span class="block font-['Cormorant_Garamond'] italic text-[var(--text-sub)]">remarkable together.</span>
            </h2>
            <p class="mt-6 text-sm leading-relaxed text-[var(--text)] max-w-sm">
                Whether you're after a collaborator, an internship, or just want to talk tech — my inbox is always open.
            </p>

            <div class="mt-10 flex flex-col gap-5">
                <a href="mailto:svach.samuel@email.cz" class="flex items-center gap-4 text-[var(--text)] hover:text-[var(--text-muted)] transition-colors duration-500">
                    <svg class="w-5 h-5 shrink-0 text-[var(--accent)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                    <span class="text-sm">svach.samuel@email.cz</span>
                </a>
                <a href="https://github.com/Soromanko" target="_blank" rel="noopener" class="flex items-center gap-4 text-[var(--text)] hover:text-[var(--text-muted)] transition-colors duration-500">
                    <svg class="w-5 h-5 shrink-0 text-[var(--accent)]" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.58 2 12.25c0 4.53 2.87 8.37 6.84 9.73.5.1.68-.22.68-.49l-.01-1.71c-2.78.62-3.37-1.36-3.37-1.36-.46-1.18-1.11-1.5-1.11-1.5-.91-.64.07-.62.07-.62 1 .07 1.53 1.06 1.53 1.06.89 1.56 2.34 1.11 2.91.85.09-.66.35-1.11.63-1.36-2.22-.26-4.56-1.14-4.56-5.07 0-1.12.39-2.03 1.03-2.75-.1-.26-.45-1.3.1-2.71 0 0 .84-.27 2.75 1.05a9.4 9.4 0 0 1 5 0c1.91-1.32 2.75-1.05 2.75-1.05.55 1.41.2 2.45.1 2.71.64.72 1.03 1.63 1.03 2.75 0 3.94-2.34 4.81-4.57 5.06.36.32.68.94.68 1.9l-.01 2.81c0 .27.18.6.69.49A10.26 10.26 0 0 0 22 12.25C22 6.58 17.52 2 12 2Z"/></svg>
                    <span class="text-sm">Soromanko</span>
                </a>
                <a href="https://maps.app.goo.gl/ZUqdMMQQhhGiSdsW6" target="_blank" rel="noopener" class="flex items-center gap-4 text-[var(--text)] hover:text-[var(--text-muted)] transition-colors duration-500">
                    <svg class="w-5 h-5 shrink-0 text-[var(--accent)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21c-4-4-7-7.5-7-11a7 7 0 1 1 14 0c0 3.5-3 7-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                    <span class="text-sm">Zlín, Czech Republic</span>
                </a>
            </div>
        </div>

        <form method="post" action="" class="flex flex-col gap-8">
            <div>
                <label for="cf-name" class="block text-xs tracking-[0.2em] uppercase text-[var(--text)] mb-2">Full Name</label>
                <input id="cf-name" name="name" type="text" required placeholder="Your name" class="w-full bg-transparent border-b border-[var(--border)] py-3 text-[var(--text)] outline-none transition-colors focus:border-[var(--accent)] placeholder:text-[var(--text-faint)]"/>
            </div>
            <div>
                <label for="cf-email" class="block text-xs tracking-[0.2em] uppercase text-[var(--text)] mb-2">Email Address</label>
                <input id="cf-email" name="email" type="email" required placeholder="your@email.com" class="w-full bg-transparent border-b border-[var(--border)] py-3 text-[var(--text)] outline-none transition-colors focus:border-[var(--accent)] placeholder:text-[var(--text-faint)]"/>
            </div>
            <div>
                <label for="cf-subject" class="block text-xs tracking-[0.2em] uppercase text-[var(--text)] mb-2">Subject</label>
                <input id="cf-subject" name="subject" type="text" placeholder="What's on your mind?" class="w-full bg-transparent border-b border-[var(--border)] py-3 text-[var(--text)] outline-none transition-colors focus:border-[var(--accent)] placeholder:text-[var(--text-faint)]"/>
            </div>
            <div>
                <label for="cf-message" class="block text-xs tracking-[0.2em] uppercase text-[var(--text)] mb-2">Message</label>
                <textarea id="cf-message" name="message" rows="4" required placeholder="Tell me more..." class="w-full bg-transparent border-b border-[var(--border)] py-3 text-[var(--text)] outline-none transition-colors focus:border-[var(--accent)] placeholder:text-[var(--text-faint)] resize-none"></textarea>
            </div>
            <div class="flex flex-col items-center gap-6 xl:flex-row xl:justify-between">
                <div class="cf-turnstile" data-sitekey="0x4AAAAAADgYftHUi1iJfnP3" data-theme="auto"></div>
                <button type="submit" class="w-full max-w-auto xl:w-auto xl:max-w-none rounded-full border border-[var(--text)] text-[var(--text)] px-8 xl:px-10 py-3 text-sm tracking-wide hover:bg-[var(--text)] hover:text-[var(--bg)] transition-colors duration-300">Send Message</button>
            </div>
            <?php if (isset($_GET['sent'])): ?>
                <p class="text-sm text-[var(--accent)]">Message sent — I'll get back to you soon.</p>
            <?php elseif (!empty($formError)): ?>
                <p class="text-sm text-red-400"><?= $formError ?></p>
            <?php endif; ?>
        </form>

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

<!-- command to run tailwind: .\tailwindcss.exe -i .\src\input.css -o .\dist\output.css --watch --minify -->
<!-- command to run local server (mainly for mobile testing): php -S 0.0.0.0:8000 -->