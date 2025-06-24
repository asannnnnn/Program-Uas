<!-- Sidebar -->

<style>
    .sidebar-collapsed {
        width: 70px;
        overflow: hidden;
    }

    .sidebar-expanded {
        width: 240px;
    }

    .sidebar-link {
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }

    /* Semua menu aktif merah */
    .sidebar-link.active {
        background-color: rgba(220, 38, 38, 0.2);
        color: #fff;
        border-left-color: #dc2626;
    }

    .sidebar-link:hover:not(.active) {
        background-color: rgba(255, 255, 255, 0.05);
    }

    .sidebar-icon {
        min-width: 24px;
        transition: transform 0.3s ease;
    }

    .sidebar-collapsed .sidebar-text {
        opacity: 0;
        width: 0;
    }

    .sidebar-collapsed .sidebar-link {
        justify-content: center;
        padding-left: 0;
        padding-right: 0;
    }

    .sidebar-tooltip {
        visibility: hidden;
        opacity: 0;
        transition: all 0.2s ease;
    }

    .sidebar-collapsed .sidebar-link:hover .sidebar-tooltip {
        visibility: visible;
        opacity: 1;
    }
</style>

<div id="sidebar" class="fixed top-0 left-0 h-full bg-gray-900 text-white transition-all duration-300 sidebar-expanded z-50 shadow-xl">

    <!-- Logo Section -->
    <div class="flex justify-between items-center p-4 border-b border-gray-700 h-16">
        <div class="flex items-center space-x-2 overflow-hidden transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
            </svg>
            <span class="text-lg font-bold whitespace-nowrap">CINETIX</span>
        </div>
        <button onclick="toggleSidebar()" class="focus:outline-none text-gray-400 hover:text-white">
            <svg id="sidebarToggleIcon" xmlns="http://www.w3.org/2000/svg" 
                 class="h-6 w-6 transition-transform duration-300" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex flex-col p-2 mt-2 space-y-1">
        @php
            $routes = [
         'managefilm' => 'film',
    'managestudio' => 'studio',
    'dashboard' => 'dashboard',
    'managetransaksi' => 'transaksi',   
    ];
    $active = $routes[request()->segment(2)] ?? '';
        @endphp

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ $active === 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt sidebar-icon {{ $active === 'dashboard' ? 'text-red-400' : 'text-gray-400' }}"></i>
            <span class="sidebar-text ml-3 whitespace-nowrap">Dashboard</span>
            <div class="sidebar-tooltip absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded shadow-lg">
                Dashboard
            </div>
        </a>

        <!-- Manajemen Film -->
        <a href="{{ route('admin.managefilm') }}" 
           class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ $active === 'film' ? 'active' : '' }}">
            <i class="fas fa-film sidebar-icon {{ $active === 'film' ? 'text-red-400' : 'text-gray-400' }}"></i>
            <span class="sidebar-text ml-3 whitespace-nowrap">Manajemen Film</span>
            <div class="sidebar-tooltip absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded shadow-lg">
                Manajemen Film
            </div>
        </a>

        <!-- Manajemen Studio -->
        <a href="{{ route('admin.managestudio') }}" 
           class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ $active === 'studio' ? 'active' : '' }}">
            <i class="fas fa-theater-masks sidebar-icon {{ $active === 'studio' ? 'text-red-400' : 'text-gray-400' }}"></i>
            <span class="sidebar-text ml-3 whitespace-nowrap">Manajemen Studio</span>
            <div class="sidebar-tooltip absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded shadow-lg">
                Manajemen Studio
            </div>
        </a>

        <!-- Manajemen Transaksi -->
        <a href="{{ route('admin.managetransaksi') }}" 
           class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ $active === 'transaksi' ? 'active' : '' }}">
            <i class="fas fa-receipt sidebar-icon {{ $active === 'transaksi' ? 'text-red-400' : 'text-gray-400' }}"></i>
            <span class="sidebar-text ml-3 whitespace-nowrap">Manajemen Transaksi</span>
            <div class="sidebar-tooltip absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded shadow-lg">
                Manajemen Transaksi
            </div>
        </a>
    </nav>

    <!-- Collapsed Footer -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700">
   
    <lord-icon
        src="https://cdn.lordicon.com/slkvcfos.json"
        trigger="loop"
        colors="primary:#ffffff,secondary:#08a88a"
        style="width:40px;height:40px">
    </lord-icon>
</div>
<script src="https://cdn.lordicon.com/lordicon.js"></script>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const icon = document.getElementById('sidebarToggleIcon');
        
        sidebar.classList.toggle('sidebar-collapsed');
        sidebar.classList.toggle('sidebar-expanded');
        
        if (sidebar.classList.contains('sidebar-collapsed')) {
            icon.setAttribute('transform', 'rotate(180)');
        } else {
            icon.removeAttribute('transform');
        }
    }

    // Dark mode toggle
    document.getElementById('dark-mode-toggle').addEventListener('click', function() {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        
        // Toggle moon/sun icon
        const icon = this.querySelector('i');
        if (document.documentElement.classList.contains('dark')) {
            icon.classList.replace('fa-moon', 'fa-sun');
        } else {
            icon.classList.replace('fa-sun', 'fa-moon');
        }
    });

    // Initialize dark mode from localStorage
    if (localStorage.getItem('darkMode') === 'true') {
        document.documentElement.classList.add('dark');
        document.getElementById('dark-mode-toggle').querySelector('i').classList.replace('fa-moon', 'fa-sun');
    }
</script>