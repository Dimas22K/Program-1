<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT PAL</title>
    <link rel="icon" type="image/png" href="/images/kalibrasi.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        /* Keyframes untuk animasi elemen masuk */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Keyframes untuk animasi kartu utama */
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.98); }
            to { opacity: 1; transform: scale(1); }
        }
        
        /* Keyframes untuk zoom lambat pada gambar latar kanan */
        @keyframes slowZoom {
            0% { background-size: 100% 100%; }
            100% { background-size: 110% 110%; }
        }

        /* Kelas utilitas untuk menerapkan animasi */
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .animate-slide-in-up {
            /* Atur kondisi awal sebelum animasi berjalan */
            opacity: 0;
            animation: slideInUp 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .animate-slow-zoom {
            background-repeat: no-repeat;
            background-position: center;
            /* Animasi berjalan selama 40 detik, bolak-balik, dan mulus */
            animation: slowZoom 40s infinite alternate ease-in-out;
        }
    </style>
    </head>

<body style="background: radial-gradient(circle at center, #0085FF, #003465);" 
      class="min-h-screen text-gray-900 flex justify-center">

    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex flex-1 animate-fade-in">
        
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex flex-col justify-center items-center">
            
            <img src="/images/PAL.png" class="w-60 mb-16 animate-slide-in-up" style="animation-delay: 0.1s;" />

            <h1 class="text-2xl xl:text-3xl font-bold mb-10 animate-slide-in-up" style="animation-delay: 0.2s;">
                Masuk
            </h1>

            <form action="{{ url('/index') }}" method="POST" class="w-full max-w-xs">
                @csrf

                <input
                    class="w-full px-8 py-4 mb-2 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white animate-slide-in-up"
                    style="animation-delay: 0.3s;"
                    type="text" name="username" placeholder="Username" />

                <div class="relative mt-5 animate-slide-in-up" style="animation-delay: 0.4s;">
                    <input
                        id="password"
                        class="w-full px-8 py-4 pr-12 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="password" name="password" placeholder="Password" />
                    
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                        <i id="eyeIcon" class="ph ph-eye"></i>
                    </button>
                </div>

                <button type="submit"
                    class="mt-5 tracking-wide font-semibold bg-[#0085FF] text-gray-100 w-full py-4 rounded-lg hover:bg-[#0063c0] transform hover:scale-105 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none animate-slide-in-up"
                    style="animation-delay: 0.5s;">
                    <span class="ml-3">
                        Login
                    </span>
                </button>
            </form>
        </div>

        <div class="flex-1 hidden lg:flex bg-center bg-cover animate-slow-zoom" style="background-image: url('/images/kanan.png');">
        </div>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('ph-eye');
                eyeIcon.classList.add('ph-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('ph-eye-slash');
                eyeIcon.classList.add('ph-eye');
            }
        }
    </script>
</body>

</html>