<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MONEV TJSL')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        main { transition: filter 0.3s ease, opacity 0.3s ease; }
    </style>
</head>
<body>
    <div class="flex min-h-screen bg-gray-50 font-sans text-gray-900">
        
        <div class="lg:hidden fixed top-0 left-0 right-0 bg-[#3A5BFF] text-white p-4 flex justify-between items-center z-40 shadow-md">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                <span class="font-bold text-xs">MONEV TJSL</span>
            </div>
            <button onclick="toggleSidebar()" class="p-2 focus:outline-none hover:bg-white/10 rounded-lg">
                <svg id="burgerIcon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-[280px] bg-[#3A5BFF] flex flex-col text-white transform -translate-x-full lg:translate-x-0 lg:sticky lg:h-screen transition-transform duration-300 ease-in-out overflow-y-auto shadow-2xl lg:shadow-none">
            <div class="flex items-center p-2 pt-5">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[70px] h-[56px] ml-4 object-contain">
                <h1 class="text-lg font-bold text-center leading-tight">
                    MONEV TJSL <br> AIRNAV INDONESIA
                </h1>
            </div>
            <hr class="mx-6 border-white/50 my-4">

            <nav class="flex-1 space-y-2 px-3">
                <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.index') ? 'bg-white/10 border-l-4 border-white' : 'border-l-4 border-transparent text-white/70' }} transition-all duration-200 rounded-r-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-bold text-[15px]">Dashboard</span>
                </a>

                <div class="relative">
                    <button onclick="toggleDropdown('userDropdown')" id="btn-userDropdown" class="w-full flex items-center justify-between px-4 py-3 {{ request()->routeIs('users.*') ? 'bg-white/10 text-white border-white' : 'text-white/70 border-transparent' }} hover:text-white hover:bg-white/10 border-l-4 transition-all duration-200 rounded-r-lg group">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="font-bold text-[15px]">Manajemen User</span>
                        </div>
                        <svg id="arrow-userDropdown" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 transform {{ request()->routeIs('users.*') ? 'rotate-90' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div id="userDropdown" class="{{ request()->routeIs('users.*') ? '' : 'hidden' }} flex flex-col mt-1 ml-6 border-l-2 border-white/20 space-y-1 overflow-hidden transition-all duration-300">
                        <a href="{{ route('users.index') }}" class="flex items-center py-2 px-6 text-[14px] font-medium {{ request()->routeIs('users.index') ? 'text-white bg-white/10' : 'text-white/60' }} hover:text-white hover:bg-white/5 rounded-r-lg transition-all">Tambah Users</a>
                        <a href="{{ route('users.detail') }}" class="flex items-center py-2 px-6 text-[14px] font-medium {{ request()->routeIs('users.detail') ? 'text-white bg-white/10' : 'text-white/60' }} hover:text-white hover:bg-white/5 rounded-r-lg transition-all">Data Users</a>
                    </div>
                </div>
            </nav>

            <div class="p-6 border-t border-white/20">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                <button type="button" onclick="confirmLogout()" class="flex items-center text-sm text-white/80 hover:text-red-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Log Out
                </button>
            </div>
        </aside>

        <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[45] hidden transition-all duration-300 lg:hidden"></div>

        <main id="mainContent" class="flex-1 flex flex-col min-h-screen overflow-x-hidden">
            <div class="sticky top-[72px] lg:top-0 z-30 w-full bg-white/90 backdrop-blur-md border-b border-gray-200 px-4 lg:px-8 py-4 shadow-sm">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 max-w-[1600px] mx-auto">
                    <div class="text-center md:text-left w-full md:w-auto">
                        <h2 class="text-xl lg:text-2xl font-bold text-gray-800 uppercase tracking-wide">
                            @yield('page_title')
                        </h2>
                    </div>

                    <div class="flex items-center justify-between md:justify-end gap-3 w-full md:w-auto">
                        <div class="flex bg-orange-100 text-orange-600 px-3 py-1.5 rounded-lg font-bold items-center text-[10px] lg:text-xs uppercase">
                            <span class="flex h-2 w-2 rounded-full bg-orange-500 mr-2 animate-pulse"></span>
                            {{ Auth::user()->role }}
                        </div>
                        <div class="flex items-center gap-3 pl-3 border-l border-gray-200">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3A5BFF&color=fff" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white shadow-md">
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 lg:p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const main = document.getElementById('mainContent');

            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
            
            // Tambahkan efek blur pada konten saat sidebar terbuka
            if (!backdrop.classList.contains('hidden')) {
                main.classList.add('blur-sm', 'pointer-events-none');
            } else {
                main.classList.remove('blur-sm', 'pointer-events-none');
            }
        }

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const arrow = document.getElementById('arrow-' + id);
            const btn = document.getElementById('btn-' + id);
            
            dropdown.classList.toggle('hidden');
            if (dropdown.classList.contains('hidden')) {
                arrow.style.transform = 'rotate(0deg)';
                btn.classList.remove('bg-white/10', 'text-white');
            } else {
                arrow.style.transform = 'rotate(90deg)';
                btn.classList.add('bg-white/10', 'text-white');
            }
        }

        function confirmLogout() {
            Swal.fire({
                title: 'Yakin mau keluar?',
                text: "Sesi Anda akan diakhiri.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3A5BFF',
                cancelButtonColor: '#ef4444',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Logout',
                background: '#ffffff',
                customClass: {
                    title: 'text-slate-800 font-bold',
                    confirmButton: 'rounded-xl px-6 py-3',
                    cancelButton: 'rounded-xl px-6 py-3'
                }
            }).then((result) => {
                if (result.isConfirmed) { 
                    document.getElementById('logout-form').submit(); 
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>