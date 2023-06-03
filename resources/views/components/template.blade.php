<!DOCTYPE html>
<html lang="en" class="antialiased">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="mobile-web-app-capable" content="yes">

<title>Tareas</title>
<link rel="icon" type="image/png" href="{{ globals('icon') }}">
<meta name="theme-color" content="white">

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet" href="{{ node('@fortawesome/fontawesome-free/css/all.css') }}">
<link rel="stylesheet" href="{{ node('flowbite/dist/flowbite.css') }}">
<link rel="stylesheet" href="{{ node('sweetalert2/dist/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body x-data="app" class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
    <nav id="header" class="bg-white fixed w-full z-20 top-0 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between my-4">
            <div class="pl-4 md:pl-0">
                <a class="flex items-center text-dark text-base xl:text-xl no-underline hover:no-underline font-extrabold font-sans" href="/">
                    <i class="fas fa-tasks mr-2"></i> Tareas
                </a>
            </div>

            <div class="pr-0 flex justify-end hidden sm:flex">
                <div class="flex relative inline-block float-right">
                    <div class="relative text-sm">
                        <a data-tooltip-target="configuration" href="/configurations">
                            <div class="flex items-center">
                                <div>
                                    <img class="rounded-full img-size inline-flex" src="{{ globals('photo') }}" alt="{{ globals('name') }}">
                                </div>

                                <div class="ml-4">
                                    {{ globals('name') }}
                                </div>
                            </div>
                        </a>

                        <x-tooltip text="Configuración" id="configuration"/>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!--Container-->
    <div class="content container w-full flex flex-wrap mx-auto pt-8 lg:pt-16">
        <div class="w-full lg:w-1/5 px-6 text-xl text-gray-800 leading-normal">
            <div class="w-full sticky inset-0 hidden overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 my-2 lg:my-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-10" id="menu-content" style="top: 5.5em">
                <ul class="list-reset py-2 md:py-0">
                    <li class="list-none py-1 md:my-2 hover:bg-black lg:hover:bg-transparent border-l-4 border-transparent {{ ($active == '/') ? 'font-bold border-black' : '' }}">
                        <a href="/" class="block pl-4 align-middle text-black no-underline hover:text-dark {{ ($active == '/') ? 'text-dark' : '' }}">
                            <i class="fa fa-home {{ ($active == '/') ? 'text-dark' : '' }}"></i>
                            <span class="pb-1 md:pb-0 text-sm {{ ($active == '/') ? 'text-dark' : '' }}">Inicio</span>
                        </a>
                    </li>

                    @foreach(projects() as $project)
                        <li style="{{ ($active == $project->slug) ? 'border-color: ' . $project->color : '' }}" class="list-none py-1 md:my-2 hover:bg-black lg:hover:bg-transparent border-l-4 border-transparent {{ ($active == $project->slug) ? 'font-bold' : '' }}">
                            <a href="{{ '/projects/show/' . $project->slug }}" class="block pl-4 align-middle text-black no-underline hover:text-dark">
                                <i style="{{ ($active == $project->slug) ? 'color: ' . $project->color : '' }} " class="{{ $project->icon }}"></i>
                                <span style="{{ ($active == $project->slug) ? 'color: ' . $project->color : '' }} " class="pb-1 md:pb-0 text-sm">{{ $project->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{ $slot }}

    </div>
    <!--/container-->

    <script src="{{ node('alpinejs/dist/cdn.js') }}" defer></script>
    <script src="{{ node('sweetalert2/dist/sweetalert2.js') }}"></script>
    <script src="{{ node('flowbite/dist/flowbite.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
