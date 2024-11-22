<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="HomeFurniPlace - Your One Stop Furniture Shop">
    <meta name="theme-color" content="#4F46E5">

    <title>@yield('title', 'HomeFurniPlace - Your One Stop Furniture Shop')</title>

    <!-- Preload Critical Fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@700&display=swap" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Source+Sans+3&display=swap" as="style">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+3&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap">

    <!-- Critical CSS -->
    <style>
        @layer critical {
            .loader-wrapper {
                @apply fixed inset-0 z-50 flex items-center justify-center bg-white;
            }

            /* Add any other critical CSS here */
        }
    </style>

    <!-- Third Party CSS -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Source Sans 3', 'sans-serif'],
                        display: ['Kumbh Sans', 'sans-serif'],
                        heading: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#1F2937',
                    }
                }
            }
        }
    </script>

    <!-- Additional Styles -->
    @stack('styles')
    @yield('csrf')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body class="min-h-screen bg-gray-50 antialiased">
    <!-- Page Loader -->
    <div class="loader-wrapper hidden">
        <span class="loader"></span>
    </div>

    <!-- Header -->
    <header class="sticky top-0 z-40 w-full bg-white/95 backdrop-blur-sm">
        @include('components.navbar')
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        @include('components.footer')
    </footer>

    <!-- Third Party Scripts -->
    <script src="https://kit.fontawesome.com/25b9223bba.js" crossorigin="anonymous" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js" defer></script>

    <!-- Initialize Scripts -->
    <script>
        // Initialize AOS
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });
        });

        // Initialize Swiper
        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            }
        });

        // Add page transition
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
