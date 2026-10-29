<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Info - LOADED</title>
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
            <a href="{{ route('customer.account') }}" class="text-white text-lg"><i class="fa-regular fa-user"></i></a>
            <a href="#" class="text-gray-300 hover:text-white text-lg"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex-grow w-full">
        <div class="flex items-center space-x-3 mb-8">
            <i class="fa-regular fa-user text-2xl text-indigo-400"></i>
            <h2 class="text-3xl font-bold tracking-wide">Personal Info</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 bg-[#171638] p-8 rounded-xl border border-indigo-900/40 shadow-xl space-y-6">
                <!-- ดึงข้อมูลชื่อจากฐานข้อมูลผ่านตัวแปร $user -->
                <div class="border-b border-indigo-950 pb-4 flex justify-between items-center">
                    <div>
                        <div class="text-xs text-gray-400 mb-1">Your Name</div>
                        <div class="text-white font-medium text-sm">{{ $user->name }}</div>
                    </div>
                    <a href="#" class="text-emerald-400 hover:underline text-xs">Edit</a>
                </div>

                <!-- ดึงข้อมูลอีเมลจากฐานข้อมูลผ่านตัวแปร $user -->
                <div class="border-b border-indigo-950 pb-4 flex justify-between items-center">
                    <div>
                        <div class="text-xs text-gray-400 mb-1">Email</div>
                        <div class="text-white font-medium text-sm">{{ $user->email }}</div>
                    </div>
                    <a href="#" class="text-emerald-400 hover:underline text-xs">Edit</a>
                </div>

                <div class="pb-2 flex justify-between items-center">
                    <div>
                        <div class="text-xs text-gray-400 mb-1">Password</div>
                        <div class="text-white font-medium text-sm">****************</div>
                    </div>
                    <a href="#" class="text-emerald-400 hover:underline text-xs">Edit</a>
                </div>

                <!-- ปุ่ม Logout ส่งไปยัง Route ออกจากระบบ -->
                <div class="pt-6 flex items-center justify-between border-t border-indigo-950">
                    <form action="{{ route('games.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-[#242352] hover:bg-[#2e2d6b] text-white text-xs font-bold px-6 py-3 rounded-lg transition border border-indigo-800/60 shadow">
                            LOG OUT
                        </button>
                    </form>

                    <a href="#" class="text-rose-500 hover:underline text-xs font-medium">Delete my account</a>
                </div>
            </div>

            <div class="lg:col-span-4 grid grid-cols-1 gap-6">
                <div class="bg-[#171638] p-6 rounded-xl border border-indigo-900/40 shadow-xl flex flex-col justify-center items-center text-center relative overflow-hidden h-48">
                    <h3 class="text-xl font-bold relative z-10 mb-2">Deals</h3>
                    <p class="text-xs text-gray-400 relative z-10">Explore special discounts and offers.</p>
                </div>
                <div class="bg-[#171638] p-6 rounded-xl border border-indigo-900/40 shadow-xl flex flex-col justify-center items-center text-center relative overflow-hidden h-48">
                    <h3 class="text-xl font-bold relative z-10 mb-2">Latest Games</h3>
                    <p class="text-xs text-gray-400 relative z-10">Discover newly added game keys.</p>
                </div>
            </div>

        </div>
    </main>

</body>
</html>