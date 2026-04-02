<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MONEV TJSL AIRNAV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F9FA] h-screen flex items-center justify-center p-4">

    <div class="flex w-full max-w-[1000px] h-[600px] bg-white rounded-lg shadow-xl overflow-hidden">

        <div class="hidden md:block w-[55%] h-full">
            <img src="{{ asset('images/salak.png') }}" alt="Salak" class="w-full h-full object-cover">
        </div>

        <div class="w-full md:w-[45%] p-10 flex flex-col">

            <div class="flex items-center justify-center gap-3 mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo AirNav" class="w-12 object-contain">
                <div class="text-left">
                    <h1 class="font-bold text-gray-800 text-[13px] leading-tight tracking-wide">MONEV TJSL</h1>
                    <h1 class="font-bold text-gray-800 text-[13px] leading-tight tracking-wide">AIRNAV INDONESIA</h1>
                </div>
            </div>

            <div class="flex-grow flex flex-col justify-center">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Senang bertemu anda kembali</h2>

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-[10px] font-semibold text-gray-400 block mb-1 ml-1">Login</label>
                        <input type="text" name="name" placeholder="Masukkan username"
                            class="w-full bg-[#F3F4F6] p-3 rounded-md text-sm border-none outline-none placeholder:text-gray-400 focus:ring-1 focus:ring-blue-400"
                            required>
                        @error('name')
                            <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-[10px] font-semibold text-gray-400 block mb-1 ml-1">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Masukkan kata sandi"
                                class="w-full bg-[#F3F4F6] p-3 rounded-md text-sm border-none outline-none placeholder:text-gray-400 focus:ring-1 focus:ring-blue-400"
                                required>

                            <button type="button" onclick="togglePass()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg id="eyeSvg" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path id="eyePath" stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path id="eyeCircle" stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12.a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#007BFF] text-white p-3 rounded-md text-sm font-bold mt-2 hover:bg-blue-700 transition shadow-sm active:scale-[0.98]">
                        Masuk
                    </button>
                </form>
            </div>

            <div class="text-center text-[10px] text-gray-400 pt-4">
                © 2026 Dashboard Monitoring Panen Salak
            </div>
        </div>
    </div>

    <script>
        function togglePass() {
            const passInput = document.getElementById('password');
            const eyePath = document.getElementById('eyePath');
            const eyeCircle = document.getElementById('eyeCircle');
            const closedPath =
                "M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.822 7.822L21 21m-2.278-2.278-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88";
            const openPath =
                "M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z";
            const openCircle = "M15 12.a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z";

            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyePath.setAttribute('d', closedPath);
                eyeCircle.setAttribute('d', '');
            } else {
                passInput.type = 'password';
                eyePath.setAttribute('d', openPath);
                eyeCircle.setAttribute('d', openCircle);
            }
        }

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: "{{ session('error') }}",
                confirmButtonColor: '#3A5BFF',
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Input Tidak Valid',
                text: 'Silakan periksa kembali username dan password Anda.',
                confirmButtonColor: '#3A5BFF',
            });
        @endif
    </script>
</body>

</html>
