<!DOCTYPE html>
<html lang="en" class="antialiased">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Tareas</title>
<link rel="icon" type="image/png" href="{{ globals('icon') }}">
<meta name="theme-color" content="{{ globals('theme-color') }}">

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet" href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css">
<link rel="stylesheet" href="{{ node('@fortawesome/fontawesome-free/css/all.css') }}">
<link rel="stylesheet" href="{{ node('@themesberg/flowbite/dist/flowbite.bundle.css') }}">
<link rel="stylesheet" href="{{ node('sweetalert2/dist/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body x-data="app" class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
    <input type="hidden" id="color" value="{{ globals('color') }}">

    <nav id="header" class="bg-white fixed w-full z-20 top-0 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between my-4">
            <div class="pl-4 md:pl-0">
                <a class="flex items-center text-{{ globals('color') }}-600 text-base xl:text-xl no-underline hover:no-underline font-extrabold font-sans" href="/">
                    <i class="fas fa-list mr-2"></i> Tareas
                </a>
            </div>

            <div class="pr-0 flex justify-end">
                <div class="flex relative inline-block float-right">
                    <div class="relative text-sm"></div>
                </div>
            </div>
        </div>
    </nav>

    <!--Container-->
    <div class="content container w-full flex flex-wrap mx-auto pt-8 lg:pt-16 mt-16">
        <section class="w-full lg:w-3/12 mb-20 hidden sm:flex">
        </section>

        <section class="w-full lg:w-6/12 mb-20">
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
                @if(messages('error'))
                    <div class="bg-red-100 p-3 mb-4 text-center rounded">{{ message('error') }}</div>
                @endif

                <form method="POST">
                    <x-form-input required label="Usuario" key="user" value=""/>

                    <x-form-input required label="Contraseña" key="password" password value=""/>

                    <x-form-button text="Iniciar sesión"/>
                </form>
            </div>
        </section>
    </div>
    <!--/container-->

    <script src="{{ node('alpinejs/dist/cdn.js') }}" defer></script>
    <script src="{{ node('sweetalert2/dist/sweetalert2.js') }}"></script>
    <script src="{{ node('@themesberg/flowbite/dist/flowbite.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
