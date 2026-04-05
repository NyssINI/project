@extends('layouts.app')
@section('page_title', 'Detail User')
@section('content')
<div class="p-4 md:p-8 bg-[#F8FAFC] min-h-screen mt-12 lg:mt-0">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola data admin dan petani dalam sistem MONEV TJSL.</p>
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto">
            <button class="flex-1 md:flex-none inline-flex items-center justify-center px-5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-sm hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Export
            </button>
            <a href="{{ route('users.index') }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-5 py-2.5 bg-[#3758F9] text-white rounded-xl font-bold text-sm shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Tambah User
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-10">
        @php
            $stat_items = [
                ['label' => 'Total Akun', 'count' => $counts['total'], 'icon_color' => 'text-indigo-500', 'bg' => 'bg-indigo-50'],
                ['label' => 'Admin', 'count' => $counts['admin'], 'icon_color' => 'text-purple-500', 'bg' => 'bg-purple-50'],
                ['label' => 'Petani', 'count' => $counts['petani'], 'icon_color' => 'text-blue-500', 'bg' => 'bg-blue-50'],
            ];
        @endphp
        @foreach ($stat_items as $item)
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm transition-all hover:shadow-md">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 {{ $item['bg'] }} rounded-xl">
                        <svg class="w-6 h-6 {{ $item['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Statistik</span>
                </div>
                <div class="text-2xl font-black text-slate-800">{{ $item['count'] }} Akun</div>
                <p class="text-sm text-slate-500 mt-1">{{ $item['label'] }} terdaftar</p>
            </div>
        @endforeach
    </div>

    <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-6 mb-6">
        <div class="inline-flex p-1.5 bg-slate-200/50 rounded-2xl w-fit backdrop-blur-sm">
            @php $roles = ['all' => 'Semua Akun', 'admin' => 'Admin', 'petani' => 'Petani']; @endphp
            @foreach($roles as $key => $label)
                <a href="{{ route('users.detail', ['role' => $key]) }}" 
                   class="px-5 py-2 rounded-xl text-sm font-bold transition-all {{ $role == $key ? 'bg-white text-[#3758F9] shadow-md' : 'text-slate-500 hover:text-slate-700' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 font-bold text-slate-700 border-b border-slate-50 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-5 bg-[#3758F9] rounded-full"></span>
                Daftar {{ $role == 'all' ? 'Semua Pengguna' : ucfirst($role) }}
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[800px]">
                <thead class="bg-[#E8EFFF] border-b border-slate-100">
                    <tr class="text-[12px] text-slate-600 font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Nama User</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Role</th>
                        <th class="px-6 py-4 text-center">Tgl Terdaftar</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($users as $user)
                        <tr class="text-sm text-slate-600 hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-5 font-bold text-slate-700">{{ $user->name }}</td>
                            <td class="px-6 py-5">
                                <span class="text-[#3758F9] font-medium hover:underline cursor-pointer">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 rounded-md text-[10px] font-black uppercase {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center text-slate-500 font-medium">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-center gap-2">
                                    <a href="#" class="p-2 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2" /></svg>
                                    </a>
                                    <a href="{{ route('users.show', $user->id) }}" class="p-2 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" /><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" /></svg>
                                    </a>
                                    <button class="p-2 bg-red-50 text-red-400 hover:text-red-600 hover:bg-red-100 rounded-lg transition-all" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-400 italic font-medium">Data user tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection