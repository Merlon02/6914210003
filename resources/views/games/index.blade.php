<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOADED - Pay Less. Game More.</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0f0e26] text-white font-sans">

    <!-- Header Navbar -->
    <header class="bg-[#171638] border-b border-indigo-900/50 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-8">
            <a href="{{ route('games.index') }}" class="hover:opacity-80 transition">
                <h1 class="text-2xl font-black tracking-wider text-white">LOADED<span class="text-pink-500">.</span></h1>
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
            <!-- ตรวจสอบสถานะ: ถ้าล็อกอินแล้วไปหน้า account ถ้ายังไปหน้า login -->
            <a href="{{ Auth::check() ? route('customer.account') : route('games.login') }}" class="text-gray-300 hover:text-white text-lg"><i class="fa-regular fa-user"></i></a>
            <a href="#" class="text-gray-300 hover:text-white text-lg"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </header>

    @if(session('success'))
        <div class="bg-emerald-600 text-white text-center p-3 text-sm font-semibold">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-rose-600 text-white text-center p-3 text-sm font-semibold">{{ session('error') }}</div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold mb-8 tracking-wide">Best Sellers</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
            @foreach($games as $game)
            <div class="bg-[#171638] rounded-lg overflow-hidden border border-indigo-900/40 hover:border-indigo-500 transition duration-300 flex flex-col justify-between group">
                <a href="{{ route('games.show', $game->id ?? 1) }}" class="relative aspect-[3/4] overflow-hidden bg-gray-900 block">
                    <img src="{{ $game->image }}" alt="{{ $game->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @if(!empty($game->discount))
                    <span class="absolute bottom-3 right-3 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
                        {{ $game->discount }}
                    </span>
                    @endif
                </a>

                <div class="p-4 flex flex-col flex-grow justify-between">
                    <div>
                        <a href="{{ route('games.show', $game->id ?? 1) }}">
                            <h3 class="text-xs font-semibold text-gray-200 line-clamp-2 mb-2 leading-relaxed uppercase hover:text-indigo-400">{{ $game->title }}</h3>
                        </a>
                        <div class="mb-3">
                            @if(isset($game->stock_qty) && $game->stock_qty > 0)
                                <span class="inline-block bg-emerald-900/60 text-emerald-400 text-[10px] font-medium px-2 py-0.5 rounded border border-emerald-500/30">
                                    <i class="fa-solid fa-box-archive mr-1"></i> เหลือคงเหลือ {{ $game->stock_qty }} ชิ้น
                                </span>
                            @else
                                <span class="inline-block bg-rose-900/60 text-rose-400 text-[10px] font-medium px-2 py-0.5 rounded border border-rose-500/30">
                                    <i class="fa-solid fa-circle-xmark mr-1"></i> สินค้าหมด
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="text-lg font-bold text-white">
                        ฿{{ number_format($game->price, 2) }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

</body>
</html>