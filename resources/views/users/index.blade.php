@extends('layouts.app')
@section('page_title', 'Tambah User')
@section('content')

<div class="max-w-6xl mx-auto px-4 pb-12 mt-24 lg:mt-10">
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden mb-12">
        <div class="bg-indigo-600 p-8 text-white">
            <h3 class="text-2xl font-bold">Registrasi User Baru</h3>
            <p class="text-indigo-100 text-sm mt-1">Pilih role dan lengkapi data untuk menambahkan pengguna baru.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="p-8">
            @csrf
            <div class="mb-10">
                <label class="block text-center text-sm font-bold text-slate-500 uppercase tracking-[0.2em] mb-4">Pilih Role Akses</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative flex flex-col items-center p-4 border-2 rounded-2xl cursor-pointer transition-all hover:bg-slate-50 group has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/50">
                        <input type="radio" name="role" value="admin" id="roleAdmin" onchange="toggleFields()" class="sr-only" {{ old('role') == 'admin' ? 'checked' : '' }}>
                        <svg class="w-8 h-8 mb-2 text-slate-400 group-has-[:checked]:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        <span class="text-sm font-bold text-slate-600 group-has-[:checked]:text-indigo-700">Administrator</span>
                    </label>

                    <label class="relative flex flex-col items-center p-4 border-2 rounded-2xl cursor-pointer transition-all hover:bg-slate-50 group has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/50">
                        <input type="radio" name="role" value="petani" id="rolePetani" onchange="toggleFields()" class="sr-only" {{ old('role') == 'petani' ? 'checked' : '' }}>
                        <svg class="w-8 h-8 mb-2 text-slate-400 group-has-[:checked]:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.5 12c0-4.418 3.582-8 8-8s8 3.582 8 8-3.582 8-8 8a8 8 0 01-7.5-5.222M12 4v4m0 8v4M4 12h4m8 0h4m-1.757-5.657l-2.828 2.828m-5.657 5.657l-2.828 2.828m14.142 0l-2.828-2.828m-5.657-5.657L6.343 6.343" /></svg>
                        <span class="text-sm font-bold text-slate-600 group-has-[:checked]:text-indigo-700">Petani</span>
                    </label>
                </div>
                @error('role') <p class="text-xs text-red-500 mt-2 text-center">{{ $message }}</p> @enderror
            </div>

            <div id="formContainer" class="hidden space-y-8 animate-fade-in">
                <div class="p-6 bg-slate-50 rounded-2xl">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-1.5 h-4 bg-indigo-600 rounded-full"></div>
                        <h4 class="text-sm font-bold text-slate-800 tracking-wide">Identitas Akun</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukan nam" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm" required>
                            @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukan email" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm" required>
                            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Password</label>
                            <input type="password" name="password" placeholder="Min. 8 Karakter" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm" required>
                            @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div id="petaniFields" class="hidden p-6 bg-slate-50 rounded-2xl border-t-4 border-indigo-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-1.5 h-4 bg-indigo-600 rounded-full"></div>
                        <h4 class="text-sm font-bold text-slate-800 tracking-wide">Detail Data Petani</h4>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="No Telepon" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm">
                        <input type="text" name="provinsi" value="{{ old('provinsi') }}" placeholder="Provinsi" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm">
                        <input type="text" name="kabupaten" value="{{ old('kabupaten') }}" placeholder="Kabupaten" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm">
                        <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" placeholder="Kecamatan" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm">
                        <input type="text" name="desa" value="{{ old('desa') }}" placeholder="Desa" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm lg:col-span-2">
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-indigo-600 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleFields() {
        const formContainer = document.getElementById('formContainer');
        const petaniFields = document.getElementById('petaniFields');
        const isPetani = document.getElementById('rolePetani').checked;
        const isAdmin = document.getElementById('roleAdmin').checked;

        if (isAdmin || isPetani) {
            formContainer.classList.remove('hidden');
            if (isPetani) {
                petaniFields.classList.remove('hidden');
            } else {
                petaniFields.classList.add('hidden');
                petaniFields.querySelectorAll('input').forEach(el => el.value = '');
            }
        }
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2500,
            background: '#ffffff',
            iconColor: '#4F46E5',
            customClass: {
                title: 'text-slate-800 font-bold',
                htmlContainer: 'text-slate-600'
            }
        });
    @endif

    document.addEventListener('DOMContentLoaded', toggleFields);
</script>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
</style>
@endsection