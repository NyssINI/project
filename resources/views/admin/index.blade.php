<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin - MONEV TJSL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="flex min-h-screen bg-gray-50 font-sans text-gray-900">
        <div
            class="lg:hidden fixed top-0 left-0 right-0 bg-[#3A5BFF] text-white p-4 flex justify-between items-center z-50 shadow-md">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                <span class="font-bold text-xs">MONEV TJSL</span>
            </div>
            <button onclick="toggleSidebar()" class="p-2 focus:outline-none hover:bg-white/10 rounded-lg">
                <svg id="burgerIcon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40 w-[280px] bg-[#3A5BFF] flex flex-col text-white transform -translate-x-full lg:translate-x-0 lg:sticky lg:h-screen transition-transform duration-300 ease-in-out overflow-y-auto">
            <div class="flex items-center p-2 pt-5">
                <img src="{{ asset('images/logo.png') }}" alt="Logo AirNav"
                    class="w-[70px] h-[56px] ml-4 object-contain">
                <h1 class="text-lg font-bold font-poppins text-center leading-tight">
                    MONEV TJSL <br> AIRNAV INDONESIA
                </h1>
            </div>
            <hr class="mx-6 border-white/50 my-4">

            <nav class="flex-1 space-y-1">
                <a href="{{ route('admin.index') }}"
                    class="flex items-center px-6 py-3 bg-white/10 border-l-4 border-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-bold text-[16px]">Dashboard</span>
                </a>
            </nav>

            <div class="p-6 border-t border-white/20">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                <button type="button" onclick="confirmLogout()"
                    class="flex items-center text-sm hover:text-red-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Log Out
                </button>
            </div>
        </aside>

        <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden">
        </div>

        <main class="flex-1 flex flex-col min-h-screen overflow-x-hidden">

            <div
                class="sticky top-[72px] lg:top-0 z-30 w-full bg-white/90 backdrop-blur-md border-b border-gray-200 px-4 lg:px-8 py-4 shadow-sm transition-all">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 max-w-[1600px] mx-auto">

                    <div class="text-center md:text-left w-full md:w-auto">
                        <h2 class="text-xl lg:text-2xl font-bold text-gray-800 uppercase tracking-wide">
                            Dashboard {{ ucfirst(Auth::user()->role) }}
                        </h2>
                    </div>

                    <div class="flex items-center justify-between md:justify-end gap-3 w-full md:w-auto">
                        <div
                            class="flex bg-orange-100 text-orange-600 px-3 py-1.5 rounded-lg font-bold items-center text-[10px] lg:text-xs uppercase">
                            <span class="flex h-2 w-2 rounded-full bg-orange-500 mr-2 animate-pulse"></span>
                            {{ Auth::user()->role }}
                        </div>

                        <div class="flex items-center gap-3 pl-3 border-l border-gray-200">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3A5BFF&color=fff"
                                alt="Profile"
                                class="w-10 h-10 rounded-full border-2 border-white shadow-md ring-1 ring-gray-100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

                <div
                    class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md hover:border-blue-200">
                    <div class="flex justify-between text-gray-400 mb-4">
                        <span class="text-xs font-semibold uppercase tracking-wider">Total Panen</span>
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $totalPanen ?? '1,250' }}</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Buah salak tercatat</p>
                </div>

                <div
                    class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md hover:border-green-200">
                    <div class="flex justify-between text-gray-400 mb-4">
                        <span class="text-xs font-semibold uppercase tracking-wider">Total Berat</span>
                        <div class="p-2 bg-green-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 01-6.001 0M18 7l-3 9m3-9l-6-2m0-2v2m0 16V5" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $totalBerat ?? '1,250' }} kg</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Berat keseluruhan</p>
                </div>

                <div
                    class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md hover:border-orange-200">
                    <div class="flex justify-between text-gray-400 mb-4">
                        <span class="text-xs font-semibold uppercase tracking-wider">Petani Aktif</span>
                        <div class="p-2 bg-orange-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $totalPetani ?? '50' }}</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Orang terdaftar</p>
                </div>

                <div
                    class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md hover:border-purple-200">
                    <div class="flex justify-between text-gray-400 mb-4">
                        <span class="text-xs font-semibold uppercase tracking-wider">Stok Layak</span>
                        <div class="p-2 bg-purple-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $stokBagus ?? '580' }} kg</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Kualitas Grade A</p>
                </div>

            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <h4 class="font-bold text-gray-700 mb-4">Hasil Panen Bulanan</h4>
                    <div class="h-[250px] lg:h-[300px]">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <h4 class="font-bold text-gray-700 mb-4">Distribusi Kualitas</h4>
                    <div class="flex justify-center h-[250px] lg:h-[300px]">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h4 class="font-bold text-gray-700 uppercase text-sm tracking-widest">Semua Data Panen</h4>
                    <button class="text-blue-600 text-xs font-bold hover:underline">LIHAT SEMUA</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[700px]">
                        <thead class="bg-gray-50 text-gray-400 text-xs font-semibold uppercase">
                            <tr>
                                <th class="px-6 py-4">Nama Petani</th>
                                <th class="px-6 py-4">Tanggal Panen</th>
                                <th class="px-6 py-4">Berat (kg)</th>
                                <th class="px-6 py-4">Bagus (kg)</th>
                                <th class="px-6 py-4">Busuk (kg)</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600 divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                            WY
                                        </div>
                                        <span class="font-semibold text-gray-800">Wira Yuda</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500">20 Mar 2026</td>
                                <td class="px-6 py-4 font-medium">150 kg</td>
                                <td class="px-6 py-4 text-green-600 font-semibold">140 kg</td>
                                <td class="px-6 py-4 text-red-400">10 kg</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-[10px] font-bold uppercase">Selesai</span>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-xs">
                                            ID
                                        </div>
                                        <span class="font-semibold text-gray-800">I Gusti Denys</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500">19 Mar 2026</td>
                                <td class="px-6 py-4 font-medium">200 kg</td>
                                <td class="px-6 py-4 text-green-600 font-semibold">185 kg</td>
                                <td class="px-6 py-4 text-red-400">15 kg</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-orange-100 text-orange-600 text-[10px] font-bold uppercase">Proses</span>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-xs">
                                            AA
                                        </div>
                                        <span class="font-semibold text-gray-800">Agus Ariawan</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500">18 Mar 2026</td>
                                <td class="px-6 py-4 font-medium">85 kg</td>
                                <td class="px-6 py-4 text-green-600 font-semibold">80 kg</td>
                                <td class="px-6 py-4 text-red-400">5 kg</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-[10px] font-bold uppercase">Selesai</span>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center font-bold text-xs">
                                            BP
                                        </div>
                                        <span class="font-semibold text-gray-800">Budi Pratama</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500">17 Mar 2026</td>
                                <td class="px-6 py-4 font-medium">120 kg</td>
                                <td class="px-6 py-4 text-green-600 font-semibold">100 kg</td>
                                <td class="px-6 py-4 text-red-400">20 kg</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-[10px] font-bold uppercase">Ditolak</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Line Chart
        const ctxLine = document.getElementById('lineChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
                datasets: [{
                    label: 'Bagus',
                    data: [58, 65, 78, 80, 72, 38],
                    borderColor: '#3A5BFF',
                    tension: 0.4,
                    fill: false
                }, {
                    label: 'Busuk',
                    data: [40, 82, 18, 20, 68, 18],
                    borderColor: '#4ADE80',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Pie Chart
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Bagus', 'Busuk'],
                datasets: [{
                    data: [85, 15],
                    backgroundColor: ['#3A5BFF', '#FF6B6B'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });

        // NOTIF LOGIN SUCESS
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // NOTIF LOGOUT
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin mau keluar?',
                text: "Kamu harus login lagi untuk masuk ke dashboard.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3A5BFF',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }

        // BURGER
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const isHidden = sidebar.classList.contains('-translate-x-full');

            if (isHidden) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }
    </script>
</body>

</html>
