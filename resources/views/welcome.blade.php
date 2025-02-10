<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buku-SSID</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="bg-white dark:bg-gray-900 astro-FLTEP2YP">
    <header class="astro-UY3JLCBK">
        <nav class="z-10 w-full absolute astro-UY3JLCBK">
            <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
                <div
                    class="flex flex-wrap items-center justify-between py-2 gap-6 md:py-4 md:gap-0 relative astro-UY3JLCBK">
                    <input aria-hidden="true" type="checkbox" name="toggle_nav" id="toggle_nav"
                        class="hidden peer astro-UY3JLCBK">
                    <div class="relative z-20 w-full flex justify-between lg:w-max md:px-0 astro-UY3JLCBK">
                        <a href="#" aria-label="logo" class="flex space-x-2 items-center astro-UY3JLCBK">
                            <div aria-hidden="true" class="flex space-x-1 astro-UY3JLCBK">
                                <div class="h-4 w-4 rounded-full bg-gray-900 dark:bg-white astro-UY3JLCBK"></div>
                                <div class="h-6 w-2 bg-primary astro-UY3JLCBK"></div>
                            </div>
                            <span
                                class="text-2xl font-bold text-gray-900 dark:text-white astro-UY3JLCBK">Buku SSID</span>
                        </a>

                        <div class="relative flex items-center lg:hidden max-h-10 astro-UY3JLCBK">
                            <label role="button" for="toggle_nav" aria-label="humburger" id="hamburger"
                                class="relative  p-6 -mr-6 astro-UY3JLCBK">
                                <div aria-hidden="true" id="line"
                                    class="m-auto h-0.5 w-5 rounded bg-sky-900 dark:bg-gray-300 transition duration-300 astro-UY3JLCBK">
                                </div>
                                <div aria-hidden="true" id="line2"
                                    class="m-auto mt-2 h-0.5 w-5 rounded bg-sky-900 dark:bg-gray-300 transition duration-300 astro-UY3JLCBK">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div aria-hidden="true"
                        class="fixed z-10 inset-0 h-screen w-screen bg-white/70 backdrop-blur-2xl origin-bottom scale-y-0 transition duration-500 peer-checked:origin-top peer-checked:scale-y-100 lg:hidden dark:bg-gray-900/70 astro-UY3JLCBK">
                    </div>
                    <div
                        class="flex-col z-20 flex-wrap gap-6 p-8 rounded-3xl border border-gray-100 bg-white shadow-2xl shadow-gray-600/10 justify-end w-full invisible opacity-0 translate-y-1  absolute top-full left-0 transition-all duration-300 scale-95 origin-top 
                            lg:relative lg:scale-100 lg:peer-checked:translate-y-0 lg:translate-y-0 lg:flex lg:flex-row lg:items-center lg:gap-0 lg:p-0 lg:bg-transparent lg:w-7/12 lg:visible lg:opacity-100 lg:border-none
                            peer-checked:scale-100 peer-checked:opacity-100 peer-checked:visible lg:shadow-none 
                            dark:shadow-none dark:bg-gray-800 dark:border-gray-700 astro-UY3JLCBK">

                        <div class="text-gray-600 dark:text-gray-300 lg:pr-4 lg:w-auto w-full lg:pt-0 astro-UY3JLCBK">
                            <ul
                                class="tracking-wide font-medium lg:text-sm flex-col flex lg:flex-row gap-6 lg:gap-0 astro-UY3JLCBK">
                                <li class="astro-UY3JLCBK">
                                    <a href="/admin/login"
                                        class="block md:px-4 transition hover:text-primary astro-UY3JLCBK">
                                        <span class="astro-UY3JLCBK">login</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="space-y-40 mb-40">
        <div class="relative">
            <div aria-hidden="true" class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20">
                <div class="blur-[106px] h-56 bg-gradient-to-br from-primary to-purple-400 dark:from-blue-700"></div>
                <div class="blur-[106px] h-32 bg-gradient-to-r from-cyan-400 to-sky-300 dark:to-indigo-600"></div>
            </div>
            <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
                <div class="relative pt-36 ml-auto">
                    <div class="lg:w-2/3 text-center mx-auto">
                        <h1 class="text-gray-900 dark:text-white font-bold text-5xl md:text-6xl xl:text-7xl">Dokumentasi SSID Lebih <span class="text-primary dark:text-white">Baik.</span></h1>
                        <p class="mt-8 text-gray-700 dark:text-gray-300">Kelola dan amankan data SSID dengan mudah dan terstruktur. Dengan dokumentasi yang lebih baik, Anda dapat menyimpan, mengelola, dan mengakses informasi SSID kapan saja dengan cepat dan efisien. Tidak perlu lagi khawatir kehilangan data—semua SSID tersimpan rapi dalam satu platform yang aman dan mudah digunakan.</p>
                        <div class="mt-16 flex flex-wrap justify-center gap-y-4 gap-x-6">
                            <a href="#"
                                class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max">
                                <span class="relative text-base font-semibold text-white">Get started</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-6 h-6 text-sky-500">
                    <path fill-rule="evenodd"
                        d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                        clip-rule="evenodd"></path>
                    <path fill-rule="evenodd"
                        d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                        clip-rule="evenodd"></path>
                </svg>
                <div
                    class="space-y-6 justify-between text-gray-600 md:flex flex-row-reverse md:gap-6 md:space-y-0 lg:gap-12 lg:items-center">
                    <div class="md:5/12 lg:w-1/2">
                        <img src="./images/pie.svg" alt="image" loading="lazy" width="" height=""
                            class="w-full">
                    </div>
                    <div class="md:7/12 lg:w-1/2">
                        <h2 class="text-3xl font-bold text-gray-900 md:text-4xl dark:text-white">
                            Data tercatat dan Transparan
                        </h2>
                        <p class="my-8 text-gray-600 dark:text-gray-300">
                            Transparansi data yang sempurna antara tenaga ahli jaringan meningkatkan kolaborasi dalam
                            bekerja, membantu menginkatkan komunikasi dan dokumentasi<br> <br> Vitae
                            error, quaerat officia delectus voluptatibus explicabo quo pariatur impedit, at
                            reprehenderit aliquam a ipsum quas voluptatem. Quo pariatur asperiores eum amet.
                        </p>
                        <div class="divide-y space-y-4 divide-gray-100 dark:divide-gray-800">
                            <div class="mt-8 flex gap-4  md:items-center">
                                <div
                                    class="w-12 h-12 flex justify-center items-center gap-4 rounded-full bg-indigo-100 dark:bg-indigo-900/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 stroke-indigo-700">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                    </svg>

                                </div>
                                <div class="w-5/6">
                                    <h4 class="font-semibold text-lg text-gray-700 dark:text-indigo-300">Efisiensi Data
                                    </h4>
                                    <p class="text-gray-500 dark:text-gray-400">Menyimpan dan Mencari data secara cepat
                                        dan akurat.</p>
                                </div>
                            </div>
                            <div class="pt-4 flex gap-4 md:items-center">
                                <div
                                    class="w-12 h-12 flex justify-center items-center gap-4 rounded-full bg-teal-100 dark:bg-teal-900/20">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 stroke-teal-700">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>

                                </div>
                                <div class="w-5/6">
                                    <h4 class="font-semibold text-lg text-gray-700 dark:text-teal-300">Transparan</h4>
                                    <p class="text-gray-500 dark:text-gray-400">Transparansi data dan Log aktifitas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
