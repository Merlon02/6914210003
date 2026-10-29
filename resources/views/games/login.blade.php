<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - LOADED</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0f0e26] text-white font-sans min-h-screen flex flex-col justify-between">

    <!-- Header Navbar -->
    <header class="bg-[#171638] border-b border-indigo-900/50 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-8">
            <a href="{{ route('games.index') }}" class="hover:opacity-80 transition">
                <h1 class="text-2xl font-black tracking-wider text-white">LOADED<span class="text-pink-500">.</span></h1>
            </a>
            <span class="text-xs text-gray-400 tracking-wide hidden md:inline">PAY LESS. GAME MORE.</span>
        </div>

        <div class="flex-1 max-w-md mx-8 hidden lg:block">
            <form action="{{ route('games.search') }}" method="GET" class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fa-solid fa-search"></i>
                </span>
                <input type="text" name="query" placeholder="Search by title..." required class="w-full bg-[#201f4a] text-sm text-white rounded-full pl-10 pr-4 py-2 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </form>
        </div>

        <div class="flex items-center space-x-6 text-sm">
            <button class="flex items-center space-x-1 text-gray-300 hover:text-white"><span>ENG</span> <i class="fa-solid fa-chevron-down text-xs"></i></button>
            <button class="flex items-center space-x-1 text-gray-300 hover:text-white"><span>THB</span> <i class="fa-solid fa-chevron-down text-xs"></i></button>
            <a href="#" class="text-gray-300 hover:text-white text-lg"><i class="fa-regular fa-heart"></i></a>
            <a href="{{ route('games.login') }}" class="text-white text-lg"><i class="fa-regular fa-user"></i></a>
            <a href="#" class="text-gray-300 hover:text-white text-lg"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </header>

    <!-- Main Login Content -->
    <main class="max-w-7xl mx-auto px-6 py-12 flex-grow w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <div class="bg-[#171638] p-8 rounded-xl border border-indigo-900/40 shadow-xl flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-center mb-8 tracking-wide">Log In</h2>

                    @if($errors->any())
                        <div class="bg-rose-600/90 text-white p-3 rounded mb-4 text-xs">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('games.authenticate') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <input type="email" name="email" placeholder="Email" required class="w-full bg-[#0f0e26] border border-indigo-900/80 p-3 rounded-lg text-sm text-white focus:outline-none focus:border-indigo-500">
                            </div>
                            <div class="relative">
                                <input type="password" name="password" placeholder="Password" required class="w-full bg-[#0f0e26] border border-indigo-900/80 p-3 rounded-lg text-sm text-white focus:outline-none focus:border-indigo-500 pr-10">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-[#242352] hover:bg-[#2e2d6b] text-gray-300 hover:text-white font-bold py-3.5 rounded-lg text-sm transition mt-2 shadow-inner border border-indigo-800/50">
                            LOGIN
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-[#171638] p-8 rounded-xl border border-indigo-900/40 shadow-xl flex flex-col justify-between text-center">
                <div>
                    <h2 class="text-2xl font-bold mb-4 tracking-wide">Register</h2>
                    <p class="text-gray-400 text-sm max-w-sm mx-auto mb-10 leading-relaxed">
                        Simply click the Register button and fill out the form to become part of a huge online community.
                    </p>
                </div>
                <a href="#" class="w-full bg-[#10b981] hover:bg-[#059669] text-white font-bold py-3.5 rounded-lg text-sm transition shadow-lg shadow-emerald-900/30 block text-center">
                    REGISTER
                </a>
            </div>

        </div>
    </main>

</body>
</html>