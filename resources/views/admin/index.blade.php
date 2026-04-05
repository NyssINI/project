@extends('layouts.app')

@section('title', 'Dashboard Admin - MONEV TJSL')
@section('page_title', 'Dashboard ' . ucfirst(Auth::user()->role))

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md hover:border-blue-200">
            <div class="flex justify-between text-gray-400 mb-4">
                <span class="text-xs font-semibold uppercase tracking-wider">Total Panen</span>
                <div class="p-2 bg-blue-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $totalPanen ?? '1,250' }}</h3>
            <p class="text-[10px] text-gray-500 mt-1">Buah salak tercatat</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md hover:border-green-200">
            <div class="flex justify-between text-gray-400 mb-4">
                <span class="text-xs font-semibold uppercase tracking-wider">Total Berat</span>
                <div class="p-2 bg-green-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 01-6.001 0M18 7l-3 9m3-9l-6-2m0-2v2m0 16V5" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $totalBerat ?? '1,250' }} kg</h3>
            <p class="text-[10px] text-gray-500 mt-1">Berat keseluruhan</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md hover:border-orange-200">
            <div class="flex justify-between text-gray-400 mb-4">
                <span class="text-xs font-semibold uppercase tracking-wider">Petani Aktif</span>
                <div class="p-2 bg-orange-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $totalPetani ?? '50' }}</h3>
            <p class="text-[10px] text-gray-500 mt-1">Orang terdaftar</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md hover:border-purple-200">
            <div class="flex justify-between text-gray-400 mb-4">
                <span class="text-xs font-semibold uppercase tracking-wider">Stok Layak</span>
                <div class="p-2 bg-purple-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">WY</div>
                                <span class="font-semibold text-gray-800">Wira Yuda</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">20 Mar 2026</td>
                        <td class="px-6 py-4 font-medium">150 kg</td>
                        <td class="px-6 py-4 text-green-600 font-semibold">140 kg</td>
                        <td class="px-6 py-4 text-red-400">10 kg</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-[10px] font-bold uppercase">Selesai</span>
                        </td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
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
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
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
                maintainAspectRatio: false,
                plugins: { legend: { position: 'right' } }
            }
        });

        // Toast Success Login
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                position: 'top-end'
            });
        @endif
    </script>
@endpush