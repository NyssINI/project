@extends('layouts.app')

@section('page_title', 'Detail User')

@section('content')
<div class="max-w-5xl mx-auto px-4 pb-20 mt-20 lg:mt-8">
    
    <div class="mb-6">
        <nav class="flex text-slate-400 text-xs mb-2 font-medium">
            <a href="{{ route('users.detail') }}" class="hover:text-[#3A5BFF]">Manajemen User</a>
            <span class="mx-2">/</span>
            <span class="text-slate-600">Detail Profil</span>
        </nav>
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-slate-800">Profil Pengguna</h1>
            <a href="{{ route('users.detail') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/80 flex flex-col md:flex-row items-center gap-6">
            <div class="relative">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3A5BFF&color=fff&size=128" 
                     class="w-24 h-24 rounded-full border-4 border-white shadow-sm" alt="Profile">
            </div>
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold text-slate-800">{{ $user->name }}</h2>
                <p class="text-slate-500">{{ $user->email }}</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-3">
                    <span class="px-3 py-1 bg-blue-50 text-[#3A5BFF] text-[10px] font-bold uppercase rounded-md border border-blue-100">
                        {{ $user->role }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-0">
            <div class="flex flex-col md:flex-row border-b border-slate-100 hover:bg-slate-50/30 transition-colors">
                <div class="w-full md:w-1/3 bg-slate-50/50 px-6 py-4 flex items-center border-r border-slate-100">
                    <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</span>
                </div>
                <div class="w-full md:w-2/3 px-6 py-4 bg-white/50">
                    <span class="text-sm font-semibold text-slate-700">{{ $user->name }}</span>
                </div>
            </div>

            <div class="flex flex-col md:flex-row border-b border-slate-100 hover:bg-slate-50/30 transition-colors">
                <div class="w-full md:w-1/3 bg-slate-50/50 px-6 py-4 flex items-center border-r border-slate-100">
                    <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Alamat Email</span>
                </div>
                <div class="w-full md:w-2/3 px-6 py-4 bg-white/50">
                    <span class="text-sm font-semibold text-[#3A5BFF]">{{ $user->email }}</span>
                </div>
            </div>

            @if($user->role == 'petani')
                <div class="flex flex-col md:flex-row border-b border-slate-100 hover:bg-slate-50/30 transition-colors">
                    <div class="w-full md:w-1/3 bg-slate-50/50 px-6 py-4 flex items-center border-r border-slate-100">
                        <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Nomor HP</span>
                    </div>
                    <div class="w-full md:w-2/3 px-6 py-4 bg-white/50">
                        <span class="text-sm font-semibold text-slate-700">{{ $user->no_hp ?? '-' }}</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row border-b border-slate-100 hover:bg-slate-50/30 transition-colors">
                    <div class="w-full md:w-1/3 bg-slate-50/50 px-6 py-4 flex items-center border-r border-slate-100">
                        <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Desa & Kecamatan</span>
                    </div>
                    <div class="w-full md:w-2/3 px-6 py-4 bg-white/50">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-0.5">Desa</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $user->desa ?? '-' }}</p>
                            </div>
                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-0.5">Kecamatan</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $user->kecamatan ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row border-b border-slate-100 hover:bg-slate-50/30 transition-colors">
                    <div class="w-full md:w-1/3 bg-slate-50/50 px-6 py-4 flex items-center border-r border-slate-100">
                        <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Wilayah Daerah</span>
                    </div>
                    <div class="w-full md:w-2/3 px-6 py-4 bg-white/50">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-0.5">Kabupaten</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $user->kabupaten ?? '-' }}</p>
                            </div>
                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-0.5">Provinsi</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $user->provinsi ?? 'Bali' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex flex-col md:flex-row hover:bg-slate-50/30 transition-colors">
                <div class="w-full md:w-1/3 bg-slate-50/50 px-6 py-4 flex items-center border-r border-slate-100">
                    <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Tanggal Bergabung</span>
                </div>
                <div class="w-full md:w-2/3 px-6 py-4 bg-white/50">
                    <span class="text-sm font-semibold text-slate-700">{{ $user->created_at->format('d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center gap-2 text-slate-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
        <p class="text-xs font-medium">Informasi profil resmi MONEV TJSL Airnav Indonesia.</p>
    </div>
</div>
@endsection