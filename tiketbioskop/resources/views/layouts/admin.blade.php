<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Cinetix | @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            600: '#dc2626',
                            700: '#b91c1c',
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">

    {{-- Sidebar --}}
    @include('admin.sidebar')

    {{-- Konten Utama --}}
    <div id="main-content" class="ml-[240px] transition-all duration-300 p-6">

        {{-- Header --}}
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg px-6 py-4 mb-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <button id="sidebar-toggle" onclick="toggleSidebar()" class="md:hidden text-gray-600 dark:text-gray-300">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-semibold text-gray-700 dark:text-white">
                    <i class="fas fa-film text-primary-600 mr-2"></i>
                    @yield('title', 'Dashboard')
                </h1>
            </div>

            @php use Illuminate\Support\Facades\Auth; @endphp
            <div class="flex items-center gap-3 relative group">
                <div class="flex items-center gap-2">
                    <i class="fas fa-bell text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-600 cursor-pointer"></i>
                    <i class="fas fa-cog text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-600 cursor-pointer"></i>
                </div>
                <div class="flex items-center gap-3 cursor-pointer" id="user-menu-button">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=dc2626&color=fff"
                         alt="Avatar"
                         class="w-10 h-10 rounded-full border-2 border-primary-600">
                    <div class="hidden md:block">
                        <span class="text-gray-700 dark:text-gray-200 font-medium">{{ Auth::user()->name }}</span>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Admin</p>
                    </div>
                </div>

                {{-- Dropdown Menu --}}
                <div id="user-menu" class="absolute right-0 top-12 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl hidden z-50 border border-gray-200 dark:border-gray-700">
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Breadcrumb --}}
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    @hasSection('breadcrumb')
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                                    @yield('breadcrumb')
                                </span>
                            </div>
                        </li>
                    @endif
                </ol>
            </nav>
        </div>

        {{-- Konten halaman --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            @yield('content')
        </div>

        {{-- Footer --}}
        <footer class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
            <p>© {{ date('Y') }} Cinetix - Sistem Manajemen Bioskop</p>
        </footer>
    </div>

    <script>
        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-expanded');

            if (sidebar.classList.contains('sidebar-collapsed')) {
                mainContent.classList.remove('ml-[240px]');
                mainContent.classList.add('ml-[60px]');
            } else {
                mainContent.classList.remove('ml-[60px]');
                mainContent.classList.add('ml-[240px]');
            }
        }

        // Toggle user dropdown
        document.getElementById('user-menu-button').addEventListener('click', function() {
            document.getElementById('user-menu').classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('user-menu');
            const userButton = document.getElementById('user-menu-button');
            
            if (!userMenu.contains(event.target) && !userButton.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });

        // Dark mode toggle
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', function() {
                document.documentElement.classList.toggle('dark');
                localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
            });
        }
    </script>
</body>
</html>