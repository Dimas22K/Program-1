<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT PAL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body style="background: radial-gradient(circle at center, #0085FF, #003465);" 
      class="min-h-screen text-gray-900 flex justify-center">

    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex flex-1">
        
        <!-- Kolom Kiri -->
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex flex-col justify-center items-center">
            <!-- Logo -->
            <img src="/images/PAL.png" class="w-60 mb-16" />

            <!-- Judul -->
            <h1 class="text-2xl xl:text-3xl font-bold mb-10">
                Masuk
            </h1>

            <!-- Form -->
            <form action="{{ url('/login') }}" method="POST" class="w-full max-w-xs">
                @csrf

                <!-- Username -->
                <input
                    class="w-full px-8 py-4 mb-2 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                    type="text" name="username" placeholder="Username" />

                <!-- Password + Icon -->
                <div class="relative mt-5">
                    <input
                        id="password"
                        class="w-full px-8 py-4 pr-12 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="password" name="password" placeholder="Password" />
                    
                    <!-- Icon toggle -->
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                        <i id="eyeIcon" class="ph ph-eye"></i>
                    </button>
                </div>

                <!-- Tombol Login -->
                <button type="submit"
                    class="mt-5 tracking-wide font-semibold bg-[#0085FF] text-gray-100 w-full py-4 rounded-lg hover:bg-[#0063c0] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                    <span class="ml-3">
                        Login
                    </span>
                </button>
            </form>
        </div>

        <!-- Kolom Kanan -->
        <div class="flex-1 hidden lg:flex bg-center bg-cover" style="background-image: url('/images/kanan.png');">
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