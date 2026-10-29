<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $game->title }} - LOADEDTHEGAME</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0f0e26] text-white font-sans">

    <!-- Header Navbar -->
    <header class="bg-[#171638] border-b border-indigo-900/50 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-8">
            <a href="{{ route('games.index') }}" class="hover:opacity-80 transition">
                <h1 class="text-2xl font-black tracking-wider text-white">LOADEDTHEGAME<span class="text-pink-500">.</span></h1>
            </a>
            <span class="text-xs text-gray-400 tracking-wide hidden md:inline">PAY LESS. GAME MORE.</span>
        </div>

        <!-- ช่องค้นหา -->
        <div class="flex-1 max-w-md mx-8 hidden lg:block">
            <form action="{{ route('games.search') }}" method="GET" class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fa-solid fa-search"></i>
                </span>
                <input type="text" name="query" placeholder="Search by title..." required class="w-full bg-[#201f4a] text-sm text-white rounded-full pl-10 pr-4 py-2 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </form>
        </div>

        <div class="flex items-center space-x-6 text-sm">
            <a href="{{ route('games.stock') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-3 py-1.5 rounded transition">จัดการสต็อก</a>
            <button class="flex items-center space-x-1 text-gray-300 hover:text-white"><span>ENG</span> <i class="fa-solid fa-chevron-down text-xs"></i></button>
            <button class="flex items-center space-x-1 text-gray-300 hover:text-white"><span>THB</span> <i class="fa-solid fa-chevron-down text-xs"></i></button>
            <a href="#" class="text-gray-300 hover:text-white text-lg"><i class="fa-regular fa-heart"></i></a>
            <a href="#" class="text-gray-300 hover:text-white text-lg"><i class="fa-regular fa-user"></i></a>
            <a href="#" class="text-gray-300 hover:text-white text-lg"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </header>

    @if(session('error'))
        <div class="bg-rose-600 text-white text-center p-3 text-sm font-semibold">{{ session('error') }}</div>
    @endif

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        <div class="text-xs text-gray-400 mb-6">
            <a href="{{ route('games.index') }}" class="hover:text-white">Home</a> / Xbox / Xbox Games
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-5 bg-[#171638] p-4 rounded-xl border border-indigo-900/50">
                <img src="{{ $game->image }}" alt="{{ $game->title }}" class="w-full rounded-lg object-cover shadow-lg">
            </div>

            <div class="lg:col-span-7 space-y-6">
                <div class="flex justify-between items-start">
                    <h2 class="text-2xl font-bold text-white">{{ $game->title }} Key</h2>
                    <button class="text-gray-400 hover:text-red-500 text-xl"><i class="fa-regular fa-heart"></i></button>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#171638] border border-indigo-900 rounded-lg p-3 text-xs flex justify-between items-center cursor-pointer">
                        <span>Xbox Series X|S / PC (WW)</span>
                        <i class="fa-solid fa-chevron-down text-gray-400"></i>
                    </div>
                    <div class="bg-[#171638] border border-indigo-900 rounded-lg p-3 text-xs flex justify-between items-center cursor-pointer">
                        <span>Standard</span>
                        <i class="fa-solid fa-chevron-down text-gray-400"></i>
                    </div>
                </div>

                <div class="bg-[#171638] p-5 rounded-xl border border-indigo-900/50 flex items-center justify-between">
                    <div>
                        <div class="text-xs text-gray-400 line-through">฿3,224.79</div>
                        <div class="text-3xl font-extrabold text-white flex items-center gap-3">
                            ฿{{ number_format($game->price, 2) }}
                            <span class="bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded">{{ $game->discount ?? '26% OFF' }}</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400">Reviewed</div>
                        <div class="text-emerald-400 font-bold text-sm">100%</div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button class="bg-[#171638] hover:bg-[#201f4a] border border-indigo-800 text-white font-bold py-3.5 px-6 rounded-lg text-sm transition flex items-center justify-center gap-2">
                        ADD TO CART <i class="fa-solid fa-cart-shopping text-xs"></i>
                    </button>

                    <form action="{{ route('games.pay', $game->id ?? 1) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 px-6 rounded-lg text-sm transition flex items-center justify-center gap-2 shadow-lg shadow-emerald-900/40">
                            BUY NOW <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-2 gap-y-3 text-xs text-gray-300 pt-4 border-t border-indigo-900/50">
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> In Stock ({{ $game->stock_qty ?? 10 }} pcs)</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> Can activate in Thailand</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> Digital Key Code</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> Login to earn 1% cashback</div>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-indigo-900/50 text-xs text-gray-400">
                    <div>
                        <div class="text-gray-500 mb-1">Publisher</div>
                        <div class="text-white font-semibold">Activision</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Developer</div>
                        <div class="text-white font-semibold">Activision</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Platform</div>
                        <div class="text-white font-semibold">Xbox Play Anywhere</div>
                    </div>
                    <div>
                        <div class="text-gray-500 mb-1">Release Date</div>
                        <div class="text-white font-semibold">23 Oct 2026</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>